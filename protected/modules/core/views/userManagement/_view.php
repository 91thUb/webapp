<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_name')); ?>:</b>
	<?php echo CHtml::encode($data->user_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_passwd')); ?>:</b>
	<?php echo CHtml::encode($data->user_passwd); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('register_date')); ?>:</b>
	<?php echo CHtml::encode($data->register_date); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('register_by')); ?>:</b>
	<?php echo CHtml::encode($data->register_by); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_level_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_level_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_date')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_date); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_ip_address')); ?>:</b>
	<?php echo CHtml::encode($data->last_ip_address); ?>
	<br />

	*/ ?>

</div>