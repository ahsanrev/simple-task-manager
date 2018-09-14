<?php
include 'db.php';
if(isset($_POST["id"])){
    $output = array();
        $procedure = "
        CREATE PROCEDURE whereTask(IN user_id int(11))
        BEGIN
        SELECT * FROM taskmanager WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereTask")){

            if(mysqli_query($connect,$procedure)){

                $query = "CALL whereTask(".$_POST["id"].")";
                $result = mysqli_query($connect,$query);

                while($row = mysqli_fetch_array($result)){
                    $output['project_title'] = $row["project_title"];
                    $output['task'] = $row['task'];
                }
                echo json_encode($output);
            }
        }
    }

if(isset($_POST["id"])){
    $output = array();
        $procedure = "
        CREATE PROCEDURE whereTask(IN user_id int(11))
        BEGIN
        SELECT * FROM taskmanager WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS whereTask")){

            if(mysqli_query($connect,$procedure)){

                $query = "CALL whereTask(".$_POST["id"].")";
                $result = mysqli_query($connect,$query);

                while($row = mysqli_fetch_array($result)){
                    $output['project_title'] = $row["project_title"];
                    $output['task'] = $row['task'];
                }
                echo json_encode($output);
            }
        }
    }

