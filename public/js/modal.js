const block = document.querySelector('.gallery_wrapper');

function handleEvents() {
	block.addEventListener('click', (e) => {
		e.target.classList.toggle('active');
	});
}
handleEvents();