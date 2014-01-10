<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Barang extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin','',TRUE);
		$this->load->model('jqgrid','',TRUE);
		$this->load->model('user','',TRUE);
	}

	function index()
	{
		/*$table_header = '<table><thead>';
		$table_header .= '<tr>';
		$table_header .= '<td>No.</td>';
		$table_header .= '<td>Kode Barang</td>';
		$table_header .= '<td>Nama Barang</td>';
		$table_header .= '<td>Jenis</td>';
		$table_header .= '<td>Lokasi</td>';
		$table_header .= '<td>Harga Beli</td>';
		$table_header .= '<td>Harga Jual</td>';
		$table_header .= '</tr>';
		$table_header .= '</thead>';

		$today = $this->user->getCurrentDateTimezone()->format('Y-m-d');
		$barang = $this->admin->getDataBarang($today);
		
		if($barang->num_rows() >= 1){
			$data = $table_header;
			$i = 1;
			foreach($barang->result() as $row){
				$data.='<tr><td>'.$i.'</td>';
				$data.='<td>'.$row->kode.'</td>';
				$data.='<td>'.$row->nama.'</td>';
				$data.='<td>'.$row->idjenis.'</td>';
				$data.='<td>'.$row->idlokasi.'</td>';
				$data.='<td>'.$row->harga_beli.'</td>';
				$data.='<td>'.$row->harga_jual.'</td>';
				$data.='</tr>';
				$i++;
			}
			$data.='</table>';
			echo $data;
		}
		else
		{
			echo 'Data barang belum ada!';
		}*/
		$this->load->view('admin/barang_list_view');
	}
	
	function get_list_barang()
    {
		$today = $this->user->getCurrentDateTimezone()->format('Y-m-d');
		$query = "SELECT b.idbarang, b.kode, b.nama, IFNULL( j.jenis_barang,  '' ) AS jenis_barang, 
			IFNULL( l.lokasi_barang,  '' ) AS lokasi_barang, h.harga_beli, h.harga_jual, s.sisa AS stock
			FROM  `tbl_barang` b
			INNER JOIN  
			(SELECT DISTINCT idbarang,harga_beli,harga_jual FROM `tbl_harga` WHERE ('".$today."' between awal_berlaku and 
			akhir_berlaku ) or ('".$today."' >= awal_berlaku and akhir_berlaku is null)) h ON b.idbarang = h.idbarang
			INNER JOIN  
			(SELECT s.idbarang,s.qty,s.sisa FROM `tbl_stock` s 
			INNER JOIN 
			(SELECT idbarang,MAX(idstock) AS max_idstock FROM `tbl_stock` 
			GROUP BY idbarang) m ON s.idstock=m.max_idstock) s  ON b.idbarang = s.idbarang
			LEFT JOIN  `tbl_jenis_barang` j ON b.idjenis = j.idjenis
			LEFT JOIN  `tbl_lokasi_barang` l ON b.idlokasi = l.idlokasi";
        $page = $this->input->post('page'); // get the requested page
        $limit = $this->input->post('rows'); // get how many rows we want to have into the grid
        $sidx = $this->input->post('sidx'); // get index row - i.e. user click to sort
        $sord = $this->input->post('sord'); // get the direction if(!$sidx) $sidx =1;
 
        $req_param = array (
			"sort_by" => $sidx,
			"sort_direction" => $sord,
			"limit" => null,
			"search" => $this->input->post('_search'),
			/*"search_field" => isset($this->input->post('searchField'))?$this->input->post('searchField'):null,*/
			"search_field" => $this->input->post('searchField'),
			"search_operator" => $this->input->post('searchOper'),
			"search_str" => $this->input->post('searchString')
        );
 
        $row = $this->jqgrid->get_data('tbl_barang',$query,$req_param)->result_array();
        $count = count($row);
        if( $count >0 ) {
            $total_pages = ceil($count/$limit);
        } else {
            $total_pages = 0;
        }
        if ($page > $total_pages)
            $page=$total_pages;
        $start = $limit*$page - $limit; // do not put $limit*($page - 1)
 
        $req_param['limit'] = array(
			'start' => $start,
			'end' => $limit
        );
 
        $result = $this->jqgrid->get_data('tbl_barang',$query,$req_param)->result_array();
        // sekarang format data dari dB sehingga sesuai yang diinginkan oleh jqGrid dalam hal ini aku pakai JSON format
        $responce = new StdClass;
        $responce->page = $page;
        $responce->total = $total_pages;
        $responce->records = $count;
        for($i=0; $i<count($result); $i++)
        {
            $responce->rows[$i]['idbarang ']=$result[$i]['idbarang'];
            // data berikut harus sesuai dengan kolom-kolom yang ingin ditampilkan di view (js)
            $responce->rows[$i]['cell']=array(
				$result[$i]['idbarang'],
                $result[$i]['kode'],
                $result[$i]['nama'],
                $result[$i]['jenis_barang'],
                $result[$i]['lokasi_barang'],
                $result[$i]['harga_beli'],
                $result[$i]['harga_jual'],
                $result[$i]['stock']
            );
 
        }
 
        echo json_encode($responce);
    }
    
    function crud(){
        $this->jqgrid->crud('factory_output', 'FactoryID ', 'id', array('FactoryID', 'DatePro', 'Quantity'));
    }
    
	function barang_baru()
	{
		$this->load->helper(array('form'));
		$data['jenis'] = $this->admin->getJenisBarang();
		$data['lokasi'] = $this->admin->getLokasiBarang();
		$data['satuan'] = $this->admin->getSatuanBarang();
		$this->load->view('admin/barang_baru_view', $data);
	}
    
	function barang_edit($idbarang)
	{
		header('Content-Type:application/json;charset=utf-8',true);
		echo json_encode($this->admin->getDataBarang($idbarang));
	}
	
	function verifybarang()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->library('form_validation');

			$this->form_validation->set_rules('kode', 'Kode Barang', 'trim|required|xss_clean|callback_check_kode');
			$this->form_validation->set_rules('nama', 'Nama Barang', 'trim|required|xss_clean|callback_check_nama');
			$this->form_validation->set_rules('hargajual', 'Harga Jual', 'trim|required|xss_clean|callback_check_harga_nol');
			$this->form_validation->set_rules('mulai_berlaku', 'Mulai Berlaku harga', 'trim|required|xss_clean|callback_check_tgl');

			if($this->form_validation->run() == FALSE)
			{
				//Field validation failed.  User redirected to login page
				$err['error'] = 'true';
				if(form_error('kode'))
					$err['kode'] = form_error('kode');
				if(form_error('nama'))
					$err['nama'] = form_error('nama');
				if(form_error('hargajual'))
					$err['hargajual'] = form_error('hargajual');
				if(form_error('mulai_berlaku'))
					$err['mulai_berlaku'] = form_error('mulai_berlaku');
				echo json_encode($err);
			}
			else
			{
				if($this->input->post('edit_id') == 0)	//insert new data
				{
					$barang_insert = array(
						'kode' => strtoupper($this->input->post('kode')),
						'nama' => strtoupper($this->input->post('nama')),
						'idjenis' => $this->input->post('jenis'),
						'idlokasi' => $this->input->post('lokasi')
					);
					$harga_insert = array(
						'idsatuan' => $this->input->post('satuan'),
						'harga_beli' => str_replace('.','',$this->input->post('hargabeli')),
						'harga_jual' => str_replace('.','',$this->input->post('hargajual')),
						'awal_berlaku' => date('Y-m-d',strtotime($this->input->post('mulai_berlaku')))
					);
					if($this->input->post('chk_smp') != 'seterusnya')
						$harga_insert['akhir_berlaku'] = date('Y-m-d',strtotime($this->input->post('sampai_berlaku')));
					
					$stock_insert = array(
						'idmode_stock' => $this->admin->getModeStock('Stock Awal'),
						'tbl_mode' => 'tbl_barang',
						'qty' => $this->input->post('stockawal'),
						'sisa' => $this->input->post('stockawal')
					);

					$this->admin->saveBarang($barang_insert,$harga_insert,$stock_insert);
					$data['error'] = 'false';
					$data['message'] = 'Input Data barang berhasil!';
					echo json_encode($data);
				}
				else
				{
					//update data
					$idbarang = $this->input->post('edit_id');
					$barang_insert = array(
						'kode' => strtoupper($this->input->post('kode')),
						'nama' => strtoupper($this->input->post('nama')),
						'idjenis' => $this->input->post('jenis'),
						'idlokasi' => $this->input->post('lokasi')
					);
					$harga_insert = array(
						'idsatuan' => $this->input->post('satuan'),
						'harga_beli' => str_replace('.','',$this->input->post('hargabeli')),
						'harga_jual' => str_replace('.','',$this->input->post('hargajual')),
						'awal_berlaku' => date('Y-m-d',strtotime($this->input->post('mulai_berlaku')))
					);
					if($this->input->post('chk_smp') != 'seterusnya')
						$harga_insert['akhir_berlaku'] = date('Y-m-d',strtotime($this->input->post('sampai_berlaku')));
					
					$stock_insert = array(
						'idmode_stock' => $this->admin->getModeStock('Stock Awal'),
						'tbl_mode' => 'tbl_barang',
						'qty' => $this->input->post('stockawal'),
						'sisa' => $this->input->post('stockawal')
					);

					$this->admin->updateBarang($idbarang,$barang_insert,$harga_insert,$stock_insert);
					$data['error'] = 'false';
					$data['message'] = 'Input Data barang berhasil!';
					echo json_encode($data);
				}
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function check_kode()
	{
		//Field validation succeeded.  Validate against database
		$kode = $this->input->post('kode');
		//query the database
		$result = $this->admin->checkKodeBarang($kode);
		if(!$result)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_kode', 'Kode Barang ini sudah ada!');
			return false;
		}
	}	

	function check_nama()
	{
		//Field validation succeeded.  Validate against database
		$nama = $this->input->post('nama');

		//query the database
		$result = $this->admin->checkNamaBarang($nama);

		if(!$result)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_nama', 'Nama Barang ini sudah ada!');
			return false;
		}
	}	

	function check_harga_nol()
	{
		//Field validation succeeded.  Validate against database
		$hargajual = $this->input->post('hargajual');

		if($hargajual > 0)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_harga_nol', 'Harga Jual tidak boleh nol!');
			return false;
		}
	}	

	function check_tgl()
	{
		//Field validation succeeded.  Validate against database
		$mulai_berlaku = $this->input->post('mulai_berlaku');
		$sampai_berlaku = $this->input->post('sampai_berlaku');
		$chk_smp = $this->input->post('chk_smp');

		if($chk_smp != 'seterusnya')
		{
			if($sampai_berlaku != ''){
				$mulai_date = strtotime($mulai_berlaku);
				$sampai_date = strtotime($sampai_berlaku);
				if($mulai_date > $sampai_date){
					$this->form_validation->set_message('check_tgl', 'Tanggal mulai berlaku harga tidak boleh lebih besar dari tanggal sampai berlaku harga');
					return false;
				}else{
					return TRUE;
				}
			}else{
				$this->form_validation->set_message('check_tgl', 'Tanggal sampai berlaku harga tidak boleh kosong atau klik "seterusnya"');
				return false;
			}
		}else{
			return TRUE;
		}
	}	
}
