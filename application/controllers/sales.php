<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Sales extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('admin','',TRUE);
	}

	function index()
	{
		echo '<div class="alert alert-error">Tekan tombol "Tambah Data Penjualan" diatas!</div>';
	}
		
	function today_sales(){
		$sales = $this->admin->getTodaySales();
		
		if($sales->num_rows() >= 1){
			$data = '<table>';
			foreach($sales->result() as $row){
				$data.='<tr><td>'.$row->idtheme.'</td><td>'.$row->themename.'</td></tr>';
			}
			$data.='</table>';
			echo $data;
		}else{
			echo '';
		}
	}

	function new_sales()
	{
		$this->load->helper(array('form'));
		$this->load->view('admin/new_sales_view');
	}
}
