<script>

function save_resume(){
	//tinyMCE.triggerSave();
	resume	= $('#resume_text').html();

	$.ajax({
		type: 'POST',
		url: uri+'pelamar/p_resume_text',
		data: 'resume_text='+resume+'&simpan_resume=1',
		success: function(data) {
			$('#resume_status').html(data);
		}
	}) 

}


function delete_exper(id){
	
	jConfirm('Hapus Pengalaman Kerja', 'Konfirmasi Tindakan', function(r) {
		if(r == true){
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/p_exper_del/'+id,
				data: $('#exper').serialize(),
				success: function(data) {
					$('#exper_status').html(data);
					load_exper_list();
				}
			}) 
		}
	});
}

function update_account(){
	$.ajax({
		type: 'POST',
		url: uri+'pelamar/p_account_edit',
		data: $('#account').serialize(),
		success: function(data) {
			$('#account_status').html(data);
			//alert(data);
		}
	}) 
}

function update_privacy(){
	$.ajax({
		type: 'POST',
		url: uri+'pelamar/p_update_privacy',
		data: $('#privacy').serialize(),
		success: function(data) {
			$('#account_status').html(data);
			//alert(data);
		}
	}) 
}


function add_exper(){
	$.ajax({
		type: 'POST',
		url: uri+'pelamar/p_exper_add',
		data: $('#msg').serialize(),
		success: function(data) {
			$('#msg').html(data);
			load_exper_list();
		}
	}) 
}

function del_edu(id){
	jConfirm('Hapus Tingkat Pendidikan', 'Konfirmasi Tindakan', function(r) {
		if(r == true){
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/p_data_edu_del/'+id,
				data: $('#exper').serialize(),
				success: function(data) {
					$('#msg').html(data);
					load_exper_list();
				}
			})
			$('#edu_'+id).remove();
		}
	});
}




</script>

<?php

	/*Data Diri*/
	if($q_data_diri->num_rows() > 0){
		$row_dd	= $q_data_diri->row();
	
		$sk_nama	= $row_dd->sk_nama;
		$sk_photo	= $row_dd->sk_photo;
		$email		= $row_dd->email;
		$sk_no_tlp	= $row_dd->sk_no_tlp;
		$sk_no_hp	= $row_dd->sk_no_hp;
		$sk_tgl_lahir	= $row_dd->sk_tgl_lahir;
		$sk_alamat		= $row_dd->sk_alamat;
		$sk_alamat		= $row_dd->sk_alamat;
		$state_id		= $row_dd->state_id;
		$state_value		= $row_dd->state_value;
		$city_value			= $row_dd->city_value;
		$city_id			= $row_dd->city_id;
		if($row_dd->sk_jns_klm == 'L') $jk	= "Laki-Laki";
		if($row_dd->sk_jns_klm == 'P') $jk	= "Perempuan";
		
	}else{
		$sk_photo		= "noavatar.jpg";
		$sk_nama		= "-";
		$email			= "-";
		$sk_no_tlp		= "-";
		$sk_no_hp		= "-";
		$sk_tgl_lahir	= "-";
		$sk_alamat		= "-";
		$sk_alamat		= "-";
		$state_value	= "-";
		$city_value		= "-";
		$state_id		= "";
		$city_id		= "";
	}
	
	/*[!] Resume */
	if($q_resume->num_rows() > 0){
		$r_resume = $q_resume->row();
		
		$txt_resume = $r_resume->resume_detail;
	}else{
		$txt_resume = "";	
	}
	
