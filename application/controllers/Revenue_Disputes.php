<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Revenue_Disputes extends CI_Controller {


    public function titleDeedFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Revenue_Disputes_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['title_deed']['name'])){

            $title_deed_img  =  uploadFiles($_FILES['title_deed']);

        }else{

            $title_deed_img = "";
        }



        $defendant_name    = $_POST['defendant_name'];
        $address_defendant = $_POST['address_defendant'];
        $complaint         = $_POST['complaint'];
        $relief            = $_POST['relief'];

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

                $title_deed = array(

                    'user_id'            => $uniqid,
                    'first_name'         => $_SESSION['basic_details']['firstname'],
                    'last_name'          => $_SESSION['basic_details']['lastname'],
                    'dob'                => $_SESSION['basic_details']['dob'],
                    'email'              => $_SESSION['basic_details']['email'],
                    'phone'              => $_SESSION['basic_details']['phone'],
                    'pincode'            => $_SESSION['basic_details']['pincode'],
                    'state'              => $_SESSION['basic_details']['state'],
                    'address'            => $_SESSION['basic_details']['address'],
                    'adhar_front'        => $adhar_front_name,
                    'adhar_back'         => $adhar_back_name,
                    'defendant_name'     => $defendant_name, 
                    'address_defendant'  => $address_defendant,
                    'title_deed'         => $title_deed_img,
                    'complaint'          => $complaint,
                    'relief'             => $relief

            );

            $userData = $this->Revenue_Disputes_model->addTitleDeedWithoutLogin($register,$title_deed);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

            $title_deed = array(

                    'user_id'            => $session_user_id,
                    'first_name'         => $_SESSION['basic_details']['firstname'],
                    'last_name'          => $_SESSION['basic_details']['lastname'],
                    'dob'                => $_SESSION['basic_details']['dob'],
                    'email'              => $_SESSION['basic_details']['email'],
                    'phone'              => $_SESSION['basic_details']['phone'],
                    'pincode'            => $_SESSION['basic_details']['pincode'],
                    'state'              => $_SESSION['basic_details']['state'],
                    'address'            => $_SESSION['basic_details']['address'],
                    'adhar_front'        => $adhar_front_name,
                    'adhar_back'         => $adhar_back_name,
                    'defendant_name'     => $defendant_name, 
                    'address_defendant'  => $address_defendant,
                    'title_deed'         => $title_deed_img,
                    'complaint'          => $complaint,
                    'relief'             => $relief

            );

                $userData = $this->Revenue_Disputes_model->addTitleDeedWithLogin($title_deed);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }

    }

}    

    /*-------------------- Enroachment ----------------------- */

   


    public function enroachmentFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Revenue_Disputes_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $adhar_front_name   = $this->session->userdata('adhar_front_name');
        $adhar_back_name    = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['title_deed']['name'])){

            $title_deed  =  uploadFiles($_FILES['title_deed']);

        }else{

            $title_deed = "";
        }



        $defendant_name     = $_POST['defendant_name'];
        $address_defendant  = $_POST['address_defendant'];
        $propert_encroached = $_POST['propert_encroached'];
        $relief             = $_POST['relief'];


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

                $encroachment = array(

                    'user_id'            => $uniqid,
                    'first_name'         => $_SESSION['basic_details']['firstname'],
                    'last_name'          => $_SESSION['basic_details']['lastname'],
                    'dob'                => $_SESSION['basic_details']['dob'],
                    'email'              => $_SESSION['basic_details']['email'],
                    'phone'              => $_SESSION['basic_details']['phone'],
                    'pincode'            => $_SESSION['basic_details']['pincode'],
                    'state'              => $_SESSION['basic_details']['state'],
                    'address'            => $_SESSION['basic_details']['address'],
                    'adhar_front'        => $adhar_front_name,
                    'adhar_back'         => $adhar_back_name,
                    'defendant_name'     => $defendant_name, 
                    'address_defendant'  => $address_defendant,
                    'propert_encroached' => $propert_encroached,
                    'title_deed'         => $title_deed,
                    'relief'             => $relief

            );


            $userData = $this->Revenue_Disputes_model->addEncroachmentWithoutLogin($register,$encroachment);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

            $encroachment = array(

                    'user_id'            => $session_user_id,
                    'first_name'         => $_SESSION['basic_details']['firstname'],
                    'last_name'          => $_SESSION['basic_details']['lastname'],
                    'dob'                => $_SESSION['basic_details']['dob'],
                    'email'              => $_SESSION['basic_details']['email'],
                    'phone'              => $_SESSION['basic_details']['phone'],
                    'pincode'            => $_SESSION['basic_details']['pincode'],
                    'state'              => $_SESSION['basic_details']['state'],
                    'address'            => $_SESSION['basic_details']['address'],
                    'adhar_front'        => $adhar_front_name,
                    'adhar_back'         => $adhar_back_name,
                    'defendant_name'     => $defendant_name, 
                    'address_defendant'  => $address_defendant,
                    'propert_encroached' => $propert_encroached,
                    'title_deed'         => $title_deed,
                    'relief'             => $relief

            );

                $userData = $this->Revenue_Disputes_model->addEncroachmentWithLogin($encroachment);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }


    /*-------------------------------------- Trespassing --------------------------------- */

    

    public function trespassingFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Revenue_Disputes_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');

        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');

        $defendant_name      = $_POST['defendant_name'];
        $address_defendant   = $_POST['address_defendant'];
        $nature_trespassing  = $_POST['nature_trespassing'];
        $trespassing_occured = $_POST['trespassing_occured'];
        $detail_trespassing  = $_POST['detail_trespassing'];
        $relief              = $_POST['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['title_deed']['name'])){

            $title_deed  =  uploadFiles($_FILES['title_deed']);

        }else{

            $title_deed = "";
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

                $trespassing = array(

                    'user_id'             => $uniqid,
                    'first_name'          => $_SESSION['basic_details']['firstname'],
                    'last_name'           => $_SESSION['basic_details']['lastname'],
                    'dob'                 => $_SESSION['basic_details']['dob'],
                    'email'               => $_SESSION['basic_details']['email'],
                    'phone'               => $_SESSION['basic_details']['phone'],
                    'pincode'             => $_SESSION['basic_details']['pincode'],
                    'state'               => $_SESSION['basic_details']['state'],
                    'address'             => $_SESSION['basic_details']['address'],
                    'adhar_front'         => $adhar_front_name,
                    'adhar_back'          => $adhar_back_name,
                    'defendant_name'      => $defendant_name, 
                    'address_defendant'   => $address_defendant,
                    'nature_trespassing'  => $nature_trespassing,
                    'trespassing_occured' => $trespassing_occured,
                    'detail_trespassing'  => $detail_trespassing,
                    'title_deed'          => $title_deed,
                    'relief'              => $relief

            );


            $userData = $this->Revenue_Disputes_model->addTrespassingWithoutLogin($register,$trespassing);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

            $trespassing = array(

                    'user_id'            => $session_user_id,
                    'first_name'         => $_SESSION['basic_details']['firstname'],
                    'last_name'          => $_SESSION['basic_details']['lastname'],
                    'dob'                => $_SESSION['basic_details']['dob'],
                    'email'              => $_SESSION['basic_details']['email'],
                    'phone'              => $_SESSION['basic_details']['phone'],
                    'pincode'            => $_SESSION['basic_details']['pincode'],
                    'state'              => $_SESSION['basic_details']['state'],
                    'address'            => $_SESSION['basic_details']['address'],
                    'adhar_front'        => $adhar_front_name,
                    'adhar_back'         => $adhar_back_name,
                    'defendant_name'     => $defendant_name, 
                    'address_defendant'  => $address_defendant,
                    'property_trespassing' => $property_trespassing,
                    'detail_property_trespassing' => $detail_property_trespassing,
                    'title_deed'         => $title_deed,
                    'relief'             => $relief

            );

                $userData = $this->Revenue_Disputes_model->addTrespassingWithLogin($trespassing);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }

    /*--------------------------------- Administration  ------------------------------- */



    public function administrationFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Revenue_Disputes_model');
        $this->load->helper('url');
        $this->load->helper('upload');
        $notice_initiated  = $this->session->userdata('notice_initiated');
        $user_login        = $this->session->userdata('user_login');
        $session_user_id   = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $department_name      = $_POST['department_name'];
        $address_department   = $_POST['address_department'];
        $complaint            = $_POST['complaint'];
        $relief               = $_POST['relief'];

        $adhar_front_name   = $this->session->userdata('adhar_front_name');
        $adhar_back_name    = $this->session->userdata('adhar_back_name');

        if(isset($_FILES['communication']['name'])){
            $communication  =  uploadFiles($_FILES['communication']);
        }else{
            $communication = "";
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

                $administration = array(

                    'user_id'             => $uniqid,
                    'first_name'          => $_SESSION['basic_details']['firstname'],
                    'last_name'           => $_SESSION['basic_details']['lastname'],
                    'dob'                 => $_SESSION['basic_details']['dob'],
                    'email'               => $_SESSION['basic_details']['email'],
                    'phone'               => $_SESSION['basic_details']['phone'],
                    'pincode'             => $_SESSION['basic_details']['pincode'],
                    'state'               => $_SESSION['basic_details']['state'],
                    'address'             => $_SESSION['basic_details']['address'],
                    'adhar_front'         => $adhar_front_name,
                    'adhar_back'          => $adhar_back_name,
                    'department_name'     => $department_name, 
                    'address_department'  => $address_department,
                    'complaint'           => $complaint,
                    'relief'              => $relief,
                    'communication'       => $communication

            );


            $userData = $this->Revenue_Disputes_model->addAdministrationWithoutLogin($register,$administration);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

           $administration = array(

                    'user_id'             => $session_user_id,
                    'first_name'          => $_SESSION['basic_details']['firstname'],
                    'last_name'           => $_SESSION['basic_details']['lastname'],
                    'dob'                 => $_SESSION['basic_details']['dob'],
                    'email'               => $_SESSION['basic_details']['email'],
                    'phone'               => $_SESSION['basic_details']['phone'],
                    'pincode'             => $_SESSION['basic_details']['pincode'],
                    'state'               => $_SESSION['basic_details']['state'],
                    'address'             => $_SESSION['basic_details']['address'],
                    'adhar_front'         => $adhar_front_name,
                    'adhar_back'          => $adhar_back_name,
                    'department_name'     => $department_name, 
                    'address_department'  => $address_department,
                    'complaint'           => $complaint,
                    'relief'              => $relief,
                    'communication'       => $communication

            );


                $userData = $this->Revenue_Disputes_model->addAdministrationWithLogin($administration);

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



    

    