@extends('pw_app')
@extends('home2')
@section('content')
<META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
          <div class="card-title">密碼重設</div>
      </div>
      <!-- /.card-header -->

          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <tr>
                <th>工號</th>
                <th>姓名</th>
                <th>動作</th>
              </tr>
              <tr v-for="user in users">
                <td>@{{ user.jobid }}</td>
                <td>@{{ user.name }}</td>
                <td>
                  <button class="edit-modal btn btn-warning" @click.prevent="editnote(user)">
                    <span class="glyphicon glyphicon-edit"></span> 重設
                  </button>
                </td>
              </tr>
              </table>
              <nav>
                <ul class="pagination">
                  <li v-if="pagination.current_page > 1">
                    <a href="#" aria-label="Previous" @click.prevent="changePage(pagination.current_page - 1)">
                      <span aria-hidden="true">«</span>
                    </a>
                  </li>
                  <li v-for="page in pagesNumber" v-bind:class="[ page == isActived ? 'active' : '']">
                    <a href="#" @click.prevent="changePage(page)">
                      @{{ page }}
                    </a>
                  </li>
                  <li v-if="pagination.current_page < pagination.last_page">
                    <a href="#" aria-label="Next" @click.prevent="changePage(pagination.current_page + 1)">
                      <span aria-hidden="true">»</span>
                    </a>
                  </li>
                </ul>
              </nav>
              <!-- 修改對話框 -->
              <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">重設密碼</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                        <div class="form-group">
                          <label for="title">密碼:</label>
                          <input type="text" name="password" class="form-control" v-model="fillnote.password" onfocus="cleartext(this)" />
                          <script type="text/javascript">
                            function cleartext (id){
                                      //清除文字
                                      id.value ="";
                                      }
                            </script>
                          <span v-if="formErrorsUpdate['password']" class="error text-danger">
                            @{{ formErrorsUpdate['password'] }}
                          </span>
                        </div>                    
                        <div class="form-group">
                          <button type="submit" class="btn btn-success">儲存</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>               
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
          <button type="button" data-toggle="modal" data-target="#create-note" class="btn btn-info">
            新增
          </button>
          <a href="{{ url('home') }}" class="btn btn-default float-right">回首頁</a>
          </div>
          <!-- /.card-footer -->

      </div>
      <!-- /.card -->

    </div>
    <!-- /.Horizontal Form -->

       
@stop