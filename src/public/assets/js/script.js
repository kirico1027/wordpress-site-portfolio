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

  function initWorksSlider() {
    var slider = document.querySelector(".works__slider");
    if (!slider) return;

    var isDragging = false;
    var startX = 0;
    var scrollLeft = 0;

    slider.addEventListener("mousedown", function (event) {
      isDragging = true;
      startX = event.pageX - slider.offsetLeft;
      scrollLeft = slider.scrollLeft;
      slider.style.cursor = "grabbing";
    });

    slider.addEventListener("mouseleave", function () {
      isDragging = false;
      slider.style.cursor = "";
    });

    slider.addEventListener("mouseup", function () {
      isDragging = false;
      slider.style.cursor = "";
    });

    slider.addEventListener("mousemove", function (event) {
      if (!isDragging) return;
      event.preventDefault();
      var x = event.pageX - slider.offsetLeft;
      var walk = (x - startX) * 1.2;
      slider.scrollLeft = scrollLeft - walk;
    });
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

  document.addEventListener("DOMContentLoaded", function () {
    initHeaderDrawer();
    initWorksSlider();
    initBlogFeaturedSlider();
    initSectionHeadingScrollReveal();
    initScrollReveal();
    initCompanyCollageReveal();
  });

  window.addEventListener("pageshow", function (event) {
    if (!event.persisted) return;
    primeSectionHeadingRevealIfVisible();
    primeScrollRevealIfVisible();
  });
})();
