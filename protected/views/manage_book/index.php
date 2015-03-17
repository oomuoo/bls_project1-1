<?php
/* @var $this MyMediaController */
/* @var $model MyMedia */

$this->breadcrumbs=array(
	'จัดการรายการหนังสือ'=>array('index'),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#my-media-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h2>จัดการรายการหนังสือ</h2>

<div>
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	 'id'=>'searchForm',
    'type'=>'search',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

<?php //echo $form->textFieldRow($model,'name', array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>')); ?>
<?php //$this->widget('ext.bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'ค้นหา')); ?>
<?php $this->endWidget(); ?>
</div>


<?php $this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'book-grid',
	'dataProvider'=>$model->searchForAll(),
	//'template' => '{pager}{items}{pager}',
	'columns'=>array(
		'id',
		'name',
		'create_date',
		'update_date',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 30px'),
			'template'=>'{view}{delete}',
			),
		),
)); ?>


		