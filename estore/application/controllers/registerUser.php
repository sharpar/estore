<?php
class RegisterUser extends CI_Controller {
	function __construct() {
		parent::__construct ();
	}
	function index() {
		$data['title'] = "Register";
		$data['css'] = "registration.css";
		$this->load->model("user_model");
		$this->load->view ( "header", $data );
		$this->load->view ( 'registerForm', $data );
		$this->load->view ( "footer", $data );
	}
	function register() {
		$this->load->library ( 'form_validation' );
		$this->load->model("user_model");
		$this->form_validation->set_rules ('firstname', 'Firstname', 'required|trim|max_length[24]');
		$this->form_validation->set_rules ('lastname', 'Lastname', 'required|trim|max_length[24]');
		$this->form_validation->set_rules('login', 'Login', 'required|trim|is_unique[customers.login|max_length[16]');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim|max_length[16]|min_length[6]');
		$this->form_validation->set_rules ('email', 'Email', 'required|trim|valid_email|is_unique[customers.email]|max_length[45]');
		
		if ($this->form_validation->run () == FALSE) {
			$this->index();
		} else {
			$this->user_model->insert();
			redirect('loginUser/');
		}
	}
}
?>