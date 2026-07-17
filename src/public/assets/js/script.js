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

  document.addEventListener("DOMContentLoaded", function () {
    initHeaderDrawer();
    initWorksSlider();
    initBlogFeaturedSlider();
  });
})();
