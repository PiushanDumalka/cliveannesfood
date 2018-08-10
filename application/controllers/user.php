<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

    public $photoname;
    public $photourl;

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model("user_model");
        $this->load->model("designation_model");
        $this->load->model("usertype_model");
        $this->load->model("general_model");

        // $this->load->library('form_validation');
    }

    public function index() {
        // $this->load->helper(array('form', 'url'));
    }

    /** View all users */
    public function view_users() {
        $data["get_users"] = $this->user_model->get_users();
        $this->load->view('system/user_management/manage_users/view_users', $data);
    }

    /** View a selected user */
    public function view_user($id) {
        $data["get_user"] = $this->user_model->get_user($id);
        $this->load->view('system/user_management/manage_users/view_user', $data);
    }

    /** check availability of users */
    public function check_availablity($value, $column) {
        $value = urldecode($value);
        $result = $this->general_model->check_availability('user', $column, $value);
        if ($result) {
            echo json_encode($result);
        }
    }

    /** add users */
    public function add_user() {
        $data["msg"] = NULL;
        $data["get_designations"] = $this->designation_model->get_designations(); //get designations
        $data["get_usertypes"] = $this->usertype_model->get_usertypes(); //get usertypes
        $data["get_userid"] = $this->general_model->last_id('user', 'Id'); //get a new UserID

        if ($this->input->Post()) {
            if (!($this->general_model->check_availability('user', 'Username', $this->input->Post("username")))) {
                /** Start Upload Profile Photo Section* */
                $config['upload_path'] = './uploads/users/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['max_size'] = '1024';
                $config['overwrite'] = TRUE;
                $config['file_name'] = 'EP' . str_pad($data["get_userid"], 6, '0', STR_PAD_LEFT);

                /** Upload Library load* */
                $this->load->library('upload', $config);

                /** upload check* */
                if ($this->upload->do_upload('userphoto')) {
                    $dataupload = array('upload_data' => $this->upload->data());
                    $this->photoname = $dataupload['upload_data']['file_name'];
                    $this->photourl = $dataupload['upload_data']['full_path'];
                } else {
                    echo $this->upload->display_errors();
                }

                /** Insert user Details * */
                $user_data = array(
                    "DesignationId" => $this->input->Post("designation"),
                    "UserId" => 'EP' . str_pad($data["get_userid"], 6, '0', STR_PAD_LEFT),
                    "TypeId" => $this->input->Post("usertype"),
                    "FullName" => $this->input->Post("fullname"),
                    "Nic" => $this->input->Post("nic"),
                    "Gender" => $this->input->Post("gender"),
                    "EpfNo" => $this->input->Post("epfno"),
                    "OrganizationName" => $this->input->Post("organizationname"),
                    "Address" => $this->input->Post("address"),
                    "Contact" => $this->input->Post("mobile"),
                    "Email" => $this->input->Post("email"),
                    "Username" => 'EP' . str_pad($data["get_userid"], 6, '0', STR_PAD_LEFT),
                    "Password" => md5($this->input->Post("password")),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "Status" => 1, //For Active Customer
                );
                $result = $this->user_model->add_userdetails($user_data); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'User added successfully.');
                } else {
                    $this->session->set_flashdata('error', 'User added fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/user/view_users");
            return;
        }

        $this->load->view('system/user_management/manage_users/add_user', $data);
    }

    /** Edit user */
    public function edit_user($id) {
        $data["msg"] = NULL;
        $data["get_designations"] = $this->designation_model->get_designations(); //get designations
        $data["get_usertypes"] = $this->usertype_model->get_usertypes(); //get usertypes
        $data["get_user"] = $this->user_model->get_user($id); //get user

        if ($this->input->Post()) {
            if (($this->general_model->check_availability('user', 'UserId', $this->input->Post("username")))) {
                /** Start Upload Profile Photo Section* */
                $config['upload_path'] = './uploads/users/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['overwrite'] = TRUE;
                $config['file_name'] = $this->input->Post("username");

                /** Upload Library load* */
                $this->load->library('upload', $config);

                /** upload check* */
                if ($this->upload->do_upload('userphoto')) {
                    $dataupload = array('upload_data' => $this->upload->data());
                    $this->photoname = $dataupload['upload_data']['file_name'];
                    $this->photourl = $dataupload['upload_data']['full_path'];
                } else {
                    //   echo $this->upload->display_errors();
                    $this->photoname = $this->input->Post("userphotoold");
                }

                /** Edit user Details * */
                $user_data = array(
                    "DesignationId" => $this->input->Post("designation"),
                    "TypeId" => $this->input->Post("usertype"),
                    "FullName" => $this->input->Post("fullname"),
                    "Nic" => $this->input->Post("nic"),
                    "Gender" => $this->input->Post("gender"),
                    "EpfNo" => $this->input->Post("epfno"),
                    "OrganizationName" => $this->input->Post("organizationname"),
                    "Address" => $this->input->Post("address"),
                    "Contact" => $this->input->Post("mobile"),
                    "Email" => $this->input->Post("email"),
                    "PhotoName" => $this->photoname,
                    "PhotoUrl" => $this->photourl,
                    "Status" => ($this->input->Post("status")) ? 0 : 1, //1 For deactivate user
                );
             //   var_dump($user_data);die;
                $result = $this->user_model->edit_userdetails($user_data, $id); //call module and insert data to user table
                if ($result) {
                    $this->session->set_flashdata('success', 'User Updated successfully.');
                } else {
                    $this->session->set_flashdata('error', 'User Update fail.');
                }
            } else {
                $this->session->set_flashdata('error', 'Fail Please Try Agian !! ');
            }
            redirect(base_url() . "index.php/user/view_user/$id");
            return;
        }

        $this->load->view('system/user_management/manage_users/edit_user', $data);
    }

    /** Edit user */
    public function change_password($username, $password) {
        $result = $this->user_model->change_password($username, md5($password)); //call module and insert password change to user table
        if ($result) {
            echo json_encode($result);
        }
    }

    /** Deactivated users */
    public function deactivated_users() {
        $data["get_users"] = $this->user_model->get_deactive_users();
        $this->load->view('system/user_management/manage_users/deactivated_users', $data);
    }

}
