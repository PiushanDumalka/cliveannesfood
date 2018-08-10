<?php

class Designation_model extends CI_Model {

    /** get designations data */
    public function get_designations() {
        $this->db->where('Status', 1);
        $query = $this->db->get("designation");
        return $query;
    }

    /** add designation data */
    public function add_designation() {
        $result = $this->db->insert("designation", $designation_data);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** get designation data */
    public function get_designation($id) {
        $this->db->where('Id', $id);
        $query = $this->db->get("designation");
        return $query;
    }

    /** edit designation data */
    public function edit_designation($designation_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('designation', $designation_data);
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** delete designation data */
    public function delete_designation($id) {
        $this->db->where('Id', $id);
         $this->db->set('Status',0);
        $this->db->update('designation');
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
 /** restore designation data */
    public function restore_designation($id) {
        $this->db->where('Id', $id);
         $this->db->set('Status',1);
        $this->db->update('designation');
        $result = $this->db->affected_rows();
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }
    /** delete designation data */
    public function deleted_designations() {
        $this->db->where('Status', 0);
        $query = $this->db->get("designation");
        return $query;
    }

}
