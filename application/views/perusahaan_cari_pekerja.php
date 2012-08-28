<script language="javascript">
$(function(){
	$("#slider").noUiSlider('init', { startMin:'17', startMax:'40', scale: [17,50], tracker:
		function(){

			lowForS	= $('#slider').noUiSlider('getValue')[0].toFixed(0);
			highForS = $('#slider').noUiSlider('getValue', {point: 'upper'}).toFixed(0)
			$("#vlowForS").val(lowForS);
			$("#vhighForS").val(highForS);

			$("#lowForS").text( $('#slider').noUiSlider('getValue')[0].toFixed(0));
			$("#highForS").text( $('#slider').noUiSlider('getValue', {point: 'upper'}).toFixed(0));
		}
	});
});  

</script>
<div style="border:1px solid #EEE;border-radius:10px;padding:5px;">
   <form method="POST" id="myform" name="myform" action="<?php echo base_url(); ?>perusahaan/cari_pekerja">
	<div style="float:left;width:40%">
		<b>Bidang Keahlian : </b><select name='edu_field'>
			<option value="">n/a</option>
			<?php
				foreach($q_edu_field->result() as $r_field){
			?>
			<option value="<?php echo $r_field->edu_field_id; ?>" ><?php echo $r_field->edu_field_value; ?></option>
			<?php
				}
			?>
		</select>
	</div>	
	<div style="padding-left:45%">
		<div style="padding-bottom:5px;">Ketentuan Usia : <span id="lowForS" style="font-weight:bold">17</span> Sampai <span id="highForS" style="font-weight:bold">40</span> (Tahun)</div>
		<div id="slider" class="sliderbar" style="position: relative;"></div>
		<input name="vlowForS" id="vlowForS" value="17" type="hidden">
		<input name="vhighForS" id="vhighForS" value="40" type="hidden">		
		<div class="clear"></div>
	</div>
	<div style="width:500px;float:left;">
		<b>Gender :</b> 
		<input type="radio" name="jk" value="P"> Wanita <input type="radio" name="jk" value="L"> Pria <input type="radio" name="jk" value="" checked> Semua 
	</div>
	<div style="width:500px;float:left;">
		<b>Tingkat Pendidikan : </b><br>
		<?php
			foreach($q_edu_qualify->result() as $r_qualify){
		?>
			<div style="float:left;width:250px"><input type="checkbox" name="edu_qualify[]" value="<?php echo $r_qualify->edu_qualify_id; ?>"><?php echo $r_qualify->edu_qualify_value; ?></div> 		
		<?php
			}
		?>
	</div>
	<div style="clear:both;padding:20px 0 10px;width:100%" align="center">
		<input type="hidden" name="search" value="1">
		<a class="buttonSearch" href="#" onclick="submitform()" rel="nofollow">Cari Pekerja</a>	
	</div>	
	<div class="clear"></div>
   </form>
</div>


<div class="clear">&nbsp;</div>
<?php
	if($q_cari_pekerja->num_rows() > 0){
		foreach($q_cari_pekerja->result() as $r_pelamar){
		
		$jk	= $r_pelamar->sk_jns_klm;
		
		if($r_pelamar->sk_jns_klm == "L")
			$jk	= "Pria";
		else
			$jk	= "Wanita";
		
		$sk_tgl_lahir = $r_pelamar->sk_tgl_lahir;
?>
<div style="float:left;width:48%;box-shadow: 0 8px 6px -7px black;" class="list_pekerja">
	<div style="float:left;width:105px;padding:5px"><img width="100" src="<?php echo base_url()."media/upload/photo/thumb/".$r_pelamar->sk_photo; ?>"></div> 
	<div style="width:100%"><b><?php echo $r_pelamar->sk_nama; ?></b></div>
	<div style="width:100%"><?php echo $jk; ?> <?php echo date("d-M-Y", strtotime($sk_tgl_lahir))." (".floor((time() - strtotime($sk_tgl_lahir))/31556926).") tahun"; ?></div>
	<div style="width:100%"><?php echo $r_pelamar->edu_instansi; ?> - <?php echo $r_pelamar->edu_location; ?></div>
	<div style="width:100%"><?php echo $r_pelamar->city_value; ?>, <?php echo $r_pelamar->state_value; ?></div>
	<div style="width:100%;text-align:right;"><a href="<?php echo base_url()."perusahaan/detail_pekerja/".$r_pelamar->sk_id; ?>">Lihat Lebih Detail&nbsp;</a></div>
</div>
<?php
		}
	}
?>