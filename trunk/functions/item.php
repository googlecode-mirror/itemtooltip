<?php
include("locales/".lang.".php");

global $itsubclass;
global $itclass;
/*
* ItemClass.dbc
*/
$itclass = array (
"consume",
"bag",
"weapon",
"gem",
"armor",
"reagent",
"projectile",
"goods",
"generic",
"recipe",
"money",
"quiver",
"quest",
"key",
"perm",
"misc",
"glyph"
);
/*
* ItemSubClass.dbc
*/
$itsubclass = array (
"consume" 			=> array ("consume",  "pot", "elixir", "flask", "scroll", "fooddrinks", "enchantment", "bandage", "other"),
"bag" 				=> array ("unk", "soulbag", "herbbag", "enchbag", "engibag", "gembag", "miningbag", "lwbag", "inscrbag"),
"weapon" 			=> array ("axe", "axe", "bow", "gun", "mace", "mace", "polearm", "sword", "sword", "unk", "staff", "unk", "unk", "fist", "unk", "dagger", "thrown", "spear", "crossbow", "wand", "pole"),
"gem" 				=> array ("red", "blue", "yellow", "purple", "green", "orange", "meta", "simple", "prismatic"),
"armor" 			=> array ("misc", "cloth", "leather", "mail", "plate", "unk", "shield", "libram", "idol", "totem", "sigil"),
"reagent"		 	=> array ("ankh"),
"projectile" 		=> array (2=>"arrow", "bullet"),
"goods" 			=> array ("goods", "parts", "explosive", "device", "jewelcrafting", "cloth", "leather", "metalstone", "meat", "herb", "elemental", "other", "enchanting", "mats", "armorench", "weaponench",),
"generic" 			=> array ("unk"),
"recipe" 			=> array ("book", "leatherworking", "tailoring", "enineering", "blacksmithing", "cooking", "alchemy", "firstaid", "enchanting", "fishing", "jewecrafting", "inscription"),
"money" 			=> array ("money"),
"quiver" 			=> array (2=>"quiver", "ammopouch"),
"quest" 			=> array ("quest"),
"key" 				=> array ("key", "lockpick"),
"perm"				=> array ("mount"),
"misc" 				=> array ("junk", "reagent", "pets", "holiday", "other", "mount"),
"glyph" 			=> array ("none", "warrior", "paladin", "hunter", "rogue", "priest", "dk", "shaman", "mage", "warlock", "none", "druid",),
);
global $slot;
$slot = array (
		"none",
		"head",
		"neck",
		"shoulder",
		"shirt",
		"chest",
		"waist",
		"legs",
		"feet",
		"wrist",
		"hands",
		"finger",
		"trinket",
		"weapon",
		"shield",
		"range",
		"cloak",
		"twohand",
		"bag",
		"tabard",
		"robe",
		"mainhand",
		"offhand",
		"offheld",
		"projectile",
		"thrown",
		"ranged",
		"quiver",
		"relic"
);
global $stat;
$stat = array (
0 => "power",
1 => "health",
3 => "agi",
4 => "str",
5 => "int",
6 => "spirit",
7 => "stam",
11 => "weaponskill",
12 => "def",
13 => "dodge",
14 => "parry",
15 => "block",
16 => "meleehit",
17 => "rangehit",
18 => "spellhit",
19 => "meleecrit",
20 => "rangecrit",
21 => "spellcrit",
28 => "meleehaste",
29 => "rangehaste",
30 => "spellhaste",
31 => "hit",
32 => "crit",
34 => "exp",
35 => "resil",
36 => "haste",
37 => "exp",
38 => "ap",
39 => "rap",
40 => "feralap",
41 => "sheal",
42 => "sdamage",
43 => "mp5",
44 => "arp",
45 => "sp",
46 => "hp5",
47 => "spellpen",
48 => "blockvalue"
);
global $aclass;
$aclass = array (
1 => "warrior",
2 => "paladin",
4 => "hunter",
8 => "rogue",
16 => "priest",
32 => "dk",
64 => "shaman",
128 => "mage",
256 => "warlock",
1024 => "druid"
);
global $arace;
$arace = array (
1 => "human",
2 => "orc",
4 => "dwarf",
8 => "nightelf",
16 => "undead",
32 => "tauren",
64 => "gnome",
128 => "troll",
256 => "goblin",
512 => "bloodelf",
1024 => "draenei",
2097152 => "worgen"
);

