@extends('layouts.frame')
@section('page','پیشخوان')
@section('content')



<div id="dashboard">



    <!-- Reminder & Date (First row) --------------------------------------------------------------------------------------------------------------------------------------->
    <div class="row">



        <!-- Reminder --------------------------------------------------------------------------------------------------------------------------------------->
        <div class="dash-con-outer col-7">
            <div class="dash-con">

                <div class="dash-con-header">
                    <img src="{{ asset('/images/icons/message.png') }}">
                    <p>یاد آوری ها</p>
                    <p>( {{ $reminders_count }} )</p>
                    <a href="#" id="btn_add_reminder" class="mr-3 d-inline"><i class="fa fa-plus-circle"></i></a>
                </div>

                <div class="dash-con-body">

                    <!-- Table -->
                    <table class="tbl-2">
                        <?php use Hekmatinasser\Verta\Verta;$i=1; ?>
                        @foreach($reminders as $reminder)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td data-toggle="tooltip" data-placement="bottom" title="{{ $reminder->description }}" style="text-align:right; padding-right:50px">{{ $reminder->title }}</td>
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
                </div>


                <div class="d-flex flex-column justify-content-around p-2">

                    <!-- Date -->
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



<!-- Modals ------------------------------------------------------------------------------------------------------------------->
<section id="dashboard-modals-con">


    <!-- modal add reminder -->
    <div id="modal_add_reminder" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg mt-5" role="document">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <span>افزودن یادآوری</span>
                    <i class="fa fa-pencil"></i>
                </div>
                <!-- Modal Body -->
                <div class="modal-body">
                    <form id="frm_send_reminder" method="POST">
                        @csrf
                        <div class="con">
                            <div class="row">
                                <!-- title -->
                                <div class="col-12 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text text-vsm"><span class="label">عنوان یادآوری :</span></div></div>
                                    <input type="text" class="form-control border-fix text-vsm" name="title" autocomplete="off"/>
                                </div>
                                <!-- start_date -->
                                <div class="col-6 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text text-vsm"><span class="label">تاریخ آغاز :</span></div></div>
                                    <input type="text" class="form-control text-center text-sm" name="start_date"  value="{{ Verta::now() }}" autocomplete="off" />
                                </div>
                                <!-- end_date -->
                                <div class="col-6 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text text-vsm"><span class="label">تاریخ پایان :</span></div></div>
                                    <input type="text" class="form-control text-center text-sm" name="end_date"  value="{{ Verta::now() }}" autocomplete="off" />
                                </div>
                                <!-- description -->
                                <div class="col-12 form-group input-group">
                                    <div class="input-group-prepend"><div class="input-group-text text-vsm"><span class="label">توضیحات :</span></div></div>
                                    <textarea class="form-control text-vsm" name="description" autocomplete="off" style="min-height:100px;" ></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                    <button type="button" data-type="add_reminder" class="btn_confirm btn btn-sm btn-primary">ثبت</button>
                </div>
            </div>
        </div>
    </div>


</section>



<!-- Scripts ----------------------------------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {



        // Show Modals on Click
        $("#btn_add_reminder").click(function (event) {
            let modal = $("#modal_add_reminder");
            modal.find('textarea[name=description], input[name=title]').val('');
            modal.modal('show');
        });



        // On Confirm Modal => send ajax request, and retreive response & take convenient action
        $(".btn_confirm").click(function (event) {


            // Add Reminder
            if ( $(this).data('type') == 'add_reminder' )
            {
                form = $('#frm_send_reminder');
                $.ajax({
                    url:'/dashboard/reminder',
                    method:"POST",
                    data:{
                        '_token'      :  '<?php echo csrf_token() ?>',
                        'title'       :  form.find('input[name=title]').val(),
                        'start_date'  :  form.find('input[name=start_date]').val(),
                        'end_date'    :  form.find('input[name=end_date]').val(),
                        'end_date'    :  form.find('input[name=end_date]').val(),
                        'description' :  form.find('textarea[name=description]').val(),
                    },
                    success:function (data) {
                        if ( data == 'true' ) {

                            $(event.target).closest('.modal').modal('hide');

                        }
                        else
                            console.log('error!');
                    }
                });
            }


        });



        // Remove Reminder
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
