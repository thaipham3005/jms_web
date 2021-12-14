<?php

class Tasks extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		
		$this->data['page_title'] = 'Tasks Management';	

        $this->load->model('model_users'); 
        // $this->load->model('model_notifications');	
        $this->load->model('model_tasks');
        // $this->load->model('model_reports');
    }

    #region render Pages
    public function member_tasks($user_id)
    {
        $this->session->set_userdata('currentPage','tasks/member_tasks/'.$user_id);
        $this->render_template('tasks/member_tasks', $this->data);
    }  

    public function team_tasks()
    {
        $this->session->set_userdata('currentPage','tasks/team_tasks');
        $this->render_template('tasks/team_tasks', $this->data);
    } 
    #endregion

    #region fetch Data
    public function fetchSingleTaskById($task_id){
        $data = $this->model_tasks->getTaskById($task_id);
        echo json_encode($data);
    }

    public function fetchTaskDataByUser($user_id, $year=null,$month=null)
    {
        $result = array('data' => array());
        $fromDate = ''; $toDate='';
        if ($year && $month){
            $fromDate = "$year-$month-1";
            $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $toDate = "$year-$month-$lastDayOfMonth";
    
            $data = $this->model_tasks->getTaskDataByUser($user_id, $fromDate, $toDate);
        } else {
            $m = date("m");
            $y = date("Y");
            $fromDate = $y."-".$m."-1";
            $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $toDate = "$y-$m-$lastDayOfMonth";

            $data = $this->model_tasks->getTaskDataByUser($user_id, $fromDate, $toDate);

        }        	

		foreach ($data as $key => $value) {
			
            $buttons = $status = $rating = $pic = '';

            $buttons.= '<div style="width:50px;">';            
            $buttons .= '<button class="btn btn-outline-secondary btn-sm"><i class="fas fa-info fa-fw"></i></button>';
            $buttons .= '<button class="btn btn-outline-secondary btn-sm"><i class="far fa-edit fa-fw"></i></button>';
            $buttons.= '</div>'; 
                
            // if ($value['status'] == '0') {
            //     $status = '<span class="badge badge-secondary">Not yet started</span>';
            // } elseif ($value['status'] == '1') {
            //     $status = '<span class="badge badge-info">Ongoing</span>';
            // }else if ($value['status'] == '2') {
            //     $status = '<span class="badge badge-primary">Completed</span>';
            // }else if ($value['status'] == '3') {
            //     $status = '<span class="badge badge-danger">Overdue</span>';
            // }else if ($value['status'] == '4') {
            //     $status = '<span class="badge badge-success">Approved</span>';
            // }else {
            //     $status = '<span class="badge badge-secondary">Idle</span>';
            // }

            
            $pic = '<img class="avatar" src="'.$value["avatar"].'"></img><span>'.$value["full_name"].'</span>';
            $rating = '<select class="star-rating">
                <option value="">Not rated</option>
                <option value="0">Not comply</option>
                <option value="1">Acceptable (I)</option>
                <option value="2">Acceptable (II)</option>
                <option value="3">Good (I)</option>
                <option value="4">Good (II)</option>
                <option value="5">Excellent (I)</option>
                <option value="6">Excellent (II)</option>
                </select>';
                        
            $result['data'][$key] = array(				
                $buttons,
                $pic,
                $value['project'],
				$value['description'],
                date('d/m/Y', strtotime($value['deadline']))  ,
                $value['weight'],                
                $value['status'], 						
                $value['assigned_by'],
                $value['remarks'],
                $rating,

                $value['id'],
                		
			);
        } // /foreach
        
		// echo $result;
		echo json_encode($result);
    }    

    public function fetchTasksRowByUser($user_id, $year=null,$month=null)
    {        
        $fromDate = ''; $toDate='';
        if ($year && $month){
            $fromDate = "$year-$month-1";
            $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
            $toDate = "$year-$month-$lastDayOfMonth";
    
            $data = $this->model_tasks->getTaskDataByUser($user_id, $fromDate, $toDate);
        } else {
            $m = date("m");
            $y = date("Y");
            $fromDate = $y."-".$m."-1";
            $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $toDate = "$y-$m-$lastDayOfMonth";

            $data = $this->model_tasks->getTaskDataByUser($user_id, $fromDate, $toDate);
        } 
		echo json_encode($data);
    }  

    public function countNewTasks()
    {
        $count = $this->model_tasks->countNewTasks();
        echo $count;
    }

    #region CRUD
    public function create()
    {
        // if(!in_array('createRequests', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $this->form_validation->set_rules('description', 'Task description', 'required');
        $this->form_validation->set_rules('project', 'Project', 'trim|required');	
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');	
        
        if ($this->form_validation->run() == TRUE) {   
            //processing after hitting submit         
        	$data = array(
                'description'=>$this->input->post('description'),
                'project'=>$this->input->post('project'),
                'company_id'=>$this->session->userdata('company_id'),
                'department_id'=>$this->session->userdata('department_id'),
                'team_id'=>$this->session->userdata('team_id'),
                'deadline'=>$this->convertDateFormat($this->input->post('deadline')),
                'plan_start'=>$this->convertDateFormat($this->input->post('plan_start')) ,
                'plan_complete'=>$this->convertDateFormat($this->input->post('plan_complete')),
                // 'actual_start'=>$this->input->post('actual_start'),
                // 'actual_complete'=>$this->input->post('actual_complete'),
                'priority'=>$this->input->post('priority'),
                'weight'=>$this->input->post('weight'),
                'remarks'=>$this->input->post('remarks'),
                'status'=>'0',
                'created_date'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata['id'],
                'user_id'=>$this->session->userdata['id']
            );
            $create = $this->model_tasks->create($data);
        	if($create == true) {
                // $noti = array(
                //     'group_id' => $groups,
                //     'function'=> 'Request',
                //     'action'=> 'Approve',
                //     'description'=>'Request No '.$data['request_no']. ' required your approval for processing', 
                //     'navigate'=>'requests/approve/',               
                //     'created_date' => date('Y-m-d h:i:s'),
                // );
                
                // $this->model_notifications->create($noti);
                $this->session->set_flashdata('success', 'Successfully created task!');
        		$response['success'] = true;
	        	$response['messages'] = 'Succesfully created task!';

        	}
        	else {
        		$this->session->set_flashdata('false', 'Error in database while creating task!');
        		$response['success'] = false;
	        	$response['messages'] = 'Error in database while creating task';
        	}
        }
        else {
            $this->session->set_flashdata('errors', 'Error in data validation while crating task!!!!');
            $response['success'] = false;
            $response['messages'] = 'Error in data validation while creating task!';
        }	
        echo json_encode($response);
    }

    public function assign($user_id)
    {
        // if(!in_array('createRequests', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }

        $this->form_validation->set_rules('description', 'Task description', 'required');

        
        if ($this->form_validation->run() == TRUE) {   
            //processing after hitting submit         
        	$data = array(
                'description'=>$this->input->post('description'),
                'project'=>$this->input->post('project'),
                'company_id'=>$this->session->userdata('company_id'),
                'department_id'=>$this->session->userdata('department_id'),
                'team_id'=>$this->session->userdata('team_id'),
                'deadline'=>$this->convertDateFormat($this->input->post('deadline')),
                'plan_start'=>$this->convertDateFormat($this->input->post('plan_start')) ,
                'plan_complete'=>$this->convertDateFormat($this->input->post('plan_complete')),
                // 'actual_start'=>$this->input->post('actual_start'),
                // 'actual_complete'=>$this->input->post('actual_complete'),
                'priority'=>$this->input->post('priority'),
                'weight'=>$this->input->post('weight'),
                'remarks'=>$this->input->post('remarks'),
                'status'=>'0',
                'created_date'=>date('Y-m-d H:i:s'),
                'created_by'=>$this->session->userdata['id'],
                'assigned_date'=>date('Y-m-d H:i:s'),
                'assigned_by'=>$this->session->userdata['id'],
                'user_id'=>$user_id
            );
            $create = $this->model_tasks->create($data);
        	if($create == true) {
                // $noti = array(
                //     'group_id' => $groups,
                //     'function'=> 'Request',
                //     'action'=> 'Approve',
                //     'description'=>'Request No '.$data['request_no']. ' required your approval for processing', 
                //     'navigate'=>'requests/approve/',               
                //     'created_date' => date('Y-m-d h:i:s'),
                // );
                
                // $this->model_notifications->create($noti);
                $this->session->set_flashdata('success', 'Successfully created task!');
        		$response['success'] = true;
	        	$response['messages'] = 'Succesfully created task!';

        	}
        	else {
        		$this->session->set_flashdata('false', 'Error in database while creating task!');
        		$response['success'] = false;
	        	$response['messages'] = 'Error in database while creating task';
        	}
        }
        else {
            $this->session->set_flashdata('errors', 'Error in data validation while crating task!!!!');
            $response['success'] = false;
            $response['messages'] = 'Error in data validation while creating task!';
        }	
        echo json_encode($response);
    }

    public function edit($id)
    {
        // if(!in_array('createRequests', $this->permission)) {
        //     redirect('dashboard', 'refresh');
        // }
        $this->form_validation->set_rules('description', 'Task description', 'required');
        $this->form_validation->set_rules('project', 'Project', 'trim|required');	
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');	
        
        if ($this->form_validation->run() == TRUE) {   
            //processing after hitting submit  
            $status = 0;  
            $actual_start = null;
            $actual_complete = null;

            if ($this->input->post('actual_start')){
                $actual_start = $this->convertDateFormat($this->input->post('actual_start'));
                $status = 1;
            }
            if ($this->input->post('actual_complete')){   
                $actual_complete = $this->convertDateFormat($this->input->post('actual_complete'));                
                $status = 3;
            }
        	$data = array(
                'description'=>$this->input->post('description'),
                'project'=>$this->input->post('project'),
                'company_id'=>$this->session->userdata('company_id'),
                'department_id'=>$this->session->userdata('department_id'),
                'team_id'=>$this->session->userdata('team_id'),
                'deadline'=>$this->convertDateFormat($this->input->post('deadline')),
                'plan_start'=>$this->convertDateFormat($this->input->post('plan_start')) ,
                'plan_complete'=>$this->convertDateFormat($this->input->post('plan_complete')),
                'actual_start'=>$actual_start,
                'actual_complete'=>$actual_complete,
                'priority'=>$this->input->post('priority'),
                'weight'=>$this->input->post('weight'),
                'remarks'=>$this->input->post('remarks'),
                'status'=> $status,
                'last_change'=>date('Y-m-d H:i:s'),
                'changed_by'=>$this->session->userdata['id']

            );
            $edit = $this->model_tasks->update($data, $id);
        	if($edit == true) {
                $this->session->set_flashdata('success', 'Successfully updated task!');
        		$response['success'] = true;
	        	$response['messages'] = 'Succesfully updated task!';
        	}
        	else {
                $this->session->set_flashdata('false', 'Error in database while updating task!');
        		$response['success'] = false;
	        	$response['messages'] = 'Error in database while updating task';
        	}
        }
        else {
            $this->session->set_flashdata('errors', 'Error in data validation while updating user!!!!');
            $response['success'] = false;
            $response['messages'] = 'Error in data validation while updating user!';
        }	
        echo json_encode($response);
    }

    public function update($id)
    {
        $data = $this->input->post();
        
        $data['last_change'] = date('Y-m-d H:i:s');
        $data['changed_by'] = $this->session->userdata['id'];

        $update = $this->model_tasks->update($data, $id);
        if($update == true) {
            $this->session->set_flashdata('success', 'Successfully updated task!');
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated task!';
        }
        else {
            $this->session->set_flashdata('false', 'Error in database while updating task!');
            $response['success'] = false;
            $response['messages'] = 'Error in database while updating task';
        }
        
        echo json_encode($response);
    }

    public function approve($id)
    {
        $data = $this->input->post();
        
        $data['approved_date'] = date('Y-m-d H:i:s');
        $data['approved_by'] = $this->session->userdata['id'];

        $update = $this->model_tasks->update($data, $id);
        if($update == true) {
            $this->session->set_flashdata('success', 'Successfully updated task!');
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated task!';
        }
        else {
            $this->session->set_flashdata('false', 'Error in database while updating task!');
            $response['success'] = false;
            $response['messages'] = 'Error in database while updating task';
        }
        
        echo json_encode($response);
    }

    public function disable($id) 
	{		
		if($id) {
						
			$disable = $this->model_tasks->disable($id);
			if($disable == true) {
				$this->session->set_flashdata('success', 'Successfully removed task');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully remove task';
			}
			else {
				$this->session->set_flashdata('error', 'Error in the database while removing task!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while removing task';
			}				
		}
		else {
			$this->session->set_flashdata('error', 'No valid item was selected!');
			$response['success'] = false;
			$response['messages'] = 'No valid item was selected';
		}
		echo json_encode($response);
	}

    #endregion

    #region General functions

    function convertDateFormat($date, $format_from = 'd/m/y', $format_to='y-m-d')
    {        
        $d = $m = $y = '';
        $result = '';
        switch ($format_from){
            case 'd/m/y':
                $temp_date = explode('/', $date) ;
                $d = $temp_date[0];
                $m = $temp_date[1];
                $y = $temp_date[2];
                break;
            default:
                $temp_date = explode('/', $date) ;
                $d = $temp_date[0];
                $m = $temp_date[1];
                $y = $temp_date[2];
                break;
        }

        switch ($format_to){
            case 'y-m-d':
                $result = $y.'-'.$m.'-'.$d;
                break;
            default:
                $result = $y.'-'.$m.'-'.$d;
                break;
        }
        return $result;        
    } 

    function checkNull($input){
        if ($input == null || $input == 0 || trim($input) == ""){
            return null;
        }        
        return trim($input);
        
    }

    function blank($input){
        if ($input == null || $input == 0 || trim($input) == "")
        {
            return '';
        }
        return trim($input);
    }

    function getLatestYears()
    {
        $result = $this->model_tasks->getLatestYears();
        $result_array = array();
        foreach($result as $key=>$value){
            $result_array[] = $value['year'];
        }
        echo json_encode($result_array);
    }

    #endregion
}

?>