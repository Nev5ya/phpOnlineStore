const block = document.querySelector('.gallery_wrapper');

function handleEvents() {
	block.addEventListener('click', (e) => {
		if (e.target.classList.contains('gallery_img')) {
			e.target.classList.toggle('active');
			e.path[1].children[2].classList.toggle('image-views_invisible');
		}
	});
}
handleEvents();