<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Usertype extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->load->model("usertype_model");
        $this->load->model("general_model");
    }

    public function index() {
        // $this->load->helper(array('form', 'url'));
    }

    /** add usertype */
    public function add_usertype() {
        $data["msg"] = NULL;
        $data["get_usertypes"] = $this->usertype_model->get_usertypes();

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('usertype', 'Type', $this->input->Post('usertype')))) {

                $usertype_data = array(
                    "Type" => $this->input->Post("usertype"),
                );
                //var_dump($usertype_data);die;
                $result = $this->usertype_model->add_usertype($usertype_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'Type assigned successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Type assigned fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/usertype/view_usertypes");
            return;
        }

        $this->load->view('system/user_management/manage_usertypes/add_usertype', $data);
    }

    /** edit usertype */
    public function edit_usertype($id) {
        $data["msg"] = NULL;
        $data["get_usertypes"] = $this->usertype_model->get_usertypes();
        $data["get_usertype"] = $this->usertype_model->get_usertype($id);

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('usertype', 'Type', $this->input->Post('usertype')))) {

                $usertype_data = array(
                    "Type" => $this->input->Post("usertype"),
                );
                $result = $this->usertype_model->edit_usertype($usertype_data, $id); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'Type update successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Type update fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Update Not Complete .Please enter a different Type !! ');
            }
            redirect(base_url() . "index.php/usertype/add_usertype");
            return;
        }

        $this->load->view('system/user_management/manage_usertypes/edit_usertype', $data);
    }

}
