<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employer extends CI_Controller {

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

    /*------------------------------------------  Termination Notice ----------------------------- */

   


       


    public function terminationFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->model('Employer_model');

        $this->load->helper('url');
        $this->load->helper('upload');


        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $company_name        =  $_POST['company_name'];
        $employee_name       =  $_POST['employee_name'];
        $address_employee    =  $_POST['address_employee'];
        $reason_termination  =  $_POST['reason_termination'];
        $date_termination    =  $_POST['date_termination'];
        $item_handed         =  $_POST['item_handed'];

        $adhar_front_name   = $this->session->userdata('adhar_front_name');
        $adhar_back_name    = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['employment_letter']['name'])){

            $employment_letter  =  uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter = "";
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

                $termination_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'employment_letter'      => $employment_letter,
                    'reason_termination'     => $reason_termination,
                    'date_termination'       => $date_termination,
                    'item_handed'            => $item_handed


            );

            $userData = $this->Employer_model->addTerminationNoticewithoutLogin($register,$termination_notice);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

              
                $termination_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'employment_letter'      => $employment_letter,
                    'reason_termination'     => $reason_termination,
                    'date_termination'       => $date_termination,
                    'item_handed'            => $item_handed


            );

                 
                $userData = $this->Employer_model->addTerminationNoticewithLogin($termination_notice);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }





    /* ------------------  Voilation     ---------------------------- */





    /*------------------------------------  Misconduct -------------------------------- */




    public function MisconductFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->model('Employer_model');


        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $company_name      =  $_POST['company_name'];
        $employee_name     =  $_POST['employee_name'];
        $address_employee  =  $_POST['address_employee'];
        $type_misconduct   =  $_POST['type_misconduct'];
        $detail_misconduct =  $_POST['detail_misconduct'];
        $reprimand_advice  =  $_POST['reprimand_advice'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
         if(isset($_FILES['employment_letter']['name'])){

            $employment_letter  =  uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter = "";
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

                $misconduct_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'type_misconduct'        => $type_misconduct,
                    'details_misconduct'     => $detail_misconduct,
                    'employment_letter'      => $employment_letter,
                    'reprimand_advice'       => $reprimand_advice


            );

            $userData = $this->Employer_model->addMisconductNoticewithoutLogin($register,$misconduct_notice);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

              
                $misconduct_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'type_misconduct'        => $type_misconduct,
                    'details_misconduct'     => $detail_misconduct,
                    'employment_letter'      => $employment_letter,
                    'reprimand_advice'       => $reprimand_advice


            );

                 
                $userData = $this->Employer_model->addMisconductNoticewithLogin($misconduct_notice);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }



    /********************************* Suspension Notice ***************************** */


    public function suspensionFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->model('Employer_model');

        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');


        if(isset($_FILES['employment_letter']['name'])){ 
                $employment_letter  =  uploadFiles($_FILES['employment_letter']);
        }else{
               $employment_letter  = "";
          }
       
        $uniqid = uniqid();


        $company_name        =  $_POST['company_name'];
        $employee_name       =  $_POST['employee_name'];
        $address_employee    =  $_POST['address_employee'];
        $suspension_duration =  $_POST['suspension_duration'];
        $suspension_reason   =  $_POST['suspension_reason'];
        $reprimondent        =  $_POST['reprimondent'];


        $adhar_front_name  = $this->session->userdata('adhar_front_name');
        $adhar_back_name   = $this->session->userdata('adhar_back_name');




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

                $suspension_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'employment_letter'      => $employment_letter,
                    'duration_suspension'    => $suspension_duration,
                    'reason_suspension'      => $suspension_reason,
                    'reprimondent'           => $reprimondent

            );

            $userData = $this->Employer_model->addSuspensionNoticewithoutLogin($register,$suspension_notice);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

              
                $suspension_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'type_misconduct'        => $type_misconduct,
                    'details_misconduct'     => $detail_misconduct,
                    'employment_letter'      => $employment_letter,
                    'reprimand_advice'       => $reprimand_advice


            );

                 
                $userData = $this->Employer_model->addSuspensionNoticewithLogin($suspension_notice);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }


    /********************** --------------------------------- Retrenchment Notice *************************/



  
    
    public function retrenchmentFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->model('Employer_model');

        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

        $company_name             =  $_POST['company_name'];
        $employee_name            =  $_POST['employee_name'];
        $address_employee         =  $_POST['address_employee'];
        $retrenchment_reason      =  $_POST['retrenchment_reason'];
        $compensation_calculation =  $_POST['compensation_calculation'];
        $item_handed              =  $_POST['item_handed'];

        $adhar_front_name   = $this->session->userdata('adhar_front_name');
        $adhar_back_name    = $this->session->userdata('adhar_back_name');
        $employment_letter  = $this->session->userdata('employment_letter');

        if(isset($_FILES['employment_letter']['name'])){
            $employment_letter = $this->uploadFiles($_FILES['employment_letter']);
        }else{
             $employment_letter = "";
        }

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

                $retrenchment_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'employment_letter'      => $employment_letter,
                    'retrenchment_reason'    => $retrenchment_reason,
                    'compensation'           => $compensation_calculation,
                    'item_handed'            => $item_handed

            );

            $userData = $this->Employer_model->addRetrenchmentNoticewithoutLogin($register,$retrenchment_notice);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

              
                $retrenchment_notice = array(

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
                    'employee_name'          => $employee_name,
                    'address_employee'       => $address_employee,
                    'employment_letter'      => $employment_letter,
                    'retrenchment_reason'    => $retrenchment_reason,
                    'compensation'           => $compensation_calculation,
                    'item_handed'            => $item_handed

            );

                 
                $userData = $this->Employer_model->addRetrenchmentNoticewithLogin($retrenchment_notice);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
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







