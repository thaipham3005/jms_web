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
        $this->load->model('model_auth');
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
        $spreadsheet->getActiveSheet()->setCellValue('A6', 'Tháng '.date('m').' năm '.date('Y'));

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

    public function exportBM3($user_id, $regulation, $overall, $year, $month)
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
        $spreadsheet->getActiveSheet()->setCellValue('F11', \PhpOffice\PhpSpreadsheet\Shared\Date::PHPToExcel(date('Y-m-d') ));
        $spreadsheet->getActiveSheet()->getStyle('F11')
        ->getNumberFormat()->setFormatCode('dd/mm/yyyy');
        // $spreadsheet->getActiveSheet()->setCellValue('C11', '');

        if ($regulation <= 30 && $regulation >= 26){
            $spreadsheet->getActiveSheet()->setCellValue('D17', $regulation);
        } 
        else if ($regulation < 26 && $regulation >= 20){
            $spreadsheet->getActiveSheet()->setCellValue('E17', $regulation);
        }
        else if ($regulation < 20 && $regulation >= 1){
            $spreadsheet->getActiveSheet()->setCellValue('F17', $regulation);
        }
        else if ($regulation == 0){
            $spreadsheet->getActiveSheet()->setCellValue('G17', $regulation);
        }

        if ($overall <= 70 && $overall >= 61){
            $spreadsheet->getActiveSheet()->setCellValue('D15', $overall);
        } 
        else if ($overall < 60 && $overall >= 51){
            $spreadsheet->getActiveSheet()->setCellValue('E15', $overall);
        }
        else if ($overall < 50 && $overall >= 1){
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
}




?>