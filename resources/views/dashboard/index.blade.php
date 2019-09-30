@extends('layouts.frame')
@section('page','پیشخوان')
@section('content')



<div id="dashboard">
    <div class="row">



        <!-- Reminder -->
        <div class="dash-con-outer col-7">
            <div class="dash-con">

                <div class="dash-con-header">
                    <img src="{{ asset('/images/icons/message.png') }}">
                    <p>یاد آوری ها</p>
                    <p>( {{ count($reminders) }} )</p>
                    <a href="/dashboard/reminder/create"><i id="btn-add-reminder" class="fa fa-plus-circle"></i></a>
                </div>

                <div class="dash-con-body">

                    <!-- Table -->
                    <table class="tbl-2">
                        <?php $i=1; ?>
                        @foreach($reminders as $reminder)
                            <tr>
                                <td style="width:80px;">{{ $i++ }}</td>
                                <td style="text-align:right; padding-right:150px">{{ $reminder->title }}</td>
                                <td style="width:80px;"><span class="btn-delete-reminder ml-0" data-id="{{ $reminder->id }}"><i class="fa fa-calendar-check-o text-success"></i></span></td>
                            </tr>
                        @endforeach
                    </table>

                    <!-- Pagination -->
                    <div class="pt-3 d-flex justify-content-center text-vvsm" style="margin-bottom:-10px;">
                        {{ $reminders->links() }}
                    </div>

                </div>

            </div>
        </div>



        <!-- Date -->
        <div class="dash-con-outer col-5">
            <div class="dash-con">

                <div class="dash-con-header">
                    <img src="{{ asset('/images/icons/calendar.png') }}">
                    <p>زمان و تاریخ</p>
                </div>

                <div class="dash-con-body">

                </div>

            </div>
        </div>


    </div>



    <!--  Diagram  ------------------------------------------------------------------------------------------------------------------------------------------>
    <div class="row">
        <div class="dash-con-outer col">
            <div class="dash-con">

                <div class="dash-con-header">
                    <img src="{{ asset('/images/icons/diagram.png') }}">
                    <p>نمودار</p>
                    <p>سود خالص 30 روز اخیر</p>
                </div>

                <div class="dash-con-body" id="pop_div">
                    
                </div>
                {{--!!Lava::render('AreaChart','Population','pop_div')!!--}}

            </div>
        </div>
    </div>



</div>



<!-- Scripts -------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {



        // remove reminder
        $(".btn-delete-reminder").on('click', function(event){
            var id = $(this).data('id');   
            $.ajax({
                'url' : 'dashboard/removereminder/' + id,
                'method' : 'POST',
                data:{
                    '_token' : '<?php echo csrf_token() ?>',
                    'id' : id
                },
                success:function (data) {
                    if ( data === 'true' ) {
                        $(event.target).closest('tr').css('background-color','#ffcccc').hide(200);
                    }
                }
            });
        });



    });
</script>



@endsection
