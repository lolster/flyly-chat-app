// put whatever urls here
var imgSrc = ['../public/images/1.png', '../public/images/2.png', '../public/images/3.png', '../public/images/4.png', '../public/images/5.png', '../public/images/6.png', '../public/images/7.png', '../public/images/8.png', '../public/images/9.png'];

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