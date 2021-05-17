<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_Disputes_model extends CI_Model {

function __construct() {
parent::__construct();
}


  public function addDelayInConstruction($delay_in_construction){


      $this->load->database();
      $this->load->library('session');
      $uniqid    = $delay_in_construction['user_id'];
      $result    = $this->db->insert('delay_in_construction', $delay_in_construction);
      $notice_id = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'delay_in_construction',
        'table_head'  => 'Delay In Construction',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result;

  }



  public function addDelayInConstructionWithoutLogin($register,$delay_in_construction){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];
      $register         = $this->db->insert('register', $register);
      $result = $this->db->insert('delay_in_construction', $delay_in_construction);

      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'delay_in_construction',
        'table_head'  => 'Delay In Construction',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result;
    
  }


  public function addRentalData($register,$lessor_dispute){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];

      $register         = $this->db->insert('register', $register);
      $result = $this->db->insert('lessor_dispute', $lessor_dispute);
      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'lessor_dispute',
        'table_head'  => 'Lessor Dispute',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $result;
  }

  public function addRentalDataWithoutLogin($lessor_dispute){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $lessor_dispute['user_id'];
      $lessor_dispute  = $this->db->insert('lessor_dispute', $lessor_dispute);
      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'lessor_dispute',
        'table_head'  => 'Lessor Dispute',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      return $lessor_dispute;
  }

  public function addTerminationDefendantDataWithoutLogin($register,$termination_rental){

      $this->load->database();
      $this->load->library('session');
      $uniqid     = $register['user_id'];
      $register   = $this->db->insert('register', $register);
      $result     = $this->db->insert('termination_rental', $termination_rental);
      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'termination_rental',
        'table_head'  => 'Termination Rental',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;

  }

  public function addTerminationDefendantData($termination_rental){

       $this->load->database();
       $this->load->library('session');
       $uniqid    = $termination_rental['user_id'];
       $result = $this->db->insert('termination_rental', $termination_rental);
       $notice_id  = $this->db->insert_id();

       $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'termination_rental',
        'table_head'  => 'Termination Rental',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;

  }

  public function addArbitrationDataWithoutLogin($register,$arbitration_rental){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];

      $register         = $this->db->insert('register', $register);
      $result = $this->db->insert('arbitration_rental', $arbitration_rental);
      $notice_id  = $this->db->insert_id();

      $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'arbitration_rental',
        'table_head'  => 'Arbitration Rental',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      
      return $result;

  }

   public function addArbitrationData($arbitration_rental){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $arbitration_rental['user_id'];

      $result = $this->db->insert('arbitration_rental', $arbitration_rental);
      $notice_id  = $this->db->insert_id();

       $extraDetail = array(

        'user_id'     => $uniqid,
        'notice_id'   => $notice_id,
        'table_name'  => 'arbitration_rental',
        'table_head'  => 'Arbitration Rental',
        'pulled'      => '0'

      );

      $addExtraDetail =  $this->addExtraDetail($extraDetail);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

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