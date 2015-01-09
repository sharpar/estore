<?php
class LoginAdmin extends CI_Controller {
	
	private $adminLogin = 'admin';
	private $adminPassword = 'adminp';
	
	function __construct() {
		parent::__construct ();
		if ($this->session->userdata('logged_in') && ($this->session->userdata('login') === 'admin')){
			redirect('store/admin');
		}
	}
	function index() {
		$data['title'] = "Admin Login";
		$data['css'] = "admin.css";
		$data['errors'] = '';
		$this->load->library('session');
		$this->load->view( "header", $data);
		$this->load->view('adminViews/adminForm', $data);
		$this->load->view("footer", $data);
	}
	function login() {
		$this->load->library('form_validation');
		$this->load->model("user_model");
		$this->form_validation->set_rules('login', 'Login', 'required|trim|max_length[16]');
		$this->form_validation->set_rules ('password', 'Password', 'required|trim|max_length[16]|min_length[6]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->index();
		} else {
			$login = $this->input->get_post('login'); 
			$password = $this->input->get_post('password');
			if((strcmp($login, $this->adminLogin) != 0) || (strcmp($password, $this->adminPassword) != 0)){
					// incorrect login and/or password
					$data['errors'] = "Incorrect login or password";
					$data['css'] = "admin.css";
					$this->load->view ( "header", $data );
					$this->load->view ( 'adminViews/adminForm', $data );
					$this->load->view ( "footer", $data );				
			}else{
				$sessiondata = array(
						'login'  => $login,
						'logged_in' => TRUE
				);
				$this->session->set_userdata($sessiondata);
				redirect('store/admin/');
			}
		}
	}
}
?>