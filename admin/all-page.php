<?php 
require_once('include/header.php');
require_once('include/slider.php'); 

    $page 	= new Page;
    $page->getPage(['*'], 'pages');
    $query 		= $page->query;
    $numRows 	= $query->num_rows;
?>
<div class="container-fluid">   
   <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0 text-gray-800">All Page (<?php echo $numRows; ?>)</h1>           
   </div>
     
   <div class="row">       
      <div class="col-md-12">
         <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">            
             	<table class="table">             		
             		<tbody>
             			<tr>
             				<th>Id</th>
             				<th>page Title</th>
             				<th>Page Description</th>
             				<th>Image</th>
             				<th>Status</th>
             			</tr>    
             			<?php
                        $i=0;
             			while ( $row = $query->fetch_assoc()) {
                            $i++;
             				$Page_id 			= $row['page_id'];
             				$page_title 		= $row['page_title'];
             				$page_description   = $row['page_description'];
             				$page_image 		= $row['page_image'];
             				$status 			= $row['status']; 
             				if($status == 1) {
             					$status = 'Active';
             				} elseif( $status == 0) {
             					$status = 'In-active';
             				}	
             			?>         			
             			<tr> 
             				<td><?php echo $i ?></td>
             				<td><?php echo $page_title; ?></td>
             				<td><?php echo $page_description ?></td>
             				<td><?php echo "<img src='admin-assets/img/Page/$page_image' width='50' class='img-responsive'/>"; ?></td>
             				<td><?php echo $status; ?></td>
             				<td><a href="edit.php?id=<?php echo $Page_id; ?>&type=page">Edit</a> | <a href="delete.php?id=<?php echo $Page_id; ?>&type=page">Delete</a></td>
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
