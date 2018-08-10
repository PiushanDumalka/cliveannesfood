<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Order extends CI_Controller {

    public $photoname;
    public $photourl;

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->library('cart');
        $this->load->model('general_model');
        $this->load->model('product_model');
        $this->load->model('customer_model');
        $this->load->model('order_model');
    }

    public function index() {
        $data["msg"] = NULL;
        $data["get_productcategory"] = $this->productcategory_model->get_productcategory();
        $this->load->view('website/index', $data);
    }

    public function search($id) {

        $products = $this->product_model->get_searched_products($id);
        //$data = array();
        // var_dump($products->rows);die;
        foreach ($products as $key => $product) {
            $data[] = array($product->Id, $product->ProductCode, $product->ProductName, $product->UnitPrice);
        } echo json_encode($data);
    }

    public function add_to_cart() {

        //  var_dump($this->input->post());die;
        $insert_data = array(
            'id' => $this->input->post('id'),
            'name' => $this->input->post('productname'),
            'price' => $this->input->post('price'),
            'qty' => $this->input->post('qty')
        );

        // This function add items into cart.
        $this->cart->insert($insert_data);
        // This will show insert data in cart.
        redirect(base_url() . "order/add_orders");
    }

    function update_cart() {
// Recieve post values,calcute them and update
        // Recieve post values,calcute them and update
        $cart_info = $_POST['cart'];

        foreach ($cart_info as $id => $cart) {
            $rowid = $cart['rowid'];
            $price = $cart['price'];
            $amount = $price * $cart['qty'];
            $qty = $cart['qty'];

            $data = array(
                'rowid' => $rowid,
                'price' => $price,
                'amount' => $amount,
                'qty' => $qty
            );
            $this->cart->update($data);
        }
        if ($this->cart->update($data)) {
            
        }
        redirect(base_url() . "order/add_orders");
    }

    function remove_cart($rowid) {
        // Check rowid value.
        if ($rowid === "all") {
            // Destroy data which store in session.
            $this->cart->destroy();
        } else {
            // Destroy selected rowid in session.
            $data = array(
                'rowid' => $rowid,
                'qty' => 0
            );
            // Update cart data, after cancel.
            $this->cart->update($data);
        }

        // This will show cancel data in cart.
        redirect(base_url() . "order/add_orders");
    }

    function place_order_view() {
        // Load "billing_view".
        $data["get_customers"] = $this->customer_model->get_reps_customers($this->session->userdata["userid"]);
        $data["orderd_customer"] = $this->input->post('customer');
       // var_dump($data["orderd_customer"]);die;
        $this->load->view('system/order_management/manage_orders/place_order_view', $data);
    }

    public function save_order() {
        if ($cart = $this->cart->contents()) {
            $order = array(
                'UserId' => $this->session->userdata["userid"],
                'CustomerId' => $this->input->post('customer'),
            );

            $order_id = $this->order_model->insert_order($order);

            foreach ($cart as $item) {
                $order_detail = array(
                    'CustomerOrderId' => $order_id,
                    'ProductId' => $item['id'],
                    'Qty' => $item['qty'],
                    'TotalPrice' => $item['subtotal']
                );

                // Insert product imformation with order detail, store in cart also store in database.
                $result = $this->order_model->insert_order_details($order_detail);
            }
            if ($result) {
                $this->cart->destroy();
                $this->session->set_flashdata('success', 'Order added successfully.');
            } else {
                $this->session->set_flashdata('error', 'order added fail.');
            }
        }
        redirect(base_url() . "order/add_orders");
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
    public function add_orders() {
        $data["msg"] = NULL;
        $data["get_customers"] = $this->customer_model->get_reps_customers($this->session->userdata["userid"]);
        $data["get_products"] = $this->product_model->get_products();
        $data["orderd_customer"] = NULL;


        // var_dump($data["get_products"]->result());die;
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

        $this->load->view('system/order_management/manage_orders/add_orders', $data);
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
                    "ProductCategory" => $this->input->Post("productcategory"),
                    "WeightId" => $this->input->Post("weight"),
                    "ExpPeriod" => $this->input->Post("expireduration"),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "Remark" => $this->input->Post("remark"),
                    "status" => $this->input->Post("availability")
                );
                // var_dump($data_product);                die;
                $result = $this->product_model->edit_productdetails($data_product, $id); //call module and insert data to product table
                if ($result) {
                    $this->session->set_flashdata('success', 'Product Update Successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Product Update Fail.');
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
                "ConsumerPrice" => $this->input->Post("consumerprice"),
            );
            $data_price_history = array(
                "ProductId" => $id,
                "DateTime" => date("Y-m-d"),
                "UnitPrice" => $this->input->Post("unitprice"),
                "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                "RetailerPrice" => $this->input->Post("retailerprice"),
                "ConsumerPrice" => $this->input->Post("consumerprice"),
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
