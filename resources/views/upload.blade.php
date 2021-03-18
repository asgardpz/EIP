<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">文件上传</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="file" id="file" name="file">
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                   上傳
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>