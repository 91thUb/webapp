<br/>
<?php 
    $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'User Level'=> YII::app()->createUrl('core/userLevel/index'), 
                    'Index'
                ),
    )); 
?>

<div class="btn-group">
    <a href="<?php echo $this->createUrl('userLevel/create'); ?>" class="btn btn-primary">Create New</a>
    <a href="<?php echo YII::app()->createUrl('core/home/index') ?>" class="btn">Close</a>
</div>

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'user-level-grid',
    'type'=>'striped bordered condensed',
    'extraRowColumns' => array('parent'),
    'mergeColumns' => array('parent'),
    'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'value' => '',
        ),
        array(
            'name' => 'name',
            'value' => 'CHtml::link(CHtml::encode($data->name), array("userLevel/view", "id" => $data->id))',
            'type' => 'raw',
			'htmlOptions' => array('style'=>'min-width:700px'),
        ),
		'description',
		array(
            'name' => 'parent',
            'value' => '(isset($data->selfRelation)) ? $data->selfRelation->name : "Parent Level"',
            'filter' => CHtml::listData(UserLevel::model()->findAll(), 'id', 'name'),
        ),
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
        array(
            'value' => '',
        ),
	),
)); ?>

<div class="btn-group">
    <a href="<?php echo $this->createUrl('userLevel/create'); ?>" class="btn btn-primary">Create New</a>
    <a href="<?php echo YII::app()->createUrl('core/home/index') ?>" class="btn">Close</a>
</div>