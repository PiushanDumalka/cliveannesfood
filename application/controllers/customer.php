<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model('customer_model');
        $this->load->model('customertype_model');
        $this->load->model('province_model');
        $this->load->model('district_model');
        $this->load->model('city_model');
        $this->load->model('general_model');
    }

    public function index() {
        $data["msg"] = NULL;
        $data["get_customertype"] = $this->customertype_model->get_customertype();
        $data["get_province"] = $this->province_model->get_province();
        $data["get_district"] = $this->district_model->get_district();
        $data["get_city"] = $this->city_model->get_city();
        $this->load->view('website/index', $data);
    }

    /** View all customers */
    public function view_customers() {
        $data["get_customers"] = $this->customer_model->get_customers();
        $this->load->view('system/customer_management/manage_customers/view_customers', $data);
    }

    /** View a selected customer */
    public function view_customer($id) {
        $data["get_customer"] = $this->customer_model->get_customer($id);
        $this->load->view('system/customer_management/manage_customers/view_customer', $data);
    }

    /** add customers */
    public function add_customer() {
        $data["msg"] = NULL;
        $data["get_customertype"] = $this->customertype_model->get_customertype();
        $data["get_province"] = $this->province_model->get_province();
        $data["get_district"] = $this->district_model->get_district();
        $data["get_city"] = $this->city_model->get_city();
        $data["get_customerid"] = $this->general_model->last_id('customer', 'Id'); //get a new UserID

        if ($this->input->Post()) {
            if (!$this->general_model->check_availability('customer', 'CustomerId', $data["get_customerid"])) {
                $data_customer = array(
                    "CustomerTypeId" => $this->input->Post("customertype"),
                    "CustomerId" => 'CS' . str_pad($data["get_customerid"], 6, '0', STR_PAD_LEFT),
                    "RepId" => $this->session->userdata["userid"],
                    "FullName" => $this->input->Post("fullname"),
                    "Nic" => $this->input->Post("nic"),
                    "RegistrationNo" => $this->input->Post("regno"),
                    "OrganizationName" => $this->input->Post("regname"),
                    "Email" => $this->input->Post("email"),
                    "Address1" => $this->input->Post("address1"),
                    "Address2" => $this->input->Post("address2"),
                    "ProvinceId" => $this->input->Post("province"),
                    "DistrictId" => $this->input->Post("district"),
                    "CityId" => $this->input->Post("city"),
                    "ContactNo" => $this->input->Post("contact"),
                    "Status" => 1, //For Active Customer
                    "Password" => md5($this->input->Post("password")),
                );
                //var_dump($data_customer); die;
                $result = $this->customer_model->insert_customerdetails($data_customer); //call module and insert data to customer table

                if ($result) {
                    $this->session->set_flashdata('success', 'Customer added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'User added fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/customer/view_customers");
            return;
        }

        $this->load->view('system/customer_management/manage_customers/add_customer', $data);
    }

    /** get all district for selected province* */
    public function get_district($province_id) {
        $query = $this->district_model->get_selected_district($province_id);
        foreach ($query->result() as $district) {
            $data[] = array($district->id, $district->name_en); //load id and name to a array
        }
        echo json_encode($data);
    }

    /** get all Cities for selected province* */
    public function get_city($district_id) {
        $query = $this->city_model->get_selected_city($district_id);
        foreach ($query->result() as $city) {
            $data[] = array($city->id, $city->name_en); //load id and name to a array
        }
        echo json_encode($data);
    }

    /** Edit customer */
    public function edit_customer($id) {
        $data["msg"] = NULL;
        $data["get_customertype"] = $this->customertype_model->get_customertype();
        $data["get_province"] = $this->province_model->get_province();
        $data["get_district"] = $this->district_model->get_district();
        $data["get_city"] = $this->city_model->get_city();
        $data["get_customer"] = $this->customer_model->get_customer($id); //get customer

        if ($this->input->Post()) {
            $data_customer = array(
                "CustomerTypeId" => $this->input->Post("customertype"),
                "FullName" => $this->input->Post("fullname"),
                "Nic" => $this->input->Post("nic"),
                "RegistrationNo" => $this->input->Post("regno"),
                "OrganizationName" => $this->input->Post("regname"),
                "Email" => $this->input->Post("email"),
                "Address1" => $this->input->Post("address1"),
                "Address2" => $this->input->Post("address2"),
                "ProvinceId" => $this->input->Post("province"),
                "DistrictId" => $this->input->Post("district"),
                "CityId" => $this->input->Post("city"),
                "ContactNo" => $this->input->Post("contact"),
                "Status" => ($this->input->Post("status")) ? 0 : 1, //1 For deactivate customer
            );
            // var_dump($data_customer); die;
            $result = $this->customer_model->edit_customerdetails($data_customer, $id); //call module and insert data to customer table

            if ($result) {
                $this->session->set_flashdata('success', 'Customer Update successfully.');
            } else {
                $this->session->set_flashdata('error', 'Customer Update successfully.');
            }

            redirect(base_url() . "index.php/customer/view_customer/$id");
            return;
        }

        $this->load->view('system/customer_management/manage_customers/edit_customer', $data);
    }

    /** Edit user */
    public function change_password($username, $password) {
        $result = $this->customer_model->change_password($username, md5($password)); //call module and insert password change to user table
        if ($result) {
            echo json_encode($result);
        }
    }

    /** Deactivated users */
    public function deactivated_customers() {
        $data["get_customers"] = $this->customer_model->get_deactive_customers();
        $this->load->view('system/customer_management/manage_customers/deactivated_customers', $data);
    }

}
