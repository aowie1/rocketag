<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Contribute extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper('url');
		$this->load->library('tank_auth');
		$this->load->library('form_validation');
		$this->load->model('mcontribute');
                
                if (!$this->tank_auth->is_logged_in())
		    redirect('/auth/login/');
	}

	function index()
	{
		$data['user_id']	= $this->tank_auth->get_user_id();
		$data['username']	= $this->tank_auth->get_username();
		$this->load->view('contribute/create_data', $data);
	}
	
	function create_data_ajax()
	{
		$this->form_validation->set_rules('thing', 'Thing Field', "trim|xss_clean");
		//foreach($_POST['tag'] as $tag_field)
		$this->form_validation->set_rules('tag[]', 'Tag Field', "trim|xss_clean");
		if(empty($_POST['thing']) && empty($_POST['tag']))	
			echo json_encode(array('error' => 'At least one field must be populated.'));
		elseif($this->form_validation->run())
			echo ($output = $this->mcontribute->create_data()) ? json_encode(array('message' => 'Thing and tag(s) added successfully. ')) : json_encode(array('error' => 'A problem occurred while attempting to add the thing and/or tag(s).'));
		else
			echo json_encode(array('error' => validation_errors()));
	}
}

/* End of file contribute.php */
/* Location: ./application/controllers/contribute.php */