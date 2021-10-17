  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
  
        <?php 

        $user = $_SESSION['login_id'] ;
        $sql = "SELECT * FROM `users` WHERE `email` = '$user' ";
              
        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){

        if($row = mysqli_fetch_array($result)){
         $_SESSION['avatar'] = $row['avatar'];
          
        
       if($_SESSION['login_type'] == 1){
        echo ' <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>';
        } else{
         $pic = $_SESSION['avatar'];

          echo "<img src='".$pic."'>";

          echo '<h3 class="text-center p-0 m-0"><b>USER</b></h3>';  
        }        
        }
          }
        ?>

    
        </br></br>
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="./" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
<!--Faculty setup -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_faculty nav-view_faculty">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Faculty
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_faculty" class="nav-link nav-new_project tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add Faculty</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=faculty_list" class="nav-link nav-project_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Faculty List</p>
                </a>
              </li>
            </ul>
          </li>   
<!--Courses setup -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Course
                <i class="right fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_course" class="nav-link nav-new_project tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Course</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=course_list" class="nav-link nav-project_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List of Courses</p>
                </a>
              </li>
            </ul>
          </li>
<!--Project setup -->
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
              Project
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_project" class="nav-link nav-new_project tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New Project</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=project_list" class="nav-link nav-project_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List of Projects</p>
                </a>
              </li>
            </ul>
          </li>

<!--Activities setup -->          
          <li class="nav-item">
                <a href="./index.php?page=task_list" class="nav-link nav-task_list">
                  <i class="fas fa-tasks nav-icon"></i>
                  <p>Activities</p>
                </a>
          </li>
          <?php if($_SESSION['login_type'] != 3): ?>
           <li class="nav-item">
                <a href="./index.php?page=reports" class="nav-link nav-reports">
                  <i class="fas fa-th-list nav-icon"></i>
                  <p>Report</p>
                </a>
          </li>
          <?php endif; ?>
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        </ul>
        
        <p style="padding-left:30px; color:white; opacity:0.8;"><img src="icons\community.png"> Community</p>
      </nav>
    </div>
  </aside>
  <script>
  	$(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
  		var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      if(s!='')
        page = page+'_'+s;
  		if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
  			if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
  				$('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
  			}
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

  		}
     
  	})
  </script>