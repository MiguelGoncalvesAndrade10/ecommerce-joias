(() => {
	const page = document.querySelector('.nc-about-page');
	if (!page) return;
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	const desktop = window.matchMedia('(min-width: 768px)');
	const hero = page.querySelector('.nc-about-hero');
	const media = page.querySelector('.nc-about-hero__media');
	const popPhoto = page.querySelector('[data-about-pop]');
	const popStage = page.querySelector('.nc-about-story');
	const popDepth = Math.max(15, Math.min(65, Number(popPhoto?.dataset.popDepth) || 45)) / 100;
	const elements = [...page.querySelectorAll('[data-about-reveal]')].filter(element => element !== popPhoto);
	const revealed = new WeakSet();
	let observer;
	let frame;
	let popArmed = true;

	const showPhoto = () => {
		if (!popPhoto) return;
		popPhoto.classList.remove('nc-about-reveal--waiting');
		popPhoto.classList.add('nc-about-pop--visible');
		popArmed = false;
	};
	const armPhoto = () => {
		if (!popPhoto) return;
		popPhoto.classList.remove('nc-about-pop--visible');
		popPhoto.classList.add('nc-about-reveal--waiting');
		popArmed = true;
	};
	const configurePhoto = () => {
		if (!popPhoto) return;
		popPhoto.classList.remove('nc-about-reveal--waiting', 'nc-about-pop--visible');
		popArmed = true;
		if (!reducedMotion.matches) armPhoto();
	};
	const updatePhoto = () => {
		if (!popPhoto || !popStage || reducedMotion.matches) return;
		// Measure the unscaled section so the animation cannot change its own trigger.
		const rect = popStage.getBoundingClientRect();
		if (!popArmed && (window.scrollY <= 2 || rect.top >= window.innerHeight * 0.95)) {
			armPhoto();
			return;
		}
		if (popArmed && window.scrollY > 2 && rect.top <= window.innerHeight * (1 - popDepth) && rect.bottom > 0) showPhoto();
	};

	const show = element => {
		element.classList.remove('nc-about-reveal--waiting');
		revealed.add(element);
		observer?.unobserve(element);
	};

	const configureReveal = () => {
		observer?.disconnect();
		elements.forEach(element => element.classList.remove('nc-about-reveal--waiting'));
		if (reducedMotion.matches || !('IntersectionObserver' in window)) return;
		observer = new IntersectionObserver(entries => {
			entries.forEach(entry => {
				if (!entry.isIntersecting) return;
				show(entry.target);
			});
		}, { threshold: 0.08 });
		elements.forEach(element => {
			if (revealed.has(element)) return;
			if (page.dataset.reveal !== 'true') return;
			// Content already on screen stays visible, including after a preference change.
			if (element.getBoundingClientRect().top < window.innerHeight) {
				show(element);
				return;
			}
			observer.observe(element);
			element.classList.add('nc-about-reveal--waiting');
		});
	};

	const update = () => {
		frame = undefined;
		updatePhoto();
		if (!media) return;
		if (reducedMotion.matches || !desktop.matches || page.dataset.parallax !== 'true') {
			media.style.transform = '';
			return;
		}
		const rect = hero.getBoundingClientRect();
		if (rect.bottom < 0 || rect.top > window.innerHeight) return;
		const progress = Math.max(0, Math.min(1, (window.innerHeight - rect.top) / (window.innerHeight + rect.height)));
		const strength = Math.max(0, Math.min(120, Number(page.dataset.parallaxStrength) || 0));
		media.style.transform = `translate3d(0, ${((progress - 0.5) * strength).toFixed(2)}px, 0)`;
	};
	const requestUpdate = () => {
		if (frame === undefined) frame = window.requestAnimationFrame(update);
	};
	window.addEventListener('scroll', requestUpdate, { passive: true });
	window.addEventListener('resize', requestUpdate);
	desktop.addEventListener('change', requestUpdate);
	reducedMotion.addEventListener('change', () => {
		configureReveal();
		configurePhoto();
		requestUpdate();
	});
	// Keyboard focus must never land in visually hidden content.
	page.addEventListener('focusin', event => {
		const element = event.target.closest('[data-about-reveal]');
		if (element === popPhoto) showPhoto();
		else if (element) show(element);
	});
	window.addEventListener('pageshow', () => {
			elements.forEach(element => {
			if (element.getBoundingClientRect().top < window.innerHeight) show(element);
		});
		requestUpdate();
	});
	configureReveal();
	configurePhoto();
	requestUpdate();
})();
