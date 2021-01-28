<?php
require_once('config.php');
if ($_POST['form_data'] && $_POST['form_data'] == 'add to Blog') {
				  $page_title        = $_POST['page_title'];              
                  $page_description  = $_POST['page_description'];
                  $page_image        = $_FILES['page_image']['name'];
                  $page_image_tmp    = $_FILES['page_image']['tmp_name'];
                  $data = [
                     [
                        'field_name'   => 'page_title',
                        'required'     => true,   
                        'min'          => 2,
                        'max'          => 50                      
                     ],                      
                     [
                        'field_name'   => 'page_description',
                        'required'     => true,
                        'min'		   =>6,
                     ],
                     [
                        'field_name'   => 'page_image',
                        'type'         => 'file',
                        'required'     => true
                     ],
                               
                  ];
                  Validation::validate($data);
                  if(Validation::$hasError === false ) {
                     $page = new Page;                    
                     $explode = explode('.', $_FILES['page_image']['name']);  
                     $extension = strtolower(end($explode));
                     $new_page_image = rand(1000, 9000).'.'.$extension; 
                     if($page->addPage('pages', ['Page_title', 'page_description', 'page_image'], [$page_title, $page_description, $new_page_image])) {                       
                        move_uploaded_file($page_image_tmp, 'admin-assets/img/Page/'.$new_page_image);  
                         echo "<div class='alert alert-success'>Successfully Added a new Page</div>";
                         ?>
                         <script> 
					setTimeout(function() {
					location.href = "all-page.php";
				}, 3000);
			           </script>
                    <?php 
                    } else {
                        echo "<div class='alert alert-danger'>Something wen't wrong</div>";
                     }
                  }  
              }
		else if ($_POST['form_data'] && $_POST['form_data'] == 'Update to Blog')
		{
				  $type=isset($_POST['type'])?(string)$_POST['type']:null;
				  $id  =isset($_POST['id'])?(int)$_POST['id']:null;
				  $page_img  =isset($_POST['page_img'])?$_POST['page_img']:null;
          echo $page_img;

                  $page_title        = $_POST['page_title'];              
                  $page_description  = $_POST['page_description'];
                  $page_image        = $_FILES['page_image']['name'];
                  $page_image_tmp    = $_FILES['page_image']['tmp_name'];
                  $page_status       = $_POST['status'];

                  $data = [
                     [
                        'field_name'   => 'page_title',
                        'required'     => true,   
                        'min'          => 2,
                        'max'          => 50                      
                     ],                      
                     [
                        'field_name'   => 'page_description',
                        'required'     => true
                     ],
                     [
                        'field_name'   => 'page_image',
                        'type'         => 'file',
                        
                     ],
                  ];
                  Validation::validate($data);
                  if(Validation::$hasError === false ) {                    
                     $page = new Page;
                     if (!empty($page_image)) {                                                     
                     $explode = explode('.', $_FILES['page_image']['name']);  
                     $extension = strtolower(end($explode));
                     $new_page_image = rand(1000, 9000).'.'.$extension;
                     }
                     $data=array(
                      'page_title'      => $page_title,
                      'page_description'=> $page_description,
                      'status'            => $page_status,
                     );
                     if (!empty($page_image)) {
                      unlink('admin-assets/img/Page/'.$page_img);
                      $data['page_image'] = $new_page_image;
                     }
                     if($page->updatePage('pages', $data, ['page_id', '=', $id])){
                    
                         if (!empty($page_image)) {
                          move_uploaded_file($page_image_tmp, 'admin-assets/img/Page/'.$new_page_image);  
                        }
                    echo "<div class='alert alert-success'>Successfully updated the Page.</div>";
                   ?>
                 <script> 
					setTimeout(function() {
					location.href = "all-page.php";
				}, 3000);
			     </script>

                 <?php }else {
                  echo "<div class='alert alert-danger'>Something wen't wrong</div>";
                  }
                }} ?>

               