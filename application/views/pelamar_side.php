<?php
	$par['sk_id']	= $this->session->userdata('sk_id');	
	$par['checked']	= '1';	
	$capply	= $this->lowongan_m->count_lamaran($par);
	$rapply	= $capply->num_rows();
	$notif_apply	= "";
	if($rapply != 0){
	$notif_apply .= "<span id='noti_Container'>";
	$notif_apply .= "<span class='noti_bubble'>".$rapply."</span>";
	$notif_apply .= "</span>";

	}
?>

<div class="borderleft" style="font-size:12px;">
<b style="color:#999999;">INFORMASI</b>
<ul style="padding-left:10px">
	<li><img src="<?php echo base_url(); ?>media/images/icon_info.gif"> <a href="<?php echo base_url()."pelamar/info_lowongan"?>">Informasi Lowongan Terbaru </a></li>
	<li><img src="<?php echo base_url(); ?>media/images/icon_magnifier.gif"> <a href="<?php echo base_url()."lowongan/all"?>">Cari Lowongan</a> </li>
	<li><img src="<?php echo base_url(); ?>media/images/icon_document.gif"> <a href="<?php echo base_url()."pelamar/status_lamaran/"?>">Respon Lamaran Terkirim</a> <?php echo $notif_apply; ?></li>
</ul>
</div>
<div style="height:10px"></div>

<div class="borderleft" style="font-size:12px;">
<b style="color:#999999;">ONLINE TEST</b>
<ul style="padding-left:10px">
	<li><img src="<?php echo base_url(); ?>media/images/icon_eng.gif"> Bahasa Inggris</li>
	<li><img src="<?php echo base_url(); ?>media/images/icon_book.gif"> Pengetahuan Umum</li>
	<li><img src="<?php echo base_url(); ?>media/images/icon_math.gif"> Logika dan Matematika Dasar</li>
</ul>
</div>
<div style="height:10px"></div>

