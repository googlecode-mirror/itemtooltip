<?php
include("de.php");
$de = $locale;
$in_de = array_keys($de);
include("en.php");
$en = $locale;
$in_en = array_keys($en);
foreach($in_de as $b)
{
	if(!in_array($b, $in_en))
		echo $b . "<br>";
}
?>