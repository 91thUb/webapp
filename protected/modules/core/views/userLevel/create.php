<br/>
<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'User Level'=> YII::app()->createUrl('core/userLevel/index'), 
                    'Create'
                ),
)); ?>

<legend>
    <h4>Create User Level</h4>
    <p>Fields with <span class="required">*</span> are required.</p>
</legend>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>