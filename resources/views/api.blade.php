@extends('app')
@extends('home2')
@section('content')
<META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
          <div class="card-title">用餐意見</div>
      </div>
      <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover">
              <tr>
                <th>標題</th>
                <th>內容</th>
                <th>動作</th>
              </tr>
              <tr v-for="note in notes">
                <td>@{{ note.title }}</td>
                <td>@{{ note.content }}</td>
                <td>
                  <button class="edit-modal btn btn-warning" @click.prevent="editnote(note)">
                    <span class="glyphicon glyphicon-edit"></span> 修改
                  </button>
                  <button class="edit-modal btn btn-danger" @click.prevent="deletenote(note)">
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
                      <h4 class="modal-title" id="myModalLabel">新增留言</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createnote">
                        <div class="form-group">
                          <label for="title">標題:</label>
                          <input type="text" name="title" class="form-control" v-model="newnote.title" />
                          <span v-if="formErrors['title']" class="error text-danger">
                            @{{ formErrors['title'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="title">內容:</label>
                          <textarea name="content" class="form-control" v-model="newnote.content">
                          </textarea>
                          <span v-if="formErrors['content']" class="error text-danger">
                            @{{ formErrors['content'] }}
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
                      <h4 class="modal-title" id="myModalLabel">修改留言</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                        <div class="form-group">
                          <label for="title">標題:</label>
                          <input type="text" name="title" class="form-control" v-model="fillnote.title" />
                          <span v-if="formErrorsUpdate['title']" class="error text-danger">
                            @{{ formErrorsUpdate['title'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="title">內容:</label>
                          <textarea name="content" class="form-control" v-model="fillnote.content">
                          </textarea>
                          <span v-if="formErrorsUpdate['content']" class="error text-danger">
                            @{{ formErrorsUpdate['content'] }}
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
          <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
          </div>
          <!-- /.card-footer -->

      </div>
      <!-- /.card -->

    </div>
    <!-- /.Horizontal Form -->

       
@stop