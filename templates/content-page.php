<?php //the_content(); ?>
<?php $theme_path = get_template_directory_uri() . '/dist/'?>

<section class="desktop-home hidden-xs hidden-sm fade in">
	<h1 class="logo"><img src="<?php echo $theme_path?>images/the-chipmunks.png"></h1>
	<nav>
		<a target="_blank" href="https://www.youtube.com/watch?v=CCY0alePMeM" class="more">
			<img src="<?php echo $theme_path?>images/more.png">
			<img class="hover" src="<?php echo $theme_path?>images/more-hover.png">
		</a>
		<a class="pickme">
			<figure class="qrcode"><img src="<?php echo $theme_path?>images/qrcode.png"></figure>
			<img src="<?php echo $theme_path?>images/pickme.png">
			<img class="hover" src="<?php echo $theme_path?>images/pickme.png">
		</a>
		<span class="copy">&copy; 2016 Fox</span>
	</nav>
</section>
<section class="mobile-home visible-sm visible-xs">
	<nav>
		<ul>
			<li><a class="home" href="<?php echo get_site_url()?>"><h1>鼠來寶</h1></a></li>
			<li><a class="home" href="<?php echo get_site_url()?>">首頁</a></li>
			<li><a class="term" href="javascript:">活動辦法</a></li>
			<li><a class="facebook" href="javascript:">facebook</a></li>
		</ul>
	</nav>
	<ul class="slick">
		<li class="home">
			<h2><img src="<?php echo $theme_path?>images/mobile/r-u-ready.png"></h2>
			<a href="javascript:" class="fan">
				<img src="<?php echo $theme_path?>images/mobile/be-a-fan.png">
				<img class="hover" src="<?php echo $theme_path?>images/mobile/be-a-fan-hover.png">
			</a>
			<a href="javascript:" class="star">
				<img src="<?php echo $theme_path?>images/mobile/be-a-star.png">
				<img class="hover" src="<?php echo $theme_path?>images/mobile/be-a-star-hover.png">
			</a>
		</li>
		<li class="term">
			<a class="star" href="javascript:" tabindex="500">
				<img src="<?php echo $theme_path?>images/mobile/term-star.png">
				<img class="hover" src="<?php echo $theme_path?>images/mobile/term-star-hover.png">
			</a>
		</li>
		<li class="pick">
			<section class="center">
				<h3><img src="<?php echo $theme_path?>images/mobile/pick-title.png"></h3>
				<a title="艾文" class="alvin" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/alvin.png"></a>
				<a title="賽門" class="simon" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/simon.png"></a>
				<a title="喜多" class="sidd" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/sidd.png"></a>
			</section>
		</li>
		<li class="download-app-tutorial">
			<section class="center">
				<h3><img src="<?php echo $theme_path?>images/mobile/pick-title.png"></h3>
				<a title="艾文" class="alvin" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/alvin.png"></a>
				<a title="賽門" class="simon" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/simon.png"></a>
				<a title="喜多" class="sidd" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/sidd.png"></a>
				<section class="buttons">
					<a class="google-play" href="https://goo.gl/0MocGm"><img src="<?php echo $theme_path?>images/mobile/google-play.png"></a>
					<a class="app-store" href="https://goo.gl/oAGksO"><img src="<?php echo $theme_path?>images/mobile/app-store.png"></a>
					
					<a class="goto-upload" href="javascript:" tabindex="500">
						<img src="<?php echo $theme_path?>images/mobile/goto-upload.png">
						<img class="hover" src="<?php echo $theme_path?>images/mobile/goto-upload-hover.png">
					</a>
				</section>
			</section>
		</li>
		<li class="upload">
			<section class="center">
				<input name="vid" type="hidden"/>
				<input name="video_src" type="hidden"/>
				<input name="fbid" type="hidden"/>
				<input name="me" type="hidden"/>
				<input name="email" type="hidden"/>
				<input name="chipmunk" type="hidden"/>
				<h3><img src="<?php echo $theme_path?>images/mobile/upload-title.png"></h3>
				<img class="text" src="<?php echo $theme_path?>images/mobile/upload-text.png">
				<a class="pickvideo" href="javascript:" tabindex="500">
					<img src="<?php echo $theme_path?>images/mobile/btn-pick.png">
					<input id="fileupload" accept="video/*" type="file" name="video">
				</a>
				<textarea name="message" placeholder="我要當明星！！">我要當明星！！</textarea>
				<a class="submit" href="javascript:" tabindex="500">
					<img src="<?php echo $theme_path?>images/mobile/submit.png">
					<img class="hover" src="<?php echo $theme_path?>images/mobile/submit-hover.png">
				</a>
				<div class="preview"></div>
			</section>
		</li>
		<li class="list">
			<section class="center">
				<h3><img src="<?php echo $theme_path?>images/mobile/list-title.png"></h3>
				<ul class="video-list row">
				</ul>
			</section>
		</li>
		<li class="watch alvin">
			<section class="center">
				<h3><img src="<?php echo $theme_path?>images/mobile/watch-title.png"></h3>
				<aside class="author">
					<img class="profile-pic">
					<span class="name"></span>
					<a class="share-btn">
						<img src="<?php echo $theme_path?>images/mobile/share-btn.png">
					</a>
				</aside>
				<aside class="video-container">
					
				</aside>
			</section>
		</li>
	</ul>
	<span class="copy">&copy; 2016 Fox</span>
	<div id="fb-root"></div>
	<script>(function(d, s, id) {
		var appId = 574874969335972;
		if(/localhost/.test(location.href)){
		  appId = 578045952352207
		}
	  var js, fjs = d.getElementsByTagName(s)[0];
	  if (d.getElementById(id)) return;
	  js = d.createElement(s); js.id = id;
	  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5&appId="+appId;
	  fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));</script>
</section>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
