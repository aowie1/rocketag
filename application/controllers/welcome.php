<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
	}

	function index()
	{
		if (!$this->tank_auth->is_logged_in()) {
			redirect('/auth/login/');
		} else {
			$data['user_id']	= $this->tank_auth->get_user_id();
			$data['username']	= $this->tank_auth->get_username();
			$this->load->view('welcome', $data);
		}
	}
	// Use this to get a new password hash via tank_auth
	/* function change_password($password){
		$this->load->helper(array('form', 'url'));
		$this->load->library('form_validation');
		$this->load->library('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
		

		$hasher = new PasswordHash(
		    $this->config->item('phpass_hash_strength', 'tank_auth'),
		    $this->config->item('phpass_hash_portable', 'tank_auth')
		);
		$hashed_password = $hasher->HashPassword($password);
		echo $hashed_password;
	}*/
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */