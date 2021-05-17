<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Banking extends CI_Controller {

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


    public function uploadFiles($data){

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($data['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($data["tmp_name"],"notice_images/".$imageName.".".$extension);
            return $adhar_back_name =  $imageName.".".$extension;
    }


    /*------------------ Sarfaesi ---------------------------------- */





    public function sarfaesiFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Banking_model');
        $this->load->helper('url');
        $this->load->helper('upload');

        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');


        $branch_name         = $_POST['branch_name'];
        $address_bank        = $_POST['address_bank'];
        $contention          = $_POST['contention'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $uniqid = uniqid();

        if(isset($_FILES['reply_notices']['name'])){

            $reply_notices  =  uploadFiles($_FILES['reply_notices']);

        }else{

            $reply_notices = "";
        }

        if(isset($_FILES['sarfaesi_notice']['name'])){

            $sarfaesi_notice  =  uploadFiles($_FILES['sarfaesi_notice']);

        }else{

            $sarfaesi_notice = "";
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

                 $sarfaesi_notice_data = array(

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
                    'branch_name'              => $branch_name, 
                    'address_bank'             => $address_bank,
                    'contention'               => $contention,
                    'sarfaesi_notice'          => $sarfaesi_notice,
                    'reply_notices'            => $reply_notices

            );

            $userData = $this->Banking_model->addSarfaesiWithoutLogin($register,$sarfaesi_notice_data);

                   if($userData){
                         echo  "1";
                    }
                    else{
                         echo "2";
                    }

            }else{

                 $sarfaesi_notice_data = array(

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
                    'branch_name'              => $branch_name, 
                    'address_bank'             => $address_bank,
                    'contention'      => $contention,
                    'sarfaesi_notice' => $sarfaesi_notice,
                    'reply_notices'   => $reply_notices

            );


                 
                $userData = $this->Banking_model->addSarfaesiWithLogin($sarfaesi_notice_data);

                 if($userData){
                     echo  "1";
                }
                else{
                     echo "2";
                }
         }

    }

}    
