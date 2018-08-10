<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Rawmaterial extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model('rawmaterial_model');

        $this->load->model('general_model');
    }

    public function index() {
        $data["get_rawmaterials"] = $this->rawmaterial_model->get_rawmaterials();
        $this->load->view('system/rawmaterial_management/manage_rawmaterials/view_rawmaterials', $data);
    }

    /** View all raw materials */
    public function view_rawmaterials() {
        $data["get_rawmaterials"] = $this->rawmaterial_model->get_rawmaterials();
        $data["get_packmaterials"] = $this->rawmaterial_model->get_packingmaterials();
        $this->load->view('system/rawmaterial_management/manage_rawmaterials/view_rawmaterials', $data);
    }

    /** View a selected raw material */
    public function view_rawmaterial($id) {
        $data["get_rawmaterial"] = $this->rawmaterial_model->get_rawmaterial($id);
        $data["get_rawmaterial_supplier"] = $this->rawmaterial_model->get_rawmaterial($id);
       // var_dump($data["get_rawmaterial_supplier"]->result());die;
        $this->load->view('system/rawmaterial_management/manage_rawmaterials/view_rawmaterial', $data);
    }

    /** add raw materials */
    public function add_rawmaterial() {
        $data["msg"] = NULL;
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'rawmaterialname',
                'label' => 'Raw Material Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'rawmaterialcategory',
                'label' => 'Raw Material Category',
                'rules' => 'required',
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
        if ($this->form_validation->run() == TRUE) {

            if (!$this->general_model->check_availability('rawmaterial', 'RawmaterialName', $this->input->Post("rawmaterialname"))) {
                $data_rawmaterial = array(
                    "RawmaterialName" => $this->input->Post("rawmaterialname"),
                    "RawMaterialCategoryId" => $this->input->Post("rawmaterialcategory"),
                    "Status" => 1, //For Active Customer
                );
                //var_dump($data_rawmaterial); die;
                $result = $this->rawmaterial_model->insert_rawmaterialdetails($data_rawmaterial); //call module and insert data to rawmaterial table

                if ($result) {
                    $this->session->set_flashdata('success', 'Raw Material added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Raw Material added fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Raw Material Exist.!! ');
            }
            redirect(base_url() . "index.php/rawmaterial/view_rawmaterials");
            return;
        }

        $this->load->view('system/rawmaterial_management/manage_rawmaterials/add_rawmaterial', $data);
    }

    /** Edit raw material */
    public function edit_rawmaterial($id) {
        $data["msg"] = NULL;
        $data["get_rawmaterial"] = $this->rawmaterial_model->get_rawmaterial($id);
        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'rawmaterialname',
                'label' => 'Raw Material Name',
                'rules' => 'required'
            ),
            array(
                'field' => 'rawmaterialcategory',
                'label' => 'Raw Material Category',
                'rules' => 'required',
            )
        );
        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $data_rawmaterial = array(
                "RawmaterialName" => $this->input->Post("rawmaterialname"),
                "RawMaterialCategoryId" => $this->input->Post("rawmaterialcategory"),
                "Status" => 1, //For Active Customer
            );
            //var_dump($data_rawmaterial); die;
            $result = $this->rawmaterial_model->edit_rawmaterialdetails($data_rawmaterial, $id); //call module and insert data to rawmaterial table

            if ($result) {
                $this->session->set_flashdata('success', 'Raw Material added successfully.');
            } else {
                $this->session->set_flashdata('error', 'Raw Material added fail.');
            }
            redirect(base_url() . "index.php/rawmaterial/view_rawmaterials");
            return;
        }

        $this->load->view('system/rawmaterial_management/manage_rawmaterials/edit_rawmaterial', $data);
    }

    /** Deactivated users */
    public function deactivated_rawmaterials() {
        $data["get_rawmaterials"] = $this->rawmaterial_model->get_deactive_rawmaterials();
        $this->load->view('system/rawmaterial_management/manage_rawmaterials/deactivated_rawmaterials', $data);
    }

}
