  <?php

    session_start();

    if (!isset($_SESSION['userId'])) {
        header('Location: login.php');
        exit();
    }


    $username = $_SESSION['username'];
    

    ?>



  <!DOCTYPE html>
  <html lang="en">

  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Document</title>
      <link rel="stylesheet" href="css/style.css">
  </head>

  <body>

      <section>
          <header>
              <div style="display: flex;align-items: center; gap: 8px;" class="scoreLeaderDiv">
                  <h5 class="username" style="font-size: 16px; color: white;text-transform: uppercase;"><?php echo ($username) ?></h5>
                  <div class="line">|</div>
                  <div style="font-size: 16px;" class="scoreDiv">

                      <h3 class="score">score:</h3>
                      <h3 class="scoreNumber">0</h3>
                  </div>
              </div>



              <div class="loginDiv">


                  <?php if ($username !== ''): ?>

                      <div style="display: flex; color: white; gap:8px; align-items: center;" class="logoutDiv">


                          <a class="leaderHref""  href="leaderboard.php">Leaderboard</a>
                        


                          <div class="line">|</div>
                          <a class="logoutText" href="logout.php">Déconnexion</a>
                      </div>


                  <?php else: ?>

                      <div class="btnDiv">
                          <a class="loginText" href="register.php">se conecter</a>
                      </div>

                  <?php endif; ?>


              </div>
          </header>
          <div class="lettersSection">
              <div class="letters"></div>
          </div>


          <div class="inputDiv">
              
              <div class="inputBorder">
                  <input placeholder="motus" style="padding: 0 16px;" class="input" type="text">
                  <input style="border: 0px solid white;" class="ok" type="submit" value="OK">
              </div>
              <div style="height: 12px;">
                  <p></p>
              </div>

          </div>


      </section>

      

      <script src="js/script.js"></script>
  </body>

  </html>