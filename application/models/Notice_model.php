<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice_model extends CI_Model {

function __construct() {
parent::__construct();
}


  public function addPfClaimWithoutLogin($register,$pf_claim){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];
      $register   = $this->db->insert('register', $register);
      $result     = $this->db->insert('pf_claim', $pf_claim);
      $notice_id  = $this->db->insert_id();
      $notice_id = $notice_id;

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'pf_claim',
                'table_heading' => 'PF Claim'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'pf_claim',
                'pulled'        => '0'
        );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
     $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


     $this->session->set_userdata('final_filled',"1");
     $this->session->set_userdata('notice_initiated',"0");
     $this->session->set_userdata('session_data',"");

      return $result;
  }



  public function addPfClaimWithLogin($pf_claim){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('pf_claim', $pf_claim);

      $notice_id  = $this->db->insert_id();

      $uniqid    = $pf_claim['user_id'];
      $notice_id = $notice_id;

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'pf_claim',
                'table_heading' => 'PF Claim'
      );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);

     $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'pf_claim',
                'pulled'        => '0'
     );

     $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;
  }

}
?>