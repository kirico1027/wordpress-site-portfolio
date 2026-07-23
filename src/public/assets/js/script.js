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

  function initRecruitIntroGallerySlider() {
    var gallery = document.querySelector(".recruit-intro__gallery");
    var slider = gallery && gallery.querySelector(".recruit-intro__gallery-slider");
    var list = slider && slider.querySelector(".recruit-intro__gallery-list");
    if (!gallery || !slider || !list || !list.children.length) return;

    var originals = Array.prototype.slice.call(list.children);
    originals.forEach(function (item) {
      var clone = item.cloneNode(true);
      clone.setAttribute("aria-hidden", "true");
      list.appendChild(clone);
    });

    if (prefersReducedMotion()) {
      gallery.classList.add("recruit-intro__gallery--static");
      return;
    }

    gallery.classList.add("recruit-intro__gallery--marquee");

    var offset = 0;
    var speed = 0.5;
    var halfWidth = 0;

    function measure() {
      halfWidth = list.scrollWidth / 2;
    }

    measure();
    window.addEventListener("resize", measure);

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
    var originalSlides = Array.prototype.slice.call(
      track.querySelectorAll(".blog-featured__slide")
    );
    var prevBtn = featured.querySelector(".blog-featured__nav-btn--prev");
    var nextBtn = featured.querySelector(".blog-featured__nav-btn--next");
    if (!viewport || !track || originalSlides.length === 0) return;

    var count = originalSlides.length;
    var index = count > 1 ? 1 : 0;
    var slides = originalSlides;
    var looping = count > 1;

    if (looping) {
      var fragBefore = document.createDocumentFragment();
      var fragAfter = document.createDocumentFragment();

      originalSlides.forEach(function (slide) {
        var before = slide.cloneNode(true);
        var after = slide.cloneNode(true);
        before.setAttribute("aria-hidden", "true");
        before.setAttribute("tabindex", "-1");
        after.setAttribute("aria-hidden", "true");
        after.setAttribute("tabindex", "-1");
        fragBefore.appendChild(before);
        fragAfter.appendChild(after);
      });

      track.insertBefore(fragBefore, track.firstChild);
      track.appendChild(fragAfter);
      slides = track.querySelectorAll(".blog-featured__slide");
      // 中央セット内の2枚目（Figma: 社員インタビューが中央）
      index = count + 1;
    }

    function setTransform(animate) {
      var slide = slides[index];
      if (!slide) return;

      if (!animate) {
        track.style.transition = "none";
      } else {
        track.style.transition = "";
      }

      var viewportWidth = viewport.offsetWidth;
      var slideWidth = slide.offsetWidth;
      var offset = slide.offsetLeft - (viewportWidth - slideWidth) / 2;
      track.style.transform = "translateX(" + -offset + "px)";

      if (!animate) {
        // スタイル再計算後に transition を戻す（ジャンプを見せない）
        void track.offsetWidth;
        track.style.transition = "";
      }
    }

    function normalizeIndex() {
      if (!looping) return;
      if (index >= count * 2) {
        index -= count;
        setTransform(false);
      } else if (index < count) {
        index += count;
        setTransform(false);
      }
    }

    function goTo(nextIndex) {
      index = nextIndex;
      if (!looping) {
        index = Math.max(0, Math.min(index, count - 1));
      }
      setTransform(true);
    }

    if (looping) {
      track.addEventListener("transitionend", function (event) {
        if (event.target !== track) return;
        if (event.propertyName && event.propertyName !== "transform") return;
        normalizeIndex();
      });
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

    window.addEventListener("resize", function () {
      setTransform(false);
    });
    setTransform(false);
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

    if (isServiceFollowupText(el)) {
      scheduleServiceFigureAfterText(el);
    }

    if (
      el.classList.contains("works__slider-wrap") ||
      el.classList.contains("works-single__pickup-grid")
    ) {
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
    var all = document.querySelectorAll(
      ".js-scroll-reveal:not(.js-company-collage-reveal):not(.js-about-collage-reveal)"
    );
    if (!all.length) return;
    enableScrollReveal();

    if (prefersReducedMotion()) {
      Array.prototype.forEach.call(all, function (el) {
        el.classList.add("is-inview", "is-revealed");
      });
      return;
    }

    var entryParts = [];
    // Service 図版は単独監視しない / ページ末 ENTRY CTA は別 rootMargin で監視
    var parts = Array.prototype.filter.call(all, function (el) {
      if (isServiceFollowupFigure(el)) return false;
      if (el.closest(".recruit-entry")) {
        entryParts.push(el);
        return false;
      }
      return true;
    });

    observeRevealTargets(parts, activateRevealEl);
    observeBottomRevealTargets(entryParts, activateRevealEl);
  }

  // ページ末要素: -10% rootMargin だと最下部で発火しないことがある
  function observeBottomRevealTargets(targets, activateFn) {
    if (!targets.length) return;

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
      { root: null, rootMargin: "0px 0px 0px 0px", threshold: 0.12 }
    );

    targets.forEach(function (el) {
      var rect = el.getBoundingClientRect();
      if (rect.top < window.innerHeight && rect.bottom > 0) {
        activateFn(el);
        return;
      }
      observer.observe(el);
    });
  }

  function isServiceFollowupFigure(el) {
    // 01/02/03 すべてのイラストは単独 IO せず、テキスト後（＋SP は画面内）で開始
    return !!(
      el.classList.contains("service-detail__figure") &&
      el.closest(".service-detail")
    );
  }

  function isServiceFollowupText(el) {
    var detail = el.closest(".service-detail");
    if (!detail || detail.classList.contains("service-detail--first")) return false;
    return (
      el.classList.contains("service-detail__num") ||
      el.classList.contains("service-detail__title") ||
      el.classList.contains("service-detail__body") ||
      el.classList.contains("btn-more--service")
    );
  }

  function startServiceFigureReveal(figure, delayMs) {
    if (!figure || figure.classList.contains("is-inview")) return;

    var isSp = window.matchMedia("(max-width: 768px)").matches;
    enableScrollReveal();

    function startFigure() {
      activateRevealEl(figure);
    }

    if (isSp) {
      observeCollageTrigger(figure, function () {
        window.setTimeout(startFigure, 120);
      });
      return;
    }

    window.setTimeout(startFigure, delayMs);
  }

  function scheduleServiceFigureAfterText(fromEl) {
    // 番号だけでは始めず、タイトルか本文が出てから画像へ（テキスト先行を明確に）
    if (
      !fromEl.classList.contains("service-detail__title") &&
      !fromEl.classList.contains("service-detail__body")
    ) {
      return;
    }

    var layout = fromEl.closest(".service-detail__layout");
    if (!layout) return;
    var figure = layout.querySelector(".service-detail__figure.js-scroll-reveal");
    if (
      !figure ||
      figure.classList.contains("is-inview") ||
      figure.getAttribute("data-reveal-scheduled")
    ) {
      return;
    }

    figure.setAttribute("data-reveal-scheduled", "1");

    var delay = layout.classList.contains("service-detail__layout--reverse")
      ? 450
      : 320;
    startServiceFigureReveal(figure, delay);
  }

  function scheduleFirstServiceFigure(first) {
    if (!first) return;
    var figure = first.querySelector(".service-detail__figure.js-scroll-reveal");
    if (
      !figure ||
      figure.classList.contains("is-inview") ||
      figure.getAttribute("data-reveal-scheduled")
    ) {
      return;
    }
    figure.setAttribute("data-reveal-scheduled", "1");
    startServiceFigureReveal(figure, 400);
  }

  function isCollageInView(el) {
    if (!el) return false;
    var rect = el.getBoundingClientRect();
    var vh = window.innerHeight || document.documentElement.clientHeight;
    // SP 縦積み後: コラージュ上端が画面内に入ったら発火（下端 8%〜上端 92%）
    return rect.top < vh * 0.92 && rect.bottom > vh * 0.08;
  }

  // コラージュ用: IO + SP は scroll フォールバック（レイアウト縦積み後の位置を確実に拾う）
  function observeCollageTrigger(trigger, onEnter) {
    if (!trigger) {
      onEnter();
      return;
    }

    var done = false;
    var observer = null;
    var isSp = window.matchMedia("(max-width: 768px)").matches;

    function enter() {
      if (done) return;
      done = true;
      if (observer) observer.disconnect();
      window.removeEventListener("scroll", onScrollOrResize, true);
      window.removeEventListener("resize", onScrollOrResize);
      onEnter();
    }

    function onScrollOrResize() {
      if (isCollageInView(trigger)) enter();
    }

    if (prefersReducedMotion() || !("IntersectionObserver" in window)) {
      enter();
      return;
    }

    observer = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (entry) {
          if (!entry.isIntersecting) return;
          enter();
        });
      },
      {
        root: null,
        // % rootMargin はモバイルで不安定なことがあるため px 指定
        rootMargin: "0px 0px -64px 0px",
        threshold: [0, 0.01, 0.15],
      }
    );
    observer.observe(trigger);

    if (isSp) {
      window.addEventListener("scroll", onScrollOrResize, true);
      window.addEventListener("resize", onScrollOrResize);
      onScrollOrResize();
      return;
    }

    if (isElementInViewport(trigger, 0.1) || isCollageInView(trigger)) {
      enter();
    }
  }

  // About: コラージュ枠が入ったらパーツを順に組み立て
  function initAboutCollageReveal() {
    var trigger =
      document.querySelector(".about__visual-scaler") ||
      document.querySelector(".about__visual");
    var parts = document.querySelectorAll(".js-about-collage-reveal");
    if (!trigger || !parts.length) return;

    enableScrollReveal();

    observeCollageTrigger(trigger, function () {
      if (prefersReducedMotion()) {
        Array.prototype.forEach.call(parts, function (el) {
          el.classList.add("is-inview", "is-revealed");
        });
        return;
      }

      Array.prototype.forEach.call(parts, function (el, index) {
        window.setTimeout(function () {
          activateRevealEl(el);
        }, 200 + index * 80);
      });
    });
  }

  // Company: コラージュ自身が画面に入ったら、テキスト先行の間を置いて組み立てる
  function initCompanyCollageReveal() {
    var trigger =
      document.querySelector(".company__visual-scaler") ||
      document.querySelector(".company__visual");
    var parts = document.querySelectorAll(".js-company-collage-reveal");
    if (!trigger || !parts.length) return;

    enableScrollReveal();

    observeCollageTrigger(trigger, function () {
      if (prefersReducedMotion()) {
        Array.prototype.forEach.call(parts, function (el) {
          el.classList.add("is-inview", "is-revealed");
        });
        return;
      }

      Array.prototype.forEach.call(parts, function (el, index) {
        window.setTimeout(function () {
          activateRevealEl(el);
        }, 200 + index * 80);
      });
    });
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

      var visual =
        section.querySelector(".about-purpose__visual-scaler") ||
        section.querySelector(".about-purpose__visual") ||
        section;

      observeCollageTrigger(visual, function () {
        pieces.forEach(function (piece, index) {
          window.setTimeout(function () {
            activatePiece(piece);
          }, index * 80);
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

  // Service: ページ入場（intro → 01 テキスト）+ 01 イラストは別途画面内で
  function initServiceOpeningReveal() {
    var intro = document.querySelector(".service-intro");
    var first = document.querySelector(".service-detail--first");
    if (!intro && !first) return;

    enableScrollReveal();

    function start() {
      if (intro && intro.classList.contains("is-ready")) return;
      if (!intro && first && first.classList.contains("is-ready")) return;

      if (prefersReducedMotion()) {
        if (intro) intro.classList.add("is-ready");
        if (first) {
          first.classList.add("is-ready");
          var reducedFigure = first.querySelector(
            ".service-detail__figure.js-scroll-reveal"
          );
          if (reducedFigure) {
            reducedFigure.classList.add("is-inview", "is-revealed");
          }
        }
        return;
      }

      if (intro) intro.classList.add("is-ready");
      if (first) {
        first.classList.add("is-ready");
        scheduleFirstServiceFigure(first);
      }
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
      { root: null, rootMargin: "0px 0px -64px 0px", threshold: 0 }
    );
    observer.observe(trigger);
  }

  function primeServiceOpeningIfVisible() {
    var intro = document.querySelector(".service-intro");
    var first = document.querySelector(".service-detail--first");
    if (intro) intro.classList.add("is-ready");
    if (first) {
      first.classList.add("is-ready");
      var figure = first.querySelector(".service-detail__figure.js-scroll-reveal");
      if (figure) figure.classList.add("is-inview", "is-revealed");
    }
  }

  // Works archive: 入場はフィルター＋画面内カード、以降は scroll-reveal
  function prepareWorksArchiveCards() {
    var archive = document.querySelector(".works-archive-page .works-archive");
    if (!archive || archive.getAttribute("data-reveal-prepared")) return;

    var grid = archive.querySelector(".works-archive__grid");
    var moreWrap = archive.querySelector(".works-archive__more-wrap");
    if (!grid) return;

    archive.setAttribute("data-reveal-prepared", "1");

    var cards = grid.querySelectorAll(".works-card");
    var isSp = window.matchMedia("(max-width: 768px)").matches;
    var openingIndex = 0;
    var openingCardBaseDelay = 300;

    Array.prototype.forEach.call(cards, function (card, index) {
      var isOpening = isSp ? index === 0 : isElementInViewport(card, 0.1);

      if (isOpening) {
        card.classList.add("is-opening");
        card.style.animationDelay =
          openingCardBaseDelay + openingIndex * 70 + "ms";
        openingIndex += 1;
        return;
      }

      card.classList.add("js-scroll-reveal");
    });

    if (moreWrap) {
      moreWrap.classList.add("js-scroll-reveal");
    }
  }

  function initWorksArchiveOpeningReveal() {
    var archive = document.querySelector(".works-archive-page .works-archive");
    if (!archive) return;

    function start() {
      if (archive.classList.contains("is-ready")) return;
      archive.classList.add("is-ready");

      if (prefersReducedMotion()) {
        Array.prototype.forEach.call(
          archive.querySelectorAll(".works-card.is-opening"),
          function (card) {
            card.classList.add("is-revealed");
          }
        );
        return;
      }

      Array.prototype.forEach.call(
        archive.querySelectorAll(".works-card.is-opening"),
        function (card) {
          markRevealedOnAnimationEnd(card);
        }
      );
    }

    if (prefersReducedMotion()) {
      start();
      return;
    }

    window.setTimeout(start, 550);
  }

  function primeWorksArchiveOpeningIfVisible() {
    var archive = document.querySelector(".works-archive-page .works-archive");
    if (!archive) return;
    archive.classList.add("is-ready");
    Array.prototype.forEach.call(
      archive.querySelectorAll(".works-card.is-opening"),
      function (card) {
        card.classList.add("is-revealed");
      }
    );
  }

  function initWorksArchiveStickyFilters() {
    var page = document.querySelector(".works-archive-page");
    var header = document.querySelector(".top-header");
    if (!page || !header) return;

    var gap = 8;

    function updateTop() {
      var top = Math.ceil(header.getBoundingClientRect().bottom + gap);
      document.documentElement.style.setProperty(
        "--works-archive-filters-top",
        top + "px"
      );
    }

    updateTop();
    window.addEventListener("resize", updateTop);
    window.addEventListener("load", updateTop);
  }

  function initWorksSingleOpeningReveal() {
    var page = document.querySelector(".works-single-page");
    if (!page) return;

    function start() {
      if (page.classList.contains("is-ready")) return;
      page.classList.add("is-ready");
    }

    if (prefersReducedMotion()) {
      start();
      return;
    }

    window.setTimeout(start, 0);
  }

  function primeWorksSingleOpeningIfVisible() {
    var page = document.querySelector(".works-single-page");
    if (page) page.classList.add("is-ready");
  }

  function prepareWorksSingleScrollReveal() {
    var page = document.querySelector(".works-single-page");
    if (!page || page.getAttribute("data-scroll-reveal-prepared")) return;

    page.setAttribute("data-scroll-reveal-prepared", "1");

    var selectors = [
      ".works-single__body .works-single__heading",
      ".works-single__body .works-single__question",
      ".works-single__body .works-single__figure",
      ".works-single__share",
      ".works-single__back",
    ];

    selectors.forEach(function (selector) {
      page.querySelectorAll(selector).forEach(function (el) {
        el.classList.add("js-scroll-reveal");
      });
    });

    var pickupGrid = page.querySelector(".works-single__pickup-grid");
    if (pickupGrid) {
      var isSp = window.matchMedia("(max-width: 768px)").matches;

      if (isSp) {
        page.querySelectorAll(".works-single__pickup-grid .works-card").forEach(function (el) {
          el.classList.add("js-scroll-reveal");
        });
      } else {
        pickupGrid.classList.add("js-scroll-reveal");
      }
    }
  }

  function initRecruitIntroOpeningReveal() {
    var intro = document.querySelector(".recruit-intro");
    if (!intro) return;

    function start() {
      if (intro.classList.contains("is-ready")) return;
      intro.classList.add("is-ready");
    }

    if (prefersReducedMotion()) {
      start();
      return;
    }

    window.setTimeout(start, 550);
  }

  function primeRecruitIntroOpeningIfVisible() {
    var intro = document.querySelector(".recruit-intro");
    if (intro) intro.classList.add("is-ready");
  }

  function initJobCardAccordion() {
    var cards = document.querySelectorAll("details.job-card");
    if (!cards.length) return;

    cards.forEach(function (details) {
      var summary = details.querySelector(".job-card__summary");
      var collapse = details.querySelector(".job-card__collapse");
      if (!summary || !collapse) return;

      details.classList.add("job-card--animated");

      if (prefersReducedMotion()) {
        if (details.open) details.classList.add("is-expanded");
        return;
      }

      if (details.open) {
        details.classList.add("is-expanded");
      } else {
        collapse.style.height = "0px";
      }

      summary.addEventListener("click", function (event) {
        event.preventDefault();
        if (details.getAttribute("data-animating") === "true") return;

        if (details.classList.contains("is-expanded")) {
          animateJobCardClose(details, collapse);
        } else {
          animateJobCardOpen(details, collapse);
        }
      });
    });
  }

  function animateJobCardOpen(details, collapse) {
    details.setAttribute("data-animating", "true");
    details.open = true;
    details.classList.add("is-expanded");

    collapse.style.height = "0px";
    collapse.style.overflow = "hidden";

    var endHeight = collapse.scrollHeight;

    if (typeof collapse.animate === "function") {
      var openAnim = collapse.animate(
        [{ height: "0px" }, { height: endHeight + "px" }],
        { duration: 300, easing: "ease-in-out", fill: "forwards" }
      );

      openAnim.onfinish = function () {
        if (typeof openAnim.commitStyles === "function") {
          openAnim.commitStyles();
        }
        openAnim.cancel();
        collapse.style.height = "auto";
        collapse.style.overflow = "";
        details.removeAttribute("data-animating");
      };
      return;
    }

    collapse.style.transition = "height 300ms ease-in-out";
    collapse.offsetHeight;
    collapse.style.height = endHeight + "px";
    window.setTimeout(function () {
      collapse.style.transition = "";
      collapse.style.height = "auto";
      collapse.style.overflow = "";
      details.removeAttribute("data-animating");
    }, 300);
  }

  function animateJobCardClose(details, collapse) {
    details.setAttribute("data-animating", "true");
    details.classList.remove("is-expanded");

    var startHeight = collapse.scrollHeight;
    collapse.style.overflow = "hidden";
    collapse.style.height = startHeight + "px";

    function finishClose() {
      details.open = false;
      collapse.style.height = "0px";
      collapse.style.overflow = "hidden";
      collapse.style.transition = "";
      details.removeAttribute("data-animating");
    }

    if (typeof collapse.animate === "function") {
      // レイアウト確定後に 0 へ（同じフレームでの二重指定を避ける）
      requestAnimationFrame(function () {
        var closeAnim = collapse.animate(
          [{ height: startHeight + "px" }, { height: "0px" }],
          { duration: 380, easing: "ease-in-out", fill: "forwards" }
        );

        closeAnim.onfinish = function () {
          if (typeof closeAnim.commitStyles === "function") {
            closeAnim.commitStyles();
          }
          closeAnim.cancel();
          finishClose();
        };
      });
      return;
    }

    collapse.offsetHeight;
    collapse.style.transition = "height 380ms ease-in-out";
    collapse.style.height = "0px";
    window.setTimeout(finishClose, 380);
  }

  document.addEventListener("DOMContentLoaded", function () {
    initHeaderDrawer();
    initWorksSlider();
    initAboutGallerySlider();
    initRecruitIntroGallerySlider();
    initBlogFeaturedSlider();
    initSectionHeadingScrollReveal();
    prepareWorksArchiveCards();
    prepareWorksSingleScrollReveal();
    initScrollReveal();
    initAboutCollageReveal();
    initCompanyCollageReveal();
    initAboutPurposeReveal();
    initServiceOpeningReveal();
    initWorksArchiveOpeningReveal();
    initWorksArchiveStickyFilters();
    initWorksSingleOpeningReveal();
    initRecruitIntroOpeningReveal();
    initJobCardAccordion();
  });

  window.addEventListener("pageshow", function (event) {
    if (!event.persisted) return;
    primeSectionHeadingRevealIfVisible();
    primeScrollRevealIfVisible();
    primeAboutPurposeIfVisible();
    primeServiceOpeningIfVisible();
    primeWorksArchiveOpeningIfVisible();
    primeWorksSingleOpeningIfVisible();
    primeRecruitIntroOpeningIfVisible();
  });
})();
