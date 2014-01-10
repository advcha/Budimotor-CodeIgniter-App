<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->model('user','',TRUE);
	}

	function index()
	{
		$data['theme'] = $this->user->getThemeFromSession();
		$this->load->view('header_login',$data);
		$this->load->helper(array('form'));
		$this->load->view('login_view');
		$this->load->view('footer');
	}
}
