<?php 

class Comp_m extends CI_Model {

	function q_industri($industri_p = NULL)
	{
		$query			= $this->db->query("SELECT * FROM `jbcompany_type`");
		return $query;
	}
	
	function q_comp($main_p = NULL)
	{
		$limit	= "";
		$where	= "";
		
		if(array_key_exists('comp_id',$main_p))
			$where	.= " and jc.comp_id='".$main_p['comp_id']."' ";
		if(!empty($main_p['limit']) && $main_p['limit'] != "")
			$limit	.= " limit ".$main_p['offset'].",".$main_p['limit'];		

		$sql	= "SELECT * FROM `jbcompany` jc, jbcompany_type jt, jbcity c, jbstate s where 1 and jt.comp_type_id=jc.comp_type_id and jc.city_id=c.city_id and c.state_id=s.state_id ".$where." ".$limit;
		$query			= $this->db->query($sql);	
		return $query;
	}

	

	function profile($par = NULL)
	{
		$where	= "";
		if(array_key_exists('user_id',$par))
			$where	.= " and ju.user_id='".$par['user_id']."' ";
		if(array_key_exists('comp_id',$par))
			$where	.= " and jc.comp_id='".$par['comp_id']."' ";

		$sql	= "select * from jbuser ju, jbcompany jc where 1 and ju.user_id=jc.user_id ".$where." ";
		$query	= $this->db->query($sql);
		return $query;
	}
	
	function edit_profile($par){
		$sql	= "UPDATE `lowongan`.`jbcompany` SET `comp_alamat` = '".$par['comp_alamat']."',
					`comp_nama` = '".$par['comp_nama']."',
					`comp_phone` = '".$par['comp_phone']."',
					`comp_fax` = '".$par['comp_fax']."',
					`comp_desc` = '".$par['comp_desc']."', 
					`comp_type_id` = '".$par['comp_type_id']."', 
					`city_id` = '".$par['city_id']."' 
					WHERE `jbcompany`.`comp_id` ='".$par['comp_id']."'";
		$query	= $this->db->query($sql);
		return $query;
	}
}