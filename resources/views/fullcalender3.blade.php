<!DOCTYPE html>
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
    <div class="row justify-content-center">
        <div class="col-md-12">
            <!-- Horizontal Form -->
            <div class="card card-info">
                <div class="card-header">
                    <div class="card-title">代刪訂餐</div>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form class="form-horizontal">
                    <div class="card-body">
                        
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
                                                    events: SITEURL + "/fullcalender3",
                                                    displayEventTime: false,
                                                    displayEventTime: false,
                                                    weekends: false, // 顯示星期六跟星期日
                                                    editable: false,  // 啟動拖曳調整日期
                                                    dayNamesShort: ["週日", "週一", "週二", "週三", "週四", "週五", "週六"], 
                                                    
                                                    eventRender: function (event, element, view) {
                                                        if (event.allDay === 'true') {
                                                                event.allDay = true;
                                                        } else {
                                                                event.allDay = false;
                                                        }
                                                    },
                                                    selectable: true,
                                                    selectHelper: true,
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
                                                                                        url: SITEURL + '/fullcalenderAjax3',
                                                                                        data: {
                                                                                                id: event.id,
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
                                                    
                                
                                </script>
                                
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer">
                    <a href="{{ url('index2') }}" class="btn btn-default float-right">回公司訂餐</a>
                    </div>
                    <!-- /.card-footer -->
                </form>
                <!-- /.card -->
            </div>
            <!-- /.Horizontal Form -->              
        </div>   
    </div>    
</div>   
</body>
</html>