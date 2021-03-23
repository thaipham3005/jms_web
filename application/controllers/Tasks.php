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
    }

    #region render Pages
    public function member_tasks()
    {
        $this->session->set_userdata('currentPage','tasks/member_tasks');
        $this->render_template('tasks/member_tasks', $this->data);
    }  

    public function team_tasks()
    {
        $this->session->set_userdata('currentPage','tasks/team_tasks');
        $this->render_template('tasks/team_tasks', $this->data);
    } 
    #endregion

    #region fetch Data
    public function fetchTaskById($task_id){
        
    }

    public function fetchTaskDataByUser($user_id, $year=null,$month=null)
    {
        $result = array('data' => array());
        if ($year && $month){
            $fromDate = strtotime("$year-$month-1");
            $lastDayOfMonth = cal_day_in_month(CAL_GREGORIAN, $month, $year);
            $toDate = strtotime("$year-$month-$lastDayOfMonth");
    
            $data = $this->model_tasks->getTaskDataByUser($user_id, $fromDate, $toDate);
        } else {
            $m = date("m");
            $y = date("Y");
            $fromDate = strtotime($y."-".$m."-1");
            $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $m, $y);
            $toDate = strtotime("$y-$m-$lastDayOfMonth");

            $data = $this->model_tasks->getTaskDataByUser($user_id, $fromDate, $toDate);

        }        	

		foreach ($data as $key => $value) {
			
            $buttons = $status = $rating = $pic = '';

            $buttons.= '<div style="width:50px;">';            
            $button .= '<button class="btn btn-outline-default"><i class="fas fa-info"></i></button>';
            $buttons.= '</div>'; 
                
            if ($value['status'] == '0') {
                $status = '<span class="badge badge-secondary">Not yet started</span>';
            } elseif ($value['status'] == '1') {
                $status = '<span class="badge badge-info">Ongoing</span>';
            }else if ($value['status'] == '2') {
                $status = '<span class="badge badge-primary">Completed</span>';
            }else if ($value['status'] == '3') {
                $status = '<span class="badge badge-danger">Overdue</span>';
            }else if ($value['status'] == '4') {
                $status = '<span class="badge badge-success">Approved</span>';
            }else {
                $status = '<span class="badge badge-secondary">Idle</span>';
            }
            $pic = '<img src="'.base_url("avatar").'"></img>';
            $rating = '';

            $result['data'][$key] = array(				
                $buttons,

                $value['project'],
				$value['description'],
                date('d/m/Y', strtotime($value['deadline']))  ,
                $value['weight'],
                $value['priority'],
                $status,						
                $value['assigned_by'],
                $value['remarks'],
                $rating,

                $value['id'],
                		
			);
        } // /foreach
        
		// echo $result;
		echo json_encode($result);
    }    

    public function fetchTaskDetail($id)
    {
        $task_data = $this->model_tasks->getTaskData($id);
        $result = array('data' => array()); 
        $test = array(
            array('tensile','Tensile Test'),
            array('weld_tensile','All Weld Tensile Test'),
            array('bend','Bend test'),
            array('charpy_impact','Charpy Impact Test'),
            array('hardness', 'Hardness Test'), 
            array('macro' ,'Macro Test'),
            array('chemical','Chemical Test'),
            array('nick_break','Nick Break Test'),
            array('weld_nick_break','Fillet Weld Nick Break Test'),
            array('micro','Micro Test'),
            array('ferrit','Ferrit Content Test'),
            array('corrosion','Pitting Corrosion Test'),
            array('ndt','NDT'));

        $col = array('','_qty','_status','_comment');
		$count=0;
        foreach ($test as $key=>$value)
        {            
            if ($task_data[$value[0]] == '1')
            {
                $buttons = '';	
                $status = '';
                $count +=1;

                $buttons.='<div style="width:100px;">';
                if (in_array('performTasks', $this->permission)){    
                    $buttons .= '<a href="'.base_url("tasks/".$value[0]."/".$task_data["id"].'/'.$task_data[$value[0].$col[1]].'") class="btn btn-default" data-toggle="tooltip" title = "Proceed testing"><i class="fa fa-play"></i></a>');  
                    
                    // $buttons .= '<button role="button" id="complete" class="btn btn-default"><i class="fa fa-check-circle"></i></button>'; 

                    // $buttons .= '<button role="button" id="return" class="btn btn-default"><i class="fa fa-undo-alt"></i></button>'; 
                }
                $buttons .= '</div>';
                

                if ($task_data[$value[0].$col[2]] == '1'){
                    $status = '<span class="badge badge-success">Approved</span>';
                } elseif ($task_data[$value[0].$col[2]] == '0') {
                    $status = '<span class="badge badge-secondary">Not yet started</span>';
                } elseif ($task_data[$value[0].$col[2]] == '2') {
                    $status = '<span class="badge badge-danger">Rejected</span>';
                }else if ($task_data[$value[0].$col[2]] == '3') {
                    $status = '<span class="badge badge-primary">Completed</span>';
                } else if ($task_data[$value[0].$col[2]] == '4') {
                    $status = '<span class="badge badge-danger">Retuned</span>';
                }else if ($task_data[$value[0].$col[2]] == '5') {
                    $status = '<span class="badge badge-warning">Ongoing</span>';
                }else {
                    $status = '<span class="badge badge-secondary">Idle</span>';
                }
                $comment_col = $value[0].$col[3];
                $qty = $task_data[$value[0].$col[1]];
                $comment = $task_data[$comment_col];
                $id = $task_data['id'];
                
                $result['data'][] = array(				
                    $buttons,
                    $value[1],
                    $qty,
                    $status,    
                    $comment,   
                    //hid these columns
                    $id,
                    $comment_col,     
                    $value[0],
                );
                
            }
    
        }
		echo json_encode($result);
    }    

    

    public function countNewTasks()
    {
        $count = $this->model_tasks->countNewTasks();
        echo $count;
    }

    public function pushComment($id, $col, $content)
    {
        $content = ($content!="")? $content: null;
        $data = array(
            // $col => $content, 
            $col => $this->input->post('comment'),
            'last_change'=>date('Y-m-d h:i:s'), 
            'changed_by' => $this->session->userdata('id')
        );
        $comment = $this->model_tasks->update($data,$id);
        if ($comment == true){
            $this->session->set_flashdata('success', 'Successfully comment');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully comment';
        }else {
            $this->session->set_flashdata('error', 'Error occurred!!');
            $response['success'] = false;
            $response['messages'] = 'Error in the database while comment';
        }

        echo json_encode($response);
    }

    function checkNull($input){
        if ($input == null || $input == 0 || trim($input) == ""){
            return null;
        }
        else {
            return trim($input);
        }
    }

    
}

?>