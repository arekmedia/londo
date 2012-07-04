<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pelamar extends CI_Controller {
	var $upload_path;

	function __construct()
	{	
		parent::__construct();

		$logged_in	= $this->session->userdata('logged_in');
		$priv		= $this->session->userdata('priv');
		$userid		= $this->session->userdata('userid');
		$this->upload_path = realpath(APPPATH .'../media');
	
		if($logged_in == FALSE){
			redirect('main', 'refresh');
		}else if($logged_in == TRUE && $priv == "cm")
			redirect('perusahaan', 'refresh');

	}

	function index()
	{
		$main_p['comp_limit']	= 20;
		$js_p['user_id']		= $this->session->userdata('userid');
		$js_p['sk_id']			= $this->session->userdata('sk_id');

		//$data				= $this->main_m->q_main($main_p);
		$data				= $this->main_m->q_spes($main_p);
		$data['q_data_diri']		= $this->js_m->profile($js_p);
		$data['q_bahasa']		= $this->js_m->bahasa($js_p);
		$data['q_skill']		= $this->edu_m->edu_skill();
		$data['q_rule']		= $this->js_m->rule($js_p);
		$data['q_resume']		= $this->js_m->resume($js_p);
		$data['q_pendidikan']	= $this->js_m->pendidikan($js_p);
		$data['q_industri']		= $this->comp_m->q_industri();
		$data['content']		= "pelamar_main";
		$data['side']			= "pelamar_side";
		$data['base_url']		= $this->config->item('base_url');
		
		$this->load->view('backend_pelamar',$data);
	}
	
	/************************************
	[!] Data Profile 
	************************************/
	function p_profile()
	{
		$par['user_id']		= $this->session->userdata('userid');
		$data['q_profile']		= $this->js_m->profile($par);
		$this->load->view('pelamar_profile',$data);	
	}

	function p_profile_edit()
	{
		$par['user_id']		= $this->session->userdata('userid');
		$par['nama']		= mysql_escape_string($this->input->post('nama'));
		$par['email']		= mysql_escape_string($this->input->post('email'));
		$par['tlp']			= mysql_escape_string($this->input->post('tlp'));
		$par['mobile']		= mysql_escape_string($this->input->post('mobile'));
		$par['jk']			= mysql_escape_string($this->input->post('jk'));
		$par['alamat']		= mysql_escape_string($this->input->post('alamat'));
		$par['stateid_js']		= mysql_escape_string($this->input->post('stateid_js'));
		$par['city_id_js']		= mysql_escape_string($this->input->post('city_id_js'));
		$par['sk_tgl_lahir']		= mysql_escape_string(date('Y-m-d', strtotime($this->input->post('sk_tgl_lahir'))));
	

		$this->form_validation->set_rules('nama','Nama','required');
		$this->form_validation->set_rules('email','Alamat Email','required|valid_email');
		$this->form_validation->set_rules('tlp','Nomor Telepon','required|numeric');
		$this->form_validation->set_rules('mobile','Nomor Handphone','required|numeric');
		$this->form_validation->set_rules('alamat','Alamat','required');
		$this->form_validation->set_rules('stateid_js','Provinsi','required');
		$this->form_validation->set_rules('city_id_js','Kota','required');
		$this->form_validation->set_rules('sk_tgl_lahir','Tanggal Lahir','required');
	
		if($this->form_validation->run() == FALSE){
			echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";
		}else{
			$this->js_m->edit_profile($par);
			echo "<div id='msg'><div class='success'>Data Diri Berhasil Diubah</div></div>";
		}
	
	}
	
	/************************************
	[!] Data Account Privacy
	************************************/
	function p_update_privacy(){
		$par['sk_id']			= $this->session->userdata('sk_id');
		$q_rule	= $this->js_m->rule();

		foreach($q_rule->result() as $row){
			$par['value']		= $this->input->post($row->rule_id);
			$par['rule_id']		= $row->rule_id;
			$this->js_m->update_privacy($par);
		}
		echo "<div id='msg'><div class='success'>Pengaturan Kebebasan Pribadi Berhasil Diubah</div></div>";

	}


	/************************************
	[!] Data Account
	************************************/
	function p_account_edit(){
		$par['user_id']			= $this->session->userdata('userid');
		$par['username']		= mysql_escape_string($this->input->post('username'));
		$par['password_lama']	= mysql_escape_string($this->input->post('password_lama'));
		$par['password_baru']	= mysql_escape_string($this->input->post('password_baru'));
		$par['cpassword_baru']	= mysql_escape_string($this->input->post('cpassword_baru'));
		
		$this->form_validation->set_rules('username','Username','required|callback_check_username_jq');
		$this->form_validation->set_rules('password_lama','Password Lama','trim|callback_check_password_jq');
		$this->form_validation->set_rules('password_baru','Password Baru','trim');
		$this->form_validation->set_rules('cpassword_baru','Ulangi Password Baru','trim|matches[password_baru]');
	
		if($this->form_validation->run() == FALSE){
			echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";
		}else{
			$this->main_m->edit_account($par);
			echo "<div id='msg'><div class='success'>Pengaturan Akun Berhasil Diubah</div></div>";
		}	
	
	}

	function check_username_jq()
	{
		$par['not_user_id']			= $this->session->userdata('userid');
		$par['username']	= mysql_escape_string($this->input->post('username'));
		$query				= $this->main_m->check_user($par);
		if($par['username'] == ""){
			echo "<div class='failed'>Username Tidak Boleh Kosong</div>";		
			return FALSE;
		}else{
			if($query->num_rows() > 0){
				$this->form_validation->set_message('check_username_jq', "<img src='".base_url()."media/images/warning.png'>&nbsp; Username ".$par['username']." sudah terdaftar. ");
				return FALSE;
			}
		}
	}

	function check_password_jq()
	{
		$par['user_id']			= $this->session->userdata('userid');
		$par['password_lama']		= mysql_escape_string($this->input->post('password_lama'));
		$par['password_baru']		= mysql_escape_string($this->input->post('password_baru'));
		$par['cpassword_baru']		= mysql_escape_string($this->input->post('cpassword_baru'));
		$query						= $this->main_m->check_user($par);
		if($par['password_baru'] == "" || $par['cpassword_baru'] == ""){
				$this->form_validation->set_message('check_password_jq', "<img src='".base_url()."media/images/warning.png'>&nbsp; Password baru tidak boleh kosong. ");
				return FALSE;			
		}
		else if($query->num_rows() < 1){
				$this->form_validation->set_message('check_password_jq', "<img src='".base_url()."media/images/warning.png'>&nbsp; Password tidak sesuai. ");
				return FALSE;
		}
	}

	/************************************
	[!] Data Experience
	************************************/
	function p_exper_list(){
		$par['sk_id']	= $this->session->userdata('sk_id');
		$data['q_exper_list']	= $this->js_m->exper_list($par);
		$this->load->view('pelamar_exper_list',$data);	
	}
	
	function p_exper_edit(){
	
		if($this->input->post('update') == '1'){
			$bln1	= mysql_escape_string($this->input->post('bln1'));
			$thn1	= mysql_escape_string($this->input->post('thn1'));
			$bln2	= mysql_escape_string($this->input->post('bln2'));
			$thn2	= mysql_escape_string($this->input->post('thn2'));
			
			$par['exper_jobdesc']	= mysql_escape_string($this->input->post('exper_jobdesc'));
			$par['exper_id']		= mysql_escape_string($this->input->post('exper_id'));
			$par['alasan_keluar']	= mysql_escape_string($this->input->post('alasan_keluar'));
			$par['date_start']		= $thn1."-".$bln1."-01";
			$par['date_out']		= $thn2."-".$bln2."-01";
			$par['exper_comp']		= mysql_escape_string($this->input->post('exper_comp'));
			$par['spes']			= mysql_escape_string($this->input->post('spes'));
			$par['exper_position']	= mysql_escape_string($this->input->post('exper_position'));
			$par['comp_type_id']	= mysql_escape_string($this->input->post('comp_type_id'));
			$par['exper_salary']	= mysql_escape_string($this->input->post('exper_salary'));
			$par['sk_id']			= $this->session->userdata('sk_id');
			
			$this->form_validation->set_rules('exper_comp','Nama Perusahaan','required');
			$this->form_validation->set_rules('exper_position','Posisi/Jabatan','required');
			$this->form_validation->set_rules('bln1','Bulan Awal','required');
			$this->form_validation->set_rules('thn1','Tahun Awal','required');
			$this->form_validation->set_rules('bln2','Bulan Akhir','required');
			$this->form_validation->set_rules('thn2','Tahun Akhir','required');
			$this->form_validation->set_rules('comp_type_id','Jenis Bidang Perusahaan/Industri','required');
			$this->form_validation->set_rules('spes','Spesialisasi','required');
			$this->form_validation->set_rules('exper_salary','Gaji/Upah per bulan','required');
			$this->form_validation->set_rules('alasan_keluar','Alasan Keluar','required');

			if($this->form_validation->run() == FALSE){
				echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";
			}else{
				$this->js_m->edit_exper($par);
				echo "<div id='msg'><div class='success'>Pengalaman Kerja Berhasil Diubah</div></div>";
			}
		
		}else{
		
			$par['sk_id']			= $this->session->userdata('sk_id');
			$par['exper_id']		= $this->uri->segment(3);
			$data				= $this->main_m->q_spes($par);
			$data['q_industri']		= $this->comp_m->q_industri();
			$data['q_exper_list']	= $this->js_m->exper_list($par);
			$this->load->view('pelamar_exper_edit',$data);		
		}
	}
	
	function p_exper_del(){
		$par['sk_id']			= $this->session->userdata('sk_id');
		$par['exper_id']		= $this->uri->segment(3);
		$this->js_m->delete_exper($par);
		echo "<div id='msg'><div class='notify'>Data Berhasil Dihapus</div></div>";
	
	}
	
	function p_exper_add(){

		$bln1	= mysql_escape_string($this->input->post('bln1'));
		$thn1	= mysql_escape_string($this->input->post('thn1'));
		$bln2	= mysql_escape_string($this->input->post('bln2'));
		$thn2	= mysql_escape_string($this->input->post('thn2'));
		
		$par['exper_jobdesc']	= mysql_escape_string($this->input->post('exper_jobdesc'));
		$par['alasan_keluar']	= mysql_escape_string($this->input->post('alasan_keluar'));
		$par['date_start']		= $thn1."-".$bln1."-01";
		$par['date_out']		= $thn2."-".$bln2."-01";
		$par['exper_comp']		= mysql_escape_string($this->input->post('exper_comp'));
		$par['spes']			= mysql_escape_string($this->input->post('spes'));
		$par['exper_position']	= mysql_escape_string($this->input->post('exper_position'));
		$par['comp_type_id']	= mysql_escape_string($this->input->post('comp_type_id'));
		$par['exper_salary']	= mysql_escape_string($this->input->post('exper_salary'));
		$par['sk_id']			= $this->session->userdata('sk_id');
		
		$this->form_validation->set_rules('exper_comp','Nama Perusahaan','required');
		$this->form_validation->set_rules('exper_position','Posisi/Jabatan','required');
		$this->form_validation->set_rules('bln1','Bulan Awal','required');
		$this->form_validation->set_rules('thn1','Tahun Awal','required');
		$this->form_validation->set_rules('bln2','Bulan Akhir','required');
		$this->form_validation->set_rules('thn2','Tahun Akhir','required');
		$this->form_validation->set_rules('comp_type_id','Jenis Bidang Perusahaan/Industri','required');
		$this->form_validation->set_rules('spes','Spesialisasi','required');
		$this->form_validation->set_rules('exper_salary','Gaji/Upah per bulan','required');
		$this->form_validation->set_rules('alasan_keluar','Alasan Keluar','required');

		if($this->form_validation->run() == FALSE){
			echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";
		}else{
			$this->js_m->add_exper($par);
			echo "<div id='msg'><div class='success'>Data Berhasil Diubah</div></div>";
		}
		
	}

	/************************************
	[!] Data Education 
	************************************/
	function p_data_edu()
	{
		$js_p['user_id']		= $this->session->userdata('userid');
		$js_p['sk_id']			= $this->session->userdata('sk_id');

		$data['q_pendidikan']	= $this->js_m->pendidikan($js_p);
		$this->load->view('pelamar_edu',$data);

	}
	
	function p_data_edu_edit(){
		
		$edu_thn_ajaran			= $this->input->post('ssp1')."|".$this->input->post('ssp2');
	
		$par['edu_qualify_id']	= mysql_escape_string($this->input->post('edu_qualify_id'));
		$par['edu_field_id']	= mysql_escape_string($this->input->post('edu_field_id'));
		$par['edu_thn_ajaran']	= mysql_escape_string($edu_thn_ajaran);
		$par['edu_instansi']	= mysql_escape_string($this->input->post('edu_instansi'));
		$par['edu_location']	= mysql_escape_string($this->input->post('edu_location'));
		$par['edu_grade']	= mysql_escape_string($this->input->post('edu_grade'));
		$par['sk_id']			= $this->session->userdata('sk_id');
		
		$this->form_validation->set_rules('edu_qualify_id','Tingkat Pendidikan','required');
		$this->form_validation->set_rules('edu_field_id','Bidang Keahlian/Jurusan','required');
		$this->form_validation->set_rules('ssp1','Tahun Lama Pendidikan','required');
		$this->form_validation->set_rules('ssp2','Tahun Lama Pendidikan','required');
		$this->form_validation->set_rules('edu_instansi','Nama Sekolah/Universitas','required');
		$this->form_validation->set_rules('edu_location','Alamat Instansi Pendidikan','required');
		$this->form_validation->set_rules('edu_grade','CGPA','numeric');
		
		if($this->form_validation->run() == TRUE){
			echo "<div id='msg'><div class='success'>Latar Pendidikan Berhasil Diubah</div></div>";
			$this->js_m->edit_pendidikan($par);
		}else{
			echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";		
		}
	}

	/************************************
	[!] Language Education  
	************************************/
	function p_lang_edu()
	{
		$data['q_lang']		= $this->edu_m->edu_lang();
		$this->load->view('pelamar_edu_lang',$data);
	}
	
	function add_edu_lang(){
		$par['lang']	= mysql_escape_string(htmlentities($this->input->post('lang')));
		$par['skill_s']	= mysql_escape_string(htmlentities($this->input->post('skill_s')));
		$par['skill_w']	= mysql_escape_string(htmlentities($this->input->post('skill_w')));

		$this->form_validation->set_rules('lang','Bahasa','required');
		$this->form_validation->set_rules('skill_s','Keahlian Lisan','required');
		$this->form_validation->set_rules('skill_w','Keahlian Tulis','required');

		if($this->form_validation->run() == TRUE){
			echo "<div id='msg'><div class='success'>Penguasaan Bahasa Berhasil Ditambah</div></div>";
			$this->edu_m->add_edu_lang($par);
		}else{
			echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";				
		}
	}

	function del_edu_lang(){
		$par['edu_lang_id']	= mysql_escape_string(htmlentities($this->input->post('edu_lang_id')));
		$this->edu_m->del_edu_lang($par);
		
	}
	
	/************************************
	[!] Skill 
	************************************/
	function p_skill(){
		$data['q_skill']		= $this->edu_m->edu_skill();
		$this->load->view('pelamar_skill',$data);
	}
	
	function add_skill(){
		$par['keahlian']	= mysql_escape_string(htmlentities($this->input->post('keahlian')));
		$par['lama']		= mysql_escape_string(htmlentities($this->input->post('lama')));
		$par['level']		= mysql_escape_string(htmlentities($this->input->post('level')));
		$this->edu_m->add_skill($par);
	
	}

	function del_skill(){
		$par['skill_id']	= mysql_escape_string(htmlentities($this->input->post('skill_id')));
		$this->edu_m->del_skill($par);
		
	}
	
	/************************************
	[!] Attach 
	************************************/
	function p_attch(){
		$data['q_attch']		= $this->edu_m->attch();
		$this->load->view('pelamar_attch',$data);
	}
	
	function add_attch(){
	}

	/************************************
	[!] Resume 
	************************************/
	function p_resume_text(){
		$par['sk_id']		= $this->session->userdata('sk_id');	
		$par['resume_text']		= $this->input->post('resume_text');	
		if($this->input->post('simpan_resume') == "1"){
			$this->form_validation->set_rules('resume_text', 'Resume', 'required');
			if($this->form_validation->run() != FALSE){
				$this->js_m->update_resume_text($par);
				echo "<div id='msg'><div class='success'>Resume Lamaran Pekerjaan Berhasil Diubah</div></div>";
			}
		}
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */