<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banking_model extends CI_Model {

function __construct() {
parent::__construct();
}


public function addSarfaesiWithoutLogin($register,$sarfaesi_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid = $register['user_id'];
      $register         = $this->db->insert('register', $register);
      

      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'sarfaesi_notice',
                'table_heading' => 'Sarfaesi Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'sarfaesi_notice'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $result = $this->db->insert('sarfaesi_notice', $sarfaesi_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'sarfaesi_notice',
                'table_heading' => 'Sarfaesi Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'sarfaesi_notice'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;

}


public function addSarfaesiWithLogin($sarfaesi_notice){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('sarfaesi_notice', $sarfaesi_notice);
      $uniqid = $sarfaesi_notice["user_id"];
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'sarfaesi_notice',
                'table_heading' => 'Sarfaesi Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'sarfaesi_notice'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);



      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result;

}

  

  
}
?>