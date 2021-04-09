<?php
    class Model_organization extends CI_Model 
    {
        public function __construct()
        {
            // parent::__construct();
        }

        #region Department

        public function getDepartmentData($company_id=null)
        {
            if($company_id){
                $sql = "SELECT * FROM departments WHERE company_id = ? AND active='1'
                ORDER BY id ASC";
                $query = $this->db->query($sql, array($company_id));
                return $query->result_array();
            }

            $sql = "SELECT * FROM departments 
            ORDER BY company_id, id ASC";
            $query = $this->db->query($sql,array());
            return $query->result_array();
        }

        public function getDepartmentByID($department_id)
        {
            $sql = "SELECT * FROM departments WHERE id = ? AND active='1'";
            $query = $this->db->query($sql, array($department_id));
            return $query->row_array();
        }

        public function createDept($data)
        {
            $create = $this->db->insert('departments', $data);
            return ($create == true) ? true : false;
        }

        public function editDept($data, $id)
        {
            $this->db->where('id', $id);
            $update = $this->db->update('departments', $data);
            return ($update == true) ? true : false;
        }

        public function disableDept($id)
        {
            $this->db->where('id', $id);
            $data = array(
                'active'=>0, 
                'changed_by'=>$this->session->userdata('id'),
                'last_change' => date('Y-m-d H:i:s')
                );
            
            $update = $this->db->update('departments', $data);
            return ($update == true) ? true : false;
        }

        public function deleteDept($id)
        {
            $this->db->where('id', $id);
            $delete = $this->db->delete('departments');
            return ($delete == true) ? true : false;
        }

        #endregion

        #region Team
        public function getTeamData($department_id, $company_id=null)
        {
            if($company_id){
                $sql = "SELECT * FROM teams WHERE department_id = ? AND company_id = ?
                AND active='1' ORDER BY id ASC";
                $query = $this->db->query($sql, array($department_id, $company_id));
                return $query->result_array();
            }

            $sql = "SELECT * FROM teams WHERE department_id = ?
            ORDER BY company_id, id ASC";
            $query = $this->db->query($sql,array());
            return $query->result_array();
        }

        public function getTeamByID($team_id)
        {
            $sql = "SELECT * FROM teams WHERE id = ? AND active='1'";
            $query = $this->db->query($sql, array($team_id));
            return $query->row_array();
        }

        public function createTeam($data)
        {
            $create = $this->db->insert('teams', $data);
            return ($create == true) ? true : false;
        }

        public function editTeam($data, $id)
        {
            $this->db->where('id', $id);
            $update = $this->db->update('teams', $data);
            return ($update == true) ? true : false;
        }

        public function disableTeam($id)
        {
            $this->db->where('id', $id);
            $data = array(
                'active'=>0, 
                'changed_by'=>$this->session->userdata('id'),
                'last_change' => date('Y-m-d H:i:s')
                );
            
            $update = $this->db->update('teams', $data);
            return ($update == true) ? true : false;
        }

        public function deleteTeam($id)
        {
            $this->db->where('id', $id);
            $delete = $this->db->delete('teams');
            return ($delete == true) ? true : false;
        }

        #endregion

        #region Squad
        public function getSquadData($team_id, $department_id, $company_id=null)
        {
            if($company_id){
                $sql = "SELECT * FROM squads 
                WHERE team_id = ? AND department_id = ? AND company_id = ?
                AND active='1' ORDER BY id ASC";
                $query = $this->db->query($sql, array($team_id, $department_id, $company_id));
                return $query->result_array();
            }

            $sql = "SELECT * FROM squads 
            WHERE team_id = ? AND department_id = ?
            ORDER BY company_id, id ASC";
            $query = $this->db->query($sql,array());
            return $query->result_array();
        }

        public function getSquadByID($squad_id)
        {
            $sql = "SELECT * FROM squads WHERE id = ? AND active='1'";
            $query = $this->db->query($sql, array($squad_id));
            return $query->row_array();
        }

        public function createSquad($data)
        {
            $create = $this->db->insert('squads', $data);
            return ($create == true) ? true : false;
        }

        public function editSquad($data, $id)
        {
            $this->db->where('id', $id);
            $update = $this->db->update('squads', $data);
            return ($update == true) ? true : false;
        }

        public function disableSquad($id)
        {
            $this->db->where('id', $id);
            $data = array(
                'active'=>0, 
                'changed_by'=>$this->session->userdata('id'),
                'last_change' => date('Y-m-d H:i:s')
                );
            
            $update = $this->db->update('squads', $data);
            return ($update == true) ? true : false;
        }

        public function deleteSquad($id)
        {
            $this->db->where('id', $id);
            $delete = $this->db->delete('squads');
            return ($delete == true) ? true : false;
        }

        #endregion

        #region Company
        public function getCompanyData($company_id = null)
        {
            if($company_id){
                $sql = "SELECT * FROM companies WHERE active='1'
                ORDER BY id ASC";
                $query = $this->db->query($sql, array($company_id));
                return $query->result_array();
            }

            $sql = "SELECT * FROM companies 
            ORDER BY id ASC";
            $query = $this->db->query($sql,array());
            return $query->result_array();
        }

        public function getCompanyByID($department_id)
        {
            $sql = "SELECT * FROM companies WHERE id = ? AND active='1'";
            $query = $this->db->query($sql, array($department_id));
            return $query->row_array();
        }

        public function createCompany($data)
        {
            $create = $this->db->insert('companies', $data);
            return ($create == true) ? true : false;
        }

        public function editCompany($data, $id)
        {
            $this->db->where('id', $id);
            $update = $this->db->update('companies', $data);
            return ($update == true) ? true : false;
        }

        public function disableCompany($id)
        {
            $this->db->where('id', $id);
            $data = array(
                'active'=>0, 
                'changed_by'=>$this->session->userdata('id'),
                'last_change' => date('Y-m-d H:i:s')
                );
            
            $update = $this->db->update('companies', $data);
            return ($update == true) ? true : false;
        }

        public function deleteCompany($id)
        {
            $this->db->where('id', $id);
            $delete = $this->db->delete('companies');
            return ($delete == true) ? true : false;
        }

        #endregion
    
    }
?>