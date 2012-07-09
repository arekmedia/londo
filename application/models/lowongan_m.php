<?php 

class Lowongan_m extends CI_Model {

	function q_lowongan($lowongan_p = NULL,$row = FALSE)
	{
		$where	= "";
		$limit	= "";

		if(array_key_exists('spes_id',$lowongan_p)){
			$where	.= " and s.spes_id='".$lowongan_p['spes_id']."'";
		}
		if(array_key_exists('spes_level',$lowongan_p)){
			$where	.= " and s.spes_level='".$lowongan_p['spes_level']."'";
		}
		if(array_key_exists('city_id',$lowongan_p) && $lowongan_p['city_id'] != ""){
			$where	.= " and FIND_IN_SET(".$lowongan_p['city_id'].",v.city_id) > 0";
		}
		if(array_key_exists('state_id',$lowongan_p) && $lowongan_p['state_id'] != ""){
			if(!array_key_exists('city_id',$lowongan_p)  || $lowongan_p['city_id'] == "")
			$where	.= " and FIND_IN_SET(c.city_id,v.city_id) > 0";

			$where	.= " and c.state_id='".$lowongan_p['state_id']."'";
		}
		if(array_key_exists('pos_id',$lowongan_p)){
			$where	.= " and p.pos_id='".$lowongan_p['pos_id']."'";
		}
		if(array_key_exists('vac_id',$lowongan_p)){
			$where	.= " and v.vac_id='".$lowongan_p['vac_id']."'";
		}
		if(array_key_exists('comp_id',$lowongan_p)){
			$where	.= " and v.comp_id='".$lowongan_p['comp_id']."'";
		}
		if(array_key_exists('status',$lowongan_p)){
			$where	.= " and v.status='".$lowongan_p['status']."'";
		}

		$sql	= "SELECT  s.spes_level,t.temp_url, p.pos_id, cmt.comp_type_value, cm.comp_nama, cm.comp_logo, cm.comp_desc,cm.comp_id, p.pos_level, v.vac_title, v.vac_detail, v.vac_salary_min, v.vac_salary_max, v.vac_id, s.spes_value, s.spes_id, v.vac_sdate, v.vac_edate, c.city_id, c.city_value, st.state_value FROM jbtemplate t, jbstate st, jbcompany_type cmt, jbcompany cm, `jbvacancy` v, jbposition p, jbspecialist s, jbcity c WHERE t.temp_id=v.temp_id and t.temp_id=v.temp_id AND p.pos_id = v.pos_id AND s.spes_id = v.spes_id AND v.comp_id = cm.comp_id AND cmt.comp_type_id = cm.comp_type_id AND st.state_id = c.state_id ".$where." group by v.vac_id ";

		if($row == FALSE){

			if(!array_key_exists('limit',$lowongan_p)) 
				$batas	= 20;
			else
				$batas	= $lowongan_p['limit'];

			if(!array_key_exists('page',$lowongan_p) || $lowongan_p['page'] == 0 ) 
				$page = 1;
			else
				$page	= $lowongan_p['page']; 
			
			$a	= ($page*$batas)-$batas;
			$limit	= " LIMIT ".$a.", ".$batas;
			$sql	= $sql.$limit;
			$result	= $this->db->query($sql);

		}else{
			$query		= $this->db->query($sql);
			$result	= $query->num_rows();		
		}
		//echo $sql;
		return $result;
	}

	function check_apply($par = NULL){
		$where		= "";
		if(!empty($par['vac_id']) && $par['vac_id'] != "")
			$where	.= " and vac_id = '".$par['vac_id']."'";
		if(!empty($par['sk_id']) && $par['sk_id'] != "")
			$where	.= " and sk_id = '".$par['sk_id']."'";

		$sql_check	= "select * from jbapplay where 1 ".$where." ";
		$q_check	= $this->db->query($sql_check);
		return $q_check;
	}
	
	function do_apply($par){
		$insert_apply	= "insert into jbapplay (vac_id,sk_id,app_status) values ('".$par['vac_id']."','".$par['sk_id']."','received')";
		$this->db->query($insert_apply);
	}
	
	function q_location_lowongan($par = NULL){
		$where	= "";
		if(!empty($par['vac_id']) && $par['vac_id'] != "")
			$where	.= " and v.vac_id = '".$par['vac_id']."'";

		$q_list_lowongan	= $this->db->query("SELECT c.city_value FROM `jbvacancy` v, jbcity c where 1 ".$where." and FIND_IN_SET(c.city_id,v.city_id)");
		return $q_list_lowongan;
	}

