<!--
///////////////////////////////////////////////////////////////////////////////////
This is an example on how to use the pop-up functionality
///////////////////////////////////////////////////////////////////////////////////
-->
<html>
<head>
	<!-- We must include all these libraries -->
	<script type="text/javascript" src="js/ajax-dynamic-content.js"></script>
	<script type="text/javascript" src="js/ajax.js"></script>
	<script type="text/javascript" src="js/ajax-tooltip.js"></script>
	<link rel="stylesheet" type="text/css" href="css/tooltip-base.css">
	<style type='text/css'>
	body {background-color: black; color: white}
	</style>
	
	<!-- This is not required, but if you want your item names to be colorful, it sure is helping
	<style type='text/css'>
	.q0, .q0 a { color: #9d9d9d !important }
	.q1, .q1 a { color: #ffffff !important }
	.q2, .q2 a { color: #1eff00 !important }
	.q3, .q3 a { color: #0070dd !important }
	.q4, .q4 a { color: #a335ee !important }
	.q5, .q5 a { color: #ff8000 !important }
	.q6, .q6 a { color: #e5cc80 !important }
	.q7, .q7 a { color: #ff0000 !important }
	.q8, .q8 a { color: #ffff98 !important }
	a {text-decoration: none;}
	a:hover {text-decoration: underline;}
	</style>-->
</head>
<!--
	.q0 Poor
	.q1 Common
	.q2 Uncommon
	.q3 Rare
	.q4 Epic
	.q5 Legendary
	.q6 Artifact
	.q7 Red???
	.q8 Artifact???
-->
<body>
<span class='q0'>
<a href="showitem.php?item=38520" onmouseover="ajax_showTooltip('showitem.php?item=38520',this);return false" onmouseout="ajax_hideTooltip()">
[Diving Log]
</a>
</span>
<span class='q1'>
<br />
<a href="showitem.php?item=43233" onmouseover="ajax_showTooltip('showitem.php?item=43233',this);return false" onmouseout="ajax_hideTooltip()">
[Deadly Poison IX]
</a>
</span>
<span class='q2'>
<br />
<a href="showitem.php?item=36499" onmouseover="ajax_showTooltip('showitem.php?item=36499',this);return false" onmouseout="ajax_hideTooltip()">
[Frigid War-Mace]
</a>
</span>
<span class='q3'>
<br />
<a href="showitem.php?item=42395" onmouseover="ajax_showTooltip('showitem.php?item=42395',this);return false" onmouseout="ajax_hideTooltip()">
[Figurine - Twilight Serpent]
</a>
</span>
<span class='q4'>
<br />
<a href="showitem.php?item=51307" onmouseover="ajax_showTooltip('showitem.php?item=51307',this);return false" onmouseout="ajax_hideTooltip()">
[Sanctified Scourgelord Handguards]
</a>
</span>
<span class='q5'>
<br />
<a href="showitem.php?item=49623" onmouseover="ajax_showTooltip('showitem.php?item=49623',this);return false" onmouseout="ajax_hideTooltip()">
[Shadowmourne]
</a>
</span>
<span class='q6'>
<br />
<a href="showitem.php?item=18582" onmouseover="ajax_showTooltip('showitem.php?item=18582',this);return false" onmouseout="ajax_hideTooltip()">
[The Twin Blades of Azzinoth]
</a>
</span>
<span class='q7'>
<br />
<a href="showitem.php?item=42944" onmouseover="ajax_showTooltip('showitem.php?item=42944',this);return false" onmouseout="ajax_hideTooltip()">
[Balanced Heartseeker]
</a>
</span>
<br />
To prove that this script can display Items with a ' in it:
<span class='q1'>
<br />
<a href="" onmouseover="ajax_showTooltip('showitem.php?item=11018',this);return false" onmouseout="ajax_hideTooltip()">
[Un'Goro Soil]
</a>
</span>
</body>
</html>