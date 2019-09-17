<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Page</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" 
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" 
    crossorigin="anonymous">
    <script language="JavaScript" type="text/javascript">
    function checkDelete(){
        return confirm('Are you sure to delete this user');
    }
    </script>
</head>
<body>
    <div class="container">
    <h1 class="text-center">Admin Control Panel</h1>
    <h2 class="text-center">Register Users</h2>
    <?php
    try{
        
        require('mysqli_connect.php');
        $pagerows = 3;
        if ((isset($_GET['p'])) && is_numeric($_GET['p'])) {
            $pages = htmlspecialchars($_GET['p'], ENT_QUOTES);
        } else {
            $query = "SELECT COUNT(userid) FROM users";
            $result = $conn->query($query);
            $row = $result->fetch_array(MYSQLI_NUM);
            $records = htmlspecialchars($row[0], ENT_QUOTES);
            if ($records > $pagerows) {
                $pages = ceil($records/$pagerows);
            } else {
                $pages = 1;
            }
        }
        
        if ((isset($_GET['s'])) && (is_numeric($_GET['s']))) {
            $start = htmlspecialchars($_GET['s'], ENT_QUOTES);
        } else {
            $start = 0;
        }
        $query = "SELECT last_name, first_name, email, DATE_FORMAT(registration_date, '%M %d %Y') AS regdat, userid FROM users ORDER BY registration_date ASC LIMIT ?,?";
        $stmt = $conn->stmt_init();
        $stmt->prepare($query);
        $stmt->bind_param("ii", $start, $pagerows);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result) {
            echo '<table class = "table table-striped">
            <tr>
            <th scope = "col">Edit</th>
            <th scope = "col">Delete</th>
            <th scope = "col">Last Name</th>
            <th scope = "col">First Name</th>
            <th scope = "col">Email</th>
            <th scope = "col">Date Registered</th>
            </tr>';
            while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $user_id = htmlspecialchars($row['userid'], ENT_QUOTES);
                $last_name = htmlspecialchars($row['last_name'], ENT_QUOTES);
                $first_name = htmlspecialchars($row['first_name'], ENT_QUOTES);
                $email = htmlspecialchars($row['email'], ENT_QUOTES);
                $registration_date = htmlspecialchars($row['regdat'], ENT_QUOTES);
                echo '<tr>
                <td><a href = "edit-user.php?userid='.$user_id.'">Edit</a></td>
                <td><a href = "delete-user.php?userid='.$user_id.'" onclick = "return checkDelete()">Delete</a></td>
                <td>'.$last_name.'</td>
                <td>'.$first_name.'</td>
                <td>'.$email.'</td>
                <td>'.$registration_date.'</td>
                </tr>';
            }
            echo '</table>';
            $result->free_result();
        } else {
            echo '<p class = "text-center">The current users could not be retrieved</p>';
            exit;
        }
        $query = "SELECT COUNT(userid) FROM users";
        $result = $conn->query($query);
        $row = $result->fetch_array(MYSQLI_NUM);
        $members = htmlspecialchars($row[0], ENT_QUOTES);
        $conn->close();
        $echostring = "<p class = 'text-center'>Total users:$members</p>";
        $echostring .= "<p class = 'text-center'>";

        if($pages > 1){
            $current_page = ($start/$pagerows) + 1;
            if($current_page != 1){
                $echostring .= '<a href="admin.php?s='.($start - $pagerows).'&p='.$pages.'">Previous</a>';
            }
            if($current_page != $pages){
                $echostring .= '<a href="admin.php?s='.($start + $pagerows).'&p='.$pages.'">Next</a>';
            }
            $echostring .= '</p>';
            echo $echostring;
        }
        $conn->close();
    }
    catch(Exception $e){
        print "An Exception occurred. Message: ".$e->getMessage();
    }
    ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>