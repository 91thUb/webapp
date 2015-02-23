<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'user-level-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->dropDownListRow($model, 
                        'parent', 
                        array('0' => Yii::t('asd', 'Parent Level')) + 
                        CHtml::listData(UserLevel::model()->findAll(), 'id', 'name') ,
                        array(
                            'empty' => 'Choose parent',
                            )
                        )
        ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Save' : 'Update',
		)); ?>
        <input type="submit" value="Close" class="btn" onclick="location.href='<?php echo $this->createUrl('userLevel/index')?>'; return false;"/>
	</div>

<?php $this->endWidget(); ?>
