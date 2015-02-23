<br/>
<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'Module Management'=> YII::app()->createUrl('core/moduleManagement/index'), 
                    'Create'
                ),
)); ?>

<legend>
    <h4>Create Module</h4>
    <p>Fields with <span class="required">*</span> are required.</p>
</legend>

<?php echo $this->renderPartial('_form', 
                array(
                    'model'=>$model,
                    'isCreate'=>true,
                    'userLevel'=>$userLevel,
                    'preCheckedArray'=>$preCheckedArray,
                    )
            ); 
?>
