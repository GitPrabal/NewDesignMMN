<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer_model extends CI_Model {

function __construct() {
  parent::__construct();
}

  public function addRetrenchmentNoticewithoutLogin($register,$retrenchment_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];
      $register = $this->db->insert('register', $register);
      $result = $this->db->insert('retrenchment_notice', $retrenchment_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'retrenchment_notice',
                'table_heading' => 'Retrenchment Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'retrenchment_notice'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      
      return $result;

  }

  public function addRetrenchmentNoticewithLogin($retrenchment_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $retrenchment_notice['user_id'];

      $result = $this->db->insert('retrenchment_notice', $retrenchment_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'retrenchment_notice',
                'table_heading' => 'Retrenchment Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'retrenchment_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result; 

  }

  public function addTerminationNoticewithoutLogin($register,$termination_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $register['user_id'];
      $register   = $this->db->insert('register', $register);
      $result     = $this->db->insert('termination_notice', $termination_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'termination_notice',
                'table_heading' => 'Termination Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'termination_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;

  }

  public function addTerminationNoticewithLogin($termination_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $termination_notice['user_id'];
      $result = $this->db->insert('termination_notice', $termination_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'termination_notice',
                'table_heading' => 'Termination Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'termination_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result; 

  }


  public function addMisconductNoticewithoutLogin($register,$misconduct_notice){ 

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $register['user_id'];
      $register = $this->db->insert('register', $register);
      $result = $this->db->insert('misconduct_notice', $misconduct_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'misconduct_notice',
                'table_heading' => 'MisConduct Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'misconduct_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);



      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;
  }

  public function addMisconductNoticewithLogin($misconduct_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $misconduct_notice['user_id'];
      $result     = $this->db->insert('misconduct_notice', $misconduct_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'misconduct_notice',
                'table_heading' => 'MisConduct Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'misconduct_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result; 
  }


  public function addSuspensionNoticewithoutLogin($register,$suspension_notice){ 

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $register['user_id'];

      $register = $this->db->insert('register', $register);
      $result = $this->db->insert('suspension_notice', $suspension_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'suspension_notice',
                'table_heading' => 'Suspension Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'suspension_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;
  }

  public function addSuspensionNoticewithLogin($suspension_notice){

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $suspension_notice['user_id'];
      $result = $this->db->insert('suspension_notice', $suspension_notice);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'suspension_notice',
                'table_heading' => 'Suspension Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'suspension_notice'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result; 
  }







}


?>