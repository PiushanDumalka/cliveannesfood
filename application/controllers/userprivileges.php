<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Userprivileges extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->load->model("userprivilege_model");
        $this->load->model("usersuserprivileges_model");
        $this->load->model("general_model");
        $this->load->model("usertype_model");
        $this->load->model("user_model");
        // $this->load->library('form_validation');
    }

    public function index() {
        // $this->load->helper(array('form', 'url'));
    }

    /** View all privilege */
    public function view_privileges() {
        $data["msg"] = NULL;
        $data["get_usersprivileges"] = $this->usersuserprivileges_model->get_usersprivileges();
        $data["get_privileges"] = $this->userprivilege_model->get_privileges();
        $data["get_users"] = $this->user_model->get_users();

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('usersuserprivilege', 'UserId', $this->input->Post('user')))) {

                $privilege_data = array();

                foreach ($this->input->Post("privilege") as $key => $value) {
                    $privilege_data[$key]['UserId'] = $this->input->Post("user");
                    $privilege_data[$key]['PrivilegeId'] = $value;
                }

                //var_dump($privilege_data);die;
                $result = $this->usersuserprivileges_model->add_privilege($privilege_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'Privilege assigned successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Privilege assigned fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/userprivileges/view_privileges");
            return;
        }

        $this->load->view('system/user_management/manage_privileges/view_privileges', $data);
    }

    /** edit privilege */
    public function edit_userprivilege($id) {
        $data["msg"] = NULL;
        $data["get_usersprivileges_notassigned"] = $this->usersuserprivileges_model->get_userprivileges_notassigned($id);
        $data["get_privileges"] = $this->usersuserprivileges_model->get_privileges($id);
        $data["get_users"] = $this->user_model->get_user($id);



        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('usersuserprivilege', 'UserId', $this->input->Post('user')))) {

                $privilege_data = array();

                foreach ($this->input->Post("privilege") as $key => $value) {
                    $privilege_data[$key]['UserId'] = $id;
                    $privilege_data[$key]['PrivilegeId'] = $value;
                }

                //var_dump($privilege_data);die;
                $result = $this->usersuserprivileges_model->add_privilege($privilege_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'Privilege update successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Privilege update fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "userprivileges/edit_userprivilege/" . $id);
            return;
        }



        $this->load->view('system/user_management/manage_privileges/edit_privileges', $data);
    }

    /** Assigned privileges */
    public function get_userprivileges($id) {
        $query = $this->usersuserprivileges_model->get_rolesprivileges($id);
        $query_privileges = $this->usersuserprivileges_model->get_privileges($id);
        $data=array();
        $data_privileges=array();
        foreach ($query->result() as $usersuserprivileges) {
            $data[] = array($usersuserprivileges->Id, $usersuserprivileges->Privilege); //load id and name to a array
        }
        foreach ($query_privileges->result() as $usersuserprivileges) {
            $data_privileges[] = array($usersuserprivileges->UserId, $usersuserprivileges->PrivilegeId); //load id and name to a array
        }
        echo json_encode(array($data,$data_privileges));
    }

    /** delete user privilege details */
    public function delete_userprivilege($userid, $privilegeid) {

        $data["msg"] = NULL;

        $result = $this->usersuserprivileges_model->delete_userprivilege($userid, $privilegeid); //delete user privilege
        if ($result) {
            $this->session->set_flashdata('success', 'User privilege Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'User privilege Deleted fail.');
        }
        redirect(base_url() . "index.php/userprivileges/view_privileges/" . $userid);
        return;
    }

}
