<?php

class Tasks extends Admin_Controller
{
    public function __construct()
	{
		parent::__construct();
		$this->not_logged_in();
		
		$this->data['page_title'] = 'Tasks Management';	

        $this->load->model('model_users'); // save user_id when create/ edit/ remove
        $this->load->model('model_notifications');	
        $this->load->model('model_tasks');
    }

    #region render Pages
    public function index()
    {
        $this->session->set_userdata('currentPage','tasks/index');
        $this->render_template('tasks/index', $this->data);
    }  
    #endregion

    #region fetch Data
    public function fetchJobData($fromDate=null,$toDate=null)
    {
        $result = array('data' => array());
        if ($fromDate && $toDate){
            $data = $this->model_tasks->getJobData($fromDate,$toDate);
        } else {
            $data = $this->model_tasks->getJobData();
        }		

		foreach ($data as $key => $value) {
			
            $buttons = '';	
            $status = '';
            $progress='';           

            $buttons.='<div style="width:150px;">';
            $buttons .= '<a href="'.base_url("tasks/detail/".$value["id"]).'") class="btn btn-default" data-toggle="tooltip" title = "View Detail"><i class="fa fa-info-circle"></i></a>';

			if ($value['scan']!=null){
                $buttons .= '<a href="'.base_url($value['scan']).'" class="btn btn-default scan" target="_blank"><i class="fa fa-file-download" data-toggle="tooltip" title = "Scan Draft"></i></a>';
            }

            if ($value['report']!=null){
                $buttons .= '<a href="'.base_url($value['report']).'" class="btn btn-default report" target="_blank"><i class="fa fa-file-pdf" data-toggle="tooltip" title = "Report"></i></a>';
            }
            
            if ($value['certificate']!=null){
                $buttons .= '<a href="'.base_url($value['certificate']).'" class="btn btn-default certificate" target="_blank"><i class="fa fa-award" data-toggle="tooltip" title = "Certificate"></i></a>';
            }            
            
            $buttons.='</div>';            

            if ($value['status'] == '1'){
                $status = '<span class="label label-success">Approved</span>';
            } elseif ($value['status'] == '0') {
                $status = '<span class="label label-default">Not yet started</span>';
            } elseif ($value['status'] == '2') {
                $status = '<span class="label label-danger">Rejected</span>';
            }else if ($value['status'] == '3') {
                $status = '<span class="label label-info">Completed</span>';
            }else if ($value['status'] == '4') {
            $status = '<span class="label label-primary">Retuned</span>';
            }else if ($value['status'] == '5') {
                $status = '<span class="label label-warning">Ongoing</span>';
            }else {
                $status = '<span class="label label-default">Idle</span>';
            }

            $progress = array($value['completed']*100/$value['total'], $value['completed'].'/'.$value['total']) ;
            $parent_job = substr($value['job_no'],0,9);
            $parent_request = substr($value['request_no'],0,9);
			$result['data'][$key] = array(				
                $buttons,
				$value['job_no'],
                $value['request_no'],
                $status,						
                $progress,
                $value['comment'],
                date('d/m/Y', strtotime($value['created_date']))  ,
                $value['id'],
                $value['isChildren'],	
                $parent_job,
                $parent_request			
			);
        } // /foreach
        
		// echo $result;
		echo json_encode($result);
    }    

