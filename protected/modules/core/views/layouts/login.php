<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<?php

    // register css
    $module = Yii::app()->getModule('core');
    $module->registerCssFile('/css/layout.css');
    $module->registerCssFile('/css/sidebar.css');
    
    // register css and js google prettify
    $module->registerCssFile('/css/prettify.css');
    $module->registerScriptFile('/js/prettify.js');
    
    // register css and js bootstrap
//    $module->registerCssFile('/bootstrap/css/bootstrap.min.css');
//    $module->registerScriptFile('/bootstrap/js/bootstrap.min.js');
    $module->registerScriptFile('/bootstrap/js/bootstrap-carousel.js');
    
    // register jquery
    $clientScript = Yii::app()->getClientScript();
    $clientScript->registerCoreScript('jquery');
    
    // register accordian js
    $module->registerScriptFile('/js/ddaccordion.js');
    
    // register init js
    $module->registerScriptFile('/js/init.js');
?>

<html lang="en">
<head>
	<title>SITAMAN | Login</title>
</head>

<body class="bg-body">
<div class="container">

<?php echo $content; ?>
    
<div class="container">
    <hr/>
    <div class="row">
        <div class="span-1">
            copyright aseprahmatginanjar 2012
        </div>
    </div>
    <hr/>
</div>
    
</div>
</body>
</html>