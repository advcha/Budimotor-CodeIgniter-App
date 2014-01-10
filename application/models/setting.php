<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
Class Setting extends CI_Model{
	function getThemeList(){
		$this->db->select('idtheme,themename');
		$this->db->from('tbl_theme');
		$this->db->where('enable',1);
		$this->db->order_by('idtheme','ASC');
		
		$query = $this->db->get();
		
		if($query->num_rows() >= 1){
			return $query->result();
		}else{
			return false;
		}
	}
	
	function setTheme($iduser,$idtheme){
		$update_theme_user=array(
			'idtheme'=>$idtheme
		);
		$this->db->where('iduser',$iduser);
		$this->db->update('tbl_user',$update_theme_user);
	}
}
