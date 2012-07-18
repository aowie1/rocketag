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
		$this->load->view('welcome');
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
			echo json_encode(array('error' => $this->form_validation->validation_errors()));
	}
	
	function new_thing(){
		if(!empty($_POST)){
			$this->form_validation->set_rules('thing_name', 'Thing Name', "trim|xss_clean|required");
			
			if($this->form_validation->run()){
				$thing_name = $this->input->post('thing_name');
			}
			
			//check if thing exists already, if not, create it
			if(!$existing_thing_id = $this->mthings->check_thing_exists($thing_name)){
			
				//if the thing was successfully inserted
				if($this->mthings->insert_thing($thing_name)){
					if(!empty($_POST['tags'])){
						$posted_tags = $this->input->post('tags');
						$tag_label = (count($posted_tags) > 1)
							? TAG_LABEL_PLURAL
							: TAG_LABEL_SINGULAR;
							
						if($this->mrelationships->new_thing_tag_join($new_thing_id, $this->input->post('tags'))){
							$output_data['msg'] = 'Your ',THING_LABEL_SINGULAR,' and '.$tag_label.' have been successfully posted.';
						}else
							$output_data['msg'] = 'Your ',THING_LABEL_SINGULAR,' was successfully ',CREATE_ACTION_LABEL_PAST,', but there was a problem ',JOIN_ACTION_LABEL_PRESENT,' your ',$tag_label,'. ',FAILURE_RESPONSE_FOLLOWUP;
					}else
						$output_data['msg'] = 'Your ',THING_LABEL_SINGULAR,'. ',FAILURE_RESPONSE_FOLLOWUP;
				}else
					$output_data['msg'] = 'There was a problem ',CREATE_ACTION_LABEL_PRESENT,' your ',THING_LABEL_SINGULAR,'. ',FAILURE_RESPONSE_FOLLOWUP;
			}else
				$output_data['msg'] = 'It appears the ',THING_LABEL_SINGULAR,' already exists in our system. <a href="',THING_VIEW_URL_PATH,$existing_thing_id,'">Click here</a> to view it now to ',JOIN_ACTION_LABEL_FUTURE,' or ',VOTE_ACTION_LABEL_FUTURE,' existing ',TAG_LABEL_PLURAL,'.';
		}
		$this->load->view('create/thing', $output_data);
	}
}

/* End of file contribute.php */
/* Location: ./application/controllers/contribute.php */