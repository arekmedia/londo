<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$data['content']		= "main";
		$data['side']			= "main_company";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}

	function ragam_lowongan(){
		$main_p['comp_limit']	= 20;
		$main_p['spes_level']	= '0';
		$lowongan_p['status']	= "publish";
		$lowongan_p['limit']	= 5;		
		$data					= $this->main_m->q_spes($main_p);
		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);
		$this->load->view('main_ragam_lowongan',$data);
	}

	function lokasi_lowongan(){
		$main_p['comp_limit']	= 20;
		$data		= $this->main_m->q_lokasi($main_p);
		$this->load->view('main_lokasi_lowongan',$data);
	}

	function posisi_lowongan(){
		$main_p['comp_limit']	= 20;
		$data		= $this->main_m->q_posisi($main_p);
		$this->load->view('main_posisi_lowongan',$data);
	}

	function logout(){
		$logindata = array(
			   'comp_id'  	=> '',
			   'userid'  	=> '',
			   'userid'  	=> '',
			   'username'	=> '', 
			   'priv'	=> '',
			   'logged_in'	=> FALSE
		   );

		$this->session->unset_userdata($logindata);
		redirect('main', 'refresh');

	}
	
	function register(){
			$b				= '1';
			$main_p['comp_limit']	= 20;
			//$data				= $this->main_m->q_main($main_p);
			$data['message']		= "";
	
			/* default value */
			$data['username']		= "";
			$data['password']		= "";
			$data['cpassword']		= "";
			$data['email']		= "";
			$data['comp_nama']		= "";
			$data['comp_alamat']		= "";
			$data['stateid_cm']		= "";
			$data['city_id']		= "";
			$data['comp_type_id']	= "";
			$data['type']			= "";
			$data['sk_nama']		= "";
			$data['sk_tgl_lahir']	= "";
			$data['sk_jns_klm']		= "";
			$data['stateid']		= "";
			$data['city_id']		= "";
			$data['sk_alamat']		= "";
			$data['sk_no_tlp']		= "";
			$data['sk_no_hp']		= "";
			$data['type']			= "";
	
	
		if($this->input->post('register_js')){
			$b				= '1';
			$data['username']		= mysql_escape_string($this->input->post('username'));
			$data['password']		= md5(mysql_escape_string($this->input->post('password')));
			$data['cpassword']		= md5(mysql_escape_string($this->input->post('cpassword')));
			$data['email']		= mysql_escape_string($this->input->post('email'));
			$data['sk_nama']		= mysql_escape_string($this->input->post('sk_nama'));
			$data['sk_tgl_lahir']	= mysql_escape_string(date('Y-m-d', strtotime($this->input->post('sk_tgl_lahir'))));
			$data['sk_jns_klm']		= mysql_escape_string($this->input->post('sk_jns_klm'));
			$data['stateid']		= mysql_escape_string($this->input->post('stateid_js'));
			$data['city_id']		= mysql_escape_string($this->input->post('city_id_js'));
			$data['sk_alamat']		= mysql_escape_string($this->input->post('sk_alamat'));
			$data['sk_no_tlp']		= mysql_escape_string($this->input->post('sk_no_tlp'));
			$data['sk_no_hp']		= mysql_escape_string($this->input->post('sk_no_hp'));
			$data['type']			= "js";

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[jbuser.username]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[vpassword]|md5');
			$this->form_validation->set_rules('vpassword', 'Confirm Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[jbuser.email]');
			$this->form_validation->set_rules('sk_nama', 'Nama Pelamar', 'trim|required');
			$this->form_validation->set_rules('sk_tgl_lahir', 'Tgl. Lahir', 'trim|required');
			$this->form_validation->set_rules('sk_jns_klm', 'Jns. Kelamin', 'trim|required');
			$this->form_validation->set_rules('stateid_js', 'Propinsi', 'trim|required');
			$this->form_validation->set_rules('city_id_js', 'Kota', 'trim|required');
			$this->form_validation->set_rules('sk_alamat', 'Alamat', 'trim|required');
			$this->form_validation->set_rules('sk_no_tlp', 'No. Telepon', 'trim|required|numeric');
			$this->form_validation->set_rules('sk_no_hp', 'No. Handphone', 'trim|required|numeric');
			$this->form_validation->set_rules('type', 'Type', 'trim|required');
			
			if ($this->form_validation->run() == FALSE){
				$data['message']	= "<div class='failed'>".validation_errors()."</div>";
			}
			else{
				$this->main_m->register_js($data);
				$data['message']	= "<div class='success'>Registrasi Berhasil.</div>";				
			}
			
		}elseif($this->input->post('register_cm')){
			$b						= '2';
			$data['username']		= mysql_escape_string($this->input->post('username'));
			$data['password']		= md5(mysql_escape_string($this->input->post('password')));
			$data['cpassword']		= md5(mysql_escape_string($this->input->post('cpassword')));
			$data['email']			= mysql_escape_string($this->input->post('email'));
			$data['comp_nama']		= mysql_escape_string($this->input->post('comp_nama'));
			$data['comp_alamat']	= mysql_escape_string($this->input->post('comp_alamat'));
			$data['stateid_cm']		= mysql_escape_string($this->input->post('stateid_cm'));
			$data['city_id']		= mysql_escape_string($this->input->post('city_id_cm'));
			$data['comp_type_id']	= mysql_escape_string($this->input->post('comp_type_id'));
			$data['type']			= "cm";

			$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[jbuser.email]');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|matches[vpassword]|md5');
			$this->form_validation->set_rules('vpassword', 'Confirm Password', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[jbuser.email]');
			$this->form_validation->set_rules('comp_nama', 'Nama Perusahaan', 'trim|required');
			$this->form_validation->set_rules('comp_alamat', 'Alamat  Perusahaan', 'trim|required');
			$this->form_validation->set_rules('stateid_cm', 'Provinsi', 'trim|required');
			$this->form_validation->set_rules('city_id_cm', 'Kota', 'trim|required|numeric');
			$this->form_validation->set_rules('comp_type_id', 'Industri', 'trim|required|numeric');
			$this->form_validation->set_rules('type', 'Type', 'trim|required');
		
			if ($this->form_validation->run() == FALSE){
				$data['message']	= "<div class='failed'>".validation_errors()."</div>";
			}
			else{
				$this->main_m->register_cm($data);
				$data['message']	= "<div class='success'>Registrasi Berhasil.</div>";				
			}
		}
	
		$data['q_main_company']	= $this->comp_m->q_comp($main_p);
		$data['q_state']		= $this->main_m->q_state();
		$data['q_industri']		= $this->comp_m->q_industri();
		$data['content']		= "main_register";
		$data['b']			= $b;
		$data['side']			= "main_company";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}
	

	/********************************************
	*		Jquery Proses
	********************************************/	
	function login_apply()
	{
		$login_p['username']	= mysql_escape_string($this->input->post('username'));
		$login_p['password']	= mysql_escape_string($this->input->post('password'));
		$login_p['priv']	= mysql_escape_string('js');
		
		$query		= $this->main_m->login($login_p);
		
		if($query->num_rows() > 0){
			$row		= $query->row();
			$userid	= $row->user_id;
			$username	= $row->username;
			$priv		= $row->priv;
			$lastlogin		= $row->lastlogin;
			
			$this->main_m->ulastlogin($userid);
			
			$logindata = array(
                   'userid'  	=> $userid,
                   'username'	=> $username,
                   'priv'	=> $priv,
                   'lastlogin'	=> $lastlogin,
                   'logged_in'	=> TRUE
               );

			$js_data['user_id']	= $userid;
			$q_js	= $this->js_m->profile($js_data);
			$r_js	= $q_js->row();
			$sk_id	= $r_js->sk_id;

			$this->session->set_userdata("sk_id",$sk_id);

			$this->session->set_userdata($logindata);
			echo "1";			
		}else{
			echo "0";
		
		}
	}


	function login_jq()
	{
		$login_p['username']	= mysql_escape_string($this->input->post('username'));
		$login_p['password']	= mysql_escape_string($this->input->post('password'));
		
		$query		= $this->main_m->login($login_p);
		
		if($query->num_rows() > 0){
			$row		= $query->row();
			$userid		= $row->user_id;
			$username	= $row->username;
			$priv		= $row->priv;
			$lastlogin	= $row->lastlogin;
			
			
			$logindata = array(
                   'userid'  	=> $userid,
                   'lastlogin'  	=> $lastlogin,
                   'username'	=> $username,
                   'priv'	=> $priv,
                   'logged_in'	=> TRUE
               );

			$this->session->set_userdata($logindata);
			$this->main_m->ulastlogin($userid);
			
			if($priv == 'cm'){				
				$comp_data['user_id']	= $userid;

				$q_comp	= $this->comp_m->profile($comp_data);
				$r_comp	= $q_comp->row();
				$comp_id	= $r_comp->comp_id;
	
				$this->session->set_userdata("comp_id",$comp_id);
				$page	= "perusahaan";			
				
			}else{
				$js_data['user_id']	= $userid;

				$q_js	= $this->js_m->profile($js_data);
				$r_js	= $q_js->row();
				$sk_id	= $r_js->sk_id;
		
				$this->session->set_userdata("sk_id",$sk_id);
				$page	= "pelamar";			
			}
			echo "<div class='success'>Please wait...</div>";
			echo "<script>window.location='".$this->config->item('base_url').$page."'</script>";

			
		}else{
			echo "<div class='failed'>Login Gagal</div>";
		
		}
	}
	
	function get_city_jq_js()
	{
		$stateid	= mysql_escape_string($this->input->post('stateid_js'));
		$search	= mysql_escape_string($this->input->post('search'));
		$query		= $this->main_m->get_city($stateid);
		
		if($query->num_rows() > 0){
			echo "<select name='city_id_js' id='city_id_js'>";
			if($search == 1)
				echo "<option value=''>----- Pilih Semua Kota -----</option>";

			foreach($query->result() as $rows ){
				echo "<option value='".$rows->city_id."'>".$rows->city_value."</option>";
			}
			echo "</select>";
		}
	}
	
	function get_city_jq_cm()
	{
		$stateid	= mysql_escape_string($this->input->post('stateid_cm'));
		$query		= $this->main_m->get_city($stateid);
		
		if($query->num_rows() > 0){
			echo "<select name='city_id_cm'>";
			foreach($query->result() as $rows ){
				echo "<option value='".$rows->city_id."'>".$rows->city_value."</option>";
			}
			echo "</select>";
		}
	}
	
	function check_username_jq()
	{
		$par['username']	= mysql_escape_string($this->input->post('username'));
		$query				= $this->main_m->check_user($par);
		if($par['username'] == ""){
			echo "<div class='failed'>Username Tidak Boleh Kosong</div>";		
			return FALSE;
		}else{
			if($query->num_rows() > 0){
				$this->form_validation->set_message('check_username_jq', "username ".$par['username']." sudah terdaftar. ");
				echo "<div class='failed'>Username ".$par['username']." Sudah Terdaftar</div>";
				return FALSE;
			}
		}
	}
	
	function check_email_jq()
	{
		$par['email']	= mysql_escape_string($this->input->post('email'));
		$query			= $this->main_m->check_user($par);
		
		if($par['email'] == ""){
			echo $par['email'];		
			return FALSE;
		}else{
			if($query->num_rows() > 0){
				$this->form_validation->set_message('check_email_jq', "email ".$par['email']." sudah terdaftar. ");
				echo "<div class='failed'>Email ".$par['email']." Sudah Terdaftar</div>";
				return FALSE;
			}
		}
	}
	
	function perusahaan(){
		$limit			= 20;
		$offset			= $this->uri->segment(3);  
		$offset			= ( ! is_numeric($offset) || $offset < 1) ? 1 : $offset;
		$main_p['null'] = NULL;
		$data['q_main_company_full']	= $this->comp_m->q_comp($main_p);

		$main_p['offset']		= ($offset*$limit)-$limit;
		$main_p['limit'] 		= $offset*$limit;
		$data['limit']	= $limit;
		$data['q_main_company']	= $this->comp_m->q_comp($main_p);
		$data['content']		= "main_perusahaan";
		$data['side']			= "main_company";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */