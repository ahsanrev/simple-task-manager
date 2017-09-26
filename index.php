<!DOCTYPE html>
<html lang="en">
<head>
    <title>CRUD - Store Procedure</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-5">
            <h3>PHP AJAX CURD -  Insert Data</h3>
            <label for="">Enter Name</label>
            <input type="text" name="name" id="name" class="form-control">
            <br/>
            <label for="">Enter Address</label>
            <input type="text" name="address" id="address" class="form-control">
            <br/>
            <input type="hidden" name="id" id="user_id">
            <button type="button" id="action" class="btn btn-warning pull-right">Add</button>
        </div>
        
        <div class="col-md-7">
            <h3>PHP AJAX CURD -  Show Data</h3>
            <br/>
            <div id="result" class="table-responsive">
            </div>

        </div>
    </div>

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
                        $('#name').val('');
                        $('#address').val('');
                        $('#action').text("Add");
                        $('#result').html(data);
                    }
                })
            }

            //insert data
            $('#action').click(function () {
                var name = $('#name').val();
                var address = $('#address').val();
                var id = $('#user_id').val();
                var action = $('#action').text();

                if(name !='' && address !=''){
                    $.ajax({
                        url:"action.php",
                        method:"POST",
                        data:{name:name, address:address, id:id, action:action},
                        success:function (data) {
                            alert(data);
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
                        $('#name').val(data.name);
                        $('#address').val(data.address);

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
                            alert(data);
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
