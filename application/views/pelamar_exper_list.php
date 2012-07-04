<script src="<?php echo base_url(); ?>/media/js/function.js"></script>
<script>


</script>
<?php
	
	if($q_exper_list->num_rows() > 0){
	
		foreach($q_exper_list->result() as $r_exper_list){

		$start_date	= date("F-Y", strtotime($r_exper_list->date_start));
		$end_date	= date("F-Y", strtotime($r_exper_list->date_out));
?>
<div>
<div style="clear:both;height:20px;"></div>
<div >
	<div style="float:left"><b style="font-size:15px;"><?php echo $r_exper_list->exper_comp; ?></b></div>
	<div style="float:right;font-size:11px;"><i><?php echo $start_date; ?> s/d <?php echo $end_date; ?></i></div>
</div>
<table style="border:1px dashed #45D4FF" >
	<tr>
		<td width="25%" style="background:#1BA5E0;color:#FFF;font-weight:bold">&nbsp;Posisi/Jabatan </td>
		<td style="padding-left:10px;"> <?php echo $r_exper_list->exper_position; ?><div style="float:right"><a href="#" onclick="loadfileid('edit_exper','<?php echo $r_exper_list->exper_id; ?>')"><img src="<?php echo base_url()."media/images/edit_24.png"; ?>"></a> &nbsp; <a href="#" onclick="delete_exper('<?php echo $r_exper_list->exper_id; ?>')"><img src="<?php echo base_url()."media/images/trash_24.png"; ?>"></a> </div></td>
	</tr>
	<tr>
		<td style="background:#1BA5E0;color:#FFF;font-weight:bold">&nbsp;Jenis Perusahaan/Industri</td>
		<td style="padding-left:10px;"> <?php echo $r_exper_list->comp_type_value; ?></td>
	</tr>
	<tr>
		<td style="background:#1BA5E0;color:#FFF;font-weight:bold">&nbsp;Gaji per Bulan (Rp.)</td>
		<td style="padding-left:10px;"> Rp. <?php echo number_format($r_exper_list->exper_salary); ?></td>
	</tr>
	<tr>
		<td style="background:#1BA5E0;color:#FFF;font-weight:bold">&nbsp;Deskripsi Pekerjaan</td>
		<td style="padding-left:10px;"> <?php echo $this->typography->nl2br_except_pre(strip_tags($r_exper_list->exper_jobdesc)); ?></td>
	</tr>
	<tr>
		<td style="background:#1BA5E0;color:#FFF;font-weight:bold">&nbsp;Alasan Keluar</td>
		<td style="padding-left:10px;"> <?php echo $this->typography->nl2br_except_pre(strip_tags($r_exper_list->alasan_keluar)); ?></td>
	</tr>
</table>

<?php
	}
}

?>