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

  document.addEventListener("DOMContentLoaded", function () {
    initHeaderDrawer();
    initWorksSlider();
  });
})();
