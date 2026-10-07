// A home não carrega o pacote do tema pai que controla este botão.
(() => {
	const button = document.querySelector('.orchid-backtotop');
	if (!button) return;
	const updateVisibility = () => {
		button.hidden = window.scrollY <= 600;
	};
	window.addEventListener('scroll', updateVisibility, { passive: true });
	button.addEventListener('click', () => {
		window.scrollTo({
			top: 0,
			behavior: window.matchMedia('(prefers-reduced-motion: reduce)').matches ? 'instant' : 'smooth',
		});
	});
	updateVisibility();
})();
