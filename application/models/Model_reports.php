<?php
class Model_reports extends CI_Model
{
    public function __construct()
    {
        // parent::__construct();
    }

    public function checkReportExist($user_id, $year, $month){
        $sql = 'SELECT *
        FROM reports 
        WHERE user_id = ? AND year = ? AND month = ? AND active = "1"';

        $query = $this->db->query($sql, array($user_id, $year, $month));
        return $query->row_array();

    }

    public function getReportByUser($user_id, $year, $month)
    {        
        $sql = 'SELECT reports.*, users.full_name as full_name, awards.award as award
        FROM reports 
        INNER JOIN users ON reports.user_id = users.id
        LEFT JOIN awards ON reports.award_id = awards.id
        WHERE users.id = ? AND year = ? AND month = ? AND reports.active = "1"
        ORDER BY year, month';

        $query = $this->db->query($sql, array($user_id, $year, $month));
        return $query->row_array();
    }

    public function getReportByTeam($team_id, $year, $month)
    {        
        $sql = 'SELECT reports.*, users.full_name as full_name, users.level as user_level,
        awards.award as award
        FROM reports 
        INNER JOIN users ON reports.user_id = users.id
        LEFT JOIN awards ON reports.award_id = awards.id
        WHERE reports.team_id = ? AND year = ? AND month = ? AND reports.active = "1"
        ORDER BY user_level asc';

        $query = $this->db->query($sql, array($team_id, $year, $month));
        return $query->result_array();
    }

    public function getReportByDepartment($department_id, $year, $month)
    {        
        $sql = 'SELECT reports.*, users.full_name as full_name, users.level as user_level,
        awards.award as award, teams.name as team
        FROM reports 
        INNER JOIN users ON reports.user_id = users.id
        INNER JOIN teams ON reports.team_id = teams.id
        LEFT JOIN awards ON reports.award_id = awards.id
        WHERE reports.department_id = ? AND year = ? AND month = ? AND reports.active = "1"
        ORDER BY team_id asc, user_level asc';

        $query = $this->db->query($sql, array($department_id, $year, $month));
        return $query->result_array();
    }

    public function getAwardsDepartment($award_type, $department_id, $year, $month)
    {      
        $award = ''  ;
        switch ($award_type){
            case 'excellent':
                $award = ['1','2'];
                break;
            case 'good':
                $award = ['3','4'];
                break;
        }
        $sql = 'SELECT reports.*, users.full_name as full_name, awards.award as award
        FROM reports 
        INNER JOIN users ON reports.user_id = users.id
        LEFT JOIN awards ON reports.award_id = awards.id
        WHERE reports.award_id in (?,?) AND reports.department_id = ?
        AND year = ? AND month = ? AND reports.active = "1"
        ORDER BY users.team_id asc';

        $query = $this->db->query($sql, array($award[0], $award[1], $department_id,  $year, $month));
        return $query->result_array();
    }

    public function summaryYear($user_id, $year){
        $sql = 'SELECT SUM(total) as total, SUM(completed) as completed, CAST(AVG(month_score) AS DECIMAL(10,2)) as avg_score, COUNT(award_id) as awards FROM reports
        WHERE user_id = ? and year = ?';

        $query = $this->db->query($sql, array($user_id, $year));
        return $query->result_array();
    }

    public function summaryMonth($user_id, $year, $month){
        $sql = 'SELECT total, completed, month_score, COUNT(award_id) as awards FROM reports
        WHERE user_id = ? and year = ? AND month = ?';

        $query = $this->db->query($sql, array($user_id, $year, $month));
        return $query->result_array();
    }

    public function performanceYear($user_id, $year){
        $sql = 'SELECT month, SUM(total) as total, SUM(completed) as completed, month_score, COUNT(award_id) as awarded FROM reports 
        WHERE user_id = ? and year = ?
        GROUP BY month';

        $query = $this->db->query($sql, array($user_id, $year));
        return $query->result_array();
    }

    public function getAwardsData(){
        $sql = 'SELECT * FROM awards';

        $query = $this->db->query($sql, array());
        return $query->result_array();
    }

    public function insert($data)
    {
        if($data) {
			$insert = $this->db->insert('reports', $data);
			return ($insert == true) ? true : false;
		}
        return false;
    }
    public function update($data, $id)
    {
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('reports', $data);
			return ($update == true) ? true : false;
		}
        return false;
    }
    public function delete($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('reports');
			return ($delete == true) ? true : false;
		}
    }
    
    public function disable($id)
    {
        $this->db->where('id', $id);
        $data = array('active'=>0, 'changed_by'=>$this->session->userdata['id'], 'last_change' => date('Y-m-d H:i:s'));
        $disable = $this->db->update('reports', $data);
        return ($disable == true) ? true : false;
    }

}

?>