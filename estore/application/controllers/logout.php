<?php
class Logout extends CI_Controller {
	function __construct() {
		parent::__construct ();
		$this->session->unset_userdata(array(
				'login' => '',
				'logged_in' => FALSE
		));
		$this->session->sess_destroy();
		$this->index();
	}
	function index(){
		redirect('store/');
	}
}
?>