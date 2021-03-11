<?php 

class Users extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Users Configuration';		

		$this->load->model('model_users');
		$this->load->model('model_groups');
		
	}

	public function index()
	{
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }
		$this->session->set_userdata('currentPage', 'users/index');
		$this->render_template('users/index', $this->data);
	}

	public function create()
	{
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('login_id', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[users.login_id]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');
		$this->form_validation->set_rules('phone', 'Phone No', 'required|regex_match[/^[0-9]{10}$/]');
		
		// $this->form_validation->set_rules('birthday', 'Birthday', 'trim|required|valid_date');
		

        if ($this->form_validation->run() == TRUE) {
            // true case
            $password = $this->password_hash($this->input->post('password'));
        	$data = array(
        		'login_id' => $this->input->post('login_id'),
        		'password' => $password,
        		'email' => $this->input->post('email'),
        		'fullname' => $this->input->post('fullname'),
        		'phone' => $this->input->post('phone'),
        		'birthday' => $this->input->post('birthday'),
        		'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'department_id' => $this->input->post('department_id'),
				'team_id' => $this->input->post('team_id'),
				'position' => $this->input->post('position'),				
				'created_date' => date('Y-m-d H:i:s'),
        	);

        	$create = $this->model_users->create($data, $this->input->post('groups'));
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('users/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('users/create', 'refresh');
        	}
        }
        else {
            // false case
            
        	$group_data = $this->model_groups->getGroupData(null,true);
        	$this->data['group_data'] = $group_data;

            $this->render_template('users/create', $this->data);
        }
	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function edit($id = null)
	{
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if($id) {
			$this->form_validation->set_rules('groups', 'Group', 'required');
			$this->form_validation->set_rules('login_id', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');			
			$this->form_validation->set_rules('email', 'Email', 'trim|required');		
			$this->form_validation->set_rules('phone', 'Phone No', 'trim|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('birthday', 'Birthday', 'trim');

			if ($this->form_validation->run() == TRUE) {				
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'login_id' => $this->input->post('login_id'),
		        		'email' => $this->input->post('email'),
						'fullname' => $this->input->post('fullname'),
						'phone' => $this->input->post('phone'),
						'birthday' => $this->input->post('birthday'),
						'gender' => $this->input->post('gender'),
						'address' => $this->input->post('address'),
						'department' => $this->input->post('department'),
						'position' => $this->input->post('position'),
						'address' => $this->input->post('address'),
						'last_change' => date('Y-m-d H:i:s'),						
		        	);

		        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully created');
		        		redirect('users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error occurred!!');
		        		redirect('users/edit/'.$id, 'refresh');
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'login_id' => $this->input->post('login_id'),
							'email' => $this->input->post('email'),
							'fullname' => $this->input->post('fullname'),
							'phone' => $this->input->post('phone'),
							'birthday' => $this->input->post('birthday'),
							'gender' => $this->input->post('gender'),
							'address' => $this->input->post('address'),
							'department' => $this->input->post('department'),
							'position' => $this->input->post('position'),
							'address' => $this->input->post('address'),
							'last_change' => date('Y-m-d H:i:s'),
							'password' => $password,
			        	);

			        	$update = $this->model_users->edit($data, $id, $this->input->post('groups'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated');
			        		redirect('users/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error occurred!!');
			        		redirect('users/edit/'.$id, 'refresh');
			        	}
					}
			        else {
			            // false case
			        	$user_data = $this->model_users->getUserData($id);
			        	$groups = $this->model_users->getUserGroup($id);

			        	$this->data['user_data'] = $user_data;
			        	$this->data['user_group'] = $groups;

			            $group_data = $this->model_groups->getGroupData();
			        	$this->data['group_data'] = $group_data;

						$this->render_template('users/edit', $this->data);	
			        }	

		        }
	        }
	        else {
	            // false case
	        	$user_data = $this->model_users->getUserData($id);
	        	$groups = $this->model_users->getUserGroup($id);

	        	$this->data['user_data'] = $user_data;
	        	$this->data['user_group'] = $groups;

	            $group_data = $this->model_groups->getGroupData(null,1);
	        	$this->data['group_data'] = $group_data;
				$this->session->set_userdata('currentPage', 'users/edit');
				$this->render_template('users/edit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if($id) {
			if($this->input->post('confirm')) {

				
					$delete = $this->model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed');
		        		redirect('users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error occurred!!');
		        		redirect('users/delete/'.$id, 'refresh');
		        	}
			}	
			else {
				$this->data['id'] = $id;
				$this->render_template('users/delete', $this->data);
			}	
		}
	}

	public function disable($id) 
	{
		
		if($id) {
						
			$disable = $this->model_users->disable($id);
			if($disable == true) {
				$this->session->set_flashdata('success', 'Successfully removed');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully remove user';
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while removing user';
			}				
		}
		else {
			$this->session->set_flashdata('error', 'Error occurred!!');
			$response['success'] = false;
			$response['messages'] = 'Error in the database while removing user';
		}
		echo json_encode($response);
	}

	public function fetchUserData()
	{
		$result = array('data' => array());
		$data = $this->model_users->getUserData();

		foreach ($data as $key => $value) {
			// button
			$buttons = '';			
			$group = '';
			$buttons = '<a href="'.base_url("users/edit/".$value["id"]).'") class="btn btn-default" data-toggle="tooltip" title = "Edit"><i class="fa fa-edit"></i></a>';
			
			$buttons .= '<button type="button" class="btn btn-default" onclick="removeFunc('.$value["id"].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash" data-toggle="tooltip" title = "Remove"></i></button>';

			// $group = $this->model_users->getGroup($value["id"]);
			$active = ($value['active'] == 1) ? '<span class="label label-success">Active</span>' : '<span class="label label-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$value['login_id'],
				$value['full_name'],
				$value['email'],
				$value['department'],
				$value['team'],
				$value['position'],
				$value['_group'],
                $active              
				
			);
		} // /foreach

		
		echo json_encode($result);
	}
	public function profile()
	{		
		
		$user_id = $this->session->userdata('id');

		$user_data = $this->model_users->getUserData($user_id);
		$this->data['user_data'] = $user_data;

		$group_data = $this->model_groups->getGroupData(null,1);
	    $this->data['group_data'] = $group_data;

		$user_group = $this->model_users->getUserGroup($user_id);
		$this->data['user_group'] = $user_group;
		$id = $user_data['id'];
		
		$this->form_validation->set_rules('login_id', 'Username', 'trim|required|min_length[5]|max_length[12]');
		$this->form_validation->set_rules('fullname', 'Fullname', 'trim|required');			
		$this->form_validation->set_rules('email', 'Email', 'trim|required');		
		$this->form_validation->set_rules('phone', 'Phone No', 'trim|regex_match[/^[0-9]{10}$/]');
		$this->form_validation->set_rules('birthday', 'Birthday', 'trim');
		

		if ($this->form_validation->run() == TRUE) {
			$image = '';
			if (($_FILES['img-file']['size']==0)){
				$image = $user_data['image'];
				
			} else {
				$image= '/images/users/'.$_FILES['img-file']['name'];				
				if ($this->do_upload() == false) {					
					redirect('users/profile','refresh');
				}
			}
			if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
				
				$data = array(
					'login_id' => $this->input->post('login_id'),
					'email' => $this->input->post('email'),
					'fullname' => $this->input->post('fullname'),
					'phone' => $this->input->post('phone'),
					'birthday' => $this->input->post('birthday'),
					'gender' => $this->input->post('gender'),
					'address' => $this->input->post('address'),
					'department' => $this->input->post('department'),
					'position' => $this->input->post('position'),
					'address' => $this->input->post('address'),
					'last_change' => date('Y:m:d H:i:s'),
					'image'=>$image,
				);

				$update = $this->model_users->edit($data, $id);
				if($update == true) {
					$this->session->set_flashdata('success', 'Successfully updated');					
					redirect('users/profile', 'refresh');

				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('users/profile', 'refresh');
				}
			}
			else {
				$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
				$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

				if($this->form_validation->run() == TRUE) {

					$password = $this->password_hash($this->input->post('password'));

					$data = array(
						'login_id' => $this->input->post('login_id'),
						'email' => $this->input->post('email'),
						'fullname' => $this->input->post('fullname'),
						'phone' => $this->input->post('phone'),
						'birthday' => $this->input->post('birthday'),
						'gender' => $this->input->post('gender'),
						'address' => $this->input->post('address'),
						'department' => $this->input->post('department'),
						'position' => $this->input->post('position'),
						'address' => $this->input->post('address'),
						'last_change' => date('Y:m:d H:i:s'),
						'password' => $password,
						'image'=>$image,
					);

					$update = $this->model_users->edit($data, $id);
					if($update == true) {
						$this->session->set_flashdata('success', 'Successfully updated');						
						redirect('users/profile', 'refresh');
					}
					else {
						$this->session->set_flashdata('errors', 'Error occurred!!');
						redirect('users/profile', 'refresh');
					}
				}
				else {
					// false case					
					$this->session->set_userdata('currentPage', 'users/profile');
					$this->render_template('users/profile', $this->data);	
				}	
			}
		}
		else {
			$this->session->set_userdata('currentPage', 'users/profile');
			// $cp = $this->session->userdata('currentPage');
			// echo '<script>console.log("'.$cp.'")</script>' ;
			$this->render_template('users/profile', $this->data);	
		}
        
	}

}