?>
	<div id="popupContact">		
		<p id="contactArea"></p>
	</div>
	<div id="backgroundPopup"></div>
	<div style="float:left">
		<ul class="menu">  
			<li id="1" class="active">Profile</li>  
			<li id="2">Resume</li>  
			<li id="3">Employment History</li>  
			<li id="4">Setting</li>  
		</ul>  
	</div>

	<span class="clear"></span>  
	<div class="content 1">  
		<div id="msg"></div>
		<form method="post" name="profileForm" style="padding-top:10px;" id="reg_input">
			<div>
				<table>
					<tr>
						<td>
							<div style="float:left;width:200px;">
								<div id="uploaded_preview"><img class="photoProfile" src="<?php echo base_url(); ?>media/upload/photo/thumb/<?php echo $sk_photo; ?>"></div>
								
								<input id="file_upload" name="file_upload" type="file" />
							</div>

							<div style="float:left;padding-left:20px">
								<h2 class="top" style="padding-top:5px;">Data Diri</h2>
							</div>
							<div style="float:right;width:300px;">						
								<div class="notify">Belum Siap Untuk Melamar Pekerjaan</div>
							</div>
							<div style="clear:right;padding-top:10px;"></div>

							<div style="float:left;padding-left:20px;width:415px;">
								<table width="100%">
									<tr>
										<td width="150px">Nama Lengkap</td>
										<td>: <span class="nama" id="name"><?php echo $sk_nama; ?></span></td>
									</tr>
									<tr>
										<td>Email</td>
										<td>: <span class="email" id="email"><?php echo $email; ?></span></td>
									</tr>
									<tr>
										<td>Jenis Kelamin</td>
										<td>: <?php echo $jk; ?></td>
									</tr>
									<tr>
										<td>No. Telephone</td>
										<td>: <span class="tlp" id="tlp"><?php echo $sk_no_tlp; ?></span></td>
									</tr>
									<tr>
										<td>Mobile</td>
										<td>: <span class="mobile" id="mobile"><?php echo $sk_no_hp; ?></span></td>
									</tr>
									<tr>
										<td>Alamat</td>
										<td>: <span class="alamat" id="alamat"><?php echo $sk_alamat; ?></span></td>
									</tr>
									<tr>
										<td>provinsi</td>
										<td>: <?php echo $state_value; ?></td>
									</tr>
									<tr>
										<td>kota</td>
										<td>: <?php echo $city_value; ?></td>
									</tr>
									<tr>
										<td>Tgl Lahir</td>
										<td>: <span id='bd'><?php echo date("d-M-Y", strtotime($sk_tgl_lahir))." (".floor((time() - strtotime($sk_tgl_lahir))/31556926).") tahun"; ?></span> </td>
									</tr>
									<tr>
										<td colspan='2'>
											<div class="buttons" id="link_button">
												<a href="#" class="positive" onclick="loadfile('profile')"><!-- class="regular"-->
													<img src="<?php echo base_url(); ?>media/images/profile.png" alt=""> 
													Edit Profile
												</a>
											</div>
										</td>
									</tr>
								</table>
							</div>						
							<div style="clear:both;height:20px;"></div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="float:left;">
								<h2 class="top">Latar Pendidikan</h2>
							</div>
								<table cellspacing="0">
									<tbody>
									<tr>
										<th width="350px">Tingkat Pendidikan</th>
										<th width="350px">Nama Instansi Pendidikan</th>
										<th width="250px">Tahun Pendidikan</th>
										<th width="250px">Grade</th>
										<th width="250px">Action</th>
									</tr>
								<?php
								
									if($q_pendidikan->num_rows() > 0){
										//$row_pd	= $q_pendidikan->row();
										
										foreach($q_pendidikan->result() as $row_pd){
										
										$edu_qualify_value	= $row_pd->edu_qualify_value;
										$edu_qualify_id	= $row_pd->edu_qualify_id;
										$edu_field_id	= $row_pd->edu_field_id;
										$edu_grade			= $row_pd->edu_grade;
										$edu_field_value	= $row_pd->edu_field_value;
										$edu_thn_ajaran		= $row_pd->edu_thn_ajaran;
										$edu_instansi		= $row_pd->edu_instansi;
										$edu_location		= $row_pd->edu_location;
										$thn_ajaran		= explode('|',$edu_thn_ajaran);
									
										if($edu_qualify_id == '1') $bg_color = '#DAF09E';
										if($edu_qualify_id == '2') $bg_color = '#9ED0F0';
										if($edu_qualify_id == '3') $bg_color = '#89A6FA';
										if($edu_qualify_id == '4') $bg_color = '#89FAB3';
										if($edu_qualify_id == '5') $bg_color = '#FAB889';
										if($edu_qualify_id == '6') $bg_color = '#F5AEBD';
									
								?>
									<tr id='edu_<?php echo $row_pd->edu_id; ?>'>
										<td><?php echo $edu_qualify_value; ?></td>
										<td><?php echo $edu_instansi; ?> - <?php echo $edu_location; ?></td>
										<td align='center'><?php echo $thn_ajaran[0]." sampai ".$thn_ajaran[1]; ?></td>
										<td align='center'><b><?php echo $edu_grade; ?></b></td>
										<td align='center'><a onmousedown="loadfileid('edu','<?php echo $row_pd->edu_id; ?>')"><img src="<?php echo base_url()."media/images/edit.png"; ?>">&nbsp;</a> <a onmousedown="del_edu('<?php echo $row_pd->edu_id; ?>');"><img src="<?php echo base_url()."media/images/delete.png"; ?>"></a></td>
									</tr>
									
								<?php
									}
								}
								?>
									<tr>
										<td colspan='2'>											
											<div class="buttons" id="link_button">
												<a href="#" class="positive" onclick="loadfile('latar_pendidikan')"><!-- class="regular"-->
													<img src="<?php echo base_url(); ?>media/images/education.png" alt=""> 
													Tambah Tingkat Pendidikan
												</a>
											</div>
										</td>
									</tr>
									</tbody>

								</table>
							<div style="clear:both;height:20px;"></div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="float:left;">
								<h2 class="top">Penguasaan Bahasa</h2>
							</div>
								<table cellspacing="0">
									<thead>
										<tr>
											<th width="200px">Bahasa</th>
											<th width="20px">Spoken</th>
											<th width="20px">Writen</th>
										</tr>
									</thead>
									<tbody>
									<?php
										if($q_bahasa->num_rows() > 0){
											foreach($q_bahasa->result() as $row_bahasa){
												$lang_values	= $row_bahasa->lang_values;
												$lang_skill_s	= $row_bahasa->lang_skill_s;
												$lang_skill_w	= $row_bahasa->lang_skill_w;
												
												$s_color	= "FFF";
												$w_color	= "FFF";

												if($lang_skill_s < 5)
													$s_color	= "#F00000";
												elseif($lang_skill_s > 4 && $lang_skill_s < 8)
													$s_color	= "#F0DC00";
												elseif($lang_skill_s > 7 )
													$s_color	= "#0ABF00";
													
												if($lang_skill_w < 5)
													$w_color	= "#F00000";
												elseif($lang_skill_w > 4 && $lang_skill_w < 8)
													$w_color	= "#F0DC00";
												elseif($lang_skill_w > 7 )
													$w_color	= "#0ABF00";
													

									?>
										<tr>
											<td width="200px"><?php echo $lang_values; ?></td>
											<td align="center" style="font-weight:bold;color:<?php echo $s_color; ?>"><?php echo $lang_skill_s; ?></td>
											<td align="center" style="font-weight:bold;color:<?php echo $w_color; ?>"><?php echo $lang_skill_w; ?></td>
										</tr>

									<?php
											}
										}
									?>
										<tr>
											<td colspan='3'>
												<div class="buttons" id="link_button">
													<a href="#" class="positive" onclick="loadfile('edu_bahasa')"><!-- class="regular"-->
														<img src="<?php echo base_url(); ?>media/images/language.png" alt=""> 
														Edit Penguasaan Bahasa
													</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							<div style="clear:both;height:20px;"></div>
						</td>
					</tr>
					<tr>
						<td>
							<div style="float:left;">
								<h2 class="top">Skill/Keahlian Khusus</h2>
							</div>
								<table cellspacing="0">
									<thead>
										<tr>
											<th width="200px">Keahlian</th>
											<th width="20px">Lama Pengalaman(thn)</th>
											<th width="200px">Tingakat Keahlian</th>
										</tr>
									</thead>
									<tbody style="border-width: 1px 0 1px;">
										<?php
											if($q_skill->num_rows() > 0){
												foreach($q_skill->result() as $r_skill){
													$keahlian	= $r_skill->keahlian;
													$lama		= $r_skill->lama;
													$level		= $r_skill->level;
													
										?>
											<tr>
												<td width="200px"><?php echo $keahlian; ?></td>
												<td align="center"><?php echo $lama; ?></td>
												<td align="center"><?php echo $level; ?></td>
											</tr>

										<?php
												}
											}
										?>
										<tr>
											<td colspan='3'>
												<div class="buttons" id="link_button">
													<a href="#" class="positive" onclick="loadfile('skill')"><!-- class="regular"-->
														<img src="<?php echo base_url(); ?>media/images/skill.png" alt=""> 
														Edit Keahlian Khusus
													</a>
												</div>
											</td>
										</tr>
									</tbody>
								</table>
							<div style="clear:both;height:20px;"></div>
						</td>
					</tr>
				</table>
			</div>
		</form>
	</div> 
	<div class="content 2" id="2">
		<div><h2>Tulis Resume Lamaran Pekerjaan</h2>
		<div id="resume_status"></div>
		<br>
		
			<textarea name="resume_text" id="resume_text" class="tinymce"><?php echo $txt_resume; ?></textarea>
			<div class="buttons" id="link_button">
				<a href="#" class="positive" onclick="save_resume();"><!-- class="regular"-->
					<img src="<?php echo base_url(); ?>media/images/save.png" alt=""> 
					Simpan Resume Lamaran
				</a>
			</div>
		</div>
		
	</div>  
	<div class="content 3">  
		<div style="float:left;">
			<h2 class="top" style="padding-top:5px;">Daftar Pengalaman Kerja</h2>
		</div>
		<div id="exper_status" style="clear:both"></div>
		<div>
			<div style="clear:both;height:20px;"></div>
			<form method="post" id="exper">
				<table>
					<tr>
						<td width="25%">Nama Perusahaan </td>
						<td>&nbsp; <input type="text" name="exper_comp"></td>
					</tr>
					<tr>
						<td width="25%">Posisi/Jabatan </td>
						<td>&nbsp; <input type="text" name="exper_position"></td>
					</tr>
					<tr>
						<td width="25%">Lama Bekerja</td>
						<td>&nbsp; 
							<select name="bln1">
								<?php
									for($b=1;$b<=12;$b++){
										
									if($b == 1) $bulan = "januari";
									elseif($b == 2) $bulan = "febuari";
									elseif($b == 3) $bulan = "maret";
									elseif($b == 4) $bulan = "april";
									elseif($b == 5) $bulan = "mei";
									elseif($b == 6) $bulan = "juni";
									elseif($b == 7) $bulan = "juli";
									elseif($b == 8) $bulan = "agustus";
									elseif($b == 9) $bulan = "september";
									elseif($b == 10) $bulan = "oktober";
									elseif($b == 11) $bulan = "november";
									elseif($b == 12) $bulan = "desember";
								?>
								<option value="<?php echo $b; ?>"><?php echo $bulan; ?></option>
								<?php
									}
								?>
							</select>
							<select name="thn1">
								<?php
									for($c=1990;$c<=date("Y");$c++){
								?>
								<option value="<?php echo $c; ?>"><?php echo $c; ?></option>
								<?php
									}
								?>
							</select> Sampai
							<select name="bln2">
								<?php
									for($b=1;$b<=12;$b++){
										
									if($b == 1) $bulan = "januari";
									elseif($b == 2) $bulan = "febuari";
									elseif($b == 3) $bulan = "maret";
									elseif($b == 4) $bulan = "april";
									elseif($b == 5) $bulan = "mei";
									elseif($b == 6) $bulan = "juni";
									elseif($b == 7) $bulan = "juli";
									elseif($b == 8) $bulan = "agustus";
									elseif($b == 9) $bulan = "september";
									elseif($b == 10) $bulan = "oktober";
									elseif($b == 11) $bulan = "november";
									elseif($b == 12) $bulan = "desember";
								?>
								<option value="<?php echo $b; ?>"><?php echo $bulan; ?></option>
								<?php
									}
								?>
							</select>
							<select name="thn2">
								<?php
									for($c=1990;$c<=date("Y");$c++){
								?>
								<option value="<?php echo $c; ?>"><?php echo $c; ?></option>
								<?php
									}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td>Jenis Perusahaan/Industri</td>
						<td>&nbsp; 	
							<select name="comp_type_id">
							<?php 
								echo "<option value=''>--Pilih Industri--</option>";
								foreach($q_industri->result() as $rows){
									echo "<option value='".$rows->comp_type_id."'  ".selected($rows->comp_type_id,$comp_type_id,"selected").">".$rows->comp_type_value."</option>";
								
								}
							?></select>
						</td>
					</tr>
					<tr>
						<td>Spesialisasi </td>
						<td>&nbsp; 	
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
						<td>Gaji per Bulan (Rp.)</td>
						<td>&nbsp; <input type="text" name="exper_salary"></td>
					</tr>
					<tr>
						<td>Deskripsi Pekerjaan</td>
						<td>&nbsp;&nbsp;<textarea name="exper_jobdesc"></textarea></td>
					</tr>
					<tr>
						<td>Alasan Keluar</td>
						<td>&nbsp;&nbsp;<textarea name="alasan_keluar"></textarea></td>
					</tr>
					<tr>
						<td></td>
						<td>
							<div class="buttons" id="link_button">
								<a href="#" class="positive" onclick="add_exper()"><!-- class="regular"-->
									<img src="<?php echo base_url(); ?>media/images/add.png" alt=""> 
									Tambah Pengalaman Kerja
								</a>
							</div>
						</td>
					</tr>
				</table>
			</form>
		</div>		
		<div id="lp">
		</div>		
	</div>  
	<div class="content 4">  
		<div style="float:left;">
			<h2 class="top" style="padding-top:5px;">Pengaturan</h2>
		</div>
		<div style="clear:both;height:20px;" ></div>
			<div id="account_status"></div>

		<form id="account" name="account" method="POST">
			<table>
				<thead>
					<tr>
						<th colspan="2" style="text-align:left">Pengaturan Akun </th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td width="30%">Username</td>
						<td width="70%"><input type="text" name="username" ></td>
					</tr>
					<tr>
						<td>Password Lama</td>
						<td><input type="password" name="password_lama"></td>
					</tr>
					<tr>
						<td>Password Baru</td>
						<td><input type="password" name="password_baru"></td>
					</tr>
					<tr>
						<td>Ulangi Password Baru</td>
						<td><input type="password" name="cpassword_baru"></td>
					</tr>
					<tr>
						<td colspan="2">
							<div class="buttons" id="link_button">
								<a href="#" class="positive" onclick="update_account();"><!-- class="regular"-->
									<img src="<?php echo base_url(); ?>media/images/profile.png" alt=""> 
									Ubah Data Akun
								</a>
							</div>
						</td>
					</tr>

				</tbody>
			</table>
		</form>
		<div style="clear:both;height:20px;"></div>
		<form id="privacy" name="privacy" method="POST">
		<table>
			<thead>
				<tr>
					<th colspan="2" style="text-align:left">Pengaturan Kebebasan Pribadi</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$q_rule	= $this->js_m->rule();
					if($q_rule->num_rows() > 0){
						foreach($q_rule->result() as $r_rule){

						$par['sk_id']		= $this->session->userdata('sk_id');
						$par['rule_id']	= $r_rule->rule_id;
						$q_privacy	= $this->js_m->privacy($par);

						$r_privacy	= $q_privacy->row();
						
						if($q_privacy->num_rows() > 0) $priv_val	= $r_privacy->value;
						if($q_privacy->num_rows() < 1) $priv_val	= "0";

				?>


				<tr>
					<td width="85%" ><?php echo $r_rule->rule_value; ?></td>
					<td align="right">
						<input type="radio" name="<?php echo $r_rule->rule_id; ?>" value="1" <?php echo selected('1',$priv_val,'checked'); ?>> Ya
						<input type="radio" name="<?php echo $r_rule->rule_id; ?>" value="0" <?php echo selected('0',$priv_val,'checked'); ?>> Tidak
					</td>
				</tr>
				<?php
						}
					}

				?>
				<tr>
					<td colspan="2">
						<div class="buttons" id="link_button">
							<a href="#" class="positive" onclick="update_privacy()"><!-- class="regular"-->
								<img src="<?php echo base_url(); ?>media/images/privacy.png" alt=""> 
								Ubah Data Akun
							</a>
						</div>
					</td>
				</tr>

			</tbody>
		</table>
		</form>
	</div>  
