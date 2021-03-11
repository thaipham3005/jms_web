<?php
    class Model_groups extends CI_Model 
    {
        public function __construct()
        {
            // parent::__construct();
        }

        public function getGroupData($groupId=null, $all=false)
        {
            if($groupId){
                $sql = "SELECT * FROM groups WHERE id = ? AND active='1'";
                $query = $this->db->query($sql, array($groupId));
                return $query->row_array();
            }

            if ($all){
                $sql = "SELECT * FROM groups where active='1' ORDER BY id DESC";
                $query = $this->db->query($sql,array());
                return $query->result_array();
            }else{
                $sql = "SELECT * FROM groups where id != ? AND active='1' ORDER BY id DESC";
                $query = $this->db->query($sql,array(1));
                return $query->result_array();
            }

            
        }

        public function create($data)
        {
            $create = $this->db->insert('groups', $data);
            return ($create == true) ? true : false;
        }

        public function edit($data, $id)
        {
            $this->db->where('id', $id);
            $update = $this->db->update('groups', $data);
            return ($update == true) ? true : false;
        }

        public function disable($id)
        {
            $this->db->where('id', $id);
            $data = array('active'=>0, 'last_change' => date('Y-m-d H:i:s'));
            
            $update = $this->db->update('groups', $data);
            return ($update == true) ? true : false;
        }

        public function delete($id)
        {
            $this->db->where('id', $id);
            $delete = $this->db->delete('groups');
            return ($delete == true) ? true : false;
        }

        public function existInUserGroup($id)
        {
            $sql = "SELECT * FROM user_group WHERE group_id = ?";
            $query = $this->db->query($sql, array($id));
            return ($query->num_rows() == 1) ? true : false;
        }

        public function getUserGroupByUserId($user_id)
        {
            $sql = "SELECT * FROM user_group 
            INNER JOIN groups ON groups.id = user_group.group_id 
            WHERE user_group.user_id = ?";
            $query = $this->db->query($sql, array($user_id));
            $result = $query->row_array();

            return $result;
        }

        public function getApprovalGroup()
        {
            $sql = "SELECT id FROM groups
            WHERE permission LIKE '%approve%'";
            $query = $this->db->query($sql, array());
            return $query->result_array();
        }

        public function getCreateGroup()
        {
            $sql = "SELECT id, group_name FROM groups
            WHERE permission LIKE '%create%'";
            $query = $this->db->query($sql, array());
            return $query->result_array();
        }
    }
?>