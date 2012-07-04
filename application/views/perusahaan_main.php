<div id="bar"> 
	STATISTIK 
</div>
<div id="perusahaan_statistik">
	<script type="text/javascript" src="<?php echo base_url(); ?>/media/js/jquery.js"></script>
	<script type="text/javascript">
	$(function () {
		var chart;
		$(document).ready(function() {
		
			// define the options
			var options = {
		
				chart: {
					renderTo: 'chart-container'
				},
		
				title: {
					text: 'Statistik Pergerakan Lowongan Iklan'
				},
		
				subtitle: {
					text: 'Source: Google Analytics'
				},
		
				xAxis: {
					type: 'datetime',
					tickInterval: 7 * 24 * 3600 * 1000, // one week
					tickWidth: 0,
					gridLineWidth: 1,
					labels: {
						align: 'left',
						x: 3,
						y: -3
					}
				},
		
				yAxis: [{ // left y axis
					title: {
						text: null
					},
					labels: {
						align: 'left',
						x: 3,
						y: 16,
						formatter: function() {
							return Highcharts.numberFormat(this.value, 0);
						}
					},
					showFirstLabel: false
				}, { // right y axis
					linkedTo: 0,
					gridLineWidth: 0,
					opposite: true,
					title: {
						text: null
					},
					labels: {
						align: 'right',
						x: -3,
						y: 16,
						formatter: function() {
							return Highcharts.numberFormat(this.value, 0);
						}
					},
					showFirstLabel: false
				}],
		
				legend: {
					align: 'left',
					verticalAlign: 'top',
					y: 20,
					floating: true,
					borderWidth: 0
				},
		
				tooltip: {
					shared: true,
					crosshairs: true
				},
		
				plotOptions: {
					series: {
						cursor: 'pointer',
						point: {
							events: {
								click: function() {
									hs.htmlExpand(null, {
										pageOrigin: {
											x: this.pageX,
											y: this.pageY
										},
										headingText: this.series.name,
										maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) +':<br/> '+
											this.y +' visits',
										width: 200
									});
								}
							}
						},
						marker: {
							lineWidth: 1
						}
					}
				},
		
				series: [{
					name: 'Pelamar Kerja',
					lineWidth: 4,
					marker: {
						radius: 4
					}
				}, {
					name: 'Melihat Iklan'
				}]
			};
		
		
			// Load data asynchronously using jQuery. On success, add the data
			// to the options and initiate the chart.
			// This data is obtained by exporting a GA custom report to TSV.
			// http://api.jquery.com/jQuery.get/
			jQuery.get('<?php echo base_url(); ?>/media/lib/chart.php', null, function(tsv, state, xhr) {
				var lines = [],
					listen = false,
					date,
		
					// set up the two data series
					allVisits = [],
					newVisitors = [];
		
				// inconsistency
				if (typeof tsv !== 'string') {
					tsv = xhr.responseText;
				}
		
				// split the data return into lines and parse them
				tsv = tsv.split(/\n/g);
				jQuery.each(tsv, function(i, line) {
		
					// listen for data lines between the Graph and Table headers
					if (tsv[i - 3] == '# Graph') {
						listen = true;
					} else if (line == '' || line.charAt(0) == '#') {
						listen = false;
					}
					// all data lines start with a double quote
					if (listen) {
						line = line.split(/\t/);
						date = Date.parse(line[0] +' UTC');
						
						allVisits.push([
							date,
							parseInt(line[1].replace(',', ''), 10)
						]);
						newVisitors.push([
							date,
							parseInt(line[2].replace(',', ''), 10)
						]);
					}
				});
				options.series[0].data = allVisits;
				options.series[1].data = newVisitors;
		
				chart = new Highcharts.Chart(options);
			});
		});
		
	});
	</script>
	<style type="text/css">.highslide img {cursor: url(<?php echo base_url(); ?>/media/css/zoomin.cur), pointer !important;}.highslide-viewport-size {position: fixed; width: 100%; height: 100%; left: 0; top: 0}</style></head>
	<script src="<?php echo base_url(); ?>/media/js/chart/highcharts.js"></script>
	<script src="<?php echo base_url(); ?>/media/js/chart/exporting.js"></script>

	<!-- Additional files for the Highslide popup effect -->
	<script type="text/javascript" src="<?php echo base_url(); ?>/media/js/chart/highslide-full.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>/media/js/chart/highslide.config.js" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/media/js/chart/highslide.css" />

	<div style="width:60&">
		<div id="chart-container" style="min-width: 400px; height: 400px; margin: 0 auto"></div>
	</div>
