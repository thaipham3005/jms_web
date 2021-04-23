<?php

class Reports extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		
		$this->data['page_title'] = 'Tasks Management';	

        $this->load->model('model_users'); 
        $this->load->model('model_tasks');	
        $this->load->model('model_reports');
    }

    public function team_reports()
    {
        $this->session->set_userdata('currentPage','reports/team_reports');
        $this->render_template('reports/team_reports', $this->data);
    }

    public function department_reports()
    {
        $this->session->set_userdata('currentPage','reports/department_reports');
        $this->render_template('reports/department_reports', $this->data);
    }

    #region fetch Data  
    public function fetchReportByUser($user_id, $year=null,$month=null)
    {  
        if ($year && $month){                
            $data = $this->model_reports->getReportByUser($user_id, $year, $month);   
            echo json_encode($data);     
        } 
		
    }  

    public function fetchReportByTeam($team_id, $year=null,$month=null)
    {  
        $result = array("data"=>array());
        if ($year && $month){                
            $data = $this->model_reports->getReportByTeam($team_id, $year, $month);  
            foreach ($data as $key=>$value) {
                $buttons = "";
                $buttons .='<button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#reportEditModal"><i class="fas fa-award fa-fw"></i></button>';

                $regulation = '';
                switch ($value["regulation"]){
                    case '':
                        $regulation = 0;
                        break;
                    case '0':
                        $regulation = 0;
                        break;
                    case '1':
                        $regulation = 20;
                        break;
                    case '2':
                        $regulation = 25;
                        break;
                    case '3':
                        $regulation = 30;
                        break;
                }

                $result["data"][]= array(
                    $buttons,
                    $value["full_name"],
                    $value["total"],
                    $value["completed"],
                    $value["ongoing"],
                    $value["overdue"],
                    $value["missdeadline"],
                    $regulation,
                    $value["overall"],
                    $value["month_score"],
                    $value["award"],
                    $value["remarks"],
                    $value["id"],
                    $value["award_id"],
                );
            }
            echo json_encode($result);     
        } 
		
    } 

    public function fetchAwardsSelect()
	{		
		$result = '';
        $data = $this->model_reports->getAwardsData();     
        $result .= "<option value = ''>Please select</option>";   		

		foreach ($data as $key => $value) {	
            $result .= "<option value = ".$value['id'].">".$value['award']." - Reward ".$value['reward']."</option>";
            
        }
		echo json_encode($result);
	}

    public function fetchReportByDepartment($department_id, $year=null,$month=null)
    {  
        $result = array("data"=>array());
        if ($year && $month){   
            $data = $this->model_reports->getReportByDepartment($department_id, $year, $month);  
            foreach ($data as $key=>$value) {
                $buttons = "";
                $buttons .='<button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#reportEditModal"><i class="fas fa-award fa-fw"></i></button>';

                $regulation = '';
                switch ($value["regulation"]){
                    case '':
                        $regulation = 0;
                        break;
                    case '0':
                        $regulation = 0;
                        break;
                    case '1':
                        $regulation = 20;
                        break;
                    case '2':
                        $regulation = 25;
                        break;
                    case '3':
                        $regulation = 30;
                        break;
                }

                $result["data"][]= array(
                    $buttons,
                    $value["full_name"],                    
                    $regulation,
                    $value["overall"],
                    $value["month_score"],
                    $value["award"],
                    $value["remarks"],
                    $value["id"],
                    $value["award_id"],
                );
            }
            echo json_encode($result);     
        } 
		
    } 

    public function fetchAwardDepartment($award_type, $department_id,$year=null,$month=null)
    {        
        $result = array("data"=>array());
        if ($year && $month){                
            $data = $this->model_reports->getAwardsDepartment($award_type, $department_id, $year, $month);  
            foreach ($data as $key=>$value) {
                $buttons = "";
                $buttons .='<button class="btn btn-xs btn-outline-secondary" data-toggle="modal" data-target="#reportEditModal"><i class="fas fa-award fa-fw"></i></button>';

                $regulation = '';
                switch ($value["regulation"]){
                    case '':
                        $regulation = 0;
                        break;
                    case '0':
                        $regulation = 0;
                        break;
                    case '1':
                        $regulation = 20;
                        break;
                    case '2':
                        $regulation = 25;
                        break;
                    case '3':
                        $regulation = 30;
                        break;
                }

                $result["data"][]= array(
                    $buttons,
                    $value["full_name"],
                    $value["award"],
                    $value["remarks"],
                    $value["id"],
                    $value["award_id"],
                );
            }
            echo json_encode($result);  
        }
    }

    #region CRUD
    public function create()
    {       
        $data = array(
            'user_id'=>$this->input->post('id'),
            'year'=>$this->input->post('year'),
            'month'=>$this->input->post('month'),
            'total'=>$this->input->post('total'),
            'completed'=>$this->input->post('completed'),
            'pending'=>$this->input->post('pending'),
            'overdue'=>$this->input->post('overdue'),
            'regulation'=>$this->input->post('regulation'),
            'overall'=>$this->input->post('overall'),
            // 'award_id'=>$this->input->post('award_id'),
            
            'created_date'=>date('Y-m-d H:i:s'),
            'created_by'=>$this->session->userdata['id']
        );
        $create = $this->model_reports->create($data);
        if($create == true) {            
            $this->session->set_flashdata('success', 'Successfully created task!');
            $response['success'] = true;
            $response['messages'] = 'Succesfully created report!';

        }
        else {
            $this->session->set_flashdata('false', 'Error in database while creating task!');
            $response['success'] = false;
            $response['messages'] = 'Error in database while creating report';
        }
        
        echo json_encode($response);
    }

    public function edit($id)
    {        
        $data = array(
            'user_id'=>$this->input->post('id'),
            'year'=>$this->input->post('year'),
            'month'=>$this->input->post('month'),
            'total'=>$this->input->post('total'),
            'completed'=>$this->input->post('completed'),
            'pending'=>$this->input->post('pending'),
            'overdue'=>$this->input->post('overdue'),
            'regulation'=>$this->input->post('regulation'),
            'overall'=>$this->input->post('overall'),
            // 'award_id'=>$this->input->post('award_id'),
            
            'last_change'=>date('Y-m-d H:i:s'),
            'changed_by'=>$this->session->userdata['id']

        );
        $edit = $this->model_reports->update($data, $id);
        if($edit == true) {
            $this->session->set_flashdata('success', 'Successfully updated report!');
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated report!';
        }
        else {
            $this->session->set_flashdata('false', 'Error in database while updating report!');
            $response['success'] = false;
            $response['messages'] = 'Error in database while updating report';
        }        
        echo json_encode($response);
    }

    public function updateAward($id)
    {        
        $data = array(
            'award_id'=>$this->input->post('award_id'),
            'remarks'=>$this->input->post('remarks'),
            'last_change'=>date('Y-m-d H:i:s'),
            'changed_by'=>$this->session->userdata['id']

        );
        $edit = $this->model_reports->update($data, $id);
        if($edit == true) {
            $this->session->set_flashdata('success', 'Successfully updated report!');
            $response['success'] = true;
            $response['messages'] = 'Succesfully updated report!';
        }
        else {
            $this->session->set_flashdata('false', 'Error in database while updating report!');
            $response['success'] = false;
            $response['messages'] = 'Error in database while updating report';
        }        
        echo json_encode($response);
    }

    public function saveReportByUser($user_id, $year, $month)
    {
        $data = $this->input->post();
        $exist = $this->model_reports->checkReportExist($user_id, $year, $month);
        if (count($exist) > 0){
            $data['last_change'] = date('Y-m-d H:i:s');
            $data['changed_by'] = $this->session->userdata['id'];

            $update = $this->model_reports->update($data, $exist['id']);
            if($update == true) {
                $this->session->set_flashdata('success', 'Successfully updated report!');
                $response['success'] = true;
                $response['messages'] = 'Succesfully updated report!';
            }
            else {
                $this->session->set_flashdata('false', 'Error in database while updating report!');
                $response['success'] = false;
                $response['messages'] = 'Error in database while updating report';
            }
        }
        else {
            $data['created_date'] = date('Y-m-d H:i:s');
            $data['created_by'] = $this->session->userdata['id'];

            $create = $this->model_reports->insert($data);
            if($create == true) {
                $this->session->set_flashdata('success', 'Successfully updated report!');
                $response['success'] = true;
                $response['messages'] = 'Succesfully updated report!';
            }
            else {
                $this->session->set_flashdata('false', 'Error in database while updating report!');
                $response['success'] = false;
                $response['messages'] = 'Error in database while updating report';
            }
        }
        echo json_encode($response);
    }

    public function disable($id) 
	{		
		if($id) {
						
			$disable = $this->model_reports->disable($id);
			if($disable == true) {
				$this->session->set_flashdata('success', 'Successfully removed report');
				$response['success'] = true;
	        	$response['messages'] = 'Succesfully remove report';
			}
			else {
				$this->session->set_flashdata('error', 'Error in the database while removing report!');
				$response['success'] = false;
	        	$response['messages'] = 'Error in the database while removing report';
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

    function checkNull($input)
    {
        if ($input == null || $input == 0 || trim($input) == ""){
            return null;
        }        
        return trim($input);
        
    }

    function blank($input)
    {
        if ($input == null || $input == 0 || trim($input) == "")
        {
            return '';
        }
        return trim($input);
    }

    #endregion


    #region Dashboard
    function dashboardYear($user_id, $year){
        $data = $this->model_reports->summaryYear($user_id, $year); 
        echo json_encode($data); 
    }

    function dashboardMonth($user_id, $year, $month){
        $data = $this->model_reports->summaryMonth($user_id, $year, $month); 
        echo json_encode($data); 
    }

    function dashboardChart($user_id, $year){
        $data = $this->model_reports->performanceYear($user_id, $year); 
        echo json_encode($data); 
    }

    #endregion
}

?>