<?php
class LoginUser extends CI_Controller {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		$data['title'] = "Login";
		$data['css'] = "login.css";
		$data['errors'] = '';
		$this->load->model("user_model");
		$this->load->library('session');
		$this->load->view ( "header", $data );
		$this->load->view ( 'loginForm', $data );
		$this->load->view ( "footer", $data );
	}
	function login() {
		$this->load->library( 'form_validation' );
		$this->load->model("user_model");
		$this->form_validation->set_rules('login', 'Login', 'required|trim|');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim|min_length[6]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$login = $this->input->get_post('login'); 
			$password = $this->input->get_post('password');
			$result = $this->user_model->getUser($login, $password);
			if($result == FALSE){
					// incorrect login and/or password
					$data['errors'] = "Incorrect login or password";
					$data['css'] = "login.css";
					$this->load->view ( "header", $data );
					$this->load->view ( 'loginForm', $data );
					$this->load->view ( "footer", $data );				
			}else{
				$sessiondata = array(
						'login'  => $login,
						'logged_in' => TRUE
				);
				
				$this->session->set_userdata($sessiondata);
				$lastPage = $this->session->userdata('lastPage');
				redirect($lastPage);
			}
		}
	}
}
?>