(() => {
	const track = document.querySelector('.nc-category-carousel__track');
	if (!track) return;
	const carousel = track.closest('.nc-category-carousel');
	const controls = carousel.querySelector('.nc-category-carousel__controls');
	const previous = controls.querySelector('[data-category-previous]');
	const next = controls.querySelector('[data-category-next]');
	const playback = carousel.querySelector('[data-category-pause]');
	const originals = [...track.querySelectorAll('.nc-category-card')];
	const reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	const speed = Math.max(10, Math.min(80, Number(carousel.dataset.speed) || 28));
	let cycle = 0;
	let step = 0;
	let position = 0;
	let hovered = false;
	let focused = false;
	let touching = false;
	let paused = false;
	let visible = !('IntersectionObserver' in window);
	let frame;
	let lastTime;
	let manualMove;
	let releaseTimer;

	const wrap = value => cycle + ((value - cycle) % cycle + cycle) % cycle;
	const canRun = () => cycle > 0 && carousel.dataset.autoplay === 'true' &&
		!reducedMotion.matches && !paused && !hovered && !focused && !touching && visible && !document.hidden;
	const tick = time => {
		frame = undefined;
		if (manualMove) {
			manualMove.start ??= time;
			const progress = Math.min(1, (time - manualMove.start) / 320);
			const eased = 1 - Math.pow(1 - progress, 3);
			position = wrap(manualMove.from + manualMove.distance * eased);
			if (progress === 1) manualMove = undefined;
		} else if (canRun() && lastTime !== undefined) {
			position = wrap(position + speed * Math.min(time - lastTime, 50) / 1000);
		}
		track.scrollLeft = position;
		lastTime = time;
		if (manualMove || canRun()) frame = window.requestAnimationFrame(tick);
		else lastTime = undefined;
	};
	const refresh = () => {
		if ((manualMove || canRun()) && frame === undefined) {
			lastTime = undefined;
			frame = window.requestAnimationFrame(tick);
		} else if (!manualMove && !canRun() && frame !== undefined) {
			window.cancelAnimationFrame(frame);
			frame = undefined;
			lastTime = undefined;
		}
	};
	const cloneGroup = () => {
		const fragment = document.createDocumentFragment();
		originals.forEach(card => {
			const clone = card.cloneNode(true);
			clone.dataset.carouselClone = 'true';
			clone.setAttribute('aria-hidden', 'true');
			clone.setAttribute('tabindex', '-1');
			clone.removeAttribute('id');
			clone.querySelectorAll('[id]').forEach(element => element.removeAttribute('id'));
			fragment.append(clone);
		});
		return fragment;
	};
	const build = () => {
		const phase = cycle ? (wrap(position) - cycle) / cycle : 0;
		track.querySelectorAll('[data-carousel-clone]').forEach(clone => clone.remove());
		manualMove = undefined;
		cycle = 0;
		controls.hidden = originals.length < 2;
		playback.hidden = originals.length < 2 || carousel.dataset.autoplay !== 'true' || reducedMotion.matches;
		if (originals.length < 2) {
			refresh();
			return;
		}
		step = originals[0].getBoundingClientRect().width + (parseFloat(window.getComputedStyle(track).columnGap) || 0);
		cycle = step * originals.length;
		if (!cycle) return;
		// Keep a complete repeat before the originals and enough after them to fill the viewport.
		track.prepend(cloneGroup());
		const repeats = Math.ceil(track.clientWidth / cycle) + 1;
		for (let index = 0; index < repeats; index++) track.append(cloneGroup());
		position = cycle + phase * cycle;
		track.scrollLeft = position;
		refresh();
	};
	const move = direction => {
		if (!cycle) return;
		position = wrap(track.scrollLeft);
		if (reducedMotion.matches) {
			position = wrap(position + direction * step);
			track.scrollLeft = position;
		} else {
			manualMove = { from: position, distance: direction * step };
			refresh();
		}
	};
	previous.addEventListener('click', () => move(-1));
	next.addEventListener('click', () => move(1));
	playback.addEventListener('click', () => {
		paused = !paused;
		playback.setAttribute('aria-pressed', String(paused));
		playback.textContent = paused ? playback.dataset.resumeLabel : playback.dataset.pauseLabel;
		refresh();
	});
	carousel.addEventListener('pointerenter', event => {
		if (event.pointerType === 'touch') return;
		hovered = true;
		refresh();
	});
	carousel.addEventListener('pointerleave', () => { hovered = false; refresh(); });
	carousel.addEventListener('focusin', event => {
		focused = event.target.matches(':focus-visible');
		refresh();
	});
	carousel.addEventListener('focusout', event => {
		focused = carousel.contains(event.relatedTarget) && event.relatedTarget.matches(':focus-visible');
		refresh();
	});
	track.addEventListener('pointerdown', () => {
		window.clearTimeout(releaseTimer);
		touching = true;
		manualMove = undefined;
		refresh();
	});
	const release = () => {
		if (!touching) return;
		// Let touch scrolling settle before resuming automatic movement.
		releaseTimer = window.setTimeout(() => { touching = false; refresh(); }, 1500);
	};
	window.addEventListener('pointerup', release);
	window.addEventListener('pointercancel', release);
	track.addEventListener('scroll', () => {
		if (!cycle || manualMove || canRun()) return;
		position = wrap(track.scrollLeft);
		if (Math.abs(position - track.scrollLeft) > 1) track.scrollLeft = position;
	}, { passive: true });
	track.addEventListener('keydown', event => {
		if (event.target !== track) return;
		if (event.key === 'ArrowLeft' || event.key === 'ArrowRight') {
			event.preventDefault();
			move(event.key === 'ArrowLeft' ? -1 : 1);
		}
	});
	document.addEventListener('visibilitychange', refresh);
	reducedMotion.addEventListener('change', build);
	if ('IntersectionObserver' in window) new IntersectionObserver(entries => {
		visible = entries[0].isIntersecting;
		refresh();
	}, { threshold: 0.05 }).observe(carousel);
	if ('ResizeObserver' in window) new ResizeObserver(build).observe(track);
	else window.addEventListener('resize', build);
	build();
})();
