<?php 
require 'function.php';
$data = query("SELECT *,DATEDIFF(COALESCE(ddate, CURRENT_DATE),COALESCE(sdate, b_sdate)) AS date_diff FROM listtask_db;");
if (isset($_POST["submit"])){
    if (update($_POST)>0){
        echo"
        <script>
            alert('Task successfully updated');
            document.location.href = 'ListTask.php';
        </script>
        ";
    }
    else{
        echo"
        <script>
            alert('Task failed to update');
            document.location.href = 'ListTask.php';
        </script>
        ";
    }

}
?>

<!DOCTYPE html>
<html>
<head>
<title>i-PMET</title>
<!-- CSS Link -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
<link href="E:\1 Aplikasi\4 Engineering\bootstrap\dist\css\bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<!-- Our Custom CSS -->
<link rel="stylesheet" href="listTask.css">

<!-- Font Awesome JS -->
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
</head>

<body>
<div class="wrapper">
  <!-- Sidebar -->
  <nav id="sidebar">
    <div class="sidebar-header">
    <h3>i-Project Management Enterprise Tools</h3>
    </div>
    <hr>
    <ul class="list-unstyled">
            <li> <a href="#projectSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-calendar"></i>
                    Projects
                </a>
                <ul class="collapse list-unstyled" id="projectSubmenu">
                    <li>
                        <a href="createProject.php">Create Project</a>
                    </li>
                    <li>
                        <a href="#">List Project</a>
                    </li>
                    <li>
                        <a href="ListTask.php">List Task</a>
                    </li>
                </ul>
            </li>
            <li> <a href="#resourceSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-users"></i>
                    Resource
                </a>
                <ul class="collapse list-unstyled" id="resourceSubmenu">
                    <li>
                        <a href="#">Add Resouce</a>
                    </li>
                    <li>
                        <a href="#">Manage Group</a>
                    </li>
                    <li>
                        <a href="#">Manage Resource</a>
                    </li>
                </ul>
            </li>
    </ul>  
    <hr>
    <ul class="list-unstyled">
        <li> <a href="#accountSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-user"></i>
                    Account
                </a>
                <ul class="collapse list-unstyled" id="accountSubmenu">
                    <li>
                        <a href="#">Profile</a>
                    </li>
                    <li>
                        <a href="index.php">Log out</a>
                    </li>
                </ul>
            </li>
    </ul>  
  </nav>
  <!-- Page Content  -->
  <div id="content">
  <h1>Task Management Information Systems</h1>
        <h2>List Task</h2>
        <table class = "table table-hover table-bordered table-striped">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>ID</th>
            <th>Task Name</th>
            <th>Status</th>
            <th>Percentage</th>
            <th>Assignee</th>
            <th>Difficulty</th>
            <th>Baseline Start Date</th>
            <th>Baseline End Date</th>
            <th>Start Date</th>
            <th>Due Date</th>
            <th>Duration</th>
            <th>PID</th>
            <th>Project Name</th>
            <th>Action</th>
        </tr>
        </thead>
        <?php $i =1;?>
        <?php foreach ($data as $row) :?>
        <tr>
            <td><?php echo $i?></td>
            <td><?php echo $row["id"]?></td>
            <td><?php echo $row["taskname"]?></td>
            <td><?php echo $row["status"]?></td>
            <td><?php echo $row["percentage"]?></td>
            <td><?php echo $row["assignee"]?></td>
            <td><?php echo $row["difficulty"]?></td>
            <td><?php echo $row["b_sdate"]?></td>
            <td><?php echo $row["b_ddate"]?></td>
            <td><?php echo $row["sdate"]?></td>
            <td><?php echo $row["ddate"]?></td>
            <td><?php echo $row["date_diff"]?></td>
            <td><?php echo $row["pid"]?></td>
            <td><?php echo $row["pname"]?></td>
            <td><button type="button" name="detail" class="btn btn-info" data-toggle="modal" data-target="#modalDetail-<?php echo $row["id"]?>">Detail</button> <button type="delete" name="delete" class="btn btn-danger" onclick = "confirmDelete(<?=$row["id"]?>,'<?=$row["taskname"]?>');">Delete</button></td>
        </tr>
        
        <!-- Fungsi confirm delete -->
        <script>
        function confirmDelete(rowid,tname){
            if(confirm("Are you sure to delete task : \n"+'#'+rowid+' '+tname+"?")){
                    document.location.href = "delete.php?id="+rowid;
                } 
            }
        </script>

        <!-- Modal Detail -->
        <div class="modal fade" id="modalDetail-<?php echo $row["id"]?>" tabindex="-1" role="dialog" aria-labelledby="modalDetailCenter" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLongTitle">Task #<?php echo $row["id"],": ",$row["taskname"]?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="" method="POST">
                <div class="container modal-body">
                    <input type="hidden" name="id" value="<?=$row["id"]?>">
                    <div class="row">
                        <div class="col"><label for="taskname">Task Name</label></div>
                        <div class="col-8">: <input type="text" id="taskname" name="taskname" required value="<?=$row["taskname"]?>"></div>
                    </div>
                    <div class="row">
                        <div class="col"><label for="difficulty">Difficulty</label></div>
                        <div class="col-8">: <select name="difficulty" id="difficulty" required value="<?=$row["difficulty"]?>">
                        <option value="5" <?php if($row['difficulty']=="5") echo "selected=\"selected\""; ?>>5</option>
                        <option value="4" <?php if($row['difficulty']=="4") echo "selected=\"selected\""; ?>>4</option>
                        <option value="3" <?php if($row['difficulty']=="3") echo "selected=\"selected\""; ?>>3</option>
                        <option value="2 <?php if($row['difficulty']=="2") echo "selected=\"selected\""; ?>">2</option>
                        <option value="1" <?php if($row['difficulty']=="1") echo "selected=\"selected\""; ?>>1</option>
                    </select>
                    </div>
                </div>
                <div class="row">
                        <div class="col"><label for="status">Status</label></div>
                        <div class="col-8">: <select name="status" id="status" required>
                        <option value="NEW" <?php if($row['status']=="NEW") echo "selected=\"selected\""; ?>>NEW</option>
                        <option value="IN PROGRESS" <?php if($row['status']=="IN PROGRESS") echo "selected=\"selected\""; ?>>IN PROGRESS</option>
                        <option value="DONE" <?php if($row['status']=="DONE") echo "selected=\"selected\""; ?>>DONE</option>
                    </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col"><label for="percentage">Percentage</label></div>
                    <div class="col-8">: <input type="text" id="percentage" name="percentage" required value="<?=$row["percentage"]?>"></div>
                </div>
                <div class="row">
                    <div class="col"><label for="assignee">Assignee</label></div>
                    <div class="col-8">: <input type="text" id="assignee" name="assignee" required value="<?=$row["assignee"]?>"></div>
                </div>
                <div class="row">
                    <div class="col"><label for="sdate">Start Date</label></div>
                    <div class="col-8">: <input type="date" id="sdate" name="sdate" required value="<?=$row["sdate"]?>"></div>
                </div>
                <div class="row">
                    <div class="col"><label for="ddate">Due Date</label></div>
                    <div class="col-8">: <input type="date" id="ddate" name="ddate" value="<?=$row["ddate"]?>"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="submit" class="btn btn-primary">Update</button>
                </div>
                </form>
                </div>
            </div>
            </div>
        
        <?php $i+=1;?>
        <?php endforeach;?>
        </table>
  </div>
  </div>

</div>
  <!-- jQuery CDN - Slim version (=without AJAX) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <!-- Popper.JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  
</body>
</html>