    public function fetchJobDetail($id)
    {
        $task_data = $this->model_tasks->getJobData($id);
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
                    $status = '<span class="label label-success">Approved</span>';
                } elseif ($task_data[$value[0].$col[2]] == '0') {
                    $status = '<span class="label label-default">Not yet started</span>';
                } elseif ($task_data[$value[0].$col[2]] == '2') {
                    $status = '<span class="label label-danger">Rejected</span>';
                }else if ($task_data[$value[0].$col[2]] == '3') {
                    $status = '<span class="label label-primary">Completed</span>';
                } else if ($task_data[$value[0].$col[2]] == '4') {
                    $status = '<span class="label label-danger">Retuned</span>';
                }else if ($task_data[$value[0].$col[2]] == '5') {
                    $status = '<span class="label label-warning">Ongoing</span>';
                }else {
                    $status = '<span class="label label-default">Idle</span>';
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

    public function fetchMultiSubDetail($id)
    {
        $task_data = $this->model_tasks->getJobData($id);
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
                    $status = '<span class="label label-success">Approved</span>';
                } elseif ($task_data[$value[0].$col[2]] == '0') {
                    $status = '<span class="label label-default">Not yet started</span>';
                } elseif ($task_data[$value[0].$col[2]] == '2') {
                    $status = '<span class="label label-danger">Rejected</span>';
                }else if ($task_data[$value[0].$col[2]] == '3') {
                    $status = '<span class="label label-primary">Completed</span>';
                } else if ($task_data[$value[0].$col[2]] == '4') {
                    $status = '<span class="label label-danger">Retuned</span>';
                }else if ($task_data[$value[0].$col[2]] == '5') {
                    $status = '<span class="label label-warning">Ongoing</span>';
                }else {
                    $status = '<span class="label label-default">Idle</span>';
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
    
    #endregion

    #region Test Info
    public function getTestInfo($id, $test_type)
    {
        $task_info = $this->model_tasks->getTestInfo($id, $test_type);               
		echo json_encode($task_info);
    }

    public function saveTestInfo($id, $test_type)
    {
        $data = array(
            'temperature' =>$this->input->post('temperature'),
            'humidity' =>$this->input->post('humidity'),
            'test_machine' =>$this->input->post('test_machine'),
            'test_speed' =>$this->input->post('test_speed'),
            'test_method' =>$this->input->post('test_method'),
            'description' =>htmlspecialchars_decode($this->input->post('description')) ,
            'bend_angle' =>$this->input->post('bend_angle'),
            'load_test' =>$this->input->post('load_test'),
            'images' =>$this->input->post('images'),
            'tested_time'=>date('Y-m-d h:i:s'),
            'tested_by'=>$this->session->userdata['id'],
        );

        $save = $this->model_tasks->saveTestInfo($id, $test_type, $data);
        if($save == true) {
            $this->session->set_flashdata('success', 'Successfully save data');
            $response['success'] = true;
            $response['messages'] = 'Succesfully save data';
        }
        else {
            $this->session->set_flashdata('error', 'Error occurred!!');
            $response['success'] = false;
            $response['messages'] = 'Error in the database while saving data';
        }	
        
        echo json_encode($response);
    }
    #endregion

    #region Tests fetch and save data
    public function fetchTestTable($task_id, $table_name)
    {
        $data = $this->model_tasks->getTestData($table_name,$task_id);
        $result = array('data' => array()); 
        
        switch ($table_name )
        {
            case 'test_tensile':
            case 'test_weld_tensile':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(				
                        $value['specimen'],
                        $value['thickness'],
                        $value['width'],
                        $value['diameter'],
                        $value['gauge_length'],
                        $value['elongation'],
                        $value['reduction_in_area'],
                        $value['yield_strength'],
                        $value['tensile_strength'],
                        $value['location_break'],
                        $value['id'],            
                    );
                }
                break;
            case 'test_bend':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(				
                        $value['specimen'],
                        $value['thickness'],
                        $value['width'],
                        $value['former_dia'],
                        $value['typeof_bend'],
                        $value['result'],
                        $value['remarks'],
                        $value['id'],            
                    );
                }
                break;
            case 'test_charpy_impact':
                    foreach ($data as $key=>$value)
                    {                                 
                        $result['data'][] = array(			
                            $value['v_notch_position'],                        
                            $value['specimen'],
                            $value['size'],
                            $value['test_temperature'],
                            $value['single_value'],
                            $value['average'],
                            $value['lateral_expansion'],
                            $value['shear_percentage'],
                            $value['id'],            
                        );
                    }
                    break;
            case 'test_macro':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(			
                        $value['specimen'],                        
                        $value['position'],
                        $value['magnification'],
                        $value['result'],
                        $value['remarks'],
                        $value['id'],            
                    );
                }
                break;
            case 'test_chemical':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(	
                        $value['specimen'],		
                        $value['C'],                        
                        $value['Si'],
                        $value['Mn'],
                        $value['P'],
                        $value['S'],
                        $value['Cr'],
                        $value['Ni'],
                        $value['Mo'],
                        $value['Al'],
                        $value['Cu'],
                        $value['Co'],
                        $value['Ti'],
                        $value['Nb'],
                        $value['V'],
                        $value['N'],
                        $value['id'],            
                    );
                }
                break;
            case 'test_hardness':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(			
                        $value['specimen'],                        
                        $value['table_name'],
                        $value['table_data'],
                        $value['hardness_type'],
                        $value['points_qty'],
                        $value['rows_config'],
                        $value['points_config'],
                        $value['id'],
                        $value['image']
                               
                    );
                }
                break;
            case 'test_nick_break':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(			
                        $value['specimen'],                        
                        $value['thickness'],
                        $value['width'],                        
                        $value['result'],
                        $value['remarks'],
                        $value['id'],                 
                    );
                }
                break;
            case 'test_weld_nick_break':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(	
                        $value['specimen'],		
                        $value['thickness'],
                        $value['width'],                        
                        $value['result'],
                        $value['remarks'],
                        $value['id'],                 
                    );
                }
                break;
            case 'test_micro':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(			
                        $value['specimen'], 
                        $value['description'],
                        $value['magnification'],
                        $value['result'],
                        $value['remarks'],
                        $value['id'],            
                    );
                }
                break;
            case 'test_ferrit':
                foreach ($data as $key=>$value)
                {                                 
                    $result['data'][] = array(			
                        $value['specimen'],                        
                        $value['n'],
                        $value['pt'],
                        $value['points_qty'],
                        $value['est_vol'],                        
                        $value['table1'],
                        $value['table2'],
                        $value['table3'],
                        $value['table4'],
                        $value['table5'],
                        $value['table6'],
                        $value['table7'],
                        $value['table8'],
                        $value['table9'],
                        $value['id']           
                    );
                }
                break;
            case 'test_corrosion':

                break;
        }
        
		echo json_encode($result);
    }

    public function saveTestTable($test_table_id, $table_name)
    {
        switch ($table_name)
        {
            case 'test_tensile':
            case 'test_weld_tensile':
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'thickness'=>$this->input->post('thickness'),
                    'width'=>$this->input->post('width'),
                    'diameter'=>$this->input->post('diameter'),
                    'gauge_length'=>$this->input->post('gauge_length'),
                    'elongation'=>$this->input->post('elongation'),
                    'reduction_in_area'=>$this->input->post('reduction_in_area'),
                    'yield_strength'=>$this->input->post('yield_strength'),
                    'tensile_strength'=>$this->input->post('tensile_strength'),
                    'location_break'=>$this->input->post('location_break'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_bend':
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'thickness'=>$this->input->post('thickness'),
                    'width'=>$this->input->post('width'),
                    'former_dia'=>$this->input->post('former_dia'),
                    'typeof_bend'=>$this->input->post('typeof_bend'),
                    'result'=>$this->input->post('result'),
                    'remarks'=>$this->input->post('remarks'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_charpy_impact':
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'v_notch_position'=>$this->input->post('v_notch_position'),
                    'size'=>$this->input->post('size'),
                    'test_temperature'=>$this->input->post('test_temperature'),
                    'single_value'=>$this->input->post('single_value'),
                    'average'=>$this->input->post('average'),
                    'lateral_expansion'=>$this->input->post('lateral_expansion'),
                    'shear_percentage'=>$this->input->post('shear_percentage'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_macro':                
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'position'=>$this->input->post('position'),
                    'magnification'=>$this->input->post('magnification'),
                    'result'=>$this->input->post('result'),
                    'remarks'=>$this->input->post('remarks'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_chemical':                
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'C'=>$this->input->post('C'),
                    'Si'=>$this->input->post('Si'),
                    'Mn'=>$this->input->post('Mn'),
                    'P'=>$this->input->post('P'),
                    'S'=>$this->input->post('S'),
                    'Cr'=>$this->input->post('Cr'),
                    'Ni'=>$this->input->post('Ni'),
                    'Mo'=>$this->input->post('Mo'),
                    'Al'=>$this->input->post('Al'),
                    'Cu'=>$this->input->post('Cu'),
                    'Co'=>$this->input->post('Co'),
                    'Ti'=>$this->input->post('Ti'),
                    'Nb'=>$this->input->post('Nb'),
                    'V'=>$this->input->post('V'),
                    'N'=>$this->input->post('N'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_hardness':                
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'table_name'=>$this->input->post('table_name'),
                    'hardness_type'=>$this->input->post('hardness_type'),
                    'points_qty'=>$this->input->post('points_qty'),
                    'rows_config'=>$this->input->post('rows_config'),
                    'points_config'=>$this->input->post('points_config'),
                    'table_rows'=>$this->input->post('table_rows'),
                    'table_data'=>htmlspecialchars_decode($this->input->post('table_data')),
                    'image'=>$this->input->post('image'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_nick_break':                
            case 'test_weld_nick_break':
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'thickness'=>$this->input->post('thickness'),
                    'width'=>$this->input->post('width'),
                    'result'=>$this->input->post('result'),
                    'remarks'=>$this->input->post('remarks'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_micro':
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'description'=>$this->input->post('description'),
                    'magnification'=>$this->input->post('magnification'),
                    'result'=>$this->input->post('result'),
                    'remarks'=>$this->input->post('remarks'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_ferrit':
                $data = array(
                    'specimen'=>$this->input->post('specimen'),
                    'n'=>$this->input->post('n'),
                    'pt'=>$this->input->post('pt'),
                    'points_qty'=>$this->input->post('points_qty'),
                    'est_vol'=>$this->input->post('est_vol'),
                    'table1'=>$this->input->post('table1'),
                    'table2'=>$this->input->post('table2'),
                    'table3'=>$this->input->post('table3'),
                    'table4'=>$this->input->post('table4'),
                    'table5'=>$this->input->post('table5'),
                    'table6'=>$this->input->post('table6'),
                    'table7'=>$this->input->post('table7'),
                    'table8'=>$this->input->post('table8'),
                    'table9'=>$this->input->post('table9'),
                    'estvol_rows'=>$this->input->post('estvol_rows'),
                    'tablerows1'=>$this->input->post('tablerows1'),
                    'tablerows2'=>$this->input->post('tablerows2'),
                    'tablerows3'=>$this->input->post('tablerows3'),
                    'tablerows4'=>$this->input->post('tablerows4'),
                    'tablerows5'=>$this->input->post('tablerows5'),
                    'tablerows6'=>$this->input->post('tablerows6'),
                    'tablerows7'=>$this->input->post('tablerows7'),
                    'tablerows8'=>$this->input->post('tablerows8'),
                    'tablerows9'=>$this->input->post('tablerows9'),
                    'tested_time'=>date('Y-m-d h:i:s'),
                    'tested_by'=>$this->session->userdata['id'],
                );
                break;
            case 'test_corrosion':

                break;
            }
        

        $save = $this->model_tasks->updateTest($data,$test_table_id,$table_name);
        if($save == true) {
            $this->session->set_flashdata('success', 'Successfully save data');
            $response['success'] = true;
            $response['messages'] = 'Succesfully save data';
        }
        else {
            $this->session->set_flashdata('error', 'Error occurred!!');
            $response['success'] = false;
            $response['messages'] = 'Error in the database while saving data';
        }	
        
        echo json_encode($response);
    } 

    #endregion

    #region Test types
    public function tensile($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $tensile_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_tensile WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $tensile = $this->model_tasks->createTest("test_tensile", $tensile_data);
            }
        }
        
        $this->render_template('tasks/tensile', $this->data);
    }     

    public function weld_tensile($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $weld_tensile_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_weld_tensile WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $weldTensile = $this->model_tasks->createTest("test_weld_tensile", $weld_tensile_data);
            }
        }
        
        $this->render_template('tasks/weld_tensile', $this->data);
    }    

    public function bend($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $bend_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_bend WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $bend = $this->model_tasks->createTest("test_bend", $bend_data);
            }
        }
        
        $this->render_template('tasks/bend', $this->data);
    }     

    public function charpy_impact($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $ci_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_charpy_impact WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $ci = $this->model_tasks->createTest("test_charpy_impact", $ci_data);
            }
        }
        
        $this->render_template('tasks/charpy_impact', $this->data);
    }     

    public function hardness($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;

        // $hardness_data = $this->model_hardness->getData();
        // $this->data['hardness_data']=$hardness_data;

        $this->session->set_userdata('currentPage','tasks/index');
        $ci_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_hardness WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $ci = $this->model_tasks->createTest("test_hardness", $ci_data);
            }
        }

        // $hardness = $query->result_array();
        // $this->data['hardness'] = json_encode($hardness) ;
        
        $this->render_template('tasks/hardness', $this->data);
    }     

    public function macro($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $macro_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_macro WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $macro = $this->model_tasks->createTest("test_macro", $macro_data);
            }
        }
        
        $this->render_template('tasks/macro', $this->data);
    }     
 
    public function chemical($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $chemical_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_chemical WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $chemical = $this->model_tasks->createTest("test_chemical", $chemical_data);
            }
        }
        
        $this->render_template('tasks/chemical', $this->data);
    }     

    public function nick_break($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $nick_break_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_nick_break WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $nick_break = $this->model_tasks->createTest("test_nick_break", $nick_break_data);
            }
        }
        
        $this->render_template('tasks/nick_break', $this->data);
    }     

    public function weld_nick_break($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $weld_nick_break_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_weld_nick_break WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $weld_nick_break = $this->model_tasks->createTest("test_weld_nick_break", $weld_nick_break_data);
            }
        }
        
        $this->render_template('tasks/weld_nick_break', $this->data);
    }     

    public function micro($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $macro_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_micro WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $macro = $this->model_tasks->createTest("test_micro", $macro_data);
            }
        }
        
        $this->render_template('tasks/micro', $this->data);
    }     

    public function ferrit($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $ferrit_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_ferrit WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $ferrit_content = $this->model_tasks->createTest("test_ferrit", $ferrit_data);
            }
        }
        
        $this->render_template('tasks/ferrit', $this->data);
    }     

    public function corrosion($task_id, $qty)
    {
        $task_data = $this->model_tasks->getJobData($task_id);
        $this->data['task_data'] = $task_data;
        $this->session->set_userdata('currentPage','tasks/index');
        $corrosion_data = array('task_id'=>$task_data["id"]);

        $sql = 'SELECT * FROM test_corrosion WHERE task_id=?';
        $query = $this->db->query($sql,array($task_id));
        $num = $query->num_rows();

        if ($num == 0){
            for ($i=0; $i<$qty; $i++)
            {   
                $pitting_corrosion = $this->model_tasks->createTest("test_corrosion", $corrosion_data);
            }
        }
        
        $this->render_template('tasks/pitting_corrosion', $this->data);
    }     
    #endregion

    

    #region AJAX
    public function updateStatus($id, $column, $status)
    {
        $task = $this->model_tasks->getJobData($id);
        $tests = array('tensile', 'weld_tensile', 'bend', 'charpy_impact', 'hardness', 'macro', 'chemical', 'nick_break', 'weld_nick_break', 'micro', 'ferrit', 'corrosion', 'ndt');
        $completed = 0;
        foreach($tests as $k=>$v){
            if ($task[$v."_status"] == '3' || $task[$v."_status"] == '1'){
                $completed += 1;
            } 
            if ($column == $v."_status"){
                if ($task[$v."_status"] == '3' && $status !='3'){
                    $completed -= 1;
                }
                else if ($task[$v."_status"] != 3 && $status == '3'){
                    $completed += 1;
                }
            }  
        }  
        $data = array(
            $column => $status,
            'completed' => $completed,
            'last_change'=>date('Y-m-d h:i:s'), 
            'changed_by' => $this->session->userdata('id')
        );
        $save = $this->model_tasks->update($data, $id);  
        if($save == true) {
            // $this->session->set_flashdata('success', 'Successfully update status');
            $response['success'] = true;
            $response['messages'] = 'Succesfully update status data';
        }
        else {
            // $this->session->set_flashdata('error', 'Error occurred!!');
            $response['success'] = false;
            $response['messages'] = 'Error in the database while updating status';
        }	
        
        echo json_encode($response);  
    }

    public function updateStatusReport($jobno, $status)
    {
        $data = array(
            'status' => $status,
            'last_change'=>date('Y-m-d h:i:s'), 
            'changed_by' => $this->session->userdata('id')
        );
        $save = $this->model_reports->updateStatus($data, $jobno);  
        if($save == true) {
            // $this->session->set_flashdata('success', 'Successfully update status');
            $response['success'] = true;
            $response['messages'] = 'Succesfully update status data';
        }
        else {
            // $this->session->set_flashdata('error', 'Error occurred!!');
            $response['success'] = false;
            $response['messages'] = 'Error in the database while updating status';
        }	
        
        echo json_encode($response);
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

    #region upload

    public function upload_image($upload_path, $file_name)
    {		
		// $file_name = str_replace('.','_',$file_name);
		if (!empty($_FILES['img-file'])) {
			$this->load->library('upload');
			$config = array(
			'upload_path' => 'images/tasks/'. $upload_path,
			'allowed_types' => "gif|jpg|png|jpeg",
            'overwrite' => TRUE,
            'remove_spaces'=>FALSE,
			'max_size' => "4096000", // Can be set to particular file size , here it is 4 MB(4096 Kb)
			'max_height' => "10000",
			'max_width' => "10000",	
			'file_name' =>	$file_name,
			);
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('img-file'))
			{					
				$uploadData = $this->upload->data();
                $data["image"] = $uploadData['file_name'];
                $this->session->set_flashdata('success', 'Successfully uploaded');
                $response['success'] = true;
                $response['messages'] = 'Succesfully upload image';
                
                // redirect('users/profile','refresh');
                
			}
			else
			{
				$error = implode(';',array('error' => $this->upload->display_errors()));
                $this->session->set_flashdata('error', $error);
                $response['success'] = false;
	        	$response['messages'] = $error;
               echo 'failed';
				// return false;
			}
        }
        else {
            
            $this->session->set_flashdata('error', 'No file selected');            
            $response['success'] = false;
            $response['messages'] = 'No file seleted for uploading image';
            echo 'no file';
            return false;
            
        }

        echo json_encode($response);
		
    }

    public function upload_scan($id, $file_name)
    {	
		// $file_name = str_replace('.','_',$file_name);
		if (!empty($_FILES['upload-file'])) {
			$this->load->library('upload');
			$config = array(
			'upload_path' => 'scan/tasks',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'remove_spaces'=>FALSE,
			'max_size' => "94096000", // Can be set to particular file size , here it is 94 MB(94096 Kb)
			'max_height' => "3840",
			'max_width' => "4320",	
			'file_name' => str_replace('.','_',$file_name)	,
			);
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('upload-file'))
			{					
				$uploadData = $this->upload->data();
                // $data["image"] = $uploadData['file_name'];
                $this->session->set_flashdata('success', 'Successfully uploaded');
                $response['success'] = true;
                $response['messages'] = 'Succesfully upload scan';
                
                $data = array('scan'=>'scan/tasks/'.$file_name);
                $this->model_tasks->update($data, $id);
                
			}
			else
			{
				$error = implode(';',array('error' => $this->upload->display_errors()));
                $this->session->set_flashdata('error', $error);
                $response['success'] = false;
	        	$response['messages'] = $error;

			}
        }
        else {
            
            $this->session->set_flashdata('error', 'No file selected');            
            $response['success'] = false;
            $response['messages'] = 'No file seleted for uploading image';
            // echo 'no file';
            return false;
            
        }

        echo json_encode($response);
		
    }

    public function upload_report($id, $file_name)
    {		
		// $file_name = str_replace('.','_',$file_name);
		if (!empty($_FILES['upload-file'])) {
			$this->load->library('upload');
			$config = array(
			'upload_path' => 'scan/tasks',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'remove_spaces'=>FALSE,
			'max_size' => "94096000", // Can be set to particular file size , here it is 94 MB(94096 Kb)
			'max_height' => "3840",
			'max_width' => "4320",	
			'file_name' =>	$file_name,
			);
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('upload-file'))
			{					
				$uploadData = $this->upload->data();
                // $data["image"] = $uploadData['file_name'];
                $this->session->set_flashdata('success', 'Successfully uploaded');
                $response['success'] = true;
                $response['messages'] = 'Succesfully upload scan';
                
                $data = array('report'=>'scan/tasks/'.$file_name);
                $this->model_tasks->update($data, $id);
                
			}
			else
			{
				$error = implode(';',array('error' => $this->upload->display_errors()));
                $this->session->set_flashdata('error', $error);
                $response['success'] = false;
	        	$response['messages'] = $error;

			}
        }
        else {
            
            $this->session->set_flashdata('error', 'No file selected');            
            $response['success'] = false;
            $response['messages'] = 'No file seleted for uploading image';
            // echo 'no file';
            return false;
            
        }

        echo json_encode($response);
		
    }

    public function upload_certificate($id, $file_name)
    {		
		// $file_name = str_replace('.','_',$file_name);
		if (!empty($_FILES['upload-file'])) {
			$this->load->library('upload');
			$config = array(
			'upload_path' => 'scan/tasks',
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
            'overwrite' => TRUE,
            'remove_spaces'=>FALSE,
			'max_size' => "94096000", // Can be set to particular file size , here it is 94 MB(94096 Kb)
			'max_height' => "3840",
			'max_width' => "4320",	
			'file_name' =>	$file_name,
			);
			// $this->load->library('upload', $config);
			$this->upload->initialize($config);
			if($this->upload->do_upload('upload-file'))
			{					
				$uploadData = $this->upload->data();
                // $data["image"] = $uploadData['file_name'];
                $this->session->set_flashdata('success', 'Successfully uploaded');
                $response['success'] = true;
                $response['messages'] = 'Succesfully upload scan';
                
                $data = array('certificate'=>'scan/tasks/'.$file_name);
                $this->model_tasks->update($data, $id);
                
			}
			else
			{
				$error = implode(';',array('error' => $this->upload->display_errors()));
                $this->session->set_flashdata('error', $error);
                $response['success'] = false;
	        	$response['messages'] = $error;

			}
        }
        else {
            
            $this->session->set_flashdata('error', 'No file selected');            
            $response['success'] = false;
            $response['messages'] = 'No file seleted for uploading image';
            // echo 'no file';
            return false;
            
        }

        echo json_encode($response);
		
    }

    #endregion

    



    
    #endregion
}


?>