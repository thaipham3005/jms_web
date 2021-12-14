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
		if(!in_array('viewUserGroup', $this->permission)) {
			$this->session->set_flashdata('error', 'You are not permitted for this operation');
            redirect('dashboard', 'refresh');
        }
		$this->session->set_userdata('currentPage', 'settings/users');		
		$this->render_template('settings/users', $this->data);
	}

	public function create()
	{
		if(!in_array('editUserGroup', $this->permission)) {
			$this->session->set_flashdata('error', 'You are not permitted for this operation');
            redirect('dashboard', 'refresh');
        }

		// $this->form_validation->set_rules('groups', 'Group', 'required');
		$this->form_validation->set_rules('full_name', 'Fullname', 'trim|required');
		$this->form_validation->set_rules('login_id', 'Username', 'trim|required|min_length[5]|max_length[12]|is_unique[users.login_id]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|is_unique[users.email]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
		$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

		
        if ($this->form_validation->run() == TRUE) {
            // true case
            $password = $this->password_hash($this->input->post('password'));
        	$data = array(
        		'login_id' => $this->input->post('login_id'),
        		'password' => $password,
        		'email' => $this->input->post('email'),
        		'full_name' => $this->input->post('full_name'),
				'short_name' => $this->input->post('short_name'),
        		'phone' => $this->input->post('phone'),
        		'birthday' => $this->input->post('birthday'),
				'level' => $this->input->post('level'),
        		'gender' => $this->input->post('gender'),
				'address' => $this->input->post('address'),
				'company_id' => $this->input->post('company_id'),
				'department_id' => $this->input->post('department_id'),
				'team_id' => $this->input->post('team_id'),
				'position' => $this->input->post('position'),
				'first_working_day' => $this->input->post('first_working_day'),
				'created_by'=> $this->session->userdata('id'),
				'created_date' => date('Y-m-d H:i:s')
        	);			

        	$create = $this->model_users->create($data, $this->input->post('group_id'));
			
						
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created user');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully created user';
        		// redirect('settings/users', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error in the database while creating user!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while creating user';
        		// redirect('settings/users', 'refresh');
        	}
        }
        else {
			$this->session->set_flashdata('errors', 'Error in data validation while creating user!');
			$response['success'] = false;
			$response['messages'] = 'Error in data validation while creating user';
			// redirect('settings/users', 'refresh');
        	// $group_data = $this->model_groups->getGroupData(null,true);
            // $this->render_template('settings/users', $this->data);
        }
		echo json_encode($response);
	}

	public function password_hash($pass = '')
	{
		if($pass) {
			$password = password_hash($pass, PASSWORD_DEFAULT);
			return $password;
		}
	}

	public function edit($id)
	{
		if(!in_array('editUserGroup', $this->permission)) {
			$this->session->set_flashdata('error', 'You are not permitted for this operation');
            redirect('dashboard', 'refresh');
        }

		if($id) {
			// $this->form_validation->set_rules('groups', 'Group', 'required');
			$this->form_validation->set_rules('login_id', 'Username', 'trim|required|min_length[5]|max_length[12]');
			$this->form_validation->set_rules('full_name', 'Fullname', 'trim|required');			
			$this->form_validation->set_rules('email', 'Email', 'trim|required');		

			if ($this->form_validation->run() == TRUE) {				
		        if(empty($this->input->post('password')) && empty($this->input->post('cpassword'))) {
		        	$data = array(
		        		'login_id' => $this->input->post('login_id'),
						'email' => $this->input->post('email'),
						'full_name' => $this->input->post('full_name'),
						'short_name' => $this->input->post('short_name'),
						'phone' => $this->input->post('phone'),
						'birthday' => $this->input->post('birthday'),
						'level' => $this->input->post('level'),
						'gender' => $this->input->post('gender'),
						'address' => $this->input->post('address'),
						'company_id' => $this->input->post('company_id'),
						'department_id' => $this->input->post('department_id'),
						'team_id' => $this->input->post('team_id'),
						'position' => $this->input->post('position'),
						'first_working_day' => $this->input->post('first_working_day'),
						'changed_by'=> $this->session->userdata('id'),
						'last_change' => date('Y-m-d H:i:s')					
		        	);

		        	$update = $this->model_users->edit($data, $id, $this->input->post('group_id'));
		        	if($update == true) {
		        		$this->session->set_flashdata('success', 'Successfully updated user');
						$response['success'] = true;
	        			$response['messages'] = 'Succesfully updated user';
		        		// redirect('users/', 'refresh');
		        	}
		        	else {
		        		$this->session->set_flashdata('errors', 'Error in the database while updating user!');
						$response['success'] = false;
						$response['messages'] = 'Error in the database while updating user';
		        	}
		        }
		        else {
		        	$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]');
					$this->form_validation->set_rules('cpassword', 'Confirm password', 'trim|required|matches[password]');

					if($this->form_validation->run() == TRUE) {

						$password = $this->password_hash($this->input->post('password'));

						$data = array(
			        		'login_id' => $this->input->post('login_id'),
							'password' => $password,
							'email' => $this->input->post('email'),
							'full_name' => $this->input->post('full_name'),
							'short_name' => $this->input->post('short_name'),
							'phone' => $this->input->post('phone'),
							'birthday' => $this->input->post('birthday'),
							'level' => $this->input->post('level'),
							'gender' => $this->input->post('gender'),
							'address' => $this->input->post('address'),
							'company_id' => $this->input->post('company_id'),
							'department_id' => $this->input->post('department_id'),
							'team_id' => $this->input->post('team_id'),
							'position' => $this->input->post('position'),
							'first_working_day' => $this->input->post('first_working_day'),
							'changed_by'=> $this->session->userdata('id'),
							'last_change' => date('Y-m-d H:i:s')	
			        	);

			        	$update = $this->model_users->edit($data, $id, $this->input->post('group_id'));
			        	if($update == true) {
			        		$this->session->set_flashdata('success', 'Successfully updated user');
							$response['success'] = true;
	        				$response['messages'] = 'Succesfully updated user';
			        		// redirect('users/', 'refresh');
			        	}
			        	else {
			        		$this->session->set_flashdata('errors', 'Error in the database while updating user!');
							$response['success'] = false;
	        				$response['messages'] = 'Error in the database while updating user';
			        		// redirect('users/edit/'.$id, 'refresh');
			        	}
					}
			        else {
			            $this->session->set_flashdata('errors', 'Password are not matched!');
						$response['success'] = false;
						$response['messages'] = 'Password are not matched!';
			        }	
		        }
	        }
	        else {
	            $this->session->set_flashdata('errors', 'Error in data validation while updating user!!!!');
				$response['success'] = false;
				$response['messages'] = 'Error in data validation while updating user!';	
	        }	
		}	
		echo json_encode($response);
	}

	public function delete($id)
	{
		if(!in_array('editUserGroup', $this->permission)) {
			$this->session->set_flashdata('error', 'You are not permitted for this operation');
            redirect('dashboard', 'refresh');
        }

		if($id) {
			if($this->input->post('confirm')) {				
					$delete = $this->model_users->delete($id);
					if($delete == true) {
		        		$this->session->set_flashdata('success', 'Successfully removed  user');
						$response['success'] = true;
						$response['messages'] = 'Succesfully remove user';
		        	}
		        	else {
		        		$this->session->set_flashdata('error', 'Error in the database while removing user!');
						$response['success'] = false;
						$response['messages'] = 'Error in the database while removing user';
		        	}
			}	
			else {
				$this->session->set_flashdata('error', 'No valid item was selected!');
				$response['success'] = false;
				$response['messages'] = 'No group seleted for delete';
			}	
		}
		echo json_encode($response);
	}

	public function disable($id) 
	{		
		if($id) {
						
			$disable = $this->model_users->disable($id);
			if($disable == true) {
				$this->session->set_flashdata('success', 'Successfully removed  user');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully remove user';
			}
			else {
				$this->session->set_flashdata('error', 'Error in the database while removing user!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while removing user';
			}				
		}
		else {
			$this->session->set_flashdata('error', 'No valid item was selected!');
			$response['success'] = false;
			$response['messages'] = 'No group seleted for delete';
		}
		echo json_encode($response);
	}
	
	public function fetchUserData($company_id = null, $department_id=null, $team_id = null)
	{
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}

		$result = array('data' => array());
		$data = $this->model_users->getUserData($company_id, $department_id=null, $team_id = null);

		foreach ($data as $key => $value) {
			// button
			$buttons = '';			
			$group = '';
			if(in_array('editUserGroup', $this->permission)){
				$buttons = '<button type="button" class="btn btn-xs btn-outline-secondary btn-edit" data-toggle="modal" data-target="#userEditModal"><i class="far fa-edit fa-fw" data-toggle="tooltip" title = "Edit"></i></button>';
				$buttons .= '<button type="button" class="btn btn-xs btn-outline-secondary btn-remove" data-toggle="modal" data-target="#userRemoveModal"><i class="far fa-trash-alt fa-fw" data-toggle="tooltip" title = "Remove"></i></button>';
				$buttons .= '<button type="button" class="btn btn-xs btn-outline-secondary btn-reset" data-toggle="modal" data-target="#userResetModal"><i class="fas fa-recycle fa-fw" data-toggle="tooltip" title = "Reset Password"></i></button>';
	
			}

			$active = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$value['login_id'],
				$value['full_name'],
				$value['email'],
				$value['department'],
				$value['team'],
				$value['position'],
				$value['_group'],
                $active,
				$value['id'],
				$value['level'],
				
			);
		} // /foreach

		
		echo json_encode($result);
	}

	public function fetchUserDataCards($company_id = null, $department_id=null, $team_id = null)
	{
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}

		$result = array('data' => array());
		$data = $this->model_users->getUserData($company_id, $department_id=null, $team_id = null);

		foreach ($data as $key => $value) {
			// button
			$buttons = '';			
			$group = '';
			$buttons = '<button type="button" class="btn btn-sm btn-outline-secondary btn-edit" data-toggle="modal" data-target="#userEditModal"><i class="far fa-edit fa-fw" data-toggle="tooltip" title = "Edit"></i></button>';
			
			$buttons .= '<button type="button" class="btn btn-sm btn-outline-secondary btn-remove" data-toggle="modal" data-target="#userRemoveModal"><i class="far fa-trash-alt fa-fw" data-toggle="tooltip" title = "Remove"></i></button>';

			$buttons .= '<button type="button" class="btn btn-sm btn-outline-secondary btn-reset" data-toggle="modal" data-target="#userResetModal"><i class="fas fa-recycle fa-fw" data-toggle="tooltip" title = "Reset Password"></i></button>';

			$active = ($value['active'] == 1) ? '<span class="badge badge-success">Active</span>' : '<span class="badge badge-warning">Inactive</span>';

			$result['data'][$key] = array(
				$buttons,
				$value['login_id'],
				$value['full_name'],
				$value['email'],
				$value['department'],
				$value['team'],
				$value['position'],
				$value['_group'],
                $active,
				$value['id'],
				$value['level'],
				
			);
		} // /foreach

		
		echo json_encode($result);
	}

	public function fetchUsersList($company_id, $department_id, $team_id)
	{
		$data = $this->model_users->getUserData($company_id, $department_id, $team_id);
		$list = '';

		$list .= '<ul class="select-list">';
		foreach ($data as $key => $value) {
			$list .= '<li class="select-item p-1" user-id='.$value["id"].'><img class="avatar" src="'.$value["avatar"].'"></img>'.$value["full_name"].'</li>';
		} // /foreach	
		$list .= '</ul>';

		echo json_encode($list) ;	
		
	}

		
	public function getUserById($user_id){
		$data = $this->model_users->getUserById($user_id);
		echo json_encode($data);
	}

	public function profile()
	{
		$this->session->set_userdata('currentPage', 'profile');
		$this->render_template('profile', $this->data);	
	}

}