<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/26/2017
 * Time: 12:26 AM
 */

if(isset($_POST["action"])){
    $output = '';
    $connect = mysqli_connect("localhost","root","dbbl96811","weblesson");

    if($_POST["action"]=="Add"){

        $name = mysqli_real_escape_string($connect, $_POST["name"]);
        $address = mysqli_real_escape_string($connect, $_POST["address"]);

        $procedure = "
        CREATE PROCEDURE insertUser(IN name varchar(255),address varchar(255))
        BEGIN
        INSERT INTO user(name,address)VALUES(name,address);
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS insertUser")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL insertUser('".$name."','".$address."')";
                mysqli_query($connect,$query);
                echo "Data Inserted";
            }
        }
    }

    if($_POST["action"]=="Edit"){

        $name = mysqli_real_escape_string($connect,$_POST["name"]);
        $address = mysqli_real_escape_string($connect,$_POST["address"]);

        $procedure = "
        CREATE PROCEDURE updateUser(IN user_id int(11),  name varchar(255), address varchar(255))
        BEGIN
        UPDATE user SET name = name, address= address
        WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS updateUser")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL updateUser('".$_POST["id"]."','".$_POST["name"]."','".$_POST["address"]."')";
                mysqli_query($connect,$query);
                echo "Data Updated";
            }
        }

    }

    if($_POST["action"]=="Delete"){

        $procedure = "
        CREATE PROCEDURE deleteUser(IN user_id int(11))
        BEGIN
        DELETE FROM user WHERE id = user_id;
        END;
        ";
        if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS deleteUser")){
            if(mysqli_query($connect,$procedure)){
                $query = "CALL deleteUser('".$_POST["id"]."')";
                mysqli_query($connect,$query);
                echo "Data Deleted";
            }
        }

    }


}