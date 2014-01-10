<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
session_start(); //we need to call PHP's session object to access it through CI
class Home extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('setting','',TRUE);
		$this->load->model('log','',TRUE);
	}

	function index()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['iduser'] = $session_data['id'];
			$data['username'] = $session_data['username'];
			$data['name'] = $session_data['name'];
			$data['userlevel'] = $session_data['userlevel'];
			$theme = $this->user->getThemeForUser($session_data['id']);
			foreach($theme as $row){
				$data['current_idtheme'] = $row->idtheme;
				$data['current_theme'] = $row->themename;
				$data['current_theme_url'] = $row->themeurl;
			}
			$data['themelist'] = $this->setting->getThemeList();
			$this->load->view('header', $data);
			//$this->load->view('home_view', $data);
			$this->template->load('home_view','navbar', $data);
			$this->load->view('footer');
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function change_password()
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['iduser'] = $session_data['id'];
			$data['username'] = $session_data['username'];
			$data['name'] = $session_data['name'];
			$data['userlevel'] = $session_data['userlevel'];
			$theme = $this->user->getThemeForUser($session_data['id']);
			foreach($theme as $row){
				$data['current_idtheme'] = $row->idtheme;
				$data['current_theme'] = $row->themename;
				$data['current_theme_url'] = $row->themeurl;
			}
			$data['themelist'] = $this->setting->getThemeList();
			$this->load->helper(array('form'));
			$this->load->view('header', $data);
			//$this->load->view('admin/set_password_view', $data);
			$this->template->load('admin/set_password_view','navbar', $data);
			$this->load->view('footer');
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function change_theme(){
		if($_POST['theme']){
			$iduser = $_POST['iduser'];
			$this->setting->setTheme($iduser,$_POST['theme']);
			
			$theme = $this->user->getThemeForUser($iduser);
			foreach($theme as $row){
				$current_theme_url = $row->themeurl;
			}
			
			echo $current_theme_url;
		}
	}
	
	function logout()
	{
		$session_data = $this->session->userdata('logged_in');
		$data['iduser'] = $session_data['id'];
		$data['logintime'] = $session_data['logintime'];
		
		$this->user->updateTblSession($data['iduser'],$data['logintime']);
			
		$logtime = $this->user->getCurrentDateTimezone()->format('Y-m-d H:i:s');
		$this->log->saveToLog($logtime,$data['iduser'],'select','tbl_user',$data['iduser'],'Logout','');
		
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('home', 'refresh');
	}

	function admin($current_menu = '')
	{
		if($this->session->userdata('logged_in'))
		{
			$session_data = $this->session->userdata('logged_in');
			$data['iduser'] = $session_data['id'];
			$data['username'] = $session_data['username'];
			$data['name'] = $session_data['name'];
			$data['userlevel'] = $session_data['userlevel'];
			$theme = $this->user->getThemeForUser($session_data['id']);
			foreach($theme as $row){
				$data['current_idtheme'] = $row->idtheme;
				$data['current_theme'] = $row->themename;
				$data['current_theme_url'] = $row->themeurl;
			}
			$data['themelist'] = $this->setting->getThemeList();
			
			if($session_data['userlevel'] == 'Administrator' || $session_data['userlevel'] == 'Manager'){
				$data['current_menu'] = $current_menu;
				if($current_menu == '')
					$data['current_menu'] = 'barang';
				$this->load->view('header', $data);
				$this->template->load('admin/admin_view','navbar', $data);
				$this->load->view('admin/sidebar_view', $data);
				
				$this->load->view('admin/'.$data['current_menu'].'_view');

				$this->load->view('footer');
			}else{
				$data['err_msg'] = 'Anda tidak diizinkan untuk membuka data administrasi!';
				$this->load->view('header', $data);
				$this->template->load('home_view','navbar', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}

	function barang(){
		$this->admin('barang');
	}

	function stock(){
		$this->admin('stock');
	}

	function sales(){
		$this->admin('sales');
	}

	function users(){
		$this->admin('users');
	}

	function setting(){
		$this->admin('setting');
	}
}

