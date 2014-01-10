<?php
Class Admin extends CI_Model{
	function getTodaySales(){
		$this->db->select('idtheme,themename,themeurl');
		$this->db->from('tbl_theme');
		
		$query = $this->db->get();
		
		return $query;
	}

	function getJenisBarang(){
		$this->db->select('idjenis,jenis_barang');
		$this->db->from('tbl_jenis_barang');
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function getLokasiBarang(){
		$this->db->select('idlokasi,lokasi_barang');
		$this->db->from('tbl_lokasi_barang');
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function getSatuanBarang(){
		$this->db->select('idsatuan,satuan,satuan_abbr');
		$this->db->from('tbl_satuan');
		
		$query = $this->db->get();
		
		return $query->result();
	}

	function getModeStock($mode_stock){
		$this->db->select('idmode_stock');
		$this->db->from('tbl_mode_stock');
		$this->db->where('mode_stock',$mode_stock);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			foreach($query->result() as $row){
				return $row->idmode_stock;
			}
		}else{
			return 0;
		}
	}

	function checkKodeBarang($kode){
		$this->db->select('idbarang');
		$this->db->from('tbl_barang');
		$this->db->where('kode',$kode);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}

	function checkNamaBarang($nama){
		$this->db->select('idbarang');
		$this->db->from('tbl_barang');
		$this->db->where('nama',$nama);
		$this->db->limit(1);
		
		$query = $this->db->get();
		
		if($query->num_rows() == 1){
			return true;
		}else{
			return false;
		}
	}
	/*
	function getDataBarang($date){
		$sql = 'select b.idbarang,b.kode,b.nama,b.idjenis,b.idlokasi,h.harga_beli,h.harga_jual from tbl_barang b 
			inner join tbl_harga h 
			on b.idbarang=h.idbarang
			where ("'.$date.'" between h.awal_berlaku and h.akhir_berlaku ) or ("'.$date.'" >= h.awal_berlaku and h.akhir_berlaku is null) 
			order by b.kode';
		
		$query = $this->db->query($sql);
		
		return $query;
	}
	*/
	function getDataBarang($idbarang){
		$sql = 'select b.idbarang,b.kode,b.nama,b.idjenis,b.idlokasi,h.harga_beli,h.harga_jual,
			DATE_FORMAT(h.awal_berlaku,"%d-%m-%Y") as awal_berlaku,
			case when h.akhir_berlaku = null then "" else DATE_FORMAT(h.akhir_berlaku,"%d-%m-%Y") end as akhir_berlaku 
			from tbl_barang b 
			inner join tbl_harga h 
			on b.idbarang=h.idbarang
			where b.idbarang = '.$idbarang;
		
		$query = $this->db->query($sql);
		
		return $query->result();
	}

	function saveBarang($barang_insert,$harga_insert,$stock_insert){
		$this->load->model('Log','log');
		$this->load->model('User','user');
		$logtime = $this->user->getCurrentDateTimezone()->format('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		//insert barang first
		$this->db->insert('tbl_barang',$barang_insert);
		$idbarang = $this->db->insert_id();//-->execute this first before the log one
		$this->log->saveToLog($logtime,$session_data['id'],'insert','tbl_barang',$session_data['id'],'saveBarang',$this->db->last_query());
		//then insert harga by using the last insert id from barang table
		$harga_insert['idbarang'] = $idbarang;
		$this->db->insert('tbl_harga',$harga_insert);
		$this->log->saveToLog($logtime,$session_data['id'],'insert','tbl_harga',$session_data['id'],'saveBarang',$this->db->last_query());
		//then insert stock by using the last insert id from barang table
		$stock_insert['idbarang'] = $idbarang;
		$stock_insert['id_mode'] = $idbarang;
		$this->db->insert('tbl_stock',$stock_insert);
		$this->log->saveToLog($logtime,$session_data['id'],'insert','tbl_stock',$session_data['id'],'saveBarang',$this->db->last_query());
	}

	function updateBarang($idbarang,$barang_update,$harga_update,$stock_update){
		$this->load->model('Log','log');
		$this->load->model('User','user');
		$logtime = $this->user->getCurrentDateTimezone()->format('Y-m-d H:i:s');
		$session_data = $this->session->userdata('logged_in');
		//update barang first
		$this->db->where('idbarang',$idbarang);
		$this->db->update('tbl_barang',$barang_update);
		$this->log->saveToLog($logtime,$session_data['id'],'update','tbl_barang',$session_data['id'],'updateBarang',$this->db->last_query());
		//then update harga
		$this->db->where('idbarang',$idbarang);
		$this->db->update('tbl_harga',$harga_update);
		$this->log->saveToLog($logtime,$session_data['id'],'update','tbl_harga',$session_data['id'],'updateBarang',$this->db->last_query());
		//then insert stock by using the last insert id from barang table
		$this->db->where('idbarang',$idbarang);
		$this->db->update('tbl_stock',$stock_update);
		$this->log->saveToLog($logtime,$session_data['id'],'update','tbl_stock',$session_data['id'],'updateBarang',$this->db->last_query());
	}

}
