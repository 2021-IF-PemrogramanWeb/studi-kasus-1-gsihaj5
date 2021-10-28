<?php
//this is super simple comparison for login

if (isset($_POST['submit_button'])) {
    require '../database/connection.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (field_empty($username, $password)) {
        header("Location: ../../index.php?error=emptyFields");
        exit();
    } else {
        $sql = "SELECT * FROM users WHERE username=? OR email=?;";
        $stmt = mysqli_stmt_init($conn);

        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../../index.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "ss", $username, $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if ($row = mysqli_fetch_assoc($result)) {
                $passwordCheck = password_verify($password, $row['password']);
                if ($passwordCheck == false) {
                    header("Location: ../../index.php?error=wrongpassword");
                    exit();
                } else if ($passwordCheck == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['userName'] = $row['name'];

                    header("Location: ../page/homePage.php");

                    exit();
                } else {
                    header("Location: ../../index.php?error=wrongpassword");
                    exit();
                }
            } else {
                header("Location: ../../index.php?error=nouser");
                exit();
            }
        }
    }
} else {
//    header("Location: ../login/registrationPage.php");
    header("Location: ../../index.php?error=invalidaction");
    exit();
}

function field_empty($username, $password)
{
    return empty($username) || empty($password);
}