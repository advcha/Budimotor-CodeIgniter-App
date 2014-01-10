<?php
Class User extends CI_Model{
	function getCurrentDateTimezone()
	{
		$date = new DateTime();
		$date->setTimezone(new DateTimeZone($GLOBALS['default_timezone']));
		return $date;
	}

	function getThemeFromSession(){
		$sql = 'select t.themename,t.themeurl from tbl_user u inner join tbl_theme t 
			on u.idtheme=t.idtheme left join tbl_session s 
			on u.iduser=s.iduser
			where s.ipaddress = "'.$_SERVER['REMOTE_ADDR'].'" and u.enable = 1
			order by s.idsession desc
			limit 1';
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->themename;
			}
		}else
			return $GLOBALS['default_theme'];
	}

	function getThemeForUser($iduser){
		$sql = 'SELECT t.idtheme,t.themename,t.themeurl FROM tbl_user u inner join tbl_theme t
			on u.idtheme=t.idtheme WHERE u.iduser = '.$iduser;
		
		$query = $this->db->query($sql);
		
		if($query->num_rows() == 1){
			return $query->result();
		}else{
			//return $GLOBALS['default_theme'];
			return $this->getDefaultThemeId();
		}
	}

	function getDefaultTheme(){
		$this->db->select('idtheme,themename,themeurl');
		$this->db->from('tbl_theme');
		$this->db->where('themename',$GLOBALS['default_theme']);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}

	function login($username,$password){
		$this->db->select('u.iduser,u.username,u.name,l.userlevel,u.enable');
		$this->db->from('tbl_user AS u');
		$this->db->join('tbl_userlevel AS l','u.iduserlevel=l.iduserlevel','INNER');
		$this->db->where('u.username',$username);
		$this->db->where('u.password',MD5($password));
		//$this->db->where('u.enable',1);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		//$this->db->last_query();
		
		if($query->num_rows() == 1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function insertTblSession($iduser,$logintime){
		$data_session = array(
			'logintime' => $logintime,
			'iduser' => $iduser,
			'ipaddress' => $_SERVER['REMOTE_ADDR']
		);
		
		$this->db->insert('tbl_session',$data_session);
	}
	
	function updateTblSession($iduser,$logintime){
		$update_session = array(
			'logouttime' => $this->getCurrentDateTimezone()->format('Y-m-d H:i:s')
		);
		
		$this->db->where('iduser',$iduser);
		$this->db->where('ipaddress',$_SERVER['REMOTE_ADDR']);
		$this->db->where('logintime',$logintime);
		$this->db->update('tbl_session',$update_session);
	}
	
	function saveNewPassword($iduser,$newpassword){
		$update_user = array(
			'password' => md5($newpassword)
		);
		
		$this->db->where('iduser',$iduser);
		$this->db->update('tbl_user',$update_user);
	}
}

