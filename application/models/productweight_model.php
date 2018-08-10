<?php

class Productweight_model extends CI_Model {

    /** get user type data */
    public function get_productweights() {
        $query = $this->db->get("productweight");
        return $query;  
    }

    /** add user type data */
    public function add_productweight() {
        $result = $this->db->insert("productweight", $productweight_data);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** get user type data */
    public function get_productweight($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get("productweight");
        return $query;
    }

    /** edit user type data */
    public function edit_productweight($productweight_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('productweight', $productweight_data);
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
