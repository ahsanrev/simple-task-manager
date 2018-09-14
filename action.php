<?php
include 'db.php';
if(isset($_POST["action"])){
    $output = '';

    if($_POST["action"]=="Add"){

        $project_title = mysqli_real_escape_string($connect, $_POST["project_title"]);
        $task = mysqli_real_escape_string($connect, $_POST["task"]);

        $procedure = "
        CREATE PROCEDURE insertTask(IN project_title varchar(255),task varchar(555))
        BEGIN
        INSERT INTO taskmanager(project_title,task)VALUES(project_title,task);
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertTask")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL insertTask('".$project_title."','".$task."')";
                mysqli_query($connect,$query);
               // echo "Resource Added";
            }
        }
    }

    if($_POST["action"]=="Edit"){

        $project_title = mysqli_real_escape_string($connect,$_POST["project_title"]);
        $task = mysqli_real_escape_string($connect,$_POST["task"]);

        $procedure = "
        CREATE PROCEDURE updateTask(IN user_id int(11),  project_title varchar(255), task varchar(555))
        BEGIN
        UPDATE taskmanager SET project_title = project_title, task = task
        WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateTask")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL updateTask('".$_POST["id"]."','".$_POST["project_title"]."','".$_POST["task"]."')";
                mysqli_query($connect,$query);
                //echo "Resource Updated";
            }
        }

    }

    if($_POST["action"]=="Delete"){

        $procedure = "
        CREATE PROCEDURE deleteTask(IN user_id int(11))
        BEGIN
        DELETE FROM taskmanager WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS deleteTask")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL deleteTask('".$_POST["id"]."')";
                mysqli_query($connect,$query);
                //echo "Resource Deleted";
            }
        }

    }
    if($_POST["action"]=="complete"){
        $procedure = "
        CREATE PROCEDURE completeTask(IN user_id int(11), status int(11))
        BEGIN
        UPDATE taskmanager SET status = 1
        WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS completeTask")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL completeTask('".$_POST["id"]."','".$_POST["status"]."')";
                mysqli_query($connect,$query);
                //echo "Resource Updated";
            }
        }

    }


}