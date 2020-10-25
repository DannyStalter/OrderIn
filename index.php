<?php
include_once 'header.php';
?>



    <!-- Welcome Box -->

    <div class="flexbox-container">

      <div class="flex-welcomeHeading">
        <div class="flexbox-item flexbox-welcome-1">
          <h1 class="welcome-1-heading">Welcome to Order In!</h1>
        </div>
      </div>

      <div class="flexbox-item flexbox-welcome-2">
        <div class="button-container">
          <img id="cutting-board" src="images/cuttingboard.jpg" alt="cutting-board">
          <button type="button" onclick="location.href='login.php';" class="btn btn-light btn-lg login-button-home">Login</button>
          <button type="button" onclick="location.href='signup.php';" class="btn btn-light btn-lg search-button" </i>Sign Up</button>
        </div>
      </div>

    </div>

    <footer class="white-section" id="footer">

      <div class="flexbox-container">
        <i class="fab fa-twitter footer-icons"></i>
        <i class="fab fa-facebook-f footer-icons"></i>
        <i class="fab fa-instagram footer-icons"></i>
        <i class="fas fa-envelope footer-icons"></i>

        <p id="copyright">© Copyright 2020 Group 2</p>
      </div>

    </footer>

</body>

</html>
