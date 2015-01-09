	<body>
		<nav class="navbar navbar-inverse" role="navigation">
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><?=anchor('store/admin/', 'Manage Products')?></li>			     
				<li role="presentation" class="active"><?=anchor('store/displayOrders/', 'Display Orders')?></li>
				<li role="presentation" class="active"><?=anchor('store/displayCustomers/', 'Manage Customer Info')?></li>
				<?php echo '<li role="presentation" class="active">' . anchor('logout/', 'Logout') . '</li>';?>
			</ul>
		</nav>
		<div>
		
			<h2>Final Orders</h2>
			
			<table class="table table-hover cards">
		
			<?php 
				
				echo "<tr><th>id</th><th>customer_id</th><th>order_date</th><th>total</th><th>creditcard_number</th><th>creditcard_month</th><th>creditcard_year</th></tr>";
				
				foreach ($orders as $order) {
					echo "<tr>";
					echo "<td>" . $order->id . "</td>";
					echo "<td>" . $order->customer_id . "</td>";
					echo "<td>" . $order->order_date . "</td>";
					echo "<td>" . $order->total . "</td>";
					echo "<td>" . $order->creditcard_number . "</td>";
					echo "<td>" . $order->creditcard_month . "</td>";
					echo "<td>" . $order->creditcard_year . "</td>";
					echo "</tr>";
				}
			?>	
			</table>
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><?=anchor('store/deleteAllOrders', 'DELETE ALL ORDERS')?></li>			     
			</ul>
			
		</div>
	</body>
