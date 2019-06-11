<?php
session_start();
require_once "./includes/functions.php";
if(!auth()){
    header('location:./login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Home</title>
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
                    <div class="col-lg-2 p-0">
                        <i class="fa fa-trash"></i>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus, nostrum perspiciatis
                        dicta assumenda quos atque expedita officiis! Nulla neque eius incidunt excepturi sint
                        sapiente? Ullam omnis fuga reiciendis suscipit molestias.
                    </div>
                    <div class="col-lg-8 p-0">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col">
                                    <?php include "./includes/post-update.php"; ?>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col">
                                    <div class="posts-container">
                                        <?php include "./includes/post-item.php"; ?>
                                        <?php include "./includes/post-item.php"; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 p-0">
                        <?php include "./includes/chat-section.php"; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<!-- <script>
$(document).ready(function() {
    if (window.File && window.FileList && window.FileReader) {
        $("#files").on("change", function(e) {
            var files = e.target.files,
                filesLength = files.length;
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result +
                        "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\"><button type=\"button\" class=\"btn btn-sm\"><i class=\"fa fa-trash\"></i> Remove</button></span>" +
                        "</span>").insertAfter("#preview");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });
                });
                fileReader.readAsDataURL(f);
            }
        });
    } else {
        alert("Your browser doesn't support to File API")
    }
});
</script> -->

</html>