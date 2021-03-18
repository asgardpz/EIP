@extends('home')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">公司訂餐</h1>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          @if ( Auth::user()->authority =='公司' || Auth::user()->authority =='admin' )  
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" onclick="window.location='{{ url('order_information') }}'">
              <div class="inner">
                <h3>訂餐資訊</h3>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="order_information" class="small-box-footer">進入 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>          
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" onclick="window.location='{{ url('order_menu') }}'">
              <div class="inner">
                <h3>訂餐菜單</h3>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="order_menu" class="small-box-footer">進入 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info" onclick="window.location='{{ url('delete_order') }}'">
              <div class="inner">
                <h3>代刪訂餐</h3>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="delete_order" class="small-box-footer">進入 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          @endif                    
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" onclick="window.location='{{ url('Company_lunch') }}'">
              <div class="inner">
                <h3>訂午餐</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="Company_lunch" class="small-box-footer">進入<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" onclick="window.location='{{ url('Company_dinner') }}'">
              <div class="inner">
                <h3>訂晚餐</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="Company_dinner" class="small-box-footer">進入<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div> 
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" onclick="window.location='{{ url('Note') }}'">
              <div class="inner">
                <h3>用餐意見</h3>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="Note" class="small-box-footer">進入<i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>           
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success" onclick="window.location='{{ url('Company_lunch_day') }}'">
              <div class="inner">
                <h3>午餐統計</sup></h3>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="Company_lunch_day" class="small-box-footer">進入 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>     
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success" onclick="window.location='{{ url('Company_dinner_day') }}'">
              <div class="inner">
                <h3>晚餐統計</sup></h3>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="Company_dinner_day" class="small-box-footer">進入 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>                         
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger" onclick="window.location='{{ url('search_index') }}'">
              <div class="inner">
                <h3>查詢訂餐</h3>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="search_index" class="small-box-footer">進入 <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>    
          <!-- ./col -->
        </div>
        <!-- /.row -->

          <!-- /.Left col -->
          <!-- right col (We are only adding the ID to make the widgets sortable)-->
          <section class="col-lg-5 connectedSortable">




          </section>
          <!-- right col -->
        </div>
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
@endsection


