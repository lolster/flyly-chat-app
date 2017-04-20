$(window).on('load', ()=>{
	var re = /(?:\.([^.]+))?$/;

	var mappings = {};
	mappings['py'] = 'python';
	mappings['c'] = 'c';
	mappings['cpp'] = 'cpp';
	mappings['java'] = 'java';
	mappings['js'] = 'javascript';
	mappings['txt'] = '';
	mappings['php'] = 'php';
	mappings['css'] = 'css';
	mappings['html'] = 'html';
	mappings['sql'] = 'sql';

	$('#file-in').on('change', (event) => {
		if(event.target.value && event.target.value.length != 0) {
			var ext = re.exec(event.target.value)[1];
			console.log('filename ext: ' + ext);
			var file = event.target.files[0];
			var reader = new FileReader();
			reader.onload = function(e) {
				// console.log(mappings);
				// console.log(ext);
				// console.log(mappings[ext]);
				// console.log(this.result);
				if (window.innerWidth > 992) {
					expandChatArea();
				}
				if(mappings[ext])
					$('#msg-box').val('```' + mappings[ext] + '\n' + this.result + '\n```\n');
				else 
					$('#msg-box').val('```' + '\n' + this.result + '\n```\n');
			}
			reader.readAsText(file);
			event.target.value = '';
		}
	})
});