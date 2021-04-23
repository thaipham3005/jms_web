<?php
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\RichText\RichText;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooter;
use PhpOffice\PhpSpreadsheet\Worksheet\HeaderFooterDrawing;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

class Excel extends Admin_Controller 
{
    public function __construct() {
        parent::__construct();
        $this->load->model('model_tasks');
        $this->load->model('model_users');
        $this->load->model('model_reports');
    }  
    function convertDateFromExcel($cellValue)
    {
        if ($cellValue != null && $cellValue != '') {
            $temp_date =  round(($val - 25569) * 86400);
            return (date('Y-m-d', $temp_date));

        }
    }

    function getRowCount($text, $width=45){
        $rc = 0;
        $line = explode("\n", $text);
        foreach($line as $source) {
            $rc += intval((strlen($source) / $width) +1);
        }
        return $rc;
    }
    
    public function exportBM2($user_id, $year, $month)
    {
        // Open the template file
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $filename = FCPATH.'templates/BM02.xlsx';
        $spreadsheet = $reader->load($filename);

        // Set document properties
        $fullname = $this->session->userdata['full_name'];
        $department = $this->session->userdata['department'];
        $team = $this->session->userdata['team'];
        $position = $this->session->userdata['position'];
        $login_id = $this->session->userdata['login_id'];

        $spreadsheet->getProperties()
        ->setCreator('RioApps')
        ->setLastModifiedBy($fullname)
        ->setTitle('JMS Report for BM02')
        ->setSubject('JMS Report for BM02')
        ->setDescription('JMS Report')
        ->setKeywords('jms spreadsheet report bm02')
        ->setCategory('bm02 report');  

        //Get data by POST method
        $from = "$year-$month-1";
        $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $to = "$year-$month-$lastDayOfMonth";
        $data = $this->model_tasks->getTaskDataByUser($user_id, $from, $to);
        $row_count = count($data);

        //Generate content
        $base1 = 13;
        $base2 = 18;
        $spreadsheet->getActiveSheet()->setCellValue('B10', $fullname);
        $spreadsheet->getActiveSheet()->setCellValue('C10', $login_id);
        $spreadsheet->getActiveSheet()->setCellValue('D10', $position);
        $spreadsheet->getActiveSheet()->setCellValue('F10', $department);
        $spreadsheet->getActiveSheet()->setCellValue('H10', $team);
        $spreadsheet->getActiveSheet()->setCellValue('A6', 'Tháng '.$month.' năm '.$year);

        $spreadsheet->getActiveSheet()->insertNewRowBefore($base2, $row_count);
        for ($i=0; $i< $row_count; $i++){
            $row = $base2+$i;
            $row_height = $this->getRowCount($data[$i]['description']) * 12.5 + 2.5;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i+1);            
            $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $data[$i]['description']);
            $spreadsheet->getActiveSheet()->mergeCells('B'.$row.':C'.$row);
            $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight($row_height);

            $spreadsheet->getActiveSheet()->getStyle('B'.$row.':C'.$row)
            ->getAlignment()->setHorizontal('left');

