<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Index extends CI_Controller {

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

    public function insert_customerdetails() {
        $data["get_customerid"] = $this->general_model->last_id('customer', 'Id'); //get a new CustomerID
        /** Insert Customer Details * */
        if ($this->input->Post()) {
            if (!$this->general_model->check_availability('customer', 'CustomerId', $this->input->Post("nic"))) {
                $data_customer = array(
                    "CustomerTypeId" => $this->input->Post("customertype"),
                    "CustomerId" => 'CS' . str_pad($data["get_customerid"], 6, '0', STR_PAD_LEFT),
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
                );
                //var_dump($data_customer); die;
                $result = $this->customer_model->insert_customerdetails($data_customer); //call module and insert data to customer table

                if ($result) {
                    $this->session->set_flashdata('success', 'Successfully Submitted.We will inform you soon !!');
                } else {
                    $this->session->set_flashdata('error', 'Submitted Fail !!');
                }
            } else {
                $this->session->set_flashdata('error', 'Registration Fail!! '.$this->input->Post("nic").' is already registerd. Please Try Again !!');
            }
            redirect(base_url() . "index#joinus");
        }
    }

}
