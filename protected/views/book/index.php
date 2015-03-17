<?php
/* @var $this BookController */
/* @var $model Book */

		$this->breadcrumbs=array(
			'รายการหนังสือ',
		);
		
		$this->menu=array(
			array('label'=>'สร้างหนังสือ', 'url'=>array('create')),
		);

		Yii::app()->clientScript->registerScript('search', "
		$('.search-button').click(function(){
			$('.search-form').toggle();
			return false;
		});
		$('.search-form form').submit(function(){
			$('#adviser-grid').yiiGridView('update', {
				data: $(this).serialize()
			});
			return false;
		});
		");

?>

<h1>จัดการข้อมูลหนังสือ</h1>

<div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model, 'name', array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>')); ?>
<?php $this->widget('ext.bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'ค้นหา')); ?>
<?php $this->endWidget(); ?>
</div>

<?php 
	$this->widget('bootstrap.widgets.TbGridView', array(
	'id'=>'book-grid',
	'dataProvider'=>$model->search(),
	//'filter'=>$model,
	'columns'=>array(
		//'id',
		'name',
		'create_date',
		'update_date',
		//'description',
		//'category_id',
		
		//'picture',
		array(
			'name'=>'status',
			'value'=>'$data->status'
		),
		//'member.alias',
		//'score_id',
		//'type_id',
		
		array(
			'class'=>'bootstrap.widgets.TbButtonColumn',
			'htmlOptions'=>array('style'=>'width: 50px'),
			'template'=>'{view}{update}{delete}',
		),
	),
)); ?>

