<?php
/* @var $this ReportBookController */
/* @var $model ReportBook */

$this->breadcrumbs=array(
	'Report Books'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List ReportBook', 'url'=>array('index')),
	array('label'=>'Manage ReportBook', 'url'=>array('admin')),
);
?>

<h1>Create ReportBook</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>