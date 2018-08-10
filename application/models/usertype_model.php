<?php

class Usertype_model extends CI_Model {

    /** get user type data */
    public function get_usertypes() {
        $query = $this->db->get("usertype");
        return $query;
    }

    /** add user type data */
    public function add_usertype() {
        $result = $this->db->insert("usertype", $usertype_data);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** get user type data */
    public function get_usertype($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get("usertype");
        return $query;
    }

    /** edit user type data */
    public function edit_usertype($usertype_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('usertype', $usertype_data);
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
