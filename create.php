<?php 
require "function.php";
if (isset($_POST["submit"])){
    if (create($_POST)>0){
        echo"
        <script>
            alert('Task successfully added');
            document.location.href = 'ListTask.php';
        </script>
        ";
    }
    else{
        echo"
        <script>
            alert('Task failed to add');
            document.location.href = 'ListTask.php';
        </script>
        ";
    }

}

?>  
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="create.css">
    <title>Input Task | i-PMET</title>
</head>
<body>
    
    <!-- Side navigation -->
    <div class="sidenav">
        <h4>i-Project Management Enterprise Tool</h4>
        <a href="index.php">Home</a>
        <a href="">Input Project</a>
        <a href="create.php" class="selected">Input Task</a>
        <a href="ListTask.php">List Task</a>
        <a href="">Resouce Management</a>
    </div>
    
    <div class=main>
    <h1>Task Management Information System</h1>
    <h2>Create Task</h2>
    <form action="" method="POST">
        <table class = "table_input_task">
            <tr>
                <td><label for="taskname">Task Name</label></td>
                <td>: <input type="text" id="taskname" name="taskname" required></td>
            </tr>

            <tr>
                <td><label for="difficulty">Difficulty</label></td>
                <td>: <select name="difficulty" id="difficulty" required>
                        <option value="5">5</option>
                        <option value="4">4</option>
                        <option value="3">3</option>
                        <option value="2">2</option>
                        <option value="1">1</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="assignee">Assignee</label></td>
                <td>: <input type="text" id="assignee" name="assignee" required></td>
            </tr>
            <tr>
                <td><label for="b_sdate">Baseline Start Date</label></td>
                <td>: <input type="date" id="b_sdate" name="b_sdate" required></td>
            </tr>
            <tr>
                <td><label for="b_ddate">Baseline Due Date</label></td>
                <td>: <input type="date" id="b_ddate" name="b_ddate" required></td>
            </tr>
            <tr>
                <td><label for="pid">PID</label></td>
                <td>: <input type="text" id="pid" name="pid" required></td>
            </tr>
         </table>
         <button type="submit" name="submit" class="button_submit_task">Create</button>
    </form>
    </div>
</body>
</html>