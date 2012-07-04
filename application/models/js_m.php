<?php 

class Js_m extends CI_Model {

	/****************************
	[!] Profile
	****************************/
	function profile($js_p = NULL)
	{
		$where	= "";

		if(array_key_exists('user_id',$js_p))
		{
			$where	.= " and ju.user_id = '".$js_p['user_id']."'";
		}
		if(array_key_exists('priv',$js_p))
		{
			$where	.= " and ju.priv = '".$js_p['priv']."'";
		}
		
		$query	= $this->db->query("SELECT js.*,ju.email,jc.city_value,jt.state_value,jt.state_id FROM jbseek js, jbuser ju, jbcity jc, jbstate jt where ju.user_id=js.user_id and js.city_id=jc.city_id and jc.state_id = jt.state_id ".$where." ");
		return $query;
	}
	
	function edit_profile($par = NULL)
	{
		$sql	= "update jbseek set sk_nama='".$par['nama']."', sk_tgl_lahir='".$par['sk_tgl_lahir']."', sk_jns_klm='".$par['jk']."',sk_alamat='".$par['alamat']."',sk_no_tlp='".$par['tlp']."',sk_no_hp='".$par['mobile']."', city_id='".$par['city_id_js']."' where user_id='".$par['user_id']."'";
		
		$sql2	= "update jbuser set email='".$par['email']."' where user_id='".$par['user_id']."' ";
		
		$this->db->query($sql);	
		$this->db->query($sql2);	
		
	}
	
	/****************************
	[!] Setting
	****************************/
	function rule($par = NULL){
		$where	= "";


		$sql	= "select * from jbmaster_rule where 1 ".$where." ";
		$query	= $this->db->query($sql);	
		return $query;
	}

	function privacy($js_p = NULL){
		$where	= "";
		if(array_key_exists('sk_id',$js_p))
			$where	.= " and sk_id = '".$js_p['sk_id']."'";
		if(array_key_exists('rule_id',$js_p))
			$where	.= " and rule_id = '".$js_p['rule_id']."'";

		$sql	= "select * from jbseek_rule where 1 ".$where." ";
		$query	= $this->db->query($sql);	
		return $query;
	}
	
	function update_privacy($par){
		$where	= "";
		if(array_key_exists('sk_id',$par))
			$where	.= " and sk_id = '".$par['sk_id']."'";
		if(array_key_exists('rule_id',$par))
			$where	.= " and rule_id = '".$par['rule_id']."'";

		$this->db->query("delete from jbseek_rule where 1 ".$where." ");
		$this->db->query("insert into jbseek_rule(sk_id,rule_id,value) values('".$par['sk_id']."','".$par['rule_id']."','".$par['value']."') ");
	}

