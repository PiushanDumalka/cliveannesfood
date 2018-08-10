<?php

class Userprivilege_model extends CI_Model {

    public function get_privileges() {
        //get all privileges
        $query = $this->db->get("userprivilege");
        return $query;
    }

    public function get_privilege($id) {
        //get a single privilege details
        $this->db->select('privilege.*,usertype.Type,userrole.RoleName');
        $this->db->from('privilege');
        $this->db->join('usertype', 'privilege.TypeId = usertype.Id', 'INNER');
        $this->db->join('userrole', 'privilege.RoleId = userrole.Id', 'INNER');
        $this->db->where('privilege.TypeId', $id);
        $result = $this->db->get();
        return $result;
    }

    /** add user type roles details */
    public function add_privilege($privilege_data) {
        //var_dump($privilege_data());die;
        $result = $this->db->insert_batch("privilege", $privilege_data);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** edit user type role details */
    public function edit_privilege($user_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('user', $user_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
