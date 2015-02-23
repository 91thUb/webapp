<br/>
<?php $this->widget('bootstrap.widgets.BootBreadcrumbs', array(
                'homeLink' => CHtml::link('Home', YII::app()->createUrl('core/home/index')),
                'links'=>array(
                    'User Management'=> YII::app()->createUrl('core/userManagement/index'), 
                    'Detail'
                ),
)); ?>

<legend>
<h3>User Level <?php echo $model->name; ?></h3>
</legend>

<table id="yw0" class="detail-view table table-striped table-condensed">
    <tbody>
        <tr class="odd">
            <th>Name</th><td><?php echo $model->name ?></td>
        </tr>
        <tr class="even">
            <th>Description</th><td><?php echo $model->description ?></td>
        </tr>
        <?php if(isset($model->selfRelation)) { ?>
        <tr class="even">
            <th>Parent Module</th><td><?php if(isset($model->selfRelation)) echo $model->selfRelation->name ?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>

<div class="form-actions">
    <a href="<?php echo $this->createUrl('userLevel/update', array('id'=> $model->id)) ?>" class="btn btn-primary">Edit</a>
    <a href="<?php echo $this->createUrl('userLevel/index') ?>" class="btn">Close</a>
</div>