<?php
/* @var $this BookController */
/* @var $model Book */
/* @var $form CActiveForm */

?>
<!DOCTYPE html>
<html lang="en" class="no-js">
<head>
<meta charset="UTF-8" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>เงื่อนไขการสร้างหนังสือ</title>
<meta name="description" content="Nifty Modal Window Effects with CSS Transitions and Animations" />
<meta name="keywords" content="modal, window, overlay, modern, box, css transition, css animation, effect, 3d, perspective" />
<meta name="author" content="Codrops" />
<link rel="shortcut icon" href="../favicon.ico">

<link rel="stylesheet" type="text/css" href="cssCon/component.css" />
<script src="jsCon/modernizr.custom.js"></script>
</head>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'book-form',
	'htmlOptions'=>array('enctype'=>'multipart/form-data'),
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">ช่องที่มี <span class="required">*</span> ต้องกรอกข้อมูลให้ครบถ้วน</p>
	<span class="header-line"></span> <br />
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->errorSummary($path); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>45,'maxlength'=>45)); ?>
		<?php //echo $form->error($model,'name'); ?>
	</div>

	<div class="row">	
		<?php echo $form->labelEx($path,'path'); ?>
		<?php echo $form->fileField($path,'path'); ?>
		<?php //echo $form->error($path,'path'); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php $this->widget('ext.yii-ckeditor.CKEditorWidget', array(

				'attribute'=>'description', // map with filed in table major
				'model'=>$model,
			));			
		//echo $form->textField($model,'description',array('size'=>50,'maxlength'=>255)); ?>		
		<?php //echo $form->error($model,'description'); ?>
	</div>

	
	<div class="row">
		<?php echo $form->labelEx($model,'category_id'); ?>
		<?php echo $form->dropDownList($model,'category_id',$model->getcategory(),
			array(
				'class'=>'span5',
				'prompt'=>'Select Category',
				'ajax'=>array(
					'type'=>'POST',
					'url'=>CController::createUrl('book/ChangeCategory'),
					'dataType'=>'json',
					'data'=>array('category_id'=>'js:this.value'),
					'beforeSend' => 'function(){
						$("#myajax").addClass("loading");}',
					'complete' => 'function(){
						$("#myajax").removeClass("loading");}',
					'success'=>'function(data) {
					    $("#Book_type_id").html(data.dropDownType);
					 }',
				)
			)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'type_id'); ?>
		<?php echo $form->dropDownlist($model,'type_id', empty($model->category_id)?array():$model->gettype(),
			array(
				'class'=>'span5','maxlength'=>45,
				'prompt'=>'Select District'
				
			)); ?>
	</div>
	
	<div class="row">
		<?php echo $form->labelEx($model,'member_id'); ?>
		<?php echo $form->dropDownList($model,'member_id', CHtml::listData(Member::model()->findAllByAttributes(array('id'=>Yii::app()->user->id)),
											'id', 'alias'));
											//array('prompt'=>'นามปากกา')); 
		//<?php echo $form->textField($model,'category',array('size'=>60,'maxlength'=>150)); ?>
		<?php //echo $form->error($model,'member.alias'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'picture'); ?>
		<?php echo CHtml::image(Yii::app()->request->baseUrl.'/images/'.$model->picture,'',array('width'=>120,'height'=>150));?>
		<br />
		<?php echo $form->fileField($model,'picture'); ?>
		<?php //echo $form->error($model,'picture'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->radioButtonList($model,'status',array('P'=>'สาธารณะ', 'M'=>'เฉพาะสมาชิก', 'W'=>'เฉพาะผู้เขียน',), // ถ้าไม่ใส่ style ให้มัน ก็ได้ แต่ format ที่ออกมาจะไม่สวย 
															array(
																'separator'=>'',
																'labelOptions'=>array(
																	'style'=>'display:inline;padding-right:15px',))); // padding-right:15px คือ กำหนดให้ระยะห่างระหว่าง แต่ละตัวห่สงกัน 15 
		//<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>150)); ?>
		<?php //echo $form->error($model,'status'); ?>
	</div>
	<br />
	<div class="rows-button">
			<div class="md-modal md-effect-1" id="modal-1">
				<div class="md-content">
				<div class="md-trigger" data-modal="modal-1">
				<h3>เงื่อนไขการสร้างหนังสือ</h3>
				<div>
				<p>กรณีที่คุณต้องการอัพโหลดไฟล์หนังสือขึ้นไปบนระบบของเรา คุณต้องทำความเข้าใจและปฏิบัตตามเงื่อนไขดังนี้:</p>
				<ul>
				<li><strong>ข้อที่ 1:</strong> กรณีที่ทางระบบตรวจพบหนังสือที่ไม่เหมาะสมในด้านเนื้อหา รูปภาพ ทางระบบจะลบ หรือระงับการเผยแพร่หนังสือเล่มนั้นทันที โดยไม่ต้องแจ้งให้ทราบล่วงหน้า.</li>
				<li><strong>ข้อที่ 2:</strong> หากมีการพบเจอว่าหนังสือที่ท่านนำมาเผยแพร่ มีการละเมิดลิขสิทธ์ต่างๆ ทางระบบจะไม่ขอรับผิดชอบใดๆทั้งสิ้น ความเสียหายทุกอย่างจะตกไปอยู่ที่ผู้กระทำทันที.</li>
				
				</ul>
							
							<script type="text/javascript">

							function showHide()
							{
								if(document.getElementById("agree").checked)
								{
									document.getElementById('content').style.display = 'block';
								}
								 else
								{
									document.getElementById('content').style.display = 'none';
								}
							} 

							</script>
							
							<input type="checkbox" name="agree" id="agree" onclick="showHide();" /><b> : ยอมรับเงื่อนไข</b>
							
							<div class="md-close" align="center" >
								<?php echo CHtml::resetButton($model->isNewRecord ? 'ยกเลิก' : 'Cancel'); ?>						
							</div>
							<div class="md-close" align="center" style="display:none;" id="content">
								<?php echo CHtml::submitButton($model->isNewRecord ? 'ตกลง' : 'Save'); ?>
								<?php //echo CHtml::resetButton($model->isNewRecord ? 'ยกเลิก' : 'Cancel'); ?>						
							</div>
							
						</div>
					</div>
			</div>
		</div>
		
		<?php $this->endWidget(); ?>
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'บันทึกข้อมูล' : 'Save'); ?>
		<?php echo CHtml::resetButton($model->isNewRecord ? 'ยกเลิก' : 'Cancel'); ?>		
		</div>

			<div class="md-trigger" data-modal="modal-1">
						<?php echo CHtml::submitButton($model->isNewRecord ? 'บันทึกข้อมูล' : 'Save'); ?>
						<?php //echo CHtml::resetButton($model->isNewRecord ? 'ยกเลิก' : 'Cancel'); ?>
						
			</div>
			
										
								
			<div class="md-overlay"></div><!-- the overlay element -->

										<!-- classie.js by @desandro: https://github.com/desandro/classie -->
										<script src="jsCon/classie.js"></script>
										<script src="jsCon/modalEffects.js"></script>

										<!-- for the blur effect -->
										<!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
										<script>
										// this is important for IEs
			var polyfilter_scriptpath = '/jsCon/';
		</script>
		<script src="jsCon/cssParser.js"></script>
		<script src="jsCon/css-filters-polyfill.js"></script>
	
</div><!-- form -->	
</html>