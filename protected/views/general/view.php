
<?php 
	$this->breadcrumbs=array(
			'ทั่วไป'=>array('general'),
			'ชื่อหนังสือ '.$general->name,
			
	);
?>

<div class="btn-toolbar">
<?php $this->widget('bootstrap.widgets.TbButton', array(
'label'=>'แจ้งหนังสือไม่เหมาะสม',
'type'=>'danger',
'url'=>'index.php?r=general/reportBook&id='.$general->id,
)); ?>
</div>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$general,
	'attributes'=>array(
		//'id',
		'name',
		'create_date',
		'update_date',
		'category.name',
		'type.name',
		//'status',
		array(
			'name'=>'status',
			'value'=>$general->status == 'P'?'สาธารณะ':'M'?'เฉพาะสมาชิก':'เฉพาะผู้เขียน'
		),
		'member.alias',

		array(
			'name'=>'picture',
			'type'=>'html',
			'value'=>($general->picture)?CHtml::image(
					Yii::app()->request->baseUrl.'/images/book_img/'
					.$general->picture,'',
					array('width'=>200,'height'=>250)):CHtml::image(
							Yii::app()->request->baseUrl.'/images/book_img/noimage.jpg'
							,'',array('width'=>200,'height'=>150)),
			), // show image on view
		
		array(
			'name'=>'description',
			'type'=>'html',// show form text html format
			'value'=>$general->description,
		),
			
	),
)); ?>
<br />
<center>
<?php $this->widget('bootstrap.widgets.TbButton', array(
'label'=>'ย้อนกลับ',
'type'=>'success',
'url'=>'index.php?r=general/general',
)); ?>
</center>

