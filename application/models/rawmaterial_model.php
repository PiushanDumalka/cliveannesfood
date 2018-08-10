<?php

class Rawmaterial_model extends CI_Model {

    /** get raw material data */
    public function insert_rawmaterialdetails($data_rawmaterial) {
        $result = $this->db->insert("rawmaterial", $data_rawmaterial);
        if ($result > 0) {
            $this->db->set('RawMaterialCode', 'RM' . str_pad($this->db->insert_id(), 6, '0', STR_PAD_LEFT));
            $this->db->where('Id', $this->db->insert_id());
            $this->db->update('rawmaterial');
            $result = $this->db->affected_rows();
            if ($result > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function get_rawmaterials() {
        //get all rawmaterials
        $this->db->select('t1.*');
        $this->db->from('rawmaterial t1');
        // $this->db->join('rawmaterialtype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        // $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        // $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        // $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        $this->db->where('t1.RawMaterialCategoryId', 1);
        $this->db->where('t1.Status', 1);
        $result = $this->db->get();
        return $result;
    }

    public function get_packingmaterials() {
        //get all packing materials
        $this->db->select('t1.*');
        $this->db->from('rawmaterial t1');
        // $this->db->join('rawmaterialtype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        // $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        // $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        // $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        $this->db->where('t1.RawMaterialCategoryId', 2);
        $this->db->where('t1.Status', 1);
        $result = $this->db->get();
        return $result;
    }

    public function get_rawmaterial($id) {
        //get a single rawmaterial details
        $this->db->select('t1.*,t3.*');
        $this->db->from('rawmaterial t1');
        $this->db->join('supplierrawmaterial t2', 't2.RawMaterialId = t1.Id', 'INNER');
        $this->db->join('supplier t3', 't2.SupplierId = t3.Id', 'INNER');
        $this->db->where('t1.Id', $id);
        $result = $this->db->get();

        return $result;
    }

    /** Edit raw material details */
    public function edit_rawmaterialdetails($rawmaterial_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('rawmaterial', $rawmaterial_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** get all deleted rawmaterials * */
    public function get_deactive_rawmaterials() {

        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('rawmaterial t1');
        $this->db->join('rawmaterialtype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
        $this->db->join('city t3', 't1.CityId = t3.Id', 'INNER');
        $this->db->join('district t4', 't1.DistrictId = t4.Id', 'INNER');
        $this->db->join('province t5', 't1.provinceId = t5.Id', 'INNER');
        $this->db->where('t1.Status', 0);
        $result = $this->db->get();
        return $result;
    }

    public function get_reps_rawmaterials($id) {
        //get all rawmaterials
        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('rawmaterial t1');
        $this->db->join('rawmaterialtype t2', 't1.CustomerTypeId = t2.Id', 'INNER');
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
        $this->db->update('rawmaterial');
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
