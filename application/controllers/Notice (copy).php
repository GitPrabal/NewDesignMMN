<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notice  extends CI_Controller {

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

	public function defendantView(){

		$this->load->library('session');
		$this->load->helper('url');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');
		$page_name = $this->session->userdata('page_name');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/'.$page_name);
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('basic_details');
				$this->load->view('footer');

			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/'.$page_name);
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');

            }

	}

	}



	public function saveNoticeData()
	{   
		$this->load->helper('url');
		$this->load->helper('upload');
        $this->load->library('session');
        $this->load->model('user_model');
        $user_login = $this->session->userdata('user_login');

        $phone = $_POST['phone'];
        $email = $_POST['email'];

        if( !isset($user_login) && empty($user_login)){
	        $result = $this->user_model->checkRegisteredUser($phone,$email);
	        if($result > 0 ){
	            echo  "3";
	            return;
	        }
        }

        $_SESSION['basic_details'] = $_POST;
        $this->session->set_userdata('basic_details_filled',"1");
        $adhar_front_name =  uploadFiles($_FILES['adhar_front']);
        $adhar_back_name =  uploadFiles($_FILES['adhar_back']);
        $this->session->set_userdata('adhar_front_name',$adhar_front_name);
        $this->session->set_userdata('adhar_back_name',$adhar_back_name);

	}

	public function abuse_power(){

		$this->load->library('session');
		$this->load->helper('url');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/abuse_power');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('basic_details');
				$this->load->view('footer');

			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/abuse_power');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');

            }

	}

	}

	public function pf_claim(){

		$this->load->library('session');
		$this->load->helper('url');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/pf_claim');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('basic_details');
				$this->load->view('footer');

			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/pf_claim');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');

            }
      }
      
	}

	public function esi_claim(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');


		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/esi_claim');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');

			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/esi_claim');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');

            }

	}



	}

	public function salary_dues(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/salary_dues');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/salary_dues');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }

	}

	public function non_payment_salary(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/non_payment_salary');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/non_payment_salary');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }

	}


	public function voilation_aggrement(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/voilation_aggrement');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/voilation_aggrement');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }

	}

	public function gratuity_claim(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/gratuity_claim');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/gratuity_claim');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }

	}

	public function wrongful_termination(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/wrongful_termination');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/wrongful_termination');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }


	}

	public function misconduct_notice(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/misconduct_notice');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/misconduct_notice');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }


	}

	public function suspension_notice(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/suspension_notice');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/suspension_notice');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }


	}



	public function harrashment(){

		$this->load->library('session');
		$this->load->view('header');
		$this->load->view('datepicker');

		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			if( $basic_details_filled ){

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/harrashment');
				$this->load->view('footer');

			}else{

				$this->load->view('login_header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
			}

	    }else{

		    if( isset($basic_details_filled) || ($basic_details_filled=='1') ){

		    	$this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/harrashment');
				$this->load->view('footer');
                return;

            }else{

                $this->load->view('header');
	        	$this->load->view('datepicker');
				$this->load->view('Employee/home');
				$this->load->view('footer');
            }

	    }
	}

	public function saveFinalData(){

		$this->load->helper('url');
		$this->load->helper('upload');
        $this->load->library('session');
        $page_name = $this->session->userdata('page_name');
        $this->session->set_userdata('final_filled',"1");
        $page_name = $page_name."_data";
        $result = $page_name($_POST,$_FILES);
        return $result;
	}

	public function save_pf_claim(){


		$this->load->helper('url');
		$this->load->helper('upload');
        $this->load->library('session');
        $this->load->model('notice_model');
        $data = $_POST;

        $page_name = $this->session->userdata('page_name');
        $this->session->set_userdata('final_filled',"1");
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');
		$adhar_front_name = $this->session->userdata('adhar_front_name');
		$adhar_back_name  = $this->session->userdata('adhar_back_name');
		$pf_complaint_attachment =  uploadFiles($_FILES['pf_complaint_attachment']);
		$session_user_id = $this->session->userdata('user_id');

			if( !$user_login ){

				$uniqid = uniqid();

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

                $pf_claim = array(

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
                    'pf_office'                 => $data['pf_office'], 
                    'address_office'            => $data['pf_office_address'],
                    'pf_complaint'             =>  $data['no_pf_complaint'],
                    'communication_attachment'  => $pf_complaint_attachment,
                    'relief'                    => $data['relief']

            );

                $userData = $this->notice_model->addPfClaimWithoutLogin($register,$pf_claim);



            }else{

              $pf_claim = array(

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
                    'pf_office'                 => $data['pf_office'], 
                    'address_office'            => $data['pf_office_address'],
                    'pf_complaint'             =>  $data['no_pf_complaint'],
                    'communication_attachment'  => $pf_complaint_attachment,
                    'relief'                    => $data['relief']

            );
                 
            $userData = $this->notice_model->addPfClaimWithLogin($pf_claim);

		}

		if($userData){
                     echo  "1";
        }
        else{
                     echo "2";
        }
	

	
}

}