<?php
try {
    if((isset($_GET['userid'])) && (is_numeric($_GET['userid']))) {
        $id = htmlspecialchars($_GET['userid'], ENT_QUOTES);
    } else if((isset($_POST['userid'])) && (is_numeric($_POST['userid']))){
        $id = htmlspecialchars($_POST['userid'], ENT_QUOTES);
    } else{
        // echo '<p class = "text-center">This page has been accessed in error</p>';
        // exit();
    }
    require('mysqli_connect.php');
    $s_stmt = $conn->stmt_init();
    $s_query = "SELECT userid, first_name, last_name, email FROM users WHERE userid = ?";
    $s_stmt->prepare($s_query);
    $s_stmt->bind_param('i',$id);
    $s_stmt->execute();
    $result = $s_stmt->get_result();
    $row1 = $result->fetch_array(MYSQLI_ASSOC);
    if (isset($_POST['submit'])) {
        if (empty($_POST['first_name'] || empty($_POST['last_name']) || empty($_POST['email']))) {
            echo "<p style=\"color:red;text-align:center;\">Please enter information!";
        }
        else {
            if($_POST['first_name'] == $row1['first_name'] && $_POST['last_name'] == $row1['last_name'] &&  $_POST['email'] == $row1['email']){
                echo "<p style=\"color:red;text-align:center;\">Please enter new information!";
            }
            else {
                $firstname = $_POST['first_name'];
                $lastname = $_POST['last_name'];
                $email = $_POST['email'];
                $s_stmt1 = $conn->stmt_init();
                $s_query1 = "UPDATE users SET first_name = ?, last_name = ?, email = ?  WHERE userid = ?";
                $s_stmt1->prepare($s_query1);
                $s_stmt1->bind_param('sssi', $firstname, $lastname, $email, $id);
                $s_stmt1->execute();
                if($s_stmt1->execute() == TRUE){
                    header("location:admin.php");
                    exit();
                }
                else {
                    echo "<p style=\"color:red;text-align:center;\">Update failed!";
                }
            }
        }
    }
}catch(Exception $e){}
?>      
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <meta http-equiv="X-UA-Compatible" content="ie=edge">
            <title>Adim Page</title>
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
            crossorigin="anonymous">
            <script language="JavaScript" type="text/javascript">
            function checkUpdate(){
                return confirm('Are you sure to update this user');
            }
            </script>
        </head>
        <body>
        <div class="container">
            <h2 class = "h2 text-center">Edit a Record</h2>
            <form action="edit-user.php" method = "post" name = "form" onsubmit = "return checkUpdate()">
            <div class="form-group row">
                <label for="first_name" class = "col-sm-4 col-form-label text-right">First Name*:</label>
                <div class="col-sm-8">
                    <input type="text" class = "form-control" id = "first_name" name = "first_name"
                    placeholder = "First Name" maxlength = "30" require
                    value = "<?php if(isset($row1['first_name']))
                    echo htmlspecialchars($row1['first_name'], ENT_QUOTES);?>">
                </div>
            </div>
            <div class="form-group row">
            <label for="last_name" class = "col-sm-4 col-form-label text-right">Last Name*:</label>
                <div class="col-sm-8">
                    <input type="text" class = "form-control" id = "last_name" name = "last_name"
                    placeholder = "Last Name" maxlength = "40" require
                    value = "<?php if(isset($row1['last_name']))
                    echo htmlspecialchars($row1['last_name'], ENT_QUOTES);?>">
                </div>
            </div>
            <div class="form-group row">
            <label for="email" class = "col-sm-4 col-form-label text-right">E-mail*:</label>
                <div class="col-sm-8">
                    <input type="text" class = "form-control" id = "email" name = "email"
                    placeholder = "E-mail" maxlength = "60" require
                    value = "<?php if(isset($row1['email']))
                    echo htmlspecialchars($row1['email'], ENT_QUOTES);?>">
                </div>
            </div>
            <input type="hidden" name="userid" value = "<?php echo $id ?>"/>
            <div class="form-group row">
                <label for="" class = "col-sm-4 col-form-label"></label>
                <div class="col-sm-8">
                <input type="submit" class ="btn btn-primary" type ="submit" name="submit" value ="Update">
                </div>
            </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        </body>
        </html>
