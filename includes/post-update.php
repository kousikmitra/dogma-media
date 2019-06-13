<div class="post-update card status-update-card"
    style="background-color:rgba(69, 128, 238, 0.2); border-color:rgb(219, 219, 226);">
    <div class="card-body">
        <h4 class="card-title">Want to share something?</h4>
        <div class="row">
            <div class="col">
                <form class="form" name="post_update"  method="post" enctype="multipart/form-data" action="./post_script.php">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon00">What
                                is the title?</span>
                        </div>
                        <input type="text" name="post_title" id="title" class="form-control" placeholder=""
                            aria-describedby="inputGroupFileAddon00" autocomplete="off">
                    </div>

                    <div class="form-group mt-3">
                        <!-- <div class="input-group-prepend">
                                                                <span class="input-group-text" id="inputGroupFileAddon01">Want
                                                                    to share something?</span>
                                                            </div> -->
                        <textarea name="post_data" id="status" class="form-control" placeholder="Write your thoughts here!"
                            aria-describedby="inputGroupFileAddon01"></textarea>

                    </div>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="inputGroupFileAddon02">Want
                                to show something?</span>
                        </div>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="files" name="files[]"
                                aria-describedby="inputGroupFileAddon02" multiple="multiple">
                            <label class="custom-file-label" for="files">Choose
                                file</label>
                        </div>
                    </div>
                    <div id="preview"></div>
                    <div class="input-group-lg">
                        <input type="submit" class="btn btn-primary w-100 mt-3" name="post" value="Let's Post This!">
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>