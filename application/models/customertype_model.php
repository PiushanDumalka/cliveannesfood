<?php

class Customertype_model extends CI_Model {

    /**get customertype data*/
    public function get_customertype() {
        $query = $this->db->get('customertype');
        return $query;
    }

}
