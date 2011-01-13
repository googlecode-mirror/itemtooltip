<?php
error_reporting(E_ALL);
include "../config.inc.php";
mysql_connect(host,user,password);
@mysql_select_db(database2) or die("Unable to select database");
$query = "SELECT * FROM displayid";
$result = mysql_query($query);
$icon = array ();
while($row = mysql_fetch_array($result))
{
	array_push($icon, strtolower("$row[1].png"));
}
$files = array ();
if ($handle = opendir('.')) {
    while (false !== ($file = readdir($handle))) {
        if ($file != "." && $file != "..") {
            array_push($files, $file);
        }
    }
    closedir($handle);
}
var_dump($icon);
foreach($files as $f)
{
	echo $f;
	if(!in_array($f, $icon))
	{
		echo "unlink: $f <br />";
		//unlink($i);
	}
}
?>