
<div class="borderleft" style="font-size:12px;">
<b style="color:#999999;">INFORMASI PERUSAHAAN</b>
<ul>
	<li><a href="<?php echo base_url()."perusahaan/data_perusahaan"; ?>"><img src="<?php echo base_url(); ?>media/images/icon_building.gif"> Data Perusahaan</a></li>
	<li><a href="<?php echo base_url()."perusahaan/account_perusahaan"; ?>"><img src="<?php echo base_url(); ?>media/images/icon_account.gif"> Account Perusahaan</a></li>
</ul>
</div>
<div style="height:10px"></div>

<div class="borderleft" style="font-size:12px;">
<b style="color:#999999;">RECRUITMENT</b>
<ul>
	<li><a href="<?php echo base_url()."perusahaan/cari_pekerja"; ?>"><img src="<?php echo base_url(); ?>media/images/icon_magnifier.gif"> Cari Pelamar Kerja </a></li>
	<li><a href="<?php echo base_url()."perusahaan/lowongan_baru"; ?>"><img src="<?php echo base_url(); ?>media/images/icon_add.gif"> Buat Lowongan Baru</a></li>
	<li><a href="<?php echo base_url()."perusahaan/lowongan"; ?>"><img src="<?php echo base_url(); ?>media/images/icon_document.gif"> Daftar Lowongan </a></li>
</ul>
</div>
<div style="height:10px"></div>

<div class="borderleft" style="font-size:12px;">
<b style="color:999999;">FAQ</b>
<ul>
	<li>Pencarian Tenaga Kerja</li>
	<li>Mulai Buka Lowongan</li>
	<li>Design Template Lowongan</li>
</ul>
</div>

<div style="height:10px"></div>
<div id="bar" style="height:25px;">
	<b>Lowongan Anda Hari ini</b>
</div>
<div class="borderleft" style="height:300px">
<?php
	$par['comp_id']	= $this->session->userdata("comp_id"); 
	$par['date']	= date('Y-m-d'); 
	
	$q_stat	= $this->lowongan_m->lowongan_stat($par);

	if($q_stat->num_rows() > 0){
		echo "<ul>";
		foreach($q_stat->result() as $r_stat){
			echo "<li>".$r_stat->click." view(s) ".$r_stat->apply." apply(s) - <b>".$r_stat->vac_title."</b></li>";
		}
		echo "<ul>";
	}else{
		echo "tidak ada data yg ditampilkan";
	}
?>
</div>