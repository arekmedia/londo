<?php 

class Lowongan_m extends CI_Model {

	function q_lowongan($lowongan_p = NULL,$row = FALSE)
	{
		$where	= "";
		$limit	= "";

		if(array_key_exists('spes_id',$lowongan_p) && $lowongan_p['spes_id'] != ""){
			$where	.= " and s.spes_id='".$lowongan_p['spes_id']."'";
		}
		if(array_key_exists('spes_in',$lowongan_p)){
			$where	.= " and s.spes_id IN (".$lowongan_p['spes_in'].")";
		}
		if(array_key_exists('ragam_id',$lowongan_p)){
			$where	.= " and s.spes_level='".$lowongan_p['ragam_id']."'";
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

		/*LIKE*/
		if(array_key_exists('search',$lowongan_p) && $lowongan_p['search'] != ""){
			$where	.= " and (v.vac_title LIKE '%".$lowongan_p['search']."%' OR s.spes_value LIKE '%".$lowongan_p['search']."%' OR cm.comp_nama LIKE '%".$lowongan_p['search']."%')";
		}

		
		$sql	= "SELECT * FROM jbtemplate t, jbstate st, jbcompany_type cmt, jbcompany cm, `jbvacancy` v, jbposition p, jbspecialist s, jbcity c WHERE t.temp_id=v.temp_id and t.temp_id=v.temp_id AND p.pos_id = v.pos_id AND s.spes_id = v.spes_id AND v.comp_id = cm.comp_id AND cmt.comp_type_id and cm.city_id=c.city_id and cm.comp_type_id=cmt.comp_type_id AND st.state_id = c.state_id and curdate() BETWEEN v.vac_sdate AND v.vac_edate ".$where." group by v.vac_id order by v.vac_edate desc";
		//echo $sql;
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
		return $result;
	}

	/************************************
	* PROSES PELAMARAN PEKERJAAN
	************************************/
	function check_apply($par = NULL){
		$where		= "";
		if(!empty($par['vac_id']) && $par['vac_id'] != "")
			$where	.= " and vac_id = '".$par['vac_id']."'";
		if(!empty($par['sk_id']) && $par['sk_id'] != "")
			$where	.= " and sk_id = '".$par['sk_id']."'";
		if(!empty($par['app_id']) && $par['app_id'] != "")
			$where	.= " and app_id = '".$par['app_id']."'";

		$sql_check	= "select * from jbapplay where 1 ".$where." ";

		$q_check	= $this->db->query($sql_check);
		return $q_check;
	}
	
	function do_apply($par){
		$insert_apply	= "insert into jbapplay (vac_id,sk_id,app_status) values ('".$par['vac_id']."','".$par['sk_id']."','received')";
		$this->db->query($insert_apply);
	}

	function update_apply($par){
		$set	= "";
		$where	= "";
		if(!empty($par['app_status']) && $par['app_status'] != "")
			$set	.= " app_status = '".$par['app_status']."', ";
		if(array_key_exists('checked',$par))
			$set	.= " checked = '".$par['checked']."',";
		if(!empty($par['now']) && $par['now'] == "1")
			$set	.= " app_follup=NOW(),";
			
		$set	= substr($set, 0, -1);
			
		$update_apply	= "update jbapplay set ".$set."  where app_id='".$par['app_id']."'";
		$this->db->query($update_apply);
	}
	
	/************************************
	* STATUS LOWONGAN
	************************************/
	function count_lamaran($par){
		$where	= "";
		$limit	= "";

		if(!empty($par['sk_id']) && $par['sk_id'] != "")
			$where	.= " and ja.sk_id = '".$par['sk_id']."'";

		if(!empty($par['vac_id']) && $par['sk_id'] != "")
			$where	.= " and ja.sk_id = '".$par['sk_id']."'";
	
		if(array_key_exists('checked',$par))
			$where	.= " and ja.checked = '".$par['checked']."'";
			
		$sql	= "select * from jbuser ju, jbseek js, jbapplay ja where 1 and ju.user_id=js.user_id and ja.sk_id=js.sk_id ".$where." order by ja.app_follup desc";
		$query	= $this->db->query($sql);
		return $query;
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
		$limit	= "";
		
		if(!empty($lowongan_p['comp_id']) && $lowongan_p['comp_id'] !== "")
			$where	.= "and j.comp_id='".$lowongan_p['comp_id']."'";
		if(!empty($lowongan_p['status']) && $lowongan_p['status'] !== "")
			$where	.= "and j.status='".$lowongan_p['status']."'";
		if(!empty($lowongan_p['limit']) && $lowongan_p['limit'] != "")
			$limit	.= " limit ".$lowongan_p['offset'].",".$lowongan_p['limit'];		
		
		$sql	= "SELECT j.*,SUM(js.click) as view,SUM(js.apply) as apply FROM jbvacancy j left join jbvacancy_stat js on j.vac_id=js.vac_id where 1 ".$where." group by j.vac_id order by j.vac_sdate desc ".$limit;
		$q_list_lowongan	= $this->db->query($sql);
		
		return $q_list_lowongan;
	}

	
	function d_stat($lowongan_p = NULL){
		$where	= "";
		if(array_key_exists('vac_id',$lowongan_p)){
			$where	.= "and vac_id='".$lowongan_p['vac_id']."'";
		}

		$lastlogin	= $this->session->userdata('lastlogin');
		
		$sql	= "SELECT *, SUM(click) as sclick, SUM(apply) as sapply FROM `jbvacancy_stat` where 1 ".$where." and date >= DATE('".$lastlogin."')";
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
		$query	= NULL;
	
		if(array_key_exists('related_by',$related) && $related['related_by'] == 'kerja'){
			$query	= $this->db->query("SELECT spes_level FROM `jbspecialist` where spes_id='".$related['related_data']."' limit 0,10");
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

	function pelamar_lowongan($par){
		$where	= "";

		if(!empty($par['umur1']) && $par['umur1'] != "")
			$where .= " and year(js.sk_tgl_lahir) between '".$par['umur2']."' and '".$par['umur1']."' ";
		if(!empty($par['jk']) && $par['jk'] != "")
			$where .= " and js.sk_jns_klm='".$par['jk']."' ";
		if(!empty($par['vac_id']) && $par['vac_id'] != "")
			$where .= " and ja.vac_id='".$par['vac_id']."' ";
		if(!empty($par['comp_id']) && $par['comp_id'] != "")	
			$where .= " and jv.comp_id='".$par['comp_id']."' ";
		if(!empty($par['app_status']) && $par['app_status'] != "" )
			$where .= " and ja.app_status='".$par['app_status']."' ";

		$sql	= "SELECT ja.app_status, jv.spes_id, ja.vac_id,js.*,ju.email,jc.city_value,jt.state_value,jt.state_id FROM  jbapplay ja, jbvacancy jv, jbuser ju, jbcity jc, jbstate jt, jbseek js
		left join jbseek_rule jr on js.sk_id=jr.sk_id
		where 1 ".$where." and ja.sk_id=js.sk_id and ja.vac_id=jv.vac_id and ju.user_id=js.user_id and js.city_id=jc.city_id and jc.state_id = jt.state_id group by js.sk_id";
		$query	= $this->db->query($sql);
		return $query;
	}
	
	function lamaran($par){
		$where	= "";
		$limit	= "";

		if(!empty($par['sk_id']) && $par['sk_id'] != "")
			$where	.= " and ja.sk_id = '".$par['sk_id']."'";
		if(!empty($par['limit']) && $par['limit'] != "")
			$limit	.= " limit ".$par['offset'].",".$par['limit'];		
			
		$sql	= "select * from jbvacancy jv, jbapplay ja, jbcompany jc where jv.comp_id=jc.comp_id and jv.vac_id=ja.vac_id ".$where." order by ja.app_follup desc ".$limit;
		$query	= $this->db->query($sql);
		return $query;
	}

	function lowongan_required($par){
		$where	= "";
		if(!empty($par['vac_id']) && $par['vac_id'] != "")
			$where	.= " and vac_id = '".$par['vac_id']."'";
	
		$sql	= "SELECT jr.*,jeq.edu_qualify_value,jef.edu_field_value FROM 
					`jbvacancy_require` jr left join jbmaster_edu_qualify jeq on jr.edu_qualify_id=jeq.edu_qualify_id  
					left join jbmaster_edu_field jef on jef.edu_field_id=jr.edu_field_id where 1 ".$where;
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function pengalaman_require($par){
		$where	= "";
		if(!empty($par['sk_id']) && $par['sk_id'] != "")
			$where	.= " and sk_id = '".$par['sk_id']."'";
		if(!empty($par['spes_id']) && $par['spes_id'] != "")
			$where	.= " and spes_id = '".$par['spes_id']."'";

		$sql	= "SELECT SUM(DATEDIFF(date_out, date_start)) as exper_day FROM jbseek_experience where 1 ".$where;
		$query	= $this->db->query($sql);		
		return $query;
	}
	
	function edit_lowongan($par){
	
		$set	= "";
		if(!empty($par['vac_edate']) && $par['vac_edate'] != "")
			$set	.= " `vac_edate` = '".$par['vac_edate']."', ";


		$sql	= "UPDATE `lowongan`.`jbvacancy` SET 
				".$set."
				`pos_id` = '".$par['pos_id']."',
				`spes_id` = '".$par['spes_id']."',
				`city_id` = '".$par['city_id']."',
				`vac_title` = '".$par['vac_title']."',
				`vac_detail` = '".$par['vac_detail']."',
				`vac_salary_min` = '".$par['vac_salary_min']."',
				`vac_salary_max` = '".$par['vac_salary_max']."',
				`vac_sdate` = '".$par['vac_sdate']."'
				 
				WHERE `jbvacancy`.`vac_id` ='".$par['vac_id']."'";
		$this->db->query($sql);

		$sql2	= "UPDATE `lowongan`.`jbvacancy_require` SET 
				`edu_qualify_id` = '".$par['edu_qualify_id']."',
				`edu_field_id` = '".$par['edu_field_id']."',
				`sk_jns_klm` = '".$par['sk_jns_klm']."',
				`sk_age` = '".$par['sk_age']."',
				`sk_exper` = '".$par['sk_exper']."' 
				WHERE `vac_id` ='".$par['vac_id']."'";

		$this->db->query($sql2);
	}
	
	function lowongan_stat($lowongan_p,$row=FALSE){
		$where	= "";
		$limit	= "";
		$group	= "";
		
		if(!empty($lowongan_p['date']) && $lowongan_p['date'] != "")
			$where	.= " and vs.date = date('".$lowongan_p['date']."') ";
		if(!empty($lowongan_p['comp_id']) && $lowongan_p['comp_id'] != "")
			$where	.= " and v.comp_id = '".$lowongan_p['comp_id']."' ";
		if(!empty($lowongan_p['status']) && $lowongan_p['status'] != "")
			$where	.= " and v.status = '".$lowongan_p['status']."' ";
		if(!empty($lowongan_p['available']) && $lowongan_p['available'] == "yes")
			$where	.= " and curdate() BETWEEN v.vac_sdate AND v.vac_edate ";
		if(!empty($lowongan_p['spes_id']) && $lowongan_p['spes_id'] != "")
			$where	.= " and s.spes_id='".$lowongan_p['spes_id']."'";

		if(!empty($lowongan_p['group']) && $lowongan_p['group'] != "")
			$group	.= " group by ".$lowongan_p['group'];
		
		$sql	= "SELECT * FROM jbcompany jc, `jbvacancy_stat` vs, jbvacancy v, jbspecialist s where v.spes_id=s.spes_id and jc.comp_id=v.comp_id and vs.vac_id=v.vac_id ".$where.$group."  order by vs.apply desc";

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

		$query	= $this->db->query($sql);		
		return $query;
	}
	
}
