@extends('layouts.frame')
@section('page','پیشخوان')
@section('content')



<div id="dashboard">



    <div class="row">



        <!-- Reminder --------------------------------------------------------------------------------------------------------------------------------------->
        <div class="dash-con-outer col-7">
            <div class="dash-con">

                <div class="dash-con-header">
                    <img src="{{ asset('/images/icons/message.png') }}">
                    <p>یاد آوری ها</p>
                    <p>( {{ $reminders_count }} )</p>
                    <a href="/dashboard/reminder/create"><i id="btn-add-reminder" class="fa fa-plus-circle"></i></a>
                </div>

                <div class="dash-con-body">

                    <!-- Table -->
                    <table class="tbl-2">
                        <?php use Hekmatinasser\Verta\Verta;$i=1; ?>
                        @foreach($reminders as $reminder)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td style="text-align:right; padding-right:50px">{{ $reminder->title }}</td>
                                <td><span class="btn-delete-reminder ml-0" data-id="{{ $reminder->id }}"><i class="fa fa-calendar-check-o text-success"></i></span></td>
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



        <!-- Date ------------------------------------------------------------------------------------------------------------------------------------------->
        <?php
            $hijri = Verta::now();
            $miladi = getdate();
        ?>
        <div class="dash-con-outer col-5">
            <div class="dash-con">


                <div class="dash-con-header">
                    <img src="{{ asset('/images/icons/calendar.png') }}">
                    <p>امروز</p>
                    <p></p>
                </div>


                <div class="d-flex flex-column justify-content-around p-2">

                    <div class="dash-con-body cal">

                        <!-- jalali -->
                        <div class="cal-part">
                            <div class="d-flex flex-row justify-content-end">
                                <p class="day-big">{{ $hijri->day < 10 ? '0'.$hijri->day : $hijri->day }}</p>
                                <p class="month-num">/ {{ $hijri->month }}</p>
                            </div>
                            <div class="d-flex flex-column text-center">
                                <p class="month-str">{{ (new Verta)->format('%B') }}</p>
                                <p class="year">{{ $hijri->year }}</p>
                            </div>
                        </div>

                        <!-- miladi -->
                        <div class="cal-part">
                            <div class="d-flex flex-row justify-content-end">
                                <p class="day-big">{{ $miladi['mday'] < 10 ? '0'.$miladi['mday']:$miladi['mday'] }}</p>
                                <p class="month-num">/ {{ $miladi['mon'] }}</p>
                            </div>
                            <div class="d-flex flex-column text-center">
                                <p class="month-str">{{ $miladi['month'] }}</p>
                                <p class="year">{{ $miladi['year'] }}</p>
                            </div>
                        </div>

                    </div>

                    <!-- time -->
                    <div class="p-1">
                        <div id="time" class="cal-part"></div>
                    </div>

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

                    {!!Lava::render('AreaChart','Population','pop_div')!!}

                </div>

            </div>
        </div>
    </div>



</div>



<!-- Scripts ----------------------------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {


        // remove reminder
        $(".btn-delete-reminder").on('click', function(event){
            var id = $(this).data('id');
            $.ajax({
                'url' : 'dashboard/removereminder/' + id,
                'method' : 'POST',
                data:{
                    '_token' : "<?php echo csrf_token() ?>",
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
