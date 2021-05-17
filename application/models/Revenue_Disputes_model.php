<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue_Disputes_model extends CI_Model {

function __construct() {
parent::__construct();
}

  public function addAdministrationWithoutLogin($register,$administration){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('administration', $administration);
      $notice_id  = $this->db->insert_id();
      $result = $this->db->insert('register', $register);
      $uniqid    = $register['user_id'];


      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'administration',
                'table_heading' => 'Notice To Administration'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'administration',
                'pulled'        => '0'
      );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
     $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;

  }

  public function addAdministrationWithLogin($administration){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('administration', $administration);
      $notice_id  = $this->db->insert_id();
      $uniqid = $administration['user_id']; 


      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'administration',
                'table_heading' => 'Notice To Administration'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'administration',
                'pulled'        => '0'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('basic_details_filled',"0");
      $this->session->set_userdata('basic_details',"");
      return $result;

  }

  public function addTrespassingWithoutLogin($register,$trespassing){

      $this->load->database();
      $this->load->library('session');
      $uniqid   =  $register['user_id'];
      $result = $this->db->insert('trespassing', $trespassing);
      $notice_id  = $this->db->insert_id();
      $result = $this->db->insert('register', $register);

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'trespassing',
                'table_heading' => 'Trespassing Notice'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'non_payment_salary',
                'pulled'        => '0'
      );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
     $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('basic_details_filled',"0");
      $this->session->set_userdata('basic_details',"");
      return $result;

  }

  public function addTrespassingWithLogin($trespassing){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('trespassing', $trespassing);
      $notice_id  = $this->db->insert_id();
      $uniqid =  $trespassing['user_id'];

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'trespassing',
        'table_head'  => 'Trespassing Notice',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('basic_details_filled',"0");
      $this->session->set_userdata('basic_details',"");
      return $result;

  }

  public function addEncroachmentWithoutLogin($register,$encroachment){

      $this->load->database();
      $this->load->library('session');
      $uniqid = $register['user_id']; 
      $result = $this->db->insert('encroachment', $encroachment);
      $notice_id  = $this->db->insert_id();
      $result = $this->db->insert('register', $register);

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'encroachment',
        'table_head'  => 'Encroachment Notice',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('basic_details',"");
      return $result;

  }

  public function addEncroachmentWithLogin($encroachment){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('encroachment', $encroachment);
      $notice_id  = $this->db->insert_id();
      $uniqid = $encroachment['user_id'];

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'encroachment',
        'table_head'  => 'Encroachment Notice',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('basic_details_filled',"0");
      $this->session->set_userdata('basic_details',"");

      return $result;

  }


  public function addTitleDeedWithoutLogin($register,$title_deed){


      $this->load->database();
      $this->load->library('session');
      $uniqid = $register['user_id'];
      $result = $this->db->insert('register', $register);
      $result = $this->db->insert('title_deed', $title_deed);
      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'title_deed',
        'table_head'  => 'Title Deed Notice',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('basic_details_filled',"0");
      $this->session->set_userdata('basic_details',"");

      return $result;
  }

  public function addTitleDeedWithLogin($title_deed){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('title_deed', $title_deed);
      $uniqid = $title_deed['user_id'];
      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'title_deed',
        'table_head'  => 'Title Deed Notice',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('basic_details_filled',"0");
      $this->session->set_userdata('basic_details',"");

      return $result;
    
  }

  public function addExtraDetail($data){

     $uniqid     = $data['user_id'];
     $notice_id  = $data['notice_id'];
     $table_name = $data['table_name'];
     $table_head = $data['table_head'];


     $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => $table_name,
                'table_heading' => $table_head
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => $table_name,
                'pulled'        => '0'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      return $advocate_pulled_notice;
  }


}
?>