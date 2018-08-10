<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Recipe extends CI_Controller {

    public $photoname;
    public $photourl;

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model('recipecategory_model');
        $this->load->model('recipeweight_model');
        $this->load->model('general_model');
        $this->load->model('recipe_model');
    }

    public function index() {
        $data["msg"] = NULL;
        $data["get_recipecategory"] = $this->recipecategory_model->get_recipecategory();
        $this->load->view('website/index', $data);
    }

    /** View all recipes */
    public function view_recipies() {
        $data["get_recipes"] = $this->recipe_model->get_recipes();
        $this->load->view('system/recipe_management/manage_recipes/view_recipes', $data);
    }

    /** View a selected recipe */
    public function view_recipe($id) {
        $data["get_recipe"] = $this->recipe_model->get_recipe($id);
        $this->load->view('system/recipe_management/manage_recipes/view_recipe', $data);
    }

    /** add recipes */
    public function add_recipe() {
        $data["msg"] = NULL;
        $data["get_recipecategory"] = $this->recipecategory_model->get_recipecategories();
        $data["get_weight"] = $this->recipeweight_model->get_recipeweights();
        $data["get_recipeid"] = $this->general_model->last_id('recipe', 'Id'); //get a new UserID

        if ($this->input->Post()) {
            if (!$this->general_model->check_availability('recipe', 'RecipeCode', $data["get_recipeid"])) {

                /** Start Upload Profile Photo Section* */
                $config['upload_path'] = './uploads/recipes/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite'] = TRUE;
                $config['file_name'] = 'FD' . str_pad($data["get_recipeid"], 6, '0', STR_PAD_LEFT);
                /** Upload Library load* */
                $this->load->library('upload', $config);

                /** upload check* */
                if ($this->upload->do_upload('recipephoto')) {
                    $data2 = array('upload_data' => $this->upload->data());
                    $this->photoname = $data2['upload_data']['file_name'];
                    $this->photourl = $data2['upload_data']['full_path'];
                } else {
                    echo $this->upload->display_errors();
                }

                $data_recipe = array(
                    "RecipeName" => $this->input->Post("recipename"),
                    "RecipeCode" => 'FD' . str_pad($data["get_recipeid"], 6, '0', STR_PAD_LEFT),
                    "RecipeCategory" => $this->input->Post("recipecategory"),
                    "WeightId" => $this->input->Post("weight"),
                    "ExpPeriod" => $this->input->Post("expireduration"),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "UnitPrice" => $this->input->Post("unitprice"),
                    "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                    "RetailerPrice" => $this->input->Post("retailerprice"),
                    "status" => 1
                );
                //  var_dump($data_recipe);die;
                $result = $this->recipe_model->insert_recipedetails($data_recipe); //call module and insert data to recipe table

                if ($result) {
                    $this->session->set_flashdata('success', 'Recipe added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Recipe added fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/recipe/view_recipes");
            return;
        }

        $this->load->view('system/recipe_management/manage_recipes/add_recipe', $data);
    }

    /** Edit recipe */
    public function edit_recipe($id) {
        $data["msg"] = NULL;
        $data["get_recipecategory"] = $this->recipecategory_model->get_recipecategories();
        $data["get_weight"] = $this->recipeweight_model->get_recipeweights();
        $data["get_recipeid"] = $this->general_model->last_id('recipe', 'Id'); //get a new RecipeID
        $data["get_recipe"] = $this->recipe_model->get_recipe($id);

        if ($this->input->Post()) {
            if (!$this->general_model->check_availability('recipe', 'RecipeCode', $data["get_recipeid"])) {

                /** Start Upload Profile Photo Section* */
                $config['upload_path'] = './uploads/recipes/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite'] = TRUE;
                $config['file_name'] = 'FD' . str_pad($id, 6, '0', STR_PAD_LEFT);
                /** Upload Library load* */
                $this->load->library('upload', $config);

                /** upload check* */
                if ($this->upload->do_upload('recipephoto')) {
                    $data2 = array('upload_data' => $this->upload->data());
                    $this->photoname = $data2['upload_data']['file_name'];
                    $this->photourl = $data2['upload_data']['full_path'];
                } else {
                    $this->photoname = $this->input->Post("recipephotoold");
                }

                $data_recipe = array(
                    "RecipeName" => $this->input->Post("recipename"),
                    "RecipeCategory" => $this->input->Post("recipecategory"),
                    "WeightId" => $this->input->Post("weight"),
                    "ExpPeriod" => $this->input->Post("expireduration"),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "Remark" => $this->input->Post("remark"),
                    "status" => $this->input->Post("availability")
                );
                //var_dump($data_recipe);                die;
                $result = $this->recipe_model->edit_recipedetails($data_recipe, $id); //call module and insert data to recipe table
                if ($result) {
                    $this->session->set_flashdata('success', 'Recipe Update Successfully.');
                } else {
                    $this->session->set_flashdata('error', 'Recipe Not Updated.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/recipe/view_recipe/$id");
            return;
        }
        $this->load->view('system/recipe_management/manage_recipes/edit_recipe', $data);
    }

    /** View a selected recipe */
    public function add_prices($id) {
        $data["get_recipe"] = $this->recipe_model->get_recipe($id);
        $data["get_prices"] = $this->recipe_model->get_price_history($id);

        if ($this->input->Post()) {
            $data_price = array(
                "UnitPrice" => $this->input->Post("unitprice"),
                "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                "RetailerPrice" => $this->input->Post("retailerprice"),
              
            );
            $data_price_history = array(
                "RecipeId" => $id,
                "DateTime" => date("Y-m-d"),
                "UnitPrice" => $this->input->Post("unitprice"),
                "WholesalerPrice" => $this->input->Post("wholesalerprice"),
                "RetailerPrice" => $this->input->Post("retailerprice"),
              
            );
            //var_dump($data_price); die;
            if (!($this->general_model->check_availability_with_id('pricechangehistory', 'DateTime', date("Y-m-d"), 'RecipeId', $id))) {
                $result = $this->recipe_model->edit_pricedetails($data_price, $id); //call module and insert price data to recipe table
                if ($result) {
                    $result = $this->recipe_model->add_pricedetails($data_price_history);
                    if ($result) {
                        $this->session->set_flashdata('success', 'Price Update Successfully.');
                    } else {
                        $result = $this->recipe_model->delete_pricedetails($data_price, $id);
                        $this->session->set_flashdata('error', 'Price Update Fail.');
                    }
                } else {
                    $this->session->set_flashdata('error', 'Price Update Fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Price Update Fail.');
            }
            redirect(base_url() . "index.php/recipe/view_prices");
            return;
        }
        $this->load->view('system/recipe_management/manage_prices/add_prices', $data);
    }

    /** Out recipes */
    public function outofstock_recipes() {
        $data["get_recipes"] = $this->recipe_model->get_outofstock_recipes();
        $this->load->view('system/recipe_management/manage_recipes/outofstock_recipes', $data);
    }

}