            $start = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($data[$i]['plan_start']);
            $complete = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($data[$i]['plan_complete']);
            $spreadsheet->getActiveSheet()->setCellValue('F'.$row, $start);
            $spreadsheet->getActiveSheet()->getStyle('F'.$row)
            ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
            $spreadsheet->getActiveSheet()->setCellValue('G'.$row, $complete);
            $spreadsheet->getActiveSheet()->getStyle('G'.$row)
            ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        }
        
        $spreadsheet->getActiveSheet()->insertNewRowBefore($base1, $row_count);
        for ($i=0; $i< $row_count; $i++){
            $row = $base1+$i;
            $row_height = $this->getRowCount($data[$i]['description'], 90) * 12.75 + 2.5;
            $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i+1);            
            $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $data[$i]['description']);
            $spreadsheet->getActiveSheet()->mergeCells('B'.$row.':G'.$row);
            $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight($row_height);
            $spreadsheet->getActiveSheet()->getStyle('B'.$row.':G'.$row)
            ->getAlignment()->setHorizontal('left');

            $spreadsheet->getActiveSheet()->setCellValue('H'.$row, $data[$i]['weight']);
        }

        //Insert Header Footer
        // $spreadsheet->getActiveSheet()
        // ->getHeaderFooter()
        // ->setOddFooter('JMS report - BM02');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $file_name = 'BM02-'.$team.'-'.$year.'-'.$month.' ('.$login_id.').xlsx';
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }

    public function exportBM3($user_id, $year, $month)
    {
        // Open the template file
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $filename = FCPATH.'templates/BM03.xlsx';
        $spreadsheet = $reader->load($filename);

        // Set document properties
        $fullname = $this->session->userdata['full_name'];
        $department = $this->session->userdata['department'];
        $team = $this->session->userdata['team'];
        $position = $this->session->userdata['position'];
        $login_id = $this->session->userdata['login_id'];

        $spreadsheet->getProperties()
        ->setCreator('RioApps')
        ->setLastModifiedBy($fullname)
        ->setTitle('JMS Report for BM02')
        ->setSubject('JMS Report for BM02')
        ->setDescription('JMS Report')
        ->setKeywords('jms spreadsheet report bm02')
        ->setCategory('bm02 report');  

        //Generate content
        $spreadsheet->getActiveSheet()->setCellValue('C8', $fullname);
        $spreadsheet->getActiveSheet()->setCellValue('C9', $login_id);
        $spreadsheet->getActiveSheet()->setCellValue('F8', $position);
        $spreadsheet->getActiveSheet()->setCellValue('F10', $department);
        $spreadsheet->getActiveSheet()->setCellValue('C10', $team);
        $spreadsheet->getActiveSheet()->setCellValue('F11', \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(date($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN, $month, $year))));
        $spreadsheet->getActiveSheet()->getStyle('F11')
        ->getNumberFormat()->setFormatCode('dd/mm/yyyy');

        $data = $this->model_reports->getReportByUser($user_id, $year, $month);
        $regulation = $data["regulation"];
        $overall = $data["overall"];


        if ($regulation == '3'){
            $spreadsheet->getActiveSheet()->setCellValue('D17', '30');
        } 
        else if ($regulation == '2'){
            $spreadsheet->getActiveSheet()->setCellValue('E17', '25');
        }
        else if ($regulation == '1'){
            $spreadsheet->getActiveSheet()->setCellValue('F17', '20');
        }
        else if ($regulation == '0'){
            $spreadsheet->getActiveSheet()->setCellValue('G17', '0');
        }

        if ($overall <= 70 && $overall >= 61){
            $spreadsheet->getActiveSheet()->setCellValue('D15', $overall);
        } 
        else if ($overall <= 60 && $overall >= 51){
            $spreadsheet->getActiveSheet()->setCellValue('E15', $overall);
        }
        else if ($overall <= 50 && $overall >= 1){
            $spreadsheet->getActiveSheet()->setCellValue('F15', $overall);
        }
        else if ($overall == 0){
            $spreadsheet->getActiveSheet()->setCellValue('G15', $overall);
        }

        //Insert Header Footer
        // $spreadsheet->getActiveSheet()
        // ->getHeaderFooter()
        // ->setOddFooter('JMS report - BM02');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $file_name = 'BM03-'.$team.'-'.$year.'-'.$month.' ('.$login_id.').xlsx';
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }

    public function exportTeamBM2($team_id, $year, $month)
    {
        //Get data by POST method
        $from = "$year-$month-1";
        $lastDayOfMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
        $to = "$year-$month-$lastDayOfMonth";

        $all_data = $this->model_tasks->getTaskDataByTeam($team_id, $from, $to);

        if (count($all_data) == 0){
            $this->session->set_flashdata('false', 'No tasks are available for this team');
            $response['success'] = false;
            $response['messages'] = 'No tasks are available for this team';
            redirect(base_url("tasks/team_tasks"));
        }

        // Open the template file
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $filename = FCPATH.'templates/BM02.xlsx';
        $spreadsheet = $reader->load($filename);

        // Set document properties
        $creator = $this->session->userdata['full_name'];

        $spreadsheet->getProperties()
        ->setCreator('RioApps')
        ->setLastModifiedBy($creator)
        ->setTitle('JMS Report for BM02')
        ->setSubject('JMS Report for BM02')
        ->setDescription('JMS Report')
        ->setKeywords('jms spreadsheet report bm02')
        ->setCategory('bm02 report');  

       
        // echo json_encode($all_data);

        $user_tasks = array();
        $users = array();

        for ($i=0; $i < count($all_data); $i++){
            $task = $all_data[$i];
            if (!in_array($task["pic_name"], $users)){
                $users[] = $task["pic_name"];
            }

            $user_tasks[$task["user_id"]][] = $task;
        }
        $ws = 0;

        foreach ($user_tasks as $key=>$data){
            $ws++;
            $sheet = $spreadsheet->getSheet(0)->copy();
            $sheet->setTitle("Worksheet ".$ws);
            $spreadsheet->addSheet($sheet);
            $spreadsheet->setActiveSheetIndex($ws);

            $row_count = count($data);
            $user_id = $key;

            //Generate content
            $base1 = 13;
            $base2 = 18;

            $user_detail = $this->model_users->getUserByID($user_id);

            $fullname =  $user_detail['full_name'];
            $department =  $user_detail['department'];
            $team =  $user_detail['team'];
            $position =  $user_detail['position'];
            $login_id =  $user_detail['login_id'];
            $spreadsheet->getActiveSheet()->setTitle($fullname);

            $spreadsheet->getActiveSheet()->setCellValue('B10', $fullname);
            $spreadsheet->getActiveSheet()->setCellValue('C10', $login_id);
            $spreadsheet->getActiveSheet()->setCellValue('D10', $position);
            $spreadsheet->getActiveSheet()->setCellValue('F10', $department);
            $spreadsheet->getActiveSheet()->setCellValue('H10', $team);
            $spreadsheet->getActiveSheet()->setCellValue('A6', 'Tháng '.$month.' năm '.$year);

            $spreadsheet->getActiveSheet()->insertNewRowBefore($base2, $row_count);
            for ($i=0; $i< $row_count; $i++){
                $row = $base2+$i;
                $row_height = $this->getRowCount($data[$i]['description']) * 12.5 + 2.5;
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i+1);            
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $data[$i]['description']);
                $spreadsheet->getActiveSheet()->mergeCells('B'.$row.':C'.$row);
                $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight($row_height);

                $spreadsheet->getActiveSheet()->getStyle('B'.$row.':C'.$row)
                ->getAlignment()->setHorizontal('left');

                $start = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($data[$i]['plan_start']);
                $complete = \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($data[$i]['plan_complete']);
                $spreadsheet->getActiveSheet()->setCellValue('F'.$row, $start);
                $spreadsheet->getActiveSheet()->getStyle('F'.$row)
                ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
                $spreadsheet->getActiveSheet()->setCellValue('G'.$row, $complete);
                $spreadsheet->getActiveSheet()->getStyle('G'.$row)
                ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
            }
            
            $spreadsheet->getActiveSheet()->insertNewRowBefore($base1, $row_count);
            for ($i=0; $i< $row_count; $i++){
                $row = $base1+$i;
                $row_height = $this->getRowCount($data[$i]['description'], 90) * 12.75 + 2.5;
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i+1);            
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $data[$i]['description']);
                $spreadsheet->getActiveSheet()->mergeCells('B'.$row.':G'.$row);
                $spreadsheet->getActiveSheet()->getRowDimension($row)->setRowHeight($row_height);
                $spreadsheet->getActiveSheet()->getStyle('B'.$row.':G'.$row)
                ->getAlignment()->setHorizontal('left');

                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, $data[$i]['weight']);
            }
        }
        
        $spreadsheet->removeSheetByIndex(0);
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $file_name = 'BM02-'.$team.'-'.$year.'-'.$month.'.xlsx';
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;

    }

    public function exportTeamBM3($team_id, $year, $month)
    {
        //Get data by POST method

        $all_data = $this->model_reports->getReportByTeam($team_id, $year, $month);

        if (count($all_data) == 0){
            $this->session->set_flashdata('false', 'No tasks are available for this team');
            $response['success'] = false;
            $response['messages'] = 'No tasks are available for this team';
            redirect(base_url("tasks/team_tasks"));
        }
        // Open the template file
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $filename = FCPATH.'templates/BM03.xlsx';
        $spreadsheet = $reader->load($filename);

        // Set document properties
        $creator = $this->session->userdata['full_name'];

        $spreadsheet->getProperties()
        ->setCreator('RioApps')
        ->setLastModifiedBy($creator)
        ->setTitle('JMS Report for BM03')
        ->setSubject('JMS Report for BM03')
        ->setDescription('JMS Report')
        ->setKeywords('jms spreadsheet report bm03')
        ->setCategory('bm03 report');

        for ($i = 0; $i < count($all_data); $i++){
            $sheet = $spreadsheet->getSheet(0)->copy();
            $sheet->setTitle("Worksheet ".$i);
            $spreadsheet->addSheet($sheet);
        }

        for ($i = 0; $i < count($all_data); $i++){           
            $spreadsheet->setActiveSheetIndex($i);
            $data = $all_data[$i];

            $user_id = $data["user_id"];

            $user_detail = $this->model_users->getUserByID($user_id);

            $fullname =  $user_detail['full_name'];
            $department =  $user_detail['department'];
            $team =  $user_detail['team'];
            $position =  $user_detail['position'];
            $login_id =  $user_detail['login_id'];
            $first_day =  $user_detail['first_working_day'];
            $spreadsheet->getActiveSheet()->setTitle($fullname);

            //Generate content
            $spreadsheet->getActiveSheet()->setCellValue('C8', $fullname);
            $spreadsheet->getActiveSheet()->setCellValue('C9', $login_id);
            $spreadsheet->getActiveSheet()->setCellValue('F8', $position);
            $spreadsheet->getActiveSheet()->setCellValue('F10', $department);
            $spreadsheet->getActiveSheet()->setCellValue('C10', $team);
            $spreadsheet->getActiveSheet()->setCellValue('C11', \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($first_day));
            $spreadsheet->getActiveSheet()->getStyle('C11')
            ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
            $spreadsheet->getActiveSheet()->setCellValue('F11', \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(date($year.'-'.$month.'-'.cal_days_in_month(CAL_GREGORIAN, $month, $year))));
            $spreadsheet->getActiveSheet()->getStyle('F11')
            ->getNumberFormat()->setFormatCode('dd/mm/yyyy');

            $regulation = $data["regulation"];
            $overall = $data["overall"];

            if ($regulation == '3'){
                $spreadsheet->getActiveSheet()->setCellValue('D17', '30');
            } 
            else if ($regulation == '2'){
                $spreadsheet->getActiveSheet()->setCellValue('E17', '25');
            }
            else if ($regulation == '1'){
                $spreadsheet->getActiveSheet()->setCellValue('F17', '20');
            }
            else if ($regulation == '0'){
                $spreadsheet->getActiveSheet()->setCellValue('G17', '0');
            }

            if ($overall <= 70 && $overall >= 61){
                $spreadsheet->getActiveSheet()->setCellValue('D15', $overall);
            } 
            else if ($overall <= 60 && $overall >= 51){
                $spreadsheet->getActiveSheet()->setCellValue('E15', $overall);
            }
            else if ($overall <= 50 && $overall >= 1){
                $spreadsheet->getActiveSheet()->setCellValue('F15', $overall);
            }
            else if ($overall == 0){
                $spreadsheet->getActiveSheet()->setCellValue('G15', $overall);
            }
        }

        //Insert Header Footer
        // $spreadsheet->getActiveSheet()
        // ->getHeaderFooter()
        // ->setOddFooter('JMS report - BM02');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $file_name = 'BM03-'.$team.'-'.$year.'-'.$month.'.xlsx';
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

    public function exportDeptSummary($department_id, $year, $month)
    {
        //Get data by POST method
        $company_id = $this->session->userdata('company_id');
        $users = $this->model_users->getUserData($company_id, $department_id);
        $all_data = $this->model_reports->getReportByDepartment($department_id, $year, $month);

        if (count($all_data) == 0){
            $this->session->set_flashdata('false', 'No tasks are available for this department');
            $response['success'] = false;
            $response['messages'] = 'No tasks are available for this department';
            redirect(base_url("tasks/team_tasks"));
        }
        // Open the template file
        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader('Xlsx');
        $filename = FCPATH.'templates/Tong ket danh gia.xlsx';
        $spreadsheet = $reader->load($filename);

        // Set document properties

        $spreadsheet->getProperties()
        ->setCreator('RioApps')
        ->setLastModifiedBy('RioApps')
        ->setTitle('JMS Report for summary')
        ->setSubject('JMS Report for summary')
        ->setDescription('JMS Report')
        ->setKeywords('jms spreadsheet report summary')
        ->setCategory('summary report');

        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Tháng '.$month.' năm '.$year);
        $spreadsheet->getActiveSheet()->setCellValue('G24', 'Vũng Tàu, ngày '.cal_days_in_month(CAL_GREGORIAN, $month, $year).' tháng '.$month.' năm '.$year);


        $users_report = array();        
        $excellent_users = array();
        $good_users = array();
        $normal_users = array();
        $excellent = array();
        $good = array();
        $normal = array();
        $teams_total = array();

        // Print out first worksheet
        for ($i=0; $i < count($users); $i++){ 
            $found = array_search($users[$i]['id'], array_column($all_data, 'user_id'));

            if ($found){
                $report = $all_data[$found];
                $users_report[$i] = $report;
            }
            else{
                $users_report[$i] = array();
            }

            if (!array_key_exists($users[$i]['team'], $teams_total)){

                $teams_total[$users[$i]['team']] = 0;;
            } else {
                $teams_total[$users[$i]['team']]++;
            }
        }  

        for ($i=0; $i < count($all_data); $i++){
            if ($all_data[$i]['award_id']=='1' || $all_data[$i]['award_id']=='2'){
                $excellent[] = $all_data[$i];

                $found = array_search($all_data[$i]['user_id'], array_column($users,'id'));
                if ($found){
                    $excellent_users[] = $users[$found];
                }

            } else if ($all_data[$i]['award_id']=='3' || $all_data[$i]['award_id']=='4'){
                $good[] = $all_data[$i];

                $found = array_search($all_data[$i]['user_id'], array_column($users,'id'));
                if ($found){
                    $good_users[] = $users[$found];
                }
            } else {
                $normal[] = $all_data[$i];

                $found = array_search($all_data[$i]['user_id'], array_column($users,'id'));
                if ($found){
                    $normal_users[] = $users[$found];
                }
            }
        }

        $spreadsheet->getActiveSheet()->setCellValue('E17', count($users));
        $spreadsheet->getActiveSheet()->setCellValue('E18', count($excellent));
        $spreadsheet->getActiveSheet()->setCellValue('E19', count($good));
        $spreadsheet->getActiveSheet()->setCellValue('E20', count($normal));

        $spreadsheet->getActiveSheet()->insertNewRowBefore(13, count($teams_total)-1);
        $row = 13;
        foreach ($teams_total as $key=>$value){

            $spreadsheet->getActiveSheet()->setCellValue('E'.$row, $key);
            $spreadsheet->getActiveSheet()->setCellValue('F'.$row, $value);
            $spreadsheet->getActiveSheet()->getStyle('F'.$row)
                ->getNumberFormat()->setFormatCode('#');
            $row++;
        }

        
        $spreadsheet->getActiveSheet()->insertNewRowBefore(10, count($users));
        for ($i = 0; $i < count($users_report); $i++){   
            $row = 9 + $i; 
            $fullname =  $users[$i]['full_name'];
            $position =  $users[$i]['position'];
            $login_id =  $users[$i]['login_id'];
            $first_day =  $users[$i]['first_working_day'];            

            //Generate content
            $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i + 1);
            $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $login_id);
            $spreadsheet->getActiveSheet()->setCellValue('C'.$row, $fullname);
            $spreadsheet->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
            $spreadsheet->getActiveSheet()->setCellValue('E'.$row, $position);
            if ($first_day != null){
                $spreadsheet->getActiveSheet()->setCellValue('F'.$row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($first_day));
                $spreadsheet->getActiveSheet()->getStyle('F'.$row)
                ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
            }

            $data = $users_report[$i];
            if (count($data) == 0){
                continue;
            }  
            
            $month_score = $data['month_score'];
            $spreadsheet->getActiveSheet()->setCellValue('G'.$row, $month_score);
            $spreadsheet->getActiveSheet()->setCellValue('I'.$row, $data['remarks']);

            if ($month_score <= 100 && $month_score >= 98){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 1');
            } 
            else if ($month_score <= 97 && $month_score >= 95){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 2');
            }
            else if ($month_score <= 94 && $month_score >= 90){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 1');
            }
            else if ($month_score <= 89 && $month_score >= 85){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 2');
            }
            else if ($month_score <= 84 && $month_score >= 75){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 1');
            }
            else if ($month_score <= 74 && $month_score >= 70){
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 2');
            }
            else{
                $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Không hoàn thành');
            }
        }

                        
        // Print out secont worksheet
        $spreadsheet->setActiveSheetIndex(1);
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Tháng '.$month.' năm '.$year);
        $spreadsheet->getActiveSheet()->setCellValue('G12', 'Vũng Tàu, ngày '.cal_days_in_month(CAL_GREGORIAN, $month, $year).' tháng '.$month.' năm '.$year);

        if (count($excellent) > 0){
            $spreadsheet->getActiveSheet()->insertNewRowBefore(10, count($excellent)-1);
            for ($i = 0; $i < count($excellent); $i++){   
                $row = 9 + $i; 
                $fullname =  $excellent_users[$i]['full_name'];
                $position =  $excellent_users[$i]['position'];
                $login_id =  $excellent_users[$i]['login_id'];
                $first_day =  $excellent_users[$i]['first_working_day'];            
    
                //Generate content
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i + 1);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $login_id);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$row, $fullname);
                $spreadsheet->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$row, $position);
                if ($first_day != null){
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($first_day));
                    $spreadsheet->getActiveSheet()->getStyle('F'.$row)
                    ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
                }
                
                $month_score = $excellent[$i]['month_score'];
                $spreadsheet->getActiveSheet()->setCellValue('G'.$row, $month_score);
                $spreadsheet->getActiveSheet()->setCellValue('I'.$row, $excellent[$i]['remarks']);

    
                if ($month_score <= 100 && $month_score >= 98){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 1');
                } 
                else if ($month_score <= 97 && $month_score >= 95){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 2');
                }
                else if ($month_score <= 94 && $month_score >= 90){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 1');
                }
                else if ($month_score <= 89 && $month_score >= 85){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 2');
                }
                else if ($month_score <= 84 && $month_score >= 75){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 1');
                }
                else if ($month_score <= 74 && $month_score >= 70){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 2');
                }
                else{
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Không hoàn thành');
                }
            }
        }
        
        // Print out third work sheet
        $spreadsheet->setActiveSheetIndex(2);

        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Tháng '.$month.' năm '.$year);
        $spreadsheet->getActiveSheet()->setCellValue('G12', 'Vũng Tàu, ngày '.cal_days_in_month(CAL_GREGORIAN, $month, $year).' tháng '.$month.' năm '.$year);

        if ( count($good) > 0) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore(10, count($good)-1);
            for ($i = 0; $i < count($good); $i++){   
                $row = 9 + $i; 
                $fullname =  $good_users[$i]['full_name'];
                $position =  $good_users[$i]['position'];
                $login_id =  $good_users[$i]['login_id'];
                $first_day =  $good_users[$i]['first_working_day'];            
    
                //Generate content
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i + 1);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $login_id);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$row, $fullname);
                $spreadsheet->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$row, $position);
                if ($first_day != null){
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($first_day));
                    $spreadsheet->getActiveSheet()->getStyle('F'.$row)
                    ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
                }    
               
                $month_score = $good[$i]['month_score'];
                $spreadsheet->getActiveSheet()->setCellValue('G'.$row, $month_score);
                $spreadsheet->getActiveSheet()->setCellValue('I'.$row, $good[$i]['remarks']);

    
                if ($month_score <= 100 && $month_score >= 98){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 1');
                } 
                else if ($month_score <= 97 && $month_score >= 95){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 2');
                }
                else if ($month_score <= 94 && $month_score >= 90){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 1');
                }
                else if ($month_score <= 89 && $month_score >= 85){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 2');
                }
                else if ($month_score <= 84 && $month_score >= 75){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 1');
                }
                else if ($month_score <= 74 && $month_score >= 70){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 2');
                }
                else{
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Không hoàn thành');
                }
            }
        }

        // Print out fourth worksheet
        $spreadsheet->setActiveSheetIndex(3);
        $spreadsheet->getActiveSheet()->setCellValue('A3', 'Tháng '.$month.' năm '.$year);
        $spreadsheet->getActiveSheet()->setCellValue('G12', 'Vũng Tàu, ngày '.cal_days_in_month(CAL_GREGORIAN, $month, $year).' tháng '.$month.' năm '.$year);
        
        if ( count($normal) > 0) {
            $spreadsheet->getActiveSheet()->insertNewRowBefore(10, count($normal)-1);
            for ($i = 0; $i < count($normal); $i++){   
                $row = 9 + $i; 
                $fullname =  $normal_users[$i]['full_name'];
                $position =  $normal_users[$i]['position'];
                $login_id =  $normal_users[$i]['login_id'];
                $first_day =  $normal_users[$i]['first_working_day'];            
    
                //Generate content
                $spreadsheet->getActiveSheet()->setCellValue('A'.$row, $i + 1);
                $spreadsheet->getActiveSheet()->setCellValue('B'.$row, $login_id);
                $spreadsheet->getActiveSheet()->setCellValue('C'.$row, $fullname);
                $spreadsheet->getActiveSheet()->mergeCells('C'.$row.':D'.$row);
                $spreadsheet->getActiveSheet()->setCellValue('E'.$row, $position);
                if ($first_day != null){
                    $spreadsheet->getActiveSheet()->setCellValue('F'.$row, \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel($first_day));
                    $spreadsheet->getActiveSheet()->getStyle('F'.$row)
                    ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
                }    
               
                $month_score = $normal[$i]['month_score'];
                $spreadsheet->getActiveSheet()->setCellValue('G'.$row, $month_score);
                $spreadsheet->getActiveSheet()->setCellValue('I'.$row, $normal[$i]['remarks']);

    
                if ($month_score <= 100 && $month_score >= 98){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 1');
                } 
                else if ($month_score <= 97 && $month_score >= 95){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành XS - Nhóm 2');
                }
                else if ($month_score <= 94 && $month_score >= 90){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 1');
                }
                else if ($month_score <= 89 && $month_score >= 85){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành Tốt - Nhóm 2');
                }
                else if ($month_score <= 84 && $month_score >= 75){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 1');
                }
                else if ($month_score <= 74 && $month_score >= 70){
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Hoàn thành - Nhóm 2');
                }
                else{
                    $spreadsheet->getActiveSheet()->setCellValue('H'.$row, 'Không hoàn thành');
                }
            }
        }
        

        //Insert Header Footer
        // $spreadsheet->getActiveSheet()
        // ->getHeaderFooter()
        // ->setOddFooter('JMS report - BM02');

        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $spreadsheet->setActiveSheetIndex(0);
        $file_name = 'Báo cáo Tổng kết tháng '.$month.' năm '.$year.'.xlsx';
        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="'.$file_name.'"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}




?>