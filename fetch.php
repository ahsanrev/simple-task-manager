<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/26/2017
 * Time: 10:45 AM
 */

$connect = mysqli_connect("localhost","root","dbbl96811","weblesson");
if(isset($_POST["id"])){
    $output = array();
        $procedure = "
        CREATE PROCEDURE whereUser(IN user_id int(11))
        BEGIN
        SELECT * FROM user WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereUser")){

            if(mysqli_query($connect,$procedure)){

                $query = "CALL whereUser(".$_POST["id"].")";
                $result = mysqli_query($connect,$query);

                while($row = mysqli_fetch_array($result)){
                    $output['name'] = $row["name"];
                    $output['address'] = $row['address'];
                }
                echo json_encode($output);
            }
        }
    }



