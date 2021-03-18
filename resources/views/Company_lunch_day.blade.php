@extends('app')
@extends('home3')
@section('content')

  <META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
  <div class="container">
    <!-- Horizontal Form -->
    <div class="card card-info">
        <div class="card-header">
            <div class="card-title">{{$getDate= date('Y-n').'月'.date('d').'日'}}-日統計</div>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form class="form-horizontal">
            
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">餐別合計</h3>
                            </div>                            
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>廠區</th>
                                          <th>餐別</th>
                                          <th>合計</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @if (isset($meal_sums))
                                        @foreach ($meal_sums as $meal_sum)
                                            <TR>
                                                <TD>{{$meal_sum->event_plant}}</TD>
                                                <TD>{{$meal_sum->event_meal}}</TD>
                                                <TD>{{$meal_sum->sum}}</TD>
                                            </TR>
                                        @endforeach
                                        @endif
                                      </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->                                 
                            </div>
                        </div> 
                    </div>                          
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">餐點合計</h3>
                            </div>                            
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>廠區</th>
                                          <th>餐別</th>
                                          <th>餐點</th>
                                          <th>合計</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @if (isset($item_sums))
                                        @foreach ($item_sums as $item_sum)
                                            <TR>
                                                <TD>{{$item_sum->event_plant}}</TD>
                                                <TD>{{$item_sum->event_meal}}</TD>
                                                <TD>{{$item_sum->event_item}}</TD>
                                                <TD>{{$item_sum->sum}}</TD>
                                            </TR>
                                        @endforeach
                                        @endif
                                      </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->                                 
                            </div>
                        </div> 
                    </div>                     
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">餐點明細</h3>
                            </div>                            
                            <div class="card-body">
                                <div class="card-body table-responsive p-0">
                                    <table class="table table-hover text-nowrap">
                                      <thead>
                                        <tr>
                                          <th>工號</th>
                                          <th>廠區</th>
                                          <th>餐別</th>
                                          <th>餐點</th>
                                          <th>數量</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @if (isset($events))
                                        @foreach ($events as $event)
                                                <TR>
                                                    <TD>{{$event->event_jobid}}</TD>
                                                    <TD>{{$event->event_plant}}</TD>
                                                    <TD>{{$event->event_meal}}</TD>
                                                    <TD>{{$event->event_item}}</TD>
                                                    <TD>{{$event->event_count}}</TD>
                                                </TR>
                                            @endforeach
                                        @endif
                                      </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->                                 
                            </div>
                        </div> 
                    </div> 
                </div>
                <!-- /.row -->  
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
            <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
            </div>
            <!-- /.card-footer -->
        </form>
        </div>
        <!-- /.card -->
  
      </div>
      <!-- /.Horizontal Form -->
    </div>
  
@stop