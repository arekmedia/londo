<?php

class Edu_m extends CI_Model{

	function edu_qualify($par = NULL){
		$where	= "";
	
		$sql	= "select * from jbmaster_edu_qualify where 1 ".$where." order by edu_qualify_id";
		$query	= $this->db->query($sql);
		return $query;
	
	}

	function edu_field($par = NULL){
		$where	= "";
	
		$sql	= "select * from jbmaster_edu_field where 1 ".$where." order by edu_field_id";
		$query	= $this->db->query($sql);
		return $query;
	
	}

	function edit_edu($par = NULL){
	
		if(!empty($par['uri']) && $par['uri'] != "" ){
		
			$check_row	= "select * from 			
				jbmaster_edu_qualify jeq,
				jbmaster_edu_field jef,
				jbseek_edu je where je.edu_qualify_id = jeq.edu_qualify_id and
				je.edu_field_id = jef.edu_field_id and
				je.sk_id='".$par['sk_id']."'";
			$query_check =  $this->db->query($check_row);
			
			if($query_check->num_rows() > 0){
				if($par['uri'] == "bs"){
					$sql	= "update jbseek_edu set edu_field_id= '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$this->db->query($sql);
					
					$query_check 	=  $this->db->query($check_row);
					$row_edu		= $query_check->row();
					return $row_edu->edu_field_value; 
				}			
				if($par['uri'] == "tpt"){
					$sql	= "update jbseek_edu set edu_qualify_id= '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$this->db->query($sql);
					
					$query_check 	=  $this->db->query($check_row);
					$row_edu 		= $query_check->row();
					return $row_edu->edu_qualify_value; 
				}
				if($par['uri'] == "cgpa"){
					$sql	= "update jbseek_edu set edu_grade= '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$this->db->query($sql);
					return  $par['value'];
				}

				if($par['uri'] == "nu"){
					$sql	= "update jbseek_edu set edu_instansi = '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$this->db->query($sql);
					return  $par['value'];
				}

				if($par['uri'] == "lo"){
					$sql	= "update jbseek_edu set edu_location = '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$this->db->query($sql);
					return  $par['value'];
				}

				if($par['uri'] == "nu"){
					$sql	= "update jbseek_edu set edu_instansi = '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$this->db->query($sql);
					return  $par['value'];
				}

				if($par['uri'] == "sp"){
					$sql	= "update jbseek_edu set edu_thn_ajaran= '".$par['value']."' where sk_id='".$par['sk_id']."'";
					$exp	= explode('|',$par['value']);
					$value	= $exp[0]." sampai ".$exp[1];
					
					$this->db->query($sql);
					return  $value;
				}

				
			}else{
				return FALSE;
			}
			
		}
	
	}

	function edu_lang($par = NULL){
		$where	= "";
				
		$sk_id	= $this->session->userdata('sk_id');
		$sql	= "SELECT * FROM jbseek_edu_lang  where 1 ".$where." and sk_id='".$sk_id."'";
		$query	= $this->db->query($sql);
		
		return $query;
	}
	
	function add_edu_lang($par = NULL){
		
		$where	= "";
				
		$sk_id	= $this->session->userdata('sk_id');
		$q_check_lang	= $this->db->query("select * from jbseek_edu_lang where lang_values='".$par['lang']."' and sk_id='".$sk_id."'");
		
		if($q_check_lang->num_rows() < 1){
		
			$sql_insert	= "insert into jbseek_edu_lang (sk_id,lang_values,lang_skill_s,lang_skill_w) values('".$sk_id."','".$par['lang']."','".$par['skill_s']."','".$par['skill_w']."')";
			$this->db->query($sql_insert);
			echo "1";
		}else{
			echo "0";
		}
	}
	
	function del_edu_lang($par = NULL){
	
		$sk_id	= $this->session->userdata('sk_id');
		$sql	= "delete from jbseek_edu_lang where edu_lang_id='".$par['edu_lang_id']."' and sk_id='".$sk_id."'";
		$this->db->query($sql);
	
	}

	/*[!] skill/keahlian khusus */
	function edu_skill($par = NULL){
		$where	= "";
				
		$sk_id	= $this->session->userdata('sk_id');
		$sql	= "SELECT * FROM jbseek_skill where 1 ".$where." and sk_id='".$sk_id."'";
		$query	= $this->db->query($sql);
		
		return $query;
	}

	function add_skill($par = NULL){
		
		$where	= "";
				
		$sk_id	= $this->session->userdata('sk_id');
		$q_check_skill	= $this->db->query("select * from jbseek_skill where keahlian='".$par['keahlian']."' and sk_id='".$sk_id."'");
		
		if($q_check_skill->num_rows() < 1){
		
			$sql_insert	= "insert into jbseek_skill (sk_id,keahlian,level,lama) values('".$sk_id."','".$par['keahlian']."','".$par['level']."','".$par['lama']."')";
			$this->db->query($sql_insert);
			echo "1";
		}else{
			echo "0";
		}
	}

	function del_skill($par = NULL){
	
		$sk_id	= $this->session->userdata('sk_id');
		$sql	= "delete from jbseek_skill where skill_id='".$par['skill_id']."' and sk_id='".$sk_id."'";
		$this->db->query($sql);
	
	}

	function attch($par = NULL){
		$where	= "";
		
		if(!empty($par['sk_id']) && $par['sk_id'] != "" ){
			$where	.= " and sk_id='".$par['sk_id']."'";
		}
	
		$sql	= "select * from jbseek_attch where 1 ".$where." order by attch_id";
		$query	= $this->db->query($sql);		
		return $query;
	}
}