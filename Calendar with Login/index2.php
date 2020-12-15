<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Login System</title>
    <link rel="stylesheet" href="./css/index.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.css">
</head>
<body>
    <nav>
        <p>WAVE</p>
        <div class="show-desktop">
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>

                <?php
                    if(isset($_SESSION['userId'])){
                        echo '  <li>
                                <form action="includes/logout.inc.php" method="POST">
                                    <button class="logoutBtn">Logout</button>
                                </form>
                                </l>';
                    }
                    else{
                        echo '<li><a href="login.php"><i class="fas fa-user"></i></a></li>';
                    }
                ?>

                
                
            </ul>
        </div>


        <!-- MOBILE VIEW -->
        <!-- <div class="menu-wrap hide-desktop">
            <input type="checkbox" class="toggler">
            <div class="hamburger"><div></div></div>
            <div class="menu">
                <div>
                    <div>
                        <ul>
                            <li><a href="#">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- MOBILE VIEW -->
    </nav>

    <div class="loginStatus">
        <?php
        
            if(isset($_SESSION['userId'])){
                echo '<p id="login">You are Logged In</p>';
            }
            else{
                echo '<p id="logout">You are Logged Out</p>';
            }
        ?>
        
    </div>
</body>
</html>




   
