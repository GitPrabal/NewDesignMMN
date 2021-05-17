<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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

    /*------------------ Non Payment Of Salary ---------------------------------- */

    public function nonPaymentFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');


        $company_name     = $_POST['company_name'];
        $address_company  = $_POST['address_company'];
        $information      = $_POST['information'];
        $relief           = $_POST['relief'];

        if(isset($_FILES['employment_letter']['name'])){
            $employment_letter  =  uploadFiles($_FILES['employment_letter']);
        }else{
            $employment_letter = "";
        }


        if(isset($_FILES['communication']['name'])){
            $communication  =  uploadFiles($_FILES['communication']);

        }else{ $communication = ""; }

         if(isset($_FILES['bank_statement']['name'])){
           $bank_statement  =  uploadFiles($_FILES['bank_statement']);
        }else{

            $bank_statement = "";
        }

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        $uniqid = uniqid();

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

                $non_payment_salary = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'employment_letter'        => $employment_letter,
                    'bank_statement'         => $bank_statement,
                    'communication'          => $communication,
                    'relief'                   => $relief

            );

            $userData = $this->Employee_model->addNonPaymentSalaryWithoutLogin($register,$non_payment_salary);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

                 $non_payment_salary = array(

                    'user_id'                  => $session_user_id,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'employment_letter'        => $employment_letter,
                    'bank_statement'         => $bank_statement,
                    'communication'          => $communication,
                    'relief'                   => $relief

            );
                 
                $userData = $this->Employee_model->addNonPaymentSalaryWithLogin($non_payment_salary);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }


    /*------------------------------------- Abuse Of Power ------------------------------------------- */


    public function abusePowerFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

        $company_name          = $_POST['company_name'];
        $address_company       = $_POST['address_company'];
        $person_excersing      = $_POST['person_excersing'];
        $complaint             = $_POST['complaint'];
        $relief                = $_POST['relief'];
       
        $uniqid = uniqid();

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['employment_letter']['name'])){ 

            $employment_letter  =  uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter  = "";
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

                $abuse_power = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'employment_letter'        => $employment_letter,
                    'person_excersing'         => $person_excersing,
                    'complaint'                => $complaint,
                    'relief'                   => $relief

            );

            $userData = $this->Employee_model->addAbusePowerWithoutLogin($register,$abuse_power);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

                $abuse_power = array(

                    'user_id'                  => $session_user_id,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'employment_letter'        => $employment_letter,
                    'person_excersing'         => $person_excersing,
                    'complaint'                => $complaint,
                    'relief'                   => $relief

            );


                 
                $userData = $this->Employee_model->addAbusePowerWithLogin($abuse_power);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }

    /*  ------------------------  Gratuity Claim --------------------------------- */

    public function grauityFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();
 
        $company_name          = $_POST['company_name'];
        $address_company       = $_POST['address_company'];
        $gratuity_calculation  = $_POST['gratuity_calculation'];
        $complaint             = $_POST['complaint'];
        $relief                = $_POST['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        $employment_letter   = $this->session->userdata('employment_letter');
        $relieving_letter    = $this->session->userdata('relieving_letter');
        $communication_attachment = $this->session->userdata('communication_attachment');

        if(isset($_FILES['employment_letter']['name'])){ 

            $employment_letter  =  uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter  = "";
        }

         if(isset($_FILES['relieving_letter']['name'])){ 

            $relieving_letter  =  uploadFiles($_FILES['relieving_letter']);

        }else{

            $relieving_letter  = "";
        }

         if(isset($_FILES['communication_attachment']['name'])){ 

            $communication_attachment  =  uploadFiles($_FILES['communication_attachment']);

        }else{

            $communication_attachment  = "";
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

                $gratuity_claim = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'gratuity_calculation'     => $gratuity_calculation,
                    'employment_letter'        => $employment_letter,
                    'relieving_letter'         => $relieving_letter,
                    'communication_attachment' => $communication_attachment,
                    'complaint'                => $complaint,
                    'relief'                   => $relief

            );

            $userData = $this->Employee_model->addGratuityClaimWithoutLogin($register,$gratuity_claim);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

               $gratuity_claim = array(

                    'user_id'                  => $session_user_id,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'gratuity_calculation'     => $gratuity_calculation,
                    'employment_letter'        => $employment_letter,
                    'relieving_letter'         => $relieving_letter,
                    'communication_attachment' => $communication_attachment,
                    'complaint'                => $complaint,
                    'relief'                   => $relief

            );

                 
                $userData = $this->Employee_model->addGratuityClaimWithLogin($gratuity_claim);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }



    }





    /* ------------------  Voilation     ---------------------------- */

    public function voilationFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
        $uniqid = uniqid();

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $aggrement_employment    = $this->session->userdata('aggrement_employment');

        if(isset($_FILES['aggrement_employment']['name'])){ 

            $aggrement_employment  =  uploadFiles($_FILES['aggrement_employment']);

        }else{

            $aggrement_employment  = "";
        }

        $company_name          = $_POST['company_name'];
        $address_company       = $_POST['address_company'];
        $date_employment       = $_POST['date_employment'];
        $complaint             = $_POST['complaint'];
        $relief                = $_POST['relief'];


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

                $voilation_aggrement = array(

                    'user_id'                => $uniqid,
                    'first_name'             => $_SESSION['basic_details']['firstname'],
                    'last_name'              => $_SESSION['basic_details']['lastname'],
                    'dob'                    => $_SESSION['basic_details']['dob'],
                    'email'                  => $_SESSION['basic_details']['email'],
                    'phone'                  => $_SESSION['basic_details']['phone'],
                    'pincode'                => $_SESSION['basic_details']['pincode'],
                    'state'                  => $_SESSION['basic_details']['state'],
                    'address'                => $_SESSION['basic_details']['address'],
                    'adhar_front'            => $adhar_front_name,
                    'adhar_back'             => $adhar_back_name,
                    'company_name'           => $company_name, 
                    'address_company'        => $address_company,
                    'date_employment'       => $date_employment,
                    'aggrement_employment'  => $aggrement_employment,
                    'complaint'             => $complaint,
                    'relief'                => $relief

            );

            $userData = $this->Employee_model->addVoilationAggrementWithoutLogin($register,$voilation_aggrement);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

               $voilation_aggrement = array(

                    'user_id'                => $session_user_id,
                    'first_name'             => $_SESSION['basic_details']['firstname'],
                    'last_name'              => $_SESSION['basic_details']['lastname'],
                    'dob'                    => $_SESSION['basic_details']['dob'],
                    'email'                  => $_SESSION['basic_details']['email'],
                    'phone'                  => $_SESSION['basic_details']['phone'],
                    'pincode'                => $_SESSION['basic_details']['pincode'],
                    'state'                  => $_SESSION['basic_details']['state'],
                    'address'                => $_SESSION['basic_details']['address'],
                    'adhar_front'            => $adhar_front_name,
                    'adhar_back'             => $adhar_back_name,
                    'company_name'           => $company_name, 
                    'address_company'        => $address_company,
                    'date_employment'       => $date_employment,
                    'aggrement_employment'  => $aggrement_employment,
                    'complaint'             => $complaint,
                    'relief'                => $relief

            );
                 
                $userData = $this->Employee_model->addVoilationAggrementWithLogin($voilation_aggrement);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }


    /* -------------------  Harrashment  ---------------------------- */


    public function harrasmentFinalSubmit(){

        $this->load->library('session');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

        $uniqid = uniqid();

        $company_name          = $_POST['company_name'];
        $address_company       = $_POST['address_company'];
        $defendant_name        = $_POST['defendant_name'];
        $defendant_designation = $_POST['defendant_designation'];
        $complaint             = $_POST['complaint'];
        $relief                = $_POST['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

         if(isset($_FILES['complaint_harrashment']['name'])){

            $complaint_harrashment  =  uploadFiles($_FILES['complaint_harrashment']);

        }else{

            $complaint_harrashment = "";
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
                $harrashment = array(

                    'user_id'                => $uniqid,
                    'first_name'             => $_SESSION['basic_details']['firstname'],
                    'last_name'              => $_SESSION['basic_details']['lastname'],
                    'dob'                    => $_SESSION['basic_details']['dob'],
                    'email'                  => $_SESSION['basic_details']['email'],
                    'phone'                  => $_SESSION['basic_details']['phone'],
                    'pincode'                => $_SESSION['basic_details']['pincode'],
                    'state'                  => $_SESSION['basic_details']['state'],
                    'address'                => $_SESSION['basic_details']['address'],
                    'adhar_front'            => $adhar_front_name,
                    'adhar_back'             => $adhar_back_name,
                    'company_name'           => $company_name, 
                    'address_company'        => $address_company,
                    'defendant_name'         => $defendant_name,
                    'defendant_designation'  => $defendant_designation,
                    'complaint_harrashment'  => $complaint_harrashment,
                    'complaint'              => $complaint,
                    'relief'                 => $relief

            );

            $userData = $this->Employee_model->addHarrashmentWithoutLogin($register,$harrashment);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

              $harrashment = array(

                    'user_id'                => $uniqid,
                    'first_name'             => $_SESSION['basic_details']['firstname'],
                    'last_name'              => $_SESSION['basic_details']['lastname'],
                    'dob'                    => $_SESSION['basic_details']['dob'],
                    'email'                  => $_SESSION['basic_details']['email'],
                    'phone'                  => $_SESSION['basic_details']['phone'],
                    'pincode'                => $_SESSION['basic_details']['pincode'],
                    'state'                  => $_SESSION['basic_details']['state'],
                    'address'                => $_SESSION['basic_details']['address'],
                    'adhar_front'            => $adhar_front_name,
                    'adhar_back'             => $adhar_back_name,
                    'company_name'           => $company_name, 
                    'address_company'        => $address_company,
                    'defendant_name'         => $defendant_name,
                    'defendant_designation'  => $defendant_designation,
                    'complaint_harrashment'  => $complaint_harrashment,
                    'complaint'              => $complaint,
                    'relief'                 => $relief

            );
                 
                $userData = $this->Employee_model->addHarrashmentWithLogin($harrashment);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }
    }

  

    public function esiClaimFinalSubmit(){

       $this->load->library('session');
       $this->load->model('Employee_model');
       $this->load->helper('url');
       $this->load->helper('upload');
       $this->load->model('notice_model');
       $page_name = $this->session->userdata('page_name');
       $this->session->set_userdata('final_filled',"1");
       $notice_initiated = $this->session->userdata('notice_initiated');
       $user_login      = $this->session->userdata('user_login');
       $session_user_id = $this->session->userdata('user_id');
       $basic_details_filled = $this->session->userdata('basic_details_filled');
       $this->session->set_userdata('final_filled',"1");

       $_SESSION['session_data']  =  $_POST;

       $esi_office         = $_POST['esi_office'];
       $esi_office_address = $_POST['esi_office_address'];
       $type_esi_complaint = $_POST['type_esi_complaint'];
       $complaint          = $_POST['complaint'];
       $relief             = $_POST['relief'];
       $adhar_front_name   = $this->session->userdata('adhar_front_name');
       $adhar_back_name    = $this->session->userdata('adhar_back_name');

      $uniqid = uniqid();

        if(isset($_FILES['communication_esi']['name'])){

            $communication_esi_name  =  uploadFiles($_FILES['communication_esi']);

        }else{

            $communication_esi_name = "";
        }


        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

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

                $esi_claim = array(

                    'user_id'                   => $uniqid,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'local_esi_office'          => $esi_office, 
                    'address_office'            => $esi_office_address,
                    'esi_complaint'             => $type_esi_complaint,
                    'communication_attachment'  => $communication_esi_name,
                    'complaint'                 => $complaint,
                    'relief'                    => $relief

            );


                $userData = $this->Employee_model->addEsiClaimWithoutLogin($register,$esi_claim);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }
            }else{

               $esi_claim = array(

                    'user_id'                   => $session_user_id,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'local_esi_office'          => $esi_office, 
                    'address_office'            => $esi_office_address,
                    'esi_complaint'             => $type_esi_complaint,
                    'communication_attachment'  => $communication_esi_name,
                    'complaint'                 => $complaint,
                    'relief'                    => $relief

            );

                 
                $userData = $this->Employee_model->addEsiClaimWithLogin($esi_claim);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }
    }

  

    /*-------------------- Salary Dues ----------------------------------- */
   

    public function salaryFinalSubmit(){


        $this->load->library('session');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $adhar_front_name = $this->session->userdata('adhar_front_name');
        $adhar_back_name  = $this->session->userdata('adhar_back_name');


        if(isset($_FILES['salary_slip']['name'])){

            $salary_slip_name  =  uploadFiles($_FILES['salary_slip']);

        }else{

            $salary_slip_name = "";
        }

        if(isset($_FILES['communication_emp']['name'])){

            $communication_emp_name  =  uploadFiles($_FILES['communication_emp']);

        }else{

            $communication_emp_name = "";
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

                $salary_dues = array(

                    'user_id'                   => $uniqid,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'company_name'              => $_POST['company_name'], 
                    'address_defendant'         => $_POST['address_defendant'],
                    'date_emp'                  => $_POST['date_emp'],
                    'salary_slip'               => $salary_slip_name,
                    'communication_attachment'  => $communication_emp_name,
                    'complaint'                 => $_POST['complaint'],
                    'relief'                    => $_POST['relief']

            );

                $userData = $this->Employee_model->addSalaryDuesWithoutLogin($register,$salary_dues);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }


            }else{

               $salary_dues = array(

                    'user_id'                   => $session_user_id,
                    'first_name'                => $_SESSION['basic_details']['firstname'],
                    'last_name'                 => $_SESSION['basic_details']['lastname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['email'],
                    'phone'                     => $_SESSION['basic_details']['phone'],
                    'pincode'                   => $_SESSION['basic_details']['pincode'],
                    'state'                     => $_SESSION['basic_details']['state'],
                    'address'                   => $_SESSION['basic_details']['address'],
                    'adhar_front'               => $adhar_front_name,
                    'adhar_back'                => $adhar_back_name,
                    'company_name'              => $_POST['company_name'], 
                    'address_defendant'         => $_POST['address_defendant'],
                    'date_emp'                  => $_POST['date_emp'],
                    'salary_slip'               => $salary_slip_name,
                    'communication_attachment'  => $communication_emp_name,
                    'complaint'                 => $_POST['complaint'],
                    'relief'                    => $_POST['relief']

            );
                 
                $userData = $this->Employee_model->addSalaryDuesWithLogin($salary_dues);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }

    /* ----------------------------------  Wrongful Termination ------------------------------------- */

    public function wrongfulTerminationFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $this->load->helper('upload');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();
 
        $company_name          = $_POST['company_name'];
        $address_company       = $_POST['address_company'];
        $ground_termination    = $_POST['ground_termination'];
        $complaint             = $_POST['complaint'];
        $relief                = $_POST['relief'];

        if(isset($_FILES['employment_letter']['name'])){

            $employment_letter  =  uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter = "";
        }

        $adhar_front_name      = $this->session->userdata('adhar_front_name');
        $adhar_back_name       = $this->session->userdata('adhar_back_name');


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

                $wrongful_termination = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'employment_letter'        => $employment_letter,
                    'ground_termination'       => $ground_termination,
                    'complaint'                => $complaint,
                    'relief'                   => $relief

            );

            $userData = $this->Employee_model->addWrongfulTerminationWithoutLogin($register,$wrongful_termination);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

            $wrongful_termination = array(

                    'user_id'                  => $session_user_id,
                    'first_name'               => $_SESSION['basic_details']['firstname'],
                    'last_name'                => $_SESSION['basic_details']['lastname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['email'],
                    'phone'                    => $_SESSION['basic_details']['phone'],
                    'pincode'                  => $_SESSION['basic_details']['pincode'],
                    'state'                    => $_SESSION['basic_details']['state'],
                    'address'                  => $_SESSION['basic_details']['address'],
                    'adhar_front'              => $adhar_front_name,
                    'adhar_back'               => $adhar_back_name,
                    'company_name'             => $company_name, 
                    'address_company'          => $address_company,
                    'employment_letter'        => $employment_letter,
                    'ground_termination'       => $ground_termination,
                    'complaint'                => $complaint,
                    'relief'                   => $relief

            );

                 
                $userData = $this->Employee_model->addWrongfulTerminationWithLogin($wrongful_termination);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }

}
