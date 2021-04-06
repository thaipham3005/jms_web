<?php
class Model_users extends CI_Model
    {
        public function __construct()
        {
            // parent::__construct();
        }

        public function getUserData($company_id = null, $department_id=null, $team_id = null) 
        {
            
            if ($company_id && $department_id && $team_id){
                $sql = "SELECT users.*, companies.name as company, departments.name as department, teams.name as team, groups.id as group_id, groups.name as _group
                FROM users
                INNER JOIN user_group ON users.id = user_group.user_id
                INNER JOIN groups ON groups.id = user_group.group_id
                INNER JOIN companies ON companies.id = users.company_id
                INNER JOIN departments ON departments.id = users.department_id
                INNER JOIN teams ON teams.id = users.team_id
                WHERE users.level > 1 AND users.active = '1'
                AND users.company_id = ? AND users.department_id = ? AND users.team_id = ?
                ORDER BY company_id ASC, department_id ASC, team_id ASC, level ASC";
                $query = $this->db->query($sql, array($company_id, $department_id, $team_id));
                return $query->result_array();
            } 
            else if ($company_id && $department_id){
                $sql = "SELECT users.*, companies.name as company, departments.name as department, teams.name as team, groups.id as group_id, groups.name as _group
                FROM users
                INNER JOIN user_group ON users.id = user_group.user_id
                INNER JOIN groups ON groups.id = user_group.group_id
                INNER JOIN companies ON companies.id = users.company_id
                INNER JOIN departments ON departments.id = users.department_id
                INNER JOIN teams ON teams.id = users.team_id
                WHERE users.level > 1 AND users.active = '1'
                AND users.company_id = ? AND users.department_id = ?
                ORDER BY company_id ASC, department_id ASC, team_id ASC, level ASC";
                $query = $this->db->query($sql, array($company_id, $department_id));
                return $query->result_array();
            }
            else if ($company_id)   {
                $sql = "SELECT users.*, companies.name as company, departments.name as department, teams.name as team, groups.id as group_id, groups.name as _group
                FROM users
                INNER JOIN user_group ON users.id = user_group.user_id
                INNER JOIN groups ON groups.id = user_group.group_id
                INNER JOIN companies ON companies.id = users.company_id
                INNER JOIN departments ON departments.id = users.department_id
                INNER JOIN teams ON teams.id = users.team_id
                WHERE users.level > 1 AND users.active = '1'
                AND users.company_id = ?
                ORDER BY company_id ASC, department_id ASC, team_id ASC, level ASC";
                $query = $this->db->query($sql, array($company_id));
                return $query->result_array();
            } 
            else {
                $sql = "SELECT users.*, companies.name as company, departments.name as department, teams.name as team, groups.id as group_id, groups.name as _group
                FROM users
                INNER JOIN user_group ON users.id = user_group.user_id
                INNER JOIN groups ON groups.id = user_group.group_id
                INNER JOIN companies ON companies.id = users.company_id
                INNER JOIN departments ON departments.id = users.department_id
                INNER JOIN teams ON teams.id = users.team_id
                
                ORDER BY company_id ASC, department_id ASC, team_id ASC, level ASC";
                $query = $this->db->query($sql, array($company_id));
                return $query->result_array();
            }          
        }

        public function getTeamData($company_id = null, $department_id=null) 
        {            
            if ($company_id && $department_id){
                $sql = "SELECT teams.*, companies.name as company, departments.name as department
                FROM teams               
                INNER JOIN companies ON companies.id = teams.company_id
                INNER JOIN departments ON departments.id = teams.department_id                
                WHERE teams.active = '1'
                AND teams.company_id = ? AND teams.department_id = ?
                ORDER BY company_id ASC, department_id ASC, team_id ASC";
                $query = $this->db->query($sql, array($company_id, $department_id));
                return $query->result_array();
            }
            else if ($company_id)   {
                $sql = "SELECT teams.*, companies.name as company, departments.name as department
                FROM teams               
                INNER JOIN companies ON companies.id = teams.company_id
                INNER JOIN departments ON departments.id = teams.department_id                
                WHERE teams.active = '1' AND teams.company_id = ?
                ORDER BY company_id ASC, department_id ASC, team_id ASC";
                $query = $this->db->query($sql, array($company_id));
                return $query->result_array();
            } 
            else {
                $sql = "SELECT teams.*, companies.name as company, departments.name as department
                FROM teams               
                INNER JOIN companies ON companies.id = teams.company_id
                INNER JOIN departments ON departments.id = teams.department_id 
                ORDER BY company_id ASC, department_id ASC, team_id ASC";
                $query = $this->db->query($sql, array());
                return $query->result_array();
            }          
        }

        public function getUserByID($user_id)
        {
            // In case of normal user (not creator) 
            if ($user_id > 1){
                $sql = "SELECT users.*, companies.name as company, departments.name as department, teams.name as team, groups.id as group_id, groups.name as _group
                    FROM users
                    INNER JOIN user_group ON users.id = user_group.user_id
                    INNER JOIN groups ON groups.id = user_group.group_id
                    INNER JOIN companies ON companies.id = users.company_id
                    INNER JOIN departments ON departments.id = users.department_id
                    INNER JOIN teams ON teams.id = users.team_id
                    WHERE users.id = ? ";
                    $query = $this->db->query($sql, array($user_id));
                    return $query->row_array();
            }

            $sql = "SELECT users.*, departments.name as department, teams.name as team, groups.id as group_id, groups.name as _group
                FROM users
                INNER JOIN user_group ON users.id = user_group.user_id
                INNER JOIN groups ON groups.id = user_group.group_id
                INNER JOIN departments ON departments.id = users.department_id
                INNER JOIN teams ON teams.id = users.team_id
                WHERE users.id = ? ";
                $query = $this->db->query($sql, array($userId));
                return $query->row_array();
        }

        public function getUserGroup($userId = null, $companyId = null) 
        {
            if($userId) {
                $sql = "SELECT * FROM user_group WHERE user_id = ?";
                $query = $this->db->query($sql, array($userId));
                $result = $query->row_array();

                $group_id = $result['group_id'];
                $g_sql = "SELECT * FROM groups WHERE id = ?";
                $g_query = $this->db->query($g_sql, array($group_id));
                $q_result = $g_query->row_array();
                return $q_result;
            }
        }

        public function getGroup($userId) 
        {
            if($userId) {
                $sql = "SELECT group_id FROM user_group WHERE user_id = ?";
                $query = $this->db->query($sql, array($userId));
                $result = $query->row_array();

                $group_id = $result['group_id'];
                $g_sql = "SELECT name FROM groups WHERE id = ?";
                $g_query = $this->db->query($g_sql, array($group_id));
                $q_result = $g_query->row_array();
                return $q_result['name'];
            }
        }

        public function create($data = '', $group_id = null)
        {
            if($data && $group_id) {
                $create = $this->db->insert('users', $data);
                $user_id = $this->db->insert_id();

                $group_data = array(
                    'user_id' => $user_id,
                    'group_id' => $group_id,
                    'last_change'=>date('Y-m-d H:i:s')
                );

                $group_link = $this->db->insert('user_group', $group_data);
                
                return ($create == true && $group_link) ? true : false;
            }

        }

        public function edit($data = array(), $id = null, $group_id = null)
        {
            $this->db->where('id', $id);
            $update = $this->db->update('users', $data);

            if($group_id) {
                $update_user_group = array('group_id' => $group_id);
                $this->db->where('user_id', $id);
                $user_group = $this->db->update('user_group', $update_user_group);
                return ($update == true && $user_group == true) ? true : false;	
            }
                
            return ($update == true) ? true : false;	
        }

        public function delete($id)
        {
            $this->db->where('id', $id);
            $delete = $this->db->delete('users');
            return ($delete == true) ? true : false;
        }

        public function disable($id){
            $this->db->where('id', $id);
            $data = array('active'=>0, 'last_change' => date('Y:m:d h:i:s'),);
            $disable = $this->db->update('users', $data);
            return ($disable == true) ? true : false;
        }

        public function countTotalUsers()
        {
            $sql = "SELECT * FROM users WHERE id != ?";
            $query = $this->db->query($sql, array(1));
            return $query->num_rows();
        }


    }
?>