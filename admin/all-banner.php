<?php 
require_once('include/header.php');
require_once('include/slider.php'); 

    $banner 	= new Banner;
    $banner->getBanner(['*'], 'banners');
    $query 		= $banner->query;
    $numRows 	= $query->num_rows;
?>
<div class="container-fluid">   
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Banner (<?php echo $numRows; ?>)</h1>           
   </div>
     
   <div class="row">       
      <div class="col-md-12">
         <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">            
             	<table class="table">             		
             		<tbody>
             			<tr>
             				<th>Id</th>
             				<th>Title</th>
             				<th>Description</th>
             				<th>Image</th>
             				<th>Button Name</th>
             				<th>URL</th>
             				<th>Status</th>
             				<th>Action</th>
             			</tr>    
             			<?php 
             			while ( $row = $query->fetch_assoc()) {
             				$banner_id 			= $row['banner_id'];
             				$banner_title 		= $row['banner_title'];
             				$banner_description = $row['banner_description'];
             				$banner_image 		= $row['banner_image'];
             				$banner_btn_name 	= $row['banner_btn_name'];
             				$banner_btn_url 	= $row['banner_btn_url'];
             				$status 			= $row['status']; 
             				if($status == 1) {
             					$status = 'Active';
             				} elseif( $status == 2) {
             					$status = 'In-active';
             				}	
             			?>         			
             			<tr> 
             				<td><?php echo $banner_id; ?></td>
             				<td><?php echo $banner_title; ?></td>
             				<td><?php echo $banner_description ?></td>
             				<td><?php echo "<img src='admin-assets/img/banners/$banner_image' width='50' class='img-responsive'/>"; ?></td>
             				<td><?php echo $banner_btn_url; ?></td>
             				<td><?php echo $banner_btn_name; ?></td>
             				<td><?php echo $status; ?></td>
             				<td><a href="edit.php?id=<?php echo $banner_id; ?>&type=banner">Edit</a> | <a href="delete.php?id=<?php echo $banner_id; ?>&type=banner">Delete</a></td>
             			</tr>
             			<?php } ?>
             		</tbody>
             	</table>
            </div>
         </div>
      </div>
   </div>
   <?php require_once('include/footer.php'); ?>  
</div>

   

<!-- Footer -->

<?php
require_once('include/scroll.php'); 
require_once('include/logout-model.php'); 
require_once('include/js.php');?>
