export function createPreviewImage(element) {
	return event => {
		const fileread = new FileReader();
		fileread.onload = () => (element.src = fileread.result);
		fileread.readAsDataURL(event.target.files[0]);
	};
}
