<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Lowongan extends CI_Controller {

	function __construct()
	{
		parent::__construct();
	}

	function index(){
		$lowongan_p['status']	= "publish";

		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);
		$data['side']			= "lowongan_related";		
		$data['content']		= "lowongan_browse.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}
	
	function apply()
	{
		$js_p['user_id']		= $this->session->userdata('userid');			
		$data['q_pelamar']		= $this->js_m->profile($js_p);
		$data['side']			= "lowongan_related";
		$data['content']		= "lowongan_detail.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('lowongan_apply',$data);
	}

	function do_apply(){
		$par['vac_id']	= $this->input->post('vac_id');
		$par['sk_id']	= $this->session->userdata('sk_id');			
		
		$check_apply	= $this->lowongan_m->check_apply($par);
		if($check_apply->num_rows() < 1){
			$this->lowongan_m->do_apply($par);
			$this->lowongan_m->uc_apply($par);
			$this->lowongan_m->uc_view($par);
			echo "1";
		}else{
			echo "0";
		}
	}
	
	function search(){
		$par['null']			= NULL;
		$data				= $this->main_m->q_spes($par);
		$data['q_state']		= $this->main_m->q_state();
		$page_uri			= $this->uri->segment(4);

		if($page_uri == ""){
			$this->session->set_userdata('spes_id',mysql_escape_string($this->input->post('spes_id')));
			$this->session->set_userdata('stateid_js',mysql_escape_string($this->input->post('stateid_js')));
			$this->session->set_userdata('city_id_js',mysql_escape_string($this->input->post('city_id_js')));
		}



		if(is_numeric($page_uri) == FALSE) $page_uri = 1;
			$lowongan_p['page']	= $page_uri;

		$lowongan_p['spes_id']	= $this->session->userdata('spes_id');
		$lowongan_p['state_id']	= $this->session->userdata('stateid_js');
		$lowongan_p['city_id']	= $this->session->userdata('city_id_js');
		$lowongan_p['limit']		= 2;		

		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);

		$data['spes_id']		= $this->session->userdata('spes_id');
		$data['state_id']		= $this->session->userdata('stateid_js');
		$data['city_id']		= $this->session->userdata('city_id_js');

		$data['limit']		= $lowongan_p['limit'];
		$data['q_num_lowongan']	= $this->lowongan_m->q_lowongan($lowongan_p,TRUE);
		$data['side']			= "lowongan_related";
		$data['content']		= "lowongan_browse.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}

	function kerja(){

		$uri_id = $this->uri->segment(3);
		if($uri_id == "") redirect(base_url(), 'refresh');

		$par['null']			= NULL;
		$data				= $this->main_m->q_spes($par);
		$data['q_state']		= $this->main_m->q_state();
		$page_uri	= $this->uri->segment(4);

		if(is_numeric($page_uri) == FALSE) $page_uri = 1;
			$lowongan_p['page']	= $page_uri;

		$lowongan_p['spes_id']	= $uri_id;
		$lowongan_p['limit']		= 2;		
		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);

		$data['limit']		= $lowongan_p['limit'];
		$data['q_num_lowongan']	= $this->lowongan_m->q_lowongan($lowongan_p,TRUE);
		$data['side']			= "lowongan_related";
		$data['content']		= "lowongan_browse.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}

	function kota(){
		$uri_id = $this->uri->segment(3);
		if($uri_id == "") redirect(base_url(), 'refresh');

		$par['null']			= NULL;
		$data				= $this->main_m->q_spes($par);
		$data['q_state']		= $this->main_m->q_state();
		$page_uri	= $this->uri->segment(4);
		if(is_numeric($page_uri) == FALSE) $page_uri = 1;
			$lowongan_p['page']	= $page_uri;

		$lowongan_p['city_id']	= $uri_id;
		$lowongan_p['limit']		= 2;
		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);

		$data['q_num_lowongan']	= $this->lowongan_m->q_lowongan($lowongan_p,TRUE);

		$data['limit']		= $lowongan_p['limit'];
		$data['side']			= "lowongan_related";
		$data['content']		= "lowongan_browse.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}
	
	function posisi(){
		$uri_id = $this->uri->segment(4);
		if($uri_id == "") redirect(base_url(), 'refresh');

		$par['null']			= NULL;
		$data				= $this->main_m->q_spes($par);
		$data['q_state']		= $this->main_m->q_state();
		$page_uri	= $this->uri->segment(4);
		if(is_numeric($page_uri) == FALSE) $page_uri = 1;
			$lowongan_p['page']	= $page_uri;

		$lowongan_p['spes_id']	= $this->uri->segment(4);
		$lowongan_p['pos_id']	= $uri_id;
		$lowongan_p['limit']		= 2;
		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);

		$data['q_num_lowongan']	= $this->lowongan_m->q_lowongan($lowongan_p,TRUE);

		$data['limit']		= $lowongan_p['limit'];
		$data['side']			= "lowongan_related";
		$data['content']		= "lowongan_browse.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}

	function detail(){
		$view_vac_id			= "view".$this->uri->segment(3);
		$lowongan_p['vac_id']	= $this->uri->segment(3);

		if($this->session->userdata($view_vac_id) == "")
			$this->lowongan_m->uc_view($lowongan_p);

		$this->session->set_userdata($view_vac_id, '1');

	
		$data['q_lowongan']		= $this->lowongan_m->q_lowongan($lowongan_p);
		$data['side']			= "lowongan_related";
		$data['content']		= "lowongan_detail.php";
		$data['base_url']		= $this->config->item('base_url');
		$this->load->view('backend',$data);
	}
	
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
