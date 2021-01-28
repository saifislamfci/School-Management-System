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
                <?php 
              $pageName = explode('.', basename($_SERVER['PHP_SELF']));
              echo $pageName = ucwords(str_replace('-', ' ', $pageName[0]));
                ?>          
              </h1>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
        <div class="row">
          <div class="col-md-12">
          <div class="card border-left-primary shadow h-100 py-2">
              <?php 
               if( isset($_POST['submit']) && $_POST['submit'] == 'Add New Banner') {

                  $banner_title        = $_POST['banner_title'];              
                  $banner_description  = $_POST['banner_description'];
                  $banner_image        = $_FILES['banner_image']['name'];
                  $banner_image_tmp    = $_FILES['banner_image']['tmp_name'];
                  $banner_btn_name     = $_POST['banner_btn_name'];
                  $banner_btn_url      = $_POST['banner_btn_url'];

                  $data = [
                     [
                        'field_name'   => 'banner_title',
                        'required'     => true,   
                        'min'          => 2,
                        'max'          => 50                      
                     ],                      
                     [
                        'field_name'   => 'banner_description',
                        'required'     => true
                     ],
                     [
                        'field_name'   => 'banner_image',
                        'type'         => 'file',
                        'required'     => true
                     ],
                     [
                        'field_name'   => 'banner_btn_name',
                        'required'     => true
                     ],
                     [
                        'field_name'   => 'banner_btn_url',
                        'required'     => true
                     ],                   
                  ];
                  Validation::validate($data);
                  if(Validation::$hasError === false ) {
                     
                     $banner = new Banner;                    
                     $explode = explode('.', $_FILES['banner_image']['name']);  
                     $extension = strtolower(end($explode));
                     $new_banner_image = rand(1000, 9000).'.'.$extension; 
                     if($banner->addBanner('banners', ['banner_title', 'banner_description', 'banner_image', 'banner_btn_url', 'banner_btn_name'], [$banner_title, $banner_description, $new_banner_image, $banner_btn_url, $banner_btn_name])) {                       
                        move_uploaded_file($banner_image_tmp, 'admin-assets/img/banners/'.$new_banner_image);  
                         echo "<div class='alert alert-success'>Successfully Added a new banner</div>";
                     } else {
                        echo "<div class='alert alert-danger'>Something wen't wrong</div>";
                     }
                  }  
              }            
               ?>
            <div class="card-body">
               <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data">
               <table class="table">
                  <tr>
                     <td><input type="text" name="banner_title" placeholder="Banner Title" class="form-control"></td>
                  </tr>
                  <tr>
                     <td><textarea name="banner_description" rows="5" placeholder="Banner Description" class="form-control"></textarea></td>
                  </tr>
                  <tr>
                     <td><input type="file" name="banner_image"></td>
                  </tr>
                  <tr>
                     <td><input type="text" name="banner_btn_name" placeholder="Banner Button Name" class="form-control"></td>
                  </tr>
                  <tr>
                     <td><input type="text" name="banner_btn_url" placeholder="Banner Button URL" class="form-control"></td>
                  </tr>
                  <tr>
                     <td><input type="submit" name="submit" value="Add New Banner" class="btn btn-primary"></td>
                  </tr>
               </table>b
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