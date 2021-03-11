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
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$groups_data = $this->model_groups->getGroupData();
		$this->data['groups_data'] = $groups_data;

		$this->render_template('groups/index', $this->data);
	}

	public function create()
	{
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$this->form_validation->set_rules('group_name', 'Group name', 'required');

        if ($this->form_validation->run() == TRUE) {
            // true case
            $permission = serialize($this->input->post('permission'));
            
        	$data = array(
        		'group_name' => $this->input->post('group_name'),
        		'permission' => $permission
        	);

        	$create = $this->model_groups->create($data);
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created');
        		redirect('groups/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('groups/create', 'refresh');
        	}
        }
        else {
            // false case
            $this->render_template('groups/create', $this->data);
        }	

		
	}

	public function edit($id = null)
	{
		if(!in_array('modifyUserGroup', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if($id) {

			$this->form_validation->set_rules('group_name', 'Group name', 'required');

			if ($this->form_validation->run() == TRUE) {
	            // true case
	            $permission = serialize($this->input->post('permission'));
	            
	        	$data = array(
	        		'group_name' => $this->input->post('group_name'),
	        		'permission' => $permission
	        	);

	        	$update = $this->model_groups->edit($data, $id);
	        	if($update == true) {
	        		$this->session->set_flashdata('success', 'Successfully updated');
	        		redirect('groups/', 'refresh');
	        	}
	        	else {
	        		$this->session->set_flashdata('errors', 'Error occurred!!');
	        		redirect('groups/edit/'.$id, 'refresh');
	        	}
	        }
	        else {
	            // false case
	            $group_data = $this->model_groups->getGroupData($id);
				$this->data['group_data'] = $group_data;
				$this->render_template('groups/edit', $this->data);	
	        }	
		}

		
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
				$this->session->set_flashdata('error', 'Error occurred!!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while deleted user';
			}				
		}
		else {
			$this->session->set_flashdata('error', 'Error occurred!!');
			$response['success'] = false;
			$response['messages'] = 'No user seleted for delete';
		}
		echo json_encode($response);
    }

    public function disable($id)
	{
		if($id) {
						
            $disable = $this->model_groups->disable($id);
            if ($disable == true) {
                $this->session->set_flashdata('success', 'Successfully removed');
                $response['success'] = true;
                $response['messages'] = 'Succesfully removed group';
            }
            else {
                $this->session->set_flashdata('error', 'Error occurred!!');
                $response['success'] = false;
                $response['messages'] = 'Error in the database while removing group';
            }				
        }
        else {
            $this->session->set_flashdata('error', 'Error occurred!!');
            $response['success'] = false;
            $response['messages'] = 'No group seleted for remove';
        }
        echo json_encode($response);
    }
    
    public function fetchGroupData()
    {
        $result = array('data' => array());
        $data = $this->model_groups->getGroupData();
        		

		foreach ($data as $key => $value) {			
            $buttons = '';
            $buttons.='<div style="width:100px;">';
            

			if (in_array('modifyUserGroup', $this->permission)){
                $buttons .= '<a href="'.base_url("groups/edit/".$value["id"]).'") class="btn btn-default" data-toggle="tooltip" title = "Edit"><i class="fa fa-edit"></i></a>';
                $buttons .= '<button class="btn btn-default" onclick="removeFunc('.$value['id'].')" data-toggle="modal" data-target="#removeModal"><i class="fa fa-trash"></i></button>';
            }
            $buttons.='</div>';

            $result['data'][$key] = array(
                $buttons,
                $value['group_name'],
                $value['description'],
                $value['id']
            );
            
        }
        echo json_encode($result);
    }


}