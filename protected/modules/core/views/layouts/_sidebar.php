<?php
    // register css
    $module = Yii::app()->getModule('core');
?>

<?php

function getParentModules($accessibleModules, $parentId = '0')
{
    sort($accessibleModules);
    $parentLevel = array();
    
    foreach ($accessibleModules as $ul) 
    {
        if ($ul->parent == $parentId) 
        {
            $parentLevel[] = $ul;
        }
    }
    
    return $parentLevel;
}

?>

<div class="sidebar-container">
    <div class="square-gray">
        <img src="<?php echo $module->getImage('/images/logo-bullet.png'); ?>"/>
        <img src="<?php echo $module->getImage('/images/logo-vertical.png'); ?>"/>
    </div>
    <div class="square-menu">
        <div id="accordian-menu">
            <img alt="logo" src="<?php echo $module->getImage('/images/logo.png'); ?>"/>
            <h3 class="expandable"><i class="icon-home icon-white"></i> Home</h3>
            <ul class="categoryitems sub-module">
                <li><a href="<?php echo YII::app()->createUrl('core/home/index'); ?>"><i class="icon-home icon-white"></i> Index</a></li>
                <li><a href="<?php echo Yii::app()->createUrl('core/user/logout'); ?>"><i class="icon-off icon-white"></i> Logout</a></li>
            </ul>
            <?php foreach (getParentModules($this->accessibleModules) as $module): ?>
                <h3 class="expandable"><i class="icon-th-large icon-white"></i> <?php echo $module->name ?> </h3>

                <ul class="categoryitems sub-module">
                    <?php foreach (getParentModules($this->accessibleModules, $module->id) as $subModule): ?>
                        <li>
                            <a href="<?php echo $this->createUrl($subModule->url . '/index') ?> ">
                                <i class="icon-chevron-right icon-white"></i> <?php echo $subModule->name; ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>

            <?php endforeach; ?>
        </div>
    </div>
</div> 