<?php
/* @var $this BookshelfController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'ชั้นหนังสือ',
);

?>


<?php /* echo CHtml::link('Advanced Search','#',array('class'=>'search-button'));  */?>
<div class="search-form" style="display:none">
<?php /* $this->renderPartial('_search',array(
	'model'=>$model,
));  */?>
</div><!-- search-form -->


<html>
<head>
<link rel="stylesheet" type="text/css" href="bookself.css">
<title>bookself</title>
<META NAME="" CONTENT="">
</head>
<body>
<table width="100%" style="margin-left:-3px;" >
  <tbody>
    <tr class="bookshelf">
      <td><span class="bookshelf-title"> <a href="" class="bookshelf-name-link"> ชั้นวางหนังสือ </a> </span>
        <div class="grid_11 alpha omega bookshelf-body">
          <div class="grid_10 alpha omega" style="padding-left:40px"> 
          	 <?php foreach ($bookshelf as $value){ 
		?>
          	<span style="float:left;padding:8px 0px 36px 0px;height:150px;display:block" >
            	<div style="float: left;" > 
            	<?php //echo '<p><a href="https://www.facebook.com/rscmovement" target="_blank">'. $post['message']. '</a></p>';?>
            		<a href="index.php?r=bookshelf/index3&id="<?php $value['book_id']; ?>>
	             	 	<div class="caption-wrapper" 
	             	 		style="overflow: hidden; padding: 0px; font-size: 0.1px; width: 111px; height: 150px; margin: 5px; border: 0px none rgb(0, 147, 204);">
	             	 		
	   						
	             	 		<img alt="<?php echo $value['name']; ?>" title="<?php echo $value['name']; ?>" 
	             	 		src="/bls_project1/images/book_img/<?php echo $value['picture']; ?>" 
	             	 		rel="book_thumb_8" class=" captify  book_thumb" style="border: 0px none; margin: 0px;">
	               	 	<div class="caption-bottom" style="margin: 0px; z-index: 1; position: relative; opacity: 0.7; width: 116px; height: 38.40625px;"></div>
	                	<div class="caption-bottom" style="margin: -52px 0px 0px; padding-top: 9px; position: relative; z-index: 2; background-image: none; border: 0px none; opacity: 1; width: 100%; background-position: initial initial; background-repeat: initial initial;"> <a href="#" class="thumblink" style="margin: 0px;"> <?php echo $value['name']; ?></a> </div>
	              		</div>
	              	</a> 
              	</div>
            </span>
            <?php 
			/* echo array( 
			'name'=>'book.picture', 
			'type'=>'html', 
				// กำหนด type เป็น html 
			'value'=>'CHtml::image("images/book_img/".$data->picture)', 
			'htmlOptions'=>array('style'=>'max-width:25px;'),); */
		?>
        <?php }?>
            </div>
           </div>
        </td>
    </tr>
    <tr>
      <td>&nbsp;</td>
    </tr>
  </tbody>
</table>
<div style="float: right"> </div>
</body>
</html>
