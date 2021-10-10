<?php 
$url = $_GET['url'];
$a = '';
if( $a==$url ) {
	$b = "";
// echo 'true';
} else {
	$b = $url;
	$b = base64_decode($b);
}

$t_url = preg_replace('/^url=(.*)$/i','$1',$_SERVER["QUERY_STRING"]);
if(!empty($t_url)) {
	preg_match('/(http|https):\/\//',$t_url,$matches);
	if($matches){
		$url=$t_url;
		$title='页面加载中,请稍候...';
	} else {
		$title='加载中...';
		echo "<script>setTimeout(function(){window.opener=null;window.close();}, 30000);</script>";/**加载超时（30秒）自动关闭**/
	}
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<meta name="robots" content="noindex, nofollow" />
		<meta http-equiv="refresh" content="0.1;url=<?php echo $b; ?>">
		<meta charset="utf-8">
		<title><?php echo $title;?></title>
		<!--<script type="text/javascript">
			/**标题“<title>”滚动效果**/
			var msg = document.title;
			msg = "" + msg;pos = 0;
			function scrollMSG() {
				document.title = msg.substring(pos, msg.length) + msg.substring(0, pos);
				pos++;
				if (pos >  msg.length) pos = 0
				window.setTimeout("scrollMSG()",500);
			}
			scrollMSG();
		</script>-->
		<style type="text/css">body{overflow:hidden;background:#444;}#colorfulPulse{display:flex;justify-content:center;align-items:center;height:100vh;overflow:hidden;}#Pulse span{display: inline-block;width: 15px;height: 60px;animation-name: scale;-webkit-animation-name: scale;-moz-animation-name: scale;-ms-animation-name: scale;-o-animation-name: scale;animation-duration: 2s;-webkit-animation-duration: 2s;-moz-animation-duration: 2s;-ms-animation-duration: 2s;-o-animation-duration: 2s;animation-iteration-count: infinite;-webkit-animation-iteration-count: infinite;-moz-animation-iteration-count: infinite;-ms-animation-iteration-count: infinite;-o-animation-iteration-count: infinite;}#colorfont {font-family: "Gill Sans", "Gill Sans MT", "Myriad Pro", "DejaVu Sans Condensed", Helvetica, Arial, "sans-serif";color: #3690cf;text-transform: uppercase;font-size: 1em;letter-spacing: 1.5px;text-align: center;margin-top: 20px;-webkit-animation: fade 2s infinite;-moz-animation: fade 2s infinite;}span.item-1 {background: #2ecc71;}span.item-2 {background: #3498db;}span.item-3 {background: #9b59b6;}span.item-4 {background: #e67e22;}span.item-5 {background: #c0392b;}span.item-6 {background: #e74c3c;}span.item-7 {background: #e74c8c;}.item-1 {animation-delay: -1s;-webkit-animation-delay: -1s;-moz-animation-delay: -1s;-ms-animation-delay: -1s;-o-animation-delay: -1s;}.item-2 {animation-delay: -0.9s;-webkit-animation-delay: -0.9s;-moz-animation-delay: -0.9s;-ms-animation-delay: -0.9s;-o-animation-delay: -0.9s;}.item-3 {animation-delay: -0.8s;-webkit-animation-delay: -0.8s;-moz-animation-delay: -0.8s;-ms-animation-delay: -0.8s;-o-animation-delay: -0.8s;}.item-4 {animation-delay: -0.7s;-webkit-animation-delay: -0.7s;-moz-animation-delay: -0.7s;-ms-animation-delay: -0.7s;-o-animation-delay: -0.7s;}.item-5 {animation-delay: -0.6s;-webkit-animation-delay: -0.6s;-moz-animation-delay: -0.6s;-ms-animation-delay: -0.6s;-o-animation-delay: -0.6s;}.item-6 {animation-delay: -0.5s;-webkit-animation-delay: -0.5s;-moz-animation-delay: -0.5s;-ms-animation-delay: -0.5s;-o-animation-delay: -0.5s;}.item-7 {animation-delay: -0.4s;-webkit-animation-delay: -0.4s;-moz-animation-delay: -0.4s;-ms-animation-delay: -0.4s;-o-animation-delay: -0.4s;}@-webkit-keyframes scale {0%, 40%, 100% {-moz-transform: scaleY(0.2);-ms-transform: scaleY(0.2);-o-transform: scaleY(0.2);-webkit-transform: scaleY(0.2);transform: scaleY(0.2);}20%, 60% {-moz-transform: scaleY(1);-ms-transform: scaleY(1);-o-transform: scaleY(1);-webkit-transform: scaleY(1);transform: scaleY(1);}}@-moz-keyframes scale {0%, 40%, 100% {-moz-transform: scaleY(0.2);-ms-transform: scaleY(0.2);-o-transform: scaleY(0.2);-webkit-transform: scaleY(0.2);transform: scaleY(0.2);}20%, 60% {-moz-transform: scaleY(1);-ms-transform: scaleY(1);-o-transform: scaleY(1);-webkit-transform: scaleY(1);transform: scaleY(1);}}@-ms-keyframes scale {0%, 40%, 100% {-moz-transform: scaleY(0.2);-ms-transform: scaleY(0.2);-o-transform: scaleY(0.2);-webkit-transform: scaleY(0.2);transform: scaleY(0.2);}20%, 60% {-moz-transform: scaleY(1);-ms-transform: scaleY(1);-o-transform: scaleY(1);-webkit-transform: scaleY(1);transform: scaleY(1);}}@keyframes scale {0%, 40%, 100% {-moz-transform: scaleY(0.2);-ms-transform: scaleY(0.2);-o-transform: scaleY(0.2);-webkit-transform: scaleY(0.2);transform: scaleY(0.2);}20%, 60% {-moz-transform: scaleY(1);-ms-transform: scaleY(1);-o-transform: scaleY(1);-webkit-transform: scaleY(1);transform: scaleY(1);}}@-webkit-keyframes fade {50% {opacity: 0.5;}100% {opacity: 1;}}@-moz-keyframes fade {50% {opacity: 0.5;}100% {opacity: 1;}}@-o-keyframes fade {50% {opacity: 0.5;}100% {opacity: 1;}@keyframes fade {50% {opacity: 0.5;}100% {opacity: 1;}}}</style>
	</head>
	<body>
		<div id="colorfulPulse">
			<div id="Pulse">
				<span class="item-1"></span>
				<span class="item-2"></span>
				<span class="item-3"></span>
				<span class="item-4"></span>
				<span class="item-5"></span>
				<span class="item-6"></span>
				<span class="item-7"></span>
				<h1 id="colorfont">Loading...</h1>
			</div>
		</div>
	</body>
</html>