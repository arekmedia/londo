<div id='lang_edu'>
<script>
	function add_lang(){
		lang	= $('#lang').val();
		skill_s	= $('#skill_s').val();
		skill_w	= $('#skill_w').val();
		
		if(lang != "" && skill_s != "" && skill_w != ""  ){
		
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/add_edu_lang',
				data: 'lang='+lang+'&skill_s='+skill_s+'&skill_w='+skill_w,
				success: function(data) {
					loadfile('edu_bahasa');
					//$('#msg').html("<div class='success'>Data Berhasil Ditambah</div>");
				}
				
			})
		}else{
			$('#msg').html("<div class='failed'>Semua field harus diisi</div>");
			$('#msg').show('slow');		
		}
	}
	
	function del_lang(id){

		if(id != ""){
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/del_edu_lang',
				data: 'edu_lang_id='+id,
				success: function(data) {
					loadfile('edu_bahasa');				
				}
				
			})
		}
	}
</script>
	<div id="msg"></div>
	<form method="POST">
	<table>
		<tr>
			<td>
				<div style="float:left;padding:10px 0;">
					<h2 class="top">Tambah Penguasaan Bahasa</h2>
					
				</div>
				<div id="tlang" style="clear:both">
					<table cellspacing='0' cellpadding='0' border='1' class="list">
						<thead>
							<tr>
								<th>Bahasa</th>
								<th>Nilai Lisan</th>
								<th>Nilai Tulis</th>
								<th>hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($q_lang->num_rows() > 0){
									foreach($q_lang->result() as $r_lang){
							?>
							<tr onMouseover="this.style.backgroundColor='#BEE2EB';" onMouseout="this.style.backgroundColor='#FFF';">
								<td ><?php echo $r_lang->lang_values; ?></td>
								<td align="center"><?php echo $r_lang->lang_skill_s; ?></td>
								<td align="center"><?php echo $r_lang->lang_skill_w; ?></td>
								<td align="center"><a href="#" onclick="del_lang('<?php echo $r_lang->edu_lang_id; ?>')"><img src="<?php echo base_url()."media/images/delete.png"; ?>"></a></td>
							</tr>
							<?php
									}
								}else{
							?>
							<tr>
								<td colspan="4">Belum ada data bahasa yang dimasukan</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td >
				Masukan Data Baru : <br>
					<div style="clear:both"><div style="float:left;width:20%;line-height:22px">Bahasa </div><input size="30" type='text' id='lang' name='lang' ></div>
					<div style="clear:both"><div style="float:left;width:20%;line-height:22px">Nilai Lisan </div><input maxlength="1" size="20" type='text' id='skill_s' name='skill_s'></div>
					<div  style="clear:both"><div style="float:left;width:20%;line-height:22px">Nilai Tulis </div><input maxlength="1" size="20" type='text' id='skill_w' name='skill_w'></div>
					<span>&nbsp;</span>
					<div class="buttons" id="link_button">
						<a href="#" class="positive" onclick="add_lang()"><!-- class="regular"-->
							<img src="<?php echo base_url(); ?>media/images/add.png" alt=""> 
							Tambah Bahasa
						</a>
					</div>
					<div style="font-weight:bold;padding-top:20px">Nilai Tulis dan Lisan</div>
					<!-- <span style="padding:3px 10px;" class="failed">Nilai 1 s/d 4 Tidak Menguasai</span>
					<span style="padding:3px 10px;" class="notify">Nilai 5 s/d 7 Cukup Menguasai</span>
					<span style="padding:3px 10px;" class="success">Nilai 8 s/d 9 Sangat Menguasai</span>
					-->
					
				<div style="clear:both;height:20px;"></div>
			</td>
		</tr>
	</table>
	</form>
</div>