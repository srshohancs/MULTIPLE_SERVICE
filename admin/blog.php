<?php include "inc/header.php"; ?>  

	<!-- content-wrapper Start -->
	<div class="content-wrapper">
		<div class="content-header">
			<div class="container-fluid">
				<div class="row mb-2">
					<div class="col-sm-6">
						<h1 class="m-0">Blog's Management</h1>
					</div>
					<div class="col-sm-6">
						<ol class="breadcrumb float-sm-right">
							<li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
							<li class="breadcrumb-item active">Blogs's Management</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<!-- Main content -->
		<section class="content">
			<div class="container-fluid">
				<div class="row">
					<div class="col-12 col-sm-12 col-md-12">
						<?php  

							// Ternary Condition
							$do = isset($_GET['do']) ? $_GET['do'] : "Manage";
							
							
							// Manage Page Start
							// All Users Manage Page
							if ( $do == "Manage" ) { ?>

								<!-- Card Stat -->
								<div class="card">
					              <div class="card-header">
					                <h3 class="card-title">Manage all Blog</h3>
					                <div class="card-tools">
					                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
					                </div>
					              </div>
					              <div class="card-body">
					                
					              	<!-- Table Start -->
					              	<table id="dataSearch" class="table table-dark table-striped table-hover table-bordered">
<thead>
	<tr>
	  <th scope="col">#Sl.</th>
	  <th scope="col">Image</th>
	  <th scope="col">Title</th>
	  <!-- <th scope="col">Blog Description</th>	      -->
	  <th scope="col">Status</th>	
	  <th scope="col">Date</th>	
	  <th scope="col">Action</th>
	</tr>
</thead>

									  <tbody>
									  	<?php  
									  		$sql = "SELECT * FROM blogs ORDER BY blog_title ASC";
									  		$allData = mysqli_query($db, $sql);

									  		$numOfBlogs = mysqli_num_rows($allData);

									  		if ($numOfBlogs == 0) { ?>
									  			<div class="alert alert-info" role="alert">
													<i class="fa-solid fa-bell"> </i> Ooops!! No Blog found in our Bloging aplication. Please make a blog first.
													</div>
									  		<?php }
									  		else {
									  			$i = 0;

												while( $row = mysqli_fetch_assoc($allData) ) {
													$blog_id   			= $row['blog_id'];
													$image  			= $row['image'];
													$blog_title  		= $row['blog_title'];
													$blog_text  		= $row['blog_text'];
													$status  			= $row['status'];
													$join_date  		= $row['join_date'];
													$i++;
													?>
									  			<tr>
											      <th scope="row"><?php echo $i; ?></th>
<td>
	<?php
		if (!empty($image)) { ?>
			<img src="dist/img/books/<?php echo $image; ?>" alt="" width="55">
		<?php }
		else { ?>
			<img src="dist/img/books/blank_book.jpg" alt="" width="55">
		<?php }
	?>											      		
</td>
											      <td><?php echo $blog_title; ?></td>
											      
											      <td>
											      	<?php
											      		if( $status == 1 ) { ?>
											      			<span class="badge badge-success">Active</span>
											      		<?php }
											      		else if ( $status == 2 ) { ?>
											      			<span class="badge badge-danger">InActive</span>
											      		<?php }
											      	?>	
											      </td>
											      	 <td><?php echo $join_date; ?></td>
											      <td>
	<div class="action-btn">
	    <ul>
	      <li>
	        <a href="blog.php?do=Edit&ubook=<?php echo $blog_id; ?>"><i class="fa-regular fa-pen-to-square"></i></a>
	      </li>
	      <li>
	        <a href="" data-toggle="modal" data-target="#delbook<?php echo $blog_id; ?>"><i class="fa-solid fa-trash-can"></i></a>
	      </li>
	    </ul>
	</div>
	</td>

	<!-- Modal Start -->
	<!-- Modal -->
<div class="modal fade" id="delbook<?php echo $blog_id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirm to delete this <?php echo $blog_title; ?> Book </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="modal-btn">
	        	<ul>
	        		<li>
	        			<a href="blog.php?do=Delete&delbook_id=<?php echo $blog_id; ?>" class="btn btn-danger">Confirm <i class="fa-regular fa-trash-can"></i></a>
	        		</li>
	        		<li>
	        			<a href="" class="btn btn-success" data-dismiss="modal">Cancel <i class="fa-regular fa-circle-xmark"></i></a>
	        		</li>	        		
	        	</ul>
	        </div>
      </div>
    </div>
  </div>
</div>
	<!-- Modal End -->
											    </tr>
									  		<?php }
									  		}

									  		
									  	?>
									    
									    
									  </tbody>
									</table>
					              	<!-- Table End -->

					              </div>
					            </div>
								<!-- Card End -->

							<?php }
							// Manage Page End



							// Create Page Start
							// This is the Create new users Html Page
							else if ( $do == "Add" ) { ?>
								<!-- Card Stat -->
								<div class="card">
		              <div class="card-header">
		                <h3 class="card-title">Add New Blog</h3>
		                <div class="card-tools">
		                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		              </div>
		              <div class="card-body">
										<form action="blog.php?do=Store" method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label>Blog Title</label>					                	
														<input type="text" name="blog_title" class="form-control" placeholder="Title of the book..." required autocomplete="off">
													</div> 

													<div class="form-group">
														<label>Blog Description</label>		
														<textarea id="description" name="blog_text" class="form-control"></textarea>	
													</div>	 	
												</div>

												<div class="col-lg-6">
													<div class="form-group">
														<label>Status</label>
														<select name="status" class="form-control">
															<option value="1">Please Select User Role</option>
															<option value="1">Active</option>
															<option value="2">InActive</option>
														</select>
													</div> 						        	

													<div class="form-group">
														<label>Thumbnail Picture</label>
														<input type="file" name="image" class="form-control-file">
													</div>

										        	<div class="form-group">
										        		<input type="submit" name="addBook" class="btn btn-success btn-block" value="Register the Book">
										        	</div>
												</div>
											</div>
										</form>
		              </div>
		            </div>
								<!-- Card End -->
							<?php }
							// Create Page End


							
							// Store page start
							// This store page will store the new users data into the Database
							else if ( $do == "Store" ) {
if (isset($_POST['addBook'])) {
	$blog_title  		= mysqli_real_escape_string($db, $_POST['blog_title']);
	$blog_text  		= mysqli_real_escape_string($db, $_POST['blog_text']);
	$status  			= $_POST['status'];
	
	$image 				= $_FILES['image']['name'];
	$image_temp     	= $_FILES['image']['tmp_name'];

	if ( !empty($image) ) {
			$image_name		= rand(1, 999999999) ."_". $image;
			move_uploaded_file($image_temp, "dist/img/books/$image_name");


			$sql = "INSERT INTO blogs ( image, blog_title, blog_text, status, join_date ) VALUES ('$image_name', '$blog_title', '$blog_text', '$status', now())";
			$registerBook = mysqli_query($db, $sql);

			if ( $registerBook ) {
				header("Location: blog.php?do=Manage");
			}
			else {
				die("mysqli Error" . mysqli_error($db));
			}
	}
	else{
		$sql = "INSERT INTO blogs ( blog_title, blog_text, status, join_date ) VALUES ('$blog_title', '$blog_text', '$status', now())";
			$registerBook = mysqli_query($db, $sql);

			if ( $registerBook ) {
				header("Location: blog.php?do=Manage");
			}
			else {
				die("mysqli Error" . mysqli_error($db));
			}
	}
											


}
							}
							// Store page End



							// Edit page start
							// This edit page will show the update users info in a html file
							else if ( $do == "Edit" ) { 
								if (isset($_GET['ubook'])) {
									$updateId = $_GET['ubook'];

									$sql = "SELECT * FROM blogs WHERE blog_id = '$updateId' ORDER BY blog_title ASC ";
									$bookData = mysqli_query($db, $sql);

									while ($row = mysqli_fetch_assoc($bookData)) {
										$blog_id   			= $row['blog_id'];
										$image  			= $row['image'];
										$blog_title  		= $row['blog_title'];
										$blog_text  		= $row['blog_text'];
										$status  			= $row['status'];
										$join_date  		= $row['join_date'];
						  			
						  			?>
						  			<!-- Card Stat -->
								<div class="card">
		              <div class="card-header">
		                <h3 class="card-title">Update <?php echo $blog_title; ?> Book Information</h3>
		                <div class="card-tools">
		                  	<button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
		                </div>
		              </div>
		              <div class="card-body">
										<form action="blog.php?do=Update" method="POST" enctype="multipart/form-data">
											<div class="row">
												<div class="col-lg-6">
													<div class="form-group">
														<label>Blog Title</label>					                	
														<input type="text" name="blog_title" class="form-control" placeholder="Title of the book..." required autocomplete="off" value="<?php echo $blog_title; ?>">
													</div> 

													<div class="form-group">
														<label>Blog Description</label>		
														<textarea id="description" name="blog_text" class="form-control"><?php echo $blog_text; ?></textarea>	
													</div>	 	  	
												</div>

												<div class="col-lg-6">
<div class="form-group">
	<label>Status</label>
	<select name="status" class="form-control">
		<option value="1">Please Select User Role</option>
		<option value="1" <?php if ( $status == 1 ) {echo 'selected'; } ?>>Active</option>
		<option value="2" <?php if ( $status == 2 ) {echo 'selected'; } ?>>InActive</option>
	</select>
</div> 																									        	

<div class="form-group">
	<label>Thumbnail Picture</label>
	<br>
	<?php
  		if (!empty($image)) { ?>
  			<img src="dist/img/books/<?php echo $image; ?>" alt="" width="60">
  		<?php }
  		else { ?>
  			<p>No Picture Uploaded!</p>
  		<?php }
  	?>	
	<input type="file" name="image" class="form-control-file pt-2">
</div>

<div class="form-group">
	<input type="hidden" name="blog_id" value="<?php echo $blog_id; ?>">
	<input type="submit" name="updateBook" class="btn btn-success btn-block" value="Update Book info">
</div>
												</div>
											</div>
										</form>
		              </div>
		            </div>
								<!-- Card End -->
									<?php }
								}
							}
							// Edit page end



							// Update page start
							// This Update page will Update the users existing data info in a html file
							else if ( $do == "Update" ) {
								if (isset($_POST['blog_id'])) {
	$blog_id  			= $_POST['blog_id'];
	$blog_title  		= mysqli_real_escape_string($db, $_POST['blog_title']);
	$blog_text  		= mysqli_real_escape_string($db, $_POST['blog_text']);
	$status  			= $_POST['status'];
	
	
	$image 				= $_FILES['image']['name'];
	$image_temp     	= $_FILES['image']['tmp_name'];

									// 
									// Both for Password and Picture with all data change
									if( !empty($image) ){ //Manea ei 2 tay data acea

										// Delete if image already exists
										$query = "SELECT * FROM blogs WHERE blog_id = '$blog_id'";
										$oldImage = mysqli_query($db, $query);

										while ($row = mysqli_fetch_assoc($oldImage)) {
											$existingImage = $row['image'];
											unlink("dist/img/books/$image_name" . $existingImage);
										}

										// Upload New Image
										$image_name		= rand(1, 999999999) ."_". $image;
										move_uploaded_file($image_temp, "dist/img/books/$image_name");

$sql = "UPDATE blogs SET image='$image_name', blog_title='$blog_title', blog_text='$blog_text',
 status='$status' WHERE blog_id = '$blog_id' ";

	$updateBook = mysqli_query($db, $sql);

											if ( $updateBook ) {
												header("Location: blog.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}

									// Only Chnge the Data
									else if ( empty($image) ) {

$sql = "UPDATE blogs SET blog_title='$blog_title', blog_text='$blog_text', status='$status'  WHERE blog_id = '$blog_id' ";

											$updateBook = mysqli_query($db, $sql);

											if ( $updateBook ) {
												header("Location: blog.php?do=Manage");
											}
											else {
												die("mysqli Error" . mysqli_error($db));
											}
									}
									// 
								}
							}
							// Update page end



							// Delete page start
							// We will delete the users from Database
							else if ( $do == "Delete" ) {
								if (isset($_GET['delbook_id'])) {
									$deleteBookId = $_GET['delbook_id'];
									$sql = "DELETE FROM blogs WHERE blog_id = '$deleteBookId'";
									$deleteBook = mysqli_query( $db, $sql );

									if ( $deleteBook ) {
										header( "Location: blog.php?do=Manage" );
									}
									else {
										die("MySql Error!" . mysqli_error($db));
									}
								}
							}
							// Delete page end

						?>
					</div>
				</div>
			</div>
		</section>
	</div>
	<!-- content-wrapper End -->

<?php include "inc/footer.php"; ?>