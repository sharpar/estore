<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="<?=base_url()?>css/print.css">

<?php

	$log = $this->session->userdata('login');
	$this->load->model('orders_model');
	$email = $this->orders_model->getCustomerEmail($log);

	echo '<div id="printable">';
	echo '<p><b> Customer Receipt </b><p>'; 
	echo '<p> Customer ID: ' . $customer_id . '</p>';
	echo '<p> Order Date: ' . $order_date . '<p>';
	echo '<p> Order Time: ' . $order_time . '<p>';
	echo '<p> Credit Card Number: XXXX-XXXX-XXXX-'.substr($creditcard_number,-4) . '<p>';
	echo '<p> Order Total: ' . $total . '<p>';
	echo '<p> Email: ' . $email . '<p>';
	echo '<hr />';
	echo '<p> Thank you for shopping with us.</p>';
	echo '</div>';
		
		$config = Array(
				'protocol' => 'smtp',
				'smtp_host' => 'ssl://smtp.gmail.com',
				'smtp_port' => 465,
				'smtp_user' => 'estoreuoft@gmail.com',
				'smtp_pass' => 'shivain27',
				'mailtype' => 'html',
				'charset' => 'iso-8859-1',
				'crlf' => "\r\n",
				'newline' => "\r\n" );
		
		$this->load->library('email');
		
		$this->email->initialize($config);

		$this->email->from(' ',' ');
		$this->email->to($email);
		$this->email->subject('Receipt');
		
   	    	$message = '<div id="printable">';
   	    $message .= '<p><b> Customer Receipt </b><p>';
   	    $message .= '<p> Customer ID: ' . $customer_id . '</p>';
   	    $message .= '<p> Order Date: ' . $order_date . '<p>';
   	    $message .= '<p> Order Time: ' . $order_time . '<p>';
   	    $message .= '<p> Credit Card Number: XXXX-XXXX-XXXX-'.substr($creditcard_number,-4) . '<p>';
   	    $message .= '<p> Order Total: ' . $total . '<p>';
   	    $message .= '<p> Email: ' . $email . '<p>';
   	    $message .= '<hr />';
   	    $message .= '<p> Thank you for shopping with us.</p>';
   	    $message .= '</div>';
		
		$this->email->message($message);
		
		echo '<div>';	
		if($this->email->send()) {
			echo "A copy of the receipt was sent to your email address.";
		} else {
			echo "Could not send the email.";
		}
		echo '</div>';
		
	?>
	<br>
	<button onclick='printDiv("printable")' class="btn btn-success">Print Reciept</button>
	
	<script type="text/javascript">
		function printDiv(divName) {
		     var printContents = document.getElementById(divName).innerHTML;
		     var originalContents = document.body.innerHTML;
		
		     document.body.innerHTML = printContents;
		
		     window.print();
		
		     document.body.innerHTML = originalContents;
			}
	</script>
	
	<div>
	<ul class="nav nav-pills" role="tablist">
			<li role="presentation" class="active"><?=anchor('store/clearcart', ' Back to Store')?></li>			     
			<li role="presentation" class="active"><?=anchor('logout/', 'Logout')?></li>
	</ul>
	</div>