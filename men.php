<!DOCTYPE html>
<html lang="en">

    <?php include "src/database.php"; 
    $query="SELECT id,name,price,description,image FROM Product WHERE category= 'men'";
    // prepare statement
    $statement = $connection -> prepare($query);
    $statement -> execute();
    $result = $statement -> get_result();
    // store product in an array
    $products = array();
    while( $row = $result->fetch_assoc()) {
        array_push( $products , $row);
    }
    ?>
    <?php include "includes/head.php"; ?>   

    <body>
        <?php include "includes/pageheader.php"; ?>    
        <div class="men-banner">
            <div class="banner-text">
                <h2>SALE</h2>
                <P>Get massive discounts in our mid-year sale</P>
                <a href="sale.html">Shop</a>
            </div>
        </div>
      
        
        <main class="container">
            <?php 
            // create card from products from database
            foreach( $products as $item){
                //echo $item['image'];
                $image = $item['image'];
                $id = $item['id'];
                $name = $item['name'];
                $price = $item['price'];
                // card start
                echo "<div class='card'>";
                //product image
                echo "<img src='products/$image'>";
                //card content
                echo "<div class='card-content'>";
                echo "<h4 class='card-title'>$name</h4>";
                echo "<p class='price'>$price</p>";
                // card button
                echo "<a href='order.php?product_id=$id' class='card-button'>Order item</a>";
                echo "</div>";
                echo "</div>";
                // echo "<div class='card'></div>";
            }
            ?>    

            <div class="bottom-banner">
                <div class="banner-text">
                    <h2>Clearance Sale</h2>
                    <P>Get massive discounts</P>
                    <a href="clearance.html">Shop</a>
                </div>
            </div>

        </main>
        <?php include "includes/footer.php" ?>

    </body>

</html>
