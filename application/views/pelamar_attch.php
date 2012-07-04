<div id='lang_edu'>
<script>
	function add_attch(){
		userfile	= $('#userfile').val();
		type		= $('#type').val();
		
		if(userfile != "" && type != ""  ){
			alert(userfile);
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/add_attch',
				data: 'userfile='+userfile+'&type='+type,
				success: function(data) {
					alert(data);
					loadfile('attch');				
				}
				
			})
		}else{
			$('#msg').html("Semua Field Harus Diisi");
		}
	}

	function del_skill(id){

		if(id != ""){
			$.ajax({
				type: 'POST',
				url: uri+'pelamar/del_attch',
				data: 'attch_id='+id,
				success: function(data) {
					loadfile('attch');				
				}
				
			})
		}
	}


</script>
	<div id="msg"></div>
	<form enctype="multipart/form-data" method='post'>
	<table>
		<tr>
			<td>
				<div style="float:left;padding:10px 0;">
					<h2 class="top">Tambah Lampiran</h2>
					
				</div>
				<div id="tlang" style="clear:both">
					<table cellspacing='0' cellpadding='0' border='1'>
						<thead>
							<tr>
								<th>Nama File</th>
								<th>Type</th>
								<th>hapus</th>
							</tr>
						</thead>
						<tbody>
							<?php
								if($q_attch->num_rows() > 0){
									foreach($q_attch->result() as $r_attch){
							?>
							<tr>
								<td align="center"><?php echo $r_attch->filename; ?></td>
								<td align="center"><?php echo $r_attch->type; ?></td>
								<td align="center"><a href="#" onclick="del_attch('<?php echo $r_attch->attch_id; ?>')">x</a></td>
							</tr>
							<?php
									}
								}else{
							?>
							<tr>
								<td colspan="4">Belum ada lampiran file yang dimasukan</td>
							</tr>
							<?php } ?>
							<tr>
								<td colspan="4"><HR></td>
							</tr>
							<tr>
								<td colspan="4">Masukan Data Baru:</td>
							</tr>
							<tr>
								<td><input id='userfile' name='userfile' type="file"></td>
								<td>
									<select id="level">
										<option value='ijasah'>ijasah</option>
										<option value='sertifikat'>sertifikat</option>
										<option value='dokumen lain'>dokumen lain</option>
									</select>
								</td>
								<td>&nbsp;</td>
							</tr>
							<tr>
								<td colspan='3'><a href="#" onclick="add_attch()">tambah</a></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div style="clear:both;height:20px;"></div>
			</td>
		</tr>
	</table>
	</form>
</div>