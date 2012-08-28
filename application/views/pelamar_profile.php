<script src="<?php echo base_url(); ?>media/js/function.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.widget.js"></script>

<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url(); ?>media/development-bundle/ui/jquery.effects.bounce.js"></script>
<script>
jQuery(document).ready(function() {
  jQuery('#datepicker').datepicker({
    minDate: new Date(1900, 0, 1),
    maxDate: new Date(2000,0,1),
    constrainInput: true,
	changeMonth: true,
	changeYear: true

	});
});

$('#save').click(function() {
	$.ajax({
		type: 'POST',
		url: uri+'pelamar/p_profile_edit',
		data: $('#myForm').serialize(),
		success: function(data) {
			$('#msg_profile').html(data);
			$('#msg_profile').show('slow');
		}
		
	})
  return false;
});

</script>
<?php
function selected($a,$b,$c){
	if($a == $b)
		return $c;
}
	if($q_profile->num_rows() > 0){
		$r_profile	= $q_profile->row();

?>
<h2>Update Data Profile</h2>
<BR>
<div id="msg_profile">
<?php 
	if(!empty($msg) )
		echo $msg;
?>
</div>
<form method="POST" id="myForm">
<table width="100%">
	<tr>
		<td width="150px">Nama Lengkap</td>
		<td><input type="text" name="nama" value="<?php echo $r_profile->sk_nama; ?>"></td>
	</tr>
	<tr>
		<td>Email</td>
		<td><input type="text" name="email" value="<?php echo $r_profile->email; ?>"></td>
	</tr>
	<tr>
		<td>No. Telephone</td>
		<td><input type="text" name="tlp" value="<?php echo $r_profile->sk_no_tlp; ?>"></td>
	</tr>
	<tr>
		<td>Mobile</td>
		<td><input type="text" name="mobile" value="<?php echo $r_profile->sk_no_hp; ?>"></td>
	</tr>
	<tr>
		<td>Jenis Kelamin</td>
		<td><input type="radio" name="jk" value="P" <?php echo selected($r_profile->sk_jns_klm,'P','checked'); ?>>Perempuan <input type="radio" name="jk" value="L" <?php echo selected($r_profile->sk_jns_klm,'L','checked'); ?>> Laki-Laki</td>
	</tr>
	<tr>
		<td>Alamat</td>
		<td><input type="text" name="alamat" value="<?php echo $r_profile->sk_alamat; ?>"></td>
	</tr>
	<tr>
		<td>provinsi</td>
		<td> 
			<select name="stateid_js" onchange="get_city_js(this.form)">
				<?php 
					$q_state	= $this->main_m->q_state();
					foreach($q_state->result() as $rows){ 
		
						echo "<option value='".$rows->state_id."' ".selected($rows->state_id,$r_profile->state_id,"selected").">".$rows->state_value."</option>";
			
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
						$q_state	= $this->main_m->get_city($r_profile->state_id);
						foreach($q_state->result() as $rows){ 
			
							echo "<option value='".$rows->city_id."' ".selected($rows->city_id,$r_profile->city_id,"selected").">".$rows->city_value."</option>";
				
						}

					?>
				</select>	
				</span>
		</td>
	</tr>
	<tr>
		<td>Tgl Lahir</td>
		<td><input name="sk_tgl_lahir" value="<?php echo $r_profile->sk_tgl_lahir; ?>" id="datepicker" type="text" style="width:100px"></td>
	</tr>
	<tr>
		<td colspan='2' align="center">
			<div class="buttons" id="link_button">
				<a href="#" class="positive" id="save"><!-- class="regular"-->
					<img src="<?php echo base_url(); ?>media/images/save.png" alt=""> 
					Update Profile
				</a>
			</div>
		</td>
	</tr>
</table>
</form>
<?php } ?>