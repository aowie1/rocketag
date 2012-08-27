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
        $error->tag             = (empty($tag) || !is_string($tag));
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
        $error->tag             = (empty($thing) || !is_string($thing));
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
    
    function pop_things($thing_category = 'all', $things_limit = 10, $start_spectrum = -10, $end_spectrum = 10, $tags_limit = 10, $start_date = false, $end_date = false)
    {
        if (!empty($start_date))
            $start_date = (time()-31536000);
        if (!empty($end_date))
            $end_date = time();
            
        //validation by a form of type hinting
        $error->thing_category  = (!empty($thing_category) && !is_string($thing_category));
        $error->things_limit    = (!empty($things_limit) && !is_int($things_limit));
        $error->start_spectrum  = (!empty($start_spectrum) && !is_int($start_spectrum));
        $error->end_spectrum    = (!empty($end_spectrum) && !is_int($end_spectrum));
        $error->tags_limit      = (!empty($tags_limit) && !is_int($tags_limit));
        $error->start_date      = (!empty($start_date) && !is_int($start_date));
        $error->end_date        = (!empty($end_date) && !is_int($end_date));
        
        if(!empty($error))
            foreach($error as $status)
                if($status)
                    die(API_INVALID_REQUEST);
                    
        $result = $this->mapi->get_pop_things($thing_category, $things_limit, $start_spectrum, $end_spectrum, $tags_limit, $start_date, $end_date);
        
        if(!empty($result))
            echo json_encode($result);
        else
            echo json_encode((object) array('error' => API_NO_RESULTS));
    }
    
    function categories($thing = 'all', $cat_limit = 10)
    {
        //validation by a form of type hinting
        $error->thing           = (!empty($thing) && !is_string($thing));
        $error->cat_limit       = (!empty($cat_limit) && !is_int($cat_limit));
        
        if(!empty($error))
            foreach($error as $status)
                if($status)
                    die(API_INVALID_REQUEST);
                    
        $result = $this->mapi->get_categories($thing, $cat_limit);
        
        if(!empty($result))
            echo json_encode($result);
        else
            echo json_encode((object) array('error' => API_NO_RESULTS));   
    }
    
    function images($thing = 'all', $images_limit = 5)
    {
        //validation by a form of type hinting
        $error->thing           = (!empty($thing) && !is_string($thing));
        $error->images_limit    = (!empty($images_limit) && !is_int($images_limit));
        
        if(!empty($error))
            foreach($error as $status)
                if($status)
                    die(API_INVALID_REQUEST);
                    
        $result = $this->mapi->get_images($thing, $images_limit);
        
        if(!empty($result))
            echo json_encode($result);
        else
            echo json_encode((object) array('error' => API_NO_RESULTS));
    }
    
    function links($thing = 'all', $links_limit = 10)
    {
        //validation by a form of type hinting
        $error->thing           = (!empty($thing) && !is_string($thing));
        $error->links_limit     = (!empty($links_limit) && !is_int($links_limit));
        
        if(!empty($error))
            foreach($error as $status)
                if($status)
                    die(API_INVALID_REQUEST);
                    
        $result = $this->mapi->get_images($thing, $links_limit);
        
        if(!empty($result))
            echo json_encode($result);
        else
            echo json_encode((object) array('error' => API_NO_RESULTS));
    }
}