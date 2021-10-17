<?php include('db_connect.php') ?>
<?php
$twhere ="";
if($_SESSION['login_type'] != 1)
  $twhere = "  ";
?>
<!-- Info boxes -->
 <div class="col-12">
          <div class="card">
            <div class="card-body">
              Welcome <?php echo $_SESSION['login_name'] ?>!
            </div>
          </div>
  </div>
  <hr>
  <?php 

    $where = "";
    if($_SESSION['login_type'] == 2){
      $where = " where manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
     $where2 = "";
    if($_SESSION['login_type'] == 2){
      $where2 = " where p.manager_id = '{$_SESSION['login_id']}' ";
    }elseif($_SESSION['login_type'] == 3){
      $where2 = " where concat('[',REPLACE(p.user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
    }
    ?>
        
      <div class="row">
        <div class="col-md-8">
        <div class="card card-outline card-success">
          <div class="card-header">
            <b>Project Progress</b>
          </div>
          <div class="card-body p-0">
            <div class="table-responsive">
              <table class="table m-0 table-hover">
                <colgroup>
                  <col width="5%">
                  <col width="30%">
                  <col width="35%">
                  <col width="15%">
                  <col width="15%">
                </colgroup>
                <thead>
                  <th>#</th>
                  <th>Project</th>
                  <th>Progress</th>
                  <th>Status</th>
                  <th></th>
                </thead>
                <tbody>
                <?php
                $i = 1;
                $stat = array("Pending","Started","On-Progress","On-Hold","Over Due","Done");
                $where = "";
                if($_SESSION['login_type'] == 2){
                  $where = " where manager_id = '{$_SESSION['login_id']}' ";
                }elseif($_SESSION['login_type'] == 3){
                  $where = " where concat('[',REPLACE(user_ids,',','],['),']') LIKE '%[{$_SESSION['login_id']}]%' ";
                }
                $qry = $conn->query("SELECT * FROM project_list order by project_name asc");
                while($row= $qry->fetch_assoc()):
               
                  ?>
                  <tr>
                      <td>
                         <?php echo $i++ ?>
                      </td>
                      <td>
                          <a>
                              <?php echo ucwords($row['project_name']) ?>
                          </a>
                          <br>
                          <small>
                              Due: <?php echo date("Y-m-d",strtotime($row['end_date'])) ?>
                          </small>
                      </td>
                      <td class="project_progress">

                         progress

                      </td>
                      <td class="project-state">
                       state
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="./index.php?page=view_project&id=<?php echo $row['id'] ?>">
                              <i class="fas fa-folder">
                              </i>
                              View
                        </a>
                      </td>
                  </tr>
                <?php endwhile; ?>
                </tbody>  
              </table>
            </div>
          </div>
        </div>
        </div>
        <div class="col-md-4">
          <div class="row">

<!--workload charts-->
<div class="col-12 col-sm-6 col-md-12">
                    <div class="small-box bg-light shadow-sm border">
                      <div class="inner">

                      
                      <?php include "overall_chart_lecturer.php" ?>


                      </div>

                      <div class="icon">
                      <i class="fa fa-tasks"></i>
                      </div>
                    </div>
                </div>

          <div class="col-12 col-sm-6 col-md-12">
            <div class="small-box bg-light shadow-sm border">
              <div class="inner">

                <h3><?php echo $conn->query("SELECT * FROM project_list $where")->num_rows; ?></h3>

                <p>Total Projects</p>
              </div>
              <div class="icon">
                <i class="fa fa-layer-group"></i>
              </div>
            </div>
          </div>

                <div class="col-12 col-sm-6 col-md-12">
                    <div class="small-box bg-light shadow-sm border">
                      <div class="inner">


                      <h3><?php echo $conn->query("SELECT * FROM task_list $where")->num_rows; ?></h3>

                      <p>Total Tasks</p>



                      </div>

                      <div class="icon">
                      <i class="fa fa-tasks"></i>
                      </div>
                    </div>
                </div>

<!--workload charts-->
<div class="col-12 col-sm-6 col-md-12">
                    <div class="small-box bg-light shadow-sm border">
                      <div class="inner">


                      <?php include "overall_chart.php" ?>


                      </div>

                      <div class="icon">
                      <i class="fa fa-tasks"></i>
                      </div>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-md-12">
                    <div class="small-box bg-light shadow-sm border">
                      <div class="inner">


                      <h3><?php echo $conn->query("SELECT * FROM users")->num_rows; ?></h3>

                      <p>Total User</p>



                      </div>

                      <div class="icon">
                      <i class="fa fa-tasks"></i>
                      </div>
                    </div>
                </div>



                
      </div>
        </div>
      </div>
