<?php


if (isset($_POST['name']) && isset($_POST['email'])) {
    include 'db_conn.php';
    
    function usertest ($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    
    $name = $_POST['name'];
    $email = $_POST['email'];
    
    if (empty($name) || empty($email)) {
        header("Location: signup.html");
    }else {
        
        $sql = "INSERT INTO test(name, email) VALUES('$name', '$email')";
        $res = mysqli_query($conn, $sql);
        
        if ($res) {
           echo "Successfully Registered!";
        }
    }
}
echo '<input type="button" style="width:60px;height:20px" value="Done" onclick="window.location=\'http://localhost/test_db/login.html\'" />';