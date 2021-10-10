<?php if ( ! defined( 'ABSPATH' ) ) { exit; } ?>
<div id="foot">

<ul>
     <?php
         wp_nav_menu( array(
             'theme_location'	=> 'footer',
         ) ); 
     ?>
</ul>


<div class="foot-content">
    <?php if(aoton('copyright')){?>
    <p><?php echo aoton('copyright'); ?></p>
    <?php } ?>
    <?php if(aoton('icp')){?>
    <p>备案号：<strong><a href="https://beian.miit.gov.cn/" rel="external nofollow" target="_blank"><?php echo aoton('icp'); ?></a></strong></p>
    <?php } ?>
</div>

</div>