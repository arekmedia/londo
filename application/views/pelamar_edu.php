<link href="<?php echo base_url(); ?>/media/css/general.css" rel="stylesheet" type="text/css">
<script src="<?php echo base_url(); ?>/media/js/function.js"></script>
<script src="<?php echo base_url(); ?>/media/development-bundle/ui/jquery.ui.core.js"></script>
<script src="<?php echo base_url(); ?>/media/development-bundle/ui/jquery.ui.widget.js"></script>

<script src="<?php echo base_url(); ?>/media/development-bundle/ui/jquery.ui.tabs.js"></script>
<script src="<?php echo base_url(); ?>/media/development-bundle/ui/jquery.ui.datepicker.js"></script>
<script src="<?php echo base_url(); ?>/media/development-bundle/ui/jquery.effects.bounce.js"></script>
<script src="http://code.jquery.com/jquery-latest.js"></script>
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
		url: uri+'pelamar/p_data_edu_edit',
		data: $('#myForm').serialize(),
		success: function(data) {
			$('#msg').html(data);
			$('#msg').show('slow');
			
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

	/*[!] Latar Pendidikan*/
	if($q_pendidikan->num_rows() > 0){
		$row_pd	= $q_pendidikan->row();
		
		$edu_qualify_value	= $row_pd->edu_qualify_value;
		$edu_qualify_id	= $row_pd->edu_qualify_id;
		$edu_field_id	= $row_pd->edu_field_id;
		$edu_grade			= $row_pd->edu_grade;
		$edu_field_value	= $row_pd->edu_field_value;
		$edu_thn_ajaran		= $row_pd->edu_thn_ajaran;
		$edu_instansi		= $row_pd->edu_instansi;
		$edu_location		= $row_pd->edu_location;
		
		$thn_ajaran		= explode('|',$edu_thn_ajaran);
		
		
		
	}else{
		$edu_qualify_value	= "-";
		$edu_grade			= "-";
		$edu_field_value	= "-";
		$edu_status			= "-";
		$edu_thn_ajaran		= "-|-";
		$edu_instansi		= "-";
		$edu_location		= "-";
		$thn_ajaran		= explode('|',$edu_thn_ajaran);

	}

?>

<form method="POST" id="myForm">

<div >
	<h2 class="top">Latar Pendidikan</h2>
</div>
<div id="msg">
<?php 
	if(!empty($msg) )
		echo $msg;
?>
</div>
<div style="clear:both"></div>
	<table>
		<tr>
			<td width="250px">Pendidikan Terakhir</td>
			<td> 
			<span id="ftpt" >
				<?php 
					$q_edu_qualify	= $this->edu_m->edu_qualify();
					
					if($q_edu_qualify->num_rows() > 0){
						echo "<select name='edu_qualify_id'>";
						
						foreach($q_edu_qualify->result() as $r_edu_qualify){
						
							echo "<option value='".$r_edu_qualify->edu_qualify_id."' ".selected($r_edu_qualify->edu_qualify_id,$edu_qualify_id,'selected').">".$r_edu_qualify->edu_qualify_value."</option>";
						
						}
						
						echo "</select>";
					}
				
				?>
			</span>
			
			</td>
		</tr>
		<tr>
			<td>CGPA</td>
			<td><input type="text" name="edu_grade" value="<?php echo $edu_grade; ?>"></td>
		</tr>
		<tr>
			<td>Bidang Studi</td>
			<td>
			<span id='fbs'>
				<?php
					$q_edu_field	= $this->edu_m->edu_field();
					if($q_edu_field->num_rows() > 0){
						echo "<select name='edu_field_id'>";
						foreach($q_edu_field->result() as $r_edu_field){
							echo "<option value='".$r_edu_field->edu_field_id."' ".selected($r_edu_field->edu_field_id,$edu_field_id,'selected').">".$r_edu_field->edu_field_value."</option>";
						}
						echo "</select>";
					}
				
				?>
			</span>
			</td>
		</tr>
		<tr>
			<td>Tahun Pendidikan</td>
			<td>
			<?php
				echo "<select name='ssp1'>";
				for($i=1970;$i<=date('Y');$i++){
					echo "<option value='".$i."' ".selected($thn_ajaran[0],$i,'selected').">".$i."</option>";
				}
				echo "</select>";
			?>
			 sampai
			<?php
				echo "<select name='ssp2'>";
				for($i=1970;$i<=date('Y');$i++){
					echo "<option value='".$i."' ".selected($thn_ajaran[1],$i,'selected').">".$i."</option>";
				}
				echo "<option value='sekarang'  ".selected($thn_ajaran[1],'sekarang','selected').">sekarang</option>";
				echo "</select>";
			?>
			
			</td>
		</tr>
		<tr>
			<td>Nama Universitas / Instansi Pendidikan</td>
			<td><input type="text" name="edu_instansi" value="<?php echo $edu_instansi; ?>"></td>
		</tr>
		<tr>
			<td>Lokasi</td>
			<td><input type="text" name="edu_location" value="<?php echo $edu_location; ?>"></td>
		</tr>
		<tr>
			<td colspan='2'>
				<div class="buttons" id="link_button">
					<a href="#" class="positive" id="save"><!-- class="regular"-->
						<img src="<?php echo base_url(); ?>media/images/save.png" alt=""> 
						Update Education
					</a>
				</div>
			</td>
		</tr>

	</table>
<div style="clear:both;height:20px;"></div>
</form>