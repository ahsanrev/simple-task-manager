<!DOCTYPE html>
<html lang="en">
<head>
    <title> Ahsan Zaidi - Team</title>
    <meta charset="utf-8">
    <meta project_title="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
session_start();
$value = $_SESSION['user_id'];
$value1 = $_SESSION['name'];
if($value == ""){
	header('Location: login.php');
}
	?>
<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h3>Welcome <?php echo $value1; ?> <br />PL Team Task Creator</h3>
            <label for="">Project Title</label>
            <input type="text" name="project_title" id="project_title" class="form-control">
            <br/>
            <label for="">Enter Task</label>
            <textarea rows="4" cols="50" project_title="task" id="task" class="form-control"> </textarea>
            <br/>
            <input type="hidden" name="id" id="user_id">
            <button type="button" id="action" class="btn btn-warning pull-right">Add</button>
        </div>
        
        <div class="col-md-7">
            <h3>Pending Tasks <span style="float:right;"><a href="logout.php">Logout</a> </span></h3>
            <br/>
            <div id="result" class="table-responsive">
			
			
            </div>

        </div>
		<div class="col-md-7">
            <h3>Complete Tasks</h3>
            <br/>
            <div id="resultcomp" class="table-responsive">
			
			
            </div>

        </div>
    </div>
<script>
        //show
        $(document).ready(function () {
            fetchUser();
            function fetchUser() {
                var actionComp = "select"
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{actionComp:actionComp},
                    success:function (data) {
                        $('#project_title').val('');
                        $('#task').val('');
                        $('#actionComp').text("Add");
                        $('#resultcomp').html(data);
                    }
                })
            }

            //insert data
            $('#actionComp').click(function () {
                var project_title = $('#project_title').val();
                var task = $('#task').val();
                var id = $('#user_id').val();
                var actionComp = $('#actionComp').text();

                if(project_title !='' && task !=''){
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{project_title:project_title, task:task, id:id, action:action},
                        success:function (data) {
                            //alert(data);
                            fetchUser();
                        }
                    })

                }else{
                    alert("Both fields are required");
                }
            });

            //update
            $(document).on('click','.update', function () {
                var id = $(this).attr("id");

                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"json",
                    success:function (data) {
                        $('#actionComp').text("Edit");
                        $('#user_id').val(id);
                        $('#project_title').val(data.project_title);
                        $('#task').val(data.task);

                    }
                })

            });

            $(document).on('click','.delete', function(){

                var id= $(this).attr("id");

                if(confirm("Are you sure you want to delete this data")){
                    var actionComp = "Delete";
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{id:id, actionComp:actionComp},
                        success:function (data) {
                            fetchUser();
                            //alert(data);
                        }
                    })
                }else{
                    return false;
                }

            });



        });

    </script>
    <script>
        //show
        $(document).ready(function () {
            fetchUser();
            function fetchUser() {
                var action = "select"
                $.ajax({
                    url:"select.php",
                    method:"POST",
                    data:{action:action},
                    success:function (data) {
                        $('#project_title').val('');
                        $('#task').val('');
                        $('#action').text("Add");
                        $('#result').html(data);
                    }
                })
            }

            //insert data
            $('#action').click(function () {
                var project_title = $('#project_title').val();
                var task = $('#task').val();
                var id = $('#user_id').val();
                var action = $('#action').text();

                if(project_title !='' && task !=''){
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{project_title:project_title, task:task, id:id, action:action},
                        success:function (data) {
                            //alert(data);
                            fetchUser();
                        }
                    })

                }else{
                    alert("Both fields are required");
                }
            });

            //update
            $(document).on('click','.update', function () {
                var id = $(this).attr("id");

                $.ajax({
                    url:"fetch.php",
                    method:"POST",
                    data:{id:id},
                    dataType:"json",
                    success:function (data) {
                        $('#action').text("Edit");
                        $('#user_id').val(id);
                        $('#project_title').val(data.project_title);
                        $('#task').val(data.task);

                    }
                })

            });
			

            $(document).on('click','.delete', function(){

                var id= $(this).attr("id");

                if(confirm("Are you sure you want to delete this data")){
                    var action = "Delete";
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{id:id, action:action},
                        success:function (data) {
                            fetchUser();
                            //alert(data);
                        }
                    })
                }else{
                    return false;
                }

            });
			
			   $(document).on('click','.complete', function(){

                var id= $(this).attr("id");

                if(confirm("Is This Task Completed?")){
                    var action = "complete";
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{id:id, action:action},
                        success:function (data) {
                            fetchUser();
                            //alert(data);
							window.location.reload();
                        }
                    })
                }else{
                    return false;
                }

            });



        });

    </script>
</div>
</body>
</html>
