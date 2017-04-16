<?php
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	require 'db_connect.php';

	$recieverID = $_POST['uid'];
	$friendName = $_POST['name'];
	$time = $_POST['time'];
	$n = 10;

	if (isset($_POST['n'])) {
		$n = $_POST['n'];
	}

	// Query to retrieve the latest message that was sen by another person----------------------------------------------

	$senderID = - 1; // SOME random val to intialize with.

	// prepare statement.
	if (!$stmnt = $connection->prepare('SELECT userid FROM `users` where username = ?')) {
		die(json_encode(array(
			'status' => 'error',
			'message' => 'query failed!'
		)));
	}

	// binding the '?' with $friendName.
	if (!$stmnt->bind_param('s', $friendName)) {
		die(json_encode(array(
			'status' => 'error',
			'message' => 'binding unsuccessful!'
		)));
	}

	// executing the statement.
	if (!$stmnt->execute()) {
		die(json_encode(array(
			'status' => 'error',
			'message' => 'execution falied!'
		)));
	}

	// binding the result of the query to $senderID
	if (!$stmnt->bind_result($senderID)) {
		die(json_encode(array(
			'status' => 'error',
			'msg' => 'binding failed'
		)));
	}

	$res = $stmnt->fetch();

	if ($res == TRUE) {
		// echo $senderID;
	} else if ($res == NULL) {
		die(json_encode(array(
			'status' => 'Could not fetch the sender userID',
			'message' => 'execution falied!'
		)));
	} else {
		die(json_encode(array(
			'status' => 'Erro Occured while fetching',
			'message' => 'execution falied!'
		)));
	}

	$stmnt->close();

	// #####This much working perfect.
	// FROM_UNIXTIME => automatically converts to required time format
	$stmnt2 = $connection->prepare('SELECT body, msgTime, send_id, rcv_id FROM messages where ((send_id = ? and rcv_id = ?) OR (send_id = ? and rcv_id = ?)) and msgTime <= FROM_UNIXTIME(?) ORDER BY msgTime DESC LIMIT ?');

	if (!$stmnt2) {
		die(json_encode(array(
			'status' => 'error in second part',
			'message' => 'query failed! in second part'
		)));
	}

	$latestmessage = '';
	$timeMessage = '';
	$msg_send_id = '';
	$msg_recv_id = '';

	if (!$stmnt2->bind_param('iiiiii', $senderID, $recieverID, $recieverID, $senderID, $time, $n)) {
		die(json_encode(array(
			'status' => 'error in second part',
			'message' => 'binding unsuccessful in second part!'
		)));
	}

	if (!$stmnt2->execute()) {
		die(json_encode(array(
			'status' => 'error in second part',
			'message' => 'execution falied! in second part'
		)));
	}

	if (!$stmnt2->bind_result($latestmessage, $timeMessage, $msg_send_id, $msg_recv_id)) {
		die(json_encode(array(
			'status' => 'error',
			'msg' => 'binding failed'
		)));
	}

	$messages = array();

	while ($stmnt2->fetch()) {
		if( ((int)$msg_send_id) == ((int)$recieverID) ) {
			//user sent it
			$res = true;
		}
		else {
			//other guy sent it
			$res = false;
		}
		$messages[] = array(
			'msg' => $latestmessage,
			'time' => $timeMessage,
			'i_sent' => $res
		);
	}

	$stmnt2->close();

	die(json_encode(array(
		'status' => 'success',
		'msgs' => $messages,
	)));
?>