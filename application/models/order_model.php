<?php

class Order_model extends CI_Model {

    /** get customer data */
    public function insert_order($data) {
        $result = $this->db->insert("customerorder", $data);
      
        $id = $this->db->insert_id();
        if ($result > 0) {
            $CustomerOrdercode = 'PO' . str_pad($id, 6, '0', STR_PAD_LEFT);
            $this->db->set('CustomerOrdercode', $CustomerOrdercode);
            $this->db->where('Id', $id);
            $this->db->update('customerorder');
            $result = $this->db->affected_rows();
        }
        return (isset($id)) ? $id : FALSE;
    }

    /** get customer data */
    public function insert_order_details($data) {
        $result = $this->db->insert("customerorderproduct", $data);
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

}
