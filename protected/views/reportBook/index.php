<?php
/* @var $this ReportBookController */
/* @var $model ReportBook */

$this->breadcrumbs=array(
	'รายการหนังสือที่ไม่เหมาะสม'=>array('index'),
);


Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$('#report-book-grid').yiiGridView('update', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<div>
<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id'=>'searchForm',
    'type'=>'search',
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<?php echo $form->textFieldRow($model, 'book_id', array('class'=>'input-medium', 'prepend'=>'<i class="icon-search"></i>')); ?>
<?php $this->widget('ext.bootstrap.widgets.TbButton', array('buttonType'=>'submit', 'label'=>'ค้นหา')); ?>
<?php $this->endWidget(); ?>
</div>

<?php $this->widget('ext.bootstrap.widgets.TbGridView', array(
	'id'=>'report-book-grid',
	'template' => '{pager}{items}{pager}',
	'dataProvider'=>$model->search(),
	'columns'=>array(
		array(
			'name'=>'book_id',
			'type'=>'html',
			'value'=>'$data->status?"<strong>".$data->book_id."</strong>":$data->book_id',
		),
		array(
			'name'=>'comment',
			'type'=>'html',
			'value'=>'$data->status?"<strong>".$data->comment."</strong>":$data->comment',
		),
		array(
			'name'=>'dateReport',
			'type'=>'html',
			'value'=>'$data->status?"<strong>".$data->dateReport."</strong>":$data->dateReport',
		),
		array(
			'name'=>'user_id',
			'type'=>'html',
			'value'=>'$data->status?"<strong>".$data->user_id."</strong>":$data->user_id',
		),
				array(
					'class'=>'ext.bootstrap.widgets.TbButtonColumn',
					'htmlOptions'=>array('style'=>'width: 50px'),
					'template'=>'{view}{delete}{reply}',

					'buttons' => array(
						'reply' => array( //the name {reply} must be same
						'label' => 'stop', // text label of the button
						'url' => 'CHtml::normalizeUrl(array("dashboard/mail/id/".rawurlencode($data->book_id)."/f_id/".$data->book_id))', //Your URL According to your wish
						'imageUrl' => Yii::app()->baseUrl . '/images/iconnn.png', // image URL of the button. If not set or false, a text link is used, The image must be 16X16 pixels
						
						),
					),
					
				),

		),
)); ?>

