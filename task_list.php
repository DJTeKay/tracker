<?php include'db_connect.php' ?>
<div class="col-lg-12">
	<div class="card card-outline card-success">
		<div class="card-header">
			<div class="card-tools">
				<a class="btn btn-block btn-sm btn-default btn-flat border-primary" href="./index.php?page=new_task"><i class="fa fa-plus"></i> Add New Activity</a>
			</div>
		</div>
		<div class="card-body">
			<table class="table tabe-hover table-condensed" id="list">
				<colgroup>
					<col width="5%">
					<col width="15%">
					<col width="20%">
					<col width="15%">
					<col width="15%">
					<col width="10%">
					<col width="10%">
					<col width="10%">
				</colgroup>
				<thead>
					<tr>
						<th class="text-center">#</th>
						<th>Project</th>
						<th>Supervisor</th>
						<th>Student</th>
						<th>Project Started</th>
						<th>Project Due Date</th>
						<th>Project Status</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					$where = "";
					if($_SESSION['login_type'] == 2){
						$where = " where p.manager_id = '{$_SESSION['login_id']}' ";
					}elseif($_SESSION['login_type'] == 3){
						$where = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
					}


					
					$sql = "SELECT * FROM `task_list` ORDER BY `status` ASC";

					$result = mysqli_query($conn, $sql);

					$resultCheck = mysqli_num_rows($result);
					
						if ($resultCheck > 0){
							while($row = mysqli_fetch_array($result)){
						
							$_SESSION['prject_name'] = $row['activity_name'];
							$_SESSION['manager'] = $row['lecture'];	
							$_SESSION['student'] = $row['student'];
							$_SESSION['start'] = $row['start_date'];				
							$_SESSION['ends'] = $row['end_date'];
							$_SESSION['status'] = $row['status'];
							$_SESSION['date_created'] = $row['date_created'];
					
					


						echo"<tr>";

						echo'<td class="text-center">'. $i++.'</td>';

						echo"<td>";
						echo"<p><b>".ucwords($_SESSION['prject_name'])."</b></p>";
						echo"</td>";
						
						echo"<td>";
						echo"<p><b>".ucwords($_SESSION['manager'])."</b></p>";
						echo"</td>";

						echo"<td>";
						echo"<p><b> ".ucwords($_SESSION['student'])." </b></p>";
						echo"</td>";

						echo"<td><b> ". date('M d, Y',strtotime($_SESSION['start']))." </b></td>";

						echo"<td><b>". date('M d, Y',strtotime($_SESSION['ends']))."  </b></td>";

						echo"<td class='text-center'> ".$_SESSION['status']."</td>";

							echo"<td class='text-center'>";
							echo"<button type='button' class='btn btn-default btn-sm btn-flat border-info wave-effect text-info dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>";
							echo" Action";
							echo"</button>";
			                echo"<div class='dropdown-menu'>";
							
			                echo"<a class='dropdown-item new_productivity' data-pid = '". $row['id']."' data-tid ='".$row['id']."'  data-task = '".ucwords($row['activity_name'])."'  href='javascript:void(0)'> Add Productivity</a>";
							echo"</div>";
							echo"</td>";
					}}?>
					</tr>	
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