</div>
<div id="stat_iklan">
	<div class="button">
		<a rel="nofollow" class="buttonYellow postJobButton" href="<?php echo base_url()."perusahaan/lowongan_baru/"; ?>" alt="Buat Lowongan Baru" title="Buat Lowongan Baru">Buat Lowongan Baru</a>
		<a rel="nofollow" class="buttonYellow postJobButton" href="londo-edan.php" alt="Cari Pelamar Kerja" title="Cari Pelamar Kerja">Cari Pelamar Kerja</a>
	</div>
	<div style="clear:both;padding:10px">&nbsp;</div>
	<div class="bbottom">
		<b style="color:999999;">Detail Statistik Iklan</b>
	</div>
	<div>
		<table width="100%" cellpadding="0" cellspacing="0" border=''>
			<?php 
				$par['comp_id']	= $this->session->userdata('comp_id');
				$q_lowongan		= $this->lowongan_m->q_list_lowongan($par);
				if($q_lowongan->num_rows() > 0){
					foreach($q_lowongan->result() as $r_lowongan){

						if($r_lowongan->apply == NULL)
							$total_apply	= "<span style='font-size:10px;color:#BABABA'>Belum ada pelamar</span>";
						else
							$total_apply	= "<b>".number_format($r_lowongan->apply)."</b> Pelamar ";

						if($r_lowongan->view == NULL)
							$total_view	= "<span style='font-size:10px;color:#BABABA'>Belum ada yang melihat iklan</span>";
						else
							$total_view	= "<b>".number_format($r_lowongan->view)."</b> Pelihat Iklan";


						$par_stat['vac_id']	= $r_lowongan->vac_id;
						$q_stat	= $this->lowongan_m->d_stat($par_stat);

						$r_stat	= $q_stat->row();

						if($r_lowongan->view < $r_stat->sclick){
							$img_view	= "<img style='padding-top:5px;width:10px;' src='".base_url()."media/images/up_12.png'>";
							$d_view	= ($r_lowongan->view)-$r_stat->sclick;
						}else{
							$img_view	= "<img style='padding-top:5px;width:10px;' src='".base_url()."media/images/min_12.png'>";
							$d_view	= 0;
						}

						if($r_lowongan->apply < $r_stat->sapply){
							$img_apply	= "<img style='padding-top:5px;width:10px;' src='".base_url()."media/images/up_12.png'>";
							$d_apply	= ($r_lowongan->apply)-$r_stat->sapply;
						}else{
							$img_apply	= "<img style='padding-top:5px;width:10px;' src='".base_url()."media/images/min_12.png'>";
							$d_apply	= 0;
						}

			?>
			<tr>
				<td colspan="2"><b><?php echo $r_lowongan->vac_title; ?></b></td>
			<tr>
			<tr>
				<td style="background:#1BA5E0;color:#FFF;font-weight:bold">Total Pelamar</td>
				<td style="border-top:1px solid #1BA5E0;"><div style="float:left;width:300px;text-align:left"><?php echo $total_apply; ?></div><?php echo $img_apply; ?> <div style="float:left;width:20px;"><?php echo $d_apply; ?> </div>Pelamar Baru (Lihat Pelamar)</td>
			<tr>
			<tr style="box-shadow: 0 8px 6px -7px black;">
				<td style="background:#1BA5E0;color:#FFF;font-weight:bold">Total Viewer</td>
				<td><div style="float:left;width:300px;text-align:left"><?php echo $total_view; ?></div><?php echo $img_apply; ?> <div style="float:left;width:20px;"><?php echo $d_view; ?> </div> Viewer Baru</td>
			<tr>
			<tr>
				<td colspan="2" style="height:10px">&nbsp;</td>
			<tr>
			<?php
					}
				}
			?>
		</table>
	</div>
</div>

