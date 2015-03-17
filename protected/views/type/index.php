<?php
/* @var $this TypeController */
/* @var $model Type */

$this->breadcrumbs=array(
	'การจัดการประเภทหนังสือ',
);

$this->menu=array(
	array('label'=>'สร้างประเภทหนังสือ', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#type-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'searchForm',
    'type'=>'search',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php echo $form->textFieldRow($model,'name', array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>')); ?>
<?php $this->widget('ext.bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'ค้นหา')); ?>
<?php $this->endWidget(); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'type-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		'id',
		'name',
		'category.name',
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'template'=>'{view}{update}{delete}',
		),
	),
)); ?>
