@extends('menu_app')
@extends('home2')
@section('content')
<META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
  <!-- Horizontal Form -->
  <div class="card card-info">
    <div class="card-header">
        <div class="card-title">訂餐菜單</div>
    </div>
    <!-- /.card-header -->
            <div class="card-body">
              <table id="example2" class="table table-bordered table-hover">
                <tr>
                  <th>類型</th>
                  <th>廠區</th>
                  <th>餐別</th>
                  <th>廠商</th>
                  <th>類別</th>
                  <th>金額</th>
                  <th>動作</th>
                </tr>
                <tr v-for="order_menu in order_menus">
                  <td>@{{ order_menu.menu_type }}</td>
                  <td>@{{ order_menu.menu_plant }}</td>
                  <td>@{{ order_menu.menu_meal }}</td>
                  <td>@{{ order_menu.menu_restaurant }}</td> 
                  <td>@{{ order_menu.menu_item }}</td>
                  <td>@{{ order_menu.menu_money }}</td>
                  <td>
                    <button class="edit-modal btn btn-warning" @click.prevent="editnote(order_menu)">
                      <span class="glyphicon glyphicon-edit"></span> 修改
                    </button>
                      <button class="edit-modal btn btn-danger" @click.prevent="deletenote(order_menu)">
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
                      <h4 class="modal-title" id="myModalLabel">新增訂餐菜單</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createnote">
                        <div class="form-group">
                          <label for="menu_type">類型:</label>
                          <select name="menu_type" class="form-control" v-model="newnote.menu_type">
                              　<option value="公司" selected>公司</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="menu_plant">廠區:</label>
                          <select name="menu_plant" class="form-control" v-model="newnote.menu_plant">
                              　<option value="新化" selected>新化</option>
                              　<option value="善化">善化</option>
                          </select>
                          <span v-if="formErrors['menu_plant']" class="error text-danger">
                            @{{ formErrors['menu_plant'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="menu_meal">餐別:</label>
                          <select name="menu_meal" class="form-control" v-model="newnote.menu_meal">
                              　<option value="午餐" selected>午餐</option>
                              　<option value="晚餐">晚餐</option>
                          </select>                                
                          <span v-if="formErrors['menu_meal']" class="error text-danger">
                            @{{ formErrors['menu_meal'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="menu_restaurant">廠商:</label>
                          <select name="menu_restaurant" class="form-control" v-model="newnote.menu_restaurant">
                            　<option value="訂餐順序" selected>訂餐順序</option>
                          </select>
                          <span v-if="formErrors['menu_restaurant']" class="error text-danger">
                            @{{ formErrors['menu_restaurant'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="menu_item">類別:</label>
                          <input type="text" name="menu_item" class="form-control" v-model="newnote.menu_item" />
                          <span v-if="formErrors['menu_item']" class="error text-danger">
                            @{{ formErrors['menu_item'] }}
                          </span>
                        </div>
                        <div class="form-group">
                          <label for="menu_money">金額:</label>
                          <input type="text" name="menu_money" class="form-control" v-model="newnote.menu_money" />
                          <span v-if="formErrors['menu_money']" class="error text-danger">
                            @{{ formErrors['menu_money'] }}
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
                      <h4 class="modal-title" id="myModalLabel">修改訂餐菜單</h4>
                    </div>
                    <div class="modal-body">
                      <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                        <div class="form-group">
                          <label for="menu_type">類型:</label>
                          <select name="menu_type" class="form-control" v-model="fillnote.menu_type" disabled>
                              　<option value="公司">公司</option>
                          </select>
                          <span v-if="formErrorsUpdate['menu_type']" class="error text-danger">
                            @{{ formErrorsUpdate['menu_type'] }}
                          </span>
                        </div>
                          <div class="form-group">
                            <label for="menu_plant">廠區:</label>
                            <select name="menu_plant" class="form-control" v-model="fillnote.menu_plant">
                                　<option value="新化">新化</option>
                                　<option value="善化">善化</option>
                            </select>
                            <span v-if="formErrors['menu_plant']" class="error text-danger">
                              @{{ formErrors['menu_plant'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="menu_meal">餐別:</label>
                            <select name="menu_meal" class="form-control" v-model="fillnote.menu_meal">
                                　<option value="午餐">午餐</option>
                                　<option value="晚餐">晚餐</option>
                            </select>                                
                            <span v-if="formErrors['menu_meal']" class="error text-danger">
                              @{{ formErrors['menu_meal'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="menu_restaurant">廠商:</label>
                            <input type="text" name="menu_restaurant" class="form-control" v-model="fillnote.menu_restaurant" disabled/>
                            <span v-if="formErrors['menu_restaurant']" class="error text-danger">
                              @{{ formErrors['menu_restaurant'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="menu_item">類別:</label>
                            <input type="text" name="menu_item" class="form-control" v-model="fillnote.menu_item" />
                            <span v-if="formErrors['menu_item']" class="error text-danger">
                              @{{ formErrors['menu_item'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="menu_money">金額:</label>
                            <input type="text" name="menu_money" class="form-control" v-model="fillnote.menu_money" />
                            <span v-if="formErrors['menu_money']" class="error text-danger">
                              @{{ formErrors['menu_money'] }}
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