<?php if(!isset($conn)){ include 'db_connect.php'; } ?>

<div class="col-lg-12">
	<div class="card card-outline card-primary">
		<div class="card-body">
			<form action="index.php?page=new_project" method="post" id="manage-project">

        <input type="hidden" name="id" value="<?php echo isset($id) ? $id : '' ?>">

		<div class="row">

			<div class="col-md-6">
				<div class="form-group">
					<label for="" class="control-label"> Project Name</label>
					<input type="text" class="form-control form-control-sm" name="name" value="<?php echo isset($name) ? $name : '' ?>">
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

            <?php else: ?>
                <input type="hidden" name="manager" value="<?php echo $_SESSION['login_id'] ?>">
            <?php endif; ?>

		        

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

<?php

if(isset($_POST['save'])){
    
        $name = $_POST['name'];
        $manager = $_POST['manager_id'];
        $start_date = $_POST['start_date'];
        $end_date = $_POST['end_date'];
        $faculty = $_POST['faculty'];

    foreach ($_POST['user_ids'] as $student)
    {     
    
        

        $sql="INSERT INTO `project_list`(`project_name`, `faculty`, `status`, `start_date`, `end_date`, `Supervisor`, `Student`) 
		VALUES ('$name','$faculty','Pending','$start_date','$end_date','$manager','$student')"; 

        // Make a refresh request here
        if (mysqli_query($conn, $sql)) {
                echo "<script>";
                echo "alert('project created successfully');";
                echo 'window.location.href = "index.php?page=project_list";';
                echo "</script>";
                
        } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                echo "<script>";
                echo "alert('project not created')";
                echo "</script>";
        }

    }	
	 
}

?>