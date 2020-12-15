<?php include('./includes/event.inc.php') ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Calendar</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css"/>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet"/>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.css">
    <link rel="stylesheet" href="css/index.css">

    
  </head>
  <body>
      <nav>
        <p class="name">Calender</p>
        <div class="show-desktop">
            <ul>
                
                <?php
                    if(isset($_SESSION['userId'])){
                        echo '  <li>
                                <form action="includes/logout.inc.php" method="POST">
                                    <button class="logoutBtn">Logout</button>
                                </form>
                                </l>';
                    }
                    else{
                        echo '<li><a href="login.php">Login <i class="fas fa-user"></i></a></li>';
                    }
                ?>   

            </ul>
        </div>
      </nav>

    <div class="container-All">
      <div class="sideBar">
        <div class="year">
          <i class="fas fa-angle-left prevYear"></i>
          <span></span>
          <i class="fas fa-angle-right nextYear"></i>
        </div>
        <div class="monthsSideBar">

        </div>
      </div>

      <div class="calendar">
        <div class="month">
          <i class="fas fa-angle-left prev"></i>
          <div class="date">
            <div class="month-Year">
              <h1 class="currentMonth"></h1>
            </div>
            <p></p>
          </div>
          <i class="fas fa-angle-right next"></i>
        </div>

        <div class="weekdays">
          <div>Sun</div>
          <div>Mon</div>
          <div>Tue</div>
          <div>Wed</div>
          <div>Thu</div>
          <div>Fri</div>
          <div>Sat</div>
        </div>

        <div class="days">

        </div>

      </div>

      <div class="eventsTab">
        <div class="eventDate">
          <h1></h1>
          <p align='center'></p>
        </div>
        <div class="eventTitle">
          <h3>

            <?php   
                if(isset($event_found)){
                    echo $event_name;
                } else {
                  echo 'No Event Found';
                }
            ?>
          
          </h3>
          <div class="eventDesc">
            <i class="fas fa-circle"></i>
            <p>

              <?php 
              if(isset($event_found)){
                echo $event_desc;
              }
              ?>
            
            </p>
          </div>
        </div>

        <?php if($is_loggedin) {
          echo '<div class="addEventBtn">
          <button type="button" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus-circle"></i></button>
          </div>';
          } else {
            echo '<p align="center" id="loginToAdd"> Login to add event </p>';
          }
        ?>
        
      </div>

    </div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" font-size="5rem">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Event</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form class="form-group" id="event-form">
              <label for="event-name">Event Name</label>
              <input type="text" name="" id="event-name" placeholder="Event Name">
              <label for="event-desc">Event Description</label>
              <input type="text" name="" id="event-desc" placeholder="Event Description">
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="event-add">Add Event</button>
          </div>
        </div>
      </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="javascript/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-sweetalert/1.0.1/sweetalert.min.js"></script>
  </body>
</html>
