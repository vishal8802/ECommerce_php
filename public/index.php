<?php require_once("../resources/config.php") ; ?>

<!-- Header -->
<?php include(TEMPLATE_FRONT.DS."header.php") ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Categories here -->
            
            <?php include(TEMPLATE_FRONT.DS."sidenav.php") ?>

            <div class="col-md-9">

                <div class="row carousel-holder">

                    <div class="col-md-12">
                        <!-- carousel -->
                        <?php include(TEMPLATE_FRONT.DS."slider.php") ?>
                    </div>

                </div>

                <div class="row">
                    

                    
                    <?php get_products();  ?>




                    <!-- row end here BELOW -->

                </div>

            </div>

        </div>

    </div>
    <!-- /.container -->

<!-- footer -->

<?php include(TEMPLATE_FRONT.DS."footer.php"); ?>