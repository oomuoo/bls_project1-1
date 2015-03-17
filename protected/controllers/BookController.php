<?php
class BookController extends Controller
{
	public $layout='//layouts/column2';
	
	// View
	public function actionView($id)
	{
		//print_r($_FILES);
		$this->render('view',array(
				'model'=>$this->loadModel($id),
		));
	}
	
	public function actionCondition()
	{
		$model=new Book('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Book']))
			$model->attributes=$_GET['Book'];
	
		$this->render('condition',array(
				'model'=>$model,
		));
	}
	
	// Create
	public function actionCreate()
	{
		$model=new Book;
		
		$path=new Files();
		
		//print_r($_POST);
		//exit();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
		if(isset($_POST['Book']))
		{
			//print_r($_POST['Book']);
			//exit();
			$model->attributes=$_POST['Book'];
			
			$path->attributes=$_POST['Files'];
			
			$model->create_date = date('Y-m-d H:i:s');
			//$model->update_date = date('Y-m-d H:i:s');
			$model->member_id = Yii::app()->user->id;
			
			$valid = $model->validate();
			//$valid = $path->validate() && $valid;
				
			if($valid){
								
				//print_r($_FILES);
				//print_r($_FILES['Files']);
				//exit();
				// keep file to $image
				
				if($image = CUploadedFile::getInstance($model,'picture'))
				{
					//print_r($model);
					// path for file upload
					$pathimg = Yii::getPathOfAlias('webroot').'/images/book_img/';
					// use image name as username
					$filename = $model->name.'.'.$image->getExtensionName();
					echo $filename;
					//exit();
					// uploaded image to path
					$image->saveAs($pathimg.$filename);
					$model->picture = $filename;
					// path for file upload
						
				}else
					// this for no image file upload
					$filename = 'book_img/noimage.jpg';
					// set another user attribute
						
					// insert userProfile
				
				
				
				if($file = CUploadedFile::getInstance($path,'path'))
					{
						// path for file upload
						$pathfile = Yii::getPathOfAlias('webroot').'/files/';
						//$pathimg = Yii::getPathOfAlias('webroot').'/images/book_img/';
							
						// use image name as username
						$filename1 = $model->name.'.'.$file->getExtensionName();
						//$filename = $model->id.'.'.$image->getExtensionName();
							
						// uploaded image to path
						$file->saveAs($pathfile.$filename1);
						//$image->saveAs($pathimg.$filename);
							
						// path for file upload
							
					}else
						// this for no image file upload
						$filename1 = 'nofile.pdf';
						//$filename = 'book_img/noimage.jpg';
						// set another user attribute
						$path->path = $filename1;
						//$model->picture = $filename;
						// insert userProfile

				//$path->file_id = $model->id;
				if(($path->save())&&($model->save()))
				
					//$pathfile = Yii::getPathOfAlias('webroot').'/files/';
					
					//$this->exportPdf($model, $pathfile);
				
					$model->file_id = $path-> id;
					$model->save();
						
					$this->redirect(array('view','id'=>$model->id));
					
					//$this->redirect(array('view','id'=>$model->id));
				}
		
			}
			
/*			
			$pathF = Yii::app()->basePath . '/files/';
			if (!is_dir($pathF)) {
				mkdir($pathF);
			}
			
			if(isset($_POST['Files'])) {
				//print_r($_POST);
				//exit();
				$path->attributes = $_POST['Files'];
				if (@!empty($_FILES['Files']['name']['path'])) {
					$path->path = $_POST['Files']['path'];
					if ($path->validate(array('path'))) {
						$path->path = CUploadedFile::getInstance($path, 'path');
					} else {
						$path->path = '';
					}
			
					$path->path->saveAs($pathF . '/' . time() . '_' . str_replace(' ', '_', strtolower($path->path)));
			
					$path->path = $path->path->getType();
					//$model->doc_size = $model->doc_file->getSize();
				}
			
				$path->path = time() . '_' . str_replace(' ', '_', strtolower($path->path));
			
				if ($path->save()) {
					$this->redirect(array('view', 'id' => $path->id));
				}
			}

*/

		/*
			if(isset($_POST['Files']))
			{
				//$model->attributes=$_POST['Book'];
					
				$path->attributes=$_POST['Files'];
					
				//$model->create_date = date('Y-m-d H:i:s');
				//$model->update_date = date('Y-m-d H:i:s');
				//$model->member_id = Yii::app()->user->id;
					
				$valid = $path->validate();
				//$valid = $path->validate() && $valid;
			
				if($valid){
			
					//print_r($_FILES);
					//print_r($_FILES['Files']);
					//exit();
					// keep file to $image
					if($file = CUploadedFile::getInstance($path,'path'))
					{
						// path for file upload
						$pathfile = Yii::getPathOfAlias('webroot').'/files/';
						//$pathimg = Yii::getPathOfAlias('webroot').'/images/book_img/';
							
						// use image name as username
						$filename1 = $path->id.'.'.$file->getExtensionName();
						//$filename = $model->id.'.'.$image->getExtensionName();
							
						// uploaded image to path
						$file->saveAs($pathfile.$filename1);
						//$image->saveAs($pathimg.$filename);
			
						// path for file upload
			
					}else
						// this for no image file upload
						$filename1 = 'nofile.docx';
						//$filename = 'book_img/noimage.jpg';
						// set another user attribute
						$path->path = $filename1;
						//$model->picture = $filename;
						// insert userProfile
			
					if($model->save(false))
			
						$pathfile = Yii::getPathOfAlias('webroot').'/files/';
							
						//$this->exportPdf($model, $pathfile);
				
						$this->redirect(array('view','id'=>$model->id));
							
						//$this->redirect(array('view','id'=>$model->id));
					}
			
			}
			
			*/
				
		$this->render('create',array(
				'path'=>$path,
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
		
		$mPDF1->WriteHTML($path->path);
		
		# Outputs ready PDF
		//$time = date("d_m_Y", strtotime(date("D M j G:i:s T Y")));
		//$mPDF1->Output('all_products_'.$time.'.pdf',EYiiPdf::OUTPUT_TO_DOWNLOAD);
		$filename = iconv('UTF-8','windows-874', $book->name);
		$mPDF1->Output($pathfile.$filename.'.pdf', EYiiPdf::OUTPUT_TO_FILE);
		//exit;
	}
	
	public function actionGeneratePdf() {
		Yii::import('application.vendors.*');
		require_once('tcpdf/tcpdf.php');
		require_once('tcpdf/config/lang/eng.php');
		$pdf = new TCPDF();
		$pdf->SetCreator(PDF_CREATOR);
		$pdf->SetAuthor('Nicola Asuni');
		$pdf->SetTitle('TCPDF Example 001');
		$pdf->SetSubject('TCPDF Tutorial');
		$pdf->SetKeywords('TCPDF, PDF, example, test, guide');
		$pdf->SetHeaderData('', 0, PDF_HEADER_TITLE, '');
		$pdf->setHeaderFont(Array('helvetica', '', 8));
		$pdf->setFooterFont(Array('helvetica', '', 6));
		$pdf->SetMargins(15, 18, 15);
		$pdf->SetHeaderMargin(5);
		$pdf->SetFooterMargin(10);
		$pdf->SetAutoPageBreak(TRUE, 0);
		$pdf->SetFont('dejavusans', '', 7);
		$pdf->AddPage();
		$pdf->writeHTML("<span>Hello World!</span>", true, false, true, false, '');
		$pdf->LastPage();
		$pdf->Output("example_002.pdf", "I");
	}
	
	// Update
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);
		$path=$this->loadModel($id);
	
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
	
	if(isset($_POST['Book']))
		{
			//print_r($_POST['Book']);
			//exit();
			$model->attributes=$_POST['Book'];
			
			//$path->attributes=$_POST['Files'];
			
			$model->create_date = date('Y-m-d H:i:s');
			//$model->update_date = date('Y-m-d H:i:s');
			$model->member_id = Yii::app()->user->id;
			
			$valid = $model->validate();
			//$valid = $path->validate() && $valid;
				
			if($valid){
								
				//print_r($_FILES);
				//print_r($_FILES['Files']);
				//exit();
				// keep file to $image
				
				if($image = CUploadedFile::getInstance($model,'picture'))
				{
					//print_r($model);
					// path for file upload
					$pathimg = Yii::getPathOfAlias('webroot').'/images/book_img/';
					// use image name as username
					$filename = $model->name.'.'.$image->getExtensionName();
					echo $filename;
					//exit();
					// uploaded image to path
					$image->saveAs($pathimg.$filename);
					$model->picture = $filename;
					// path for file upload
						
				}else
					// this for no image file upload
					$filename = 'book_img/noimage.jpg';
					// set another user attribute
						
					// insert userProfile
				
				
				
				if($file = CUploadedFile::getInstance($path,'path'))
					{
						// path for file upload
						$pathfile = Yii::getPathOfAlias('webroot').'/files/';
						//$pathimg = Yii::getPathOfAlias('webroot').'/images/book_img/';
							
						// use image name as username
						$filename1 = $model->name.'.'.$file->getExtensionName();
						//$filename = $model->id.'.'.$image->getExtensionName();
							
						// uploaded image to path
						$file->saveAs($pathfile.$filename1);
						//$image->saveAs($pathimg.$filename);
							
						// path for file upload
							
					}else
						// this for no image file upload
						$filename1 = 'nofile.pdf';
						//$filename = 'book_img/noimage.jpg';
						// set another user attribute
						//$path->path = $filename1;
						//$model->picture = $filename;
						// insert userProfile

				//$path->file_id = $model->id;
				if(($path->save())&&($model->save()))
				
					//$pathfile = Yii::getPathOfAlias('webroot').'/files/';
					
					//$this->exportPdf($model, $pathfile);
				
					$model->file_id = $path-> id;
					$model->save();
						
					$this->redirect(array('view','id'=>$model->id));
					
					//$this->redirect(array('view','id'=>$model->id));
				}
		
			}
		$this->render('update',array(
				'path'=>$path,
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