<?php require_once('include/header.php'); ?>
 <?php require_once('include/slider.php');?>
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <?php require_once('include/topbar.php');?>
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">
              <?php
              $type=isset($_GET['type'])?(string)$_GET['type']:null;
              $id=isset($_GET['id'])?(int)$_GET['id']:null; 
               ?>
                <?php 
                   $pageName = explode('.', basename($_SERVER['PHP_SELF']));
                  $pageName = ucwords(str_replace('-', ' ', $pageName[0]));
                  $pagetype=ucfirst($type);
                  echo $pageName.' '.$pagetype;
                ?>          
              </h1>
              <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
          </div>
        <div class="row">
          <div class="col-md-12">
          <div class="card border-left-primary shadow h-100 py-2">
               <?php
               if (isset($type) && $type== 'banner') {           
                $banner   = new Banner;
                $banner->getBanner(['*'], 'banners',['banner_id','=',$id]);
                $query=$banner->query;
                $row=$query->fetch_assoc();
                $banner_title=$row['banner_title'];
                $banner_description=$row['banner_description'];
                $banner_image=$row['banner_image'];
                $banner_btn=$row['banner_btn_name'];
                $banner_url=$row['banner_btn_url'];
                $db_status=$row['status'];
               ?>
              <?php
               if( isset($_POST['submit']) && $_POST['submit'] == 'Update Banner') {

                  $banner_title        = $_POST['banner_title'];              
                  $banner_description  = $_POST['banner_description'];
                  $banner_image        = $_FILES['banner_image']['name'];
                  $banner_image_tmp    = $_FILES['banner_image']['tmp_name'];
                  $banner_btn_name     = $_POST['banner_btn_name'];
                  $banner_btn_url      = $_POST['banner_btn_url'];
                  $banner_status       = $_POST['status'];

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

                     if (!empty($banner_image)) {                                                     
                     $explode = explode('.', $_FILES['banner_image']['name']);  
                     $extension = strtolower(end($explode));
                     $new_banner_image = rand(1000, 9000).'.'.$extension;
                     }
                     $data=array(
                      'banner_title'      => $banner_title,
                      'banner_description'=> $banner_description,
                      'banner_btn_name'   => $banner_btn_name,
                      'banner_btn_url'    => $banner_btn_url,
                      'status'            => $banner_status,
                     );
                     if (!empty($banner_image)) {
                      $data['banner_image'] = $new_banner_image;
                     }
                    
                     if($banner->updateBanner('banners', $data, ['banner_id', '=', $id])){
                    
                         if (!empty($banner_image)) {
                          move_uploaded_file($banner_image_tmp, 'admin-assets/img/banners/'.$new_banner_image);  
                        }
                    echo "<div class='alert alert-success'>Successfully updated the banner.</div>";
                    redirect('all-banner.php');
                   }
                 else {
                  echo "<div class='alert alert-danger'>Something wen't wrong</div>";
                  }
                }}
               ?>
            <div class="card-body">
               <form action="<?php echo htmlentities($_SERVER['PHP_SELF'])."?id=$id&type=banner";?>" method="POST" enctype="multipart/form-data" id="ajax_id">
               <table class="table">
                  <tr>
                     <td><input type="text" name="banner_title" placeholder="" class="form-control" value="<?php if(isset($banner_title)){echo $banner_title;}?>"></td>
                  </tr>
                  <tr>
                     <td><textarea name="banner_description" rows="5" placeholder="Banner Description" class="form-control text-justify ">
                       <?php if(isset($banner_description)){echo $banner_description;}?>
                     </textarea></td>
                  </tr>
                  <tr>
                     <td><input type="file" name="banner_image"> <br/>  <br/>
                     <img width="100" class="img-responsive" src="admin-assets/img/banners/<?php echo $banner_image; ?>" alt=""></td>
                    
                  </tr>
                  <tr>
                     <td><input type="text" name="banner_btn_name" placeholder="Banner Button Name" class="form-control" value="<?php if(isset($banner_btn)){echo $banner_btn;} ?>"></td>
                  </tr>
                  <tr>
                     <td><input type="text" name="banner_btn_url" placeholder="Banner Button URL" class="form-control" value="<?php if(isset($banner_url)){echo $banner_url;} ?>"></td>
                  </tr>
                  <tr>
                  <td>
                    <select name="status" class="form-control">
                      <option value="">--Choose Status--</option>
                      <option value="1" <?php if($db_status == 1 ) echo 'selected="selected"' ?>>Active</option> 
                      <option value="2" <?php if($db_status == 2 ) echo 'selected="selected"' ?>>In-active</option> 
                     </select> 
                  </td>
                </tr> 
                  <tr>
                     <td><input type="submit" name="submit" value="Update Banner" class="btn btn-primary"></td>
                  </tr>
               </table>
            </form>
          <?php }elseif (isset($type) && $type== 'page') {

                $page   = new Page;
                $page->getPage(['*'], 'pages',['page_id','=',$id]);
                $query=$page->query;
                $row=$query->fetch_assoc();
                $page_title=  $row['page_title'];
                $page_description= $row['page_description'];
                $page_image= $row['page_image'];
                $db_status=  $row['status'];
            ?>
            <form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" id="ajax_id" >
              <div class="result"></div>
               <table class="table">
                  <tr>
                     <td><input type="text" name="page_title" placeholder="Page Title" class="form-control" value="<?php if(isset($page_title)){echo $page_title;} ?>"></td>
                  </tr>
                  <tr>
                     <td><textarea name="page_description" id="summernote" rows="10" placeholder="Page Description" class="form-control"><?php if(isset($page_title)){echo $page_title;} ?></textarea></td>
                  </tr>
                  <tr>
                     <td><input type="file" name="page_image"> <br/>
                      <h6 class="text-danger font-weight-bold">Old Image</h6>
                     <img width="100" class="img-responsive" src="admin-assets/img/Page/<?php echo $page_image; ?>" alt="page Image"></td>
                  </tr>
                 <tr>
                  <td>
                    <select name="status" class="form-control">
                      <option value="">--Choose Status--</option>
                      <option value="1" <?php if($db_status == 1 ) echo 'selected="selected"' ?>>Active</option> 
                      <option value="0" <?php if($db_status == 0 ) echo 'selected="selected"' ?>>In-active</option> 
                     </select> 
                  </td>
                  </tr>                 
                  <tr>
                     <td><input type="submit" name="submit" value="Update to Blog" class="btn btn-primary"></td>
                     <td><input type="hidden" name="form_data" value="Update to Blog"></td>
                     <td><input type="hidden" name="page_img" value="<?php echo $page_image ?>"></td>
                     <td><input type="hidden" name="id" value="<?php echo $id ?>"></td>
                     <td><input type="hidden" name="type" value="<?php echo $type ?>"></td>
                  </tr>
               </table>
            </form>
          <?php }?>
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