# ----------------------------------------
highcharts.com
Daily visits
May 20, 2012	Juni 17, 2012
# ----------------------------------------

# ----------------------------------------
# Graph
# ----------------------------------------
Day	All Visits (Segment)	New Visitors (Segment)
<?php
	include('config.php');

	$start_date = date("l, F d, Y", strtotime ("-30 day", strtotime(date("l, F d, Y"))));
	$end_date = date("l, F d, Y");
	$check_date = $start_date;
	$i	= 0;
	
	while ($check_date != $end_date) {
		$i++;
		$check_date = date("l, F d, Y", strtotime ("+1 day", strtotime($check_date)));
		$date	= date('Y-m-d', strtotime($check_date));
		$sql	= mysql_query("SELECT SUM(js.apply) as sapply,SUM(js.click) as sclick FROM `jbvacancy_stat` js, jbvacancy j where 1 and date = '".$date."' and j.comp_id='2' and j.vac_id=js.vac_id");
		$row	= mysql_fetch_array($sql);

		echo $check_date."\t".number_format($row['sapply'])."\t".number_format($row['sclick'])."\n";
	} 
?>
