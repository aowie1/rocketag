<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Thinks
 *
 * This model handles CRUD functionality for things.
 *
 * @author	Randen Kelly (aowie1@gmail.com)
 */
class Mthings extends CI_Model{
    function create_thing($input_string){
        $sql = "INSERT INTO things (thing_name) VALUES (?)";
        $this->db->query($sql, func_get_args());

        return $this->db->insert_id();
    }
    function check_thing_exists($input_string, $main_category_id, $limit = 5){
        $sql = "SELECT * FROM things
        JOIN category_thing_joins ON category_thing_joins.things_id = things.id
        WHERE things.thing_name = ? AND category_thing_joins.category_id = ?
        LIMIT = 0, ?";
        
        $this->db->query($sql, func_get_args());
    }
}
/* End of file mthings.php */
/* Location: ./application/models/mthings.php */