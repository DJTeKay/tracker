<div class="col-lg-12">
	<div class="card">
		<div class="card-body">
			<form action="index.php?page=new_user"   method="post" enctype="multipart/form-data" id="manage_user" >
				<input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
				
				<div class="row">

					<div class="col-md-6">
                		<div class="form-group">
							<label for="" class="control-label">First Name</label>
							<input type="text" name="firstname" class="form-control form-control-sm" required value="<?php echo isset($firstname) ? $firstname : '' ?>">
						</div>
					</div>
						
					<div class="col-md-6">
                		<div class="form-group">
							<label for="" class="control-label">Last Name</label>
							<input type="text" name="lastname" class="form-control form-control-sm" required value="<?php echo isset($lastname) ? $lastname : '' ?>">
						</div>
					</div>

				</div>

				<div class="row">

						<?php if($_SESSION['login_type'] == 1): ?>

					<div class="col-md-6 border-right">
							
						<div class="form-group" >								
							<label for="" class="control-label">User Role</label>
							<br />
							<input type="radio" onclick="adminClick()" name="type" value="1">
							Admin
							<input type="radio" onclick="deanClick()" name="type" value="2">
							Dean
							<input type="radio" onclick="hodClick()" name="type" value="3">
							HOD
							<input type="radio" onclick="staffClick()" name="type" value="4">
							Lecture
							<input type="radio" onclick="stdClick()" id="st" name="type" value="5">
							Student
						</div>
					</div>

					<div class="col-md-6 border-right">
						<div class="form-group" id="staff">
							<label for="" class="control-label">Staff Number</label>
							<input type="text"name="staff"  class="form-control form-control-sm"  >
						</div>				
					</div>

				</div>

				<div class="row" id="std">
						
					<div class="col-md-6 border-right" >

						<div class="form-group" >
							<label for="" class="control-label">Student Number</label>
							<input type="text"  name ="std"  class="form-control form-control-sm"  >
						</div>
					</div>

					<div class="col-md-6 border-right">

						<div class="form-group" >
							<label for="" class="control-label">Year of Study</label>
							<input type="text"  name ="yos"  class="form-control form-control-sm"  >
						</div>

					</div>
						
				</div>

				<div class="row">

					<div class="col-md-6 border-right">
						<div class="form-group">
							<label class="control-label">Email</label>
							<input type="email" class="form-control form-control-sm" name="email" required value="<?php echo isset($email) ? $email : '' ?>">
							<small id="#msg"></small>
						</div>
					</div>

					<div class="col-md-6 border-right">
						<div class="form-group">
							<label class="control-label">Password</label>
							<input type="password" class="form-control form-control-sm" name="password" <?php echo !isset($id) ? "required":'' ?>>
							<small><i><?php echo isset($id) ? "Leave this blank if you dont want to change you password":'' ?></i></small>
						</div>

						<div class="form-group">
							<label class="label control-label">Confirm Password</label>
							<input type="password" class="form-control form-control-sm" name="cpass" <?php echo !isset($id) ? 'required' : '' ?>>
							<small id="pass_match" data-status=''></small>
						</div>
					</div>

				</div>

				<div class="row">

					<div class="col-md-6 border-right">

						<div class="form-group" id="std">
							<?php else: ?>
							<input type="hidden" name="type" value="3">
							<?php endif; ?>
							<div class="form-group">
								<label for="" class="control-label">Profile Picture</label>
								<div class="custom-file">
									<input type="file"  accept="image/*"  class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
									<label class="custom-file-label" for="customFile">Choose file</label>
								</div>
							</div>
						</div>

						<div class="form-group d-flex justify-content-center align-items-center">
						<img src="<?php echo isset($avatar) ? 'assets/uploads/'.$avatar :'' ?>" alt="Avatar" id="cimg" class="img-fluid img-thumbnail ">
					</div>
				</div>					
				

				<div class="col-md-6 border-right">
							<div class="form-group" id="std">
								<button class="btn btn-primary mr-2" name="save_user">Save</button>

								<button class="btn btn-secondary" type="button" onclick="location.href = 'index.php?page=user_list'">Cancel</button>
							</div>
				</div>	
	

			</form>

		</div>

	</div>

</div>

<style>
	img#cimg{
		height: 15vh;
		width: 15vh;
		object-fit: cover;
		border-radius: 100% 100%;
	}
</style>
<script>
	$('[name="password"],[name="cpass"]').keyup(function(){
		var pass = $('[name="password"]').val()
		var cpass = $('[name="cpass"]').val()
		if(cpass == '' ||pass == ''){
			$('#pass_match').attr('data-status','')
		}else{
			if(cpass == pass){
				$('#pass_match').attr('data-status','1').html('<i class="text-success">Password Matched.</i>')
			}else{
				$('#pass_match').attr('data-status','2').html('<i class="text-danger">Password does not match.</i>')
			}
		}
	})
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) {
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result);
	        }

	        reader.readAsDataURL(input.files[0]);
	    }
	}
	/*	$('#manage_user').submit(function(e){
		e.preventDefault()
		$('input').removeClass("border-danger")
		start_load()
		$('#msg').html('')
		if($('[name="password"]').val() != '' && $('[name="cpass"]').val() != ''){
			if($('#pass_match').attr('data-status') != 1){
				if($("[name='password']").val() !=''){
					$('[name="password"],[name="cpass"]').addClass("border-danger")
					end_load()
					return false;
				}
			}
		}
		$.ajax({
			url:'ajax.php?action=save_user',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved.',"success");
					setTimeout(function(){
						location.replace('index.php?page=user_list')
					},750)
				}else if(resp == 2){
					$('#msg').html("<div class='alert alert-danger'>Email already exist.</div>");
					$('[name="email"]').addClass("border-danger")
					end_load()
				}
			}
		})
	})
*/
	
</script>
<script>
					document.getElementById("st").checked = true;					
					document.getElementById("staff").style.display = "none";
					document.getElementById("std").style.display = "block";
					document.getElementById("mySelect").selectedIndex = "4";

				function adminClick() {
				  document.getElementById("staff").style.display = "none";
				  document.getElementById("std").style.display = "none";
				  document.getElementById("mySelect").selectedIndex = "0";
				}
				
				function deanClick() {
				  document.getElementById("staff").style.display = "none";
				  document.getElementById("std").style.display = "none";
				  document.getElementById("mySelect").selectedIndex = "1";
				}

				function hodClick() {
				  document.getElementById("staff").style.display = "none";
				  document.getElementById("std").style.display = "none";
				  document.getElementById("mySelect").selectedIndex = "2";
				}

	
				function staffClick() {
					document.getElementById("std").style.display = "none";		  				  
					document.getElementById("staff").style.display = "block";					
					document.getElementById("mySelect").selectedIndex = "3";
				}
				
				function stdClick() {
				  document.getElementById("staff").style.display = "none";
				  document.getElementById("std").style.display = "block";
				  document.getElementById("mySelect").selectedIndex = "4";
				  }
</script>
<?php

if(isset($_POST['save_user'])){

	$img = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileLocation = $_FILES['file']['tmp_name'];
	$fileDestination = "Products/".$fileName;
	move_uploaded_file($fileLocation,$fileDestination);
	$pic = "Products/p".date("Ymd").date("hisa").".jpg";
	rename( $fileDestination,$pic ) ;

	$firstname = $_POST['firstname'];
	$lastname = $_POST['lastname'];
	$email = $_POST['email'];	
	$password = bin2hex($_POST['password']);
	$type = $_POST['type'];
	$date_created = date("Y-m-d")." ".date("h:m:s");




	$sql="INSERT INTO `users`(`firstname`, `lastname`, `email`, `password`, `type`, `avatar`, `date_created`) 
	VALUES ('$firstname','$lastname','$email','$password','$type','$pic','$date_created')";

	if (mysqli_query($conn, $sql)) {
		echo "<script>";
        echo "alert('User record created successfully');";
		echo 'window.location.href = "index.php?page=user_list";';
		echo "</script>";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		echo "<script>";
        echo "alert('User not created')";
		echo "</script>";
        }	
	}

	if($type=="5"){
		$std = $_POST['std'];
		$yof = $_POST['yos'];
		
		$sql="INSERT INTO `students`(`id`, `firstname`, `lastname`, `std_number`, `study_year`, `faculty`, `course`, `email`)
		VALUES ('$firstname','$lastname','$std','$yof','','','$email')";

		if (mysqli_query($conn, $sql)) {
			echo "<script>";
			echo "alert('User record created successfully');";
			echo 'window.location.href = "index.php?page=user_list";';
			echo "</script>";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
			echo "<script>";
			echo "alert('User not created')";
			echo "</script>";
		}	
		
	}
?>