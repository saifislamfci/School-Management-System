<?php require_once('include/header.php'); ?>
<?php require_once('include/slider.php');?>
<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">
        <?php require_once('include/topbar.php');?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">      
              </h1>
          </div>
        <div class="row">
          <div class="col-md-12">
          <div class="card  shadow h-100 py-2">
            <div class="card-body">
               <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" id="ajax_id">
              <div class="result"></div>
               <table class="table">
                  <tr>
                     <td><input type="text" name="page_title" placeholder="Page Title" class="form-control" value=""></td>
                  </tr>
                  <tr>
                     <td><textarea name="page_description" id="summernote" rows="10" placeholder="Page Description" class="form-control"></textarea></td>
                  </tr>
                  <tr>
                     <td><input type="file" name="page_image"></td>
                  </tr>                 
                  <tr>
                     <td><input type="submit" name="submit" value="add to Blog" class="btn btn-primary"></td>
                     <td><input type="hidden" name="form_data" value="add to Blog"></td>
                  </tr>
               </table>
            </form>
            </div>
         </div>
         </div>
        </div>
      </div>
      </div>
      <?php require_once('include/footer.php'); ?>
      </div>
<?php require_once('include/scroll.php'); ?>
<?php require_once('include/logout-model.php'); ?>
<?php require_once('include/js.php');?>

</body>
</html>