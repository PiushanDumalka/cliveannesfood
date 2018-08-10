<?php

class General_model extends CI_Model {

    public function check_availability($table, $columnname, $value) {
        //check availability of data
        $this->db->select($columnname);
        $this->db->from($table);
        $this->db->where($columnname, $value);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            // var_dump($result);die;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function check_availability_with_id($table, $columnname, $value, $where, $id) {
        //check availability of data
        $this->db->select($columnname);
        $this->db->from($table);
        $this->db->where($columnname, $value);
        $this->db->where($where, $id);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            // var_dump($result);die;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function last_id($table, $columnname) {
        //get last id and add 1
        $query = $this->db->select($columnname)->order_by($columnname, 'desc')->limit(1)->get($table)->row($columnname);
        return $query + 1;
    }

}