function HasFlag($flags, $flag)
{
	if(!$flag || !$flags)return;
	$bits = array();
	for($i=1;$i<=$flags;$i*=2)
	{
		if( ($i & $flags) > 0)
			array_push($bits, $i);
	}
	if(in_array($flag, $bits))
		return true;
	return false;
}

function GetFlag($flags)
{
	$bits = array();
	for($i=1;$i<=$flags;$i*=2)
	{
		if( ($i & $flags) > 0)
			array_push($bits, $i);
	}
	return $bits;
}

function GetItemClass($cl, $subcl)
{
	global $itclass;
	global $itsubclass;
	return $itsubclass[$itclass[$cl]][$subcl];
}

function GetSlot($slotid)
{
	global $slot;
	return $slot[$slotid];
}

function ParseItemType($class, $subclass, $inventorytype)
{

	include("locales/".lang.".php");
	$itype = GetItemClass($class, $subclass);
	$itmslot= GetSlot($inventorytype);
	if(debug)
	echo "slot: $itmslot type: $itype <br /> class: $class sub: $subclass inv: $inventorytype <br />";
	$out = "<span style='float:left;'>$locale[$itmslot]</span><span style='float:right;'>$locale[$itype]</span><br />";
	//Fixes
	if(in_array($itmslot,array("misc"))) //itemtype: left when slot is misc
		$out = "<span style='float:left;'>$locale[$itype]</span><br />";
	if(!in_array($class, array(2,4, 6)))
		$out = "";
	echo $out;
	/*
	if($class == 2) //weapon
	{
		if($subclass == 0) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span><span style='float:right;'>$locale[axe]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[axe]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span><span style='float:right;'>$locale[axe]</span>";}
		}
		elseif($subclass == 1) {$var = "<span style='float:left;'>$locale[twohand]</span><span style='float:right;'>$locale[axe]</span>";}
		elseif($subclass == 2) {$var = "<span style='float:left;'>$locale[dist]</span><span style='float:right;'>$locale[bow]</span>";}
		elseif($subclass == 3) {$var = "<span style='float:left;'>$locale[dist]</span><span style='float:right;'>$locale[shot]</span>";}
		elseif($subclass == 4) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span><span style='float:right;'>$locale[mace]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[mace]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span><span style='float:right;'>$locale[mace]</span>";}
		}
		elseif($subclass == 5) {$var = "<span style='float:left;'>$locale[twohand]</span><span style='float:right;'>$locale[mace]</span>";}
		elseif($subclass == 6) {$var = "<span style='float:left;'>$locale[twohand]</span><span style='float:right;'>$locale[polearm]</span>";}
		elseif($subclass == 7) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span><span style='float:right;'>$locale[sword]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[sword]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span><span style='float:right;'>$locale[sword]</span>";}
		}
		elseif($subclass == 8) {$var = "<span style='float:left;'>$locale[twohand]</span><span style='float:right;'>$locale[sword]</span>";}
		elseif($subclass == 10) {$var = "<span style='float:left;'>$locale[twohand]</span><span style='float:right;'>$locale[staff]</span>";}
		elseif($subclass == 13) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span><span style='float:right;'>$locale[fist]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[fist]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span><span style='float:right;'>$locale[fist]</span>";}
		}
		elseif($subclass == 14) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span>";}
		}
		elseif($subclass == 15) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span><span style='float:right;'>$locale[dagger]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[dagger]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span><span style='float:right;'>$locale[dagger]</span>";}
		}
		elseif($subclass == 16) {$var = "<span style='float:left;'>$locale[throw]</span><span style='float:right;'>$locale[throw]</span>";}
		elseif($subclass == 18) {$var = "<span style='float:left;'>$locale[range]</span><span style='float:right;'>$locale[cross]</span>";}
		elseif($subclass == 19) {$var = "<span style='float:left;'>$locale[range]</span><span style='float:right;'>$locale[wand]</span>";}
		elseif($subclass == 20) {
			if($inventorytype == 21)
			{$var = "<span style='float:left;'>$locale[main]</span><span style='float:right;'>$locale[fishpole]</span>";}
			elseif($inventorytype == 22)
			{$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[fishpole]</span>";}
			else
			{$var = "<span style='float:left;'>$locale[onehand]</span><span style='float:right;'>$locale[fishpole]</span>";}
		}
	}
	elseif($class == 4) //armor
	{
		if($inventorytype == 1) {$var = "<span style='float:left;'>$locale[head]</span>";}
		elseif($inventorytype == 2) {$var = "<span style='float:left'>$locale[neck]</span>";}
		elseif($inventorytype == 3) {$var = "<span style='float:left'>$locale[shoulder]</span>";}
		elseif($inventorytype == 4) {$var = "<span style='float:left'>$locale[shirt]</span>";}
		elseif($inventorytype == 5) {$var = "<span style='float:left'>$locale[chest]</span>";}
		elseif($inventorytype == 6) {$var = "<span style='float:left'>$locale[waist]</span>";}
		elseif($inventorytype == 7) {$var = "<span style='float:left'>$locale[legs]</span>";}
		elseif($inventorytype == 8) {$var = "<span style='float:left'>$locale[feet]</span>";}
		elseif($inventorytype == 9) {$var = "<span style='float:left'>$locale[wrist]</span>";}
		elseif($inventorytype == 10) {$var = "<span style='float:left'>$locale[hands]</span>";}
		elseif($inventorytype == 11) {$var = "<span style='float:left'>$locale[finger]</span>";}
		elseif($inventorytype == 12) {$var = "<span style='float:left'>$locale[trinket]</span>";}
		elseif($inventorytype == 16) {$var = "<span style='float:left'>$locale[cloak]</span>";}
		elseif($inventorytype == 19) {$var = "<span style='float:left'>$locale[tabard]</span>";}
		elseif($inventorytype == 23) {$var = "<span style='float:left'>$locale[offheld]</span>";}
		elseif($inventorytype == 28) {$var = "<span style='float:left'>$locale[relic]</span>";}
			
		if($subclass == 1) {$var = $var . "<span style='float:right;'>$locale[cloth]</span>";}
		elseif($subclass == 2) {$var = $var . "<span style='float:right;'>$locale[leather]</span>";}
		elseif($subclass == 3) {$var = $var . "<span style='float:right;'>$locale[mail]</span>";}
		elseif($subclass == 4) {$var = $var . "<span style='float:right;'>$locale[plate]</span>";}
		elseif($subclass == 6) {$var = "<span style='float:left;'>$locale[off]</span><span style='float:right;'>$locale[shield]</span>";}
	}
	elseif($class == 6) //ammo
	{
		$var = "<span style='float:left;'>$locale[projectile]</span>";
		if($subclass == 2) {$var = $var . "<span style='float:right;'>$locale[arrow]</span>";}
		elseif($subclass == 3) {$var = $var . "<span style='float:right;'>$locale[bullet]</span>";}
	}
	if($var && $var != "<span style='float:left;'>$locale[unk]</span>")
		echo $var . "<br />";*/
}

