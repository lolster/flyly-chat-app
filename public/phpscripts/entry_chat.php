<?php
	error_reporting(E_ALL);
	ini_set('display_errors',1);
	//mysqli_report((MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

	require 'db_connect.php';
	
	$user = $_SESSION['username'];
	$firstname = $_SESSION['firstname'];
	$lastname = $_SESSION['lastname'];
	$userid = $_SESSION['id'];
	$email = $_SESSION['email'];
	
	/*$user = 'hunter';
	$firstname = 'Sriharsha';
	$lastname = 'Hatwar';
	$userid = 10;
	$email = 'whocares@gmail.com';*/
	#Changes -> need to get the first name , lastname of a particular username
	if(!$stmnt = $connection->prepare('SELECT userid, username, firstname, lastname from users where userid in (select send_id from messages where rcv_id = ? )')){
		 die(json_encode(array(
			 'status'=>'error',
			 'message'=>'query failed!'
		 )));
	}
	if(!$stmnt->bind_param('i',$userid)){
		die(json_encode(array(
			'status'=>'error',
			'message'=>'binding unsuccessful!'
		)));
	}
	if(!$stmnt->execute()){
		die(json_encode(array(
			'status'=>'error',
			'message'=>'execution falied!'
		)));
	}
	// variables to hold the result.
	$userFriendId = -1;
	$userFriend = '';
	$userFriendFirstN = '';
	$userFriendLastN = '';
	$userFriendsId = array();
	$userFriends = array();
	$userFriendsFirstName = array();
	$userFriendsLastName = array();
	if(!$stmnt->bind_result($userFriendId, $userFriend, $userFriendFirstN, $userFriendLastN)) {
		die(json_encode(array(
			'status'=>'error',
			'msg'=>'binding failed'
		)));
	}
	while($stmnt->fetch()){
		//array_push($userFriends,$user); //waste time and stack space by making function call
		$userFriendsId[] = $userFriendId;
		$userFriends[] = $userFriend;
		$userFriendsFirstName[] = $userFriendFirstN;
		$userFriendsLastName[] = $userFriendLastN;
	}

	$stmnt->close();

	$friend_wid_time = array();
	// get the latest timestamp associated with the userFriend and build an array contaning userFriend and the timestamp.
	// sort the array on the basis of the timestamp in descending order.
	//Could be done much more efficient, but have no time.

	$length = sizeof($userFriends);
	
	for($i = 0 ; $i < $length ; $i++){
		//get the latest timestamp by querying.
		$frID = $userFriendsId[$i];
		$time_friend = "";
		
		if(!($stmnt = $connection->prepare('SELECT msgTime FROM messages WHERE ((send_id = ? AND rcv_id = ?) OR (send_id = ? AND rcv_id = ?)) ORDER BY msgTime DESC LIMIT 1'))) {
			die(json_encode(array(
				'status'=>'error getting timestamp',
				'message'=>'query failed!',
				'msg' => $connection->error
			)));
		}
		
		if(!$stmnt->bind_param('iiii',$userid,$frID,$frID,$userid)){
			die(json_encode(array(
				'status'=>'error',
				'message'=>'binding unsuccessful!'
			)));
		}
		
		if(!$stmnt->execute()){
			die(json_encode(array(
				'status'=>'error while executing second query',
				'message'=>'execution falied!'
			)));
		}

		$time_friend = '';
		
		if(!$stmnt->bind_result($time_friend)){
			die(json_encode(array(
				'status'=>'error',
				'msg'=>'binding failed'
			)));
		}

		$fml = $stmnt->fetch();
		
		if($fml === null) {
			$friend_wid_time[] = array('name'=>$userFriends[$i],'timestamp'=>null);
		}
		else if($fml === false) {
			die(json_encode(array(
				'status'=>'error',
				'msg'=>'binding failed'
			)));	
		}
		else {
			$friend_wid_time[] = array('name'=>$userFriends[$i],'timestamp'=>$time_friend);
			$stmnt->close();
		}
	}
	
	function build_sorter($key){
		return function($a,$b) use ($key){
			$date1 = DateTime::createFromFormat('Y-m-d H:i:s', $a[$key]);
			$date2 = DateTime::createFromFormat('Y-m-d H:i:s', $b[$key]);
			$res = 0;
			if ($date1 < $date2) $res = 1;
			else if ($date1 > $date2) $res = -1;
			return $res;
			//return (($date1 < $date2) ? (-1 : (($date2 < $date1) ? ( 1 : 0 ))));
		};
	}

	usort($friend_wid_time, build_sorter('timestamp'));
	for($i = 0 ; $i < $length ; ++$i) {
		// Mr. Hunter, why thou must force me to do this egregious deed?;
		$index = array_search($friend_wid_time[$i]['name'], $userFriends);
		if($index === false) {
			die(json_encode(array(
				'status' => 'serror',
				'msg' => 'kill me'
			)));
		}
		
		$temp = $userFriendsFirstName[$i];
		$userFriendsFirstName[$i] = $userFriendsFirstName[$index];
		$userFriendsFirstName[$index] = $temp;
		
		$temp = $userFriendsLastName[$i];
		$userFriendsLastName[$i] = $userFriendsLastName[$index];
		$userFriendsLastName[$index] = $temp;
		
		$temp = $userFriends[$i];
		$userFriends[$i] = $friend_wid_time[$i]['name'];
		$userFriends[$index] = $temp;
	}
?>