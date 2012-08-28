<script type="text/javascript">
	$('#city_list').val('0');
	function del_vac_city(id){
		var city_list	= $('#city_list').val();
		var mySplitResult = city_list.split(",");
		new_city_list	= "0";
		for(i = 0; i < mySplitResult.length; i++){
			if(mySplitResult[i] != id){
				new_city_list	+=  ','+mySplitResult[i];
				$('#city_list').val(new_city_list);
				
			}
		}
		get_city();
	}
	function add_vac_city(){
		var sama = 'no';
		var new_city	= $('#city_id_js').val();

		var city_list	= $('#city_list').val();
		var mySplitResult = city_list.split(",");

		for(i = 0; i < mySplitResult.length; i++){
			if(mySplitResult[i] == new_city){
				sama = 'yes';
			}
		}

		if(sama == 'no'){
			var new_city_list	= city_list+","+new_city;
			$('#city_list').val(new_city_list);
			get_city();

		}

	}
	function get_city(){
		$('#message_city').html("<img src='"+uri+"media/images/loading.gif'> Loading...");
		$.ajax({
			type: 'POST',
			url: uri+'perusahaan/lowongan_kota',
			data: 'city_list='+$('#city_list').val(),
			success: function(data) {
				var city_list	= data;
				var mySplitResult = city_list.split(",");
				var daftar_kota = ""; 
				for(i = 0; i < mySplitResult.length; i++){
					daftar_kota += '<div style=\'float:left;width:150px\'>'+mySplitResult[i]+'</div>';
				}
				if(mySplitResult.length == 1)
					var daftar_kota = "<div style='font-size:10px'>Tambah kota terlebih dahulu</div>";				
				
				
				$('#daftar_kota').html(daftar_kota+"<div style='padding:20px 0'>&nbsp;</div>");				
				$('#message_city').html("");

			}
		})
	}

	function create_lowongan(){
		$.ajax({
			type: 'POST',
			url: uri+'perusahaan/lowongan_baru',
			data: $('#lowbaru').serialize(),
			success: function(data) {
				//alert($('#lowbaru').serialize());
				$('#msg').html(data);
				$('#vac_title').val('');
			}
		})
	}

	function get_salary(){

		if($('#nego').is(':checked')){
			$('#vac_salary_min').attr('disabled', 'disabled');
			$('#vac_salary_max').attr('disabled', 'disabled');
		}else{
			$('#vac_salary_min').removeAttr('disabled');
			$('#vac_salary_max').removeAttr('disabled');
		}
	}
</script>
<div id="bar">
	BUKA LOWONGAN BARU
</div>
<div id="msg"></div>
<form method="post" id="lowbaru" name="lowbaru">
<input type="hidden" name="city_list" id="city_list" value="0">
<input type="hidden" name="create" value="1">
<div class="buttons" id="link_button" style="float:right">
	<a class="positive" href="#" onclick="create_lowongan();"><!-- class="regular"-->
		<img src="<?php echo base_url(); ?>media/images/add.png" alt=""> 
		Posting Sekarang
	</a>
</div>
<div style="clear:both"></div>
<fieldset style="border:1px dashed #E09B1B">
	<legend><b>Materi Lowongan</b></legend>
	<table width="100%">
	<tr>
		<td width="20%">Spesialisasi Lowongan</td>
		<td>	
			<select name="spes" id="spes">
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
		</td>
	</tr>
	<tr>
		<td>Level Posisi</td>
		<td>	
			<select name="pos" id="pos">
			<?php
				if($q_pos_level->num_rows() > 0){
					$i	= 1;
					foreach($q_pos_level->result() as $pos_rows){
						echo "<option value='".$pos_rows->pos_id."'>".$pos_rows->pos_level."</option>";			
					}
				}

			?>
			</select>
		</td>
	</tr>
	<tr>
		<td>Tanggal Tayang</td>
		<td><input type="text" id="datepicker" name="vac_sdate" size="12" maxlength="10"> (Masa Tayang 1 Bulan)</td>
	</tr>
	<tr>
		<td>Judul Materi</td>
		<td><input type="text" id="vac_title" name="vac_title" size="50"></td>
	</tr>
	<tr>
		<td>Materi Lowongan</td>
		<td>
			<textarea style="width:50%" name="vac_detail" id="vac_detail" class="tinymce" ></textarea>
		</td>
	</tr>
	<tr>
		<td width="20%">Gaji Per Bulan</td>
		<td><input type="text" name="vac_salary_min" id="vac_salary_min"> s/d <input type="text" name="vac_salary_max" id="vac_salary_max"> <input onclick="get_salary()" type="checkbox" name="nego" id="nego" value="1"> Negotiable</td>
	</tr>
