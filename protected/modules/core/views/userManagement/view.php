<br/>
<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'User Management'=> YII::app()->createUrl('core/userManagement/index'), 
                    'Detail'
                ),
)); ?>

<legend>
<h3>User <?php echo $model->name; ?></h3>
</legend>

<?php $this->widget('bootstrap.widgets.BootDetailView',array(
	'data'=>$model,
    'nullDisplay'=>'',
	'attributes'=>array(
//		'id',
		'name',
		'user_name',
		'email',
		'register_date',
		'userLevel.name',
		'last_login_date',
		'last_ip_address',
	),
)); ?>

<div class="form-actions">
    <a href="<?php echo $this->createUrl('userManagement/update', array('id'=> $model->id)) ?>" class="btn btn-primary">Edit</a>
    <a href="<?php echo $this->createUrl('userManagement/index') ?>" class="btn">Close</a>
</div>