<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="index.php?page=new_task" method="post" id="manage-project">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label">Choose Activity</label>
					<select class="form-control form-control-sm select2" name="activity">                    
                    <option value="noneSelected">--none---</option>
                    <option value="assign">Assignment</option>                    
                    <option value="act">Class Activity</option>                    
                    <option value="act">Class Exercice</option>
                    </select>
				</div>
			</div>

			<div class="col-md-6">
                <div class="form-group">
                <label for="" class="control-label">Start Date</label>
                <input type="date" class="form-control form-control-sm" autocomplete="off" name="start_date" value="<?php echo isset($start_date) ? date("Y-m-d",strtotime($start_date)) : '' ?>">
                </div>
            </div>

		</div>

		<div class="row">

            <?php if($_SESSION['login_type'] == 1 ): ?>

            <div class="col-md-6">
                <div class="form-group">
                <label for="" class="control-label">Lecturer</label>
                <select class="form-control form-control-sm select2" name="manager_id">
                    <option></option>
                    <?php 
                    $managers = $conn->query("SELECT * FROM users where type = 4 order by lastname asc ");
                    while($row= $managers->fetch_assoc()):
                    ?>
                    <option value="<?php echo $row['email'] ?>" <?php echo isset($manager_id) && $manager_id == $row['email'] ? "selected" : '' ?>><?php echo ucwords($row['email']) ?></option>
                    <?php endwhile; ?>
                </select>
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                <label for="" class="control-label">End Date</label>
                <input type="date" class="form-control form-control-sm" autocomplete="off" name="end_date" value="<?php echo isset($end_date) ? date("Y-m-d",strtotime($end_date)) : '' ?>">
                </div>
              </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                    <div class="form-group">
                        <label for="" class="control-label"> Students </label>
                        <select class="form-control form-control-sm select2" multiple="multiple" name="user_ids[]">
                            <?php 
                            $students = $conn->query("SELECT * FROM users where type = 5 order by lastname asc ");
                            while($row= $students->fetch_assoc()):
                            ?>
                            <option value="<?php $lname = $row['email'];  echo $lname ?>" <?php echo isset($user_ids) && in_array($row['email'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['email']) ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
            </div>
            
            <div class="col-md-6">
                    <div class="file_upload">
                        <form action="/action_page.php">
                        <input type="file"  accept="image/*"  class="custom-file-input" id="customFile" name="img" onchange="displayImg(this,$(this))">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                        </form>
                    </div>
            </div>

        </div>
        <div class="row">

            <div class="col-md-6">
                <div class="form-group">
                <label for="" class="control-label">Faculty</label>
                <select class="form-control form-control-sm select2" name="faculty">
                    <option></option>
                    <?php 
                        $students = $conn->query("SELECT * FROM faculty_list  ");
                        while($row= $students->fetch_assoc()):
                        ?>
                        <option value="<?php $lname = $row['name'];  echo $lname ?>" <?php echo isset($user_ids) && in_array($row['name'],explode(',',$user_ids)) ? "selected" : '' ?>><?php echo ucwords($row['name']) ?></option>
                        <?php endwhile; ?>
                    </select>
                    </div>
                </div>
            </div>

            
        </div>  
            <?php else: ?>
                <input type="hidden" name="manager" value="<?php echo $_SESSION['login_id'] ?>">
            <?php endif; ?>

		      
        


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

<?php

if(isset($_POST['save'])){

    $img = $_FILES['file'];
	$fileName = $_FILES['file']['name'];
	$fileLocation = $_FILES['file']['tmp_name'];
	$fileDestination = "Files/".$fileName;
	move_uploaded_file($fileLocation,$fileDestination);
	$targetfolder = "Files/p".date("Ymd").date("hisa").".jpg";
	rename( $fileDestination,$pic ) ;
    
    $name = $_POST['activity'];
    $manager = $_POST['manager_id'];
    $date_created = date("Y-m-d")." ".date("h:m:s");
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    foreach ($_POST['user_ids'] as $student)
    {     
    
            
    $sql="INSERT INTO `task_list`(`activity_name`, `lecture`,`student`,`status`,`date_created`,  `start_date`, `end_date`, `file`) 
    VALUES ('$name','$manager','$student','Pending','$date_created','$start_date','$end_date','$targetfolder')"; 

        // Make a refresh request here
        if (mysqli_query($conn, $sql)) {
                echo "<script>";
                echo "alert('Task created successfully');";
                echo 'window.location.href = "index.php?page=task_list";';
                echo "</script>";
                
        } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                echo "<script>";
                echo "alert('Task not created')";
                echo "</script>";
        }

    }	
	 
}

?>