function ParseDamage($damagetype)
{
	include("locales/".lang.".php");
	if($damagtype >= 0 && $damagetype < 7)
		return $locale["damagetype$damagetype"];
}

function ParseFeralAttackPower($dps, $weapon)
{
	global $locale;
	//(WeaponDPS - 55) * 14
	if(in_array($weapon, array ("staff", "mace", "dagger", "fist", "polearm")))
	{
		$dps = sprintf("%01.2f", round($dps,1)); //Wow calculates only with .0 and .5
		$d = $dps*10%10;
		if($d < 3 && $d > 0)
			$dps = floor($dps);
		elseif($d < 3 && $d > 7)
			$dps = ($dps%100000)+0.5;
		else
			$dps = ceil($dps);
		$fap = (($dps - 55) * 14);
		$fap = round($fap);
		if($fap<1)return;
		return "<span class='fap'>($fap $locale[feralap])</span><br />";
	}
	return;
}

function ParseStat($st, $sv, $sec = false)
{
	global $stat;
	global $locale;
	$d = false;
	$out = "";
	for($i=0;$i<count($st);$i+=1)
	{
		$s = $st[$i];
		$v = $sv[$i];
		if(!$sec && $s > 7)continue;
		if($s < 2 || $s > 48)continue;
		if($sec && $s < 8)continue;
		if(debug)
		{
			if($sec && !$d){echo "<br />"; $d=true;}
			echo "(stattype: $s&#091;$stat[$s]&#093; value: $v)<br />";
		}
		if(!$sec)
			$out = $out . "+$v {$locale[$stat[$s]]}<br />";
		elseif(($stat[$s] == "hp5" || $stat[$s] == "mp5") && $sec)
			$out = $out . "<br /><span class='q2'>$locale[restore]$v {$locale[$stat[$s]]}</span>";
		elseif($sec)
			$out = $out . "<br /><span class='q2'>$locale[addstat] {$locale[$stat[$s]]}$locale[by] $v.</span>";
	}
	echo $out;
}

