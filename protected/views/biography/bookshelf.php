
<div class="form">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'report-book-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($biography,'id'); ?>
		<?php echo $form->textField($biography,'id',array('readonly' => true)); ?>
		<?php echo $form->error($biography,'id'); ?>
	</div>	
	<div class="row">
		<?php echo $form->hiddenField($bookshelf, 'id'); ?>
		<?php echo $form->error($bookshelf, 'id'); ?>
	</div>
	
		
<div style="margin-left: 125px"><?php echo CHtml::submitButton('ยืนยัน'); ?></div>

<?php $this->endWidget(); ?>

</div><!-- form -->