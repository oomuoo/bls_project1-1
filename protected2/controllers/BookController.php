<?php
class BookController extends Controller
{
	public $layout='//layouts/column2';
	
	// View
	public function actionView($id)
	{
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	// Create
	public function actionCreate()
	{
		$model=new Book;
		
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];
			
			$model->create_date = date('Y-m-d H:i:s');
			//$model->update_date = date('Y-m-d H:i:s');
			$model->member_id = Yii::app()->user->id;
			
			$valid = $model->validate();
				
			if($valid){

				// keep file to $image
				if($file = CUploadedFile::getInstance($model,'file'))
				{
					// path for file upload
					//$path = Yii::getPathOfAlias('webroot').'/images/book_img/';
					$pathfile = Yii::getPathOfAlias('webroot').'/files/';
					// use image name as username
					//$filename = $model->id.'.'.$image->getExtensionName();
					$filename1 = $model->name.'.'.$file->getExtensionName();
					// uploaded image to path
					//$image->saveAs($path.$filename);
					$file->saveAs($pathfile.$filename1);
					
					// path for file upload
					
				}else
					// this for no image file upload
					//$filename = 'book_img/noimage.jpg';
					// set another user attribute
					//$model->picture = $filename;
					// insert userProfile
				
			if($model->save(false))
				// path for file upload
				$pathfile = Yii::getPathOfAlias('webroot').'/files/';

				$this->exportPdf($model, $pathfile);
				
				$this->redirect(array('view','id'=>$model->id));
			}
		
		}
	
		$this->render('create',array(
				'model'=>$model,
		));
	}
	
	public function exportPdf($book, $pathfile)
	{
		# mPDF
		$mPDF1 = Yii::app()->ePdf->mpdf();
		# set header
		$mPDF1 -> defaultheaderline = 0;
		$mPDF1 -> defaultheaderfontstyle = 'I';
		$mPDF1 -> setHeader('||exported date : {DATE j-m-Y}');
			# set page number on the footer
		$mPDF1 -> pagenumPrefix = 'Page ';
		$mPDF1 -> pagenumSuffix = ' of ';
		$mPDF1 -> defaultfooterline = 0;
		$mPDF1 -> defaultfooterfontstyle = 'I';
		$mPDF1 -> setFooter('||{PAGENO}{nb}');
		# set support Thai font
		$mPDF1->SetAutoFont(AUTOFONT_ALL);
		# don't need complex table
		//$mpdf1 -> simpleTables = true;
		# not mind the extra processing time
		//$mpdf1 -> packTableData = true;
		
		$mPDF1->WriteHTML($book->file);
		
		# Outputs ready PDF
		//$time = date("d_m_Y", strtotime(date("D M j G:i:s T Y")));
		//$mPDF1->Output('all_products_'.$time.'.pdf',EYiiPdf::OUTPUT_TO_DOWNLOAD);
		$filename = iconv('UTF-8','windows-874', $book->name);
		$mPDF1->Output($pathfile.$filename1.'.pdf', EYiiPdf::OUTPUT_TO_FILE);
		//exit;
	}
	
	// Update
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Book']))
		{
			$model->attributes=$_POST['Book'];
			
			//$model->create_date = date('Y-m-d H:i:s');
			$model->update_date = date('Y-m-d H:i:s');
			$model->member_id = Yii::app()->user->id;
			$valid = $model->validate();
				
			if($valid){
				// keep file to $image
				if($image = CUploadedFile::getInstance($model,'picture'))
				{
					// path for file upload
					$path = Yii::getPathOfAlias('webroot').'/images/book_img/';
					// use image name as username
					$filename = $model->id.'.'.$image->getExtensionName();
					// uploaded image to path
					$image->saveAs($path.$filename);
					$model->picture = $filename;
					// path for file upload
									
				}
					// this for no image file upload
					//$filename = 'book_img/noimage.jpg';
					// set another user attribute
					
					// insert userProfile
				
			if($model->save(false))
				
				$path = Yii::getPathOfAlias('webroot').'/files/';
				
				$this->exportPdf($model, $path);
					
				$this->redirect(array('view','id'=>$model->id));
				
				//$this->redirect(array('view','id'=>$model->id));
			}
		
		}
	
		$this->render('update',array(
				'model'=>$model,
		));
	}
	
	// Delete
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
	
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('index'));
	}
	

	public function actionIndex()
	{
		$model=new Book('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$model->attributes=$_GET['Book'];
		
		$this->render('index',array(
				'model'=>$model,
		));
	}
	
	public function loadModel($id)
	{
		$model=Book::model()->findByPk($id);
		
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='book-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function actionChangeCategory()
	{
		$type =Type::model()->findAll('category_id=:category_id',
				array(':category_id'=>(int) $_POST['category_id']));
	
		$type = CHtml::listData($type,'id','name');
		$dropDownType = "<option value=''>Select Type</option>";
		foreach($type as $value=>$name)
			$dropDownType .= CHtml::tag('option', array('value'=>$value),CHtml::encode($name),true);
	
		echo CJSON::encode(array(
				'dropDownType'=>$dropDownType,
		));
	}
	
}