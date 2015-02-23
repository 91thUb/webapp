<br/>
<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'Module Management'=> YII::app()->createUrl('core/moduleManagement/index'), 
                    'Index'
                ),
)); ?>

<div class="btn-group">
    <a href="<?php echo $this->createUrl('moduleManagement/create'); ?>" class="btn btn-primary">Create New</a>
    <a href="<?php echo YII::app()->createUrl('core/home/index') ?>" class="btn">Close</a>
</div>

<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $this->widget('ext.groupgridview.BootGroupGridView',array(
	'id'=>'module-grid',
    'type'=>'striped bordered condensed',
    'extraRowColumns' => array('parent'),
	'dataProvider'=>$model->search(),
    'ajaxUpdate'=>false,
	'filter'=>$model,
	'columns'=>array(
        array(
            'value' => '',
        ),
		array(
            'name' => 'name',
            'value' => 'CHtml::link(CHtml::encode($data->name), array("moduleManagement/view", "id" => $data->id))',
            'type' => 'raw',
        ),
		'description',
		array(
            'name' => 'url',
            'value' => '$data->url == "0" || $data->url == "-" ? "-" : $data->url'
        ),
		array(
            'name' => 'parent',
            'value' => '(isset($data->selfRelation)) ? $data->selfRelation->name : "Parent Modul"',
            'filter' => CHtml::listData(Module::model()->parentModule()->findAll(), 'id', 'name'),
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
    <a href="<?php echo $this->createUrl('moduleManagement/create'); ?>" class="btn btn-primary">Create New</a>
    <a href="<?php echo YII::app()->createUrl('core/home/index') ?>" class="btn">Close</a>
</div>