	/****************************
	[!] Pendidikan
	****************************/
	function pendidikan($js_p = NULL)
	{
		$where	= "";

		if(array_key_exists('user_id',$js_p))
			$where	= " and ju.user_id = '".$js_p['user_id']."'";
		if(array_key_exists('sk_id',$js_p))
			$where	= " and je.sk_id = '".$js_p['sk_id']."'";
		
		$query	= $this->db->query("SELECT je.*, jeq.*, jef.* FROM 
			jbseek js, 
			jbmaster_edu_qualify jeq,
			jbmaster_edu_field jef,
			jbseek_edu je 
			where 
			je.edu_qualify_id = jeq.edu_qualify_id and
			je.edu_field_id = jef.edu_field_id ".$where." ");
		return $query;
	}

	function edit_pendidikan($par){
	
		$sql	= "update jbseek_edu set
			edu_field_id = '".$par['edu_field_id']."',
			edu_qualify_id ='".$par['edu_qualify_id']."',
			edu_thn_ajaran ='".$par['edu_thn_ajaran']."',
			edu_instansi ='".$par['edu_instansi']."',
			edu_location ='".$par['edu_location']."',
			edu_grade ='".$par['edu_grade']."',
			sk_id='".$par['sk_id']."'";
		
		$this->db->query($sql);
	}
	
	
	function bahasa($js_p = NULL)
	{
		$where	= "";

		if(array_key_exists('sk_id',$js_p))
		{
			$where	= " and ju.sk_id = '".$js_p['sk_id']."'";
		}
		
		$query	= $this->db->query("SELECT * FROM `jbseek_edu_lang` ju where 1 ".$where." ");
		return $query;
	}

	/****************************
	[!] Lamaran
	****************************/
	function exper_list($par){
		$where	= "";
		if(array_key_exists('sk_id',$par))
			$where	.= " and je.sk_id = '".$par['sk_id']."'";
		if(array_key_exists('exper_id',$par))
			$where	.= " and je.exper_id = '".$par['exper_id']."'";
	
		$sql	= "SELECT * FROM `jbseek_experience` je, jbcompany_type jt where jt.comp_type_id=je.comp_type_id ".$where." order by exper_id desc";
		$query	= $this->db->query($sql);
		return $query;
	}
	
	function edit_exper($par){
		$where	= "";
		if(array_key_exists('sk_id',$par))
			$where	.= " and sk_id = '".$par['sk_id']."'";
		if(array_key_exists('exper_id',$par))
			$where	.= " and exper_id = '".$par['exper_id']."'";

		$sql	= "update jbseek_experience set spes_id='".$par['spes']."', exper_comp='".$par['exper_comp']."',comp_type_id='".$par['comp_type_id']."',date_start='".$par['date_start']."',date_out='".$par['date_out']."',alasan_keluar='".$par['alasan_keluar']."',exper_jobdesc='".$par['exper_jobdesc']."',exper_position='".$par['exper_position']."',exper_salary='".$par['exper_salary']."' where 1 ".$where." ";

		$this->db->query($sql);
		
	}

	function delete_exper($par){
		$where	= "";
		$where	.= " and sk_id = '".$par['sk_id']."'";
		$where	.= " and exper_id = '".$par['exper_id']."'";

		$sql	= "delete from jbseek_experience where 1 ".$where." ";
		$this->db->query($sql);
	}
	
	function add_exper($par){
		$sql	= "insert into jbseek_experience (exper_comp,comp_type_id,spes_id,date_start,date_out,alasan_keluar,exper_jobdesc,exper_position,exper_salary,sk_id) 
		values 
		('".$par['exper_comp']."','".$par['comp_type_id']."','".$par['spes']."','".$par['date_start']."','".$par['date_out']."','".$par['alasan_keluar']."','".$par['exper_jobdesc']."','".$par['exper_position']."','".$par['exper_salary']."','".$par['sk_id']."')";
		$this->db->query($sql);
		
	}
	
	function resume($par = NULL){
		$sql	= "select * from jbseek_resume where sk_id='".$par['sk_id']."'";
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function update_resume_text($par = NULL){
		$q_check	= $this->db->query("select * from jbseek_resume where sk_id='".$par['sk_id']."'");
		
		if($q_check->num_rows() > 0){
			$sql	= "update jbseek_resume set resume_detail='".$par['resume_text']."' where sk_id='".$par['sk_id']."'";
		}else{
			$sql	= "insert into jbseek_resume(resume_detail,sk_id) values ('".$par['resume_text']."','".$par['sk_id']."')";
		}
		$this->db->query($sql);
	
	}

	function resume_file($par = NULL){
		$q_check	= $this->db->query("select * from jbseek_resume where sk_id='".$par['sk_id']."'");
		
		if($q_check->num_rows() > 0){
			$sql	= "update jbseek_resume set resume_detail='".$par['resume_text']."' where sk_id='".$par['sk_id']."'";
		}else{
			$sql	= "insert into jbseek_resume(resume_detail,sk_id) values ('".$par['resume_text']."','".$par['sk_id']."')";
		}
		$this->db->query($sql);
	
	}


}