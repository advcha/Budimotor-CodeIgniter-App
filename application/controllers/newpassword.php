<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//session_start(); //we need to call PHP's session object to access it through CI
class NewPassword extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('setting','',TRUE);
		$this->load->model('log','',TRUE);
	}

	function index()
	{
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('oldpassword', 'Password Lama', 'trim|required|xss_clean|callback_check_oldpassword');
		$this->form_validation->set_rules('newpassword', 'Password Baru', 'trim|required|xss_clean|callback_check_newpassword');
		$this->form_validation->set_rules('newpasswordagain', 'Password Baru (Lagi)', 'trim|required|xss_clean');

		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to change password page
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
				$this->load->view('admin/set_password_view', $data);
			}
			else
			{
				//If no session, redirect to login page
				redirect('login', 'refresh');
			}
		}
		else
		{
			//Go to private area
			redirect('home/logout', 'refresh');
		}

	}

	function check_oldpassword($oldpassword)
	{
		$session_data = $this->session->userdata('logged_in');
		$username = $session_data['username'];

		//query the database
		$result = $this->user->login($username, $oldpassword);

		if($result)
		{
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_oldpassword', 'Password lama salah. Coba lagi!');
			return false;
		}
	}

	function check_newpassword($newpassword)
	{
		$session_data = $this->session->userdata('logged_in');
		$iduser = $session_data['id'];
		$username = $session_data['username'];
		
		$newpasswordagain = $this->input->post('newpasswordagain');

		if($newpassword == $newpasswordagain)
		{
			$this->user->saveNewPassword($iduser,$newpassword);
			$logtime = $this->user->getCurrentDateTimezone()->format('Y-m-d H:i:s');
			$this->log->saveToLog($logtime,$iduser,'update','tbl_user',$iduser,'Ubah Password','');
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('check_newpassword', 'Password baru tidak sama dengan password baru (lagi). Coba lagi!');
			return false;
		}
	}

}
