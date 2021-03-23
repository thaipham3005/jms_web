<?php
class Model_tasks extends CI_Model
{
    public function __construct()
    {
        // parent::__construct();
    }

    public function getTaskById($task_id){
        if ($from && $to)
        {
            $sql = 'SELECT * FROM tasks WHERE id = ?';
            $query = $this->db->query($sql,array($task_id));
            return $query->row_array();
        }
    }

    public function getTaskDataByUser($compnay_id, $user_id, $from = null, $to = null)
    {
        if ($from && $to)
        {
            $sql = 'SELECT * FROM tasks 
            WHERE compnay_id = ? AND4 user_id = ? AND active = "1" 
            AND plan_complete >= ? AND plan_complete <= ? 
            ORDER BY id DESC';
            $query = $this->db->query($sql,array($user_id, $from, $to));
            return $query->result_array();
        }

        $sql = "SELECT * FROM tasks WHERE user_id = ? AND active = '1' 
        ORDER BY id DESC";
        $query = $this->db->query($sql, array($user_id));
        return $query->result_array();
    } 

    public function getTaskDataByTeam($team_id, $from = null, $to = null)
    {
        if ($from && $to)
        {
            $sql = 'SELECT * FROM tasks 
            WHERE team_id = ? AND active = "1" 
            AND plan_complete >= ? AND plan_complete <= ? 
            ORDER BY id DESC';
            $query = $this->db->query($sql,array($team_id, $from, $to));
            return $query->result_array();
        }

        $sql = "SELECT * FROM tasks WHERE team_id = ? AND active = '1' 
        ORDER BY id DESC";
        $query = $this->db->query($sql, array($team_id));
        return $query->result_array();
    } 

    public function getTaskDataByDepartment($department_id, $from = null, $to = null)
    {
        if ($from && $to)
        {
            $sql = 'SELECT * FROM tasks 
            WHERE department_id = ? AND active = "1" 
            AND plan_complete >= ? AND plan_complete <= ? 
            ORDER BY id DESC';
            $query = $this->db->query($sql,array($department_id, $from, $to));
            return $query->result_array();
        }

        $sql = "SELECT * FROM tasks WHERE department_id = ? AND active = '1' 
        ORDER BY id DESC";
        $query = $this->db->query($sql, array($department_id));
        return $query->result_array();
    } 

    public function create($data)
	{
		if($data) {
			$insert = $this->db->insert('tasks', $data);
			return ($insert == true) ? true : false;
		}
    }

    public function assign($data){
        if($data) {
			$insert = $this->db->insert('tasks', $data);
			return ($insert == true) ? true : false;
		}
    }

	public function update($data, $id)
	{
		if($data && $id) {
			$this->db->where('id', $id);
			$update = $this->db->update('tasks', $data);
			return ($update == true) ? true : false;
		}
	}

	public function delete($id)
	{
		if($id) {
			$this->db->where('id', $id);
			$delete = $this->db->delete('tasks');
			return ($delete == true) ? true : false;
		}
    }
    
    public function disable($id)
    {
        $this->db->where('id', $id);
        $data = array('active'=>0, 'changed_by'=>$this->session->userdata['id'], 'last_change' => date('Y-m-d H:i:s'),);
        $disable = $this->db->update('tasks', $data);
        return ($disable == true) ? true : false;
    }

	public function countTotaltasks($all=false)
	{
        if ($all==true){
            $sql = "SELECT id FROM tasks";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
		$sql = "SELECT id FROM tasks WHERE active='1'";
		$query = $this->db->query($sql);
		return $query->num_rows();
    }

    public function countNewTasks($all=false)
	{
        if ($all==true){
            $sql = "SELECT id FROM tasks WHERE status='0'";
            $query = $this->db->query($sql);
            return $query->num_rows();
        }
		$sql = "SELECT id FROM tasks WHERE active='1' AND status='0'";
        $query = $this->db->query($sql);
        // echo $sql;
		return $query->num_rows();
    }  

}

?>