<h2>Edit Product</h2>

<style>
input {
	display: block;
}
</style>

<?php
echo "<p>" . anchor ( 'store/admin', 'Back' ) . "</p>";

echo form_open ( "store/update/$product->id" );

echo form_label ( 'Name' );
echo form_error ( 'name' );
echo form_input ( 'name', $product->name, "required" );

echo form_label ( 'Description' );
echo form_error ( 'description' );
echo form_input ( 'description', $product->description, "required" );

echo form_label ( 'Price' );
echo form_error ( 'price' );
echo form_input ( 'price', $product->price, "required" );

echo form_submit ( 'store/admin', 'Save' );
echo form_close ();
?>	
