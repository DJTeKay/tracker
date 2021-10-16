<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
            <?php if($_SESSION['login_type'] != 3): ?>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_project"><i class="fa fa-plus"></i> Add New project</a>
			</div>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
							<col width="5%">
							<col width="20%">
							<col width="15%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
							<col width="10%">
				</colgroup>
				<thead>
					<tr>
							<th>#</th>
							<th>Project Name</th>
							<th>Faculty</th>
							<th>Supervisor</th>
							<th>Student</th>
							<th>Starting Date</th>
							<th>Ending Date</th>
							<th>Status</th>
							<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					if($_SESSION['login_type'] == 2){
						$where = " where manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}
					$qry = $conn->query("SELECT * FROM `project_list` ORDER BY `project_list`.`project_name` ASC");
			
					while($row= $qry->fetch_assoc()):
	
					?>
					<tr>
					<td class="text-center"><?php echo $i++ ?></td>

					<td class=""><b><?php echo ucwords($row['project_name']) ?></b></td>
					<td class=""><p><?php echo ucwords($row['faculty']) ?></p></td>

					<td class="text-center"><?php echo ucwords($row['supervisor']) ?></td>
					<td class=""><b><?php echo ucwords($row['student']) ?></b></td>

					<td class=""><b><?php echo ucwords($row['start_date']) ?></b></td>									

					<td class=""><b><?php echo ucwords($row['end_date']) ?></b></td>									

					<td class=""><b><?php echo ucwords($row['status']) ?></b></td>

						<td class="text-center">

							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_project" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <?php if($_SESSION['login_type'] != 3): ?>
		                      <a class="dropdown-item" href="./index.php?page=edit_project&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
							  <form action= "index.php?page=project_list"method="post" >
							  
							  <?php echo"<button class='dropdown-item delete_project'  href='javascript:void(0)'
							   name= 'del".$i."s' >Delete </button>"; ?>  
							</form>
							  <?php endif; ?>					  

								<?php

								if(isset($_POST['del'.$i.'s'])){

									echo $id;

									$idd = $row['id'];
									
									$sql="DELETE FROM project_list where id = $idd";
								
									if (mysqli_query($conn, $sql)) {
									echo '<script>';
									echo'alert("Data successfully delete");';									
									echo 'window.location.href = "index.php?page=project_list";';
									echo '</script>';
									}else{
										
									echo '<script>';
									echo'alert("Data not delete");';
									echo '</script>';
									}
								}
								?>

		                    </div>
						</td>
					</tr>	
				<?php endwhile; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<style>
	table p{
		margin: unset !important;
	}
	table td{
		vertical-align: middle !important
	}
</style>
