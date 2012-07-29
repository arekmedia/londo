<div id="popupContact">		
	<p id="contactArea"></p>
</div>
<div id="backgroundPopup"></div>
<?php
	$msg		= "<div style='float:left;padding:3px 0;'><h2>".$q_num_lowongan." Lowongan Tersedia</h2></div>";
	$page_uri	= $this->uri->segment(4);
	$_ctr		= $this->uri->segment(1);
	$_ctg		= $this->uri->segment(2);
	$_id		= $this->uri->segment(3);
	$_ttl		= $this->uri->segment(5);
	$show_result	= TRUE;

	if($_ctg == 'search'){
		$_id		= "page";
	}
	if(is_numeric($page_uri) == FALSE){ 
		$page_uri = 1;
		$_ttl		= $this->uri->segment(4);
	}

	if($q_lowongan->num_rows() < 1 ){

		$msg	= "<div id='msg'><div class='notify'> Maaf, Kami tidak menemukan data yang cocok </div></div>";

		if($_ctg == 'search'){
			$msg	= "<div id='msg'><div class='notify'> Maaf, Kami tidak menemukan data yang cocok </div></div>";
			$show_result	= FALSE;		
		}else{
			$r_par['related_by']	= $_ctg;
			$r_par['related_data']	= $_id;	
			$q_related				= $this->lowongan_m->q_related($r_par);
			
			if($q_related !== NULL && $q_related->num_rows() > 0){
				$msg	.= "<div style='float:left;padding:3px 0;'><h2>Lowongan Terkait</h2></div>";
				$r_rel					= $q_related->row();
			
				if($r_par['related_by'] == 'kerja')
					$par['spes_level']	= $r_rel->spes_level;
				else if($r_par['related_by'] == 'kota')
					$par['state_id']	= $r_rel->state_id;

				$par['null']	= NULL;
				$par['page']	= $page_uri;
				$par['limit']	= $limit;
				$q_lowongan		= $this->lowongan_m->q_lowongan($par);
				$q_num_lowongan	= $this->lowongan_m->q_lowongan($par,TRUE);
			}
		}
	}

	$total_page	= ceil($q_num_lowongan/$limit);
?>

<div style="border:1px solid #EEE;border-radius:10px;padding:10px;">
   <form method="POST" id="myform" name="myform" action="<?php echo base_url(); ?>lowongan/search">
	<div style="float:left;width:40%">
	Spesialisasi 
	<select name="spes_id">
		<option>----- Pilih Spesifikasi -----</option>
	<?php
		if($q_main_spes->num_rows() > 0){
			$i	= 1;
			foreach($q_main_spes->result() as $spes_rows){
				echo "<optgroup label='".$spes_rows->spes_value."'>";
				foreach($q_main_spes_child[$spes_rows->spes_id]->result() as $spes_crows ){
					echo "<option value='".$spes_crows->spes_id."'>".$spes_crows->spes_value."</option>";			
				}				
			}
		}
	?>
	</select>
	</div>	
	<div style="float:left;">
	Lokasi 
	<select name="stateid_js" onchange="get_city_js_search(this.form)">
		<option value="">----- Pilih Semua Provinsi -----</option>
		<?php 
			$q_state	= $this->main_m->q_state();
			foreach($q_state->result() as $rows){ 
				echo "<option value='".$rows->state_id."' >".$rows->state_value."</option>";
		
			}
		?>
	</select>
	&nbsp;<span id="city_js">
	<select name='city_id_js' id='city_id_js'>
		<option value="">----- Pilih Semua Kota -----</option>
	</select>
	</span>
	</div>	
	<div class="clear"></div>
	<div style="padding-top:20px;width:100%" align="center">
		<a class="buttonSearch" href="#" onclick="submitform()" rel="nofollow">Cari Lowongan</a>	
	</div>	
	<div class="clear"></div>
   </form>
</div>
<div style="padding-top:10px">
<?php
	echo $msg;
