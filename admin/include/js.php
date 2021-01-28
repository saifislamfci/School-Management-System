  <script src="admin-assets/vendor/jquery/jquery.min.js"></script>
  <script src="admin-assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="admin-assets/vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="admin-assets/js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="admin-assets/vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="admin-assets/js/demo/chart-area-demo.js"></script>
  <script src="admin-assets/js/demo/chart-pie-demo.js"></script>
  <?php
  if($currentPage == 'add-page.php' || isset($_GET['type']) && $_GET['type'] == 'page') {   
    echo '<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">';
    echo '<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>';
  ?>
  <script> 
    $('#summernote').summernote({
      placeholder: 'Enter your description',
      height: 300
    });
  </script>
  <?php } ?>

  <script> 
    $("#ajax_id").submit(function(e) {
      e.preventDefault();     
      $.ajax({
        type : 'POST', 
        url : 'ajax.php',
        dataType : 'html',
        cache: false,
        contentType: false,
        processData: false,
        data: new FormData(this),
        success : function ( result ) {
       $('.result').html( result );
          }
      });
    });
  </script>