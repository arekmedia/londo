<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="text/html;charset=utf-8" />

<title>iPhone Style Radio and Checkbox Switches, found on DevGrow.com</title>

<link rel="alternate" type="application/rss+xml" href="http://SITEURL" title="SITE TITLE" /> 
<meta name="description" content="DESCRIPTION" /> 
<meta name="keywords" content="KEYWORDS" /> 

	
<script type="text/javascript" src="jquery.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready( function(){ 
	$(".cb-enable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-disable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', true);
	});
	$(".cb-disable").click(function(){
		var parent = $(this).parents('.switch');
		$('.cb-enable',parent).removeClass('selected');
		$(this).addClass('selected');
		$('.checkbox',parent).attr('checked', false);
	});
});
</script>

<style type="text/css">
	body { font-family: Arial, Sans-serif; padding: 0 20px; }
	.field { width: 100%; float: left; margin: 0 0 20px; }
	.field input { margin: 0 0 0 20px; }
	h3 span { background: #444; color: #fff; padding: 3px; }
	pre { background: #f4f4f4; }

	/* Used for the Switch effect: */
	.cb-enable, .cb-disable, .cb-enable span, .cb-disable span { background: url(switch.gif) repeat-x; display: block; float: left; }
	.cb-enable span, .cb-disable span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
	.cb-enable span { background-position: left -90px; padding: 0 10px; }
	.cb-disable span { background-position: right -180px;padding: 0 10px; }
	.cb-disable.selected { background-position: 0 -30px; }
	.cb-disable.selected span { background-position: right -210px; color: #fff; }
	.cb-enable.selected { background-position: 0 -60px; }
	.cb-enable.selected span { background-position: left -150px; color: #fff; }
	.switch label { cursor: pointer; }
</style>

</head>
<body>
	<h2>iPhone Style Radio and Checkbox Switches using JQuery and CSS</h2>
	<h4>From <a href="http://devgrow.com/">DevGrow</a>, a blog about designing, developing and growing your website.</h4>
	<h3>The Example:</h3>
	<p class="field switch">
		<input type="radio" id="radio1" name="field"  checked />enable
		<input type="radio" id="radio2" name="field" />disable
		<label for="radio1" class="cb-enable selected"><span>Enable</span></label>
		<label for="radio2" class="cb-disable"><span>Disable</span></label>
	</p>
	<p class="field switch">
		<label class="cb-enable"><span>On</span></label>
		<label class="cb-disable selected"><span>Off</span></label>
		<input type="checkbox" id="checkbox" class="checkbox" name="field2" /> Checkbox
	</p>
	
	<h3>The Prerequisites</h3>
	<p>You need just two things for this to work correctly: <a href="http://jquery.com/">JQuery 1.3.2+</a> and the <a href="http://devgrow.com/examples/switch.gif">switch.gif</a> image file used for the backgrounds.</p>

	<h3><span>Step 1</span> The HTML</h3>
	<pre><code>
	&lt;p class="field switch"&gt;
		&lt;input type="radio" id="radio1" name="field"  checked /&gt;
		&lt;input type="radio" id="radio2" name="field" /&gt;
		&lt;label for="radio1" class="cb-enable selected"&gt;&gt;span&gt;Enable&lt;/span&gt;&lt;/label&gt;
		&lt;label for="radio2" class="cb-disable"&gt;&lt;span&gt;Disable&lt;/span&gt;&lt;/label&gt;
	&lt;/p>
	&lt;p class="field switch"&gt;
		&lt;label class="cb-enable"&gt;&lt;span&gt;On&lt;/span&gt;&lt;/label&gt;
		&lt;label class="cb-disable selected"&gt;&lt;span&gt;Off&lt;/span&gt;&lt;/label&gt;
		&lt;input type="checkbox" id="checkbox" class="checkbox" name="field2" /&gt;
	&lt;/p&gt;
	</code>
	</pre>

	<h3><span>Step 2</span> The Javascript</h3>
	<pre><code>
	$(document).ready( function(){ 
		$(".cb-enable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-disable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', true);
		});
		$(".cb-disable").click(function(){
			var parent = $(this).parents('.switch');
			$('.cb-enable',parent).removeClass('selected');
			$(this).addClass('selected');
			$('.checkbox',parent).attr('checked', false);
		});
	});</code>
	</pre>

	<h3><span>Step 3</span> The CSS</h3>
	<pre><code>
	.cb-enable, .cb-disable, .cb-enable span, .cb-disable span { background: url(switch.gif) repeat-x; display: block; float: left; }
	.cb-enable span, .cb-disable span { line-height: 30px; display: block; background-repeat: no-repeat; font-weight: bold; }
	.cb-enable span { background-position: left -90px; padding: 0 10px; }
	.cb-disable span { background-position: right -180px;padding: 0 10px; }
	.cb-disable.selected { background-position: 0 -30px; }
	.cb-disable.selected span { background-position: right -210px; color: #fff; }
	.cb-enable.selected { background-position: 0 -60px; }
	.cb-enable.selected span { background-position: left -150px; color: #fff; }
	.switch label { cursor: pointer; }
	.switch input { display: none; }</code>
	</pre>
	
	<h3>Compatability</h3>
	<p>While this should work in all major browsers, it has only been tested on: Firefox 3.5+, IE7+, Chrome 4.1+, Opera 9.6+, Safari 4+</p>
	
	<h3>License</h3>
	<p>This resource is released under <strong><a href="http://www.gnu.org/licenses/gpl.html">GPL</a> - share at will!</strong></p>
	<p>- Monji, from <a href="http://devgrow.com/">DevGrow</a></p>
</body>
</html>