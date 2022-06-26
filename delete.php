<?php 
require 'function.php';
$id = $_GET["id"];

if (delete($id)>0){
    echo "
    <script>
        alert('Task successfully deleted');
        document.location.href = 'ListTask.php';
    </script>
    ";
}
?>