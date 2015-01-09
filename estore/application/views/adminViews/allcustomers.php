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
		
			<h2>All Customers</h2>
			
			<table class="table table-hover cards">
		
			<?php 
				
				echo "<tr><th>id</th><th>First</th><th>Last</th><th>Login</th><th>Password</th><th>Email</th><th>Delete</th></tr>";
				
				foreach ($customers as $customer) {
					echo "<tr>";
					echo "<td>" . $customer->id . "</td>";
					echo "<td>" . $customer->first . "</td>";
					echo "<td>" . $customer->last . "</td>";
					echo "<td>" . $customer->login . "</td>";
					echo "<td>" . $customer->password . "</td>";
					echo "<td>" . $customer->email . "</td>";
										
					echo "<td>" . anchor("store/deleteThisCustomer/$customer->id",'Delete') . "</td>";
					echo "</tr>";
				}
			?>	
			</table>
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><?=anchor('store/deleteAllCustomers', 'DELETE ALL CUSTOMERS')?></li>			     
			</ul>
			
		</div>
	</body>