</table>
</fieldset>
<br>
<fieldset style="border:1px dashed #E09B1B">
	<legend><b>Penempatan Kerja Lowongan</b></legend>
	<table width="100%">
		<tr>
			<td width="20%">Penempatan Kerja</td>
			<td> 
				<select name="stateid_js" onchange="get_city_js(this.form)">
					<?php 
						$q_state	= $this->main_m->q_state();
						foreach($q_state->result() as $rows){ 
		
							echo "<option value='".$rows->state_id."' >".$rows->state_value."</option>";
				
						}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td>kota</td>
			<td><span id="city_js">
				<select name='city_id_js' id='city_id_js'>
					<?php 
						$q_state	= $this->main_m->get_city(282);
						foreach($q_state->result() as $rows){ 
		
							echo "<option value='".$rows->city_id."'>".$rows->city_value."</option>";
			
						}

					?>
				</select>
				</span>&nbsp;<a style="cursor:pointer" onmousedown="add_vac_city()" style="padding-top:10px"> <img src="<?php echo base_url()."/media/images/add_12.png"; ?>"> Tambah Kota</a>
				<br><b>Daftar Lokasi Penempatan Kerja</b><div id="message_city"></div><div id="daftar_kota"><div style='font-size:10px'>Tambah kota terlebih dahulu</div></div>
			</td>
		</tr>
	</table>
</fieldset>
<br>
<fieldset style="border:1px dashed #E09B1B;background-color:#F7F5B7;">
	<legend><b>Tentukan Kriteria Pelamar</b></legend>
	<table width="100%">
		<tr>
			<td width="20%">Jenis Kelamin</td>
			<td>
				<select name="sk_jns_klm">
					<option>n/a</option>
					<option value="L">Laki-Laki</option>
					<option value="P">Pemempuan</option>
				</select>
			</td>
		</tr>
		<tr>
			<td width="20%">Usia (Max)</td>
			<td>
				<input type="text" size="3" maxlength="2" name="sk_age">  Thn
			</td>
		</tr>
		<tr>
			<td width="20%">Pendidikan Terakhir </td>
			<td>
				<?php 
					$q_edu_qualify	= $this->edu_m->edu_qualify();
					
					if($q_edu_qualify->num_rows() > 0){
						echo "<select name='edu_qualify_id'>";
						echo "<option>n/a</option>";
						foreach($q_edu_qualify->result() as $r_edu_qualify){
						
							echo "<option value='".$r_edu_qualify->edu_qualify_id."'>".$r_edu_qualify->edu_qualify_value."</option>";
						
						}
						
						echo "</select>";
					}
				
				?>

			</td>
		</tr>
		<tr>
			<td width="20%">Bidang Studi / Jurusan </td>
			<td>
				<?php
					$q_edu_field	= $this->edu_m->edu_field();
					if($q_edu_field->num_rows() > 0){
						echo "<select name='edu_field_id'>";
						echo "<option>n/a</option>";
						foreach($q_edu_field->result() as $r_edu_field){
							echo "<option value='".$r_edu_field->edu_field_id."' >".$r_edu_field->edu_field_value."</option>";
						}
						echo "</select>";
					}
				
				?>
			</td>
		</tr>
		<tr>
			<td width="20%">Lama Pengalaman Kerja (Min)</td>
			<td><input type="text" size="3" maxlength="2" name="sk_exper"> Thn</td>
		</tr>
		<tr>
			<td colspan="2">
				<div style="font-size:10px;">Kriteria pelamar membantu anda dalam mencari calon pekerja yang berkualitas dan handal.<br><font color="red">*</font>) Tidak akan tercantum dalam iklan lowongan. </div>
			</td>
		</tr>
	</table>
</fieldset>
<div style="height:20px">&nbsp;</div>
</form>
