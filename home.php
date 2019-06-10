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
                                    <div class="card status-update-card"
                                        style="background-color:rgba(69, 128, 238, 0.2); border-color:rgb(219, 219, 226);">
                                        <div class="card-body">
                                            <h4 class="card-title">Want to share something?</h4>
                                            <div class="row">
                                                <div class="col">
                                                    <form class="form">
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="inputGroupFileAddon00">What
                                                                    is the title?</span>
                                                            </div>
                                                            <input type="text" name="title" id="title"
                                                                class="form-control" placeholder=""
                                                                aria-describedby="inputGroupFileAddon00">
                                                        </div>

                                                        <div class="form-group mt-3">
                                                            <!-- <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupFileAddon01">Want
                                                                    to share something?</span>
                                                            </div> -->
                                                            <textarea name="status" id="status" class="form-control"
                                                                placeholder="Write your thoughts here!"
                                                                aria-describedby="inputGroupFileAddon01"></textarea>

                                                        </div>
                                                        <div class="input-group">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"
                                                                    id="inputGroupFileAddon02">Want
                                                                    to show something?</span>
                                                            </div>
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input" id="files"
                                                                    name="files[]"
                                                                    aria-describedby="inputGroupFileAddon02" multiple>
                                                                <label class="custom-file-label" for="files">Choose
                                                                    file</label>
                                                            </div>
                                                        </div>
                                                        <div id="preview"></div>
                                                        <div class="input-group-lg">
                                                            <input type="submit" class="btn btn-primary w-100 mt-3"
                                                                value="Let's Post This!">
                                                        </div>

                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
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

<script>
    $(document).ready(function () {
        if (window.File && window.FileList && window.FileReader) {
            $("#files").on("change", function (e) {
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function (e) {
                        var file = e.target;
                        $("<span class=\"pip\">" +
                            "<img class=\"imageThumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                            "<br/><span class=\"remove\"><button type=\"button\" class=\"btn btn-sm\"><i class=\"fa fa-trash\"></i> Remove</button></span>" +
                            "</span>").insertAfter("#preview");
                        $(".remove").click(function () {
                            $(this).parent(".pip").remove();
                        });
                    });
                    fileReader.readAsDataURL(f);
                }
            });
        } else {
            alert("Your browser doesn't support to File API")
        }
    });</script>

</html>