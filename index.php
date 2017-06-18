<?php
session_start();

//Check PIN, redirect if correct

if(isset($_POST['pin'])){
    require 'connect.php';
    $pin = $_POST['pin'];
    $result = mysqli_query($con, "SELECT * FROM pin WHERE pin= '$pin'");
    $_SESSION['log'] = '1';
    if(mysqli_num_rows($result)==1){
        header('Location:welcome.php');

    }
    else{

        echo 'Vale PIN!';

    }
}

//End session

if(isset($_GET['logout'])){
    session_destroy();
    unset($_SESSION["log"]);
}
?>

<!--Style taken from W3Schools-->

<style>
    form {
        border: 3px solid #f1f1f1;
    }

    input[type=text], input[type=password] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    button {
        background-color: #4CAF50;
        color: white;
        padding: 14px 20px;
        margin: 8px 0;
        border: none;
        cursor: pointer;
        width: 100%;
    }

    button:hover {
        opacity: 0.8;
    }

    .container {
        padding: 16px;
    }
</style>

<!--Form taken from W3Schools-->

<body>
<p><?php var_dump($_SESSION['log']); ?></p>
<form method="post" action="index.php?action=login">
        <div class="container">
        <label><b>PIN</b></label>
        <input type="password" minlength="4" onkeypress='return event.charCode >= 48 && event.charCode <= 57' placeholder="Enter PIN" name="pin" required>

        <button type="submit">Login</button>
    </div>

</form>

</body>