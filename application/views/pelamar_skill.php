<div id='lang_edu'>
<script>
	function add_skill(){
		keahlian	= $('#keahlian').val();
		lama	= $('#lama').val();
		level	= $('#level').val();
		
		if(keahlian != "" && lama != "" && level != ""  ){
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/add_skill',
				data: 'keahlian='+keahlian+'&lama='+lama+'&level='+level,
				success: function(data) {
					loadfile('skill');				
				}
				
			})
		}else{
			$('#msg').html("<div class='failed'>Semua Field Harus Diisi</div>");
		}
	}

	function del_skill(id){

		if(id != ""){
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/del_skill',
				data: 'skill_id='+id,
				success: function(data) {
					loadfile('skill');				
				}
				
			})
		}
	}


</script>
	<div id="msg"></div>
	<table>
		<tr>
			<td>
				<div style="float:left;padding:10px 0;">
					<h2 class="top">Tambah Keahlian Khusus</h2>
					
				</div>
				<div id="tlang" style="clear:both">
					<table cellspacing='0' cellpadding='0' class="list">
						<thead>
							<tr>
								<th>Keahlian</th>
								<th>Lama (Tahun)</th>
								<th>Level</th>
								<th>hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($q_skill->num_rows() > 0){
									foreach($q_skill->result() as $r_skill){
							?>
							<tr>
								<td><?php echo $r_skill->keahlian; ?></td>
								<td align="center"><?php echo $r_skill->lama; ?></td>
								<td align="center"><?php echo $r_skill->level; ?></td>
								<td align="center"><a href="#" onclick="del_skill('<?php echo $r_skill->skill_id; ?>')"><img src="<?php echo base_url(); ?>media/images/delete.png" alt=""></a></td>
							</tr>
							<?php
									}
								}else{
							?>
							<tr>
								<td colspan="4">Belum ada data keahlian khusus yang dimasukan</td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="4" class="borderbotom">&nbsp;</td>
							</tr>
							<tr>
								<td colspan="4">Masukan Data Baru:</td>
							</tr>
							<tr>
								<td>Keahlian</td>
								<td><input type='text' id='keahlian' ></td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td>Lama Pengalaman</td>
								<td><input size="3" type='text' id='lama'> Tahun</td>
								<td>Tingkat / Level
									<select id="level">
										<option value='beginner'>beginner</option>
										<option value='itermediate'>itermediate</option>
										<option value='expert'>expert</option>
									</select>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan='3'>
									<div class="buttons" id="link_button">
										<a href="#" class="positive" onclick="add_skill()"><!-- class="regular"-->
											<img src="<?php echo base_url(); ?>media/images/add.png" alt=""> 
											Tambah Keahlian Khusus
										</a>
									</div>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div style="clear:both;height:20px;"></div>
			</td>
		</tr>
	</table>
</div>