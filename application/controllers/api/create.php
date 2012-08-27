<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class create extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->library('form_validation');
        $this->load->helper('url');
        
        $this->load->model('mapi');
        
    }
    
    function thing($json_response = true)
    {
        $this->form_validation->set_rules('thing_name', 'Thing Name', 'required|max_length[75]|callback__valid_string|is_unique[things.name]');
        $this->form_validation->set_rules('tags[]', 'Tag', 'is_natural_no_zero|max_length[20]');
        
        if ($this->form_validation->run()) {
            $thing = $this->input->post('thing_name');
            
            $new_thing_id = $this->mapi->create_thing($thing);
            
            //Attempt to assign the tags if they were posted and the thing was successfully created
            if (!empty($_POST['tags']) && $new_thing_id) {
                $tags = $this->input->post('tags');
                $tag_assignment = $this->mapi->assign_tag($new_thing_id, $tags); 
            }  
            
            $status = !empty($new_thing_id);
        }else{
            $errors = $this->form_validation->error_array();
            $status = empty($errors);
        }
        
        //Output a formatted response
        if ($json_response) {
            //We squelch errors here b/c PHP throws a warning if the default value is 0
            @$output->status = (int) $status;
            $output->errors = @$errors;
            
            echo json_encode($output);
        }
        
        return $status;
    }
    
    function tag($json_response = true)
    {
        $this->form_validation->set_rules('tags[]', 'Tag', 'is_natural_no_zero|max_length[20]');
        
        if ($this->form_validation->run()) {
            echo 'passed validation';
            $thing = $this->input->post('thing_name');
            $tags = $this->input->post('tags');
            $creation = $this->mapi->create_thing($thing);
            
            $status = array('status' => (int) $creation);
            return $creation;
        }else{
            $errors = $this->form_validation->error_array();
            $status = array('status' => (int) empty($errors));
        }
        
        if ($json_response) {
            $output = array_merge($status, array('errors' => @$errors));
            echo json_encode($output);
        }
        
        return false;
    }
    
    function _valid_string($str)
    {
        $regex_check = preg_match('/^[a-zA-Z0-9\.\s\!\@\#\$\%\^\&\*\(\)\{\}\[\]\"\'\+\=\-\_\,\/\?\:\;\<\>]*$/', $str);
        
        if (!$regex_check) {
            $this->form_validation->set_message(__FUNCTION__, 'Not a valid string.');
            return false;
        } else
            return true;
    }
}
