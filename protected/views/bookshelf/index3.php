

<!DOCTYPE html>
<html dir="ltr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="chrome = 1">
<title>PDF.js viewer</title>
<!-- PDFJSSCRIPT_INCLUDE_FIREFOX_EXTENSION -->

<link rel="stylesheet" href="csss/viewer.css" />
<link rel="stylesheet" href="csss/book.css" />
<link rel="resource" type="application/l10n" href="locale.properties" />
<!-- PDFJSSCRIPT_REMOVE_CORE -->
<script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script>
<script type="text/javascript" src="scripts/turn.js"></script>
<script type="text/javascript" src="scripts/compatibility.js"></script>
<!-- PDFJSSCRIPT_REMOVE_FIREFOX_EXTENSION -->
<script type="text/javascript" src="l10n.js"></script>
<!-- PDFJSSCRIPT_REMOVE_CORE -->
<script type="text/javascript" src="pdf.js"></script>
<!-- PDFJSSCRIPT_REMOVE_CORE -->

<script type="text/javascript" src="scripts/debugger.js"></script>
<script type="text/javascript" src="scripts/viewer.js"></script>
<script type="text/javascript" src="scripts/glue.js"></script>
    <link type="text/css" href="csss/main.css" rel="stylesheet" media="screen" />
    <script type="text/javascript" src="scripts/jquery.js"></script>
    <script type="text/javascript" src="scripts/pdf.js"></script>
    <script type="text/javascript" src="scripts/jquery-1.7.1.min.js"></script>
    <script type="text/javascript" src="scripts/turn.min.js"></script>
    <script type="text/javascript" src="scripts/tools.js"></script>
    <script type="text/javascript" src="scripts/lupa.js"></script>
</head>

<body>
	<div id="outerContainer">

		<div id="sidebarContainer">
			<div id="toolbarSidebar">
				<div class="splitToolbarButton toggled">
					<button id="viewThumbnail" class="toolbarButton toggled"
						title="Show Thumbnails"
						onclick="PDFView.switchSidebarView('thumbs')" tabindex="1"
						data-l10n-id="thumbs">
						<span data-l10n-id="thumbs_label">Thumbnails</span>
					</button>
					<button id="viewOutline" class="toolbarButton"
						title="Show Document Outline"
						onclick="PDFView.switchSidebarView('outline')" tabindex="2"
						data-l10n-id="outline">
						<span data-l10n-id="outline_label">Document Outline</span>
					</button>
				</div>
			</div>
			<div id="sidebarContent">
				<div id="thumbnailView"></div>
				<div id="outlineView" class="hidden"></div>
			</div>
		</div>
		<!-- sidebarContainer -->

		<div id="mainContainer">
			<div class="toolbar">
				<div id="toolbarContainer">

					<div id="toolbarViewer">
						<div id="toolbarViewerLeft">
							<button id="sidebarToggle" class="toolbarButton"
								title="Toggle Sidebar" tabindex="3" data-l10n-id="toggle_slider">
								<span data-l10n-id="toggle_slider_label">Toggle Sidebar</span>
							</button>
							<div class="toolbarButtonSpacer"></div>
							<div class="splitToolbarButton">
								<button class="toolbarButton pageUp" title="Previous Page"
									onclick="PDFView.page--" id="previous" tabindex="4"
									data-l10n-id="previous">
									<span data-l10n-id="previous_label">Previous</span>
								</button>
								<div class="splitToolbarButtonSeparator"></div>
								<button class="toolbarButton pageDown" title="Next Page"
									onclick="PDFView.page++" id="next" tabindex="5"
									data-l10n-id="next">
									<span data-l10n-id="next_label">Next</span>
								</button>
							</div>
							<label id="pageNumberLabel" class="toolbarLabel" for="pageNumber"
								data-l10n-id="page_label">Page: </label> <input type="number"
								id="pageNumber" class="toolbarField pageNumber"
								onchange="PDFView.page = this.value;" value="1" size="4" min="1"
								tabindex="6"> </input> <span id="numPages" class="toolbarLabel"></span>
						</div>
						<div id="toolbarViewerRight">
							<input id="fileInput" class="fileInput" type="file"
								oncontextmenu="return false;"
								style="visibility: hidden; position: fixed; right: 0; top: 0" />
							<button id="openFile" class="toolbarButton openFile"
								title="Open File" tabindex="10" data-l10n-id="open_file"
								onclick="document.getElementById('fileInput').click()">
								<span data-l10n-id="open_file_label">Open</span>
							</button>

							<!--
                <button id="print" class="toolbarButton print" title="Print" tabindex="11" data-l10n-id="print" onclick="window.print()">
                  <span data-l10n-id="print_label">Print</span>
                </button>
                -->

							<button id="download" class="toolbarButton download"
								title="Download" onclick="PDFView.download();" tabindex="12"
								data-l10n-id="download">
								<span data-l10n-id="download_label">Download</span>
							</button>
							
							
							<!-- <div class="toolbarButtonSpacer"></div> -->
							<a href="#" id="viewBookmark" class="toolbarButton bookmark"
								title="Current view (copy or open in new window)" tabindex="13"
								data-l10n-id="bookmark"><span data-l10n-id="bookmark_label">Current
									View</span></a>
									
									
						</div>
						<div class="outerCenter">
							<div class="innerCenter" id="toolbarViewerMiddle">
								<div class="splitToolbarButton">
								
								
									<button class="toolbarButton zoomOut" title="Zoom Out" 
										onclick="if(window.parent.document.body.style.zoom!=0) window.parent.document.body.style.zoom*=0.8; else window.parent.document.body.style.zoom=0.8;" tabindex="7"
										data-l10n-id="zoom_out">
									
									</button>
									<div class="splitToolbarButtonSeparator"></div>
									
									
									<button class="toolbarButton zoomIn" title="Zoom In"
										onclick="if(window.parent.document.body.style.zoom!=0) window.parent.document.body.style.zoom*=1.2; else window.parent.document.body.style.zoom=1.2;" tabindex="8"
										>
										<!--  <span data-l10n-id="zoom_in_label">Zoom In</span>-->
									</button>
								</div>
								<span id="scaleSelectContainer" class="dropdownToolbarButton">
									<select id="scaleSelect"
									onchange="PDFView.parseScale(this.value);" title="Zoom"
									oncontextmenu="return false;" tabindex="9" data-l10n-id="zoom">
										<option id="pageAutoOption" value="auto" selected="selected"
											data-l10n-id="page_scale_auto">Automatic Zoom</option>
										<option id="pageActualOption" value="page-actual"
											data-l10n-id="page_scale_actual">Actual Size</option>
										<option id="pageFitOption" value="page-fit"
											data-l10n-id="page_scale_fit">Fit Page</option>
										<option id="pageWidthOption" value="page-width"
											data-l10n-id="page_scale_width">Full Width</option>
										<option id="customScaleOption" value="custom"></option>
										<option value="0.5">50%</option>
										<option value="0.75">75%</option>
										<option value="1">100%</option>
										<option value="1.25">125%</option>
										<option value="1.5">150%</option>
										<option value="2">200%</option>
								</select>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>


