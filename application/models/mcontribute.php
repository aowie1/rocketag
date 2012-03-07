<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Contribute
 *
 * This model represents authenticated user inputted data. It operates the following tables:
 * - things, tags, thing_tag_joins
 *
 * @author	Randen Kelly (aowie1@gmail.com)
 */
class MContribute extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->library('tank_auth');
    }
    function create_data()
    {
        //insert things
        $thing_data['thing_name'] = $this->input->post('thing', TRUE);
        if(!empty($thing_data['thing_name'])){
            $this->db->insert('things', $thing_data);
            $inserted_things = $this->db->affected_rows();
            
            //make the connection
            $new_thing_id = $this->db->insert_id();
            $thing_conn_data['thing_id'] = $new_thing_id;
            $thing_conn_data['user_id'] = $this->tank_auth->get_user_id();
            $this->db->insert('connections', $thing_conn_data);
        }
        
        //insert tags
        $tags = $this->input->post("tag", TRUE);
        foreach($tags as $i => $tag){
            $tag_data[$i]['tag_name'] = $tag;
            $this->db->insert('tags', $tag_data[$i]);
            $new_tag_ids[] = $this->db->insert_id();
            $inserted_tags = $this->db->affected_rows();
        }
        //Alternative method if we can figure out how to get insert_ids from each query that insert_batch executes
        /*if(!empty($tag_data)){
            $this->db->insert_batch('tags', $tag_data);
        }*/
            
        //make the connection
        $user_id = $this->tank_auth->get_user_id();
        
        foreach($new_tag_ids as $j => $new_tag_id){
            $tag_conn_data[$j] = array(
                'tag_id' => $new_tag_id,
                'user_id' => $user_id
            );
            $this->db->insert('connections', $tag_conn_data[$j]);
        }
        
        return ((@$inserted_things+@count($inserted_tags)) > 0);
    }
}
/* End of file mcontribute.php */
/* Location: ./application/models/mcontribute.php */