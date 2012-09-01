<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * API Model
 *
 * This model handles procedural data management.
 *
 * @author	Randen Kelly (aowie1@gmail.com)
 */
class Mapi extends CI_Model{
    
    function __construct()
    {
        parent::__construct();
    }

    //CREATE
    
    function create_thing($data)
    {
        $this->db->insert('things', $data);
    
        return $this->db->insert_id();
    }
    
    function relate_thing_category($data)
    {
        $this->db->insert('categories_things_joins', $data);
        
        return $this->db->insert_id();
    }
    
    function create_tag($data)
    {
        $this->db->insert('tags', $data);
        
        return $this->db->insert_id();
    }
    
    //READ
    function _get_things_by_tag($tag = false, $thing_category = 'all', $things_limit = 10, $random = 0)
    {
        if (empty($tag))
            return false;
            
        $this->db->select('things.name as thing_name, tags.name as tag_name');
        
        $this->db->join('things_tags_joins', 'things.things_id = things.id', 'left');
        $this->db->join('tags', 'things_tags_joins.tags_id = tags.id', 'right');
        
        $this->db->where('tags.name', $tag);
        
        $q = $this->db->get('things');
        
        $r = $q->result();
        
        return ($q->num_rows() > 0) ? $r : null;
    }
    
    function _get_tags_by_thing($thing = false, $tags_limit = 10, $start_spectrum = -10, $end_spectrum = 10, $is_fact = 0)
    {
        if(empty($thing))
            return false;
        
        $this->db->select('things.name as thing_name, tags.name as tag_name, spectrum.value as spectrum_value');
        
        $this->db->join('things_tags_joins', 'things_tags_joins.things_id = things.id', 'left');
        $this->db->join('tags', 'things_tags_joins.tags_id = tags.id', 'right');
        $this->db->join('spectrum', 'tags.id = spectrum.tags_id', 'left');
        
        $this->db->where('things.name', $thing);
        
        //should benchmark to see if always applying these filters slows this query down
        $this->db->where('spectrum >', $start_spectrum);
        $this->db->where('spectrum <', $end_spectrum);
        
        $this->db->limit($tags_limit);
        
        $q = $this->db->get('tags');
        
        $r = $q->result();
        
        return ($q->num_rows() > 0) ? $r : null;  
    }
    
    function _get_popular_things($thing_category = 'all', $things_limit = 10, $start_spectrum = -10, $end_spectrum = 10, $tags_limit = 10, $start_date = false, $end_date = false)
    {
        $start_date = time()-31536000;
        $end_date = time();
        
        $this->db->select('things.name as thing_name, spectrum.value as spectrum_value');
        
        $this->db->join('category_thing_joins', 'category_thing_joins.things_id = things.id', 'left');
        $this->db->join('thing_categories', 'thing_categories.id = category_thing_joins.thing_categories_id', 'left');
        $this->db->join('things_tags_joins', 'things.things_id = things.id', 'left');
        $this->db->join('tags', 'things_tags_joins.tags_id = tags.id', 'right');
        $this->db->join('spectrum', 'tags.id = spectrum.tags_id', 'left');
        
        if ($thing_category != 'all')
            $this->db->where('category', $thing_category);
            
        $q = $this->db->get('things');
        
        $r = $q->result();
        
        return ($q->num_rows() > 0) ? $r : null; 
    }
    
    //EDIT
    
    //DELETE
}
/* End of file mthings.php */
/* Location: ./application/models/mthings.php */