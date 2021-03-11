<?php 
    class MY_Controller extends CI_Controller
    {
        public function __construct()
        {
            parent::__construct();
        }
    }

    class Admin_Controller extends MY_Controller
    {
        var $permission = array();

        public function __construct()
        {
            parent::__construct();
            date_default_timezone_set('Asia/Bangkok');
            $group_data = array();
            if (empty($this->session->userdata('logged_in'))){
                $session_data = array('logged_in'=> FALSE);
                $this->session->set_userdata($session_data);
            } else {
                $user_id = $this->session->userdata('id');
                $this->load->model('model_groups');
                $group_data = $this->model_groups->getUserGroupByUserId($user_id);

                $this->data['user_permission'] = unserialize($group_data['permission']);
                $this->permission = unserialize($group_data['permission']);

                
            }
        }

        public function logged_in()
        {
            $session_data = $this->session->userdata();
            if ($session_data['logged_in'] == TRUE){                
                redirect('dashboard', 'refresh');                
            }
        }

        public function not_logged_in()
        {
            $session_data = $this->session->userdata();
            if ($session_data['logged_in'] == FALSE) {
                redirect('auth/login', 'refresh');
            }
        }

        public function render_template($page=null, $data = array())
        {
            $this->load->view('templates/header',$data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view($page,$data);
            $this->load->view('templates/footer', $data);
        }        
    }

    class User_Controller extends MY_Controller
    {
        var $permission = array();

        public function __construct()
        {
            parent::__construct();
            date_default_timezone_set('Asia/Bangkok');
            $group_data = array();
            if (empty($this->session->userdata('logged_in'))){
                $session_data = array('logged_in'=> FALSE);
                $this->session->set_userdata($session_data);
            } else {
                $user_id = $this->session->userdata('id');
                $this->load->model('model_groups');
                $group_data = $this->model_groups->getUserGroupByUserId($user_id);

                $this->data['user_permission'] = unserialize($group_data['permission']);
                $this->permission = unserialize($group_data['permission']);

                
            }
        }

        public function logged_in()
        {
            $session_data = $this->session->userdata();
            if ($session_data['logged_in'] == TRUE){                
                redirect('dashboard', 'refresh');
                
            }
        }

        public function not_logged_in()
        {
            $session_data = $this->session->userdata();
            if ($session_data['logged_in'] == FALSE) {
                redirect('auth/login', 'refresh');
            }
        }

        public function render_template($page=null, $data = array())
        {
            $this->load->view('templates/header',$data);
            $this->load->view('templates/navbar', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view($page,$data);
            $this->load->view('templates/footer', $data);

        }

        
    }

?>
