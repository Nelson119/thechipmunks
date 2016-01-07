<?php //the_content(); ?>
<?php $theme_path = get_template_directory_uri() . '/dist/'?>

<section class="desktop-home hidden-xs fade in">
	<h1 class="logo"><img src="<?php echo $theme_path?>images/the-chipmunks.png"></h1>
	<nav>
		<a href="https://www.youtube.com/watch?v=CCY0alePMeM" class="more">
			<img src="<?php echo $theme_path?>images/more.png">
			<img class="hover" src="<?php echo $theme_path?>images/more-hover.png">
		</a>
		<a href="javascript:" class="pickme">
			<figure class="qrcode"><img src="<?php echo $theme_path?>images/qrcode.png"></figure>
			<img src="<?php echo $theme_path?>images/pickme.png">
			<img class="hover" src="<?php echo $theme_path?>images/pickme-hover.png">
		</a>
	</nav>
</section>
<section class="mobile-home visible-xs">
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
		</li>
		<li class="pick">
			<a title="艾文" class="alvin" href="javascript:">alvin</a>
			<a title="賽門" class="simon" href="javascript:">simon</a>
			<a title="喜多" class="sidd" href="javascript:">sidd</a>
		</li>
		<li class="download-app-tutorial">
			<section class="center">
				<a class="google-play" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/google-play.png"></a>
				<a class="app-store" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/app-store.png"></a>
				
				<a class="goto-upload" href="javascript:" tabindex="500">
					<img src="<?php echo $theme_path?>images/mobile/goto-upload.png">
					<img class="hover" src="<?php echo $theme_path?>images/mobile/goto-upload-hover.png">
				</a>
			</section>
		</li>
		<li class="upload">
			<section class="center">
				<a class="pickvideo" href="javascript:" tabindex="500">
					<img src="<?php echo $theme_path?>images/mobile/btn-pick.png">
					<input id="fileupload" accept="video/*" type="file" name="video">
				</a>
				<textarea placeholder="我要當明星！！">我要當明星！！</textarea>
				<a class="submit" href="javascript:" tabindex="500">
					<img src="<?php echo $theme_path?>images/mobile/submit.png">
					<img class="hover" src="<?php echo $theme_path?>images/mobile/submit-hover.png">
				</a>
			</section>
		</li>
		<li class="choose-role">
			<section class="center">
				<a class="google-play" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/google-play.png"></a>
				<a class="app-store" href="javascript:"><img src="<?php echo $theme_path?>images/mobile/app-store.png"></a>
				<a class="goto-upload" href="javascript:">
					<img src="<?php echo $theme_path?>images/mobile/goto-upload.png">
					<img class="hover" src="<?php echo $theme_path?>images/mobile/goto-upload-hover.png">
				</a>
			</section>
		</li>
	</ul>
</section>
<?php wp_link_pages(['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>']); ?>
