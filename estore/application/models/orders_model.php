<?php
class orders_model extends CI_Model {
	
	function getAll() {
		$query = $this->db->get("orders");
		return $query->result();
	}
	
	function getOrder($id) {
		$this->db->where('id', $id);	  
		$users = $this->db->get('orders');
		return ($users->num_rows() > 0) ? $users : FALSE;
	}
	
	function delete($id) { 
		return $this->db->delete("orders", array(
				'id' => $id 
		));
	}
	
	function insert($cid) {
		
		date_default_timezone_set('America/Toronto');
		$date = date("Y-m-d");
		$time = date('H:i:s');
		$total = $this->cart->total();
		$month = $this->input->get_post("expmonth");
		$year = $this->input->get_post("expyear");
		$mydate = strval($month) . "-" . strval($year);
		$current = date("m-Y");
		
		if ( $mydate >= $current ){
			
		$order = array(
				"customer_id" => $cid,
				"order_date" => $date,
				"order_time" => $time,
				"total" => $total,
				"creditcard_number" => $this->input->get_post("credit"),
				"creditcard_month" => $this->input->get_post("expmonth"),
				"creditcard_year" => $this->input->get_post("expyear")
				
		);
		
		$this->db->insert("orders", $order);
		$ordId = $this->orders_model->lastOrder();
		$cart = $this->cart->contents();
		foreach ($cart as $cartItem) {	
			
			$this->load->model('item');
			$item = new item();
			$item->product_id = $cartItem['id'];
			$item->quantity = $cartItem['qty'];
			$item->order_id = $ordId;
			$this->orders_model->insertItem($item);
		}
			
		$this->load->view('product/print.php', $order);
		
	}
	else {
		return FALSE;
	}
	}
	
	function getCustomerID($login) {
		$query = $this->db->get_where('customers',array('login' => $login));
		return ($query->num_rows() > 0) ? $query->row()->id : FALSE;
	}
	
	function getCustomerEmail($login) {
		$query = $this->db->get_where('customers',array('login' => $login));
		return ($query->num_rows() > 0) ? $query->row()->email : FALSE;
	}
	
	function insertItem($item)
	{
		$this->db->insert("order_items", array(
				'order_id' => $item->order_id,
				'product_id' => $item->product_id,
				'quantity' => $item->quantity
		));
	}
	
	function lastOrder()
	{
		$query = $this->db->query("SELECT id FROM orders order by id desc LIMIT 1;");
		$row = $query->row(0);
		return $row->id;
	}
	
}
?>
