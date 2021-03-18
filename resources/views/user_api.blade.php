@extends('user_app')
@extends('home2')
@section('content')
<META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
          <div class="card-title">帳號管理</div>
      </div>
      <!-- /.card-header -->

          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <tr>
                <th>工號</th>
                <th>姓名</th>
                <th>權限</th>
                <th>動作</th>
              </tr>
              <tr v-for="user in users">
                <td>@{{ user.jobid }}</td>
                <td>@{{ user.name }}</td>
                <td>@{{ user.authority }}</td>
                <td>
                  <button class="edit-modal btn btn-warning" @click.prevent="editnote(user)">
                    <span class="glyphicon glyphicon-edit"></span> 修改
                  </button>
                  <button class="edit-modal btn btn-danger" @click.prevent="deletenote(user)">
                    <span class="glyphicon glyphicon-trash"></span> 刪除
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
              <!-- 新增對話框 -->
              <div class="modal fade" id="create-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">新增帳號</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createnote">
                        <div class="form-group">
                          <label for="title">工號:</label>
                          <input type="text" name="jobid" class="form-control" v-model="newnote.jobid" />
                          <span v-if="formErrors['jobid']" class="error text-danger">
                            @{{ formErrors['jobid'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="title">姓名:</label>
                          <input type="text" name="name" class="form-control" v-model="newnote.name" />
                          <span v-if="formErrors['name']" class="error text-danger">
                            @{{ formErrors['name'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="title">信箱:</label>
                          <input type="text" name="email" class="form-control" v-model="newnote.email" />
                          <span v-if="formErrors['email']" class="error text-danger">
                            @{{ formErrors['email'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="title">密碼:</label>
                          <input type="password" name="password" class="form-control" v-model="newnote.password" />
                          <span v-if="formErrors['password']" class="error text-danger">
                            @{{ formErrors['password'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="title">權限:</label>
                          <select name="authority" class="form-control" v-model="newnote.authority">
                            　  <option value="無" selected>無</option>                            
                              　<option value="公司">公司</option>
                              　<option value="自付">自付</option>
                                <option value="admin">admin</option>
                          </select>
                          <span v-if="formErrors['authority']" class="error text-danger">
                            @{{ formErrors['authority'] }}
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
              <!-- 修改對話框 -->
              <div class="modal fade" id="edit-note" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">權限</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                        <div class="form-group">
                          <label for="title">權限:</label>
                          <select name="authority" class="form-control" v-model="fillnote.authority" >
                            　  <option value="無">無</option>                            
                              　<option value="公司">公司</option>
                              　<option value="自付">自付</option>
                                <option value="admin">admin</option>
                          </select>
                          <span v-if="formErrorsUpdate['authority']" class="error text-danger">
                            @{{ formErrorsUpdate['authority'] }}
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