<?php
/* @var $this ReportBookController */
/* @var $model ReportBook */

$this->breadcrumbs=array(
	'รายการหนังสือที่ไม่เหมาะสม'=>array('index'),
	$model->id,
);


$this->menu=array(
	array('label'=>'รายการหนังสือที่ไม่เหมาะสม', 'url'=>array('index')),	
	array('label'=>'ดูรายละเอียดหนังสือที่ได้รับการรายงาน', 'url'=>array('manage_book/view','id'=>$model->book_id)),
);
?>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'book.name',
		'comment',
		'dateReport',
		'user.usename',
	),
)); ?>
