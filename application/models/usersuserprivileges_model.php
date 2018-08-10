<?php

class Usersuserprivileges_model extends CI_Model {

    public function get_usersprivileges() {
        //get all roles
        $this->db->select("usersuserprivilege.*,user.FullName,usertype.Type,GROUP_CONCAT(userprivilege.Privilege SEPARATOR ', ') AS Privileges");
        $this->db->from('usersuserprivilege');
        $this->db->join('user', 'usersuserprivilege.UserId = user.Id', 'INNER');
        $this->db->join('userprivilege', 'usersuserprivilege.PrivilegeId = userprivilege.Id', 'INNER');
        $this->db->join('usertype', 'user.TypeId = usertype.Id', 'INNER');
        $this->db->group_by('UserId');
        $result = $this->db->get();
        return $result;
    }

    public function get_rolesprivileges($id) {
        //get a single roles privilege details
        $this->db->select('userprivilege.*');
        $this->db->from('user');
        $this->db->join('usertyperole', 'user.TypeId = usertyperole.TypeId', 'INNER');
        $this->db->join('userprivilege', 'usertyperole.RoleId = userprivilege.RoleId', 'INNER');
        $this->db->join('userrole', 'userprivilege.RoleId = userrole.Id', 'INNER');
        $this->db->where('user.Id', $id);
        $result = $this->db->get();
        return $result;
    }

    public function get_privileges($id) {
        //get a single privilege details
        $this->db->select('usersuserprivilege.*,userprivilege.Privilege,user.FullName');
        $this->db->from('usersuserprivilege');
        $this->db->join('user', 'usersuserprivilege.UserId = user.Id', 'INNER');
        $this->db->join('userprivilege', 'usersuserprivilege.PrivilegeId = userprivilege.Id', 'INNER');
        $this->db->where('usersuserprivilege.UserId', $id);
        $result = $this->db->get();
        return $result;
    }

    /** add user type roles details */
    public function add_privilege($privilege_data) {
        //var_dump($privilege_data());die;
        $result = $this->db->insert_batch("usersuserprivilege", $privilege_data);
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

    public function get_userprivileges_notassigned($id) {
        
        $this->db->select('userprivilege.*');
        $this->db->from('user');
        $this->db->join('usertyperole', 'user.TypeId = usertyperole.TypeId', 'INNER');
        $this->db->join('userprivilege', 'usertyperole.RoleId = userprivilege.RoleId', 'INNER');
        $this->db->join('userrole', 'userprivilege.RoleId = userrole.Id', 'INNER');
        $this->db->where('user.Id', $id);
        $this->db->join('usersuserprivilege', 'userprivilege.Id=usersuserprivilege.PrivilegeId AND usersuserprivilege.UserId=' . $id . '', 'Left');
        $this->db->where('usersuserprivilege.PrivilegeId', NULL);
        $result = $this->db->get();

       // var_dump($result->result()); die;
        return $result;
    }


    /** delete user privilege details */
    public function delete_userprivilege($userId, $privilegeId) {
        $this->db->where('UserId', $userId);
        $this->db->where('PrivilegeId', $privilegeId);
        $result = $this->db->delete('usersuserprivilege');

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

}
