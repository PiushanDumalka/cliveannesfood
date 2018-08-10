<?php

class Userrole_model extends CI_Model {

    /** get usertype data */
    public function get_userrole() {
        $query = $this->db->get("userrole");
        return $query;
    }

}
