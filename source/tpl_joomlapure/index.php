<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  Templates.joomlapure
 *
 * @copyright   Copyright (C) Robert Went. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$params = $app->getTemplate(true)->params;
$this->language = $doc->language;
$this->direction = $doc->direction;
$template = $app->getTemplate();

// Move all the guff somewhere else
include ('pure'.DS.'config.php');
include ('pure'.DS.'views'.DS.'main_index_include.php');

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<meta charset="utf-8">
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php
	if (!(JoomlaPure::isBot() && $mobileRemoveBotCss)) {
		if (JoomlaPure::isMobile() && !JoomlaPure::isTablet() && $mobileMobileCss) {
		// Mobiledetect installed/enabled/selected, is a mobile -> load mobile.css ?>
		<link rel="stylesheet" href="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/css/mobile.css" type="text/css" />
		<?php } elseif (JoomlaPure::isTablet() && $mobileTabletCss) {
		// Mobiledetect installed/enabled/selected, is a tablet -> load tablet.css ?>
		<link rel="stylesheet" href="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/css/tablet.css" type="text/css" />
		<?php } else {
		echo $loadCss; // Loads selected stylesheets
	}
}
	 // Add jQuery if set to load in the head
if (!(JoomlaPure::isBot() && $mobileRemoveBotJs)) {
	if ($addJquery == 'top' && $jqueryVersion) : ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/<?php echo $jqueryVersion; ?>/jquery.min.js"></script>
	<script src="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/js/noconflict.js"></script>
	<?php endif;
} ?>
<jdoc:include type="head" />
<?php if ($this->params->get('analyticsCode')) {
	echo $this->params->get('analyticsCode');
} ?>
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
</head>
<body>
	<!--start demo-->
	<div class="content pure-g-r"> <!--content-->
		<header class="header pure-u-1">
			<?php if ($this->countModules('menu')) : ?>
			<div class="pure-menu pure-menu-open pure-menu-fixed pure-menu-horizontal" <?php if ($waiAriaRoles) echo 'role="navigation"'; ?>>
				<a href="<?php echo $this->baseurl; ?>" title="<?php echo $sitename; ?>" class="brand-link"><span class="brand-title" <?php if ($waiAriaRoles) echo 'role="banner"'; ?>><?php echo $sitename; ?></span></a>
				<jdoc:include type="modules" name="menu" style="puredefault" />
			</div>
		<?php endif; ?>
	</header>
	<?php if ($this->countModules('splash')) : ?>
	<div class="splash pure-u-1">
		<div class="pure-g-r">
			<jdoc:include type="modules" name="splash" style="puredefault" />
		</div>
	</div>
<?php endif; ?>
<div class="content pure-u-1"> <!--main wrap-->
	<?php if ($this->countModules('breadcrumbs')) : ?>
	<div class="breadcrumbs pure-g-r">
		<jdoc:include type="modules" name="breadcrumbs" style="puredefault" />
	</div>
<?php endif; ?>
<div class="main pure-g-r content-ribbon" <?php if ($waiAriaRoles) echo 'role="main"'; ?>>
	<jdoc:include type="message" />
	<?php if ($removeComponent != 1) : ?>
	<jdoc:include type="component" />
<?php endif; ?>
</div>
<?php if ($this->countModules('bottom')) : ?>
	<div class="bottom pure-g-r">
		<jdoc:include type="modules" name="bottom" style="puredefault" />
	</div>
<?php endif; ?>
</div> <!--end main wrap-->
<?php if ($this->countModules('footer')) : ?>
	<footer class="footer pure-u-1">
		<jdoc:include type="modules" name="footer" style="puredefault" />
	</footer>
<?php endif; ?>
</div> <!--end content-->
<!--end demo-->


<?php
if (!(JoomlaPure::isBot() && $mobileRemoveBotJs)) {
	if ($addJquery == 'bottom' && $jqueryVersion) : ?>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/<?php echo $jqueryVersion; ?>/jquery.min.js"></script>
	<!--<script type="text/javascript">jQuery.noConflict();</script>-->
	<script src="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/js/noconflict.js"></script>
	<?php endif;
	if ($addPlugins) {
		if ($cdnUrl && $cdnJavascript) { ?>
		<script defer src="<?php echo $cdnUrl ?>/templates/<?php echo $template; ?>/js/plugins.js"></script>
		<?php } else { ?>
		<script defer src="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/js/plugins.js"></script>
		<?php }
	};
	if ($addScripts) {
		if ($cdnUrl && $cdnJavascript) { ?>
		<script defer src="<?php echo $cdnUrl ?>/templates/<?php echo $template; ?>/js/scripts.js"></script>
		<?php } else { ?>
		<script defer src="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/js/scripts.js"></script>
		<?php }
	};
	// SocialCount stuff
	if (!(JoomlaPure::isBot() && $mobileRemoveBotJs)) {
		if ($SocialCountJs) {
			if ($cdnUrl && $cdnJavascript) { ?>
			<script src="<?php echo $cdnUrl ?>/templates/<?php echo $template; ?>/pure/libs/socialcount/socialcount.min.js"></script>
			<?php } else { ?>
			<script src="<?php echo JURI::root(true) ?>/templates/<?php echo $template; ?>/pure/libs/socialcount/socialcount.min.js"></script>
			<?php }
		}
	}
	if (($bottomScripts && $bottomScripts!=null) || ($this->params->get('googleFont') && $this->params->get('googleFontLoader'))) : ?>
	<script type="text/javascript">
	<?php endif;
	if ($this->params->get('bottomScripts')) {
	//echo preg_replace('/\s+/', '', $bottomScripts); //Remove all whitespace
		echo $bottomScripts;
	}
	if ($this->params->get('googleFont') && $this->params->get('googleFontName') && $this->params->get('googleFontLoader')): ?>
		WebFontConfig={google:{families:["<?php echo $this->params->get('googleFontName'); ?>"]}};(function(){var e=document.createElement("script");e.src=("https:"==document.location.protocol?"https":"http")+"://ajax.googleapis.com/ajax/libs/webfont/1/webfont.js";e.type="text/javascript";e.async="true";var t=document.getElementsByTagName("script")[0];t.parentNode.insertBefore(e,t)})();
<?php endif;
if (($bottomScripts && $bottomScripts!=null) || ($this->params->get('googleFont') && $this->params->get('googleFontLoader'))) : ?>
	</script>
<?php endif;
}
if (!(JoomlaPure::isBot() || JoomlaPure::isMobile() || JoomlaPure::isTablet() )) {?>
<jdoc:include type="modules" name="debug" style="none" />
<?php } ?>
</body>
</html>
