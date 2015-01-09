<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href=" <?php echo base_url(); ?>css/shopping.css" type="text/css">
<h2>Product Entry</h2>
<div id="read">
<?php
echo "<p>" . anchor ( 'store/index', 'Back' ) . "</p>";

echo "<p> ID = " . $product->id . "</p>";
echo "<p> NAME = " . $product->name . "</p>";
echo "<p> Description = " . $product->description . "</p>";
echo "<p> Price = " . $product->price . "</p>";
echo "<p><img src='" . base_url () . "images/product/" . $product->photo_url . "' width='100px'/></p>";

?>	
</div>
