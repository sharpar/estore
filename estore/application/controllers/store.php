<?php
class Store extends CI_Controller {
	function __construct() {
		// Call the Controller constructor
		parent::__construct ();
		
		$config ['upload_path'] = './images/product/';
		$config ['allowed_types'] = 'gif|jpg|png';
		/*
		 * $config['max_size'] = '100';
		 * $config['max_width'] = '1024';
		 * $config['max_height'] = '768';
		 */
		
		$this->load->library ( 'upload', $config );
	}
	
	function index() {
		$this->load->library('session');
		$this->load->model ( 'product_model' );
		$products = $this->product_model->getAll();
		$data ['products'] = $products;
		$data['logged_in'] = $this->session->userdata('logged_in');
		$this->load->view ( 'product/shoppinglist.php', $data );
	}
	
	function admin(){
		if (!$this->session->userdata('logged_in') || !($this->session->userdata('login') === 'admin')){
			redirect('loginAdmin');
		}
		$this->load->library('session');
		$this->load->model ( 'product_model' );
		$products = $this->product_model->getAll();
		$data ['products'] = $products;
		$data['css'] = 'admin.css';
		$this->load->view( "header", $data);
		$this->load->view('adminViews/adminProducts', $data);
		$this->load->view("footer", $data);
	}
	
	function displayOrders(){
		if (!$this->session->userdata('logged_in') || !($this->session->userdata('login') === 'admin')){
			redirect('loginAdmin');
		}
		$this->load->model ('orders_model');
		$orders = $this->orders_model->getAll();
		$data['orders'] = $orders;
		$data['css'] = 'admin.css';
		$this->load->view( "header", $data);
		$this->load->view('adminViews/allorder', $data);
		$this->load->view("footer", $data);
	}
	
	function displayCustomers(){
		if (!$this->session->userdata('logged_in') || !($this->session->userdata('login') === 'admin')){
			redirect('loginAdmin');
		}
		$this->load->model ('user_model');
		$customers = $this->user_model->getAll();
		$data['customers'] = $customers;
		$data['css'] = 'admin.css';
		$this->load->view( "header", $data);
		$this->load->view('adminViews/allCustomers', $data);
		$this->load->view("footer", $data);
	}
	
	function deleteThisCustomer($id){
		if (!$this->session->userdata('logged_in') || !($this->session->userdata('login') === 'admin')){
			redirect('loginAdmin');
		}
		$this->load->model ('user_model');
		$this->user_model->delete($id);
		$this->displayCustomers();
	}
	
	function deleteAllCustomers(){
		if (!$this->session->userdata('logged_in') || !($this->session->userdata('login') === 'admin')){
			redirect('loginAdmin');
		}
		$this->load->model ('user_model');
		$customers = $this->user_model->getAll();
		foreach($customers as $customer){
			$this->user_model->delete($customer->id);
		}
		$this->displayCustomers();
	}
	
	function deleteAllOrders(){
		if (!$this->session->userdata('logged_in') || !($this->session->userdata('login') === 'admin')){
			redirect('loginAdmin');
		}
		$this->load->model('orders_model');
		$orders = $this->orders_model->getAll();
		foreach($orders as $order){
			$this->orders_model->delete($order->id);
		}
		$this->displayOrders();
	}
	
	function newForm() {
		$this->load->view ( 'product/newForm.php' );
	}
	
	function create() {
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'name', 'Name', 'required|is_unique[products.name]' );
		$this->form_validation->set_rules ( 'description', 'Description', 'required' );
		$this->form_validation->set_rules ( 'price', 'Price', 'required' );
		
		$fileUploadSuccess = $this->upload->do_upload ();
		
