<?php
// include the database connection
include "src/database.php";

// if product id exists in the URL
if( $_GET['product_id']) {
    $id = $_GET['product_id'];
    // get product details from database
    $query = "SELECT name,price,description FROM `Product` WHERE id=?";
    $statement = $connection -> prepare($query);
    $statement -> bind_param("i",$id);
    $statement -> execute();
    $result = $statement -> get_result();
    $product = $result -> fetch_assoc();
    $name = $product['name'];
    $price = $product['price'];
    $description = $product['description'];
}
$submitting = false;

// submitting order to the database
if( $_SERVER['REQUEST_METHOD'] == 'POST') {
    $customer_name = $_POST['name'];
    $email = $_POST['email'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $total = $_POST['total'];
    $date = date('Y-m-d H:i:s');

    $query = "
    INSERT INTO orders 
    (customer_name,
    email,
    product_name,
    quantity,
    price,
    order_date)
    VALUES(?,?,?,?,?,?)";

    $statement = $connection -> prepare($query);
    $statement -> bind_param("sssids",$customer_name,$email,$product_name,$price,$quantity,$date);
    $statement -> execute();
    $submitting = true;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include "includes/head.php"; ?>

<body>
    <?php include "includes/pageheader.php" ?>
   
    <main class="container">
        <form id="order-form" method="post" action="order.php">
            <?php
            if( $submitting == true ) {
                echo "<p class='alert'>Thank you for your order</p>";
            }
            ?>
            <h3>Your order</h3>
            <label for="name">Your Name</label>
            <input maxlength="255" required type="text" name="name" id="name" placeholder="Jane Smith">
            <label for="email">Your Email Address</label>
            <input maxlength="255" required type="email" name="email" id="email" placeholder="you@example.com">
            <label for="product_name">Product Name</label>
            <input maxlength="255" type="text" value="<?php echo $name; ?>" name="product_name" id="product_name" placeholder="Hey there">
            <label for="price">Price</label>
            <input type="number" value="<?php echo $price; ?>" readonly id="price" name="price">
            <label for="quantity">Quantity</label>
            <input type="number" value="1" min="1" name="quantity" id="quantity">
            <label for="total">total</label>
            <input type="number" readonly value="<?php echo $price; ?>" min="1" name="total" id="total">
            <div class="buttons">
                <button type="reset">Cancel</button>
                <button type="submit">Submit Order</button>
            </div>
        </form>
    </main>
    <?php include "includes/footer.php"; ?>
    <script>
        const form = document.querySelector("#order-form")
        const price = document.querySelector("#price").value
        const total = document.querySelector("#total")
        
        function onChange( event ) {
           if(event.target.id = "quantity") {
              total.value = price * event.target.value  
           }
           
        }
        form.addEventListener("change", onChange )
    </script>
</body>

</html>