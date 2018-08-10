<?php

class Province_model extends CI_Model {

    /**get province data*/
    public function get_province() {
        $query = $this->db->get("province");
        return $query;
    }

}
