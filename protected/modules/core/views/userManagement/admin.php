<br/>
<?php 
    $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'User Management'=> YII::app()->createUrl('core/userManagement/index'), 
                    'Index'
                ),
    )); 
?>

<div class="btn-group">
    <a href="<?php echo $this->createUrl('userManagement/create'); ?>" class="btn btn-primary">Create New</a>
    <a href="<?php echo YII::app()->createUrl('core/home/index') ?>" class="btn">Close</a>
</div>

<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'user-grid',
    'type'=>'striped bordered condensed',
    'extraRowColumns' => array('user_level_id'),
    'mergeColumns' => array('user_level_id'),
    'ajaxUpdate'=>false,
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'value' => '',
        ),
		array(
            'name' => 'name',
            'value' => 'CHtml::link(CHtml::encode($data->name), array("userManagement/view", "id" => $data->id))',
            'type' => 'raw',
        ),
		'user_name',
		'email',
		'register_date',
		array(
            'name' => 'user_level_id',
            'value' => '(isset($data->userLevel)) ? $data->userLevel->name : null',
            'filter' => CHtml::listData(UserLevel::model()->findAll(), 'id', 'name'),
        ),
		array(
			'class'=>'bootstrap.widgets.BootButtonColumn',
		),
        array(
            'value' => '',
        ),
	),
)); 
?>

<div class="btn-group">
    <a href="<?php echo $this->createUrl('userManagement/create'); ?>" class="btn btn-primary">Create New</a>
    <a href="<?php echo YII::app()->createUrl('core/home/index') ?>" class="btn">Close</a>
</div>