function ParseSocket($sockettype, $inventorytype)
{
	include("locales/".lang.".php");
	if($sockettype == 1)
		echo "<span class='socket-meta q0'>$locale[socketmeta]";
	elseif($sockettype == 2)
		echo "<span class='socket-red q0'>$locale[socketred]";
	elseif($sockettype == 4)
		echo "<span class='socket-yellow q0'>$locale[socketyellow]";
	elseif($sockettype == 8)
		echo "<span class='socket-blue q0'>$locale[socketblue]";
	elseif($inventorytype == 28)
		echo "<span class='socket-prismatic q0'>$locale[socketprismatic]";
	if(debug)
		echo " (sockettype: $sockettype)";
	echo "</span><br />";
}

function ParseSocketBonus($sb)
{
	/*
	* SpellItemEnchantment.dbc
	*/
	include("locales/".lang.".php");
	mysql_connect(host,user,password);
	@mysql_select_db(database2) or die("Unable to select database");
	$entry = mysql_real_escape_string($sb);
	$query = "SELECT * FROM socketbonus WHERE id=$entry LIMIT 1";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result))
	{
		$sb_string = utf8_encode($row['bonus_'.lang.'']);
		$out = "<span class='q0'>$locale[socketbonus] $sb_string";
		if(debug)
			$out = $out . " (entry: $entry)";
		$out = $out . "</span><br />";
		echo $out;
	}
}

function ParseClass($class)
{
	include("locales/".lang.".php");
	global $aclass;
	$bits = array();
	for($i=1;$i<=$class;$i*=2)
	{
		if( ($i & $class) > 0 and $i < 1025 and $i != 512)
			array_push($bits, $i);
	}
	foreach($bits as $bit)
	{
		$var = $var . "<span class=\"class-$aclass[$bit]\">";
		if(debug)
			$var = $var . "(cid: $bit)";
		$var = $var . "{$locale[$aclass[$bit]]}</span>, ";
	}
	return substr($var,0,(strlen($var)-2));
}

function ParseRace($race)
{
	include("locales/".lang.".php");
	global $arace;
	$bits = array();
	for($i=1;$i<=$race;$i*=2)
	{
		if( ($i & $race) > 0 && ($i < 1025 || $i == 2097152))
			array_push($bits, $i);
	}
	foreach ($bits as $b)
	{
		if(debug)
			$var = $var . "(flag: $b)";
		$var = $var . "{$locale[$arace[$b]]}, ";
	}
	return substr($var,0,(strlen($var)-2));
}

function ParseReqSkill($rskill, $lvl)
{
	global $locale;
	$skill = array (
	129 => "firstaid",
	164 => "blacksmithing",
	165 => "leatherworking",
	171 => "alchemy",
	182 => "herbalism",
	185 => "cooking",
	186 => "mining",
	197 => "tailoring",
	202 => "engineering",
	333	=> "enchanting",
	356 => "fishing",
	393	=> "skinning",
	755 => "jewelcrafting",
	773 => "Inscription"
	);
	return "$locale[needs] {$locale[$skill[$rskill]]} ($lvl) <br />";
}
?>