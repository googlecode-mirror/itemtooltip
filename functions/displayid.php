<?php
function ParseIcon($dispid)
{
	if($dispid == 0)
		return "<img width=44 height=44 src=".path."/icons/INV_Misc_QuestionMark.png />";
	mysql_connect(host,user,password);
	@mysql_select_db(database2) or die("Unable to select database");
	$entry = mysql_real_escape_string($dispid);
	$query = "SELECT * FROM displayid WHERE dispid=$entry LIMIT 1";
	$result = mysql_query($query);
	if($row = mysql_fetch_array($result))
	{
		$icon = "$row[1].png";
		$icon = strtolower($icon);
		echo "<img width=44 height=44 src=".path."/icons/$icon />";
	}
	else
		echo "<img width=44 height=44 src=".path."/icons/inv_misc_questionmark.png />";
}
?>