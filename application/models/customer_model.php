<?php

class Customer_model extends CI_Model {

    /** get customer data */
    public function insert_customerdetails($data_customer) {
        $result = $this->db->insert("customer", $data_customer);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function get_customers() {
        //get all customers
        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('customer t1');
        $this->db->join('customertype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        $this->db->where('t1.Status', 1);
        $result = $this->db->get();
        return $result;
    }

    public function get_customer($id) {
        //get a single customer details
        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('customer t1');
        $this->db->join('customertype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        //$this->db->where('t1.Status', 1);
        $this->db->where('t1.Id', $id);
        $result = $this->db->get();

        return $result;
    }

    /** Edit customer details */
    public function edit_customerdetails($customer_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('customer', $customer_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** get all deleted customers * */
    public function get_deactive_customers() {

        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('customer t1');
        $this->db->join('customertype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        $this->db->where('t1.Status', 0);
        $result = $this->db->get();
        return $result;
    }

    public function get_reps_customers($id) {
        //get all customers
        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('customer t1');
        $this->db->join('customertype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        $this->db->where('t1.RepId', $id);
        $this->db->where('t1.Status', 1);
        $result = $this->db->get();
        return $result;
    }

    //change password
    public function change_password($username, $password) {
        $this->db->where('CustomerId', $username);
        $this->db->set('Password', $password);
        $this->db->update('customer');
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
