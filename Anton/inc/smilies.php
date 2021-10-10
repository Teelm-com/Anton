<?php
// 表情
function aotonhemes_filter_smilies_src($img_src, $img, $siteurl) {
    return THEME_URI . '/assets/images/smilies/' . $img;
}
add_filter('smilies_src', 'aotonhemes_filter_smilies_src', 1, 10);

function smilies_reset() {
    global $wpsmiliestrans, $wp_smiliessearch, $wp_version;
    if ( !get_option( 'use_smilies' ) || $wp_version < 4.2)
        return;
    $wpsmiliestrans = array(
    ':mrgreen:' => 'mrgreen.png',
    ':exclaim:' => 'exclaim.png',
    ':neutral:' => 'neutral.png',
    ':twisted:' => 'twisted.png',
      ':arrow:' => 'arrow.png',
        ':eek:' => 'eek.png',
      ':smile:' => 'smile.png',
   ':confused:' => 'confused.png',
       ':cool:' => 'cool.png',
       ':evil:' => 'evil.png',
    ':biggrin:' => 'biggrin.png',
       ':idea:' => 'idea.png',
    ':redface:' => 'redface.png',
       ':razz:' => 'razz.png',
   ':rolleyes:' => 'rolleyes.png',
       ':wink:' => 'wink.png',
        ':cry:' => 'cry.png',
        ':lol:' => 'lol.png',
        ':mad:' => 'mad.png',
   ':drooling:' => 'drooling.png',
':persevering:' => 'persevering.png',
    );
}
smilies_reset();