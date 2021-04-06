<?php 

class Organization extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();

		$this->data['page_title'] = 'Organization';
		$this->load->model('model_organization');
	}

	public function index()
	{
		if(!in_array('editOrganization', $this->permission) || !in_array('viewOrganization', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		$depts_data = $this->model_organization->getDepartmentData();
		$this->data['depts_data'] = $depts_data;
        $teams_data = $this->model_organization->getTeamData();
		$this->data['teams_data'] = $teams_data;
        $squads_data = $this->model_organization->getSquadData();
		$this->data['squads_data'] = $squads_data;

		$this->render_template('settings/organization', $this->data);
	}

	public function createDept()
	{
		if(!in_array('editOrganization', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

        $data = array(
        		'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),	
                'created_by'=> $this->session->userdata('id'),			
				'created_date' => date('Y-m-d H:i:s')
        	);

        	$create = $this->model_organization->createDept($data, $this->input->post('departments'));
        	if($create == true) {
        		$this->session->set_flashdata('success', 'Successfully created department');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully created department';
        		// redirect('settings/users', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error in the database while creating department!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while creating department';
        		// redirect('settings/users', 'refresh');
        	}
        
		
	}

	public function editDept($id = null)
	{
		if(!in_array('editOrganization', $this->permission)) {
            redirect('dashboard', 'refresh');
        }

		if($id) {
			$data = array(
				'name' => $this->input->post('name'),
				'description' => $this->input->post('description'),	
				'changed_by'=> $this->session->userdata('id'),			
				'last_change' => date('Y-m-d H:i:s')
			);

			$update = $this->model_organization->editDept($data, $id);
			if($update == true) {
				$this->session->set_flashdata('success', 'Successfully updated department!');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully updated department';
			}
			else {
				$this->session->set_flashdata('errors', 'Error in the database while updating department!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while updating department';
			}
		}
		else {
			$this->session->set_flashdata('errors', 'Error in data validation while updating department!');
				$response['success'] = false;
				$response['messages'] = 'Error in data validation while updating department!';
			// $department_data = $this->model_organization->getDepartmentByID($id);
			// $this->data['department_data'] = $department_data;
			// $this->render_template('settings/organization', $this->data);	
		}	
		echo json_encode($response);
	}

	public function delete($id)
	{
		if($id) {
						
			$disable = $this->model_organization->delete($id);
			if($disable == true) {
				$this->session->set_flashdata('success', 'Successfully deleted user');
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
			$this->session->set_flashdata('error', 'No department seleted for delete!');
			$response['success'] = false;
			$response['messages'] = 'No department seleted for delete';
		}
		echo json_encode($response);
    }

    public function disable($id)
	{
		if($id) {
						
            $disable = $this->model_organization->disable($id);
            if ($disable == true) {
                $this->session->set_flashdata('success', 'Successfully removed department');
                $response['success'] = true;
                $response['messages'] = 'Succesfully removed department';
            }
            else {
                $this->session->set_flashdata('error', 'Error in the database while removing department!');
                $response['success'] = false;
                $response['messages'] = 'Error in the database while removing department';
            }				
        }
        else {
            $this->session->set_flashdata('error', 'No department seleted for remove!');
            $response['success'] = false;
            $response['messages'] = 'No department seleted for remove';
        }
        echo json_encode($response);
    }
    
    public function fetchDeparmentData($company_id = null)
    {
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
        $result = array('data' => array());
        $data = $this->model_organization->getDepartmentData();
        		

		foreach ($data as $key => $value) {			
            $buttons = '';
            $buttons.='<div style="width:100px;">';            

			if(in_array('editOrganization', $this->permission)){
                $buttons .= '<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#departmentEditModal"><i class="fa fa-edit fa-fw" data-toggle="tooltip" title = "Edit"></i></button>';

                $buttons .= '<button type="button" class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#departmentRemoveModal"><i class="fa fa-trash fa-fw" data-toggle="tooltip" title = "Remove"></i></button>';
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

	#region Fetch data for Select
	public function fetchCompanySelect()
	{		
		$result = '';
        $data = $this->model_organization->getCompanyData();        		

		foreach ($data as $key => $value) {	
            $result .= "<option value = ".$value['id'].">".$value['name']."</option>";
            
        }
		echo json_encode($result);
	}
	public function fetchDepartmentSelect($company_id = null)
	{
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
		$result = '';
        $data = $this->model_organization->getDepartmentData($company_id);        		

		foreach ($data as $key => $value) {	
            $result .= "<option value = ".$value['id'].">".$value['name']."</option>";
            
        }
		echo json_encode($result);
	}
	public function fetchTeamSelect($department_id, $company_id = null)
	{
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
		$result = '';
        $data = $this->model_organization->getTeamData($department_id, $company_id);        		

		foreach ($data as $key => $value) {	
            $result .= "<option value = ".$value['id'].">".$value['name']."</option>";
            
        }
		echo json_encode($result);
	}
	public function fetchSquadSelect($team_id, $department_id, $company_id = null)
	{
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
		$result = '';
        $data = $this->model_organization->getSquadData($team_id, $department_id, $company_id);        		

		foreach ($data as $key => $value) {	
            $result .= "<option value = ".$value['id'].">".$value['name']."</option>";
            
        }
		echo json_encode($result);
	}


	public function fetchTeamList($department_id, $company_id = null ){
		if ($company_id == null) {
			$company_id = $this->session->userdata("company_id");
		}
        $data = $this->model_organization->getTeamData($department_id, $company_id);        		
		$result = '<ul class="select-list">';
		foreach ($data as $key => $value) {	
            $result .= '<li class="select-item p-1" team-id='.$value['id'].'>'.$value['name'].'</li>';            
        }
		$result .= '</ul>';
		echo json_encode($result);
	}


}
		