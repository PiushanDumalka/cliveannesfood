<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Product extends CI_Controller {

    public $photoname;
    public $photourl;

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model('productcategory_model');
        $this->load->model('productweight_model');
        $this->load->model('general_model');
        $this->load->model('product_model');
    }

    public function index() {
        $data["msg"] = NULL;
        $data["get_productcategory"] = $this->productcategory_model->get_productcategory();
        $this->load->view('website/index', $data);
    }

    /** View all products */
    public function view_products() {
        $data["get_products"] = $this->product_model->get_products();
        $this->load->view('system/product_management/manage_products/view_products', $data);
    }

    /** View a selected product */
    public function view_product($id) {
        $data["get_product"] = $this->product_model->get_product($id);
        $this->load->view('system/product_management/manage_products/view_product', $data);
    }

    /** add products */
    public function add_product() {
        $data["msg"] = NULL;
        $data["get_productcategory"] = $this->productcategory_model->get_productcategories();
        $data["get_weight"] = $this->productweight_model->get_productweights();
        $data["get_productid"] = $this->general_model->last_id('product', 'Id'); //get a new UserID

        if ($this->input->Post()) {
            if (!$this->general_model->check_availability('product', 'ProductCode', $data["get_productid"])) {

                /** Start Upload Profile Photo Section* */
                $config['upload_path'] = './uploads/products/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite'] = TRUE;
                $config['file_name'] = 'FD' . str_pad($data["get_productid"], 6, '0', STR_PAD_LEFT);
                /** Upload Library load* */
                $this->load->library('upload', $config);

                /** upload check* */
                if ($this->upload->do_upload('productphoto')) {
                    $data2 = array('upload_data' => $this->upload->data());
                    $this->photoname = $data2['upload_data']['file_name'];
                    $this->photourl = $data2['upload_data']['full_path'];
                } else {
                    echo $this->upload->display_errors();
                }

                $data_product = array(
                    "ProductName" => $this->input->Post("productname"),
                    "ProductCode" => 'FD' . str_pad($data["get_productid"], 6, '0', STR_PAD_LEFT),
                    "ProductCategory" => $this->input->Post("productcategory"),
                    "WeightId" => $this->input->Post("weight"),
                    "ExpPeriod" => $this->input->Post("expireduration"),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "UnitPrice" => $this->input->Post("unitprice"),
                    "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                    "RetailerPrice" => $this->input->Post("retailerprice"),
                    "status" => 1
                );
                //  var_dump($data_product);die;
                $result = $this->product_model->insert_productdetails($data_product); //call module and insert data to product table

                if ($result) {
                    $this->session->set_flashdata('success', 'Product added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Product added fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/product/view_products");
            return;
        }

        $this->load->view('system/product_management/manage_products/add_product', $data);
    }

    /** Edit product */
    public function edit_product($id) {
        $data["msg"] = NULL;
        $data["get_productcategory"] = $this->productcategory_model->get_productcategories();
        $data["get_weight"] = $this->productweight_model->get_productweights();
        $data["get_productid"] = $this->general_model->last_id('product', 'Id'); //get a new ProductID
        $data["get_product"] = $this->product_model->get_product($id);

        if ($this->input->Post()) {
            if (!$this->general_model->check_availability('product', 'ProductCode', $data["get_productid"])) {

                /** Start Upload Profile Photo Section* */
                $config['upload_path'] = './uploads/products/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite'] = TRUE;
                $config['file_name'] = 'FD' . str_pad($id, 6, '0', STR_PAD_LEFT);
                /** Upload Library load* */
                $this->load->library('upload', $config);

                /** upload check* */
                if ($this->upload->do_upload('productphoto')) {
                    $data2 = array('upload_data' => $this->upload->data());
                    $this->photoname = $data2['upload_data']['file_name'];
                    $this->photourl = $data2['upload_data']['full_path'];
                } else {
                    $this->photoname = $this->input->Post("productphotoold");
                }

                $data_product = array(
                    "ProductName" => $this->input->Post("productname"),
                    "ProductCategory" => $this->input->Post("productcategory"),
                    "WeightId" => $this->input->Post("weight"),
                    "ExpPeriod" => $this->input->Post("expireduration"),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "Remark" => $this->input->Post("remark"),
                    "status" => $this->input->Post("availability")
                );
                //var_dump($data_product);                die;
                $result = $this->product_model->edit_productdetails($data_product, $id); //call module and insert data to product table
                if ($result) {
                    $this->session->set_flashdata('success', 'Product Update Successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Product Not Updated.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/product/view_product/$id");
            return;
        }
        $this->load->view('system/product_management/manage_products/edit_product', $data);
    }

    /** View a selected product */
    public function add_prices($id) {
        $data["get_product"] = $this->product_model->get_product($id);
        $data["get_prices"] = $this->product_model->get_price_history($id);

        if ($this->input->Post()) {
            $data_price = array(
                "UnitPrice" => $this->input->Post("unitprice"),
                "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                "RetailerPrice" => $this->input->Post("retailerprice"),
              
            );
            $data_price_history = array(
                "ProductId" => $id,
                "DateTime" => date("Y-m-d"),
                "UnitPrice" => $this->input->Post("unitprice"),
                "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                "RetailerPrice" => $this->input->Post("retailerprice"),
              
            );
            //var_dump($data_price); die;
            if (!($this->general_model->check_availability_with_id('pricechangehistory', 'DateTime', date("Y-m-d"), 'ProductId', $id))) {
                $result = $this->product_model->edit_pricedetails($data_price, $id); //call module and insert price data to product table
                if ($result) {
                    $result = $this->product_model->add_pricedetails($data_price_history);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Price Update Successfully.');
                    } else {
                        $result = $this->product_model->delete_pricedetails($data_price, $id);
                        $this->session->set_flashdata('error', 'Price Update Fail.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Price Update Fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Price Update Fail.');
            }
            redirect(base_url() . "index.php/product/view_prices");
            return;
        }
        $this->load->view('system/product_management/manage_prices/add_prices', $data);
    }

    /** View all prices */
    public function view_prices() {
        $data["get_products"] = $this->product_model->get_products();
        $this->load->view('system/product_management/manage_prices/view_prices', $data);
    }

    /** Out products */
    public function outofstock_products() {
        $data["get_products"] = $this->product_model->get_outofstock_products();
        $this->load->view('system/product_management/manage_products/outofstock_products', $data);
    }

}
