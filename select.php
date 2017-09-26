<?php
/**
 * Created by PhpStorm.
 * User: PC
 * Date: 9/25/2017
 * Time: 10:56 PM
 */

$output = '';
$connect = mysqli_connect("localhost","root","dbbl96811","weblesson");

if(isset($_POST["action"])){
    $procedure ="
    CREATE PROCEDURE selectUser()
    BEGIN
    SELECT * FROM user ORDER BY id DESC;
    END;
    ";
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectUser")){
        if(mysqli_query($connect,$procedure)){
            $query = "CALL selectUser";
            $result = mysqli_query($connect,$query);
            $output .='                
                <table class="table table-borderd">
                <tr>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Update</th>
                    <th>Delete</th>
                </tr>
                ';
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $output .='
                    <tr>
                        <td>'.$row["name"].'</td>
                        <td>'.$row["address"].'</td>
                        <td><button type="button" name="update" id="'.$row["id"].'" class="update btn btn-info">Update</button></td>
                        <td><button type="button" name="delete" id="'.$row["id"].'" class="delete btn btn-danger">Delete</button></td>
                    </tr>
                    ';
                }
            }else{
                $output ='
                <tr>
                    <td>Data not found</td>
                </tr>
                ';
            }
            $output .='</table>';
            echo $output;

        }
    }

}