<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
            <?php if($_SESSION['login_type'] != 3): ?>
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_faculty"><i class="fa fa-plus"></i> Add New faculty</a>
			</div>
            <?php endif; ?>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="30%">
					<col width="20%">
					<col width="20%">
					<col width="15%">					
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Faculty Name</th>
						<th>Faculty Dean</th>
						<th>Head of Department</th>
						<th>Date Created</th>
						<th></th>
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
					$qry = $conn->query("SELECT * FROM faculty_list order by name asc");
			
					while($row= $qry->fetch_assoc()):
	
					?>
					<tr>
						<th class="text-center"><?php echo $i++; ?></th>
						<td>
							<p><b><?php echo $row['name']; ?></b></p>
						</td>

						<td><b><?php  echo $row['dean']  ?></b></td>

						<td><b>
							<?php 
							echo $row['hod'];
							?>
						</b>
						</td>

						<td><b><?php echo $row['date_created'] ?></b></td>

						<td class="text-center">

							<button type="button" class="btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
		                      Action
		                    </button>
		                    <div class="dropdown-menu" style="">
		                      <a class="dropdown-item view_project" href="./index.php?page=view_faculty&id=<?php echo $row['id'] ?>" data-id="<?php echo $row['id'] ?>">View</a>
		                      <div class="dropdown-divider"></div>
		                      <?php if($_SESSION['login_type'] != 3): ?>
		                      <a class="dropdown-item" href="./index.php?page=edit_faculty&id=<?php echo $row['id'] ?>">Edit</a>
		                      <div class="dropdown-divider"></div>
							  <form action= "index.php?page=faculty_list"method="post" >
							  
							  <?php echo"<button class='dropdown-item delete_project'  href='javascript:void(0)'
							   name= 'del".$i."s' >Delete </button>"; ?>  
							</form>
							  <?php endif; ?>					  

								<?php

								if(isset($_POST['del'.$i.'s'])){

									echo $id;

									$idd = $row['id'];
									
									$sql="DELETE FROM faculty_list where id = $idd";
								
									if (mysqli_query($conn, $sql)) {
									echo '<script>';
									echo'alert("Data successfully delete");';									
									echo 'window.location.href = "index.php?page=faculty_list";';
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
