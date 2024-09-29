<?php
include 'connect.php';
session_start();
if (isset($_SESSION['username'])) {
    echo "<script>alert('You are already logged in!');</script>";
    echo "<script>window.location.href='index.php';</script>";
}

function getUserId($conn, $username)
{
    $sql = "SELECT user_id FROM user WHERE user_name = ?";
    $stmt = mysqli_prepare($conn, $sql);

    mysqli_stmt_bind_param($stmt, 's', $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        return $row['user_id'];
    }
    return null; // Return null if user_id not found
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <a class="goBackHome" href="index.php">
        <img src="assets/icons/arrow.png" alt="">
    </a>
    <div class="wrapper">
        <div class="card-switch">
            <label class="switch">
                <input type="checkbox" class="toggle">
                <span class="slider"></span>
                <span class="card-side"></span>
                <div class="flip-card__inner">
                    <div class="flip-card__front">
                        <div class="title">Log in123</div>
                        <form class="flip-card__form" action="" method="post">
                            <input class="flip-card__input" name="username" placeholder="Username" type="text" required>
                            <input class="flip-card__input" name="password" placeholder="Password" type="password"
                                required>
                            <button name="login" class="flip-card__btn">Login</button>
                        </form>
                        <?php
                        if (isset($_POST['login'])) {
                            // Sanitize inputs
                            $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
                            $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

                            // Prepare and execute the query to check if the username exists
                            $sql = "SELECT user_password FROM user WHERE user_name = ?";
                            $stmt = mysqli_prepare($conn, $sql);
                            mysqli_stmt_bind_param($stmt, 's', $username);
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $hashed_password);
                            $user_exists = mysqli_stmt_fetch($stmt); // Fetch the result
                        
                            if ($user_exists) {
                                // Username exists, now verify the password
                                if (password_verify($password, $hashed_password)) {
                                    // Set session variable on successful login
                                    $_SESSION['username'] = $username;
                                    echo "<script>alert('Login successful!');</script>";
                                    echo "<script>window.location.href='index.php';</script>";
                                } else {
                                    echo "Invalid username or password.";
                                }
                            } else {
                                echo "Invalid username or password.";
                            }

                            // Clean up
                            mysqli_stmt_close($stmt);
                        }
                        ?>
                    </div>

                    <div class="flip-card__back">
                        <div class="title">Sign up</div>
                        <form class="flip-card__form" action="login.php" method="post">
                            <input class="flip-card__input" name="SignUpUsername" placeholder="Name" type="text"
                                required>
                            <input class="flip-card__input" name="SignUpPassword" placeholder="Password" type="password"
                                required>
                            <button class="flip-card__btn" name="signup">Sign Up</button>

                            <?php
                            if (isset($_POST['signup'])) {
                                $username = filter_input(INPUT_POST, 'SignUpUsername', FILTER_SANITIZE_STRING);
                                $password = filter_input(INPUT_POST, 'SignUpPassword', FILTER_SANITIZE_STRING);

                                // Hash the password before storing
                                $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                                // Debugging: Check if the password is hashed
                                if ($hashed_password === false) {
                                    die('Password hashing failed.');
                                }

                                // Debugging: Output the hashed password
                                echo "Hashed Password: " . htmlspecialchars($hashed_password) . "<br>";

                                // Insert the username and hashed password into the database
                                $sql = "INSERT INTO user (user_name, user_password) VALUES (?, ?)";
                                $stmt = mysqli_prepare($conn, $sql);

                                if ($stmt === false) {
                                    die('MySQL Prepare Statement Error: ' . mysqli_error($conn));
                                }

                                // Bind parameters and execute the statement
                                mysqli_stmt_bind_param($stmt, 'ss', $username, $hashed_password);
                                $execute_result = mysqli_stmt_execute($stmt);

                                // Debugging: Check if the statement executed successfully
                                if ($execute_result === false) {
                                    die('MySQL Execute Statement Error: ' . mysqli_stmt_error($stmt));
                                }

                                if (mysqli_stmt_affected_rows($stmt) > 0) {
                                    echo "Signup successful!";
                                } else {
                                    echo "Signup failed.";
                                }

                                // Clean up
                                mysqli_stmt_close($stmt);
                            }
                            ?>
                        </form>
                    </div>
                </div>
            </label>
        </div>
    </div>
</body>

</html>