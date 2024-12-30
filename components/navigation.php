<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>

<div class="container">
  <header class="d-flex flex-wrap justify-content-between w-100 py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-body-emphasis text-decoration-none">
      <svg class="bi me-2" width="40" height="32">
        <use xlink:href="#bootstrap"></use>
      </svg>
      <span class="fs-4">Tes Kepribadian</span>
    </a>

    <ul class="nav nav-pills">
      <li class="nav-item"><a href="index.php" class="nav-link  <?php echo ($current_page == 'index.php') ? 'active text-light' : 'text-primary-emphasis'; ?>">Home</a></li>
      <li class="nav-item"><a href="jenis.php" class="nav-link  <?php echo ($current_page == 'jenis.php') ? 'active text-light' : 'text-primary-emphasis'; ?>">Jenis Kepribadian</a></li>
      <!-- <li class="nav-item"><a href="#" class="nav-link">Pricing</a></li> -->
      <!-- <li class="nav-item"><a href="#" class="nav-link">FAQs</a></li> -->
      <!-- <li class="nav-item"><a href="#" class="nav-link">About</a></li> -->

    </ul>
    <?php if (isset($_SESSION['user'])) : 
      $user = $_SESSION['user'];
      ?>
      <div class="col-md-5 d-flex text-end align-self-end justify-content-end">
        <div class="dropdown text-end">
          <div class="d-block link-body-emphasis text-decoration-none dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
              <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg>
          </div>
          <ul class="dropdown-menu text-small" style="">
            <li><a class="dropdown-item" href="hasil_db.php">hasil</a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="#"><?=$user['name'];?></a></li>
            <li><a class="dropdown-item" href="#"><?=$user['email'];?></a></li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
          </ul>
        </div>
      </div>
    <?php else: ?>
      <div class="col-md-5 d-flex text-end align-self-end justify-content-end">
        <a href="login.php"><button type="button" class="btn btn-outline-primary me-2">Login</button></a>
        <a href="register.php"><button type="button" class="btn btn-primary">Sign-up</button></a>
      </div>
    <?php endif; ?>
  </header>
</div>