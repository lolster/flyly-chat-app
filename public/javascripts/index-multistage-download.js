// put whatever urls here
var imgSrc = ['http://i.imgur.com/QRADrXh.jpg', 'http://i.imgur.com/7ss7KpJ.jpg', 'https://i.redditmedia.com/S-5DrXu-oSY6rpP85mjTA-BUe6i1gILWBq6Ow3_WYdE.jpg?w=1024&s=be4490678cce011cea176c40e500e4bd', 'https://i.redditmedia.com/CxVKZbynn_bcoG6B5Fh8Lud1HSj_v0oQnzo1gmVMjT0.jpg?w=1024&s=aafa9c98cf784876d6f99b02df344275'];

$(window).on('load', () => {
	var imgList = $('img');
	var i = 0;
	function getImgs() {
		if(i >= imgSrc.length) {
			return;
		}
		imgList[i].src = imgSrc[i];
		imgList[i+1].src = imgSrc[i+1];
		i += 2;
		console.log('yolo');
		setTimeout(getImgs, 1000);
	}
	getImgs();
});