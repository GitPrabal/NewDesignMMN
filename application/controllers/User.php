<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

    public function index(){
        
        $this->load->model('user_model');
        $this->load->library('session');
        
        //Including validation library
        //Setting values for tabel columns

        $user_id   = $this->session->userdata('user_id');
        $data = array(
            'user_id' => $user_id
        );

        $unique_id = uniqid();


        $data = array(
            'user_id'    => $unique_id,
            'first_name' => $this->input->post('first_name'),
            'last_name'  => $this->input->post('last_name'),
            'email'      => $this->input->post('email'),
            'phone'      => $this->input->post('phone'),
            'password'   => $this->input->post('password'),
            'dob'        => $this->input->post('dob'),
            'age'        => $this->input->post('age'),
            'gender'     => $this->input->post('gender')
        );
        
        //Transfering data to Model
        $result = $this->user_model->userRegistration($data);
        echo $result;
    }
    
	

	public function login(){

		$this->load->model('user_model');
        $this->load->helper('url'); 
        $data = array(
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password')
        );
        $result = $this->user_model->login($data);

        if($result){
           echo $result;
        }else{
            $result  = array("msg"=>"Invalid Credentials","status"=>"300");
            $result  = json_encode($result);
            echo $result;
        }

	}

    public function userLogOut(){

        $this->load->library('session');
        $this->load->helper('url');
        $session_user_id = $this->session->userdata('user_id');
        $this->session->sess_destroy();
        echo "1";

    }

    public function userHome(){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');
        $session_user_id = $this->session->userdata('user_id');
        $session_email = $this->session->userdata('email');
        $user_login = $this->session->userdata('user_login');
        $user_id    = $this->session->userdata('user_id');

        $noticeList = array();

        if( $user_login ){

            $userData = $this->user_model->retriveUserNoticeFilled($session_user_id);

            for ( $i = 0; $i < count($userData); $i++  ){

                $noticeList[]  = $this->user_model->retriveNoticeDetail( $userData[$i]->table_name , $userData[$i]->notice_id);
            }

            $userData = $this->user_model->retriveUserData($session_user_id);

            $data =  array( 'data' => $userData , 'noticeList'=> $noticeList);

            $this->load->view('Headers/login_header');
            $this->load->view('user_home', $data);
            $this->load->view('user_notice_filled', $data);
            $this->load->view('generateQueryModal.php');

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('home');

        }

    }

    public function retrieveNotices($user_id){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');



        return $notice_list;

    }

    public function consumer_notices(){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');
        $session_user_id = $this->session->userdata('user_id');
        $session_email = $this->session->userdata('email');


        if (empty($session_user_id) || $session_user_id == '') {
            $this->session->unset_userdata('user_id');
            $this->session->sess_destroy();
            $data = array('user_id' => '');
            $this->load->view('consumer_case', $data);
        } else {
            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('consumer_case', $data);
        }

       
    }

    public function approvedNotice(){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');
        $session_user_id = $this->session->userdata('user_id');
        $session_email = $this->session->userdata('email');

        
        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $userData = $this->user_model->retriveUserData($session_user_id);
            $data =  array( 'data' => $userData );
            $this->load->view('Headers/login_header');
            $this->load->view('approved_notice', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('home');
        }

    }

    public function reviewNotice(){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');
        $session_user_id = $this->session->userdata('user_id');
        $session_email = $this->session->userdata('email');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $userData = $this->user_model->retriveUserData($session_user_id);
            $data =  array( 'data' => $userData );
            $this->load->view('Headers/login_header');
            $this->load->view('review_notice', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('home');

        }

    }

    public function addConsumerData(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');

        $consumer_fname = $_POST["consumer-fname"];
        $consumer_lname = $_POST["consumer-lname"];
        $consumer_email   = $_POST["consumer-email"];
        $consumer_phone   = $_POST["consumer-phone"];
        $consumer_pincode = $_POST["consumer-pincode"];
        $consumer_state   = $_POST["consumer-state"];
        $consumer_address = $_POST["consumer-address"];

        $aadhar_front          =  $_FILES["adhar_front"]["name"];
        $aadhar_front_tmp_name =  $_FILES["adhar_front"]["tmp_name"];

        $adhar_back            =  $_FILES["adhar_back"]["name"];
        $adhar_back_tmp_name   =  $_FILES["adhar_back"]["tmp_name"];

        $consumer_fname = $_POST["consumer-fname"];
        $consumer_lname = $_POST["consumer-lname"];

        $session_user_id = $this->session->userdata('user_id');

        /* Check User Exists */
        
        $result = $this->user_model->checkRegisteredUser($consumer_phone,$consumer_email);

        echo $result;die;

        if($result == "1" ){
            echo  $result;
            return;
        }




        /* Move Files to the folder */

        if(isset($_FILES['adhar_front']['name'])){ 

            $temp                  = explode(".", $_FILES['adhar_front']['name']);
            $motor_fir_certificate = round(microtime(true)+rand(10,100000)) . '.' . end($temp);
     
            $target_file   = APPPATH."notice_images/consumer_notice/";
            $file_name     = $_FILES['adhar_front']['name'];
            $file_tmp_name = $_FILES['adhar_front']['tmp_name'];
            $uploadeFlag1   = move_uploaded_file( $file_tmp_name , $target_file.$motor_fir_certificate );
        }


        if(isset($_FILES['adhar_back']['name'])){ 

            $temp                  = explode(".", $_FILES['adhar_back']['name']);
            $motor_fir_certificate = round(microtime(true)+rand(10,100000)) . '.' . end($temp);
     
            $target_file   = APPPATH."notice_images/consumer_notice/";
            $file_name     = $_FILES['adhar_back']['name'];
            $file_tmp_name = $_FILES['adhar_back']['tmp_name'];
            $uploadeFlag1   = move_uploaded_file( $file_tmp_name , $target_file.$motor_fir_certificate );
        }


        $data = array(

            'user_id'          => $this->session->userdata('user_id'),
            'consumer_name'    => $consumer_fname,
            'consumer_lname'   => $consumer_lname,
            'consumer_email'   => $consumer_email,
            'consumer_phone'   => $consumer_phone,
            'consumer_pincode' => $consumer_pincode,
            'consumer_state'   => $consumer_state,
            'consumer_address' => $consumer_address,
            'aadhar_front'     => $aadhar_front,
            'aadhar_back'      => $adhar_back

        );

        $result = $this->user_model->addConsumerData($data);

        if($result){
        echo  $result;
        }else{
            echo "2";
        }

    }

    public function submitQuery(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        $session_user_id = $this->session->userdata('user_id');

        $result = $this->user_model->submitQuery($_POST,$session_user_id);
        echo  $result;

    }

    public function userApproveNotice(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        $session_user_id = $this->session->userdata('user_id');

        $id =  $_POST['id'];
        $tablename =  $_POST['tablename'];

        $data    = array(

            'id'            => $id,
            'tablename'     => $tablename,
            'user_id'       => $session_user_id

            );

        $result = $this->user_model->userApproveNotice($data);
        echo  $result;

    }




    
    

}
