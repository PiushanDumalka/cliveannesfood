<?php

class Productcategory_model extends CI_Model {

    /** get user type data */
    public function get_productcategories() {
        $query = $this->db->get("productcategory");
        return $query;  
    }

    /** add user type data */
    public function add_productcategory() {
        $result = $this->db->insert("productcategory", $productcategory_data);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** get user type data */
    public function get_productcategory($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get("productcategory");
        return $query;
    }

    /** edit user type data */
    public function edit_productcategory($productcategory_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('productcategory', $productcategory_data);
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

}
