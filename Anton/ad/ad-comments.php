<!--评论框广告，在评论框上方显示-->
<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php if(aoton('commentsad')){?>
<div class="post-newer">
	<?php if ( wp_is_mobile() ) { ?>
        <div class="ad-m ad-site" uk-toggle="target: body ; cls: post-focus">
			<?php echo aoton('comments_ad_m') ?>
		</div>
	<?php } else { ?>
		<div class="ad-pc ad-site" uk-toggle="target: body ; cls: post-focus">
			<?php echo aoton('comments_ad_pc') ?>
		</div>
	<?php } ?>
</div>
<?php } ?>