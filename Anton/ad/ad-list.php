<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<?php if( aoton('listad') ) { ?>
<?php if ($wp_query->current_post == 1) : ?>
	<!-- 广告内容 -->
	<div class="post-newer mt-lg-2">
		<?php if ( wp_is_mobile() ) { ?>
			<div class="ad-m ad-site" uk-toggle="target: body ; cls: post-focus">
				<?php echo aoton('list_ad_m') ?>
			</div>
		<?php } else { ?>
			<div class="ad-pc ad-site" uk-toggle="target: body ; cls: post-focus">
				<?php echo aoton('list_ad_pc') ?>
			</div>
		<?php } ?>
	</div>
	<!-- 广告内容 -->
<?php endif; ?>
<?php } ?>