<?php

class biographyController extends Controller
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
	 public function actionbiography()
	{
	
		$biography=new Book();
	
		$biography->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$biography->attributes=$_GET['Book'];
	
		$this->render('biography',array(
				'biography'=>$biography,
		));
			
	} 
	*/
	public  function  actionbiography()
	{
		/*$sql_book = "book.id,book.category_id,book.create_date,book.description,book.member_id,member.alias AS Alias";
		$from ="book LEFT JOIN member ON book.member_id = member.id";
		$where ="book.category_id=2";*/
		// $biography=new Book();
		
		//$model=new biography('search');
		
		 $results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->leftJoin('member', 'book.member_id = member.id')-> where('book.category_id=3')-> order ('book.id DESC')-> queryAll();
		 $this->render('biography',array(
				'biography'=>$results
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
				'biography'=>$this->loadModel($id),
		)); 
		/*
		 $biography=$this->loadModel($id);

		$results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->rightJoin('member', 'book.member_id = member.id')-> where('book.id=')-> queryAll();
		$this->render('view',array(
				'biography'=>$results,
		));  */
		 
	}
	
	public function actionBookshelf($id)
	{
		$biography=$this->loadModel($id);
		$bookshelf = new Bookshelf;
		
		$ID_User = Yii::app()->session['_id']; 
		if(isset($_POST['Bookshelf']))
		{
			$biography->attributes=$_POST['Bookshelf'];
			$bookshelf->attributes=$_POST['Bookshelf'];
			
			$bookshelf->book_id = $biography->id;
			$bookshelf->member_id = Yii::app()->user->id;
			
			if($bookshelf->save())
				$this->redirect(array('bookshelf/index'));
		}
		
		$this->render('bookshelf',array(
				'biography'=>$biography,
				'bookshelf'=>$bookshelf,
		));
			
	}
	
	public function actionReportBook($id)
	{
		//$biography = new biography;
		$biography=$this->loadModel($id);
		$report= new ReportBook;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['ReportBook']))
		{
			$biography->attributes=$_POST['ReportBook'];
			$report->attributes=$_POST['ReportBook'];

			$report->book_id = $biography->id;
			$report->dateReport = date('Y-m-d H:i:s');
			$report->status = 1;
			$report->user_id = Yii::app()->user->id;
	
			if($report->save())
				$this->redirect(array('biography'));
		}
	
		$this->render('reportBook',array(
				'biography'=>$biography,
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