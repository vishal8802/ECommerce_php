<?php

//Helper Functions

//to redirect   : header 
// function redirect($location){
//not working
//  header("location : $location");
// }

//message for login

function last_id(){
    global $connection;
    return mysqli_insert_id($connection);
}

function set_message($msg){
    if(!empty($msg)){
        $_SESSION['message'] = $msg;
    }else{
        $msg= "";
    }
}

function display_message(){
    if(isset($_SESSION['message'])){

        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
}

//query execute : mysqli_query

function query($sql){

    global $connection;

    return mysqli_query($connection , $sql);
}

//

function confirm($result){

    global $connection;
    if(!$result){
        die("QUERY FAILED".mysqli_error($connection));
    }

}


function escape_string($string){

    global $connection;

    return mysqli_real_escape_string($connection, $string);

}

function fetch_array($result){

    return mysqli_fetch_array($result);
}

/*************************** FRONT END FUNCTIONS ***************************/

//Get Products

function get_products(){

    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){

        $products = <<<EOT

        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <a href="item.php?id={$row['product_id']}"> <img src="{$row['product_image']}" alt=""></a>
                <div class="caption">
                    <h4 class="pull-right">&#8377; {$row['product_price']}</h4>
                    <h4><a href="item.php?id={$row['product_id']}">{$row['product_title']}</a>
                    </h4>
                    <p>This is a short description. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>

                    <a class="btn btn-primary"  href="../resources/cart.php?add={$row['product_id']}">Add To Cart</a>
                </div>
                                            

            </div>
        </div>
        

EOT;
//heredoc (upper name)
//echo here
        echo $products;

    }

}





function get_categories(){

    
    $query = query("SELECT * FROM categories");

    confirm($query);
    
    while($row = fetch_array($query)){

        $categories_links = <<<DELIMETER
        
        <a href='category.php?id={$row['cat_id']}' class='list-group-item'> {$row['cat_title']}</a>  


DELIMETER;

//echo here

    echo $categories_links;
    }

}


function get_products_in_cat_page(){

    $query = query("SELECT * FROM products WHERE product_category_id=".escape_string($_GET['id'])." "); 
    confirm($query);

    while($row = fetch_array($query)){

        $products = <<<EOT

        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>The best PRODUCT</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

        

EOT;
//heredoc (upper name)
//echo here
        echo $products;

    }

}

function get_products_in_shop_page(){

    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){

        $products = <<<EOT

        <div class="col-md-3 col-sm-6 hero-feature">
                <div class="thumbnail">
                    <img src="{$row['product_image']}" alt="">
                    <div class="caption">
                        <h3>{$row['product_title']}</h3>
                        <p>The best PRODUCT</p>
                        <p>
                            <a href="#" class="btn btn-primary">Buy Now!</a> <a href="item.php?id={$row['product_id']}" class="btn btn-default">More Info</a>
                        </p>
                    </div>
                </div>
            </div>

        

EOT;
//heredoc (upper name)
//echo here
        echo $products;

    }

}


function login_user(){

    if(isset($_POST['submit'])){

        $username = escape_string($_POST['username']);
        $password = escape_string($_POST['password']);

        $query = query("SELECT * FROM users WHERE password = '{$password}' AND username = '{$username}' ");
        confirm($query);

        if(mysqli_num_rows($query) == 0){
            set_message("Your password and username is wrong");
            header("location: login.php");
        
        }else{

            $_SESSION['username'] = $username;
            //set_message("Welcome to Admin {$username}");
            header("location: admin");

        }

    }

}



function send_message(){

    if(isset($_POST['submit'])){

        $to         =  "jatin6972@gmail.com";
        $from_name  =  $_POST['name'];
        $subject    =  $_POST['subject'];        
        $message    =  $_POST['message'];
        $email      =  $_POST['email'];

        $headers = "From: {$from_name} {$email}";

        $result = mail($to , $subject , $message , $headers);

        if(!$result){
            set_message("Sorry we could not send your message");
        }else{
            set_message("Your Message has been Sent");  
        }


    }

}








/*************************** BACK END FUNCTIONS ***************************/

function display_orders(){
    $query=query("SELECT *FROM orders");
    confirm($query);
    while($row=fetch_array($query)) {
        $orders= <<<DELIMETER
        <tr>
            <td>{$row['order_id']}</td>
            <td>{$row['order_amount']}</td>
            <td>{$row['order_transaction']}</td>
            <td>{$row['order_currency']}</td>
            <td>{$row['order_status']}</td>
            <td><a class="btn btn-danger" href="../../resources/templates/back/delete_order.php?id={$row['order_id']}"><span class="glyphicon glyphicon-remove"></td>
        </tr>
DELIMETER;
echo $orders;
    }
}

/**********************Admin products************************ */
function get_products_in_admin(){
    
    $query = query("SELECT * FROM products");
    confirm($query);

    while($row = fetch_array($query)){

        $products = <<<EOT

        <tr>
            <td>{$row['product_id']}</td>
            <td>{$row['product_title']}<br>
              <img src="{$row['product_image']}" alt="">
            </td>
            <td>Category</td>
            <td>{$row['product_price']}</td>
            <td>{$row['product_quantity']}</td>
        </tr>
        

EOT;
//heredoc (upper name)
//echo here
        echo $products;

    }
}
?>