		if ($this->form_validation->run () == true && $fileUploadSuccess) {
			$this->load->model ( 'product_model' );
			
			$product = new Product ();
			$product->name = $this->input->get_post ( 'name' );
			$product->description = $this->input->get_post ( 'description' );
			$product->price = $this->input->get_post ( 'price' );
			
			$data = $this->upload->data ();
			$product->photo_url = $data ['file_name'];
			
			$this->product_model->insert ( $product );
			
			// Then we redirect to the index page again
			redirect ( 'store/admin', 'refresh' );
		} else {
			if (! $fileUploadSuccess) {
				$data ['fileerror'] = $this->upload->display_errors ();
				$this->load->view ( 'product/newForm.php', $data );
				return;
			}
			
			$this->load->view ( 'product/newForm.php' );
		}
	}
	
	function read($id) {
		$this->load->model ( 'product_model' );
		$product = $this->product_model->get ( $id );
		$data ['product'] = $product;
		$this->load->view ( 'product/read.php', $data );
	}
	
	function editForm($id) {
		$this->load->model ( 'product_model' );
		$product = $this->product_model->get ( $id );
		$data ['product'] = $product;
		$this->load->view ( 'product/editForm.php', $data );
	}
	
	function update($id) {
		$this->load->library ( 'form_validation' );
		$this->form_validation->set_rules ( 'name', 'Name', 'required' );
		$this->form_validation->set_rules ( 'description', 'Description', 'required' );
		$this->form_validation->set_rules ( 'price', 'Price', 'required' );
		
		if ($this->form_validation->run () == true) {
			$product = new Product ();
			$product->id = $id;
			$product->name = $this->input->get_post ( 'name' );
			$product->description = $this->input->get_post ( 'description' );
			$product->price = $this->input->get_post ( 'price' );
			
			$this->load->model ( 'product_model' );
			$this->product_model->update ( $product );
			// Then we redirect to the index page again
			redirect ( 'store/admin', 'refresh' );
		} else {
			$product = new Product ();
			$product->id = $id;
			$product->name = set_value ( 'name' );
			$product->description = set_value ( 'description' );
			$product->price = set_value ( 'price' );
			$data ['product'] = $product;
			$this->load->view ( 'product/editForm.php', $data );
		}
	}
	
	function delete($id) {
		$this->load->model ( 'product_model' );
		
		if (isset ( $id ))
			$this->product_model->delete( $id );

		redirect ( 'store/admin', 'refresh' );
	}
	
	function shoppingList() {
   		$this->load->model('product_model');
   		$products = $this->product_model->getAll();
   		$data['products']=$products;
   		$data['cart'] = $this->load->library('cart');
   		$this->load->view('product/shoppinglist', $data);
   }
   
   	function addToCart($id) { # add to cart by passing product id.
   		
	   	$this->load->model('product_model');
	   	$product = $this->product_model->get($id);
	   	$exists = FALSE;
	   	$cart = $this->cart->contents();
	   	foreach($cart as $item) {
	   		if($item['id'] == $id)
	   		{
	   			$exists = true;
	   			$rowid = $item['rowid'];
	   			$qty = $item['qty'] + 1;
	   			$this->updateQty($rowid, $qty);
	   		}
	   	}
	   	
	   	if ($exists == FALSE){
	   	$data = array (
	   			'id' => $product->id,
	   			'name' => $product->name,
	   			'qty' => 1,
	   			'photo' => $product->photo_url,
	   			'price' => $product->price,
	   	);
	   	
	   	$this->load->library('cart');
	   	$this->cart->insert($data);
	   	}
	   	
	   	redirect('store/shoppinglist');
   }
   
   	function showCart() { # show cart content/array
   		$cart = $this->cart->contents();
   		
   		echo "<pre>";
   		print_r($cart);
   }
   
   	function cartTotal(){ # find cart total
   		$total = $this->cart->total();
   }
   
   function decrease($id) {

   	$cart = $this->cart->contents();
   	
   	foreach($cart as $item) {
   		if($item['id'] == $id)
   		{
   			$rowid = $item['rowid'];
   			$qty = $item['qty'] - 1;
   			$this->updateQty($rowid, $qty);
   		}
   	}
   	
   	redirect('store/shoppinglist');
   	
   }
   
     
   	function updateQty($rowid, $qty){ # update quantity with row id and new quantity
   	
   		$data = array (
   				'rowid' => $rowid,
   				'qty' => $qty
   		);
   		
   		$this->cart->update($data);
   }
   
   	function remove($rowid){ # remove items by row id
   		$data = array(
   			'rowid' => $rowid,
   			'qty' => 0
   		);
   		
   		$this->cart->update($data);
   		redirect('store/shoppinglist');
   }
   
   function verifyCartSize($items){
   		if($items==0){
	   		echo "<script type='text/javascript'>alert('Please add items to cart before checking out!');</script>";
	   		echo "<script type='text/javascript'>window.location='javascript:history.go(-1)'; </script>";
	   		$this->index();
   		}
   		else {
   			redirect('checkout/checkoutcart/');
   		}
   }
   
   
   	function clearCart(){ # clear cart using the detroy function
   	
   		$this->cart->destroy();
   		redirect('store/shoppinglist');
   	
   }
}

