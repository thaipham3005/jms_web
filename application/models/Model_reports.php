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
        $sql = 'SELECT reports.*, users.full_name as full_name, awards.award
        FROM reports 
        INNER JOIN users ON reports.user_id = users.id
        LEFT JOIN awards ON reports.award_id = awards.id
        WHERE users.id = ? AND year = ? AND month = ? AND reports.active = "1"
        ORDER BY year, month';

        $query = $this->db->query($sql, array($user_id, $year, $month));
        return $query->row_array();

    }
    public function insert($data)
    {
        if($data) {
			$insert = $this->db->insert('reports', $data);
			return ($insert == true) ? true : false;
		}
        return false;
    }
    public function edit($data, $id)
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