<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_auth');
        $this->load->model('model_groups');
    }

    /* 
		Check if the login form is submitted, and validates the user credential
		If not submitted it redirects to the login page
	*/
    public function login()
    {
        $this->logged_in();

        $this->form_validation->set_rules('login_id', 'Login ID', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $id_exists = $this->model_auth->check_login_id($this->input->post('login_id'));

            if ($id_exists == TRUE) {
                $login = $this->model_auth->login($this->input->post('login_id'), $this->input->post('password'));

                if ($login) {
                    $group = $this->model_groups->getUserGroupByUserId($login['id']);  
                    $logged_in_sess = array(
                        'id' => $login['id'],
                        'login_id'  => $login['login_id'],
                        'fullname'  => $login['fullname'],                        
                        'email'     => $login['email'],
                        // 'department'=>$login['department'],
                        // 'team'=>$login['team'],
                        // 'squad'=>$login['squad'],
                        'group_id'=> $group['group_id'],
                        'position'=>$login['position'],
                        'avatar' => $login['avatar'],
                        'images' => $login['images'],
                        'logged_in' => TRUE,
                        
                    );                                      

                    $this->session->set_userdata($logged_in_sess);
                    
                    //echo "Logged in";
                    redirect('dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('error', 'Incorrect username/password');
                    $this->data['errors'] = 'Incorrect username/password';
                    $this->load->view('auth/login', $this->data);
                }
            } else {
                $this->session->set_flashdata('error', 'Login ID does not exists');
                $this->data['errors'] = 'Login ID does not exists';
                $this->load->view('auth/login', $this->data);
            }
        } else {
            // false case
            $this->load->view('auth/login');
        }
    }

    /*
		clears the session and redirects to login page
	*/
    public function logout()
    {        
        $this->data['page_title'] = 'Log out';
        $this->render_template('logout', $this->data);	
    }

    public function logged_out(){
        $this->session->sess_destroy(); 
        redirect('auth/login', 'refresh');
    }

    public function saveDataToSession($key){        
        
        $this->session->set_userdata($key, $this->input->post($key));        
        // echo json_encode($this->input->post($key)) ;
    }

    public function loadDataFromSession($key){        
        $data = $this->session->userdata($key);
        echo json_encode($data); 
    }

    public function clearFormFromSession($key){
        $this->session->set_userdata($key, null);                
    }

}
