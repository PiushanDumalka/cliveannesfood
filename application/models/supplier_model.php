<?php

class Supplier_model extends CI_Model {

    /** get supplier data */
    public function insert_supplierdetails($data_supplier) {
        $result = $this->db->insert("supplier", $data_supplier);
        if ($result > 0) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    /** add supplier materials details */
    public function insert_supplierrawmaterialsdetails($data) {
        $result = $this->db->insert_batch("supplierrawmaterial", $data);
        //  $result = $this->db->query("INSERT INTO usertyperole (TypeId, RoleId) VALUES " . implode(",", $usertyperole_data) . " ON DUPLICATE KEY UPDATE RoleId = VALUES(RoleId),TypeId= VALUES(TypeId)");
        if ($result > 0) {
            return true;
        } else {
            $this->db->where('Id', $data[0]['SupplierId']);
            $this->db->delete('supplier');
            return false;
        }
    }

    public function get_suppliers() {
        //get all suppliers
        $this->db->order_by('Id', 'ASC');
        $this->db->where('Status', 1);
        $result = $this->db->get('supplier');
        return $result;
    }

    public function get_supplier($id) {
        //get a single supplier details
//        $this->db->select('t1.*,t3.RawmaterialName');
//        $this->db->from('supplier t1');
//        $this->db->join('supplierrawmaterial t2', 't1.Id = t2.SupplierId', 'INNER');
//        $this->db->join('rawmaterial t3', 't2.RawmaterialId = t3.Id', 'INNER');
//        //$this->db->where('t1.Status', 1);
        $this->db->where('Id', $id);
        $result = $this->db->get('supplier');

        return $result;
    }

    public function get_supplier_rawmaterial($id) {
        //get a single supplier details
        $this->db->select('t1.*,t2.*,t3.RawmaterialName,t3.RawMaterialCategoryId');
        $this->db->from('supplier t1');
        $this->db->join('supplierrawmaterial t2', 't1.Id = t2.SupplierId', 'INNER');
        $this->db->join('rawmaterial t3', 't2.RawmaterialId = t3.Id', 'INNER');
        $this->db->where('t3.RawMaterialCategoryId', 1);
        $this->db->where('t1.Id', $id);
        $result = $this->db->get();

        return $result;
    }

    public function get_supplier_packingmaterial($id) {
        //get a single supplier Packing Material details
        $this->db->select('t1.*,t2.*,t3.RawmaterialName');
        $this->db->from('supplier t1');
        $this->db->join('supplierrawmaterial t2', 't1.Id = t2.SupplierId', 'INNER');
        $this->db->join('rawmaterial t3', 't2.RawmaterialId = t3.Id', 'INNER');
        //$this->db->where('t1.Status', 1);
        $this->db->where('t1.Id', $id);
        $this->db->where('t3.RawMaterialCategoryId', 2);
        $result = $this->db->get();

        return $result;
    }

    /** Edit supplier details */
    public function edit_supplierdetails($supplier_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('supplier', $supplier_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_reps_suppliers($id) {
        //get all suppliers
        $this->db->select('t1.*,t2.Title,t3.name_en as city,t4.name_en as district,t5.name_en as province');
        $this->db->from('supplier t1');
        $this->db->join('suppliertype t2', 't1.SupplierTypeId = t2.Id', 'INNER');
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
        $this->db->where('SupplierId', $username);
        $this->db->set('Password', $password);
        $this->db->update('supplier');
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** delete supplier material details */
    public function delete_supplierrawmaterial($supplierId, $rawmaterialId) {
        $this->db->where('SupplierId', $supplierId);
        $this->db->where('RawmaterialId', $rawmaterialId);
        $result = $this->db->delete('supplierrawmaterial');

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function get_supplier_notassignedrawmaterials($id) {
        //get all raw not assigned to suppliers
        $this->db->select("rawmaterial.*");
        $this->db->from('rawmaterial');
        $this->db->join('supplierrawmaterial', 'rawmaterial.Id=supplierrawmaterial.RawmaterialId AND supplierrawmaterial.SupplierId=' . $id . '', 'Left');
        $this->db->where('supplierrawmaterial.RawmaterialId', NULL);
        $this->db->where('rawmaterial.RawMaterialCategoryId', 1);
        $this->db->where('rawmaterial.Status', 1);
        $result = $this->db->get();

        return $result;
    }

    public function get_supplier_notassignedpackingmaterials($id) {
        //get all packraw not assigned to suppliers
        $this->db->select("rawmaterial.*");
        $this->db->from('rawmaterial');
        $this->db->join('supplierrawmaterial', 'rawmaterial.Id=supplierrawmaterial.RawmaterialId AND supplierrawmaterial.SupplierId=' . $id . '', 'Left');
        $this->db->where('supplierrawmaterial.RawmaterialId', NULL);
        $this->db->where('rawmaterial.RawMaterialCategoryId', 2);
        $this->db->where('rawmaterial.Status', 1);
        $result = $this->db->get();

        return $result;
    }

    /** get all deleted suppliers * */
    public function get_deactive_suppliers() {

        $this->db->select('t1.*');
        $this->db->from('supplier t1');
        $this->db->where('t1.Status', 0);
        $result = $this->db->get();
        return $result;
    }

}
