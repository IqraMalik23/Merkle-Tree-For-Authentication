<?php
if (isset($_POST['email'])) {
    include 'db_conn.php';
    
    function usertest ($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $email = $_POST['email'];
        $sql = "select * from test where email='$email'";
        $res = mysqli_query($conn, $sql);
        $count=mysqli_num_rows($res);
        if($count>0) 
        if ($res) {
           echo "Login Successful";
        }
    }
echo 'Login Successful';
echo '<input type="button" style="width:60px;height:20px" value="Done" onclick="window.location=\'http://localhost/test_db/home.html\'" />';
?>