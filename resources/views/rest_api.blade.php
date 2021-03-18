@extends('rest_app')
@extends('home2')
@section('content')
<META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
        <div class="card-title">店家維護</div>
    </div>
    <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <tr>
                  <th>類型</th>
                  <th>廠區</th>
                  <th>餐別</th>
                  <th>店家名稱</th>
                  <th>店家logo圖</th>
                  <th>店家菜單圖</th>
                  <th>店家電話</th>
                  <th>店家住址</th>
                  <th>動作</th>
                </tr>
                <tr v-for="restaurant in restaurants">
                  <td>@{{ restaurant.restaurant_type }}</td>
                  <td>@{{ restaurant.restaurant_plant }}</td>
                  <td>@{{ restaurant.restaurant_meal }}</td>
                  <td>@{{ restaurant.restaurant_name }}</td> 
                  <td>@{{ restaurant.restaurant_logo }}</td>
                  <td>@{{ restaurant.restaurant_menu }}</td>
                  <td>@{{ restaurant.restaurant_phone }}</td>
                  <td>@{{ restaurant.restaurant_address }}</td>                  
                  <td>
                    <button class="edit-modal btn btn-warning" @click.prevent="editnote(restaurant)">
                      <span class="glyphicon glyphicon-edit"></span> 修改
                    </button>
                      <button class="edit-modal btn btn-danger" @click.prevent="deletenote(restaurant)">
                      <span class="glyphicon glyphicon-trash"></span> 刪除
                    </button>
                  </td>
                  <td>
                    <!-- 上傳圖片 -->
                   
                    <form class="form-horizontal" role="form" method="POST" action="upload" enctype="multipart/form-data">
                      @{{ restaurant.id }}
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
                      <h4 class="modal-title" id="myModalLabel">新增店家資訊</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createnote">
                        <div class="form-group">
                          <label for="restaurant_type">類型:</label>
                          <select name="restaurant_type" class="form-control" v-model="newnote.restaurant_type">
                              　<option value="自付" selected>自付</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="restaurant_plant">廠區:</label>
                          <select name="restaurant_plant" class="form-control" v-model="newnote.restaurant_plant">
                              　<option value="新化" selected>新化</option>
                              　<option value="善化">善化</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="restaurant_meal">餐別:</label>
                          <select name="restaurant_meal" class="form-control" v-model="newnote.restaurant_meal">
                              　<option value="午餐" selected>午餐</option>
                              　<option value="晚餐">晚餐</option>
                          </select>                                
                        </div>
                        <div class="form-group">
                          <label for="restaurant_name">店家名稱:</label>
                          <input type="text" name="restaurant_name" class="form-control" v-model="newnote.restaurant_name" />
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
                      <h4 class="modal-title" id="myModalLabel">修改店家資訊</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                        <div class="form-group">
                            <label for="restaurant_type">類型:</label>
                            <select name="restaurant_type" class="form-control" v-model="fillnote.restaurant_type" disabled>
                                　<option value="自付">自付</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="restaurant_plant">廠區:</label>
                            <select name="restaurant_plant" class="form-control" v-model="fillnote.restaurant_plant">
                                　<option value="新化">新化</option>
                                　<option value="善化">善化</option>
                            </select>
                          </div>
                          <div class="form-group">
                            <label for="restaurant_meal">餐別:</label>
                            <select name="restaurant_meal" class="form-control" v-model="fillnote.restaurant_meal">
                                　<option value="午餐">午餐</option>
                                　<option value="晚餐">晚餐</option>
                            </select>                                
                          </div>                        
                          <div class="form-group">
                            <label for="restaurant_name">店家名稱:</label>
                            <input type="text" name="restaurant_name" class="form-control" v-model="fillnote.restaurant_name" />
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
        <!-- /.card-body -->
        <div class="card-footer">
        <button type="button" data-toggle="modal" data-target="#create-note" class="btn btn-info">
          新增
        </button>
        <!-- 回公司訂餐 -->
        <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
        </div>
        <!-- /.card-footer -->

    </div>
    <!-- /.card -->

  </div>
  <!-- /.Horizontal Form -->
       
@stop