
<?php require_once("../resources/config.php"); ?>
<?php include(TEMPLATE_FRONT.DS."header.php"); ?>


<?php 

process_transaction();


//session_destroy();

// } else {

//     header("location:index.php");

// }



?>


    <div class="container">
    <!-- /.row --> 

        <h1 class="text-center"> THANK YOU </h1>

    </div>
    <!-- /.container -->

<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>