<?php require_once('include/header.php'); ?>
<?php require_once('include/slider.php');?>
<div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
        <?php
            $type=isset($_GET['type'])?(string)$_GET['type']:null;
            $id=isset($_GET['id'])?(int)$_GET['id']:null;
        ?>
      <div id="content">
        <?php require_once('include/topbar.php');?>
        <!-- Begin Page Content -->
        <div class="container-fluid">
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1>Delete <?php echo ucfirst($type);?></h1>
              <h1 class="h3 mb-0 text-gray-800">         
              </h1>
          </div>
        <div class="row">
          <div class="col-md-12">
          <div class="card shadow h-100 py-2">          
            <div class="card-body">
              <h3>Do You Detele this   <?php echo  ucfirst($type);?></h3>
          <?php
          if ($type == 'banner'){
            if (isset($_POST['submit']) && $_POST['submit']== 'Yes Delete it!') {
              $banner = new Banner;
              if($banner->deleteBanner('banners',['banner_id','=',$id])){
              echo "<div class='alert alert-success'>Successfully deleted</div>";
              redirect('all-banner.php', 2);
             }else
              {
               echo "<div class='alert alert-danger'>Somethign wen't wrong.</div>";
              }
            }
            }
            else if ($type == 'page') {
            if (isset($_POST['submit']) && $_POST['submit']== 'Yes Delete it!') {
              $Page = new Page;
              if($Page->deletePage('pages',['page_id','=',$id])){
              echo "<div class='alert alert-success'>Successfully deleted</div>";
              redirect('all-page.php', 2);
             }else
              {
               echo "<div class='alert alert-danger'>Somethign wen't wrong.</div>";
              }
            }
            }
           ?>


              <div class="row">
                 <div class="col-md-3">                  
                  <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])."?id=$id&type=$type" ?>" method="POST">
                  <table class="table">               
                    <tr>
                      <td><a href="all-<?php echo $type; ?>.php" class="btn btn-success" >NO</a></td>
                      <td><input type="submit" name="submit" value="Yes Delete it!" class="btn btn-danger"></td>
                    </tr>         
                    </table>
                  </form>
                </div>
               </div>
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