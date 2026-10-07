(() => {
	const hero = document.querySelector(".nc-hero");
	const heroMedia = document.querySelector(".nc-hero__media");

	if (!hero || !heroMedia) {
		return;
	}

	const motionPreference = window.matchMedia(
		"(min-width: 768px) and (prefers-reduced-motion: no-preference)"
	);

	let animationFrame;

	const updateParallax = () => {
		animationFrame = undefined;

		if (!motionPreference.matches) {
			heroMedia.style.transform = "";
			return;
		}

		const heroPosition = hero.getBoundingClientRect();

		if (
			heroPosition.bottom < 0 ||
			heroPosition.top > window.innerHeight
		) {
			return;
		}

		const progress =
			(window.innerHeight - heroPosition.top) /
			(window.innerHeight + heroPosition.height);

		// Movimento ampliado temporariamente para facilitar a avaliação visual do parallax.
		const offset = (progress - 0.5) * 480;

		heroMedia.style.transform = `translate3d(0, ${offset.toFixed(2)}px, 0)`;
	};

	const requestParallaxUpdate = () => {
		if (!animationFrame) {
			animationFrame = window.requestAnimationFrame(updateParallax);
		}
	};

	window.addEventListener("scroll", requestParallaxUpdate, {
		passive: true,
	});

	window.addEventListener("resize", requestParallaxUpdate);

	motionPreference.addEventListener("change", requestParallaxUpdate);

	requestParallaxUpdate();
})();
