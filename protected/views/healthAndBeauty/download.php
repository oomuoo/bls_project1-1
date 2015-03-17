<?php
if(isset($_GET['id']))
{
$link = mysql_connect("localhost","root","");
mysql_select_db("bls_db",$link);

//$dir = "uploads/$path";
$Id     = $_GET['id'];
$query = "SELECT book.id,files.id ,files.path 
				FROM book LEFT JOIN files on book.file_id = files.id
				WHERE  book.id =$Id";
$result = mysql_query($query) or die('Error, query failed');
//$dir = "uploads/$path";
list ($Id,$idfile,$pathbook) = mysql_fetch_array($result);

$data = "files/$pathbook";
//$file="uploads/$path"; //file location
header("Content-length:$Id");
//header("Content-type: $Type");
header('Content-Type: application/octet-stream');
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="'.basename($data).'"');
header('Content-Length: ' . filesize($data));
readfile($data);

echo $data;

//header('Content-Disposition: attachment;filename="foo.pdf"');
//readfile('/uploads/foo.pdf');

//echo header("Content-Disposition: attachment; filename=$path");
//echo $Contents;
echo"OK";
}
echo"faild";
exit;

?>

