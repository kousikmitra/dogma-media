<div class="header-section fixed-top">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand mx-5 font-weight-bolder" href="./home.php">Dogma Media</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ml-auto mr-5 d-flex align-items-baseline">
                <li class="nav-item active">
                    <a class="nav-link font-weight-bold" href="./home.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <?php
                    $sql = "SELECT users.id AS 'USERID', users.username AS 'USERNAME', users.name AS 'NAME', profiles.profile_photo AS 'PROFILE_PHOTO' FROM users, profiles WHERE users.id = profiles.users_id AND users.id={$_SESSION['user_id']};";
                    $myprofile_info = $conn->query($sql);
                    $myprofile_info = $myprofile_info->fetch_assoc();
                    ?>
                    <a class="nav-link font-weight-bold" href="<?php echo "./profile.php?user_id=".$myprofile_info['USERID'] ?>">
                        <img src="<?php echo $myprofile_info['PROFILE_PHOTO'] ?>" class="profile-icon" alt=""> <?php echo $myprofile_info['NAME']; echo $_SESSION['user_id']; ?>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle font-weight-bold" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        More
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Messages</a>
                        <a class="dropdown-item" href="#">Change Password</a>
                        <a class="dropdown-item" href="#">Settings</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="./logout.php">Logout</a>
                        <a class="dropdown-item" href="#">Contact Us</a>
                        <a class="dropdown-item" href="#">Privacy Policy</a>
                    </div>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-primary my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
</div>