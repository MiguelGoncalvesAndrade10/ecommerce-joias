(() => {
	const page = document.querySelector('.nc-home-page');
	if (!page) return;
	const elements = [...page.querySelectorAll('[data-home-reveal]')];
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	const revealed = new WeakSet();
	let observer;

	const show = element => {
		element.classList.remove('nc-home-reveal--waiting');
		revealed.add(element);
		observer?.unobserve(element);
	};
	const configure = () => {
		observer?.disconnect();
		elements.forEach(element => element.classList.remove('nc-home-reveal--waiting'));
		if (reducedMotion.matches || !('IntersectionObserver' in window)) return;
		observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
				if (entry.isIntersecting) show(entry.target);
			});
		}, { threshold: 0.08 });
		elements.forEach(element => {
			if (revealed.has(element)) return;
			// Preserve content already visible when loading or restoring the page.
			if (element.getBoundingClientRect().top < window.innerHeight) {
				show(element);
				return;
			}
			observer.observe(element);
			element.classList.add('nc-home-reveal--waiting');
		});
	};
	page.addEventListener('focusin', event => {
		const element = event.target.closest('[data-home-reveal]');
		if (element) show(element);
	});
	reducedMotion.addEventListener('change', configure);
	window.addEventListener('pageshow', () => {
		elements.forEach(element => {
			if (element.getBoundingClientRect().top < window.innerHeight) show(element);
		});
	});
	configure();
})();
