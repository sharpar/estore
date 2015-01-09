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
		
			<h2>Baseball Cards Available</h2>
			
			<table class="table table-hover cards">
		
			<?php 
				
				echo "<tr><th>Name</th><th>Description</th><th>Price</th><th>Photo</th><th>Edit</th><th>Delete</th></tr>";
				
				foreach ($products as $product) {
					echo "<tr>";
					echo "<td>" . $product->name . "</td>";
					echo "<td>" . $product->description . "</td>";
					echo "<td>" . $product->price . "</td>";
					echo "<td><img src='" . base_url() . "images/product/" . $product->photo_url . "' width='100px' /></td>";
						
					echo "<td>" . anchor("store/update/$product->id",'Edit') . "</td>";					
					echo "<td>" . anchor("store/delete/$product->id",'Delete') . "</td>";
					echo "</tr>";
				}
			?>	
			</table>
			<ul class="nav nav-pills" role="tablist">
				<li role="presentation" class="active"><?=anchor('store/newForm', ' Add a product')?></li>			     
			</ul>
			
		</div>
	</body>
