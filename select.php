<?php
include 'db.php';
$output = '';
if(isset($_POST["action"])){
    $procedure ="
    CREATE PROCEDURE selectTasks()
    BEGIN
    SELECT * FROM taskManager where status = 0 ORDER BY id DESC;
    END;
    ";
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectTasks")){
        if(mysqli_query($connect,$procedure)){
            $query = "CALL selectTasks";
            $result = mysqli_query($connect,$query);
            $output .='                
                <table class="table table-borderd">
                <tr>
                    <th>Project</th>
                    <th>Tasks</th>
                    <th>Update</th>
                    <th>Delete</th>
					<th>Status</th>
                </tr>
                ';
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $output .='
                    <tr>
                        <td>'.$row["project_title"].'</td>
                        <td>'.$row["task"].'</td>
                        <td><button type="button" name="update" id="'.$row["id"].'" class="update btn btn-info">Update</button></td>
                        <td><button type="button" name="delete" id="'.$row["id"].'" class="delete btn btn-danger">Delete</button></td>
						<td><button type="button" name="complete" id="'.$row["id"].'" class="complete btn btn-info">Done</button></td>
                    </tr>
                    ';
                }
            }else{
                $output ='
                <tr>
                    <td><button type="button" project_title="Data not found" class="update btn btn-danger">Data not found - Please Add Some Tasks</button></td>
                </tr>
                ';
            }
            $output .='</table>';
            echo $output;

        }
    }

}

if(isset($_POST["actionComp"])){
    $procedureComp ="
    CREATE PROCEDURE selectCompletedTasks()
    BEGIN
    SELECT * FROM taskManager where status = 1 ORDER BY time DESC;
    END;
    ";
    if(mysqli_query($connect,"DROP PROCEDURE IF EXISTS selectCompletedTasks")){
        if(mysqli_query($connect,$procedureComp)){
            $query = "CALL selectCompletedTasks";
            $result = mysqli_query($connect,$query);
            $output .='                
                <table class="table table-borderd">
                <tr>
                    <th>Project</th>
                    <th>Tasks</th>
					<th>Status</th>
					<th>Date</th>
                    <th>Delete</th>
                </tr>
                ';
            if(mysqli_num_rows($result) > 0){
                while($row = mysqli_fetch_array($result)){
                    $output .='
                    <tr>
                        <td>'.$row["project_title"].'</td>
                        <td>'.$row["task"].'</td>
						<td>'.$row["status"].'</td>
						<td>'.$row["time"].'</td>
                        <td><button type="button" project_title="delete" id="'.$row["id"].'" class="delete btn btn-danger">Delete</button></td>
                    </tr>
                    ';
                }
            }else{
                $output ='
                <tr>
                    <td><button type="button" project_title="Data not found" class="update btn btn-danger">Data not found - Please Add Some Tasks</button></td>
                </tr>
                ';
            }
            $output .='</table>';
            echo $output;

        }
    }

}
