<?php $this->widget('bootstrap.widgets.BootAlert'); ?>

<?php
function getParent($baseArray, $parentValue)
{
    sort($baseArray);
    $parentLevel = array();
    
    foreach ($baseArray as $ul) 
    {
        if ($ul->parent == $parentValue) 
        {
            $parentLevel[] = $ul;
        }
    }
    
    return $parentLevel;
}

function isChecked($preCheckedArray, $checkedId)
{
    if(in_array($checkedId, $preCheckedArray))
    {
        return 'checked="checked"';
    }
}

function printCheckboxList($baseArray, $levelMenu = 0, $formName, $preCheckedArray = array() , $subMargin = 10)
{
    foreach (getParent($baseArray, $levelMenu) as $level)
    {
        echo '<input '. isChecked($preCheckedArray, $level->id) .' style="margin-left: '. $subMargin .'px;" type="checkbox" name="' . $formName . '" value="' . $level->id . '">' . ' ' . $level->name . ' <br />';
        printCheckboxList($baseArray, $level->id, $formName, $preCheckedArray, $subMargin + 20);
    }
}
?>

<?php
    foreach(Yii::app()->user->getFlashes() as $key => $message) {
        echo '<div class="flash-' . $key . '">' . $message . "</div>\n";
    }
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'module-form',
    'type'=>'horizontal',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    <table>
        <tr>
            <td style="width: 570px;">
                <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>255)); ?>

                <?php echo $form->textFieldRow($model,'description',array('class'=>'span5','maxlength'=>255)); ?>

                <?php echo $form->textFieldRow($model,'url',array('class'=>'span5','maxlength'=>255)); ?>

                <?php echo $form->dropDownListRow($model, 
                                                'parent', 
                                                array('0' => Yii::t('asd', 'Parent Module')) + 
                                                CHtml::listData(Module::model()->parentModule()->findAll(), 'id', 'name') ,
                                                array(
                                                    'empty' => 'Choose parent',
                                                    )
                                                )
                ?>
            </td>
            <td style="vertical-align: top;" class="span-7">
                <div class="row">
                    <?php echo $form->labelEx($model, 'hasPrivilage') ?>
                    <?php echo $form->error($model, 'hasPrivilage') ?>
                    <br/>
                    <? printCheckboxList($userLevel, 0, 'privilages[]', $preCheckedArray) ?>
                </div>
            </td>
        </tr>
    </table>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Save' : 'Update',
		)); ?>
        <input type="submit" value="Close" class="btn" onclick="location.href='<?php echo $this->createUrl('moduleManagement/index')?>'; return false;"/>
	</div>

<?php $this->endWidget(); ?>
