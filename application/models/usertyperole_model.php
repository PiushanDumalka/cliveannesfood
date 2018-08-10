<?php

class Usertyperole_model extends CI_Model {

    public function get_usertyperoles() {
        //get all roles
        $this->db->select("usertyperole.*,usertype.Type,GROUP_CONCAT(userrole.RoleName SEPARATOR ', ') AS RoleName");
        $this->db->from('usertyperole');
        $this->db->join('usertype', 'usertyperole.TypeId = usertype.Id', 'INNER');
        $this->db->join('userrole', 'usertyperole.RoleId = userrole.Id', 'INNER');
        $this->db->group_by('TypeId');
        $result = $this->db->get();
        return $result;
    }

    public function get_usertyperole($id) {
        //get a single usertyperole details
        $this->db->select('usertyperole.*,usertype.Type,userrole.RoleName');
        $this->db->from('usertyperole');
        $this->db->join('usertype', 'usertyperole.TypeId = usertype.Id', 'INNER');
        $this->db->join('userrole', 'usertyperole.RoleId = userrole.Id', 'INNER');
        $this->db->where('usertyperole.TypeId', $id);
        $result = $this->db->get();
        return $result;
    }

    public function get_userroles_notassigned($id) {
        //get all roles
        $this->db->select("userrole.*");
        $this->db->from('userrole');
        $this->db->join('usertyperole', 'userrole.Id=usertyperole.RoleId AND usertyperole.TypeId=' . $id . '', 'Left');
        $this->db->where('usertyperole.RoleId', NULL);
        $result = $this->db->get();

        return $result;
    }

    /** add user type roles details */
    public function add_usertyperole($usertyperole_data) {
        $result = $this->db->insert_batch("usertyperole", $usertyperole_data);
        //  $result = $this->db->query("INSERT INTO usertyperole (TypeId, RoleId) VALUES " . implode(",", $usertyperole_data) . " ON DUPLICATE KEY UPDATE RoleId = VALUES(RoleId),TypeId= VALUES(TypeId)");
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** edit user type role details */
    public function edit_usertyperole($user_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('user', $user_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** delete user type role details */
    public function delete_usertyperole($TypeId, $RoleId) {
        $this->db->where('TypeId', $TypeId);
        $this->db->where('RoleId', $RoleId);
        $result = $this->db->delete('usertyperole');

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
