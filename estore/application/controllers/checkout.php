<?php 

class Checkout extends CI_Controller {
	function __construct()
	{
		parent::__construct();

		if (!$this->session->userdata('logged_in') || ($this->session->userdata('login') === 'admin')){
			$this->load->helper('url');
			$this->session->set_userdata('lastPage', current_url());
			redirect('loginUser');
		}

	}
	
	function index() {
		$this->load->library('session');
	}
	
	function checkoutcart(){	
		if (!$this->session->userdata('logged_in') || ($this->session->userdata('login') === 'admin')){
			$this->load->helper('url');
			$this->session->set_userdata('lastPage', current_url());
			redirect('loginUser');
		}
		$this->load->view('checkoutview');
	}

	function verify(){
		
		$this->load->library ( 'form_validation' );
		
		$this->form_validation->set_rules ('name', 'Name', 'required|trim'); 
		$this->form_validation->set_rules ('credit', 'CreditCardNumber', 'required|trim|exact_length[16]|numeric');
		$this->form_validation->set_rules ('expmonth', 'ExpiryMonth', 'required|trim');
		$this->form_validation->set_rules ('expyear', 'ExpiryYear', 'required|trim');
		$this->form_validation->set_rules ('securitycode', 'SecurityCode', 'required|trim|exact_length[3]');
		
		if ($this->form_validation->run () == FALSE) {
			$this->load->view('checkoutview');
		}  else {
				
			$log = $this->session->userdata('login');
			$this->load->model('orders_model');
			
			$customer_id = $this->orders_model->getCustomerID($log);
			
			if ($this->orders_model->insert($customer_id)==FALSE){

				echo "Card Expired, please enter credit card with a valid date.	";
				echo anchor("checkout/verify","Take me back");	     				

			}

		}
		
	}
	
	
}

?>