<!DOCTYPE html>
<html>
<head>
<meta name="csrf-token" content="{{ csrf_token() }}">  
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"></link>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<style>
.well, .panel {text-align: center;}
</style>
</head>

<body>
  <META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=auto">
  <div class="container">
    <div class="row">
        <div class="col-12">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">查詢訂餐</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0">
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 400px;">
                        查詢類型：
                        <button id="Y-m" type="button" class="btn btn-info">月</button>
                        <button id="Y-m-d" type="button" class="btn btn-info">日</button>
                        <BR>
                        <input id="0"   size="5" disabled hidden>
                            日期：    <input type="" id="dateFrom" name="dateFrom" value="" /></input>
                            工號：    <input type="text" size="5" class="form-controller" id="search" name="search"></input>
                        <script type="text/javascript">
                            $(document).ready(function(){
                                $("#Y-m").click(function(){
                                var name = "<?php echo date('Y-m'); ?>";
                                var mode = "month"; 
                                document.getElementById('search').value = ""; 
                                document.getElementById('dateFrom').type = mode; 
                                document.getElementById('dateFrom').value = name;  
                                document.getElementById('0').value = mode;                                            
                                });
                                $("#Y-m-d").click(function(){
                                var name = "<?php echo date('Y-m-d'); ?>";
                                var mode = "date"; 
                                document.getElementById('search').value = ""; 
                                document.getElementById('dateFrom').type = mode;       
                                document.getElementById('dateFrom').value = name;  
                                document.getElementById('0').value = mode; 
                                
                                });
                            });
                        </script>                        
                    </div>
                  </div>                
              <table class="table table-hover text-nowrap">
                <thead>
                  <tr>
                    <th>日期</th>
                    <th>工號</th>
                    <th>廠區</th>
                    <th>餐別</th>
                    <th>類型</th>
                    <th>餐點</th>
                    <th>數量</th>
                  </tr>
                </thead>
                <tbody>
                </tbody>
                <script type="text/javascript">
                    $('#search').on('keyup',function(){
                    $value=$(this).val();
                    $date=$('#dateFrom').val();
                    $mode=$('#0').val();
                    if ($mode=="date"){
                        $.ajax({
                            type : 'get',
                            url : '{{URL::to('search')}}',
                            data:{'search':$value,'dateFrom':$date},
                            success:function(data){
                            $('tbody').html(data);
                            }
                            });
                    }
                    if ($mode=="month"){
                        $.ajax({
                            type : 'get',
                            url : '{{URL::to('search_month')}}',
                            data:{'search':$value,'dateFrom':$date},
                            success:function(data){
                            $('tbody').html(data);
                            }
                            });
                    }                                        

                    })
                    </script>
                    <script type="text/javascript">
                    $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
                    </script>                 
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <div class="card-footer">
            <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- /.row -->      
    </div>

</body>

</html>          
