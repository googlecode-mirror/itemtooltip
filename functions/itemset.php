<?php
echo "<html><head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"../css/base.css\" />
</head>";
function ParseItemSet($setid)
{
mysql_connect(host,user,password);
@mysql_select_db(database2) or die("Unable to select database");
$entry = mysql_real_escape_string($setid);
$query = "SELECT * FROM itemset WHERE id=$entry LIMIT 1";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
$setname = $row['name_'.lang.''];
$item1 = $row['item1'];
$item2 = $row['item2'];
$item3 = $row['item3'];
$item4 = $row['item4'];
$item5 = $row['item5'];
$item6 = $row['item6'];
$item7 = $row['item7'];
$item8 = $row['item8'];
$item9 = $row['item9'];
$items = array ($item1, $item2, $item3, $item4, $item5, $item6, $item7, $item8, $item9); 
$count = 0;
foreach ($items as $i)
{
	if($i)
		$count += 1;
}
$spell1 = $row['spell1'];
$spell2 = $row['spell2'];
$spell3 = $row['spell3'];
$spell4 = $row['spell4'];
$spell5 = $row['spell5'];
$spell6 = $row['spell6'];
$spell7 = $row['spell7'];
$spell8 = $row['spell8'];
$spells = array ($spell1, $spell2, $spell3, $spell4, $spell5, $spell6, $spell7, $spell8); 
$bonus1 = $row['bonus1'];
$bonus2 = $row['bonus2'];
$bonus3 = $row['bonus3'];
$bonus4 = $row['bonus4'];
$bonus5 = $row['bonus5'];
$bonus6 = $row['bonus6'];
$bonus7 = $row['bonus7'];
$bonus8 = $row['bonus8'];
$bonus = array ($bonus1, $bonus2, $bonus3, $bonus4, $bonus5, $bonus6, $bonus7, $bonus8);

if(lang != "en")
	$wowhead = "http://".lang.".wowhead.com/itemset=";
else
	$wowhead = "http://wowhead.com/itemset=";
$out = "<br /><span class='q10'><a href=$wowhead$setid>$setname </a>(0/$count)</span><br />";
foreach($items as $i)
{
	if($i)
		$out = $out . "<span class='q0'>&nbsp; &nbsp;" . GetItemName($i) . "</span><br />";
}
echo "<br />$out<br />";
ParseSpell($spells, $bonus, true);
}
function GetItemName($id)
{
global $locale;
mysql_connect(host,user,password);
@mysql_select_db(database) or die("Unable to select database");
$entry = mysql_real_escape_string($id);
$query = "SELECT * FROM items WHERE entry=$entry LIMIT 1";
$result = mysql_query($query);
$row = mysql_fetch_array($result);
if($row)
return $row['name1'];
else
return "$locale[notfound]";
}
?>