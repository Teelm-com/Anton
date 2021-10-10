<!--正文广告，在标题下显示-->
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php if( aoton('searchad') ) { ?>
<div class="post-newer mt-lg-2">
	<?php if ( wp_is_mobile() ) { ?>
        <div class="ad-m ad-site" uk-toggle="target: body ; cls: post-focus">
			<?php echo aoton('search_ad_m') ?>
		</div>
	<?php } else { ?>
		<div class="ad-pc ad-site" uk-toggle="target: body ; cls: post-focus">
			<?php echo aoton('search_ad_m') ?>
		</div>
	<?php } ?>
</div>
<?php } ?>