<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Designation extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }

        $this->load->model("designation_model");
        $this->load->model("general_model");
    }

    public function index() {
        // $this->load->helper(array('form', 'url'));
    }

    /** add designation */
    public function add_designation() {
        $data["msg"] = NULL;
        $data["get_designations"] = $this->designation_model->get_designations();

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('designation', 'Designation', $this->input->Post('designation')))) {

                $designation_data = array(
                    "Designation" => $this->input->Post("designation"),
                );
                //var_dump($designation_data);die;
                $result = $this->designation_model->add_designation($designation_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'Designation assigned successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Designation assigned fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/designation/view_designations");
            return;
        }

        $this->load->view('system/user_management/manage_designations/add_designation', $data);
    }

    /** edit designation */
    public function edit_designation($id) {
        $data["msg"] = NULL;
        $data["get_designations"] = $this->designation_model->get_designations();
        $data["get_designation"] = $this->designation_model->get_designation($id);

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('designation', 'Designation', $this->input->Post('designation')))) {

                $designation_data = array(
                    "Designation" => $this->input->Post("designation"),
                );
                $result = $this->designation_model->edit_designation($designation_data, $id); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'Designation update successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Designation update fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Update Not Complete .Please enter a different Designation !! ');
            }
            redirect(base_url() . "index.php/designation/add_designation");
            return;
        }

        $this->load->view('system/user_management/manage_designations/edit_designation', $data);
    }

    /** Deleted Designation */
    public function delete_designation($id) {
        $data["msg"] = NULL;
        $data["delete_designation"] = $this->designation_model->delete_designation($id);
        $data["deleted_designations"] = $this->designation_model->deleted_designations();
        $this->load->view('system/user_management/manage_designations/deleted_designation', $data);
    }
       /** Deleted Designation */
    public function restore_designation($id) {
        $data["msg"] = NULL;
        $data["restore_designation"] = $this->designation_model->restore_designation($id);
        $data["deleted_designations"] = $this->designation_model->deleted_designations();
        $this->load->view('system/user_management/manage_designations/deleted_designation', $data);
    }

    /** Deleted Designation */
    public function deleted_designation() {
        $data["msg"] = NULL;
        $data["deleted_designations"] = $this->designation_model->deleted_designations();
        $this->load->view('system/user_management/manage_designations/deleted_designation', $data);
    }

}
