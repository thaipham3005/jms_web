<?php
    class Model_db2 extends CI_Model {
        public function __construct(){
            parent::__construct();
            //load our second db and put in $db2
            $this->db2 = $this->load->database('second', TRUE);
        }

        

    }
?>