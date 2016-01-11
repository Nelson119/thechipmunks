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

var appId = 574874969335972;
if(/localhost/.test(location.href)){
  appId = 578045952352207;
}

(function($) {
  var siteUrl = $('.mobile-home nav .home').attr('href');

  function push(target){
    console.log('push');
    console.log('push',target);

    var state = {
        title: document.title,
        url: location.href
    };
    window.history.pushState(state, document.title, siteUrl + '/?pagename=' + target);
  }

  var popped = false;
  var page = 1;
  var end = false;
  var initialURL = location.href;
  $(window).bind('popstate', function (event) {
    // Ignore inital popstate that some browsers fire on page load
    var initialPop = !popped && location.href == initialURL;
    popped = true;
    if (initialPop) return;


    // showMailOverview(); // exmaple function to display all email since the user has click Back.
    var state = event.originalEvent.state;
    var to = state.url.replace(/(http[:])?\/\/((.*)\/)+\/?([?]pagename[=])*[&]?/i,'');
    var vid = state.url.replace(/.*vid=(.*)[&]?/ig,'$1');
    slickTo(to, vid);
  });
  $(window).bind('pushstate', function (event) {
    // showMailOverview(); // exmaple function to display all email since the user has click Back.
    var state = event.originalEvent.state;
    var to = state.url.replace(/(http[:])?\/\/((.*)\/)+\/?([?]pagename[=])*[&]?/i,'');
    var vid = state.url.replace(/.*vid=(.*)[&]?/ig,'$1');
    slickTo(to, vid);
  });
  function share(post){
    if(post.url){
      window.open('https://www.facebook.com/sharer.php?u='+encodeURIComponent(post.url)+'&t='+encodeURIComponent(post.title));
    }else{
      window.open('https://www.facebook.com/sharer.php?s=100&p[title]=' + post.title + '&p[summary]=' + post.description + '&p[url]=' + post.url + '&p[images][0]=' + post.image); 
    }
  }
  function loadpage(cb){

      $.getJSON( siteUrl + '?page=' + page, function(r){
        $.each(r.list, function(i, d){
          var li = document.createElement('li');
          var a = document.createElement('a');
          $(a).attr('data-vid', d.vid).css('background-image', 'url(' + siteUrl+'/wp-content/themes/sage-theme/lib/videos/' + d.vid + '.jpg)');
          $(li).attr('data-vpost', d.post_id);
          $(a).on('click', function(){
            slickTo('watch', d.post_id);
          });
          $(li).append(a);
          $(li).addClass('col-xs-3 fade');
          $('.mobile-home .slick-track .list ul')
            .append(li);
            setTimeout(function(){
              $(li).addClass('in');
            }, i * 50);
        });
        end = r.list;
        page += 1;
        if(cb){
          cb();
        }
      });

  }
  function getpost(vpost){
    $.getJSON('?vpost=' + vpost, function(r){
      if(r.invalid){
        alert('影片不存在');
        slickTo('list');
      }

      var template = '<video src="' + siteUrl+'/wp-content/themes/sage-theme/lib/videos/'+r.vid+'.mp4" poster="' + siteUrl+'/wp-content/themes/sage-theme/lib/videos/'+r.vid+'.jpg" preload="metadata" controls="controls" autoplay="autoplay" width="480" height="320"><source src="' + siteUrl+'/wp-content/themes/sage-theme/lib/videos/'+r.vid+'.mp4" /></video>';
      $('.mobile-home .slick-track .watch .video-container').html(template);
      $('.mobile-home .slick-track .watch .author .name').html(r.name);
      $('.mobile-home .slick-track .watch .author .profile-pic')
        .attr('src', 'https://graph.facebook.com/' + r.fbid + '/picture');
      $('.mobile-home .slick-track .watch')
        .removeClass('sidd')
        .removeClass('alvin')
        .removeClass('simon');
      switch(r.chipmunk){
        case '喜多':
          $('.mobile-home .slick-track .watch').addClass('sidd');
          break;
        case '艾文':
          $('.mobile-home .slick-track .watch').addClass('alvin');
          break;
        case '賽門':
          $('.mobile-home .slick-track .watch').addClass('simon');
          break;
      }
    });
  }
  function slickTo(target, postId){
    $('.slick').removeClass('loading');
    if(target !== 'term' && target !== 'list' && target !== 'watch' && target !== 'home'){
      if(!$('input[name=fbid]').val()){
        target = 'home';
      }else if(!$('input[name=chipmunk]').val()){
        target = 'pick';
      }
    }
    if(target == 'list'){
      if($('.mobile-home').hasClass('list')){
        return;
      }
      $('.mobile-home').addClass('list');
      $('.mobile-home .slick-track .list ul').html('');
      page = 1;
      loadpage(loadpage);
    }else{
      $('.mobile-home').removeClass('list');
    }
    if(target == 'watch'){
      if(!postId){
        target = 'list';
      }
    }else{
      $('.mobile-home .slick-track .watch .video-container').html('');
      $('.mobile-home .slick-track .watch .author .name').html('');
      $('.mobile-home .slick-track .watch .author .profile-pic')
        .attr('src', '');
    }
    target = target || 'home';
    $('.slick').slick('slickGoTo', $('.mobile-home .slick-track .' + target).index() );
    if(target == 'watch'){
      if(postId){
        target += '&vid=' + postId;
        getpost(postId);
      }
    }
    push(target);
  }
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        hello.init({
          facebook: appId, 
        }, {redirect_uri: siteUrl, });

        $('.share-btn').on('click', function(){
          var post= {
            url : location.href,
            title: document.title
          };
          share(post);
        });
        $('.facebook').on('click', function(){
          var post= {
            url : siteUrl,
            title: $('meta[property^=og][property$=title]').attr('content')
          };
          share(post);
        });
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
        $('.slick >li').width($('.mobile-home').width());
        $('.slick >li').height($(window).height() - $('.mobile-home >nav').css('margin-top').replace(/px/,'') - $('.mobile-home >nav').css('padding-top').replace(/px/,''));

        $('.slick').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToSlide: 1,
          pauseOnHover: true,
          draggable: false,
          speed: 350,
          arrows: false,
          cssEase: 'ease-in-out',
          fade: true
        });
        var current = $('body').attr('data-current-slick') || 'home';
        var vid = $('body').attr('data-vid');
        slickTo(current, vid);
        $(window).resize(function(){
          $('.slick li').width($('.slick-list').width());
          $('.slick li').height($(window).height() - $('.mobile-home >nav').css('margin-top').replace(/px/,'') - $('.mobile-home >nav').css('padding-top').replace(/px/,''));
        }).trigger('resize');

        //活動辦法
        $('.mobile-home nav .term').on('click', function(){
          slickTo('term');
        });
        //回首頁
        $('.mobile-home nav .home').on('click', function(){
          slickTo('home');
          return false;
        });
        //我要當明星 跟登入當明星
        $('.mobile-home .slick-track .home .star, .mobile-home .slick-track .term .star').on('click', function(){
          if(!$('input[name=fbid]').val()){
            FB.login(function(response) {
                if (response.authResponse) {
                 // console.log('Welcome!  Fetching your information.... ');
                 FB.api('/me?fields=email,name,id', function(me) {
                   // console.log('Good to see you, ' + response.name + '.');
                   $('input[name=me]').val(me.name);
                   $('input[name=fbid]').val(me.id);
                   $('input[name=email]').val(me.email);
                   slickTo('pick');
                 });
                } else {
                  alert('請先登入facebook');
                }
            },{scope: 'email'});
          }else{
            slickTo('pick');
          }
        });
        $('.mobile-home .slick-track .home .fan').on('click', function(){
          slickTo('list');
        });
        //角色選擇
        $('.mobile-home .slick-track .pick a.alvin').on('click', function(){
          $('input[name=chipmunk]').val('艾文');
          slickTo('download-app-tutorial','alvin');
        });
        $('.mobile-home .slick-track .pick a.simon').on('click', function(){
          $('input[name=chipmunk]').val('賽門');
          slickTo('download-app-tutorial','simon');
        });
        $('.mobile-home .slick-track .pick a.sidd').on('click', function(){
          $('input[name=chipmunk]').val('喜多');
          slickTo('download-app-tutorial','sidd');
        });
        //我已經錄好，下一步
        $('.mobile-home .slick-track .download-app-tutorial .goto-upload').on('click', function(){
          slickTo('upload');
        });


        //選擇影片
        $('.mobile-home .slick-track .upload .pickvideo').on('click', function(e){
          $('.mobile-home .slick-track .upload #fileupload').trigger('click');
        });
        //上傳影片
        $('#fileupload').fileupload({
            url: './',
            dataType: 'json',
            done: function (e, data) {
              alert('上傳完成');
              $('.slick').removeClass('loading');
              if(data._response.textStatus == 'success'){
                var vid = data._response.result.id;
                var src = data._response.result.video_src;
                $('input[name=vid]').val(vid);
                $('input[name=video_src]').val(src);
                $('.slick-track .upload .preview').html('<div class="fb-video" data-href="https://www.facebook.com/roleplayergame2016/videos/'+vid+'" data-width="'+$(window).width()*0.8+'"></div>');
                $('.mobile-home .slick-track .upload .submit').unbind('click').bind('click',function(){
                  var post = {
                    vid : $('input[name=vid]').val(),
                    fbid : $('input[name=fbid]').val(),
                    me : $('input[name=me]').val(),
                    email : $('input[name=email]').val(),
                    chipmunk : $('input[name=chipmunk]').val(),
                    video_src : $('input[name=video_src]').val(),
                    message : $('textarea[name=message]').val()
                  };
                  $('.slick').addClass('loading');
                  $.ajax({
                      url:'',
                      method:'post',
                      data: post
                    }).error(function(){
                      slickTo('home');
                      alert('請稍後再試');
                    }).success(function(r){
                      slickTo('watch',r.post_id);
                    });
                });
              }
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

        $(window).on('resize scroll', function(){
            var winHeight = $(window).height();

            var showupArr = [];
            showupArr.push($('.copy'));

            if($('.list.slick-active').length){
              $.each(showupArr, function(i, d){
                if( $(window).scrollTop() + winHeight - 100 > d.offset().top && !end){
                  loadpage();
                }
              });
            }
        }).trigger('resize');
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
