<br/>
<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'Module Management'=> YII::app()->createUrl('core/moduleManagement/index'), 
                    'Detail'
                ),
)); ?>

<legend>
<h3>Module <?php echo $model->name; ?></h3>
</legend>

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
        echo '<input '. isChecked($preCheckedArray, $level->id) .' disabled="disabled" style="margin-left: '. $subMargin .'px;" type="checkbox" name="' . $formName . '" value="' . $level->id . '">' . ' ' . $level->name . ' <br />';
        printCheckboxList($baseArray, $level->id, $formName, $preCheckedArray, $subMargin + 20);
    }
}
?>

<table id="yw0" class="detail-view table table-striped table-condensed">
    <tbody>
        <tr class="odd">
            <th>Name</th><td><?php echo $model->name ?></td>
        </tr>
        <tr class="even">
           <th>Description</th><td><?php echo $model->description ?></td>
        </tr>
        <tr class="odd">
           <th>Modul URL Location</th><td><?php echo $model->url == "0" || $model->url == "-" ? "PARENT MODULE" : $model->url ?></td>
        </tr>
        <?php if(isset($model->selfRelation)) { ?>
        <tr class="even">
            <th>Parent Module</th><td><?php if(isset($model->selfRelation)) echo $model->selfRelation->name ?></td>
        </tr>
        <?php } ?>
        
        <?php if(count($model->privilages) > 0) { ?>
        <tr class="even">
            <th>Privilages</th>
            <td><? echo count($model->privilages) ? printCheckboxList($userLevel, 0, 'privilages[]', $preCheckedArray) : "-" ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>


<div class="form-actions">
    <a href="<?php echo $this->createUrl('moduleManagement/update', array('id'=> $model->id)) ?>" class="btn btn-primary">Edit</a>
    <a href="<?php echo $this->createUrl('moduleManagement/index') ?>" class="btn">Close</a>
</div>