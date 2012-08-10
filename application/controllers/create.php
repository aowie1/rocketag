<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class create extends CI_Controller {

    function __construct()
    {
        parent::__construct();

        $this->load->helper('url');
        
    }
    //thing_name (string), tag_ids (mixed[int|array]), category_ids (mixed[int|array])
    function thing()
    {
        $input_data->thing_name     = $this->input->post('thing_name');
        $input_data->tag_ids        = json_decode($this->input->post('tag_ids'));
        $input_data->category_ids   = json_decode($this->input->post('category_ids'));
        $input_data->anonymous      = $this->input->post('anonymous');
        
        //validation by a form of type hinting
        //required
        $validate->thing           = (!empty($input_data->thing_name) && is_string($input_data->thing_name));
        
        //optional
        $validate->tag_ids         = (is_array($input_data->tag_ids) || is_int($input_data->tag_ids));
        $validate->category_ids    = (is_array($input_data->category_ids) || !is_int($input_data->category_ids));
        $validate->anonymous       = (is_int($input_data->anonymous));
        
        if(!empty($validate))
            foreach($validate as $key => $status)
                if(!$status)
                    die('Invalid request for "'.$key.'"');
                    
        $this->db->insert('things', $input_data->thing_name);
        $new_thing_id = $this->db->insert_id();
        
        if(!empty($input_data->tags_ids)) {
            foreach($input_data->tags_ids as $tag_id)
                $insert_tag_data[] = array(
                    'things_id'      => $new_thing_id,
                    'tags_id'        => $tag_id,
                    'originator'    => (int) $this->check_thing_tag_join_exists($new_thing_id, $tag_id),
                    'anonymous'     => $input_data->anonymous,
                    'created_ts'    => time()
                );
            $this->db->insert_batch('things_tags_joins', $insert_tag_data);
        }
        
        if(!empty($input_data->category_ids)) {
            foreach($input_data->category_ids as $category_id)
                $insert_category_data[] = array(
                    'things_id'              => $new_thing_id,
                    'thing_categories_id'   => $category_id
                );
            $this->db->insert_batch('categories_things_joins', $insert_category_data);
        }
    }
}
