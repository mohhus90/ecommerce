<nav class="navbar navbar-inverse" > <!--  navbar navbar-inverse /// navbar navbar-expand-lg navbar-dark bg-dark -->
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php">Home</a>
    </div>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
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
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['username']?> <span class="caret"></span></a>
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