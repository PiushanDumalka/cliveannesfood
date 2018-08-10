<?php

class User_model extends CI_Model {

    public function login_control($username, $password) {
        //check login details 
        $this->db->select('t1.Id as "Session_Id",t1.UserId,t1.FullName,t2.*,t3.*');
        $this->db->from('user t1');
        $this->db->join('usertyperole t2', 't1.TypeId = t2.TypeId', 'INNER');
        $this->db->join('userrole t3', 't2.RoleId = t3.Id', 'INNER');
        $this->db->where(array('Username' => $username, 'Password' => $password, 'status' => 1));
        $result = $this->db->get();
        return $result;
    }

    public function get_users() {
        //get all users
        $this->db->select('t1.*,t2.Designation');
        $this->db->from('user t1');
        $this->db->join('designation t2', 't1.DesignationId = t2.Id', 'INNER');
        $this->db->where('t1.Status', 1);
        $result = $this->db->get();

        return $result;
    }

    public function get_user($id) {
        //get a single user details
        $this->db->select('user.*,designation.Designation,usertype.Type');
        $this->db->from('user');
        $this->db->join('designation', 'user.DesignationId = designation.Id', 'INNER');
        $this->db->join('usertype', 'user.TypeId = usertype.Id', 'INNER');
        $this->db->where('user.Id', $id);
        $result = $this->db->get();

        return $result;
    }

    public function check_availability($UserId) {
        //check availability of user id
        $this->db->select('UserId');
        $this->db->from('user');
        $this->db->where('UserId', $UserId);
        $result = $this->db->get();

        if ($result->num_rows() > 0) {
            // var_dump($result);die;
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /** add user details */
    public function add_userdetails($user_data) {
        $result = $this->db->insert("user", $user_data);
        if ($result > 0) {
            return true;
        } else {
            return false;
        }
    }

    /** add user details */
    public function edit_userdetails($user_data, $id) {
        $this->db->where('Id', $id);
        $this->db->update('user', $user_data);
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    //change password
   public function change_password($username, $password) {
       $this->db->where('Username', $username);
        $this->db->set('Password', $password);
        $this->db->update('user');
        $result = $this->db->affected_rows();

        if ($result > 0) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    public function get_deactive_users() {
        //get all users
        $this->db->select('t1.*,t2.Designation');
        $this->db->from('user t1');
        $this->db->join('designation t2', 't1.DesignationId = t2.Id', 'INNER');
        $this->db->where('t1.Status', 0);
        $result = $this->db->get();

        return $result;
    }

}
