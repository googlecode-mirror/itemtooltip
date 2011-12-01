<?php
function ParseSpell($spells, $triggers, $set = false)
{
	include("locales/".lang.".php");
	if(lang != "en")
		$wowhead = "http://".lang.".wowhead.com/spell=";
	else
		$wowhead = "http://wowhead.com/spell=";
	$sp_out = "";
	$learn = false;
	if($set)
	$setarray = array();
	for($i=0;$i<count($spells);$i+=1)
	{
		$id = $spells[$i];
		$tri = $triggers[$i];
		if(debug)
			echo "<br />(spell$i:$id trigger:$tri)";
		mysql_connect(host,user,password);
		@mysql_select_db(database2) or die("Unable to select database");
		$entry = mysql_real_escape_string($id);
		$q2 = "SELECT * FROM spelltext_".lang." WHERE spellId = $entry";
		$re = mysql_query($q2);
		if($re)
			$rp = mysql_fetch_array($re);
		if($rp)
			$spelltext = utf8_encode($rp['spellText']);
		else $spelltext = false;
		if($set)
		{
			if($tri==0)continue;
			$setarray[$tri] = $setarray[$tri] . "<span class='q0'>Set ($tri): <a href=$wowhead$id>$spelltext</a></span><br />";
			continue;
		}
		if($id == 483 || $id == 55884) //Learning
		{
			if($i == 0 && $spells[0])
				$sp_out = $sp_out . "<br />";
			$learn = true;
			$sp_out = $sp_out . "<span class='q2'>$locale[use]</span>";
			continue;
		}
		if($learn)
		{
			if(!$spelltext)
				$sp_out = $sp_out . "<span class='q2'><a href=$wowhead$id>$locale[teaches]</a></span>";
			else
				$sp_out = $sp_out . "<span class='q2'><a href=$wowhead$id>$spelltext</a></span>";
			$learn = false;
			if($spells[$i+1]!=0)
				$sp_out = $sp_out . "<br />";
		}
		else
		{
			if($id==0)continue;
			if(!$spelltext)continue;
			$pre = ParseSpell2($tri);
			$sp_out = $sp_out . "$pre<span class='q2'><a href=$wowhead$id>$spelltext</a></span>";
		}
	}
	if($set)
	{
		ksort($setarray);
		foreach($setarray as $s)
			echo $s;
	}
	echo $sp_out;
}

function ParseSpell2($trigger)
{	
	include("locales/".lang.".php");
	switch($trigger)
	{
		case 0:
			return "<br /><span class='q2'>$locale[use]</span>";
			break;
		case 1:
			return "<br /><span class='q2'>$locale[equip]</span>";
			break;
		case 2:
			return "<br /><span class='q2'>$locale[itemhit]</span>";
			break;
		default:
			break;
	}
}

function GetGlyphType($spellid)
{
	mysql_connect(host,user,password);
	@mysql_select_db(database2) or die("Unable to select database");
	$entry = mysql_real_escape_string($spellid);
	$q2 = "SELECT * FROM spelltext_".lang." WHERE spellId = $entry";
	$re = mysql_query($q2);
	if($re)
		$rp = mysql_fetch_array($re);
	if($rp)
		$type = utf8_encode($rp['glyphType']);
	include("locales/".lang.".php");
	if ($type == 0)
		return "<span class='q9'>$locale[glyphmajor]</span><br />";
	if ($type == 1)
		return "<span class='q9'>$locale[glyphminor]</span><br />";
	return "<span class='q9'>$locale[glyph]</span><br />";
}
?>