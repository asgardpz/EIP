@extends('inf_app')
@extends('home2')
@section('content')
<meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Horizontal Form -->
    <div class="card card-info">
      <div class="card-header">
          <div class="card-title">訂餐資訊</div>
      </div>
      <!-- /.card-header -->
              <div class="card-body">
                <table id="example2" class="table table-bordered table-hover">
                <tr>
                  <th>類型</th>
                  <th>廠區</th>
                  <th>餐別</th>
                  <th>訂餐時間</th>
                  <th>動作</th>
                </tr>
                <tr v-for="order_information in order_informations">
                  <td>@{{ order_information.inf_type }}</td>
                  <td>@{{ order_information.inf_plant }}</td>
                  <td>@{{ order_information.inf_meal }}</td>
                  <td>@{{ order_information.inf_time }}</td> 
                  <td>
                    <button class="edit-modal btn btn-warning" @click.prevent="editnote(order_information)">
                      <span class="glyphicon glyphicon-edit"></span> 修改
                    </button>
                    <!--
                    <button class="edit-modal btn btn-danger" @click.prevent="deletenote(order_information)">
                      <span class="glyphicon glyphicon-trash"></span> 刪除
                    </button>
                    -->
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
                        <h4 class="modal-title" id="myModalLabel">新增訂餐資訊</h4>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="createnote">
                          <div class="form-group">
                            <label for="inf_type">類型:</label>
                            <input type="text" name="inf_type" class="form-control" v-model="newnote.inf_type" />
                            <span v-if="formErrors['inf_type']" class="error text-danger">
                              @{{ formErrors['inf_type'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_plant">廠區:</label>
                            <input type="text" name="inf_plant" class="form-control" v-model="newnote.inf_plant" />
                            <span v-if="formErrors['inf_plant']" class="error text-danger">
                              @{{ formErrors['inf_plant'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_meal">餐別:</label>
                            <input type="text" name="inf_meal" class="form-control" v-model="newnote.inf_meal" />
                            <span v-if="formErrors['inf_meal']" class="error text-danger">
                              @{{ formErrors['inf_meal'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_time">訂餐時間:</label>
                            <input type="text" name="inf_time" class="form-control" v-model="newnote.inf_time" />
                            <span v-if="formErrors['inf_time']" class="error text-danger">
                              @{{ formErrors['inf_time'] }}
                            </span>
                          </div> 
                          <div class="form-group">
                            <label for="inf_1">順序1:</label>
                            <input type="text" name="inf_1" class="form-control" v-model="newnote.inf_1" />
                            <span v-if="formErrors['inf_1']" class="error text-danger">
                              @{{ formErrors['inf_1'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_2">順序2:</label>
                            <input type="text" name="inf_2" class="form-control" v-model="newnote.inf_2" />
                            <span v-if="formErrors['inf_2']" class="error text-danger">
                              @{{ formErrors['inf_2'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_3">順序3:</label>
                            <input type="text" name="inf_3" class="form-control" v-model="newnote.inf_3" />
                            <span v-if="formErrors['inf_3']" class="error text-danger">
                              @{{ formErrors['inf_3'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_4">順序4:</label>
                            <input type="text" name="inf_4" class="form-control" v-model="newnote.inf_4" />
                            <span v-if="formErrors['inf_4']" class="error text-danger">
                              @{{ formErrors['inf_4'] }}
                            </span>
                          </div>    
                          <div class="form-group">
                            <label for="inf_5">順序5:</label>
                            <input type="text" name="inf_5" class="form-control" v-model="newnote.inf_5" />
                            <span v-if="formErrors['inf_5']" class="error text-danger">
                              @{{ formErrors['inf_5'] }}
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
                        <h4 class="modal-title" id="myModalLabel">修改訂餐資訊</h4>
                      </div>
                      <div class="modal-body">
                        <form method="post" enctype="multipart/form-data" v-on:submit.prevent="updatenote(fillnote.id)">
                          <div class="form-group">
                            <label for="inf_time">訂餐時間:</label>
                            <select name="inf_time" class="form-control" v-model="fillnote.inf_time">
                              　<option value="8">8</option>
                              　<option value="9">9</option>
                              　<option value="10">10</option>
                              　<option value="11">11</option>
                              　<option value="12">12</option>
                              　<option value="13">13</option>
                              　<option value="14">14</option>
                              　<option value="15">15</option>
                              　<option value="16">16</option>
                              　<option value="17">17</option>
                              　<option value="18">18</option>
                              　<option value="19">19</option>
                              　<option value="20">20</option>
                              　<option value="21">21</option>
                              　<option value="22">22</option>
                            </select>
                            <span v-if="formErrorsUpdate['inf_time']" class="error text-danger">
                              @{{ formErrorsUpdate['inf_time'] }}
                            </span>
                          </div>    
                          <div class="form-group">
                            <label for="inf_1">葷廠商</label>
                            <select name="iinf_1" class="form-control" v-model="fillnote.inf_1">
                              　<option value="客樂 06-5901605">客樂 06-5901605</option>
                              　<option value="猋師傅 06-5970852">猋師傅 06-5970852</option>
                              　<option value="阡福町 06-2042855">阡福町 06-2042855</option>
                              　<option value="圓法 06-5983432">圓法 06-5983432</option>
                              　<option value="大廟口06-5909810">大廟口06-5909810</option>
                            </select>                              
                            <span v-if="formErrorsUpdate['inf_1']" class="error text-danger">
                              @{{ formErrorsUpdate['inf_1'] }}
                            </span>
                          </div>
                          <div class="form-group">
                            <label for="inf_2">素廠商</label>
                            <select name="iinf_2" class="form-control" v-model="fillnote.inf_2">
                              　<option value="客樂 06-5901605">客樂 06-5901605</option>
                              　<option value="猋師傅 06-5970852">猋師傅 06-5970852</option>
                              　<option value="阡福町 06-2042855">阡福町 06-2042855</option>
                              　<option value="圓法 06-5983432">圓法 06-5983432</option>
                              　<option value="大廟口06-5909810">大廟口06-5909810</option>
                            </select>                              

                              @{{ formErrorsUpdate['inf_2'] }}
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
          <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
          </div>
          <!-- /.card-footer -->
      </div>
      <!-- /.card -->

    </div>
    <!-- /.Horizontal Form -->
       
@stop