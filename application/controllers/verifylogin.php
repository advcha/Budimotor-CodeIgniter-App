<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class VerifyLogin extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
		$this->load->model('log','',TRUE);
	}

	function index()
	{
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_check_database');

		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.  User redirected to login page
			$data['theme'] = $this->user->getThemeFromSession();
			$this->load->view('header_login',$data);
			$this->load->view('login_view', $data);
			$this->load->view('footer');
		}
		else
		{
			//Go to private area
			redirect('home', 'refresh');
		}

	}

	function check_database($password)
	{
		//Field validation succeeded.  Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->user->login($username, $password);

		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				if($row->enable == 0)
				{
					$this->form_validation->set_message('check_database', 'Pengguna ini sudah tidak aktif lagi!');
					return false;
				}
				else
				{
					$logintime = $this->user->getCurrentDateTimezone()->format('Y-m-d H:i:s');

					$sess_array = array(
						'id' => $row->iduser,
						'username' => $row->username,
						'name' => $row->name,
						'userlevel' => $row->userlevel,
						'logintime' => $logintime
					);
					$this->session->set_userdata('logged_in', $sess_array);
					//Save Session to table session
					$this->user->insertTblSession($row->iduser,$logintime);
					//Save Session to table log
					$this->log->saveToLog($logintime,$row->iduser,'select','tbl_user',$row->iduser,'Login','');
					return TRUE;
				}
			}
			
		}
		else
		{
			$this->form_validation->set_message('check_database', 'Nama pengguna atau password salah. Coba lagi!');
			return false;
		}
	}

}
