<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
<?php include_http_metas() ?>
<?php include_metas() ?>
<?php include_title() ?>
<?php use_stylesheet('/cache/css/customizing.css') ?>
<?php if (Doctrine::getTable('SnsConfig')->get('customizing_css')): ?>
<link rel="stylesheet" type="text/css" href="<?php echo url_for('@customizing_css') ?>" />
<?php endif; ?>
<?php include_stylesheets() ?>
<?php
use_helper('Javascript');
use_javascript('jquery.min.js');
use_javascript('jquery.tmpl.min.js');
?>
<?php if (opConfig::get('enable_jsonapi') && opToolkit::isSecurePage()): ?>
<?php
use_javascript('jquery.notify.js');
use_javascript('op_notify.js');
$jsonData = array(
  'apiKey' => $sf_user->getMemberApiKey(),
  'apiBase' => app_url_for('api', 'homepage'),
);

echo javascript_tag('
var openpne = '.json_encode($jsonData).';
');
?>
<?php endif ?>
<?php include_javascripts() ?>
<?php echo $op_config->get('pc_html_head') ?>
  <script type='text/javascript'>
    var googletag = googletag || {};
    googletag.cmd = googletag.cmd || [];
    (function() {
      var gads = document.createElement('script');
      gads.async = true;
      gads.type = 'text/javascript';
      var useSSL = 'https:' == document.location.protocol;
      gads.src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
      var node = document.getElementsByTagName('script')[0];
      node.parentNode.insertBefore(gads, node);
    })();
  </script>

  <script type='text/javascript'>
    googletag.cmd.push(function() {
      googletag.defineSlot('/7083201/pne_jp_side1', [160, 600], 'div-gpt-ad-1383195165288-0').addService(googletag.pubads());
      googletag.pubads().enableSingleRequest();
      googletag.enableServices();
    });
  </script>
</head>
<body id="<?php printf('page_%s_%s', $view->getModuleName(), $view->getActionName()) ?>" class="<?php echo opToolkit::isSecurePage() ? 'secure_page' : 'insecure_page' ?>">
<?php echo $op_config->get('pc_html_top2') ?>
<div id="Body">
<?php echo $op_config->get('pc_html_top') ?>
<div id="Container">
<?php $type = sfConfig::get('sf_nav_type', sfConfig::get('mod_'.$module.'_default_nav', 'default')); ?>
<div id="Header" class="navbar <?php if('friend' == $type): ?>navbar-inverse<?php endif; ?>">
<div id="HeaderContainer" div class="navbar-inner">
<div class="container">
<?php include_partial('global/header') ?>
</div>
</div><!-- HeaderContainer -->
</div><!-- Header -->

<div id="Contents">
<div id="ContentsContainer">

<div id="Layout<?php echo $layout ?>" class="Layout">

<?php if ($sf_user->hasFlash('error')): ?>
<?php op_include_parts('alertBox', 'flashError', array('body' => __($sf_user->getFlash('error'), $sf_data->getRaw('sf_user')->getFlash('error_params', array())))) ?>
<?php endif; ?>
<?php if ($sf_user->hasFlash('notice')): ?>
<?php op_include_parts('alertBox', 'flashNotice', array('body' => __($sf_user->getFlash('notice'), $sf_data->getRaw('sf_user')->getFlash('notice_params', array())))) ?>
<?php endif; ?>

<?php if (has_slot('op_top')): ?>
<div id="Top">
<?php include_slot('op_top') ?>
</div><!-- Top -->
<?php endif; ?>

<?php if (has_slot('op_sidemenu')): ?>
<div id="Left">
<?php include_slot('op_sidemenu') ?>
<div class="well dparts ad">
<?php if (opConfig::get('opt_ad_free') == 0): ?>
<?php
echo<<<EOM
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5836291027790450";
/* pne.jp_250×250 */
google_ad_slot = "8175424807";
google_ad_width = 250;
google_ad_height = 250;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
EOM;
?>
<?php endif;?>
</div>
</div><!-- Left -->
<?php endif; ?>

<div id="Center">
<?php echo $sf_content ?>
</div><!-- Center -->

<?php if (has_slot('op_bottom')): ?>
<div id="Bottom">
<?php include_slot('op_bottom') ?>
</div><!-- Bottom -->
<?php endif; ?>

</div><!-- Layout -->

<div id="sideBanner">
<?php include_component('default', 'sideBannerGadgets'); ?>
<div class="dparts ad">
<?php if (opConfig::get('opt_ad_free') == 0): ?>
<?php
echo <<<EOM
<!-- pne_jp_side2 -->
<div id='div-gpt-ad-1383195165288-0' style='width:160px; height:600px;'>
<script type='text/javascript'>
googletag.cmd.push(function() { googletag.display('div-gpt-ad-1383195165288-0'); });
</script>
</div>
EOM;
?>
</div>

<div class="dparts ad">
<?php
echo <<<EOM
<script type="text/javascript"><!--
google_ad_client = "ca-pub-5836291027790450";
/* pne.jp_160×600_2*/
google_ad_slot = "5221958404";
google_ad_width = 160;
google_ad_height = 600;
//-->
</script>
<script type="text/javascript"
src="//pagead2.googlesyndication.com/pagead/show_ads.js">
</script>
EOM;
?>
<?php endif;?>
</div>
</div><!-- sideBanner -->

</div><!-- ContentsContainer -->
</div><!-- Contents -->

<?php if ($sf_request->isSmartphone(false)): ?>
<div id="SmtSwitch">
<a href="javascript:void(0)" id="SmtSwitchLink"><?php echo __('View this page on smartphone style') ?></a>
<?php echo javascript_tag('
document.getElementById("SmtSwitchLink").addEventListener("click", function() {
  opCookie.set("disable_smt", "0");
  location.reload();
}, false);
') ?>
</div>
<?php endif ?>

<div id="Footer">
<div id="FooterContainer">
<?php include_partial('global/footer') ?>
</div><!-- FooterContainer -->
</div><!-- Footer -->

<?php echo $op_config->get('pc_html_bottom2') ?>
</div><!-- Container -->
<?php echo $op_config->get('pc_html_bottom') ?>
</div><!-- Body -->
</body>
</html>
