<html>
<head>
<meta charset="utf-8">
<title>วรรณกรรม/นวนิยาย</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">

<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto+Slab:400,700,300,100">
<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,400italic,300italic,300,500,500italic,700,900">
<!--
Artcore Template
http://www.templatemo.com/preview/templatemo_423_artcore
-->
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.css">
        <link rel="stylesheet" href="css/animate.css">
        <link rel="stylesheet" href="css/templatemo-misc.css">
        <link rel="stylesheet" href="css/templatemo-style.css">
        <script src="js/vendor/modernizr-2.6.1-respond-1.1.0.min.js"></script>
        		</head>
        		<body>    		
<?php
$this->breadcrumbs=array(
	'วรรณกรรม/นวนิยาย',
);

?>
            <div class="projects-holder">
             <table style="width:100%">
  <tr>
    <td>
            <?php foreach ($literature as $value){ 
		?>
		
            <div class="row=3">   
            	<div class="col-md-4 project-item mix architecture">
            		<div class="project-thumb">
            		<!--<img src="images/book3.jpg" alt="">-->
            		<img src="/bls_project1/images/book_img/<?php echo $value['picture']; ?>" width="270px;" height="360px;" >
            		<div class="overlay-b">
            		<div class="overlay-inner">
                    <a href="/bls_project1/images/book_img/<?php echo $value['picture']; ?>" class="fancybox fa fa-expand" title="<?php echo  $value['name'] ; ?>"></a>
                    </div>
                    </div>
                    </div>
                         <div class="box-content project-detail">
                             <!--  <h2><a href="">เรื่องซนๆของโซฟี</a></h2>-->
                             <h2><?php echo  $value['name'] ; ?>
            				</h2>
                             <p></p>
                             <p><a href="/bls_project1/index.php?r=/healthAndBeauty/view&id=<?php echo $value['id'];?>"><b class="blue">อ่านต่อ >></b></a></p>
                         </div>
                   
                 </div> <!-- /.project-item -->
			
                 </div> <!-- /.row -->
             
      <?php  }?> 
      </td>
      </tr>   
      </table> 
       
<div class="load-more">
<a href="javascript:void(0)" class="load-more"><b class="blue">Load More</b></a>
</div>
</div> <!-- /.projects-holder -->



        <script src="js/vendor/jquery-1.11.0.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>

        <!-- Preloader -->
        <script type="text/javascript">
        		//<![CDATA[
        		$(window).load(function() {
                $('.loader-item').fadeOut();
        				$('#pageloader').delay(350).fadeOut('slow');
        				$('body').delay(350).css({'overflow-y':'visible'});
})
//]]>
</script>

</body>
</html>

		
