<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_model extends CI_Model {

function __construct() {
  parent::__construct();
}


  public function addNonPaymentSalaryWithoutLogin($register,$non_payment_salary){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];

      $register         = $this->db->insert('register', $register);
      $result = $this->db->insert('non_payment_salary', $non_payment_salary);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'non_payment_salary',
                'table_heading' => 'Non Payment Of Salary'
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
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;
  }


   public function addNonPaymentSalaryWithLogin($non_payment_salary){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $non_payment_salary['user_id'];
      $result = $this->db->insert('non_payment_salary', $non_payment_salary);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'non_payment_salary',
                'table_heading' => 'Non Payment Of Salary'
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
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;

  }



  public function addAbusePowerWithoutLogin($register,$abuse_power){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];
      $register = $this->db->insert('register', $register);
      $result   = $this->db->insert('abuse_power', $abuse_power);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power',
                'table_heading' => 'Abuse Of Power'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;

  }

  public function addAbusePowerWithLogin($abuse_power){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('abuse_power', $abuse_power);
      $notice_id  = $this->db->insert_id();
      $uniqid    = $abuse_power['user_id'];

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power',
                'table_heading' => 'Abuse Of Power'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;
  }
  
  public function addWrongfulTerminationWithoutLogin($register,$wrongful_termination){

      $this->load->database();
      $this->load->library('session');
      $uniqid   = $register['user_id'];
      $register = $this->db->insert('register', $register);
      $result = $this->db->insert('wrongful_termination', $wrongful_termination);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power',
                'table_heading' => 'Abuse Of Power'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);


      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;

  }


    public function addWrongfulTerminationWithLogin($wrongful_termination){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('wrongful_termination', $wrongful_termination);

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power',
                'table_heading' => 'Abuse Of Power'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'abuse_power'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);



      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      
      return $result; 

  }

  public function addGratuityClaimWithoutLogin($register,$gratuity_claim){

      $this->load->database();
      $this->load->library('session');
      $uniqid   = $register['user_id'];  
      $register = $this->db->insert('register', $register);
      $result   = $this->db->insert('gratuity_claim', $gratuity_claim);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'gratuity_claim',
                'table_heading' => 'Gratuity Claim'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'gratuity_claim'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled); 
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;

  }

  public function addGratuityClaimWithLogin($gratuity_claim){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('gratuity_claim', $gratuity_claim);
      $notice_id  = $this->db->insert_id();
      $uniqid = $gratuity_claim["user_id"];

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'gratuity_claim',
                'table_heading' => 'Gratuity Claim'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'gratuity_claim'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled); 
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      
      return $result; 

  }


  
  public function addSalaryDuesWithoutLogin($register,$salary_dues){ 

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];
      $register  = $this->db->insert('register', $register);
      $result    = $this->db->insert('salary_dues', $salary_dues);
      $notice_id = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'salary_dues',
                'table_heading' => 'Salary Dues Notice  '
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'salary_dues',
                'pulled'        => '0'
      );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
     $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);



      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");

      return $result;
  }

  public function addSalaryDuesWithLogin($salary_dues){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('salary_dues', $salary_dues);
      $notice_id  = $this->db->insert_id();
      $uniqid    = $salary_dues['user_id'];

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'salary_dues',
                'table_heading' => 'Salary Dues'
      );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);

     $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'salary_dues',
                'pulled'        => '0'
     );

      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result; 
  }


  public function addEsiClaimWithoutLogin($register,$esi_claim){

      $this->load->database();
      $this->load->library('session');
      $uniqid    = $register['user_id'];
      $register = $this->db->insert('register', $register);
      $result   = $this->db->insert('esi_claim', $esi_claim);
      $notice_id  = $this->db->insert_id();
     

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'esi_claim',
                'table_heading' => 'ESI Claim'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'esi_claim',
                'pulled'        => '0'
      );


      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;
  }

  public function addEsiClaimWithLogin($esi_claim){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('esi_claim', $esi_claim);
      $notice_id  = $this->db->insert_id();
      $uniqid    = $esi_claim['user_id'];
      $notice_id = $notice_id;
      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'esi_claim',
                'table_heading' => 'ESI Claim'
      );

     $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
     $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'esi_claim',
                'pulled'        => '0'
     );

      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;



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

  public function addHarrashmentWithoutLogin($register,$harrashment){

      $this->load->database();
      $this->load->library('session');
      $uniqid = $register["user_id"];
      $register = $this->db->insert('register', $register);
      $result   = $this->db->insert('harrashment', $harrashment);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'harrashment',
                'table_heading' => 'Sexual Harassment'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'harrashment'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);

      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;
  }

  public function addHarrashmentWithLogin($harrashment){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('harrashment', $harrashment);
      $notice_id  = $this->db->insert_id();
      $uniqid    = $harrashment['user_id'];

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'harrashment',
                'table_heading' => 'Sexual Harassment'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'harrashment'
      );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;
  }


  public function addVoilationAggrementWithoutLogin($register,$voilation_aggrement){

      $this->load->database();
      $this->load->library('session');
      $uniqid = $register["user_id"];
      $register         = $this->db->insert('register', $register);
      $result = $this->db->insert('voilation_aggrement', $voilation_aggrement);
      $notice_id  = $this->db->insert_id();

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'voilation_aggrement',
                'table_heading' => 'Violation Of Aggrement'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'voilation_aggrement'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");

      return $result;
  }

  public function addVoilationAggrementWithLogin($voilation_aggrement){

      $this->load->database();
      $this->load->library('session');
      $result = $this->db->insert('voilation_aggrement', $voilation_aggrement);
      $notice_id  = $this->db->insert_id();
      $uniqid = $voilation_aggrement["user_id"];

      $user_notice_filled = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'voilation_aggrement',
                'table_heading' => 'Violation Of Aggrement'
      );

      $advocate_pulled_notice = array(

                'user_id'       => $uniqid,
                'notice_id'     => $notice_id,
                'table_name'    => 'voilation_aggrement'
        );

      $user_notice_filled     = $this->db->insert('user_notice_filled', $user_notice_filled);
      $advocate_pulled_notice = $this->db->insert('advocate_pulled_notice', $advocate_pulled_notice);
      $this->session->set_userdata('final_filled',"1");
      $this->session->set_userdata('notice_initiated',"0");
      $this->session->set_userdata('session_data',"");
      return $result;
  }








}


?>