	function q_list_lowongan($lowongan_p = NULL){
		$where	= "";
		if(array_key_exists('comp_id',$lowongan_p)){
			$where	.= "and j.comp_id='".$lowongan_p['comp_id']."'";
		}
		$q_list_lowongan	= $this->db->query("SELECT j.*,SUM(js.click) as view,SUM(js.apply) as apply FROM jbvacancy j left join jbvacancy_stat js on j.vac_id=js.vac_id where 1 ".$where." group by j.vac_id");
		return $q_list_lowongan;
	}

	
	function d_stat($lowongan_p = NULL){
		$where	= "";
		if(array_key_exists('vac_id',$lowongan_p)){
			$where	.= "and vac_id='".$lowongan_p['vac_id']."'";
		}

		$sql	= "SELECT *, SUM(click) as sclick, SUM(apply) as sapply FROM `jbvacancy_stat` where 1 ".$where." and date < DATE_SUB(date,INTERVAL 1 DAY)";
		$query	= $this->db->query($sql);
		return $query;
	}

	function a_stat($lowongan_p = NULL){
		$where	= "";
		if(array_key_exists('comp_id',$lowongan_p)){
			$where	.= "and j.comp_id='".$lowongan_p['comp_id']."'";
		}
		if(array_key_exists('vac_id',$lowongan_p)){
			$where	.= "and js.vac_id='".$lowongan_p['vac_id']."'";
		}
		if(array_key_exists('date',$lowongan_p)){
			$where	.= "and js.date='".$lowongan_p['date']."'";
		}

		$sql	= "SELECT js.*, SUM(click) as sclick, SUM(apply) as sapply FROM `jbvacancy_stat` js, jbvacancy j where 1 ".$where." and j.vac_id=js.vac_id and js.date < CURDATE() group by js.date";
		$query	= $this->db->query($sql);
		return $query;
	}

	function uc_view($lowongan_p = NULL){
		$where1	= "";
		$where2	= "";
		if(array_key_exists('vac_id',$lowongan_p)){
			$where1	.= "and s.vac_id='".$lowongan_p['vac_id']."'";
		}
		if(array_key_exists('comp_id',$lowongan_p)){
			$where2	.= "and v.comp_id='".$lowongan_p['comp_id']."'";
		}

		$q_stat	= $this->db->query("select * from `jbvacancy_stat` s where 1 ".$where1." and date=CURDATE()");
		if($q_stat->num_rows() == 0){
			$this->db->query("insert into jbvacancy_stat (vac_id,date,click) values('".$lowongan_p['vac_id']."',CURDATE(),1)");
		}else{
			$this->db->query("update jbvacancy_stat set click=click+1 where date=CURDATE() and vac_id='".$lowongan_p['vac_id']."'");
		}
	}

	function uc_apply($lowongan_p = NULL){
		$where1	= "";
		$where2	= "";
		if(array_key_exists('vac_id',$lowongan_p)){
			$where1	.= "and s.vac_id='".$lowongan_p['vac_id']."'";
		}
		if(array_key_exists('comp_id',$lowongan_p)){
			$where2	.= "and v.comp_id='".$lowongan_p['comp_id']."'";
		}

		$q_stat	= $this->db->query("select * from `jbvacancy_stat` s where 1 ".$where1." and date=CURDATE()");
		if($q_stat->num_rows() == 0){
			$this->db->query("insert into jbvacancy_stat (vac_id,date,apply) values('".$lowongan_p['vac_id']."',CURDATE(),1)");
		}else{
			$this->db->query("update jbvacancy_stat set apply=apply+1 where date=CURDATE() and vac_id='".$lowongan_p['vac_id']."'");
		}
	}
	
	function q_related($related){
		if(array_key_exists('related_by',$related) && $related['related_by'] == 'kerja'){
			$query	= $this->db->query("SELECT spes_level FROM `jbspecialist` where spes_id='".$related['related_data']."'");
		}	
		if(array_key_exists('related_by',$related) && $related['related_by'] == 'kota'){
			$query	= $this->db->query("SELECT state_id FROM `jbcity` where city_id = '".$related['related_data']."'");
		}	
	
	
		return $query;	
	}

	function create_lowongan($par = NULL){
		$sql_create	= "insert into jbvacancy (pos_id,spes_id,city_id,temp_id,vac_title,vac_detail,vac_salary_min,vac_salary_max,vac_sdate,vac_edate,comp_id) 
				values ('".$par['pos_id']."','".$par['spes_id']."','".$par['city_id']."','1','".$par['vac_title']."','".$par['vac_detail']."','".$par['vac_salary_min']."','".$par['vac_salary_max']."','".$par['vac_sdate']."','".$par['vac_edate']."','".$par['comp_id']."')";

		$this->db->query($sql_create);
		$vac_id	= $this->db->insert_id();
		
		$sql_require	= "insert into jbvacancy_require (vac_id,	edu_qualify_id, edu_field_id, sk_jns_klm, sk_age, sk_exper) 
					values ('".$vac_id."','".$par['edu_qualify_id']."','".$par['edu_field_id']."','".$par['sk_jns_klm']."','".$par['sk_age']."','".$par['sk_exper']."')";
		$this->db->query($sql_require);

	}


}
