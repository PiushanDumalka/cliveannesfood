<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model('supplier_model');
        $this->load->model('rawmaterial_model');
        $this->load->model('general_model');
    }

    public function index() {
        $data["get_suppliers"] = $this->supplier_model->get_suppliers();
        $this->load->view('system/rawmaterial_management/manage_suppliers/view_suppliers', $data);
    }

    /** View all suppliers */
    public function view_suppliers() {
        $data["get_suppliers"] = $this->supplier_model->get_suppliers();
        $this->load->view('system/rawmaterial_management/manage_suppliers/view_suppliers', $data);
    }

    /** View a selected supplier */
    public function view_supplier($id) {
        $data["get_supplier"] = $this->supplier_model->get_supplier($id);
        $data["get_supplier_rawmaterial"] = $this->supplier_model->get_supplier_rawmaterial($id); //get suppliers Rawmaterial
        $data["get_supplier_packingmaterial"] = $this->supplier_model->get_supplier_packingmaterial($id); //get supplier Packingmatrial
        // var_dump($data["get_supplier"]->result());die;
        $this->load->view('system/rawmaterial_management/manage_suppliers/view_supplier', $data);
    }

    /** add suppliers */
    public function add_supplier() {
        $data["msg"] = NULL;
        $data["get_supplierid"] = $this->general_model->last_id('supplier', 'Id'); //get a new UserID
        $data["get_rawmaterials"] = $this->rawmaterial_model->get_rawmaterials(); //get rawmaterails
        $data["get_packingmaterials"] = $this->rawmaterial_model->get_packingmaterials(); //get rawmaterails

        $this->load->library('form_validation');
        $config = array(
            array(
                'field' => 'suppliername',
                'label' => 'Suppliername',
                'rules' => 'required'
            ),
            array(
                'field' => 'address',
                'label' => 'Address',
                'rules' => 'required',
            ),
            array(
                'field' => 'phoneno',
                'label' => 'Phoneno',
                'rules' => 'required'
            ),
            array(
                'field' => 'contact',
                'label' => 'Contact',
                'rules' => 'required'
            )
        );

        $this->form_validation->set_rules($config);
        $this->form_validation->set_error_delimiters('<div style="color:red;">', '</div>');
        if ($this->form_validation->run() == TRUE) {


            if (!$this->general_model->check_availability('supplier', 'SupplierCode', $data["get_supplierid"])) {
                $data_supplier = array(
                    "SupplierCode" => 'SP' . str_pad($data["get_supplierid"], 6, '0', STR_PAD_LEFT),
                    "SupplierName" => $this->input->Post("suppliername"),
                    "Email" => $this->input->Post("email"),
                    "Address" => $this->input->Post("address"),
                    "PhoneNo" => $this->input->Post("phoneno"),
                    "ContactNo" => $this->input->Post("contact"),
                    "Description" => $this->input->Post("description"),
                    "Status" => 1, //For Active Supplier
                );

                $supplier_result = $this->supplier_model->insert_supplierdetails($data_supplier); //call module and insert data to supplier table

                if ($supplier_result) {

                    $rawmaterial_data = array();
                    $packingmaterial_data = array();

                    if ($this->input->Post("raw")) {
                        foreach ($this->input->Post("raw") as $key => $value) {
                            $rawmaterial_data[$key]['SupplierId'] = $supplier_result;
                            $rawmaterial_data[$key]['RawmaterialId'] = $value;
                        }
                        $result = $this->supplier_model->insert_supplierrawmaterialsdetails($rawmaterial_data); //call module and insert data to supplier table
                    }
                    if ($this->input->Post("pack")) {
                        foreach ($this->input->Post("pack") as $key => $value) {
                            $packingmaterial_data[$key]['SupplierId'] = $supplier_result;
                            $packingmaterial_data[$key]['RawmaterialId'] = $value;
                        }
                        $result = $this->supplier_model->insert_supplierrawmaterialsdetails($packingmaterial_data);
                    }

                    if ($result) {

                        $this->session->set_flashdata('success', 'Supplier added successfully.');
                    } else {
                        $this->session->set_flashdata('error', 'Supplier added fail.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Supplier added fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/supplier/view_suppliers");
            return;
        }

        $this->load->view('system/rawmaterial_management/manage_suppliers/add_supplier', $data);
    }

    /** Edit supplier */
    public function edit_supplier($id) {

        $data["msg"] = NULL;
        $data["get_supplier"] = $this->supplier_model->get_supplier($id); //get supplier
        $data["get_rawmaterials"] = $this->rawmaterial_model->get_rawmaterials(); //get rawmaterails
        $data["get_supplier_rawmaterial"] = $this->supplier_model->get_supplier_rawmaterial($id); //get suppliers Rawmaterial
        $data["get_supplier_packingmaterial"] = $this->supplier_model->get_supplier_packingmaterial($id); //get supplier Packingmatrial
        $data["get_rawmaterials"] = $this->supplier_model->get_supplier_notassignedrawmaterials($id); //get rawmaterails not assigned
        $data["get_packingmaterials"] = $this->supplier_model->get_supplier_notassignedpackingmaterials($id); //get rawmaterails notassigned
        //var_dump($data["get_supplier"]->result());die;
        if ($this->input->Post()) {
            $data_supplier = array(
                "SupplierCode" => 'SP' . str_pad($id, 6, '0', STR_PAD_LEFT),
                "SupplierName" => $this->input->Post("suppliername"),
                "Email" => $this->input->Post("email"),
                "Address" => $this->input->Post("address"),
                "PhoneNo" => $this->input->Post("phoneno"),
                "ContactNo" => $this->input->Post("contact"),
                "Description" => $this->input->Post("description"),
                "Status" => $this->input->Post("status"), //For Active Supplier
            );
            // var_dump($data_supplier); die;
            $result = $this->supplier_model->edit_supplierdetails($data_supplier, $id); //call module and insert data to supplier table
            $rawmaterial_data = array();
            $packingmaterial_data = array();

            if ($this->input->Post("raw")) {
                foreach ($this->input->Post("raw") as $key => $value) {
                    $rawmaterial_data[$key]['SupplierId'] = $id;
                    $rawmaterial_data[$key]['RawmaterialId'] = $value;
                }
                $result = $this->supplier_model->insert_supplierrawmaterialsdetails($rawmaterial_data); //call module and insert data to supplier table
            }
            if ($this->input->Post("pack")) {
                foreach ($this->input->Post("pack") as $key => $value) {
                    $packingmaterial_data[$key]['SupplierId'] = $id;
                    $packingmaterial_data[$key]['RawmaterialId'] = $value;
                }
                $result = $this->supplier_model->insert_supplierrawmaterialsdetails($packingmaterial_data);
            }

            if ($result) {
                $this->session->set_flashdata('success', 'Supplier Update successfully.');
            } else {
                $this->session->set_flashdata('error', 'Supplier NotUpdated');
            }

            redirect(base_url() . "index.php/supplier/view_supplier/$id");
            return;
        }

        $this->load->view('system/rawmaterial_management/manage_suppliers/edit_supplier', $data);
    }

    /** Edit user */
    public function change_password($username, $password) {
        $result = $this->supplier_model->change_password($username, md5($password)); //call module and insert password change to user table
        if ($result) {
            echo json_encode($result);
        }
    }

    /** Deactivated users */
    public function deactivated_suppliers() {
        $data["get_suppliers"] = $this->supplier_model->get_deactive_suppliers();
        $this->load->view('system/rawmaterial_management/manage_suppliers/deactivated_suppliers', $data);
    }

    public function delete_supplierrawmaterial($SupplierId, $RawmaterialId) {

        $data["msg"] = NULL;

        $result = $this->supplier_model->delete_supplierrawmaterial($SupplierId, $RawmaterialId); //call module and insert data to user table
        if ($result) {
            $this->session->set_flashdata('success', 'Material Deleted successfully.');
        } else {
            $this->session->set_flashdata('error', 'Material Deleted fail.');
        }
        redirect(base_url() . "index.php/supplier/edit_supplier/" . $SupplierId);
        return;
    }

}
