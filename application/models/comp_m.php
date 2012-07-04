<?php 

class Comp_m extends CI_Model {

	function q_industri($industri_p = NULL)
	{
		$query			= $this->db->query("SELECT * FROM `jbcompany_type`");
		return $query;
	}
	
	function q_comp($main_p = NULL)
	{
		$company_limit	= "";
		$query			= $this->db->query("SELECT * FROM `jbcompany` ".$company_limit." ");	
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
}