<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usertyperole extends CI_Controller {

    public $photoname;
    public $photourl;

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model("userrole_model");
        $this->load->model("usertype_model");
        $this->load->model("usertyperole_model");
        $this->load->model("general_model");
        // $this->load->library('form_validation');
    }

    public function index() {
        // $this->load->helper(array('form', 'url'));
    }

    /** View all roles */
    public function view_usertyperoles() {
        $data["msg"] = NULL;
        $data["get_usertyperole"] = $this->usertyperole_model->get_usertyperoles();
        $data["get_usertype"] = $this->usertype_model->get_usertypes(); //get usertypes
        $data["get_userrole"] = $this->userrole_model->get_userrole(); //get userrole

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('usertyperole', 'TypeId', $this->input->Post("usertype")))) {

                /** Insert user Details * */
                $usertyperole_data = array();

                foreach ($this->input->Post("role") as $key => $value) {
                    $usertyperole_data[$key]['TypeId'] = $this->input->Post("usertype");
                    $usertyperole_data[$key]['RoleId'] = $value;
                }

                $result = $this->usertyperole_model->add_usertyperole($usertyperole_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'User roles assigned successfully.');
                } else {
                    $this->session->set_flashdata('error', 'User roles assigned fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Can not assigned... already roles are assigned .!! ');
            }
            redirect(base_url() . "index.php/usertyperole/view_usertyperoles");
            return;
        }
        $this->load->view('system/user_management/manage_roles/view_usertyperoles', $data);
    }

    /** Assigned roles */
    public function assigned_usertyperoles($id) {
        $query = $this->usertyperole_model->get_usertyperole($id);
        foreach ($query->result() as $usertyperole) {
            $data[] = array($usertyperole->TypeId, $usertyperole->RoleId); //load id and name to a array
        }
        echo json_encode($data);
    }

    /** edit roles */
    public function edit_usertyperole($id) {
        $data["msg"] = NULL;
        $data["get_usertype"] = $this->usertype_model->get_usertypes(); //get usertypes
        $data["get_userrole"] = $this->usertyperole_model->get_userroles_notassigned($id); //get userrole
        $data["get_usertyperole"] = $this->usertyperole_model->get_usertyperole($id); //get usertyperole

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('usertyperole', 'TypeId', $this->input->Post("usertype")))) {

                /** Insert user Details * */
                $usertyperole_data = array();
                foreach ($this->input->Post("role") as $key => $value) {
                    $usertyperole_data[$key]['TypeId'] = $id;
                    $usertyperole_data[$key]['RoleId'] = $value;
                }

                //var_dump($usertyperole_data);die;
                $result = $this->usertyperole_model->add_usertyperole($usertyperole_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'User roles assigned successfully.');
                } else {
                    $this->session->set_flashdata('error', 'User roles assigned fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/usertyperole/view_usertyperoles");
            return;
        }

        $this->load->view('system/user_management/manage_roles/edit_usertyperole', $data);
    }

    /** add roles */
    public function add_usertyperole() {
        $data["msg"] = NULL;
        $data["get_usertype"] = $this->usertype_model->get_usertypes(); //get usertypes
        $data["get_userrole"] = $this->userrole_model->get_userrole(); //get userrole

        if ($this->input->Post()) {
            if (($this->general_model->check_availability('usertyperole', 'TypeId', $this->input->Post("usertype")))) {

                /** Insert user Details * */
                $usertyperole_data = array();

                foreach ($this->input->Post("role") as $key => $value) {
                    // $usertyperole_data[$key]['TypeId'] = $this->input->Post("usertype");
                    //$usertyperole_data[$key]['RoleId'] = $value;
                    $usertyperole_data[] = '(' . $this->input->Post("usertype") . ',' . $value . ')';
                }

                //  var_dump($usertyperole_data);die;

                $result = $this->usertyperole_model->add_usertyperole($usertyperole_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'User roles assigned successfully.');
                } else {
                    $this->session->set_flashdata('error', 'User roles assigned fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Can not assigned... already roles are assigned .!! ');
            }
            redirect(base_url() . "index.php/usertyperole/view_usertyperoles");
            return;
        }

        $this->load->view('system/user_management/manage_roles/add_usertyperole', $data);
    }

    public function delete_usertyperole($TypeId, $RoleId) {

        $data["msg"] = NULL;

        $result = $this->usertyperole_model->delete_usertyperole($TypeId, $RoleId); //call module and insert data to user table
        if ($result) {
            $this->session->set_flashdata('success', 'User role Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'User role Deleted fail.');
        }
             redirect(base_url() . "index.php/usertyperole/edit_usertyperole/".$TypeId);
            return;
    }

}
