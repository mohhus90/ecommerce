<nav class="navbar navbar-expand-lg navbar-light bg-light"> <!-- //navbar navbar-dark bg-dark //navbar navbar-expand-lg navbar-light bg-light-->
  <div class="container">
    <a class="navbar-brand" href="#"><?php echo lang('home') ?></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#app-nav" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang('Category') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang('Items') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="member.php"><?php echo lang('Members') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang('Statistics') ?></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#"><?php echo lang('Logs') ?></a>
        </li>
        <li class="nav-item dropdown ">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            HUS
          </a>
          <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="member.php?do=edit&userid=<?php echo $_SESSION['ID'] ?>"><?php echo lang('Edit Profile') ?></a></li>
          <li><a class="dropdown-item" href="#"><?php echo lang('Setting') ?></a></li>
          <li><a class="dropdown-item" href="logout.php"><?php echo lang('Logout') ?></a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>