<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>My Profile</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <style>
    </style>
</head>

<body>
    <div class="container-main">
        <?php include_once "./includes/header.php"; ?>
        <div class="main" style="margin-top:15vh;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-2">
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Odio nemo nisi, laudantium corporis deleniti quasi labore quisquam hic voluptas blanditiis cumque excepturi? Error recusandae quidem assumenda aliquam quas dolor autem!
                    </div>
                    <div class="col-7 ml-5">
                        <div class="container-fluid" style="background:background: rgba(238, 236, 236, 0.705);">
                            <div class="row">
                                <div class="col">
                                    <div class="row">
                                        <div class="col-3 text-center">
                                            <img src="./images/profile-icon.png" alt="" class="profile-photo rounded-circle">
                                        </div>
                                        <div class="col-9">
                                            <div class="row mt-4">
                                                <div class="col-8">
                                                    <h1 class="full-name">Hello World</h1>
                                                    <h5 class="user-name">my-user-name</h5>
                                                    <p class="work mt-3">I do this.</p>
                                                    <p class="address mt-1"> <i class="fa fa-map-marker"></i> Hello, This is my address</p>
                                                </div>
                                                <div class="col-4">
                                                    <a href="" class="btn btn-primary float-right">Send Message</a>
                                                </div>
                                            </div>
                                            <div class="row mt-5">
                                                    <div class="col-2"></div>
                                                    <div class="col-10">
                                                        <div class="row">
                                                            <div class="col">
                                                                <a href="" class="btn btn-outline-dark w-100">Followers 
                                                                    <span class="badge badge-primary">100</span>
                                                                </a>
                                                            </div>
                                                            <div class="col">
                                                            <a href="" class="btn btn-outline-dark w-100">Foolowing
                                                            <span class="badge badge-primary">100</span>
                                                            </a>
                                                            </div>
                                                            <div class="col-5">
                                                            <a href="" class="btn btn-primary w-100 fa"> Follow</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                        <div class="profile-tabs mt-3 mb-3">
                                        <ul class="nav nav-tabs justify-content-around" role="tablist">
                                                <li class="nav-item w-25">
                                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab">Thoughts</a>
                                                </li>
                                                <li class="nav-item w-25">
                                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab">About</a>
                                                </li>
                                                <li class="nav-item w-25">
                                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab">Photos</a>
                                                </li>
                                            </ul>
                                        </div>    
                                        <!-- Tab panes -->
                                            <div class="tab-content tab-page">
                                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                                    <p>First Panel</p>
                                                </div>
                                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                                    <p>Second Panel</p>
                                                </div>
                                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                                    <p>Third Panel</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-2">
                        <?php include "./includes/chat-section.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>