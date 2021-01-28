<?php require_once('include/header.php') ?>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Header Area Start -->
        <?php require_once('include/nav.php'); ?>
		<!-- Header Area End -->
		<!-- Background Area Start -->
        <?php require_once('include/slider.php'); ?>
		<!-- Background Area End -->
        <!-- Notice Start -->
        <section class="notice-area pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php require_once('include/notice-left.php'); ?>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php require_once('include/notice-right.php'); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Notice End -->
        <!-- Choose Start -->
        <section class="choose-area pb-85 pt-77">
            <div class="container">
                <div class="row">
                   <?php require_once('include/course-content.php'); ?>
                    </div>
                </div>
            </div>
        </section>
        <!-- Choose Area End -->
        <!-- Courses Area Start -->
        <div class="courses-area pt-150 text-center">
            <div class="container">
                <?php include_once('include/course-offer.php'); ?>
            </div>
        </div>
        <!-- Courses Area End -->
        <!-- Event Area Start -->
        <div class="event-area one text-center pt-140 pb-150">
            <div class="container">
            <?php include_once('include/events.php'); ?>
            </div>
        </div>
        <!-- Event Area End -->

     
        <!-- Blog Area Start -->
        <div class="blog-area pt-150 pb-150">
            <div class="container">
                <?php require_once('include/blog.php'); ?>
            </div>
        </div>
        <!-- Blog Area End -->
        <!-- Subscribe Start -->

        <!-- Subscribe End -->
        <!-- Footer Start -->
        <footer class="footer-area">
            <div class="main-footer">
                <div class="container">
                    <?php require_once('include/footer.php'); ?>
                </div>
            </div>   
            <div class="footer-bottom text-center">
                <div class="container">
                        <?php require_once('include/copy-right.php'); ?>
                </div>    
            </div>
        </footer>
        <!-- Footer End -->

        <script src="assets/js/vendor/jquery-1.12.0.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <script src="assets/js/jquery.meanmenu.js"></script>
        <script src="assets/js/jquery.magnific-popup.js"></script>
        <script src="assets/js/ajax-mail.js"></script>
        <script src="assets/js/owl.carousel.min.js"></script>
        <script src="assets/js/jquery.mb.YTPlayer.js"></script>
        <script src="assets/js/jquery.nicescroll.min.js"></script>
        <script src="assets/js/plugins.js"></script>
        <script src="assets/js/main.js"></script>
    </body>
</html>
