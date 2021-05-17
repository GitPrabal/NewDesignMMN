<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rental_Disputes extends CI_Controller {

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
        $this->load->helper('url'); 

        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('home', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('home');

        }
    }

    /* ------------------------------ Delay Construction ---------------------------- */



    public function delayConstructionFinalSubmit(){

        $this->load->model('user_model');
        $this->load->model('Rental_Disputes_model');

        $this->load->library('session');
        $this->load->helper('url');

        $notice_initiated  = $this->session->userdata('notice_initiated');
        $user_login        = $this->session->userdata('user_login');
        $session_user_id   = $this->session->userdata('user_id');

        $uniqid = uniqid();

        $adhar_front_name          = $this->session->userdata('adhar_front_name');
        $adhar_back_name           = $this->session->userdata('adhar_back_name');
        $agreement_attachment_name = $this->session->userdata('agreement_attachment_name');

        $_POST =  $_POST;

        $company_name             = $_POST['company_name'];
        $address_defendant        = $_POST['address_defendant'];
        $details_project          = $_POST['details_project'];
        $complaint                = $_POST['complaint'];

         if( !$user_login ){


                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['firstname'],
                    'last_name'  => $_SESSION['basic_details']['lastname'],
                    'email'      => $_SESSION['basic_details']['email'],
                    'phone'      => $_SESSION['basic_details']['phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $delay_in_construction = array(

                    'user_id'                   => $uniqid,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'details_complainant'       => $_SESSION['basic_details']['detail_complainant'],
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'company_name'              => $company_name, 
                    'address_defendant'         => $address_defendant,
                    'details_project'           => $details_project,
                    'attachment_agreement'      => $agreement_attachment_name,
                    'complaint'                 => $complaint

            );

                $userData = $this->Rental_Disputes_model->addDelayInConstructionWithoutLogin($register,$delay_in_construction);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }


            }else{

                $delay_in_construction = array(

                    'user_id'                   => $uniqid,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'details_complainant'       => $_SESSION['basic_details']['detail_complainant'],
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'company_name'              => $_POST['company_name'], 
                    'address_defendant'         => $_POST['address_defendant'],
                    'details_project'           => $_POST['details_project'],
                    'attachment_agreement'      => $agreement_attachment_name,
                    'complaint'                 => $_POST['complaint']

                );
                 
                $userData = $this->Rental_Disputes_model->addDelayInConstruction($delay_in_construction);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }


    }


    

    /* ------------------------- End Construction Func ------------------- */




 

    public function addTerminationBasicDetail(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["email"];
        $consumer_phone   = $_POST["phone"];

        $session_user_id = $this->session->userdata('user_id');
        $user_login      = $this->session->userdata('user_login');

        /* Check User Exists */

        if( !isset($user_login) && empty($user_login)){
            
        $result = $this->user_model->checkRegisteredUser($consumer_phone,$consumer_email);

        if($result > 0 ){
            echo  "3";
            return;
        }
    }

   



        $_SESSION['basic_details']=array();

        $_SESSION['basic_details'] = $_POST;
        $_SESSION['rental_lessor_files'] = $_FILES;

        $this->session->set_userdata('consumer_filled',"1");
        $this->session->set_userdata('notice_initiated',"1");

        echo "1";
        die;

    }


    public function termination_defendant_notice(){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

         if( $user_login ){

            if( ( $notice_initiated == 0 ) || ( $notice_initiated == "0" ) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Rental_Disputes/termination_basic_details',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Rental_Disputes/termination_defendant_notice',$data);

            }

         }else{

            if( ( $notice_initiated == 0 ) || ( $notice_initiated == "0" ) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Rental_Disputes/termination_basic_details',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Rental_Disputes/termination_defendant_notice',$data);
            }

         }

    }

    public function rentalLessorFinalSubmit(){

        $this->load->model('user_model');
        $this->load->model('Rental_Disputes_model');

        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

        $uniqid = uniqid();
       
        $company_name      =  $_POST['company_name'];
        $address_defendant =  $_POST['address_defendant'];
        $complaint         =  $_POST['complaint'];
        $relief            =  $_POST['relief'];

        $adhar_front_name = $this->session->userdata('adhar_front_name');
        $adhar_back_name  = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['agreement_attachment']['name'])){
            $agreement_attachment  =  uploadFiles($_FILES['agreement_attachment']);
        }else{
            $agreement_attachment = "";
        }

        if(isset($_FILES['previous_notice']['name'])){
            $previous_notice  =  uploadFiles($_FILES['previous_notice']);
        }else{
            $previous_notice = "";
        }

         if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['firstname'],
                    'last_name'  => $_SESSION['basic_details']['lastname'],
                    'email'      => $_SESSION['basic_details']['email'],
                    'phone'      => $_SESSION['basic_details']['phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $lessor_dispute = array(

                    'user_id'                   => $uniqid,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'complainant_basic'         => '',
                    'details_complainant_basic' => '',
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'company_name'              => $company_name, 
                    'address_defendant'         => $address_defendant,
                    'complaint'                 => $complaint,
                    'relief'                    => $relief,
                    'aggreement_attachment'     => $agreement_attachment, 
                    'previous_attachment'       => $previous_notice

            );

                $userData = $this->Rental_Disputes_model->addRentalData($register,$lessor_dispute);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }


            }else{

                $lessor_dispute = array(

                    'user_id'                   => $session_user_id,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'complainant_basic'         => '',
                    'details_complainant_basic' => '',
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'company_name'              => $_POST['company_name'], 
                    'address_defendant'         => $_POST['address_defendant'] ,
                    'complaint'                 => $_POST['complaint'],
                    'relief'                    => $_POST['relief'],
                    'aggreement_attachment'     => $agreement_attachment_name, 
                    'previous_attachment'       => $previous_notice_name

            );
                 
                $userData = $this->Rental_Disputes_model->addRentalDataWithoutLogin($lessor_dispute);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }


    }


    public function terminationFinalSubmit(){

        $this->load->model('Rental_Disputes_model');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('upload');

        $this->load->model('user_model');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $adhar_front_name          = $this->session->userdata('adhar_front_name');
        $adhar_back_name           = $this->session->userdata('adhar_back_name');
        $previous_notice_name      = $this->session->userdata('previous_notice_name');
        $agreement_attachment_name = $this->session->userdata('agreement_attachment_name');

        $company_name              = $_POST['company_name'];
        $address_defendant         = $_POST['address_defendant'];
        $reason_termination        = $_POST['reason_termination'];
        $relief                    = $_POST['relief'];

        if(isset($_FILES['agreement_attachment']['name'])){
            $agreement_attachment  =  uploadFiles($_FILES['agreement_attachment']);
        }else{
            $agreement_attachment = "";
        }

        if(isset($_FILES['previous_notice']['name'])){
            $previous_notice  =  uploadFiles($_FILES['previous_notice']);
        }else{
            $previous_notice = "";
        }


         if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['firstname'],
                    'last_name'  => $_SESSION['basic_details']['lastname'],
                    'email'      => $_SESSION['basic_details']['email'],
                    'phone'      => $_SESSION['basic_details']['phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name
                );

                $termination_rental = array(

                    'user_id'           => $uniqid,
                    'first_name'        => $_SESSION['basic_details']['firstname'],
                    'last_name'         => $_SESSION['basic_details']['lastname'],
                    'dob'               => $_SESSION['basic_details']['dob'],
                    'email'             => $_SESSION['basic_details']['email'],
                    'phone'             => $_SESSION['basic_details']['phone'],
                    'pincode'           => $_SESSION['basic_details']['pincode'],
                    'state'             => $_SESSION['basic_details']['state'],
                    'address'           => $_SESSION['basic_details']['address'], 
                    'first_party'          => '' ,
                    'adhar_front'          => $adhar_front_name,
                    'adhar_back'           => $adhar_back_name,
                    'company_name'         => $company_name, 
                    'address_defendant'    => $address_defendant,
                    'attachment_agreement' => $agreement_attachment,
                    'previous_notice'      => $previous_notice,
                    'reason_termination'   => $reason_termination,
                    'relief'               => $relief


            );

                $userData = $this->Rental_Disputes_model->addTerminationDefendantDataWithoutLogin($register,$termination_rental);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }


            }else{

                $termination_rental = array(

                    'user_id'           => $session_user_id,
                    'first_name'        => $_SESSION['basic_details']['firstname'],
                    'last_name'         => $_SESSION['basic_details']['lastname'],
                    'dob'               => $_SESSION['basic_details']['dob'],
                    'email'             => $_SESSION['basic_details']['email'],
                    'phone'             => $_SESSION['basic_details']['phone'],
                    'pincode'           => $_SESSION['basic_details']['pincode'],
                    'state'             => $_SESSION['basic_details']['state'],
                    'address'           => $_SESSION['basic_details']['address'], 
                    'first_party'          => '',
                    'adhar_front'          => $adhar_front_name,
                    'adhar_back'           => $adhar_back_name,
                    'company_name'         => $company_name, 
                    'address_defendant'    => $address_defendant,
                    'attachment_agreement' => $agreement_attachment,
                    'previous_notice'      => $previous_notice,
                    'reason_termination'   => $reason_termination,
                    'relief'               => $relief


            );

                $userData = $this->Rental_Disputes_model->addTerminationDefendantData($termination_rental);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }

    }
}    



    public function congoPage(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');

        $this->session->unset_userdata('consumer_last_insert_id');
        $this->session->set_userdata('notice_filled',"1");
        $final_filled   = $this->session->userdata('final_filled');

        $user_login     = $this->session->userdata('user_login');



        if( $user_login ){
            
            $session_user_id   = $this->session->userdata('session_user_id');

             if( !isset($final_filled) && empty($final_filled) ){

                $this->session->unset_userdata('final_filled');
                $this->session->unset_userdata('consumer_filled');

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('congo',$data);
                return;

            }else{
                

                $this->session->unset_userdata('final_filled');
                $this->session->unset_userdata('consumer_filled');

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('congo',$data);
                return;

            }

         }else{

            if( !isset($final_filled) && empty($final_filled) ){

                $data = array('user_id' => '');
                $this->load->view('Headers/header');
                $this->load->view('congo',$data);
                $this->session->unset_userdata('final_filled');
                $this->session->unset_userdata('consumer_filled');

                return;
            }else{

                $this->session->unset_userdata('final_filled');
                $this->session->unset_userdata('consumer_filled');

              //  $userData = $this->user_model->retriveUserData($session_user_id);
                $data = array('user_id' => '');
                $this->load->view('Headers/header');
                $this->load->view('congo',$data);
            }

         }

    }

    /* ------------------------------------------------------ Arbitration Notice ------------------- */



    public function arbitration_notice(){


        $this->load->helper('url');

        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('Rental_Disputes/arbitration_basic_notice', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('Rental_Disputes/arbitration_basic_notice');

        }


    }

    public function addArbitrationBasicDetails(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["email"];
        $consumer_phone   = $_POST["phone"];

        $session_user_id = $this->session->userdata('user_id');
        $user_login      = $this->session->userdata('user_login');

        /* Check User Exists */

        if( !isset($user_login) && empty($user_login)){
            
        $result = $this->user_model->checkRegisteredUser($consumer_phone,$consumer_email);

        if($result > 0 ){
            echo  "3";
            return;
        }
    }


    if(isset($_FILES['adhar_front']['name'])){ 

             $adhar_front_name  =  $this->uploadFiles($_FILES['adhar_front']);
             $this->session->set_userdata('adhar_front_name',$adhar_front_name);

    }else{
            $this->session->set_userdata('adhar_front_name',"");
    }

    if(isset($_FILES['adhar_back']['name'])){

            $adhar_back_name   =  $this->uploadFiles($_FILES['adhar_back']);
            $this->session->set_userdata('adhar_back_name',$adhar_back_name);

    }else{

            $this->session->set_userdata('adhar_back_name',"");
    }



        $_SESSION['basic_details']=array();

        $_SESSION['basic_details'] = $_POST;
        $_SESSION['rental_lessor_files'] = $_FILES;

        $this->session->set_userdata('consumer_filled',"1");
        $this->session->set_userdata('notice_initiated',"1");

        echo "1";
        die;

    }

    public function arbitration_defendant_notice(){

        $this->load->model('user_model');
        $this->load->library('session');
        $this->load->helper('url');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

         if( $user_login ){

            if( ( $notice_initiated == 0 ) || ( $notice_initiated == "0" ) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Rental_Disputes/arbitration_basic_notice',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Rental_Disputes/arbitration_defendant_notice',$data);

            }

         }else{

            if( ( $notice_initiated == 0 ) || ( $notice_initiated == "0" ) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Rental_Disputes/arbitration_basic_notice',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Rental_Disputes/arbitration_defendant_notice',$data);

            }

         }

    }

    public function addArbitrationDefendant(){


        $this->load->model('Rental_Disputes_model');

        $this->load->library('session');
        $this->load->helper('url');

        $this->load->model('user_model');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();


        if(isset($_FILES['agreement_attachment']['name'])){

            $agreement_attachment_name   =  $this->uploadFiles($_FILES['agreement_attachment']);

        }else{

            $agreement_attachment_name = "";

        }

        if(isset($_FILES['previous_notice']['name'])){

            $previous_notice_name   =  $this->uploadFiles($_FILES['previous_notice']);
           
        }else{

            $previous_notice_name = "";

        }

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $this->session->set_userdata('agreement_attachment_name',$agreement_attachment_name);
        $this->session->set_userdata('previous_notice_name',$previous_notice_name);
        $_POST  =  $_POST;

        $company_name         = $_POST['company_name'];
        $address_defendant    = $_POST['address_defendant'];
        $name                 = $_POST['name_arbitraton'];
        $position             = $_POST['position'];
        $complaint            = $_POST['complaint'];
        $relief               = $_POST['relief'];

        $rsultString  = "";

        $rsultString .= '<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form" style="margin: 0px 35px auto;padding:20px 0px 5px 0px;">
              
                <form>
                 <center><h3>Consumer Details</h3></center>
                <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>First Name</th>
               <td>'.$_SESSION['basic_details']['firstname'].'</td>
            </tr>
            <tr>
               <th>Last Name</th>
               <td>'.$_SESSION['basic_details']['lastname'].'</td>
            </tr>
            <tr>
               <th>Date Of Birth</th>
               <td>'.$_SESSION['basic_details']['dob'].'</td>
            </tr>
            <tr>
               <th>Email Id</th>
               <td>'.$_SESSION['basic_details']['email'].'</td>
            </tr>
            <tr>
               <th>Phone Number</th>
               <td>'.$_SESSION['basic_details']['phone'].'</td>
            </tr>
            <tr>
               <th>Pin Code</th>
               <td>'.$_SESSION['basic_details']['pincode'].'</td>
            </tr>
            <tr>
               <th>State</th>
               <td>'.$_SESSION['basic_details']['state'].'</td>
            </tr>
            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['address'].'</td>
            </tr>';

              if ( strpos($adhar_front_name, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Aadhar Front Side</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$adhar_front_name.'" target="_blank" >View PDF</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Aadhar Front Side</th></td>
               <td><img src="/notice_images/'.$adhar_front_name.'" height="20" width="20" id="adhar_back" style="cursor:pointer;" ></img></td>
               <td><a href="/notice_images/'.$adhar_front_name.'" target="_blank">View</a></td>
            </tr>';

            }

            if ( strpos($adhar_back_name, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Aadhar Back Side</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$adhar_back_name.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Aadhar Back Side</th></td>
               <td><img src="/notice_images/'.$adhar_back_name.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$adhar_back_name.'" target="_blank">View</a></td>
            </tr>';

            }

            $rsultString .='
           
           
              </table>

              <center><h3>Defendant Details</h3></center>

              <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>Company Name</th>
               <td>'.$company_name.'</td>
            </tr>
            <tr>
               <th>Address Of Defendant</th>
               <td>'.$address_defendant.'</td>
            </tr>
            <tr>
               <th>Position Or Credentials</th>
               <td>'.$position.'</td>
            </tr>
            <tr>
               <th>Relief</th>
               <td>'.$relief.'</td>
            </tr>
             <tr>
               <th>Complaint</th>
               <td>'.$complaint.'</td>
            </tr>
           
            ';

            if ( strpos($agreement_attachment_name, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Attachment Of Agreement</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$agreement_attachment_name.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Attachment Of Agreement</th></td>
               <td><img src="/notice_images/'.$agreement_attachment_name.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$agreement_attachment_name.'" target="_blank">View</a></td>
            </tr>';

            }

            if ( strpos($previous_notice_name, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Any Previous Notice</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$previous_notice_name.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Any Previous From Notice</th></td>
               <td><img src="/notice_images/'.$previous_notice_name.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$previous_notice_name.'" target="_blank">View</a></td>
            </tr>';

            }

            $rsultString .='
              </table>
                </form>
                </div>
            </div>
        </div>';

        echo  $rsultString;
        return;



    }


public function arbitrationFinalSubmit(){

        $this->load->model('Rental_Disputes_model');
        $this->load->library('session');
        $this->load->helper('url');

        $this->load->model('user_model');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $adhar_front_name           = $this->session->userdata('adhar_front_name');
        $adhar_back_name            = $this->session->userdata('adhar_back_name');
        $agreement_attachment_name  = $this->session->userdata('agreement_attachment_name');
        $previous_notice_name       = $this->session->userdata('previous_notice_name');

        $company_name         = $_POST['company_name'];
        $address_defendant    = $_POST['address_defendant'];
        $attachment_agreement = $agreement_attachment_name;
        $previous_notice      = $previous_notice_name;
        $name                 = $_POST['name_arbitraton'];
        $position             = $_POST['position'];
        $complaint            = $_POST['complaint'];
        $relief               = $_POST['relief'];

         if( !$user_login ){


                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['firstname'],
                    'last_name'  => $_SESSION['basic_details']['lastname'],
                    'email'      => $_SESSION['basic_details']['email'],
                    'phone'      => $_SESSION['basic_details']['phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $arbitration_rental = array(

                    'user_id'           => $uniqid,
                    'first_name'        => $_SESSION['basic_details']['firstname'],
                    'last_name'         => $_SESSION['basic_details']['lastname'],
                    'dob'               => $_SESSION['basic_details']['dob'],
                    'email'             => $_SESSION['basic_details']['email'],
                    'phone'             => $_SESSION['basic_details']['phone'],
                    'pincode'           => $_SESSION['basic_details']['pincode'],
                    'state'             => $_SESSION['basic_details']['state'],
                    'address'           => $_SESSION['basic_details']['address'], 
                    'first_party'          => $_SESSION['basic_details']['first_party'] ,
                    'adhar_front'          => $adhar_front_name,
                    'adhar_back'           => $adhar_back_name,
                    'company_name'         => $company_name, 
                    'address_defendant'    => $address_defendant,
                    'attachment_agreement' => $agreement_attachment_name,
                    'previous_notice'      => $previous_notice_name,
                    'name'                 => $name,
                    'position'             => $position,
                    'compaint'             => $complaint,
                    'relief'               => $relief


            );

                $userData = $this->Rental_Disputes_model->addArbitrationDataWithoutLogin($register,$arbitration_rental);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }


            }else{

                $arbitration_rental = array(

                    'user_id'              => $session_user_id,
                    'first_name'           => $_SESSION['basic_details']['firstname'],
                    'last_name'            => $_SESSION['basic_details']['lastname'],
                    'dob'                  => $_SESSION['basic_details']['dob'],
                    'email'                => $_SESSION['basic_details']['email'],
                    'phone'                => $_SESSION['basic_details']['phone'],
                    'pincode'              => $_SESSION['basic_details']['pincode'],
                    'state'                => $_SESSION['basic_details']['state'],
                    'address'              => $_SESSION['basic_details']['address'], 
                    'first_party'          => $_SESSION['basic_details']['first_party'] ,
                    'adhar_front'          => $adhar_front_name,
                    'adhar_back'           => $adhar_back_name,
                    'company_name'         => $company_name, 
                    'address_defendant'    => $address_defendant,
                    'attachment_agreement' => $agreement_attachment_name,
                    'previous_notice'      => $previous_notice_name,
                    'name'                 => $name,
                    'position'             => $position,
                    'compaint'             => $complaint,
                    'relief'               => $relief
            );


                $userData = $this->Rental_Disputes_model->addArbitrationData($arbitration_rental);

                 if($userData){
                     echo  "1";
                     return;

                }
                else{
                     echo "2";
                     return;
                }
         }
}    



public function uploadFiles($data){

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($data["tmp_name"],"notice_images/".$imageName.".".$extension);
            return $adhar_back_name =  $imageName.".".$extension;
    }


}



    

    