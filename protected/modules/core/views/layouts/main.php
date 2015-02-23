<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

    // register css
    $module = Yii::app()->getModule('core');
    $module->registerCssFile('/css/layout.css');
    $module->registerCssFile('/css/sidebar.css');
    
    // register css and js google prettify
    $module->registerCssFile('/prettify/prettify.css');
    $module->registerScriptFile('/prettify/prettify.js');
    
    // register css and js carousel
    $module->registerScriptFile('/bootstrap/js/bootstrap-carousel.js');
    
    // register jquery
    $clientScript = Yii::app()->getClientScript();
    $clientScript->registerCoreScript('jquery');
    
    // register accordian js
    $module->registerScriptFile('/js/ddaccordion.js');
    
    // register windows_js
    $module->registerScriptFile('/windows_js/javascripts/prototype.js');
    $module->registerScriptFile('/windows_js/javascripts/effects.js');
    $module->registerScriptFile('/windows_js/javascripts/window.js');
    $module->registerScriptFile('/windows_js/javascripts/window_effects.js');
    $module->registerScriptFile('/windows_js/javascripts/debug.js');
    
    $module->registerCssFile('/windows_js/themes/default.css');
    $module->registerCssFile('/windows_js/themes/mac_os_x.css');
    
    // register init js
    $module->registerScriptFile('/js/init.js');
?>

<html lang="en">
<head>
	<title>DefaultDev | <?php echo isset(Yii::app()->user->name) ? Yii::app()->user->name : '' ?></title>
</head>

<body class="bg-short-body">

<!--  begin sidebar  -->
<div class="footer-container">
    <?php echo $this->renderPartial('application.modules.core.views.layouts._sidebar', array()); ?>
</div>
<!--  end sidebar  -->

<!--  begin content  -->
<div class="header-container">
    <?php echo $this->renderPartial('application.modules.core.views.layouts._header', array()); ?>
</div>

<div class="content-container">
    <h2> <?php echo isset($this->functionName) ? $this->functionName : '-'?></h2>
    <?php echo $content; ?>
</div>
<!--  end content  -->

<!--  begin footer  -->
<div class="footer-container">
    <?php echo $this->renderPartial('application.modules.core.views.layouts._footer', array()); ?>
</div>
<!--  end footer  -->

</body>
</html>