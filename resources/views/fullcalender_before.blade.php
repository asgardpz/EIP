
<html>

<head>
<meta name="csrf-token" content="{{ csrf_token() }}">  
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet"></link>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
<style>
.well, .panel {text-align: center;}
</style>
</head>

<body>
  <META name="viewport" content="width=device-width, initial-scale=0.8, minimum-scale=0.5 maximum-scale=2, user-scalable=no">
  <div class="container">
      <div class="row">
            </div>    
            <div >
                <div class="well">1.選擇廠區/餐點</div>
                @if (isset($order_infs))
                @foreach ($order_infs as $order_inf)
                @endforeach
                @endif
                <div class="card card-info">
                        <div class="card-header">
                            <div class="card-title">{{$getDate= date('Y-n').'月'}}-公司訂餐</div>
                        </div>                    
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3">
                                    <input type="text" class="form-control" placeholder="工號：" disabled>
                                </div>
                                <div class="col-3">
                                    @if (Auth::user()->jobid == 'admin')
                                        <input class="form-control" id="event_jobid" value = {{Auth::user()->jobid}} size="10">
                                    @else
                                        <input class="form-control" id="event_jobid" value = {{Auth::user()->jobid}} size="10" disabled>
                                    @endif                                 
                                </div>
                                <div class="col-3">
                                    <input class="form-control" id="menu_type" value = {{ $menu_type }} size="5" disabled>
                                </div>
                                <div class="col-3">
                                    <input class="form-control" id="menu_meal" value = {{ $menu_meal }} size="5" disabled>
                                </div>  
                            </div>                                
                            <div class="row">
                                <div class="col-sm-4">
                                  <!-- select -->
                                  <div class="form-group">
                                    <label>廠區 :</label>
                                    <select class="form-control" id='event_plant' name='event_plant'>
                                      <option value='0'></option>
                                      <!-- Read Departments -->
                                      @foreach($departmentData['data'] as $department)
                                      <option value='{{ $department->menu_plant }}'>{{ $department->menu_plant }}</option>
                                      @endforeach                                  
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                  <!-- select -->
                                  <div class="form-group">
                                    <label>餐點 : </label>
                                    <select class="form-control" id='event_item' name='event_item'>
                                        <option value='0'></option>                                
                                    </select>
                                  </div>
                                </div>
                                <div class="col-sm-4">
                                    <!-- select -->
                                    <div class="form-group">
                                      <label>數量 : </label>
                                      <select class="form-control" id='event_count'>
                                        <option value='1'>1</option>
                                        <option value='2'>2</option>
                                        <option value='3'>3</option>                            
                                      </select>
                                    </div>
                                </div>                            
                            </div>
                                            <label id=lbl></label>
                                            <!-- Script -->
                                            <script type='text/javascript'>
                                        
                                            $(document).ready(function(){
                                        
                                            // Department Change
                                            $('#event_plant').change(function(){
                                        
                                                // Department id
                                                var id = $(this).val();
                                                var menu_meal = $('#menu_meal').val();
                                                var menu_type = $('#menu_type').val();
                                                // Empty the dropdown
                                                $('#event_item').find('option').not(':first').remove();
                                        
                                                // AJAX request 
                                                $.ajax({
                                                    url: 'getEmployees/'+id+'/'+menu_meal+'/'+menu_type,
                                                    type: 'get',
                                                    dataType: 'json',
                                                    success: function(response){
                                        
                                                    var len = 0;
                                                    if(response['data'] != null){
                                                        len = response['data'].length;
                                                    }
                                        
                                                    if(len > 0){
                                                        // Read data and create <option >
                                                        for(var i=0; i<len; i++){
                                                        if (menu_type=='自付')
                                                        {
                                                            var name = response['data'][i].menu_restaurant+':'+response['data'][i].menu_item;
                                                            var menu_id = response['data'][i].id;
                                                        }   
                                                        else
                                                        {
                                                            var menu_id = response['data'][i].menu_item;
                                                            var name = response['data'][i].menu_item;
                                                        }     
                                                        
                                                        var option = "<option value='"+menu_id+"' >"+name+"</option>"; 
                                                                                              
                                                        $("#event_item").append(option); 
                                                        }
                                                    }
                                                    }
                                                });

                                                $.ajax({
                                                    url: 'get_order_information/'+id+'/'+menu_meal+'/'+menu_type,
                                                    type: 'get',
                                                    dataType: 'json',
                                                    success: function(response){
                                        
                                                    var len = 0;
                                                    if(response['data'] != null){
                                                        len = response['data'].length;
                                                    }
                                        
                                                    if(len > 0){

                                                        for(var i=0; i<len; i++){
                                        
                                        
                                                        var name = response['data'][i].inf_time;
                                                        var inf_1 = response['data'][i].inf_1;
                                                        var inf_2 = response['data'][i].inf_2;
                                                        var inf_3 = response['data'][i].inf_3;
                                                        var inf_4 = response['data'][i].inf_4;
                                                        var inf_5 = response['data'][i].inf_5;
                                                        document.getElementById('0').value = name;
                                                        document.getElementById('1').value = inf_1;
                                                        document.getElementById('2').value = inf_2;
                                                        document.getElementById('3').value = inf_3;
                                                        document.getElementById('4').value = inf_4;
                                                        document.getElementById('5').value = inf_5;
                                                        }
                                                    }
                                        
                                                    }
                                                });
                                                                                                
                                            });
                                        
                                            });
                                        
                                            </script>

                        </div> 
                        <div class="card-footer">
                            @if ( $menu_type == '公司')
                            <div class="col-sm-4">
                               請要吃便當的同仁在<input id="0"   size="5" disabled>點之前訂餐
                            </div>     
                            <div class="col-sm-4"> 
                                公司{{$menu_meal}}:葷:<input id="1"  size="20" disabled>
                            </div> 
                            <div class="col-sm-4"> 
                                公司{{$menu_meal}}:素:<input id="2"  size="20" disabled>
                            </div>                                    
                            @else
                            <div class="col-sm-4">
                                請自付訂餐的同仁在<input id="0"   size="5" disabled>點之前訂餐
                            </div>  
                            @endif 
                            <BR>                             
                            <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
                        </div>                                  
                    </div>
            </div>

            
            <div >
            </div>        
                <div class="well">2.點選行事曆</div>
                <div id='calendar'></div>
                <script>
                    $(document).ready(function () {
                    
                    var SITEURL = "{{ url('/') }}";

                    $.ajaxSetup({
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                    var calendar = $('#calendar').fullCalendar({
                                        editable: true,
                                        //events: SITEURL + "/fullcalender2",
                                        events: SITEURL + "/fullcalender2",
                                        displayEventTime: false,
                                        weekends: false, // 顯示星期六跟星期日
                                        editable: false,  // 啟動拖曳調整日期
                                        dayNamesShort: ["週日", "週一", "週二", "週三", "週四", "週五", "週六"], 
                                        header: { // 頂部排版
                                            left: "", // 左邊放置上一頁、下一頁和今天
                                            center: "", // 中間放置標題
                                            right: "" // 右邊放置月、周、天
                                        },  
                                        eventRender: function (event, element, view) {
                                            if (event.allDay === 'true') {
                                                    event.allDay = true;
                                            } else {
                                                    event.allDay = false;
                                            }
                                        },
                                        selectable: false,
                                        selectHelper: true,
                                        select: function (start, end, allDay) {
                                            var start1 = $.fullCalendar.formatDate(start, "D");
                                            var month1 = $.fullCalendar.formatDate(start, "M");
                                            var Tday1=new Date();
                                            var tod1 =Tday1.getDate();
                                            //var title = '訂餐';
                                            var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                                            var end = $.fullCalendar.formatDate(end, "Y-MM-DD");
                                            var jobid_add = $('#event_jobid').val();
                                            var plant_add = $('#event_plant').val();
                                            var meal_add = $('#menu_meal').val();
                                            var meal_type = $('#menu_type').val();
                                            var menu_id = $('#event_item').val();
                                            var item_add=$("#event_item").find("option:selected").text(); 
                                            var count_add = $('#event_count').val();
                                            var title = '訂餐:'+jobid_add+'\n'+plant_add+'-'+meal_type+'-'+meal_add+'\n'+item_add+'-'+count_add; 

                                            //判斷日期
                                            var start_d = new Date(start);
                                            var diff = new Date(start_d-Tday1),
                                                days  = diff/1000/60/60/24;
                                            var hours = Tday1.getHours();
                                            var endhour = $('#0').val();
                                            if (days <=-1 ) 
                                            {
                                                displayMessage("不能往前訂餐");
                                            }
                                            else if(item_add==0)
                                            {
                                                displayMessage("餐點不可空白");  
                                            }
                                            else if(hours>=endhour && days <=0)
                                            {
                                                displayMessage("已截止訂餐");  
                                            }                                                        
                                            else
                                            {
                                                if (title) 
                                                {

                                                    $.ajax({
                                                        url: SITEURL + "/fullcalenderAjax",
                                                        data: {
                                                            title: title,
                                                            start: start,
                                                            end: end,
                                                            event_plant: $('#event_plant').val(),
                                                            event_meal: meal_add,
                                                            event_type: meal_type,
                                                            event_count: count_add,
                                                            event_menu_id: menu_id,
                                                            event_item: $('#event_item').val(),
                                                            event_jobid: $('#event_jobid').val(),
                                                            type: 'add'
                                                        },
                                                        type: "POST",
                                                        success: function (data) {
                                                            displayMessage("訂餐成功");
                        
                                                            calendar.fullCalendar('renderEvent',
                                                                {
                                                                    id: data.id,
                                                                    title: title,
                                                                    start: start,
                                                                    end: end,
                                                                    event_jobid: $('#event_jobid').val(),
                                                                    allDay: allDay
                                                                },true);
                        
                                                            calendar.fullCalendar('unselect');
                                                        }
                                                    });
                                                }  

                                            } 

                                        },   
                                        dayClick: function (date, allDay, jsEvent, view) { 
                                            //var title = '訂餐';
                                            var start =date.format()
                                            var end =date.format()
                                            var start_d = new Date(date.format());


                                            var Tday1=new Date();
                                            //var title = '訂餐';
                                            var jobid_add = $('#event_jobid').val();
                                            var plant_add = $('#event_plant').val();
                                            var meal_add = $('#menu_meal').val();
                                            var meal_type = $('#menu_type').val();
                                            var menu_id = $('#event_item').val();
                                            var item_add=$("#event_item").find("option:selected").text(); 
                                            var count_add = $('#event_count').val();
                                            var title = '訂餐:'+jobid_add+'\n'+plant_add+'-'+meal_type+'-'+meal_add+'\n'+item_add+'-'+count_add; 

                                            //判斷日期
                                            var start_d = new Date(start);
                                            var diff = new Date(start_d-Tday1),
                                                days  = diff/1000/60/60/24;
                                            var hours = Tday1.getHours();
                                            var endhour = $('#0').val();

                                            //displayMessage(start);
                                            if (days <=-1 ) 
                                            {
                                                displayError("不能往前訂餐");
                                            }
                                            else if(item_add==0)
                                            {
                                                displayError("餐點不可空白");  
                                            }
                                            else if(hours>=endhour && days <=0)
                                            {
                                                displayError("已截止訂餐");  
                                            }                                                        
                                            else
                                            {
                                                if (title) 
                                                {

                                                    $.ajax({
                                                        url: SITEURL + "/fullcalenderAjax",
                                                        data: {
                                                            title: title,
                                                            start: start,
                                                            end: end,
                                                            event_plant: $('#event_plant').val(),
                                                            event_meal: meal_add,
                                                            event_type: meal_type,
                                                            event_count: count_add,
                                                            event_menu_id: menu_id,
                                                            event_item: $('#event_item').val(),
                                                            event_jobid: $('#event_jobid').val(),
                                                            type: 'add'
                                                        },
                                                        type: "POST",
                                                        success: function (data) {
                                                            displayMessage("訂餐成功");
                        
                                                            calendar.fullCalendar('renderEvent',
                                                                {
                                                                    id: data.id,
                                                                    title: title,
                                                                    start: start,
                                                                    end: end,
                                                                    event_jobid: $('#event_jobid').val(),
                                                                    allDay: allDay
                                                                },true);
                        
                                                            calendar.fullCalendar('unselect');
                                                        }
                                                    });
                                                }  

                                            }

                                        },                                                                                          
                                        eventDrop: function (event, delta) {
                                            var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                                            var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
                    
                                            $.ajax({
                                                url: SITEURL + '/fullcalenderAjax',
                                                data: {
                                                    title: event.title,
                                                    start: start,
                                                    end: end,
                                                    id: event.id,
                                                    event_jobid: $('#event_jobid').val(),
                                                    type: 'update'
                                                },
                                                type: "POST",
                                                success: function (response) {
                                                    displayMessage("更新成功");
                                                }
                                            });
                                        },
                                        eventClick: function (event) {
                                            var start = $.fullCalendar.formatDate(event.start, "D");
                                            var Tday=new Date();
                                            var tod =Tday.getDate();
                                            //判斷日期
                                            var start_d = new Date(event.start);
                                            var diff = new Date(start_d-Tday),
                                                days  = diff/1000/60/60/24; 
                                            if(days <=-1){
                                                displayMessage("無法刪除舊資料");
                                            }
                                            else
                                            {
                                                var deleteMsg = confirm("是否刪除訂餐？");
                                                if (deleteMsg) {
                                                    $.ajax({
                                                        type: "POST",
                                                        url: SITEURL + '/fullcalenderAjax',
                                                        data: {
                                                                id: event.id,
                                                                event_jobid: $('#event_jobid').val(),
                                                                type: 'delete'
                                                                
                                                        },
                                                        success: function (response) {
                                                            calendar.fullCalendar('removeEvents', event.id);
                                                            displayMessage("刪除成功");
                                                        }
                                                    });
                                                }                                                              
                                            }
                                                
                                        }
                    
                                    });
                    
                    });
                    function displayMessage(message) {
                        toastr.success(message, '訊息');
                    } 
                    function displayError(message) {
                        toastr.error(message, '錯誤');
                    }                     
                </script>              
            </div>
      </div>
  </div>

</body>

</html>