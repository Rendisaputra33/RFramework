function createPreviewImage(currentEl, element) {
	const fileread = new FileReader();
    // 
	fileread.onload = function () {
		element.src = fileread.result;
	};
    // 
	fileread.readAsDataURL(currentEl.target.files[0]);
}
