<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<?php

    // register css
    $module = Yii::app()->getModule('core');
    $module->registerCssFile('/css/layout.css');
    $module->registerCssFile('/css/sidebar.css');
    
    // register jquery
    $clientScript = Yii::app()->getClientScript();
    $clientScript->registerCoreScript('jquery');
    
?>

<html lang="en">
<head>
</head>

<body class="bg-short-body">

<div class="container">
    <?php echo $content; ?>
</div>
<!--  end content  -->

</body>
</html>