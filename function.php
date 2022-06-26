<?php 
$conn = mysqli_connect("localhost","root","","ipmet_dev");

function query($query){
    global $conn;
    $qresult = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($qresult)){
        $rows[] = $row;
    }
    return $rows;
}

function create($create){
    global $conn;
    $taskname = htmlspecialchars($create["taskname"]);
    $difficulty = htmlspecialchars($create["difficulty"]);
    $assignee = htmlspecialchars($create["assignee"]);
    $b_sdate = htmlspecialchars($create["b_sdate"]);
    $b_ddate = htmlspecialchars($create["b_ddate"]);
    $pid = htmlspecialchars($create["pid"]);

    $query = "INSERT INTO listtask_db
                (taskname,difficulty,assignee,b_sdate,b_ddate,pid)
                VALUES
                ('$taskname','$difficulty','$assignee','$b_sdate','$b_ddate','$pid')";
    mysqli_query($conn,$query);
    return(mysqli_affected_rows($conn));            

}

function delete($id){
    global $conn;
    mysqli_query($conn, "DELETE FROM listtask_db WHERE id = $id");
    return mysqli_affected_rows($conn);
    
}

function update($update){
    global $conn;
    $id = $update["id"];
    $taskname = htmlspecialchars($update["taskname"]);
    $difficulty = htmlspecialchars($update["difficulty"]);
    $status = htmlspecialchars($update["status"]);
    $percentage = htmlspecialchars($update["percentage"]);
    $assignee = htmlspecialchars($update["assignee"]);
    $sdate = htmlspecialchars($update["sdate"]);
    $ddate = htmlspecialchars($update["ddate"]);

    $query = "UPDATE listtask_db
    SET taskname = '$taskname',
    difficulty = '$difficulty',
    status = '$status',
    percentage = '$percentage',
    assignee = '$assignee',
    sdate = '$sdate',
    ddate = '$ddate' 
    WHERE id = $id";
    mysqli_query($conn,$query);
    return(mysqli_affected_rows($conn));
}