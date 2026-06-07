jQuery(document).ready(function ($) {

  if ($('#home-slider').length) {
    $('#home-slider').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: false,
      dots: false,
      infinite: true,
      speed: 500
    });
  }

  if ($('#rs-team-slider').length) {
    $('#rs-team-slider').slick({
      slidesToShow: 4,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      arrows: true,
      dots: false,
      infinite: true,
      speed: 500,
      prevArrow:
        '<div class="owl-prev"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="#000000" /></svg></div>',
      nextArrow:
        '<div class="owl-next"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z" fill="#000000" /></svg></div>',
      responsive: [
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
          }
        },

        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          }
        }

      ]
    });
  }

  if ($('#rs-team-slider-inside-faculty-page').length) {
    $('#rs-team-slider-inside-faculty-page').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      arrows: true,
      dots: false,
      infinite: true,
      speed: 500,
      prevArrow:
        '<div class="owl-prev"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="#000000" /></svg></div>',
      nextArrow:
        '<div class="owl-next"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z" fill="#000000" /></svg></div>',
      responsive: [
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
          }
        },

        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          }
        }

      ]
    });
  }

  if ($('.instrument_slider').length) {
    $('.instrument_slider').slick({
      slidesToShow: 3,
      slidesToScroll: 1,
      autoplay: false,
      autoplaySpeed: 3000,
      arrows: true,
      dots: false,
      infinite: true,
      speed: 500,
      prevArrow:
        '<div class="owl-prev"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M768 903.232l-50.432 56.768L256 512l461.568-448 50.432 56.768L364.928 512z" fill="#000000" /></svg></div>',
      nextArrow:
        '<div class="owl-next"><svg width="24px" height="24px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg"><path d="M256 120.768L306.432 64 768 512l-461.568 448L256 903.232 659.072 512z" fill="#000000" /></svg></div>',
      responsive: [
        {
          breakpoint: 980,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 1,
            arrows: false,
          }
        },

        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            arrows: false,
          }
        }

      ]
    });
  }

  if ($('.popup-youtube').length) {
    $('.popup-youtube').magnificPopup({
      type: 'iframe'
    });
  }

  if (document.querySelector('.rs-menu-toggle i')) {
    document.querySelector('.rs-menu-toggle i').addEventListener('click', function () {
      document.querySelector('.rs-menu').classList.toggle('active');
    });
  }

  if (document.querySelector('#fort_div')) {
    document.querySelector('#fort_div').addEventListener('click', function () {
      document.querySelector('.fort_sec').classList.add('active');
      document.querySelector('.morris_sec').classList.remove('active');
    });
  }

  if (document.querySelector('#morris_div')) {
    document.querySelector('#morris_div').addEventListener('click', function () {
      document.querySelector('.morris_sec').classList.add('active');
      document.querySelector('.fort_sec').classList.remove('active');
    });
  }

});
