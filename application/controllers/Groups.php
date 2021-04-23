<?php 

class Groups extends Admin_Controller 
{
	
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();

		$this->data['page_title'] = 'Groups';
		$this->load->model('model_groups');

	}

	public function index()
	{
		if(!in_array('editUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$groups_data = $this->model_groups->getGroupData();
		$this->data['groups_data'] = $groups_data;

		$this->render_template('settings/groups', $this->data);
	}

	public function create()
	{
		if(!in_array('editUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
        	$data = array(
        		'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),
        		'permission' => $permission,
				'created_by'=> $this->session->userdata('id'),			
				'created_date' => date('Y-m-d H:i:s')
        	);

        	$create = $this->model_groups->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Succesfully created group');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully created group';
        		// redirect('settings/groups', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error in the database while creating group!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while creating group';
        		// redirect('settings/groups', 'refresh');
        	}
        }
        else {
			$this->session->set_flashdata('errors', 'Error in data validation while creating group!');
			$response['success'] = false;
			$response['messages'] = 'Error in the database while creating group';

			// redirect('settings/groups', 'refresh');
            // $this->render_template('groups/create', $this->data);
        }	

		echo json_encode($response);
	}

	public function edit($id = null)
	{
		// if(!in_array('editUserGroup', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

		if($id) {
			$this->form_validation->set_rules('name', 'Group name', 'required');

			if ($this->form_validation->run() == TRUE) {
	            $permission = serialize($this->input->post('permission'));
	            
	        	$data = array(
	        		'name' => $this->input->post('name'),
					'description' => $this->input->post('description'),
	        		'permission' => $permission, 
					'changed_by'=>$this->session->userdata('id'),
					'last_change'=> date('Y-m-d H:i:s')
	        	);

	        	$update = $this->model_groups->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
					$response['success'] = true;
	        		$response['messages'] = 'Succesfully updated group';
	        		// redirect('groups/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
					$response['success'] = false;
	        		$response['messages'] = 'Error in the database while updating group!';
	        		// redirect('groups/edit/'.$id, 'refresh');
	        	}
	        }
	        else {
				$this->session->set_flashdata('errors', 'Error in data validation while updating group!');
				$response['success'] = false;
				$response['messages'] = 'Error in data validation while updating group!';
	        }	
		}
		echo json_encode($response);
		
	}

	public function delete($id)
	{
		if($id) {
						
			$disable = $this->model_groups->delete($id);
			if($disable == true) {
				$this->session->set_flashdata('success', 'Successfully deleted');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully deleted user';
			}
			else {
				$this->session->set_flashdata('error', 'Error in the database while deleted user!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while deleted user';
			}				
		}
		else {
			$this->session->set_flashdata('error', 'No user seleted for delete!');
			$response['success'] = false;
			$response['messages'] = 'No group seleted for delete';
		}
		echo json_encode($response);
    }

    public function disable($id)
	{
		if($id) {
						
            $disable = $this->model_groups->disable($id);
            if ($disable == true) {
                $this->session->set_flashdata('success', 'Successfully removed group');
                $response['success'] = true;
                $response['messages'] = 'Succesfully removed group';
            }
            else {
                $this->session->set_flashdata('error', 'Error in the database while removing group!');
                $response['success'] = false;
                $response['messages'] = 'Error in the database while removing group!';
            }				
        }
        else {
            $this->session->set_flashdata('error', 'No group seleted for remove!');
            $response['success'] = false;
            $response['messages'] = 'No group seleted for remove';
        }
        echo json_encode($response);
    }

	public function getGroupByID($group_id){
		$result = array();
		if ($group_id){
			$data = $this->model_groups->getGroupByID($group_id);
			$result["name"] = $data["name"];
			$result["description"] = $data["description"];
			$result["permission"]= unserialize($data["permission"]);

			echo json_encode($result);
		}
	}
    
    public function fetchGroupData($company_id = null)
    {
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
        $result = array('data' => array());
        $data = $this->model_groups->getGroupData($company_id);        		

		foreach ($data as $key => $value) {			
            $buttons = '';
            $buttons.='<div style="width:100px;">';
            

			if (in_array('editUserGroup', $this->permission)){
                $buttons .= '<button type="button" class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#groupEditModal"><i class="far fa-edit fa-fw" data-toggle="tooltip" title = "Edit"></i></button>';

                $buttons .= '<button type="button" class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#groupRemoveModal"><i class="far fa-trash-alt fa-fw" data-toggle="tooltip" title = "Remove"></i></button>';
            }
            $buttons.='</div>';

            $result['data'][$key] = array(
                $buttons,
                $value['name'],
                $value['description'],
                $value['id']
            );
            
        }
        echo json_encode($result);
    }

	public function fetchGroupSelect($company_id = null)
	{
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
		$result = '';
        $data = $this->model_groups->getGroupData($company_id);        		

		foreach ($data as $key => $value) {	
            $result .= "<option value = ".$value['id'].">".$value['name']."</option>";
            
        }
		echo json_encode($result);
	}


}