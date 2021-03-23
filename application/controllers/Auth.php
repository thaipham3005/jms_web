<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('model_auth');
        $this->load->model('model_groups');
        $this->load->model('model_users');
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
                $avail = $this->model_auth->login($this->input->post('login_id'), $this->input->post('password'));
                
                if ($avail) {
                    $login = $this->model_users->getUserByID($avail["id"]);
                    if ($avail['id'] == 1){                        
                        $logged_in_sess = array(
                            'id' => $login['id'],
                            'login_id'  => $login['login_id'],
                            'full_name'  => $login['full_name'],                        
                            'email'     => $login['email'],
                            'department'=>$login['department'],
                            'team'=>$login['team'],
                            'company_id'=>$login['company_id'],
                            'group'=> $login['_group'],
                            'position'=> $login['position'],
                            'avatar' => $login['avatar'],
                            'thumbnail' => $login['thumbnail'],
                            'images' => $login['images'],
                            'logged_in' => TRUE                            
                        ); 
                            
                    }
                    else {
                        $logged_in_sess = array(
                            'id' => $login['id'],
                            'login_id'  => $login['login_id'],
                            'full_name'  => $login['full_name'],                        
                            'email'     => $login['email'],
                            'department_id'=>$login['department_id'],
                            'department'=>$login['department'],
                            'team_id'=>$login['team_id'],
                            'team'=>$login['team'],
                            'company_id'=>$login['company_id'],
                            'company'=>$login['company'],
                            'group'=> $login['_group'],
                            'position'=> $login['position'],
                            'avatar' => $login['avatar'],
                            'thumbnail' => $login['thumbnail'],
                            'images' => $login['images'],
                            'logged_in' => TRUE                            
                        ); 
                        
                    }                        
                    // echo json_encode($login) ;                         
                    
                    $this->session->set_userdata($logged_in_sess);  
                    $this->session->set_flashdata('success', 'Welcome '.$login['full_name']);                  
                    redirect('dashboard', 'refresh');
                    // echo json_encode( $logged_in_sess );
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
