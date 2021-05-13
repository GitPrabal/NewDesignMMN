<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

function __construct() {
parent::__construct();
}

public function checkRegisteredUser($consumer_phone,$consumer_email){

    
  $this->load->database();
  $this->load->library('form_validation');
  $this->load->helper('form');
  $this->load->library('session');

  $this->db->select('email');
  $this->db->select('phone');
  $this->db->from('register');
  $this->db->where('email',$consumer_email);
  $this->db->where('phone',$consumer_phone);
  $query   = $this->db->get();
  $row = $query->row();
  $result  = $query->num_rows();

  return $result;

}

public function userRegistration( $data ){

  $email    = $data['email'];
  $phone    = $data['phone'];
  $user_id  = $data['user_id'];
  $name     = $data['first_name'];

  $this->load->database();
  $this->load->library('form_validation');
  $this->load->helper('form');
  $this->load->library('session');

  $this->db->select('email');
  $this->db->from('register');
  $this->db->where('email',$email);
  $query   = $this->db->get();
  $result  = $query->num_rows();

    if($result > 0){
      $result  = array("msg"=>"Email Id already exist","status"=>"404","focus"=>"email");
      $result  = json_encode($result);
      echo $result;
        return;
    }

  $this->db->select('phone');
  $this->db->from('register');
  $this->db->where('phone',$phone);
  $query   = $this->db->get();
  $result  = $query->num_rows();

    if($result > 0){
  $result  = array("msg"=>"Phone number is already exist","status"=>"404","focus"=>"phone");
  $result  = json_encode($result);
  echo $result;
    exit;
    }

    $result1 = $this->db->insert('register', $data);

    if($result1){

      $this->load->library('session');
      $this->session->set_userdata('user_id',$user_id);
      $this->session->set_userdata('name',$data['first_name']);
      $this->session->set_userdata('email',$data['email']);

    $result  = array("msg"=>"Thanks for registered with us","status"=>"200");
    $result  = json_encode($result);
    echo $result;
      

    }else{
    $result  = array("msg"=>"Unable to register with us","status"=>"300");
    $result  = json_encode($result);
    echo $result;
    
    }

  }

  public function  login($data){


    $email    = $data['email'];
    $password = $data['password'];
    
  $this->load->database();
  $this->load->library('form_validation');
  $this->load->helper('form');
  $this->load->library('session');

  $this->db->select('email');
  $this->db->select('password');
  $this->db->select('user_id');
  $this->db->from('register');
  $this->db->where('email',$email);
  $this->db->where('password',$password);
  $query   = $this->db->get();
  $row = $query->row();
  $result  = $query->num_rows();


    if( $result == 1 || $result == '1' || $result > 1 ){
      $user_id = $row->user_id;
      $email = $row->email;
      $this->session->set_userdata('user_id',$user_id);
      $this->session->set_userdata('email',$email);
      $this->session->set_userdata('user_login',"true");

        $data = array('user_id',$user_id);
        return 1;

    }else{
      return 2;
    }


  }

  public function retriveNotices(){

    $this->load->database();
    $this->db->select('*');
    $this->db->from('notices');
    $query   = $this->db->get();

    /* Fetch All Records */

    $row     = $query->result();
    $result  = $query->num_rows();
    return $row;

  }

  public function retriveUserData($user_id){
    
    $this->load->database();
    $this->db->select('*');
    $this->db->from('register');
    $this->db->where('user_id',$user_id);
    
    $query   = $this->db->get();
    $row     = $query->result();
    return $row;
  }

  public function retriveUserNoticeFilled($user_id){

    $this->load->database();
    $this->db->select('table_name,notice_id');
    $this->db->from('user_notice_filled');
    $this->db->where('user_id',$user_id);
    $query   = $this->db->get();
    $row     = $query->result();
    return $row;
  }

  public function retriveNoticeDetail($table_name,$id){

    $this->db->select('advocate_pulled_notice.*,

        advocate_pulled_notice.pulled_by,advocate_pulled_notice.pulled,advocate_pulled_notice.approved_by_user,'.$table_name.'.id as notice_id,'.$table_name.'.id,'.$table_name.'.*');
    $this->db->from($table_name)->join('advocate_pulled_notice','advocate_pulled_notice.notice_id = '.$table_name.'.id','left');
    $this->db->where('advocate_pulled_notice.table_name', $table_name);
    $this->db->where('advocate_pulled_notice.notice_id', $id);
    $query = $this->db->get();
    $pf_claim_list  = $query->result();

    return $pf_claim_list;

  }

  public function submitMotorNotice($data){


        $this->load->database();
        $this->load->library('session');

        $email_sender      =  $data['email_sender'];
        $number_sender     =  $data['number_sender'];
        $email_recipeient  =  $data['email_recipeient'];
        $number_recipient  =  $data['number_recipient'];

        $this->session->set_userdata('email_sender',$email_sender);
        $this->session->set_userdata('number_sender',$number_sender);

        $this->session->set_userdata('email_recipeient',$email_recipeient);
        $this->session->set_userdata('number_recipient',$number_recipient);


      $result = $this->db->insert('motor_notice', $data);
      $last_insert_id = $this->db->insert_id();
      $this->session->set_userdata('last_insert_id',$last_insert_id);
      $true = 'true';
      $this->session->set_userdata('goto_basic_details',$true);
      return $result;

  }

  public function addConsumerData($user_data,$data){

      $this->load->database();
      $this->load->library('session');
      $user_login      = $this->session->userdata('user_login');

       if( !($user_login) ){

        $email    = $user_data['email'];
        $phone    = $user_data['phone'];
        $user_id  = $user_data['user_id'];
        $name     = $user_data['first_name'];

        $this->load->database();
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->library('session');

        $this->db->select('email');
        $this->db->from('register');
        $this->db->where('email',$email);
        $query   = $this->db->get();
        $result  = $query->num_rows();

        if($result > 0){
          $result  = array("msg"=>"Email Id already exist","status"=>"404","focus"=>"email");
          $result  = json_encode($result);
          echo $result;
          return;
        }

        $this->db->select('phone');
        $this->db->from('register');
        $this->db->where('phone',$phone);
        $query   = $this->db->get();
        $result  = $query->num_rows();

        if($result > 0){
          $result  = array("msg"=>"Phone number is already exist","status"=>"404","focus"=>"phone");
          $result  = json_encode($result);
          echo $result;
          exit;
        }

    $result1 = $this->db->insert('register', $user_data);
    $result = $this->db->insert('consumernotice', $data);
    $last_insert_id = $this->db->insert_id();
    $this->session->set_userdata('consumer_last_insert_id',$last_insert_id);

     if($result){
          $result  = array("msg"=>"Notice Filled","status"=>"200","focus"=>"null");
          $result  = json_encode($result);
          echo $result;
          exit;
        }

    }else{

          $result = $this->db->insert('consumernotice', $data);
          $last_insert_id = $this->db->insert_id();
          $this->session->set_userdata('consumer_last_insert_id',$last_insert_id);
    
          $result  = array("msg"=>"Notice Filled","status"=>"200","focus"=>"null");
          $result  = json_encode($result);
          echo $result;
          exit;
       

    }



  }

  public function addDefendantData($register,$consumernotice,$consumer_defendant){

      $this->load->database();
      $this->load->library('session');

      $register         = $this->db->insert('register', $register);
      $consumernotice   = $this->db->insert('consumernotice', $consumernotice);
      $consumer_last_id = $this->db->insert_id();

      $consumer_defendant = array(

            'user_id'              => $consumer_defendant['user_id'],
            'consumer_last_id'     => $consumer_last_id,
            'company_name'         => $consumer_defendant['company_name'],
            'address_defendant'    => $consumer_defendant['address_defendant'],
            'commodity'            => $consumer_defendant['commodity'],
            'warranty_attachment'  => $consumer_defendant['warranty_attachment'],
            'bill_attachment'      => $consumer_defendant['bill_attachment'],
            'date_purchase'        => $consumer_defendant['date_purchase'],
            'box_picture'          => $consumer_defendant['box_picture'],
            'complaint'            => $consumer_defendant['complaint'],
            'relief'               => $consumer_defendant['relief']

        );


      $result = $this->db->insert('consumer_defendant', $consumer_defendant);
      $this->session->set_userdata('final_filled',"1");

      return $result;
  }





  public function submitQuery($data,$session_user_id){

        date_default_timezone_set('Asia/Kolkata');
        $this->load->database();

        $id        =  $data['id'];
        $tablename =  $data['tablename'];
        $query     =  $data['query'];

        $this->db->set('query',$query);
        $this->db->where('id', $id);
        $this->db->where('user_id', $session_user_id);
        $this->db->where('table_name', $tablename);

        $result = $this->db->update('advocate_pulled_notice'); //
        return $result;

  }

   public function userApproveNotice($data){

        $this->load->database();

        $id        =  $data['id'];
        $tablename =  $data['tablename'];
        $user_id   =  $data['user_id'];

        $approved_time =  date("d-m-Y h:i:s A");
        
        $this->db->set('approved_by_user',"1");  //Set the column name and which value to set..
        $this->db->set('approved_time',$approved_time);

        $this->db->where('notice_id', $id); //set column_name and value in which row need to update
        $this->db->where('user_id', $user_id);
        $this->db->where('table_name', $tablename);

        $result = $this->db->update('advocate_pulled_notice'); //
        return $result;

  }




}
?>