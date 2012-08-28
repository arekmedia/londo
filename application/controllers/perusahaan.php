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
 
	function lowongan(){
		$par['comp_id']		= $this->session->userdata('comp_id');
		
		$limit			= 10;
		$offset			= $this->uri->segment(3);  
		$offset			= ( ! is_numeric($offset) || $offset < 1) ? 1 : $offset;

		$data['limit']	= $limit;
		$data['page_uri']	= $offset;
		$data['q_lowongan_full']		= $this->lowongan_m->q_list_lowongan($par);
		
		$par['offset']			= ($offset*$limit)-$limit;
		$par['limit'] 			= $offset*$limit;
		$data['q_lowongan']		= $this->lowongan_m->q_list_lowongan($par);
		
		$data['content']		= "perusahaan_lowongan";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}

	function lowongan_draft(){
		$par['comp_id']		= $this->session->userdata('comp_id');
		$par['status']		= "draft";
		
		$limit			= 10;
		$offset			= $this->uri->segment(3);  
		$offset			= ( ! is_numeric($offset) || $offset < 1) ? 1 : $offset;

		$data['limit']	= $limit;
		$data['page_uri']	= $offset;
		$data['q_lowongan_full']		= $this->lowongan_m->q_list_lowongan($par);
		
		$par['offset']			= ($offset*$limit)-$limit;
		$par['limit'] 			= $offset*$limit;
		$data['q_lowongan']		= $this->lowongan_m->q_list_lowongan($par);
		
		$data['content']		= "perusahaan_lowongan";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}

	function lowongan_publish(){
		$par['comp_id']		= $this->session->userdata('comp_id');
		$par['status']		= "publish";
		
		$limit			= 10;
		$offset			= $this->uri->segment(3);  
		$offset			= ( ! is_numeric($offset) || $offset < 1) ? 1 : $offset;

		$data['limit']	= $limit;
		$data['page_uri']	= $offset;
		$data['q_lowongan_full']		= $this->lowongan_m->q_list_lowongan($par);
		
		$par['offset']			= ($offset*$limit)-$limit;
		$par['limit'] 			= $offset*$limit;
		$data['q_lowongan']		= $this->lowongan_m->q_list_lowongan($par);
		
		$data['content']		= "perusahaan_lowongan";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}

	function lowongan_rejected(){
		$par['comp_id']		= $this->session->userdata('comp_id');
		$par['status']		= "rejected";
		
		$limit			= 10;
		$offset			= $this->uri->segment(3);  
		$offset			= ( ! is_numeric($offset) || $offset < 1) ? 1 : $offset;

		$data['limit']	= $limit;
		$data['page_uri']	= $offset;
		$data['q_lowongan_full']		= $this->lowongan_m->q_list_lowongan($par);
		
		$par['offset']			= ($offset*$limit)-$limit;
		$par['limit'] 			= $offset*$limit;
		$data['q_lowongan']		= $this->lowongan_m->q_list_lowongan($par);
		
		$data['content']		= "perusahaan_lowongan";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}

	function lowongan_edit(){
		if($this->input->post('edit') == '1'){
			$par['vac_id']		= $this->uri->segment(3);
			$par['user_id']		= $this->session->userdata('userid');
			$par['comp_id']		= $this->session->userdata('comp_id');
			$par['spes_id']		= mysql_escape_string($this->input->post('spes'));
			$par['pos_id']		= mysql_escape_string($this->input->post('pos'));
			$par['city_id']		= mysql_escape_string($this->input->post('city_list'));
			$par['vac_date']		= mysql_escape_string($this->input->post('vac_date'));
			$par['vac_detail']		= mysql_escape_string($this->input->post('vac_detail'));
			$par['vac_title']		= mysql_escape_string($this->input->post('vac_title'));
			//$par['vac_sdate']		= mysql_escape_string(date("Y-m-d", strtotime($this->input->post('vac_sdate'))));
			//$par['vac_edate']		= mysql_escape_string(date("Y-m-d", strtotime(" +1 month", strtotime($this->input->post('vac_sdate')))));
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
			//$this->form_validation->set_rules('vac_sdate','Tanggal Tayang','required');
			$this->form_validation->set_rules('vac_title','Judul Iklan Lowongan','required');
			$this->form_validation->set_rules('vac_detail','Materi Iklan Lowongan','required');
			$city_list_msg = "";

			//if($par['city_id'] == 0){
			//	$city_list_msg = "<br>Daftar penempatan kerja harus diisi";
			//}
			if($this->form_validation->run() == FALSE ){
				echo "<div id='msg'><div class='failed'>".validation_errors().$city_list_msg."</div></div>";
			}else{
				$this->lowongan_m->edit_lowongan($par);
				echo "<div id='msg'><div class='success'>Lowongan Berhasil di Edit</div></div>";
			}

		}else{

			$par['all']				= 'all';
			$data					= $this->main_m->q_spes($par);
			$lowongan_p['vac_id']	= $this->uri->segment(3);
			$lowongan_p['status']	= "draft";
			$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);
			$data['q_pos_level']	= $this->main_m->q_posisi_level($par);
			$data['content']		= "perusahaan_lowongan_edit";
			$data['side']			= "perusahaan_side";
			$this->load->view('backend_perusahaan',$data);
		}
	}

	function lowongan_detail(){
		if($this->input->post('edit') == '1'){
			$par['vac_id']		= $this->uri->segment(3);
			$par['user_id']		= $this->session->userdata('userid');
			$par['comp_id']		= $this->session->userdata('comp_id');
			$par['spes_id']		= mysql_escape_string($this->input->post('spes'));
			$par['pos_id']		= mysql_escape_string($this->input->post('pos'));
			$par['city_id']		= mysql_escape_string($this->input->post('city_list'));
			$par['vac_date']		= mysql_escape_string($this->input->post('vac_date'));
			$par['vac_detail']		= mysql_escape_string($this->input->post('vac_detail'));
			$par['vac_title']		= mysql_escape_string($this->input->post('vac_title'));
			//$par['vac_sdate']		= mysql_escape_string(date("Y-m-d", strtotime($this->input->post('vac_sdate'))));
			//$par['vac_edate']		= mysql_escape_string(date("Y-m-d", strtotime(" +1 month", strtotime($this->input->post('vac_sdate')))));
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
			//$this->form_validation->set_rules('vac_sdate','Tanggal Tayang','required');
			$this->form_validation->set_rules('vac_title','Judul Iklan Lowongan','required');
			$this->form_validation->set_rules('vac_detail','Materi Iklan Lowongan','required');
			$city_list_msg = "";

			//if($par['city_id'] == 0){
			//	$city_list_msg = "<br>Daftar penempatan kerja harus diisi";
			//}
			if($this->form_validation->run() == FALSE ){
				echo "<div id='msg'><div class='failed'>".validation_errors().$city_list_msg."</div></div>";
			}else{
				$this->lowongan_m->edit_lowongan($par);
				echo "<div id='msg'><div class='success'>Lowongan Berhasil di Edit</div></div>";
			}

		}else{

			$par['all']				= 'all';
			$data					= $this->main_m->q_spes($par);
			$lowongan_p['vac_id']	= $this->uri->segment(3);
			$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);
			$data['q_pos_level']	= $this->main_m->q_posisi_level($par);
			$data['content']		= "perusahaan_lowongan_detail";
			$data['side']			= "perusahaan_side";
			$this->load->view('backend_perusahaan',$data);
		}
	}
	
	function data_perusahaan(){

		if($this->uri->segment(3) == "create"){
			$par['comp_id']		= $this->session->userdata('comp_id');
			$par['comp_nama']	= $this->input->post('comp_nama');
			$par['comp_alamat']	= $this->input->post('comp_alamat');
			$par['comp_phone']	= $this->input->post('comp_phone');
			$par['comp_logo']	= $this->input->post('comp_logo');
			$par['comp_fax']	= $this->input->post('comp_fax');
			$par['comp_desc']	= $this->input->post('comp_desc');
			$par['comp_type_id']	= $this->input->post('comp_type');
			$par['city_id']	= $this->input->post('city_id_js');

			$this->form_validation->set_rules('comp_nama','Nama Perusahaan','required');

			if($this->form_validation->run() == FALSE ){
				echo "<div id='msg'><div class='failed'>".validation_errors()."</div></div>";
			}else{
				$this->comp_m->edit_profile($par);
				echo "<div id='msg'><div class='success'>Data Perusahaan Berhasil di Ubah</div></div>";
			}
		}else{

			$data['content']		= "perusahaan_profile";
			$data['side']			= "perusahaan_side";
			$industri_p['null']		= NULL;
			$comp_p['comp_id']		= $this->session->userdata('comp_id');
			$data['q_industri']		= $this->comp_m->q_industri($industri_p);
			$data['q_profile']		= $this->comp_m->q_comp($comp_p);
			$data['base_url']		= $this->config->item('base_url');
			$this->load->view('backend_perusahaan',$data);	
		}
	}

	function pelamar_lowongan(){
		$par['null']		= NULL;
		$par_search['null']	= NULL;	
		$par_search['comp_id']	= $this->session->userdata("comp_id");	
		$par_search['vac_id']	= $this->uri->segment(3);	
		//$par_search['app_status']	= 'selective';	
	
		$data['q_edu_field']	= $this->edu_m->edu_field($par);
		$data['q_edu_qualify']	= $this->edu_m->edu_qualify($par);
		$data['q_cari_pekerja']	= $this->lowongan_m->pelamar_lowongan($par_search);
		$data['q_required']		= $this->lowongan_m->lowongan_required($par_search);

		$data['content']		= "perusahaan_pelamar";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$data['vac_id']			= intval($par_search['vac_id']);
		$this->load->view('backend_perusahaan',$data);
	}

	function pelamar_lowongan_save(){
		$par['null']		= NULL;
		$par_search['null']	= NULL;	
		$par_search['comp_id']	= $this->session->userdata("comp_id");	
		$par_search['vac_id']	= $this->uri->segment(3);	
		$par_search['app_status']	= 'save';	
	
		$data['q_edu_field']	= $this->edu_m->edu_field($par);
		$data['q_edu_qualify']	= $this->edu_m->edu_qualify($par);
		$data['q_cari_pekerja']	= $this->lowongan_m->pelamar_lowongan($par_search);
		$data['q_required']		= $this->lowongan_m->lowongan_required($par_search);

		$data['content']		= "perusahaan_pelamar";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$data['vac_id']			= intval($par_search['vac_id']);
		$this->load->view('backend_perusahaan',$data);
	}

	function pelamar_lowongan_print(){
		$par['null']		= NULL;
		$par_search['null']	= NULL;	
		$par_search['comp_id']	= $this->session->userdata("comp_id");	
		$par_search['vac_id']	= $this->uri->segment(3);	
		$par_search['app_status']	= 'print';	
	
		$data['q_edu_field']	= $this->edu_m->edu_field($par);
		$data['q_edu_qualify']	= $this->edu_m->edu_qualify($par);
		$data['q_cari_pekerja']	= $this->lowongan_m->pelamar_lowongan($par_search);
		$data['q_required']		= $this->lowongan_m->lowongan_required($par_search);

		$data['content']		= "perusahaan_pelamar";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$data['vac_id']			= intval($par_search['vac_id']);
		$this->load->view('backend_perusahaan',$data);
	}

	function pelamar_lowongan_trash(){
		$par['null']		= NULL;
		$par_search['null']	= NULL;	
		$par_search['comp_id']	= $this->session->userdata("comp_id");	
		$par_search['vac_id']	= $this->uri->segment(3);	
		$par_search['app_status']	= 'trash';	
	
		$data['q_edu_field']	= $this->edu_m->edu_field($par);
		$data['q_edu_qualify']	= $this->edu_m->edu_qualify($par);
		$data['q_cari_pekerja']	= $this->lowongan_m->pelamar_lowongan($par_search);
		$data['q_required']		= $this->lowongan_m->lowongan_required($par_search);

		$data['content']		= "perusahaan_pelamar";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$data['vac_id']			= intval($par_search['vac_id']);
		$this->load->view('backend_perusahaan',$data);
	}
	
	function cari_pekerja(){
		$par['null']		= NULL;
		$par_search['null']	= NULL;	
	
		if($this->input->post('search') == '1' ){
			$umur1	= $this->input->post('vlowForS');
			$umur2	= $this->input->post('vhighForS');
			$par_search['jk']			= $this->input->post('jk');
			$par_search['edu_field']	= $this->input->post('edu_field');	
			$par_search['umur1']		= date('Y')-$umur1;
			$par_search['umur2']		= date('Y')-$umur2;

			$edu_qualify	= "0";
			$cedu_qualify	= $this->input->post('edu_qualify');
			for($i=0;$i<count($cedu_qualify);$i++){
				$edu_qualify	.= ",".$cedu_qualify[$i];
			}
			
			$par_search['edu_qualify']	= $edu_qualify;
		}
	
		$data['q_edu_field']	= $this->edu_m->edu_field($par);
		$data['q_edu_qualify']	= $this->edu_m->edu_qualify($par);
		$data['q_cari_pekerja']	= $this->js_m->list_pekerja($par_search);

		$data['content']		= "perusahaan_cari_pekerja";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend_perusahaan',$data);
	}

	function detail_pekerja(){
		$main_p['comp_limit']	= 20;
		//$js_p['user_id']		= $this->session->userdata('userid');

		$data					= $this->main_m->q_spes($main_p);
		$js_p['sk_id']			= $this->uri->segment(3);
		$js_p['vac_id']			= $this->uri->segment(4);
		$q_apply				= $this->lowongan_m->check_apply($js_p);
		if($q_apply->num_rows() == 1 && $js_p['vac_id'] != ""){
			$r_apply	= $q_apply->row();
			$data['app_id']		= $r_apply->app_id;
		}

		//$data					= $this->main_m->q_main($main_p);
		$data['q_data_diri']	= $this->js_m->profile($js_p);
		$data['q_bahasa']		= $this->js_m->bahasa($js_p);
		$data['q_skill']		= $this->edu_m->edu_skill();
		$data['q_rule']			= $this->js_m->rule($js_p);
		$data['q_resume']		= $this->js_m->resume($js_p);
		$data['q_pendidikan']	= $this->edu_m->pendidikan($js_p);
		$data['q_industri']		= $this->comp_m->q_industri();
		$data['q_exper_list']	= $this->js_m->exper_list($js_p);
		$data['content']		= "perusahaan_detail_pekerja";
		$data['side']			= "perusahaan_side";
		$data['base_url']		= $this->config->item('base_url');
		
		$this->load->view('backend_pelamar',$data);
	}

	function print_resume(){
		$this->load->helper('dompdf');
		$main_p['comp_limit']	= 20;
		//$js_p['user_id']		= $this->session->userdata('userid');

		$data					= $this->main_m->q_spes($main_p);
		$js_p['sk_id']			= $this->uri->segment(3);
		$js_p['vac_id']			= $this->uri->segment(4);
		$q_apply				= $this->lowongan_m->check_apply($js_p);
		if($q_apply->num_rows() == 1 && $js_p['vac_id'] != ""){
			$r_apply	= $q_apply->row();
			$data['app_id']		= $r_apply->app_id;
		}

		//$data					= $this->main_m->q_main($main_p);
		$data['q_data_diri']	= $this->js_m->profile($js_p);
		$data['q_bahasa']		= $this->js_m->bahasa($js_p);
		$data['q_skill']		= $this->edu_m->edu_skill();
		$data['q_rule']			= $this->js_m->rule($js_p);
		$data['q_resume']		= $this->js_m->resume($js_p);
		$data['q_pendidikan']	= $this->edu_m->pendidikan($js_p);
		$data['q_industri']		= $this->comp_m->q_industri();
		$data['q_exper_list']	= $this->js_m->exper_list($js_p);
		$data['base_url']		= $this->config->item('base_url');
		
		$html	= $this->load->view('perusahaan_print_resume',$data,TRUE);
		//$this->load->view('perusahaan_print_resume',$data);
		pdf_create($html,'pelamar'.$js_p['sk_id']);
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
	/************************************
	[!] Data Account
	************************************/
	function account_perusahaan(){
		$par['user_id']			= $this->session->userdata('userid');
		$data['q_account']		= $this->main_m->check_user($par);
		$data['content']		= "perusahaan_account";
		$data['side']			= "perusahaan_side";
		$this->load->view('backend_perusahaan',$data);	
	}
	
	function p_account_edit(){
		$par['user_id']			= $this->session->userdata('userid');
		$par['username']		= mysql_escape_string($this->input->post('username'));
		$par['email']			= mysql_escape_string($this->input->post('email'));
		$par['password_lama']	= mysql_escape_string($this->input->post('password_lama'));
		$par['password_baru']	= mysql_escape_string($this->input->post('password_baru'));
		$par['cpassword_baru']	= mysql_escape_string($this->input->post('cpassword_baru'));
		
		$this->form_validation->set_rules('username','Username','required|callback_check_username_jq');
		$this->form_validation->set_rules('email','Email','required|callback_check_email_jq');
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
		if((($par['password_baru'] == "" || $par['cpassword_baru'] == "") && $par['password_lama'] != "")){
				$this->form_validation->set_message('check_password_jq', "<img src='".base_url()."media/images/warning.png'>&nbsp; Password baru tidak boleh kosong. ");
				return FALSE;			
		}
		else if($query->num_rows() < 1){
				$this->form_validation->set_message('check_password_jq', "<img src='".base_url()."media/images/warning.png'>&nbsp; Password tidak sesuai. ");
				return FALSE;
		}
	}

	function check_email_jq()
	{
		$par['not_user_id']		= $this->session->userdata('userid');
		$par['email']			= mysql_escape_string($this->input->post('email'));
		$query					= $this->main_m->check_user($par);
		
		if($par['email'] == ""){
			echo $par['email'];		
			return FALSE;
		}else{
			if($query->num_rows() > 0){
				$this->form_validation->set_message('check_email_jq', "email ".$par['email']." sudah terdaftar. ");
				return FALSE;
			}
		}
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */