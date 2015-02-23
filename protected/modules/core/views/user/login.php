<br/><br/><br/><br/><br/><br/>
<div class="row">
    <div class="span8">
        <h1>Sistem Informasi Tanaman</h1>
        <p>Description</p>
    </div>
</div>

<?php
    $module = Yii::app()->getModule('core');
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
)); ?>

<div class="row-fluid">
    <div class="span8">
        <div id="myCarousel" class="carousel slide">
            <!-- Carousel items -->
            <div class="carousel-inner">
                <div class="item"><img src='<?php echo $module->getImage('/images/photo1.png'); ?>'/></div>
                <div class="item active"><img src='<?php echo $module->getImage('/images/photo2.png'); ?>'/></div>
            </div>
            <!-- Carousel nav -->
            <a class="carousel-control left" href="#myCarousel" data-slide="prev">&lsaquo;</a>
            <a class="carousel-control right" href="#myCarousel" data-slide="next">&rsaquo;</a>
        </div>
    </div>
    <div class="span4">
        <div class="well">
            <h4>Login
                <small>, authenticate with your credential</small>
            </h4>
            <hr/>
            <form class="form-horizontal" action="<?php echo Yii::app()->createUrl('core/user/login'); ?>" method="POST">
                <div class="control-group">
                    <?php echo $form->textFieldRow($model,'username',array('class'=>'input-block-level', 'labelOptions'=>array('label'=>' <i class="icon-user"></i> Username'))); ?>
                </div>
                <div class="control-group">
                    <?php echo $form->passwordFieldRow($model,'password', array('class'=>'input-block-level', 'labelOptions'=>array('label'=>' <i class="icon-lock"></i> Password'))); ?>
                </div>
                <br/>
                <input class="btn btn-primary" type="submit" value="Login">
                <input type="reset" class="btn" value="Reset">
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function(){
        $('.carousel').carousel({
            interval: 5000
        });
    });
</script>

<?php
   $this->endWidget(); 
?>