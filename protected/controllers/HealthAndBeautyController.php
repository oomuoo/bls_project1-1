<?php

class HealthAndBeautyController extends Controller
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
	 public function actionHealthAndBeauty()
	{
	
		$healthAndBeauty=new Book();
	
		$healthAndBeauty->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$healthAndBeauty->attributes=$_GET['Book'];
	
		$this->render('healthAndBeauty',array(
				'healthAndBeauty'=>$healthAndBeauty,
		));
			
	} 
	*/
	public  function  actionHealthAndBeauty()
	{
		/*$sql_book = "book.id,book.category_id,book.create_date,book.description,book.member_id,member.alias AS Alias";
		$from ="book LEFT JOIN member ON book.member_id = member.id";
		$where ="book.category_id=2";*/
		// $healthAndBeauty=new Book();
		
		//$model=new HealthAndBeauty('search');
		
		 $results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->leftJoin('member', 'book.member_id = member.id')-> where('book.category_id=2')-> order ('book.id DESC')-> queryAll();
		 $this->render('healthAndBeauty',array(
				'healthAndBeauty'=>$results
		));
		
	}
	
public function actionDownload($id)
	{
		//$results = Yii::app()->db->createCommand()-> select('book.id as book_id, files.id as files_id,  book.file_id as bookfile_id, files.path')-> from('book')->JOIN('files', 'book.file_id=files.id;')-> where('book.file_id=files.id;')-> queryAll();
		//$this->render('healthAndBeauty',array(
				//'healthAndBeauty'=>$results
		//));
		
	
		$download=new Book();
	
		$download->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$download->attributes=$_GET['Book'];
	
		$this->render('download',array(
				'download'=>$this->loadModel($id),
		));
	}
	
	
	public function actionIndex3($id)
	{
		//$results = Yii::app()->db->createCommand()-> select('book.id as book_id, files.id as files_id,  book.file_id as bookfile_id, files.path')-> from('book')->JOIN('files', 'book.file_id=files.id;')-> where('book.file_id=files.id;')-> queryAll();
		//$this->render('healthAndBeauty',array(
				//'healthAndBeauty'=>$results
		//));
		
	
		$index3=new Book();
	
		$index3->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$index3->attributes=$_GET['Book'];
	
		$this->render('index3',array(
				'index3'=>$this->loadModel($id),
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
		$healthAndBeauty=$this->loadModel($id);
		$bookshelf = new  Bookshelf;
	
		if(isset($_POST['Bookshelf']))
		{
			$healthAndBeauty->attributes=$_POST['Bookshelf'];
			$bookshelf->attributes=$_POST['Bookshelf'];
	
			$bookshelf->book_id = $healthAndBeauty->id;
			$bookshelf->member_id = Yii::app()->user->id;
	
			if($bookshelf->save())
				$this->redirect(array('bookshelf/index'));
		}
	
		$this->render('view',array(
				'healthAndBeauty'=>$this->loadModel($id),
				'bookshelf'=>$bookshelf,
		));
		/*
		 $healthAndBeauty=$this->loadModel($id);

		$results = Yii::app()->db->createCommand()-> select('book.id, book.category_id,book.create_date, book.description, book.member_id, book.picture, book.name, member.alias')-> from('book')->rightJoin('member', 'book.member_id = member.id')-> where('book.id=')-> queryAll();
		$this->render('view',array(
				'healthAndBeauty'=>$results,
		));  */
		 
	}
	
	
	
	public function actionReportBook($id)
	{
		//$healthAndBeauty = new HealthAndBeauty;
		$healthAndBeauty=$this->loadModel($id);
		$report= new ReportBook;
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['ReportBook']))
		{
			$healthAndBeauty->attributes=$_POST['ReportBook'];
			$report->attributes=$_POST['ReportBook'];

			$report->book_id = $healthAndBeauty->id;
			$report->dateReport = date('Y-m-d H:i:s');
			$report->status = 1;
			$report->user_id = Yii::app()->user->id;
	
			if($report->save())
				$this->redirect(array('healthAndBeauty'));
		}
	
		$this->render('reportBook',array(
				'healthAndBeauty'=>$healthAndBeauty,
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