?>
</div>
<div class="paging" style="float:right;">
  
  <?php

	if($q_num_lowongan > $limit){

		$a	= $page_uri+1;
		$b	= $page_uri-1;

		$link_a	= base_url().$_ctr."/".$_ctg."/".$_id."/".$a."/".$_ttl;
		$link_b	= base_url().$_ctr."/".$_ctg."/".$_id."/".$b."/".$_ttl;

		if($page_uri > 1 ){
			if($page_uri-2 > 1 && $total_page > 3){
				echo "<a href='".$link_b."' class='prevnext'>&larr; prev</a>";
				echo "<span class='disabled'>...</span>";
			}
	
			if($page_uri-2 <= 1)
				$min	= 1;
			else
				$min	= $page_uri-2;
			
			if($page_uri+2 >= $total_page)
				$max	= $total_page;
			else
				$max	= $page_uri+2;
					
		}else{
			$min	= 1;
			if($page_uri+2 >= $total_page)
				$max	= $total_page;
			else
				$max	= $page_uri+2;
		}

		for($i=$min;$i<=$max;$i++){	
			$link	= base_url().$_ctr."/".$_ctg."/".$_id."/".$i."/".$_ttl;

			if($page_uri == $i)
				echo "<span class='current'>".$i."</span>";
			else
				echo "<a href='".$link."'>".$i."</a>";
  ?>

  <?php
		}
		if($total_page > $page_uri+3) echo   "<span class='disabled'>...</span>";

		if($page_uri+2 < $total_page) echo "<a href='".$link_a."' class='prevnext'>next &rarr;</a>";
	}
  ?>

</div>
<table id="rounded-corner" cellspacing="0" cellpadding="0">
	<tbody>
	<?php
	  if($show_result == TRUE){
		foreach($q_lowongan->result() as $rows){
			$salary	= number_format($rows->vac_salary_min)." - ".number_format($rows->vac_salary_max);
			if($rows->vac_salary_min == 0 && $rows->vac_salary_max == 0){
				$salary	= "negotiable";
			}
		
		$par['vac_id']	= $rows->vac_id;
		$q_loc	= $this->lowongan_m->q_location_lowongan($par);
		$city_list = "";

		foreach($q_loc->result() as $r_loc){
			$city_list .= $r_loc->city_value." ";
		}
	?>
		<tr>
			<td>
			<div id="listLowongan">
				<div class="side-left">
					<a class="title" href="<?php echo base_url()."lowongan/detail/".$rows->vac_id."/".url_title($rows->spes_value)."/".url_title($rows->vac_title).".html"; ?>"><?php echo $rows->vac_title;?><br>
					<a class="company" href="<?php echo base_url()."lowongan/kerja/".$rows->spes_id."/".url_title($rows->spes_value).".html"; ?>"><?php echo $rows->spes_value;?></a> - 
					<a class="company" style="color:#5A9161;" href="<?php echo base_url()."lowongan/perusahaan/".$rows->comp_id."/".url_title($rows->comp_nama).".html"; ?>"><?php echo $rows->comp_nama;?></a>
				</div>
				<div class="side-center">
					<div class="small-detail">Salary IDR <?php echo $salary; ?></div>
					<div class="small-detail">Location <?php echo $city_list;?></div>
				</div>
				<div>
					<a class="buttonOrange" href="<?php echo base_url()."lowongan/detail/".$rows->vac_id."/".url_title($rows->spes_value)."/".url_title($rows->vac_title).".html"; ?>" rel="nofollow">Lihat Detail</a> &nbsp;&nbsp;&nbsp;&nbsp;
					<a class="buttonGreen" onclick="loadfileid('apply','<?php echo $rows->vac_id; ?>')" href="#" rel="nofollow">Kirim Lamaran</a>
				</div>	
			</div>
			</td>		
		</tr>
	<?
		}
	  }
	?>
	</tbody>
</table>