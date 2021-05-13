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



    public function non_payment_salary(){

        $this->load->helper('url');
        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('Employee/non_payment_salary', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('Employee/non_payment_salary');
        }

    }

    public function non_payment_salary_defendant(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');

        $notice_initiated = $this->session->userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

             $session_user_id = $this->session->userdata('user_id');

             if( !isset($notice_initiated) || ($notice_initiated == "0") ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/non_payment_salary',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/non_payment_salary_defendant',$data);
            }

        }else{

            $session_user_id = $this->session->userdata('user_id');

            if( !isset($notice_initiated) || empty($notice_initiated) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Employee/non_payment_salary',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Employee/non_payment_salary_defendant',$data);

            }

         }
    }
    
    public function add_non_payment_salary(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["consumer-email"];
        $consumer_phone   = $_POST["consumer-phone"];

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

            $adhar_front_name      = $_FILES['adhar_front']['name'];
            $adhar_front__tmp_name = $_FILES['adhar_front']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['adhar_front']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['adhar_front']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $adhar_front_name =  $imageName.".".$extension;
            $this->session->set_userdata('adhar_front_name',$adhar_front_name);

        }else{

            $this->session->set_userdata('adhar_front_name',"");

        }

        if(isset($_FILES['adhar_back']['name'])){

            $adhar_back_name = $_FILES['adhar_back']['name'];
            $adhar_back__tmp_name = $_FILES['adhar_back']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['adhar_back']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['adhar_back']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $adhar_back_name =  $imageName.".".$extension;
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

    public function add_non_payment_salary_defendant(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        if(isset($_FILES['employment_letter']['name'])){

            $employment_letter      = $_FILES['employment_letter']['name'];
            $employment_letter_tmp  = $_FILES['employment_letter']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['employment_letter']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['employment_letter']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $employment_letter =  $imageName.".".$extension;

        }else{

            $employment_letter = "";
        }


        if(isset($_FILES['communication']['name'])){

            $communication      = $_FILES['communication']['name'];
            $employment_letter_tmp  = $_FILES['communication']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['communication']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['communication']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $communication =  $imageName.".".$extension;

        }else{

            $communication = "";
        }

         if(isset($_FILES['bank_statement']['name'])){

            $bank_statement      = $_FILES['bank_statement']['name'];
            $employment_letter_tmp  = $_FILES['bank_statement']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['bank_statement']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['bank_statement']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $bank_statement =  $imageName.".".$extension;

        }else{

            $bank_statement = "";
        }

        $this->session->set_userdata('employment_letter',$employment_letter);
        $this->session->set_userdata('communication',$communication);
        $this->session->set_userdata('bank_statement',$bank_statement);

        $_SESSION['session_data'] =  $_POST;
     
 
        $company_name     = $_SESSION['session_data']['company_name'];
        $address_company  = $_SESSION['session_data']['address_company'];
        $information      = $_SESSION['session_data']['information'];
        $relief           = $_SESSION['session_data']['relief'];

        $adhar_front_name  = $this->session->userdata('adhar_front_name');
        $adhar_back_name   = $this->session->userdata('adhar_back_name');

         $rsultString = "";

        $rsultString .= '<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form" style="margin: 0px 35px auto;padding:20px 0px 5px 0px;">
              
                <form>
                 <center><h3>Consumer Details</h3></center>
                <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>First Name</th>
               <td>'.$_SESSION['basic_details']['consumer-fname'].'</td>
            </tr>
            <tr>
               <th>Last Name</th>
               <td>'.$_SESSION['basic_details']['consumer-lname'].'</td>
            </tr>
            <tr>
               <th>Date Of Birth</th>
               <td>'.$_SESSION['basic_details']['dob'].'</td>
            </tr>
            <tr>
               <th>Email Id</th>
               <td>'.$_SESSION['basic_details']['consumer-email'].'</td>
            </tr>
            <tr>
               <th>Phone Number</th>
               <td>'.$_SESSION['basic_details']['consumer-phone'].'</td>
            </tr>
            <tr>
               <th>Pin Code</th>
               <td>'.$_SESSION['basic_details']['consumer-pincode'].'</td>
            </tr>
            <tr>
               <th>State</th>
               <td>'.$_SESSION['basic_details']['consumer-state'].'</td>
            </tr>
            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
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
               <th>Address Of Company</th>
               <td>'.$address_company.'</td>
            </tr>
            <tr>
               <th>Any Information To Be Provided</th>
               <td>'.$information.'</td>
            </tr>
           <tr>
               <th>Relief</th>
               <td>'.$relief.'</td>
            </tr>';

            if ( strpos($employment_letter, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Person Of Employment At The Firm</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Person Of Employment At The Firm</th></td>
               <td><img src="/notice_images/'.$employment_letter.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
            </tr>';
            }

            if ( strpos($bank_statement, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Bank Statement For Prior Paid Salaries</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$bank_statement.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Bank Statement For Prior Paid Salaries</th></td>
               <td><img src="/notice_images/'.$bank_statement.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$bank_statement.'" target="_blank">View</a></td>
            </tr>';
            }
           

           if ( strpos($communication, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Communication to and from the company regarding the payment of salary</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$communication.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Communication to and from the company regarding the payment of salary</th></td>
               <td><img src="/notice_images/'.$communication.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$communication.'" target="_blank">View</a></td>
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

    public function nonPaymentFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();
        if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'  => $_SESSION['basic_details']['consumer-lname'],
                    'email'      => $_SESSION['basic_details']['consumer-email'],
                    'phone'      => $_SESSION['basic_details']['consumer-phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $non_payment_salary = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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

    public function abuse_power_basic_details(){

        $this->load->helper('url');
        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('Employee/abuse_power_basic_details', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('Employee/abuse_power_basic_details');
        }

    }

    public function add_abuse_power_basic_details(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["consumer-email"];
        $consumer_phone   = $_POST["consumer-phone"];

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

            $adhar_front_name      = $_FILES['adhar_front']['name'];
            $adhar_front__tmp_name = $_FILES['adhar_front']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['adhar_front']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['adhar_front']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $adhar_front_name =  $imageName.".".$extension;
            $this->session->set_userdata('adhar_front_name',$adhar_front_name);

        }else{

            $this->session->set_userdata('adhar_front_name',"");

        }

        if(isset($_FILES['adhar_back']['name'])){

            $adhar_back_name = $_FILES['adhar_back']['name'];
            $adhar_back__tmp_name = $_FILES['adhar_back']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['adhar_back']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['adhar_back']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $adhar_back_name =  $imageName.".".$extension;
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

    public function abuse_power_defendant_details(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');

        $notice_initiated = $this->session->userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

             $session_user_id = $this->session->userdata('user_id');

             if( !isset($notice_initiated) || ($notice_initiated == "0") ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/abuse_power_basic_details',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/abuse_power_defendant_details',$data);
            }

        }else{

            $session_user_id = $this->session->userdata('user_id');

            if( !isset($notice_initiated) || empty($notice_initiated) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Employee/abuse_power_basic_details',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Employee/abuse_power_defendant_details',$data);

            }

         }

    }

    public function add_abuse_power_defendant_details(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();



        if(isset($_FILES['employment_letter']['name'])){

            $employment_letter      = $_FILES['employment_letter']['name'];
            $employment_letter_tmp  = $_FILES['employment_letter']['tmp_name'];

            $str  = microtime();
            $str  = str_replace(' ','',$str);
            $name = str_replace('.','',$str);
            $extension = pathinfo($_FILES['employment_letter']['name'], PATHINFO_EXTENSION);
            $imageName = $name;
            $result =   move_uploaded_file($_FILES['employment_letter']["tmp_name"],"notice_images/".$imageName.".".$extension);
            $employment_letter =  $imageName.".".$extension;

        }else{

            $employment_letter = "";
        }
 
        $_SESSION['session_data'] =  $_POST;
 
        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $person_excersing      = $_SESSION['session_data']['person_excersing'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $this->session->set_userdata('employment_letter',$employment_letter);



        $rsultString = "";

        $rsultString .= '<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form" style="margin: 0px 35px auto;padding:20px 0px 5px 0px;">
              
                <form>
                 <center><h3>Consumer Details</h3></center>
                <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>First Name</th>
               <td>'.$_SESSION['basic_details']['consumer-fname'].'</td>
            </tr>
            <tr>
               <th>Last Name</th>
               <td>'.$_SESSION['basic_details']['consumer-lname'].'</td>
            </tr>
            <tr>
               <th>Date Of Birth</th>
               <td>'.$_SESSION['basic_details']['dob'].'</td>
            </tr>
            <tr>
               <th>Email Id</th>
               <td>'.$_SESSION['basic_details']['consumer-email'].'</td>
            </tr>
            <tr>
               <th>Phone Number</th>
               <td>'.$_SESSION['basic_details']['consumer-phone'].'</td>
            </tr>
            <tr>
               <th>Pin Code</th>
               <td>'.$_SESSION['basic_details']['consumer-pincode'].'</td>
            </tr>
            <tr>
               <th>State</th>
               <td>'.$_SESSION['basic_details']['consumer-state'].'</td>
            </tr>
            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
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
               <th>Address Of Company</th>
               <td>'.$address_company.'</td>
            </tr>
            <tr>
               <th>Person Exercising the abuse of power</th>
               <td>'.$person_excersing.'</td>
            </tr>
            
            <tr>
               <th>Complaint</th>
               <td>'.$complaint.'</td>
            </tr><tr>
               <th>Relief</th>
               <td>'.$relief.'</td>
            </tr>';

            if ( strpos($employment_letter, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Person Of Employment At The Firm</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Person Of Employment At The Firm</th></td>
               <td><img src="/notice_images/'.$employment_letter.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
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

    public function abusePowerFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

       

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $this->session->set_userdata('employment_letter',$employment_letter);


        if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'  => $_SESSION['basic_details']['consumer-lname'],
                    'email'      => $_SESSION['basic_details']['consumer-email'],
                    'phone'      => $_SESSION['basic_details']['consumer-phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $abuse_power = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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


    public function gratuity_claim_basic_details(){

        $this->load->helper('url');
        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('Employee/gratuity_claim_basic_details', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('Employee/gratuity_claim_basic_details');
        }

    }


    public function gratuity_claim_defendant_details(){

        $this->load->helper('url');

        $this->load->model('user_model');

        $this->load->library('session');

        $notice_initiated = $this->session->userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){


             $session_user_id = $this->session->userdata('user_id');

             if( !isset($notice_initiated) || ($notice_initiated == "0") ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/gratuity_claim_basic_details',$data);
                return;
            }else{


                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/gratuity_claim_defendant_details',$data);

            }

        }else{


            $session_user_id = $this->session->userdata('user_id');

            if( !isset($notice_initiated) || empty($notice_initiated) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Employee/gratuity_claim_basic_details',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Employee/gratuity_claim_defendant_details',$data);

            }

         }

    }

    /*------------------------------------- Grauity Claim ------------------------------- */


    public function add_gratuity_claim_basic_details(){

        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["consumer-email"];
        $consumer_phone   = $_POST["consumer-phone"];

        $session_user_id = $this->session->userdata('user_id');
        $user_login      = $this->session->userdata('user_login');

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

            $adhar_back_name = $this->uploadFiles($_FILES['adhar_back']);
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


    public function add_gratuity_claim_defendant_details(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        $_SESSION['session_data'] =  $_POST;


        if(isset($_FILES['employment_letter']['name'])){

            $employment_letter      =  $this->uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter = "";
        }

        if(isset($_FILES['relieving_letter']['name'])){

            $relieving_letter      =  $this->uploadFiles($_FILES['relieving_letter']);

        }else{

            $relieving_letter = "";
        }

        if(isset($_FILES['communication_attachment']['name'])){

            $communication_attachment      =  $this->uploadFiles($_FILES['communication_attachment']);

        }else{

            $communication_attachment = "";
        }

        $this->session->set_userdata('employment_letter',$employment_letter);
        $this->session->set_userdata('relieving_letter',$relieving_letter);
        $this->session->set_userdata('communication_attachment',$communication_attachment);
 
        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $gratuity_calculation  = $_SESSION['session_data']['gratuity_calculation'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        $rsultString = "";

        $rsultString .= '<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form" style="margin: 0px 35px auto;padding:20px 0px 5px 0px;">
              
                <form>
                 <center><h3>Consumer Details</h3></center>
                <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>First Name</th>
               <td>'.$_SESSION['basic_details']['consumer-fname'].'</td>
            </tr>
            <tr>
               <th>Last Name</th>
               <td>'.$_SESSION['basic_details']['consumer-lname'].'</td>
            </tr>
            <tr>
               <th>Date Of Birth</th>
               <td>'.$_SESSION['basic_details']['dob'].'</td>
            </tr>
            <tr>
               <th>Email Id</th>
               <td>'.$_SESSION['basic_details']['consumer-email'].'</td>
            </tr>
            <tr>
               <th>Phone Number</th>
               <td>'.$_SESSION['basic_details']['consumer-phone'].'</td>
            </tr>
            <tr>
               <th>Pin Code</th>
               <td>'.$_SESSION['basic_details']['consumer-pincode'].'</td>
            </tr>
            <tr>
               <th>State</th>
               <td>'.$_SESSION['basic_details']['consumer-state'].'</td>
            </tr>
            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
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
               <th>Address Of Company</th>
               <td>'.$address_company.'</td>
            </tr>
            <tr>
               <th>Grauity Calculation</th>
               <td>'.$gratuity_calculation.'</td>
            </tr>
            
            <tr>
               <th>Complaint</th>
               <td>'.$complaint.'</td>
            </tr><tr>
               <th>Relief</th>
               <td>'.$relief.'</td>
            </tr>';

            if ( strpos($employment_letter, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Employment Letter</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Agreement Of Employment</th></td>
               <td><img src="/notice_images/'.$employment_letter.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
            </tr>';

            }

            if ( strpos($relieving_letter, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Relieving Letter</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$relieving_letter.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Relieving Letter</th></td>
               <td><img src="/notice_images/'.$relieving_letter.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$relieving_letter.'" target="_blank">View</a></td>
            </tr>';

            }

            if ( strpos($communication_attachment, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Communication Letter</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$communication_attachment.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Communication Letter</th></td>
               <td><img src="/notice_images/'.$communication_attachment.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$communication_attachment.'" target="_blank">View</a></td>
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


    public function grauityFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();
 
        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $gratuity_calculation  = $_SESSION['session_data']['gratuity_calculation'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');

        $employment_letter   = $this->session->userdata('employment_letter');
        $relieving_letter    = $this->session->userdata('relieving_letter');
        $communication_attachment = $this->session->userdata('communication_attachment');


        if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'  => $_SESSION['basic_details']['consumer-lname'],
                    'email'      => $_SESSION['basic_details']['consumer-email'],
                    'phone'      => $_SESSION['basic_details']['consumer-phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $gratuity_claim = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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


    public function voilation_aggrement_basic_detail(){

        $this->load->helper('url');
        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('Employee/voilation_aggrement_basic_detail', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('Employee/voilation_aggrement_basic_detail');

        }

    }

    public function add_voilation_aggrement_basic_detail(){


        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["consumer-email"];
        $consumer_phone   = $_POST["consumer-phone"];

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

    public function voilation_aggrement_defendant_details(){


        $this->load->helper('url');

        $this->load->model('user_model');

        $this->load->library('session');

        $notice_initiated = $this->session->userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){


             $session_user_id = $this->session->userdata('user_id');

             if( !isset($notice_initiated) || ($notice_initiated == "0") ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/voilation_aggrement_basic_detail',$data);
                return;
            }else{


                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/voilation_aggrement_defendant_details',$data);

            }

        }else{


            $session_user_id = $this->session->userdata('user_id');

            if( !isset($notice_initiated) || empty($notice_initiated) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Employee/voilation_aggrement_basic_detail',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Employee/voilation_aggrement_defendant_details',$data);

            }

         }

    }

    public function add_voilation_aggrement_defendant_details(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();


        if(isset($_FILES['aggrement_employment']['name'])){

            $aggrement_employment  =  $this->uploadFiles($_FILES['aggrement_employment']);

        }else{

            $aggrement_employment = "";
        }
 
        $company_name          = $_POST['company_name'];
        $address_company       = $_POST['address_company'];
        $date_employment       = $_POST['date_employment'];
        $complaint             = $_POST['complaint'];
        $relief                = $_POST['relief'];

        $_SESSION['session_data']  =  $_POST;

        
        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $date_employment       = $_SESSION['session_data']['date_employment'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];



        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $this->session->set_userdata('aggrement_employment',$aggrement_employment);

         $rsultString = "";

        $rsultString .= '<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form" style="margin: 0px 35px auto;padding:20px 0px 5px 0px;">
              
                <form>
                 <center><h3>Consumer Details</h3></center>
                <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>First Name</th>
               <td>'.$_SESSION['basic_details']['consumer-fname'].'</td>
            </tr>
            <tr>
               <th>Last Name</th>
               <td>'.$_SESSION['basic_details']['consumer-lname'].'</td>
            </tr>
            <tr>
               <th>Date Of Birth</th>
               <td>'.$_SESSION['basic_details']['dob'].'</td>
            </tr>
            <tr>
               <th>Email Id</th>
               <td>'.$_SESSION['basic_details']['consumer-email'].'</td>
            </tr>
            <tr>
               <th>Phone Number</th>
               <td>'.$_SESSION['basic_details']['consumer-phone'].'</td>
            </tr>
            <tr>
               <th>Pin Code</th>
               <td>'.$_SESSION['basic_details']['consumer-pincode'].'</td>
            </tr>
            <tr>
               <th>State</th>
               <td>'.$_SESSION['basic_details']['consumer-state'].'</td>
            </tr>
            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
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
                 <th>Aadhar Front Side</th></td>
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
               <th>Address Of Company</th>
               <td>'.$address_company.'</td>
            </tr>
            <tr>
               <th>Date Of Employment</th>
               <td>'.$date_employment.'</td>
            </tr>
            
            <tr>
               <th>Complaint</th>
               <td>'.$complaint.'</td>
            </tr><tr>
               <th>Relief</th>
               <td>'.$relief.'</td>
            </tr>';

            if ( strpos($aggrement_employment, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Agreement Of Employment</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$aggrement_employment.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Agreement Of Employment</th></td>
               <td><img src="/notice_images/'.$aggrement_employment.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$aggrement_employment.'" target="_blank">View</a></td>
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

    public function voilationFinalSubmit(){

        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
        $uniqid = uniqid();

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $aggrement_employment    = $this->session->userdata('aggrement_employment');

        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $date_employment       = $_SESSION['session_data']['date_employment'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];


              if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'  => $_SESSION['basic_details']['consumer-lname'],
                    'email'      => $_SESSION['basic_details']['consumer-email'],
                    'phone'      => $_SESSION['basic_details']['consumer-phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $voilation_aggrement = array(

                    'user_id'                => $uniqid,
                    'first_name'             => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'              => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                    => $_SESSION['basic_details']['dob'],
                    'email'                  => $_SESSION['basic_details']['consumer-email'],
                    'phone'                  => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                  => $_SESSION['basic_details']['consumer-state'],
                    'address'                => $_SESSION['basic_details']['consumer-address'],
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
                    'first_name'             => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'              => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                    => $_SESSION['basic_details']['dob'],
                    'email'                  => $_SESSION['basic_details']['consumer-email'],
                    'phone'                  => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                  => $_SESSION['basic_details']['consumer-state'],
                    'address'                => $_SESSION['basic_details']['consumer-address'],
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

       $notice_initiated = $this->session->userdata('notice_initiated');
       $user_login      = $this->session->userdata('user_login');
       $session_user_id = $this->session->userdata('user_id');
       $_SESSION['session_data']  =  $_POST;

       $esi_office         =  $_POST['esi_office'];
       $esi_office_address =  $_POST['esi_office_address'];
       $type_esi_complaint =  $_POST['type_esi_complaint'];
       $complaint          =  $_POST['complaint'];
       $relief             =  $_POST['relief'];
       $adhar_front_name = $this->session->userdata('adhar_front_name');
       $adhar_back_name  = $this->session->userdata('adhar_back_name');

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
                    'first_name'                => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                 => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                       => $_SESSION['basic_details']['dob'],
                    'email'                     => $_SESSION['basic_details']['consumer-email'],
                    'phone'                     => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                   => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                     => $_SESSION['basic_details']['consumer-state'],
                    'address'                   => $_SESSION['basic_details']['consumer-address'],
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


     public function wrongful_termination_basic_details(){
        
        $this->load->helper('url');

        $this->load->library('session');
        $this->session->unset_userdata('notice_initiated');
        $user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('Headers/login_header');
            $this->load->view('Employee/wrongful_termination_basic_details.php', $data);

        }else{

            $this->session->sess_destroy();
            $this->load->view('Headers/header');
            $this->load->view('Employee/wrongful_termination_basic_details.php');

        }
    }

    public function add_wrongful_termination_basic_details(){


        $this->load->model('user_model');
        $this->load->helper('url');
        $this->load->library('session');
        
        $consumer_email   = $_POST["consumer-email"];
        $consumer_phone   = $_POST["consumer-phone"];

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

     public function wrongful_termination_defendant_details(){


        $this->load->helper('url');

        $this->load->model('user_model');

        $this->load->library('session');

        $notice_initiated = $this->session->userdata('notice_initiated');

        $user_login = $this->session->userdata('user_login');

        if( $user_login ){


             $session_user_id = $this->session->userdata('user_id');

             if( !isset($notice_initiated) || ($notice_initiated == "0") ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/wrongful_termination_basic_details',$data);
                return;
            }else{


                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/login_header');
                $this->load->view('Employee/wrongful_termination_defendant_details',$data);

            }

        }else{


            $session_user_id = $this->session->userdata('user_id');

            if( !isset($notice_initiated) || empty($notice_initiated) ){

                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('Headers/header');
                $this->load->view('Employee/wrongful_termination_basic_details',$data);
                return;
            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data =  array( 'data' => $userData );
                $this->load->view('Headers/header');
                $this->load->view('Employee/wrongful_termination_defendant_details',$data);

            }

         }

    }

    public function add_wrongful_termination_defendant_details(){
        
        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();

        if(isset($_FILES['employment_letter']['name'])){

            $employment_letter  =  $this->uploadFiles($_FILES['employment_letter']);

        }else{

            $employment_letter = "";
        }

        $_SESSION['session_data'] =  $_POST;
 
        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $ground_termination    = $_SESSION['session_data']['ground_termination'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];

        $adhar_front_name    = $this->session->userdata('adhar_front_name');
        $adhar_back_name     = $this->session->userdata('adhar_back_name');
        $this->session->set_userdata('employment_letter',$employment_letter); $rsultString = "";

        $rsultString .= '<div class="row">

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
              <div class="form" style="margin: 0px 35px auto;padding:20px 0px 5px 0px;">
              
                <form>
                 <center><h3>Consumer Details</h3></center>
                <table class="table table-bordered table-striped" style="overflow:scroll">
            <tr>
               <th>First Name</th>
               <td>'.$_SESSION['basic_details']['consumer-fname'].'</td>
            </tr>
            <tr>
               <th>Last Name</th>
               <td>'.$_SESSION['basic_details']['consumer-lname'].'</td>
            </tr>
            <tr>
               <th>Date Of Birth</th>
               <td>'.$_SESSION['basic_details']['dob'].'</td>
            </tr>
            <tr>
               <th>Email Id</th>
               <td>'.$_SESSION['basic_details']['consumer-email'].'</td>
            </tr>
            <tr>
               <th>Phone Number</th>
               <td>'.$_SESSION['basic_details']['consumer-phone'].'</td>
            </tr>
            <tr>
               <th>Pin Code</th>
               <td>'.$_SESSION['basic_details']['consumer-pincode'].'</td>
            </tr>
            <tr>
               <th>State</th>
               <td>'.$_SESSION['basic_details']['consumer-state'].'</td>
            </tr>
            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
            </tr>

            <tr>
               <th>Address</th>
               <td>'.$_SESSION['basic_details']['consumer-address'].'</td>
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
               <th>Address Of Company</th>
               <td>'.$address_company.'</td>
            </tr>
            <tr>
               <th>Ground Termination</th>
               <td>'.$ground_termination.'</td>
            </tr>
            
            <tr>
               <th>Complaint</th>
               <td>'.$complaint.'</td>
            </tr><tr>
               <th>Relief</th>
               <td>'.$relief.'</td>
            </tr>';

            if ( strpos($employment_letter, "pdf") == true  ){ 

              $rsultString .='

              <tr>
                 <th>Employment Letter</th></td>
                 <td>PDF File</td>
                 <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
              </tr>';

            }else{

              $rsultString .='

              <tr>
               <th>Agreement Of Employment</th></td>
               <td><img src="/notice_images/'.$employment_letter.'" height="20" width="20"></img></td>
               <td><a href="/notice_images/'.$employment_letter.'" target="_blank">View</a></td>
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

    public function wrongfulTerminationFinalSubmit(){


        $this->load->library('session');
        $this->load->model('user_model');
        $this->load->model('Employee_model');
        $this->load->helper('url');
        $notice_initiated = $this->session->userdata('notice_initiated');
        $user_login      = $this->session->userdata('user_login');
        $session_user_id = $this->session->userdata('user_id');
       
        $uniqid = uniqid();
 
        $company_name          = $_SESSION['session_data']['company_name'];
        $address_company       = $_SESSION['session_data']['address_company'];
        $ground_termination    = $_SESSION['session_data']['ground_termination'];
        $complaint             = $_SESSION['session_data']['complaint'];
        $relief                = $_SESSION['session_data']['relief'];

        $adhar_front_name      = $this->session->userdata('adhar_front_name');
        $adhar_back_name       = $this->session->userdata('adhar_back_name');
        $employment_letter     = $this->session->userdata('employment_letter');


        if( !$user_login ){

                $register = array(

                    'user_id'    => $uniqid,
                    'first_name' => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'  => $_SESSION['basic_details']['consumer-lname'],
                    'email'      => $_SESSION['basic_details']['consumer-email'],
                    'phone'      => $_SESSION['basic_details']['consumer-phone'],
                    'password'   => '123456',
                    'dob'        => $_SESSION['basic_details']['dob'],
                    'age'        => '',
                    'gender'     => '',
                    'adhar_front'=> $adhar_front_name,
                    'adhar_back' => $adhar_back_name

                );

                $wrongful_termination = array(

                    'user_id'                  => $uniqid,
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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
                    'first_name'               => $_SESSION['basic_details']['consumer-fname'],
                    'last_name'                => $_SESSION['basic_details']['consumer-lname'],
                    'dob'                      => $_SESSION['basic_details']['dob'],
                    'email'                    => $_SESSION['basic_details']['consumer-email'],
                    'phone'                    => $_SESSION['basic_details']['consumer-phone'],
                    'pincode'                  => $_SESSION['basic_details']['consumer-pincode'],
                    'state'                    => $_SESSION['basic_details']['consumer-state'],
                    'address'                  => $_SESSION['basic_details']['consumer-address'],
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
