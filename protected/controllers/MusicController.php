<?php

class MusicController extends Controller
{
	public $layout='//layouts/column3';

	// Uncomment the following methods and override them if needed

	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
				'accessControl', // perform access control for CRUD operations
				'postOnly + delete', // we only allow deletion via POST request
		);
	}

	public function actionMusic()
	{

		/* $music=new Book();

		$music->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$music->attributes=$_GET['Book'];

		$this->render('music',array(
				'music'=>$music,
		)); */
		$results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->leftJoin('member', 'book.member_id = member.id')-> where('book.category_id=5')-> order ('book.id DESC')-> queryAll();
		$this->render('music',array(
				'music'=>$results
		));
	}

	public function actionView($id)
	{
		$this->render('view',array(
				'music'=>$this->loadModel($id),
		));
	}
	public function actionReportBook($id)
	{
		//$healthAndBeauty = new HealthAndBeauty;
		$music=$this->loadModel($id);
		$report= new ReportBook;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['ReportBook']))
		{
			$music->attributes=$_POST['ReportBook'];
			$report->attributes=$_POST['ReportBook'];

			$report->book_id = $music->id;
			$report->dateReport = date('Y-m-d H:i:s');
			$report->status = 1;
			$report->user_id = Yii::app()->user->id;

			if($report->save())
				$this->redirect(array('music'));
		}

		$this->render('reportBook',array(
				'music'=>$music,
				'report'=>$report,
		));

	}

	public function loadModel($id)
	{
		$model=Book::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param MyMedia $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='my-media-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}



}