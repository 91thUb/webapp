<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php /* @var $form BootActiveForm */?>
<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'user-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>50)); ?>

	<?php echo $form->textFieldRow($model,'user_name',array('class'=>'span5','maxlength'=>50)); ?>

    <?php 
        if($model->isNewRecord)
        {
            echo $form->passwordFieldRow($model, 'user_passwd', array('class' => 'span5', 'maxlength' => 50));
        }
    ?>


	<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>50)); ?>
    
     <?php // echo $form->dropDownListRow($model, 'dropdown', array('Something ...', '1', '2', '3', '4', '5')); ?>
    
	<?php echo $form->dropDownListRow($model, 
                        'user_level_id', 
                        CHtml::listData(UserLevel::model()->findAll(), 'id', 'name') ,
                        array(
                            'empty' => 'Choose user level',
                            )
                        );
   ?>

    <?php 
        if(!$model->isNewRecord)
        {
            echo '<legend><h4>Optional</h4></legend>';
            echo $form->passwordFieldRow($model, 'changePassword', array('class' => 'span5', 'maxlength' => 50));
        }
    ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Save' : 'Update',
		)); ?>
        <input type="submit" value="Close" class="btn" onclick="location.href='<?php echo $this->createUrl('userManagement/index')?>'; return false;"/>
	</div>

<?php $this->endWidget(); ?>

