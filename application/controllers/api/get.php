<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Get extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->model('mapi');
        
    }
    
    //get things by tag
    function things($tag = false, $thing_category = 'all', $things_limit = 10, $random = 0)
    {
        //validation by a form of type hinting
        $error->tag             = (empty($tag));
        $error->thing_category  = (!empty($thing_category) && !is_str($thing_category));
        $error->things_limit      = (!empty($things_limit) && !is_int($things_limit));
        $error->random          = (!empty($random) && !is_int($random));
        
        if(!empty($error))
            foreach($error as $status)
                if($status)
                    die(API_INVALID_REQUEST);
        
        $result = $this->mapi->get_things_by_tag($tag, $thing_category, $tags_limit, $random);
        
        if(!empty($result))
            echo json_encode($result);
        else
            echo json_encode((object) array('error' => API_NO_RESULTS));
    }
    
    //get tags by thing
    function tags($thing = false, $tags_limit = 10, $start_spectrum = -10, $end_spectrum = 10, $is_fact = 0)
    {
        //validation by a form of type hinting
        $error->tag             = (empty($thing));
        $error->tags_limit      = (!empty($tags_limit) && !is_int($tags_limit));
        $error->start_spectrum  = (!empty($start_spectrum) && !is_int($start_spectrum));
        $error->end_spectrum    = (!empty($end_spectrum) && !is_int($end_spectrum));
        $error->is_fact         = (!empty($is_fact) && !is_int($is_fact));
        
        if(!empty($error))
            foreach($error as $status)
                if($status)
                    die(API_INVALID_REQUEST);
        
        $result = $this->mapi->get_tags_by_thing($thing, $tags_limit, $start_spectrum, $end_spectrum, $is_fact);
        
        if(!empty($result))
            echo json_encode($result);
        else
            echo json_encode((object) array('error' => API_NO_RESULTS));
    }
}