</br></br></br></br>

			<div id="viewerContainer">
				<div id="viewer"></div>
			</div>

			<div class="magazine">
    </div>


<?php 
if(isset($_GET['id']))
{
	$link = mysql_connect("localhost","root","");
	mysql_select_db("bls_db",$link);


	$Id     = $_GET['id'];
	$query = "SELECT book.id,files.id ,files.path 
				FROM book LEFT JOIN files on book.file_id = files.id
				WHERE  book.id =$Id";
	$result = mysql_query($query) or die('Error, query failed');


	list ($Id,$idfile,$pathbook) = mysql_fetch_array($result);
	$data = "files/$pathbook"; // ตัวแปร PHP
	echo '<script type="text/javascript">';
	echo "var data = '$data';"; // ส่งค่า $data จาก PHP ไปยังตัวแปร data ของ Javascript
	echo '</script>';
	//echo $files;
	echo '</br >';
	echo $pathbook;
	echo '</br >';
	//echo $Contents;
	echo $data;
?>




    <script type="text/javascript">
   // alert(data); // ทดสอบแสดงตัวแปร

        PDFJS.disableWorker = true;
        var pdfDoc, scale, file, np;

        $(document).ready(function () {
            file = getUrlVars()["file"];
            if (file == null)
                file = (data);
           
            PDFJS.getDocument(file).then(function (doc) {
                pdfDoc = doc;
                np = (doc.numPages);

                scale = 3;

                for (var i = 1; i <= np; i++) {
                    $(".magazine").html($(".magazine").html() + '<div><canvas id="hoja' + i + '" style="border: 1px solid black; width: 99.4%; height: 99.5%;"></canvas></div>');
                }

                for (var i = 1; i <= np; i++) {
                    renderPage(i, document.getElementById('hoja' + i));
                }

                //Evento Window Ready
                flipkey();
                demoDisplay();
                window.onload = function () {
                    setContent();

                }
                document.getElementById('imagen-oculta').style.visibility = 'visible';
                document.getElementById('imagen-oculta2').style.visibility = 'visible';
            });
        });
      
    </script>
    <?php 

//    	echo"Test";
    }
//    echo"faild";
//    exit;
    ?>


    

			<div id="errorWrapper" hidden='true'>
				<div id="errorMessageLeft">
					<span id="errorMessage"></span>
					<button id="errorShowMore" onclick="" oncontextmenu="return false;"
						data-l10n-id="error_more_info">More Information</button>
					<button id="errorShowLess" onclick="" oncontextmenu="return false;"
						data-l10n-id="error_less_info" hidden='true'>Less
						Information</button>
				</div>
				<div id="errorMessageRight">
					<button id="errorClose" oncontextmenu="return false;"
						data-l10n-id="error_close">Close</button>
				</div>
				<div class="clearBoth"></div>
				<textarea id="errorMoreInfo" hidden='true' readonly="readonly"></textarea>
			</div>
		</div>
		<!-- mainContainer -->

	</div>
	<!-- outerContainer -->

	 
</body>
</html>
<br /><br />



