// put whatever urls here
var imgSrc = ['../public/images/dog.jpg', '../public/images/dog.jpg', '../public/images/dog.jpg', '../public/images/dog.jpg'];

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
		console.log(imgList);
		console.log('yolo');
		setTimeout(getImgs, 2000);
	}
	getImgs();
});