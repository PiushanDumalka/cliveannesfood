<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!isset($_SESSION)) {
            session_start();
        }
        $this->load->model("user_model");
    }

    public function index() {
          $data['msg'] = '';
        if ($this->input->post()) {
            $username = $this->input->post("username");
            $password = md5($this->input->post("password"));

            /** check username and password */
            if ((Trim($username) != '') && (Trim($password) != '')) {
                $result = $this->user_model->login_control($username, $password);
                if ($result->num_rows() > 0) {
                    foreach ($result->result() as $data) {
                        $user_id[] = $data->Session_Id;
                        $user_fullname[] = $data->FullName;
                        $user_roles[] = $data->RoleName;
                    }

                    /** Set Session data */
                    $user_data = array('username' => $username, 'roles' => $user_roles, 'userid' => $user_id[0],'fullname' => $user_fullname[0]);
                    $this->session->set_userdata($user_data);
                    redirect('dashboard');
                    return FALSE;
                } else {
                    $data['msg'] = array('type' => 'error', 'msg' => "Username or Password Invalid !!");
                }
            } else {
                $data['msg'] = array('type' => 'error', 'msg' => "Username or Password cannot be empty!!");
            }
        }
        $this->load->view('system/login/login_form', $data);
    }

    /** Login to admin panel */
    public function login_control() {
        $data['msg'] = '';
        if ($this->input->post()) {
            $username = $this->input->post("username");
            $password = md5($this->input->post("password"));

            /** check username and password */
            if ((Trim($username) != '') && (Trim($password) != '')) {
                $result = $this->user_model->login_control($username, $password);
                if ($result->num_rows() > 0) {
                    foreach ($result->result() as $data) {
                        $user_id[] = $data->Session_Id;
                        $user_fullname[] = $data->FullName;
                        $user_roles[] = $data->RoleName;
                    }

                    /** Set Session data */
                    $user_data = array('username' => $username, 'roles' => $user_roles, 'userid' => $user_id[0],'fullname' => $user_fullname[0]);
                    $this->session->set_userdata($user_data);
                    redirect('dashboard');
                    return FALSE;
                } else {
                    $data['msg'] = array('type' => 'error', 'msg' => "Username or Password Invalid !!");
                }
            } else {
                $data['msg'] = array('type' => 'error', 'msg' => "Username or Password cannot be empty!!");
            }
        }
        $this->load->view('system/login/login_form', $data);
    }

    /** Logout from admin panel */
    public function logouthandle() {
        /** Removing session data */
        $user_data = array('username' => '', 'roles' => '', 'userid' => '','fullname' => '');
        $this->session->unset_userdata($user_data);
        $this->session->sess_destroy();
        redirect('login/login_control');
    }

}
