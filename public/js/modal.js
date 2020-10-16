const block = document.querySelector('.gallery_wrapper');

function handleEvents() {
	block.addEventListener('click', (e) => {
		if (e.target.classList.contains('gallery_img')) {
			e.target.classList.toggle('active');
		}
	});
}
handleEvents();