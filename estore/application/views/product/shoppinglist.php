<!-- Shows all the cards in database available for purchase to the customer. -->
<!DOCTYPE html>
<html>
	<head>
		<title>Shopping</title>
		<meta charset="utf-8">
		
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
		<link rel="stylesheet" href=" <?php echo base_url(); ?>css/shopping.css" type="text/css">
		
		<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-2.1.1.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	</head>
	<body>
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><?=anchor('store/', 'Store')?></li>	
				<li role="presentation" class="active"><?=anchor('loginAdmin/', 'Admininstrator')?></li>		     
				<?php if($this->session->userdata('logged_in')){
					echo '<li role="presentation" class="active">'.anchor("logout/", "Logout").'</li>';
				}?>
			</ul>
		<div>
		
			<h2>Baseball Cards Available</h2>
			
			<table class="table table-hover cards">
		
			<?php 
				
				echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th></tr>";
				
				foreach ($products as $product) {
					echo "<tr>";
					echo "<td>" . $product->name . "</td>";
					echo "<td>" . $product->description . "</td>";
					echo "<td>" . $product->price . "</td>";
					echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
						
					echo "<td>" . anchor("store/read/$product->id",'View') . "</td>";
					echo "<td>" . anchor("store/addtocart/$product->id",'Add to Cart') . "</td>";
					
					echo "</tr>";
				}
			?>	
			</table>
		</div>
		
		<div class="cart">
		
			<h3>Your Shopping Cart</h3>
	
			<table class = "table table-condensed">
			
				<tr><th>Item Name</th><th>Item Price</th><th>Photo</th><th>Quantity</th></tr>
				<?php 
					
					$cart = $this->cart->contents();
					
					foreach ($cart as $item) {
						echo "<tr>";
						echo "<td>" . $item['name'] . "</td>";
						echo "<td>" . $item['price']. " x ".$item['qty']."<br> = ". $item['subtotal'] . "</td>";
						echo "<td><img src='" . base_url() . "images/product/" . $item['photo'] . "' width='50px' /></td>";
						echo '<td>'. $item["qty"] . '</td>' ;
						echo "<td>" . anchor("store/addtocart/". $item["id"], "Add One More"). '<br>' . anchor("store/decrease/". $item["id"], "Remove One").'<br>'. anchor("store/remove/".$item['rowid'], 'Delete All') ."</td>"; 
						echo "</tr>";
					}

				?>
				
				<tr class = "total">
				<td><strong>Total</strong></td>
				<td> <?php echo $this->cart->total() ?>
				<td> <?php echo anchor("store/clearCart", 'Clear Cart')?> </td>
				<td> <?php echo anchor("store/verifyCartSize/".$this->cart->total_items(), 'Checkout')?> </td>
				</tr>
			</table>
		</div>
	</body>
</html>