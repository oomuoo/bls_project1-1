<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

$this->pageTitle=Yii::app()->name . ' - Login';
$this->breadcrumbs=array(
	'เข้าสู่ระบบ',	
);
?>

<h1>กรุณาเข้าสู่ระบบ</h1>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<p class="note">ช่องที่มี <span class="required">*</span> ต้องกรอกข้อมูลให้ครบถ้วน</p>

	<div class="row">
		<?php echo $form->labelEx($model,'username'); ?>
		<?php echo $form->textField($model,'username'); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

<!--  
	<div class="row rememberMe">
		<?php //echo $form->checkBox($model,'rememberMe'); ?>
		<?php //echo $form->label($model,'rememberMe'); ?>
		<?php //echo $form->error($model,'rememberMe'); ?>
	</div>
-->
		
	<div class="row buttons">
		<?php $this->widget('ext.bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'เข้าสู่ระบบ')); ?>
	</div>

<?php $this->endWidget(); ?>
</div><!-- form -->
