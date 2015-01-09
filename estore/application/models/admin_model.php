<?php
class Admin_model extends CI_Model {
	function getAll() {
		$query = $this->db->get("customers");
		return $query->result();
	}
	function getUser($login, $password) {
		$this->db->where('login', $login);
		$this->db->where('password', $password);	  
		$users = $this->db->get('customers');
		return ($users->num_rows() > 0) ? $users : FALSE;
	}
	function delete($id) {
		return $this->db->delete("customers", array(
				'id' => $id 
		));
	}
	function add() {
		$user = array(
				"first" => $this->input->get_post("firstname"),
				"last" => $this->input->get_post("lastname"),
				"login" => $this->input->get_post("login"),
				"password" => $this->input->get_post("password"),
				"email" => $this->input->get_post("email")
		);
		return $this->db->insert ("customers", $user);
	}
	function edit($product) {
		$this->db->where ('id', $product->id);
		return $this->db->update ("customers", array(
				'first' => $user->firstname,
				'last' => $user->lastname,
				'login' => $user->login,
				'email' => $user->email 
		));
	}
}
?>
