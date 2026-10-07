(() => {
	const header = document.querySelector('.nc-header[data-hero-overlay="true"]');
	const hero = document.querySelector('.nc-hero, .nc-about-hero');
	if (!header || !hero) return;
	let frame;
	const measure = () => {
		document.documentElement.style.setProperty('--nc-overlay-header-height', `${header.offsetHeight}px`);
	};
	const update = () => {
		frame = undefined;
		const adminBar = document.getElementById('wpadminbar');
		if (adminBar && window.matchMedia('(max-width: 600px)').matches) {
			header.style.top = `${Math.max(0, adminBar.getBoundingClientRect().bottom)}px`;
		} else {
			header.style.top = '';
		}
		// Restore the normal header when the hero no longer fills its backdrop.
		header.classList.toggle('nc-header--over-hero', hero.getBoundingClientRect().bottom > header.getBoundingClientRect().bottom + 1);
	};
	const requestUpdate = () => {
		if (frame === undefined) frame = window.requestAnimationFrame(update);
	};
	measure();
	header.classList.add('nc-header--hero-enabled');
	document.documentElement.classList.add('nc-has-overlay-header');
	update();
	window.addEventListener('scroll', requestUpdate, { passive: true });
	window.addEventListener('resize', () => {
		measure();
		requestUpdate();
	});
	window.addEventListener('pageshow', requestUpdate);
	if ('ResizeObserver' in window) new ResizeObserver(() => {
		measure();
		requestUpdate();
	}).observe(header);
})();
