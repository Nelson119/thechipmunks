/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */

(function($) {
  var siteUrl = $('.mobile-home nav .home').attr('href');
  function push(target){

    var state = {
        title: document.title,
        url: siteUrl + '/' + target
    };
    window.history.pushState(state, document.title, siteUrl + '/term');
  }
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        $('.slick li').width($('.mobile-home').width());
        $('.slick li').height($(window).height() - $('.mobile-home >nav').css('margin-top').replace(/px/,'') - $('.mobile-home >nav').css('padding-top').replace(/px/,''));

        $('.slick').slick({
          // dots: true,
          infinite: true,
          slidesToShow: 1,
          slidesToSlide: 1,
          // variableWidth: true,
          // centerMode: true,
          pauseOnHover: true,
          draggable: false,
          speed: 350,
          cssEase: 'ease-in-out',
          fade: true
        });
        var current = $('body').attr('data-current-slick') || 'home';
        $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .' + current).index() );
        $(window).resize(function(){
          $('.slick li').width($('.slick-list').width());
          $('.slick li').height($(window).height() - $('.mobile-home >nav').css('margin-top').replace(/px/,'') - $('.mobile-home >nav').css('padding-top').replace(/px/,''));
        }).trigger('resize');

        //活動辦法
        $('.mobile-home nav .term').on('click', function(){
          $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .term').index() );
          push('term');
        });
        //回首頁
        $('.mobile-home nav .home').on('click', function(){
          $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .home').index() );
          push('');
          return false;
        });
        //我要當明星
        $('.mobile-home .slick-track .home .star').on('click', function(){
          $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .pick').index() );
          push('pick');
        });
        //角色選擇
        $('.mobile-home .slick-track .pick a').on('click', function(){
          $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .download-app-tutorial').index() );
          push('download-app-tutorial');
        });
        //我已經錄好，下一步
        $('.mobile-home .slick-track .download-app-tutorial .goto-upload').on('click', function(){
          $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .upload').index() );
          push('upload');
        });


        //選擇影片
        // $('.mobile-home .slick-track .upload .pickvideo').on('click', function(){
        //   $('.mobile-home .slick-track .upload #fileupload').trigger('click');
        // });
        //上傳影片
        $('#fileupload').fileupload({
            url: './',
            dataType: 'json',
            done: function (e, data) {
              $('.slick').removeClass('loading');
              $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .list').index());
              push('list');
            },
            progressall: function (e, data) {
              var progress = parseInt(data.loaded / data.total * 100, 10);
                // $('#progress .progress-bar').css(
                //     'width',
                //     progress + '%'
                // );
            }
        })
        .bind('fileuploadstart', function (e) {
            $('.slick').addClass('loading');
        })
        .prop('disabled', !$.support.fileInput)
            .parent().addClass($.support.fileInput ? undefined : 'disabled');
      }
    },
    // Home page
    'home': {
      init: function() {
        // JavaScript to be fired on the home page
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
        // alert($('.slick').slick);

      }
    },
    // About us page, note the change from about-us to about_us.
    'about_us': {
      init: function() {
        // JavaScript to be fired on the about us page
      }
    }
  };

  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';

      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');

      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });

      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };

  // Load Events
  $(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.
