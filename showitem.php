<?php
//DON'T CHANGE SOMETHING AT THIS FILE EXCEPT YOU KNOW WHAT YOU DO!!!
echo "<html><head>
<meta http-equiv=\"content-type\" content=\"text/html; charset=ISO-8859-1\">
<link rel=\"stylesheet\" type=\"text/css\" href=\"css/tooltip-base.css\" />
</head>
<body>";
//error_reporting(E_ALL);
include "config.inc.php";
if(lang == "de" || lang == "en")
{}
elseif(lang == "yourlang")
	die("No language selected");
else
	die("Wrong language");
include("locales/".lang.".php");
include "functions/item.php";
include "functions/spell.php";
include "functions/displayid.php";
include "functions/itemset.php";
define("debug",$_GET['d']);
global $locale;
if($_GET['item'])
{
if($_GET['item'] == -1)
{
		echo "<table border=0><tbody><tr><td style='width:44px; vertical-align: top; padding: 2px 0px 0px 0px;' >";
		echo ParseIcon(0);
		echo "</td><td valign='top'>";
		echo "<div class='tooltip'><table width='100%'><td>";
		echo "<span class='q1' style='font-size: 15px'>$locale[loading]</span><br />";
		echo "</td><th style='background-position: top right'></th></tr><tr><th style='background-position: bottom left'></th><th style='background-position: bottom right'></th></tr>";
		echo "</td></tr></tbody></table></div>";
		return;
}
mysql_connect(host,user,password);
@mysql_select_db(database) or die("Unable to select database");
$entry = mysql_real_escape_string($_GET['item']);
$query = "SELECT * FROM items WHERE entry=$entry LIMIT 1";
if(lang == "de")
{
	$loc = "SELECT * FROM items_localized WHERE entry=$entry AND language_code='deDE' LIMIT 1";
	$resloc = mysql_query($loc);	
}
$result = mysql_query($query);
if(!$row = mysql_fetch_array($result))
{
	$query = "SELECT * FROM items WHERE entry=$entry LIMIT 1";
	$result = mysql_query($query);
	if(!$row = mysql_fetch_array($result))
	{	
		echo "<table border=0><tbody><tr><td style='width:44px; vertical-align: top; padding: 2px 0px 0px 0px;'>";
		echo ParseIcon(0);
		echo "</td><td valign='top'>";
		echo "<div class='tooltip'><table width='100%'><td>";
		echo "<span class='q1' style='font-size: 15px'>$locale[notfound]</span><br />";
		echo "</td><th style='background-position: top right'></th></tr><tr><th style='background-position: bottom left'></th><th style='background-position: bottom right'></th></tr>";
		echo "</td></tr></tbody></table>";
		mysql_close();
		return;
	}
}
if(lang == "en")
{
	$name = utf8_encode($row['name1']);
	$desc = utf8_encode($row['description']);
}
elseif(!$rowloc = mysql_fetch_array($resloc))
{
	$name = utf8_encode($row['name1']);
	$desc = utf8_encode($row['description']);
}
elseif(lang != "en")
{
	$name = $rowloc['name'];
	$desc = $rowloc['description'];
}
include("locales/".lang.".php");
global $locale;
$flag = utf8_encode($row['flags']);
$q = utf8_encode($row['quality']);
$bind = utf8_encode($row['bonding']);
$unique = utf8_encode($row['Unique']);
$class = utf8_encode($row['class']);
$subclass = utf8_encode($row['subclass']);
$invtype = utf8_encode($row['inventorytype']);
$display = utf8_encode($row['displayid']);
$slots = utf8_encode($row['ContainerSlots']);
$armor = utf8_encode($row['armor']);
$durability = utf8_encode($row['MaxDurability']);
$ilvl = utf8_encode($row['itemlevel']);
$sp = utf8_encode($row['sellprice']);
$itemset = utf8_encode($row['itemset']);
$pageid = utf8_encode($row['page_id']);

$rclass = utf8_encode($row['allowableclass']);
$rrace = utf8_encode($row['allowablerace']);
$rlevel = utf8_encode($row['requiredlevel']);
$rskill = utf8_encode($row['RequiredSkill']);
$rskilllvl = utf8_encode($row['RequiredSkillRank']);
$scale = utf8_encode($row['ScaledStatsDistributionId']);
$scaleflag = utf8_encode($row['ScaledStatsDistributionFlags']);

$dmg1min = utf8_encode($row['dmg_min1']);
$dmg1max = utf8_encode($row['dmg_max1']);
$dmg1type = utf8_encode($row['dmg_type1']);

$dmg2min = utf8_encode($row['dmg_min2']);
$dmg2max = utf8_encode($row['dmg_max2']);
$dmg2type = utf8_encode($row['dmg_type2']);

$speed = $row['delay'] / 1000;

$randomsuffix = $row['randomsuffix'];
$randomprop = $row['randomprop'];

$stat1t = utf8_encode($row['stat_type1']);
$stat1v = utf8_encode($row['stat_value1']);

$stat2t = utf8_encode($row['stat_type2']);
$stat2v = utf8_encode($row['stat_value2']);

$stat3t = utf8_encode($row['stat_type3']);
$stat3v = utf8_encode($row['stat_value3']);

$stat4t = utf8_encode($row['stat_type4']);
$stat4v = utf8_encode($row['stat_value4']);

$stat5t = utf8_encode($row['stat_type5']);
$stat5v = utf8_encode($row['stat_value5']);

$stat6t = utf8_encode($row['stat_type6']);
$stat6v = utf8_encode($row['stat_value6']);

$stat7t = utf8_encode($row['stat_type7']);
$stat7v = utf8_encode($row['stat_value7']);

$stat8t = utf8_encode($row['stat_type8']);
$stat8v = utf8_encode($row['stat_value8']);

$stat9t = utf8_encode($row['stat_type9']);
$stat9v = utf8_encode($row['stat_value9']);

$sp1 = utf8_encode($row['spellid_1']);
$st1 = utf8_encode($row['spelltrigger_1']);
$sp2 = utf8_encode($row['spellid_2']);
$st2 = utf8_encode($row['spelltrigger_2']);
$sp3 = utf8_encode($row['spellid_3']);
$st3 = utf8_encode($row['spelltrigger_3']);
$sp4 = utf8_encode($row['spellid_4']);
$st4 = utf8_encode($row['spelltrigger_4']);
$sp5 = utf8_encode($row['spellid_5']);
$st5 = utf8_encode($row['spelltrigger_5']);

$rholy = utf8_encode($row['holy_res']);
$rfire = utf8_encode($row['fire_res']);
$rnature = utf8_encode($row['nature_res']);
$rfrost = utf8_encode($row['frost_res']);
$rshadow = utf8_encode($row['shadow_res']);
$rarcane = utf8_encode($row['arcane_res']);

$socket1 = utf8_encode($row['socket_color_1']);
$socket2 = utf8_encode($row['socket_color_2']);
$socket3 = utf8_encode($row['socket_color_3']);
$socketbonus = utf8_encode($row['socket_bonus']);
echo "<table border=0><tbody><tr>";
if(icons)
{
	echo "<td style='width:44px; vertical-align: top; padding: 2px 0px 0px 0px;'>";
	ParseIcon($display);
	echo "</td>";
}
echo "<td valign='top'>";
echo "<div class='tooltip'><table width='100%'><td>";
echo "<b class='q$q' style='font-size: 15px'>$name</b>";
if(debug) echo "&nbsp;&nbsp;(entry: $entry)";
echo "<br />";
if(in_array($flag, array(8, 4104))) echo "<span class='q2'>$locale[heroic]</span><br />";
if($class == 16)
	GetGlyphType($sp1);
if(debug)
	echo "bonding: $bind quality: $q flag: $flag (->".implode(', ', GetFlag($flag)).") <br />";
if($q == 7)
	echo "$locale[acc]<br />";
elseif($bind == 1)
		echo "$locale[pick]<br />";
elseif($bind == 2)
		echo "$locale[equiped]<br />";
elseif($bind == 3)
		echo "$locale[used]<br />";
elseif($bind == 4)
		echo "$locale[quest]<br />";

if($unique == 1)
		echo "$locale[unique]<br />";
else if($unique > 1)
		echo "$locale[unique] ($unique)<br />";
if(HasFlag ($flag,524288))
	echo "$locale[uniqueeq]<br />";
if($slots != 0)
{
		echo "$slots $locale[bag]<br />";
}
ParseItemType($class, $subclass, $invtype);
$dps = 0;
//damage
if($dmg1min > 0)
{
	if($class == 6)
	{
		$dam = ($dmg1min+$dmg1max)/2;
		echo "<span style='float:left;'>$locale[ammo1] $dam $locale[ammo2]</span><br />";
	}	
	else
	{
	$str = ParseDamage($dmg1type);
	echo "<span style='float:left;'>$dmg1min - $dmg1max $str$locale[damage]</span><span style='float:right;'>$locale[speed] ";
	printf("%01.2f</span><br />",$speed);
	$dps = (($dmg1max + $dmg1min) / 2) / $speed;
	}
}
if($dmg2min > 0)
{
	$str = ParseDamage($dmg2type);
	echo "+$dmg2min - $dmg2max $str$locale[damage]<br />";
	$dps += (($dmg2max + $dmg2min) / 2) / $speed;
}

if($dps) 
{
	printf("(%01.1f $locale[dps])<br />", $dps);
}

echo ParseFeralAttackPower($dps, GetItemClass($class, $subclass));

if($armor)
		echo "$armor $locale[armor]<br />";
if($randomsuffix || $randomprop)
	echo "<span class='q2'>&lt;$locale[rnd]&gt;</span><br />";
$stats = array ($stat1t, $stat2t, $stat3t, $stat4t, $stat5t, $stat6t, $stat7t, $stat8t, $stat9t);
$statvalues = array ($stat1v, $stat2v, $stat3v, $stat4v, $stat5v, $stat6v, $stat7v, $stat8v, $stat9v);
ParseStat($stats, $statvalues);
/*if($ps && $stat1v)
{
	if($stat1v > 0)
		echo "+";
	echo "$stat1v $ps<br />";
}
$ps = ParseStat($stat2t);
if($ps && $stat2v)
{
	if($stat2v > 0)
		echo "+";
	echo "$stat2v $ps<br />";
}
$ps = ParseStat($stat3t);
if($ps && $stat3v)
{
	if($stat3v > 0)
		echo "+";
	echo "$stat3v $ps<br />";
}
$ps = ParseStat($stat4t);
if($ps && $stat4v)
{
	if($stat4v > 0)
		echo "+";
	echo "$stat4v $ps<br />";
}
$ps = ParseStat($stat5t);
if($ps && $stat5v)
{
	if($stat5v > 0)
		echo "+";
	echo "$stat5v $ps<br />";
}*/

if($rholy > 0 && $rholy == $rfire && $rfire == $rnature && $rnature == $rfrost && $rfrost == $rshadow && $rshadow == $rarcane)
	echo "+$rholy $locale[allres]<br />"; 

else
{
if($rholy)
	echo "+$rholy $locale[holy]<br />";
if($rfire)	
	echo "+$rfire $locale[fire]<br />";
if($rnature)
	echo "+$rnature $locale[nature]<br />";
if($rfrost)
	echo "+$rfrost $locale[frost]<br />";
if($rshadow)
	echo "+$rshadow $locale[shadow]<br />";
if($rarcane)
	echo "+$rarcane $locale[arcane]<br />";
}

if($socket1 or $invtype == 28)
{
	ParseSocket($socket1, $invtype);
	if($socket2)
	{
		ParseSocket($socket2, $invtype);
		if($socket3)
		{
			ParseSocket($socket3, $invtype);
		}
	}
	if($socketbonus)
	{
		ParseSocketBonus($socketbonus);
	}
}

if($durability)
	echo "$locale[dur] $durability/$durability<br />";

if($rclass != -1 && $rclass != 32767 && $rclass != 1535 && $rclass != 262143)
{
	$sc = ParseClass($rclass);
	echo "$locale[class]: $sc<br />";

}
if($rrace != -1 && $rrace != 32767 && $rrace != 2047 && $rrace != 0 && $rrace != 511 && $rrace != 2147483647)
{
	$sr = ParseRace($rrace);
	echo "$locale[race]: $sr<br />";

}

if($rlevel>1)
	echo "$locale[level] $rlevel <br />";
elseif($scale)
{
	if(debug)
		echo "(scale: $scale scaleflag: $scaleflag)<br />";
	echo "$locale[levelscale]<br />";
}
if($rskilllvl && $rskill)
	echo ParseReqSkill($rskill, $rskilllvl);
if($ilvl != -1)
	echo "$locale[ilvl] $ilvl";

// Spells
ParseStat($stats, $statvalues, true);
/*
if($stat1t > 7 && $stat1v)
ParseStat2($stat1t, $stat1v);

if($stat2t > 7 && $stat2v)
ParseStat2($stat2t, $stat2v);

if($stat3t > 7 && $stat3v)
ParseStat2($stat3t, $stat3v);

if($stat4t > 7 && $stat4v)
ParseStat2($stat4t, $stat4v);

if($stat5t > 7 && $stat5v)
ParseStat2($stat5t, $stat5v);

if($stat6t > 7 && $stat6v)
ParseStat2($stat6t, $stat6v);

if($stat7t > 7 && $stat7v)
ParseStat2($stat7t, $stat7v);

if($stat8t > 7 && $stat8v)
ParseStat2($stat8t, $stat8v);

if($stat9t > 7 && $stat9v)
ParseStat2($stat9t, $stat9v);*/

$spells = array (0 => $sp1, $sp2, $sp3, $sp4, $sp5);
$spelltriggers = array (0 => $st1, $st2, $st3, $st4, $st5);
ParseSpell($spells, $spelltriggers);

if($itemset)
ParseItemSet($itemset);

if($pageid)
echo "<br /><span class='q2'>&lt;$locale[read]&gt;</span>";
if($flag == 4)
echo "<br /><span class='q2'>&lt;$locale[open]&gt;</span>";
if($desc != "")
echo "<br /><span class='q'>\"$desc\"</span>";
if($sp != 0 and $sp != -1)
echo "<br />$locale[sellprice]";
$gold = floor($sp / 10000);
$silver = floor(($sp%10000)/100);
$copper = ($sp%10000)%100;
if($gold != 0)
echo "<span class='moneygold'>$gold</span>";
if($silver != 0)
echo "<span class='moneysilver'> $silver</span>";
if($copper != 0)
echo "<span class='moneycopper'> $copper</span>";

echo "</td><th style='background-position: top right'></th></tr><tr><th style='background-position: bottom left'></th><th style='background-position: bottom right'></th></tr>";
echo "</td></tr></tbody></table></div>";
mysql_close();}
?>
</body>
</html>