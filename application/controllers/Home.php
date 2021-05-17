<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index()
	{
		
        $this->load->helper('url');
        $this->load->library('session');

		$user_login = $this->session->userdata('user_login');

        if( $user_login ){

            $data = array('user_id' => $this->session->userdata('user_id'));
            $this->load->view('login_header');
			$this->load->view('home',$data);
			$this->load->view('footer');

        }else{

            $this->session->sess_destroy();
            $this->load->view('header');
            $this->load->view('home');
            $this->load->view('loginModal');
			$this->load->view('footer');

        }

	}

	public function basic_details(){

		$page_name =  $_GET['page_name'];
		$this->load->library('session');

		$user_login = $this->session->userdata('user_login');
		$this->session->set_userdata('page_name',$page_name);
		$this->session->unset_userdata('basic_details_filled');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('datepicker');
			$this->load->view('basic_details');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{

			$this->load->view('header');
			$this->load->view('datepicker');
			$this->load->view('basic_details');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}
		
	}


	public function contact(){

		echo "<pre>";print_r($_POST);die;
	}

	public function employee_home() {

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Employee/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{


			$this->load->view('header');
			$this->load->view('Employee/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}


    }

    public function bank_conflicts(){

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Bank_Conflicts/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{

			$this->load->view('header');
			$this->load->view('Bank_Conflicts/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}
    }

    public function revenue_disputes(){

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Revenue_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{
			
			$this->load->view('header');
			$this->load->view('Revenue_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}
    }

    public function rental_property(){

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Rental_Property/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{
			
			$this->load->view('header');
			$this->load->view('Rental_Property/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}

    }

    public function family_disputes(){

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Family_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{
			
			$this->load->view('header');
			$this->load->view('Family_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}


    }

    public function consumer_case(){

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Consumer_Case/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{
			
			$this->load->view('header');
			$this->load->view('Consumer_Case/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}

    }

    public function insurance_disputes(){

    	$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Insurance_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{
			
			$this->load->view('header');
			$this->load->view('Insurance_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}

    }

    public function consumer_disputes(){

		$this->load->library('session');
		$this->load->helper('url');
		$basic_details_filled = $this->session->userdata('basic_details_filled');
		$user_login = $this->session->userdata('user_login');

		if( $user_login ){

			$this->load->view('login_header');
			$this->load->view('Consumer_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');

		}else{
			
			$this->load->view('header');
			$this->load->view('Consumer_Disputes/home');
			$this->load->view('loginModal');
			$this->load->view('footer');
		}
		
    }

    public function congoPage(){

        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('user_model');
        $this->session->unset_userdata('consumer_last_insert_id');
        $this->session->unset_userdata('basic_details');
        $this->session->unset_userdata('basic_details_filled');
        $this->session->set_userdata('notice_filled',"1");
        $final_filled = $this->session->userdata('final_filled');
        $user_login = $this->session->userdata('user_login');

        if( $user_login ){
            
            $session_user_id   = $this->session->userdata('session_user_id');
             if( !isset($final_filled) && empty($final_filled) ){
                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('login_header');
                $this->load->view('congo',$data);
                return;

            }else{

                $userData = $this->user_model->retriveUserData($session_user_id);
                $data = array('user_id' => $this->session->userdata('user_id'));
                $this->load->view('login_header');
                $this->load->view('congo',$data);
                $this->load->view('datepicker');
				$this->load->view('loginModal');
				$this->load->view('footer');
                return;
            }

         }else{

            if( !isset($final_filled) && empty($final_filled) ){

                $data = array('user_id' => '');
                $this->load->view('header');
                $this->load->view('congo',$data);
                $this->load->view('datepicker');
				$this->load->view('loginModal');
				$this->load->view('footer');
               
                return;
            }else{

              //  $userData = $this->user_model->retriveUserData($session_user_id);
                $data = array('user_id' => '');
                $this->load->view('header');
                $this->load->view('congo',$data);
                $this->load->view('datepicker');
				$this->load->view('loginModal');
				$this->load->view('footer');
            }

         }

    }


}
