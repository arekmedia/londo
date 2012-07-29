<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Perusahaan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$logged_in	= $this->session->userdata('logged_in');
		$priv		= $this->session->userdata('priv');
		$userid		= $this->session->userdata('userid');
		$this->upload_path = realpath(APPPATH .'../media');
	
		if($logged_in == FALSE){
			redirect('main', 'refresh');
		}else if($logged_in == TRUE && $priv == "js")
			redirect('pelamar', 'refresh');

	}

	function index(){
		$data['content']		= "perusahaan_main";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}

	function perusahaan_statistik(){

		$par['user_id']		= $this->session->userdata('userid');
		$par['comp_id']		= $this->session->userdata('comp_id');
		$data['q_profile']		= $this->comp_m->profile($par);
		$data['q_statistik']		= "";
		$this->load->view('perusahaan_statistik',$data);
	}

	function cari_pekerja(){
		$par['null']		= NULL;
		$par_post['null']	= NULL;	
	
		if($this->input->post('submit') == '1' ){
			$par_post['']	= "";	
		
		}
	
		$data['q_edu_field']	= $this->edu_m->edu_field($par);
		$data['q_edu_qualify']	= $this->edu_m->edu_qualify($par);
		$data['q_cari_pekerja']	= $this->js_m->list_pekerja($par_post);

		$data['content']		= "perusahaan_cari_pekerja";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}
	
	function lowongan_baru(){

		if($this->input->post('create') == '1'){
			$par['user_id']		= $this->session->userdata('userid');
			$par['comp_id']		= $this->session->userdata('comp_id');
			$par['spes_id']		= mysql_escape_string($this->input->post('spes'));
			$par['pos_id']		= mysql_escape_string($this->input->post('pos'));
			$par['city_id']		= mysql_escape_string($this->input->post('city_list'));
			$par['vac_date']		= mysql_escape_string($this->input->post('vac_date'));
			$par['vac_detail']		= mysql_escape_string($this->input->post('vac_detail'));
			$par['vac_title']		= mysql_escape_string($this->input->post('vac_title'));
			$par['vac_sdate']		= mysql_escape_string(date("Y-m-d", strtotime($this->input->post('vac_sdate'))));
			$par['vac_edate']		= mysql_escape_string(date("Y-m-d", strtotime(" +1 month", strtotime($this->input->post('vac_sdate')))));
			$par['vac_salary_min']	= 0;
			$par['vac_salary_max']	= 0;

			/* Vacancy Required */
			$par['sk_jns_klm']		= $this->input->post('sk_jns_klm');
			$par['sk_age']		= $this->input->post('sk_age');
			$par['edu_qualify_id']	= $this->input->post('edu_qualify_id');
			$par['edu_field_id']		= $this->input->post('edu_field_id');
			$par['sk_exper']		= $this->input->post('sk_exper');

			//echo $par['vac_sdate'].$par['vac_edate'];
		
			$nego	= $this->input->post('nego');

			//echo $nego;
			if(empty($nego) ){
				$par['vac_salary_min']	= mysql_escape_string($this->input->post('vac_salary_min'));
				$par['vac_salary_max']	= mysql_escape_string($this->input->post('vac_salary_max'));

				$this->form_validation->set_rules('vac_salary_min','Tawaran Gaji Terendah','required');
				$this->form_validation->set_rules('vac_salary_max','Tawaran Gaji Tertinggi','required');
			}

			$this->form_validation->set_rules('spes','Spesialisasi','required');
			$this->form_validation->set_rules('pos','Posisi','required');
			$this->form_validation->set_rules('city_list','Daftar Kota','required|null');
			$this->form_validation->set_rules('vac_sdate','Tanggal Tayang','required');
			$this->form_validation->set_rules('vac_title','Judul Iklan Lowongan','required');
			$this->form_validation->set_rules('vac_detail','Materi Iklan Lowongan','required');
			$city_list_msg = "";

			//if($par['city_id'] == 0){
			//	$city_list_msg = "<br>Daftar penempatan kerja harus diisi";
			//}
			if($this->form_validation->run() == FALSE ){
				echo "<div id='msg'><div class='failed'>".validation_errors().$city_list_msg."</div></div>";
			}else{
				$this->lowongan_m->create_lowongan($par);
				echo "<div id='msg'><div class='success'>Lowongan Berhasil di Posting</div></div>";
			}

		}else{

			$par['all']			= 'all';
			$data				= $this->main_m->q_spes($par);
			$data['q_pos_level']		= $this->main_m-> q_posisi_level($par);
			$data['content']		= "perusahaan_lowongan_baru";
			$data['side']			= "perusahaan_side";
			$this->load->view('backend_perusahaan',$data);
		}
	}

	function lowongan_kota(){
		$in	= $this->input->post('city_list');
		$q_city	= $this->main_m->get_city_in($in);

		if($q_city->num_rows() > 0){
			foreach( $q_city->result() as $r_city){
				echo "<span style=\"font-weight:bold;color:red\" onmousedown=\"del_vac_city('$r_city->city_id')\">[x]</span>&nbsp;".$r_city->city_value.",";
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */