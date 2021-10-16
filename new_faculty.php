<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="index.php?page=new_faculty" method="post" id="manage-project">

            <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="control-label">Faculty Name</label>
                        <input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>
                </div>

                <?php if($_SESSION['login_type'] == 1 ): ?>
            <div class="col-md-6">
                <div class="form-group">
                <label for="" class="control-label">Faculty Dean</label>
                <select class="form-control form-control-sm select2" name="dean">
                    <option></option>
                    <?php 
                    $managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 2 order by concat(firstname,' ',lastname) asc ");
                    while($row= $managers->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['name'] ?>" <?php echo isset($manager_id) && $manager_id == $row['name'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                    <?php endwhile; ?>
                </select>
                </div>
                <div class="form-group">
                <label for="" class="control-label">Faculty Head of Department</label>
                <select class="form-control form-control-sm select2" name="hod">
                    <option></option>
                    <?php 
                    $managers = $conn->query("SELECT *,concat(firstname,' ',lastname) as name FROM users where type = 3 order by concat(firstname,' ',lastname) asc ");
                    while($row= $managers->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['name'] ?>" <?php echo isset($manager_id) && $manager_id == $row['name'] ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                    <?php endwhile; ?>
                </select>
                </div>
            </div>
                <?php else: ?>
                    <input type="hidden" name="manager_id" value="<?php echo $_SESSION['login_id'] ?>">
                <?php endif; ?>
            
            </div>
		
        </form>
    	</div>
    	<div class="card-footer border-top border-info">
    		<div class="d-flex w-100 justify-content-center align-items-center">
    			<button class="btn btn-flat  bg-gradient-primary mx-2" name="save" form="manage-project">Save</button>
    			<button class="btn btn-flat bg-gradient-secondary mx-2" type="button" onclick="location.href='index.php?page=project_list'">Cancel</button>
    		</div>
    	</div>
	</div>
</div>
<script>
    /*
	$('#manage-project').submit(function(e){
		e.preventDefault()
		start_load()
		$.ajax({
			url:'ajax.php?action=save_project',
			data: new FormData($(this)[0]),
		    cache: false,
		    contentType: false,
		    processData: false,
		    method: 'POST',
		    type: 'POST',
			success:function(resp){
				if(resp == 1){
					alert_toast('Data successfully saved',"success");
					setTimeout(function(){
						location.href = 'index.php?page=faculty_list'
					},2000)
				}
			}
		})
	})
    */
</script>

<?php

if(isset($_POST['save'])){



	$name = $_POST['name'];
	$dean = $_POST['dean'];
	$hod = $_POST['hod'];
	$date_created = date("Y-m-d")." ".date("h:m:s");

	$sql="INSERT INTO `faculty_list`(`name`, `dean`, `hod`, `date_created`)
	VALUES ('$name','$dean','$hod','$date_created')";

    // Make a refresh request here
	if (mysqli_query($conn, $sql)) {
		echo "<script>";
        echo "alert('Faculty created successfully');";
		echo 'window.location.href = "index.php?page=faculty_list";';
		echo "</script>";
        } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		echo "<script>";
        echo "alert('Faculty not created')";
		echo "</script>";
        }	
	}

?>