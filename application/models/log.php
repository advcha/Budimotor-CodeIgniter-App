<?php
Class Log extends CI_Model{
	function saveToLog($logtime,$iduser,$mode,$table_name,$table_id,$notes,$sqlquery){
		$data_log = array(
			'logtime' => $logtime,
			'iduser' => $iduser,
			'mode' => $mode,
			'table_name' => $table_name,
			'table_id' => $table_id,
			'notes' => $notes,
			'sqlquery' => $sqlquery
		);
		
		$this->db->insert('tbl_log',$data_log);
	}
}
