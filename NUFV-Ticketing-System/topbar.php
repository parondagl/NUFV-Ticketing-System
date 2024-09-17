<nav class="navbar sticky-top navbar-light" style="height: 60px; background-color: #34418e;">
    <ul class="navbar-nav" style="margin-left: 1%;">
        <li class="nav-item" >
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <img src="NUFV Watermark.png" alt="Logo" style="height: 35px; margin-top: -1px;">
            </a>
        </li>
    </ul>

    <ul class="navbar-nav ml-auto" style="margin-right: 0%; margin-top: -5px;">
        <li class="nav-item dropdown">
            <a href="javascript:void(0)" class="brand-link dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                
                <span class="brand-image img-circle elevation-3 d-flex justify-content-center align-items-center bg-primary text-white font-weight-bold user-initials" style="width: 38px;height:50px">
                    <?php echo strtoupper(substr($_SESSION['login_firstname'], 0,1).substr($_SESSION['login_lastname'], 0,1)) ?>
                </span>
                
                
                <span class="brand-text user-name">
                    <?php echo ucwords($_SESSION['login_firstname'].' '.$_SESSION['login_lastname']) ?>
                </span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pushMenuDropdown" style="position: absolute; right: 100px;">
                <a class="dropdown-item" href="ajax.php?action=logout">Logout</a>
            </div>
        </li>
    </ul>
</nav>
