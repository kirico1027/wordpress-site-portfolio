"use strict";

(function () {
  var HEADER_OPEN_CLASS = "top-header--menu-open";

  function initHeaderDrawer() {
    var header = document.querySelector(".top-header");
    if (!header) return;

    var toggle = header.querySelector(".top-header__menu-toggle");
    var backdrop = header.querySelector(".top-header__backdrop");
    var drawerClose = header.querySelector(".top-header__drawer-close");
    var navLinks = header.querySelectorAll(".top-header__nav-link");

    function setOpen(open) {
      header.classList.toggle(HEADER_OPEN_CLASS, open);
      if (toggle) {
        toggle.setAttribute("aria-expanded", open ? "true" : "false");
        toggle.setAttribute("aria-label", open ? "メニューを閉じる" : "メニューを開く");
      }
      document.body.style.overflow = open ? "hidden" : "";
    }

    function closeMenu() {
      setOpen(false);
    }

    if (toggle) {
      toggle.addEventListener("click", function () {
        setOpen(!header.classList.contains(HEADER_OPEN_CLASS));
      });
    }

    if (backdrop) {
      backdrop.addEventListener("click", closeMenu);
    }

    if (drawerClose) {
      drawerClose.addEventListener("click", closeMenu);
    }

    navLinks.forEach(function (link) {
      link.addEventListener("click", closeMenu);
    });

    document.addEventListener("keydown", function (event) {
      if (event.key === "Escape") {
        closeMenu();
      }
    });
  }

  function initDragScrollSlider(slider, options) {
    if (!slider) return null;

    var opts = options || {};
    var isDragging = false;
    var startX = 0;
    var scrollLeft = 0;
    var hasMoved = false;
    var activePointerId = null;
    var state = { dragging: false };

    function getPageX(event) {
      if (typeof event.clientX === "number") return event.clientX;
      return 0;
    }

    function onPointerDown(event) {
      if (event.pointerType === "touch") return;

      isDragging = true;
      state.dragging = true;
      hasMoved = false;
      activePointerId = event.pointerId;
      startX = getPageX(event);
      scrollLeft = slider.scrollLeft;
      slider.classList.add("is-dragging");
      if (typeof opts.onDragStart === "function") opts.onDragStart();

      if (slider.setPointerCapture) {
        try {
          slider.setPointerCapture(event.pointerId);
        } catch (error) {
          // ignore
        }
      }
    }

    function onPointerMove(event) {
      if (!isDragging) return;
      if (activePointerId !== null && event.pointerId !== activePointerId) return;

      event.preventDefault();
      var x = getPageX(event);
      var walk = (x - startX) * 1.2;
      if (Math.abs(walk) > 3) hasMoved = true;
      slider.scrollLeft = scrollLeft - walk;
    }

    function onPointerUp(event) {
      if (!isDragging) return;
      if (activePointerId !== null && event.pointerId !== activePointerId) return;

      isDragging = false;
      state.dragging = false;
      activePointerId = null;
      slider.classList.remove("is-dragging");
      if (typeof opts.onDragEnd === "function") opts.onDragEnd();

      if (slider.releasePointerCapture && event.pointerId != null) {
        try {
          slider.releasePointerCapture(event.pointerId);
        } catch (error) {
          // ignore
        }
      }
    }

    slider.addEventListener("pointerdown", onPointerDown);
    slider.addEventListener("pointermove", onPointerMove);
    slider.addEventListener("pointerup", onPointerUp);
    slider.addEventListener("pointercancel", onPointerUp);
    slider.addEventListener("lostpointercapture", onPointerUp);

    slider.addEventListener(
      "click",
      function (event) {
        if (!hasMoved) return;
        event.preventDefault();
        event.stopPropagation();
        hasMoved = false;
      },
      true
    );

    return state;
  }

  function initWorksSlider() {
    initDragScrollSlider(document.querySelector(".works__slider"));
  }

  function initAboutGallerySlider() {
    var gallery = document.querySelector(".about-gallery");
    var slider = gallery && gallery.querySelector(".about-gallery__slider");
    var list = slider && slider.querySelector(".about-gallery__list");
    if (!gallery || !slider || !list || !list.children.length) return;

    // シームレスループ用にアイテムを複製（枚数不足ではなく、途切れなく流すため）
    var originals = Array.prototype.slice.call(list.children);
    originals.forEach(function (item) {
      var clone = item.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      list.appendChild(clone);
    });

    if (prefersReducedMotion()) {
      gallery.classList.add("about-gallery--static");
      return;
    }

    gallery.classList.add("about-gallery--marquee");

    var offset = 0;
    var speed = 0.5;
    var halfWidth = 0;

    function measure() {
      halfWidth = list.scrollWidth / 2;
    }

    measure();
    window.addEventListener("resize", measure);

    // 画像読み込み後に幅が変わる場合に備える
    list.querySelectorAll("img").forEach(function (img) {
      if (img.complete) return;
      img.addEventListener("load", measure);
    });

    function tick() {
      if (halfWidth > 0) {
        offset += speed;
        if (offset >= halfWidth) offset -= halfWidth;
        list.style.transform = "translate3d(" + -offset + "px, 0, 0)";
      } else {
        measure();
      }
      window.requestAnimationFrame(tick);
    }

    window.requestAnimationFrame(tick);
  }

  function initBlogFeaturedSlider() {
    var featured = document.querySelector(".blog-featured");
    if (!featured) return;

    var viewport = featured.querySelector(".blog-featured__viewport");
    var track = featured.querySelector(".blog-featured__track");
    var slides = featured.querySelectorAll(".blog-featured__slide");
    var prevBtn = featured.querySelector(".blog-featured__nav-btn--prev");
    var nextBtn = featured.querySelector(".blog-featured__nav-btn--next");
    if (!viewport || !track || slides.length === 0) return;

    // Figma 初期表示: 中央が「社員インタビュー」、左右に「お役立ち情報」が覗く
    var index = slides.length > 1 ? 1 : 0;

    function update() {
      var slide = slides[index];
      var viewportWidth = viewport.offsetWidth;
      var slideWidth = slide.offsetWidth;
      var offset = slide.offsetLeft - (viewportWidth - slideWidth) / 2;
      track.style.transform = "translateX(" + -offset + "px)";
    }

    function goTo(nextIndex) {
      index = (nextIndex + slides.length) % slides.length;
      update();
    }

    if (prevBtn) {
      prevBtn.addEventListener("click", function () {
        goTo(index - 1);
      });
    }

    if (nextBtn) {
      nextBtn.addEventListener("click", function () {
        goTo(index + 1);
      });
    }

    window.addEventListener("resize", update);
    update();
  }

  function prefersReducedMotion() {
    return window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  }

  function isElementInViewport(el, bottomOffsetRatio) {
    var ratio = typeof bottomOffsetRatio === "number" ? bottomOffsetRatio : 0.2;
    var rect = el.getBoundingClientRect();
    var triggerLine = window.innerHeight * (1 - ratio);
    return rect.top < triggerLine && rect.bottom > 0;
  }

  function markRevealedOnAnimationEnd(el) {
    function onEnd(event) {
      if (event.target !== el) return;
      el.classList.add("is-revealed");
      el.removeEventListener("animationend", onEnd);
    }
    el.addEventListener("animationend", onEnd);
  }

  function markHeadingRevealedOnLastChild(heading) {
    var title = heading.querySelector(".section-heading__title");
    var target = title || heading;

    function onEnd(event) {
      if (event.target !== target) return;
      heading.classList.add("is-revealed");
      target.removeEventListener("animationend", onEnd);
    }

    target.addEventListener("animationend", onEnd);
  }

  function activateRevealEl(el) {
    if (el.classList.contains("is-inview")) return;
    el.classList.add("is-inview");

    if (el.classList.contains("works__slider-wrap")) {
      var cards = el.querySelectorAll(".works-card");
      var last = cards.length ? cards[cards.length - 1] : el;

      function onEnd(event) {
        if (event.target !== last) return;
        el.classList.add("is-revealed");
        last.removeEventListener("animationend", onEnd);
      }

      last.addEventListener("animationend", onEnd);
      return;
    }

    if (el.classList.contains("about-panel")) {
      var body = el.querySelector(".about-panel__body");
      var panelTarget = body || el;

      function onPanelEnd(event) {
        if (event.target !== panelTarget) return;
        el.classList.add("is-revealed");
        panelTarget.removeEventListener("animationend", onPanelEnd);
      }

      panelTarget.addEventListener("animationend", onPanelEnd);
      return;
    }

    if (el.classList.contains("about-value__head")) {
      var valueTitle = el.querySelector(".about-value__title");
      var valueHeadTarget = valueTitle || el;

      function onValueHeadEnd(event) {
        if (event.target !== valueHeadTarget) return;
        el.classList.add("is-revealed");
        valueHeadTarget.removeEventListener("animationend", onValueHeadEnd);
      }

      valueHeadTarget.addEventListener("animationend", onValueHeadEnd);
      return;
    }

    if (el.classList.contains("service-effects__heading")) {
      function onEffectsHeadEnd(event) {
        if (event.animationName !== "service-line-grow") return;
        el.classList.add("is-revealed");
        el.removeEventListener("animationend", onEffectsHeadEnd);
      }

      el.addEventListener("animationend", onEffectsHeadEnd);
      return;
    }

    markRevealedOnAnimationEnd(el);
  }

  function activateHeadingReveal(heading) {
    if (heading.classList.contains("is-inview")) return;
    heading.classList.add("is-inview");
    markHeadingRevealedOnLastChild(heading);
  }

  function observeRevealTargets(targets, activateFn) {
    if (!targets.length) return;

    if (prefersReducedMotion()) {
      targets.forEach(function (el) {
        el.classList.add("is-inview", "is-revealed");
      });
      return;
    }

    if (!("IntersectionObserver" in window)) {
      targets.forEach(activateFn);
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          activateFn(entry.target);
          observer.unobserve(entry.target);
        });
      },
      { root: null, rootMargin: "0px 0px -10% 0px", threshold: 0 }
    );

    targets.forEach(function (el) {
      if (isElementInViewport(el, 0.1)) {
        activateFn(el);
        return;
      }
      observer.observe(el);
    });
  }

  function enableScrollReveal() {
    document.documentElement.classList.add("scroll-reveal-active");
  }

  function primeSectionHeadingRevealIfVisible() {
    document.querySelectorAll(".js-section-heading-reveal").forEach(function (el) {
      el.classList.add("is-inview", "is-revealed");
    });
  }

  function primeScrollRevealIfVisible() {
    document.querySelectorAll(".js-scroll-reveal").forEach(function (el) {
      el.classList.add("is-inview", "is-revealed");
    });
  }

  function initSectionHeadingScrollReveal() {
    var headings = document.querySelectorAll(".js-section-heading-reveal");
    if (!headings.length) return;
    enableScrollReveal();
    observeRevealTargets(Array.prototype.slice.call(headings), activateHeadingReveal);
  }

  function initScrollReveal() {
    var parts = document.querySelectorAll(
      ".js-scroll-reveal:not(.js-company-collage-reveal)"
    );
    if (!parts.length) return;
    enableScrollReveal();
    observeRevealTargets(Array.prototype.slice.call(parts), activateRevealEl);
  }

  // Company: コラージュ自身が画面に入ったら、テキスト先行の間を置いて組み立てる
  function initCompanyCollageReveal() {
    var trigger = document.querySelector(".company__visual");
    var parts = document.querySelectorAll(".js-company-collage-reveal");
    if (!trigger || !parts.length) return;

    enableScrollReveal();

    var started = false;
    function startCollage() {
      if (started) return;
      started = true;

      if (prefersReducedMotion()) {
        Array.prototype.forEach.call(parts, function (el) {
          el.classList.add("is-inview", "is-revealed");
        });
        return;
      }

      Array.prototype.forEach.call(parts, function (el, index) {
        window.setTimeout(function () {
          activateRevealEl(el);
        }, 320 + index * 70);
      });
    }

    if (prefersReducedMotion() || !("IntersectionObserver" in window)) {
      startCollage();
      return;
    }

    if (isElementInViewport(trigger, 0.1)) {
      startCollage();
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          observer.disconnect();
          startCollage();
        });
      },
      { root: null, rootMargin: "0px 0px -10% 0px", threshold: 0 }
    );
    observer.observe(trigger);
  }

  // About Purpose: テキストは content、コラージュは SP でパーツ個別
  function initAboutPurposeReveal() {
    var section = document.querySelector(".about-purpose");
    if (!section) return;

    var content = section.querySelector(".about-purpose__content");
    var pieces = [
      section.querySelector(".about-purpose__accent"),
      section.querySelector(".about-purpose__carousel"),
      section.querySelector(".about-purpose__shape--peach"),
      section.querySelector(".about-purpose__shape--green"),
    ].filter(Boolean);
    var CAROUSEL_READY_MS_PC = 2000;
    var mqSp = window.matchMedia("(max-width: 768px)");

    function revealPiecesImmediate() {
      pieces.forEach(function (piece) {
        piece.classList.add("is-inview", "is-revealed");
      });
    }

    function revealAllImmediate() {
      section.classList.add(
        "is-ready",
        "is-visual-ready",
        "about-purpose--carousel-ready"
      );
      revealPiecesImmediate();
    }

    function startText() {
      if (section.classList.contains("is-ready")) return;
      if (prefersReducedMotion()) {
        revealAllImmediate();
        return;
      }
      section.classList.add("is-ready");
    }

    function startVisual(carouselMs) {
      if (section.classList.contains("is-visual-ready")) return;
      if (prefersReducedMotion()) {
        revealAllImmediate();
        return;
      }
      section.classList.add("is-visual-ready");
      window.setTimeout(function () {
        section.classList.add("about-purpose--carousel-ready");
      }, carouselMs);
    }

    function activatePiece(piece) {
      if (piece.classList.contains("is-inview")) return;
      piece.classList.add("is-inview");

      function onEnd(event) {
        if (event.target !== piece) return;
        piece.classList.add("is-revealed");
        piece.removeEventListener("animationend", onEnd);

        if (piece.classList.contains("about-purpose__carousel")) {
          section.classList.add("about-purpose--carousel-ready");
        }
      }

      piece.addEventListener("animationend", onEnd);
    }

    function observeOnce(el, onEnter) {
      if (!el) {
        onEnter();
        return;
      }

      if (!("IntersectionObserver" in window)) {
        onEnter();
        return;
      }

      if (isElementInViewport(el, 0.1)) {
        onEnter();
        return;
      }

      var observer = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (!entry.isIntersecting) return;
            observer.disconnect();
            onEnter();
          });
        },
        { root: null, rootMargin: "0px 0px -10% 0px", threshold: 0 }
      );
      observer.observe(el);
    }

    if (mqSp.matches) {
      observeOnce(content || section, startText);

      if (prefersReducedMotion()) {
        revealAllImmediate();
        return;
      }

      if (!pieces.length) {
        section.classList.add("about-purpose--carousel-ready");
        return;
      }

      pieces.forEach(function (piece) {
        observeOnce(piece, function () {
          activatePiece(piece);
        });
      });
      return;
    }

    observeOnce(section, function () {
      startText();
      startVisual(CAROUSEL_READY_MS_PC);
    });
  }

  function primeAboutPurposeIfVisible() {
    var section = document.querySelector(".about-purpose");
    if (!section) return;
    section.classList.add(
      "is-ready",
      "is-visual-ready",
      "about-purpose--carousel-ready"
    );
    [
      ".about-purpose__accent",
      ".about-purpose__carousel",
      ".about-purpose__shape--peach",
      ".about-purpose__shape--green",
    ].forEach(function (selector) {
      var piece = section.querySelector(selector);
      if (piece) piece.classList.add("is-inview", "is-revealed");
    });
  }

  // Service: ページ入場（intro → 01）
  function initServiceOpeningReveal() {
    var intro = document.querySelector(".service-intro");
    var first = document.querySelector(".service-detail--first");
    if (!intro && !first) return;

    function start() {
      if (intro && intro.classList.contains("is-ready")) return;
      if (!intro && first && first.classList.contains("is-ready")) return;

      if (prefersReducedMotion()) {
        if (intro) intro.classList.add("is-ready");
        if (first) first.classList.add("is-ready");
        return;
      }

      if (intro) intro.classList.add("is-ready");
      if (first) first.classList.add("is-ready");
    }

    var trigger = intro || first;

    if (!("IntersectionObserver" in window)) {
      start();
      return;
    }

    if (isElementInViewport(trigger, 0.1)) {
      start();
      return;
    }

    var observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          observer.disconnect();
          start();
        });
      },
      { root: null, rootMargin: "0px 0px -10% 0px", threshold: 0 }
    );
    observer.observe(trigger);
  }

  function primeServiceOpeningIfVisible() {
    var intro = document.querySelector(".service-intro");
    var first = document.querySelector(".service-detail--first");
    if (intro) intro.classList.add("is-ready");
    if (first) first.classList.add("is-ready");
  }

  document.addEventListener("DOMContentLoaded", function () {
    initHeaderDrawer();
    initWorksSlider();
    initAboutGallerySlider();
    initBlogFeaturedSlider();
    initSectionHeadingScrollReveal();
    initScrollReveal();
    initCompanyCollageReveal();
    initAboutPurposeReveal();
    initServiceOpeningReveal();
  });

  window.addEventListener("pageshow", function (event) {
    if (!event.persisted) return;
    primeSectionHeadingRevealIfVisible();
    primeScrollRevealIfVisible();
    primeAboutPurposeIfVisible();
    primeServiceOpeningIfVisible();
  });
})();
