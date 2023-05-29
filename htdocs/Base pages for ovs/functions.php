<?php

require('connect.php');
    


    function performQuery($query){
       
        $stmt = mysqli_prepare($query);
        if(mysqli_stmt_execute ( $stmt )){
            return true;
        }else{
            return false;
        }
    }

    function fetchAll($query){

        $stmt = $con->query($query);
        return $stmt->fetchAll();
    }

?>