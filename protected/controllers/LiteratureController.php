<?php

class literatureController extends Controller
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
	
	/* public function accessRules()
	{
		return array(
				array('allow',  // allow all users to perform 'index' and 'view' actions
						'actions'=>array('index','view'),
						'users'=>array('*'),
				),
				array('allow', // allow authenticated user to perform 'create' and 'update' actions
						'actions'=>array('create','update'),
						'users'=>array('*'),
				),
				array('allow', // allow admin user to perform 'admin' and 'delete' actions
						'actions'=>array('admin','delete'),
						'users'=>array('*'),
				),
				array('deny',  // deny all users
						'users'=>array('*'),
				),
		);
	} */
	/*
	 public function actionliterature()
	{
	
		$literature=new Book();
	
		$literature->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$literature->attributes=$_GET['Book'];
	
		$this->render('literature',array(
				'literature'=>$literature,
		));
			
	} 
	*/
	public  function  actionliterature()
	{
		/*$sql_book = "book.id,book.category_id,book.create_date,book.description,book.member_id,member.alias AS Alias";
		$from ="book LEFT JOIN member ON book.member_id = member.id";
		$where ="book.category_id=2";*/
		// $literature=new Book();
		
		//$model=new literature('search');
		
		 $results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->leftJoin('member', 'book.member_id = member.id')-> where('book.category_id=1')-> order ('book.id DESC')-> queryAll();
		 $this->render('literature',array(
				'literature'=>$results
		));
		
	}
	
	public function actionIndex()
	{
		//$this->layout='column2';
		$model=new ReportBook('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['ReportBook']))
			$model->attributes=$_GET['ReportBook'];
	
		$this->render('index',array(
				'model'=>$model,
		));
	}
	
	public function actionView($id)
	{
		 $this->render('view',array(
				'literature'=>$this->loadModel($id),
		)); 
		/*
		 $literature=$this->loadModel($id);

		$results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->rightJoin('member', 'book.member_id = member.id')-> where('book.id=')-> queryAll();
		$this->render('view',array(
				'literature'=>$results,
		));  */
		 
	}
	
	public function actionBookshelf($id)
	{
		$literature=$this->loadModel($id);
		$bookshelf = new Bookshelf;
		
		$ID_User = Yii::app()->session['_id'];
		if(isset($_POST['Bookshelf']))
		{
			$literature->attributes=$_POST['Bookshelf'];
			$bookshelf->attributes=$_POST['Bookshelf'];
			
			$bookshelf->book_id = $literature->id;
			$bookshelf->member_id = Yii::app()->user->id;
			
			if($bookshelf->save())
				$this->redirect(array('bookshelf/index'));
		}
		
		$this->render('bookshelf',array(
				'literature'=>$literature,
				'bookshelf'=>$bookshelf,
		));
			
	}
	
	public function actionReportBook($id)
	{
		//$literature = new literature;
		$literature=$this->loadModel($id);
		$report= new ReportBook;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['ReportBook']))
		{
			$literature->attributes=$_POST['ReportBook'];
			$report->attributes=$_POST['ReportBook'];

			$report->book_id = $literature->id;
			$report->dateReport = date('Y-m-d H:i:s');
			$report->status = 1;
			$report->user_id = Yii::app()->user->id;
	
			if($report->save())
				$this->redirect(array('literature'));
		}
	
		$this->render('reportBook',array(
				'literature'=>$literature,
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