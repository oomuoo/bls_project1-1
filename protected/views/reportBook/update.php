<?php
/* @var $this ReportBookController */
/* @var $model ReportBook */

$this->breadcrumbs=array(
	'Report Books'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List ReportBook', 'url'=>array('index')),
	array('label'=>'Create ReportBook', 'url'=>array('create')),
	array('label'=>'View ReportBook', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage ReportBook', 'url'=>array('admin')),
);
?>

<h1>Update ReportBook <?php echo $model->id; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>