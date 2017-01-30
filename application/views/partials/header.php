<nav class="light-blue lighten-1" roleId="navigation">
  <div class="nav-wrapper container"><a id="logo-container" href=<?php echo "'".STARTPATH."/home'"; ?> class="brand-logo">Ticketshop</a>
    <ul class="right hide-on-med-and-down">
      <?php      
      // Sets the correct nav-menue-buttons for the roleIds.
      if(isset($_SESSION['roleId']))
      {
        if($_SESSION['roleId'] == 1)
        { // Veranstalter
        ?>
        <li><a href=<?php echo "'".STARTPATH."/new'"; ?>><i class="material-icons left">add</i>Neu</a></li>
        <li><a href=<?php echo "'".STARTPATH."/overview'"; ?>><i class="material-icons left">apps</i>Übersicht</a></li>
        <?php
        } else { // Kunde
        ?>
        <li><a href="#"><i class="material-icons left">whatshot</i>Heiss</a></li>
        <li><a href="#"><i class="material-icons left">receipt</i>Tickets</a></li>
        <?php  
        } // Common
        ?>
        <li><a href=<?php echo "'".STARTPATH."/profile'"; ?>><i class="material-icons left">person</i>Profil</a></li>
        <li><a href="#" class="nav-logout"><i class="material-icons left">exit_to_app</i>Ausloggen</a></li>
      <?php }
      else
      { // Nicht eingeloggt.
      ?>
      <li><a href="#"><i class="material-icons left">whatshot</i>Heiss</a></li>
      <li><a href="#"><i class="material-icons left">info_outline</i>Über</a></li>
      <li><a href="#" class="nav-login"><i class="material-icons left">person_outline</i>Login</a></li>
      <?php
      }
      ?>
    </ul>
    <ul id="nav-mobile" class="side-nav">
      <?php      
      // Sets the correct nav-menue-buttons for the roleIds.
      if(isset($_SESSION['roleId']))
      {
        if($_SESSION['roleId'] == 1)
        { // Veranstalter
        ?>
        <li><a href=<?php echo "'".STARTPATH."/new'"; ?>><i class="material-icons left">add</i>Neu</a></li>
        <li><a href=<?php echo "'".STARTPATH."/overview'"; ?>><i class="material-icons left">apps</i>Übersicht</a></li>
        <?php
        } else { // Kunde
        ?>
        <li><a href="#"><i class="material-icons left">whatshot</i>Heiss</a></li>
        <li><a href="#"><i class="material-icons left">receipt</i>Tickets</a></li>
        <?php  
        } // Common
        ?>
        <li><a href=<?php echo "'".STARTPATH."/profile'"; ?>><i class="material-icons left">person</i>Profil</a></li>
        <li><a href="#" class="nav-logout"><i class="material-icons left">exit_to_app</i>Ausloggen</a></li>
      <?php }
      else
      { // Nicht eingeloggt.
      ?>
      <li><a href="#"><i class="material-icons left">whatshot</i>Heiss</a></li>
      <li><a href="#"><i class="material-icons left">info_outline</i>Über</a></li>
      <li><a href="#" class="nav-login"><i class="material-icons left">person_outline</i>Login</a></li>
      <?php
      }
      ?>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
  </div>
</nav>
<div class="container">