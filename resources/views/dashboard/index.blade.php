@extends('layouts.frame')
@section('page','پیشخوان')
@section('content')



<div id="dashboard">



    <!--  First Row ( Reminders & Date )  --------------------------------------------------------------------------------------------------------------------->
    <div class="row">


        <!-- Reminder -->
        <div class="col-7 dash-con">
            <div class="dash-con-inner">

                <div class="d-flex flex-row justify-content-between" style="line-height:3.4;">
                    <img src="{{ asset('/images/icons/message.png') }}">
                    <p>یاد آوری ها</p>
                    <p class="ml-auto" style="line-height:3.5;" >( {{ count($reminders) }} )</p>
                    <a href="/dashboard/reminder/create"><i id="btn-add-reminder" class="fa fa-2x fa-plus-circle"></i></a>
                </div>

                <div class="tbl-2-con">

                    <!-- Table -->
                    <table class="tbl-2">
                        <?php $i=0; ?>
                        @foreach($reminders as $reminder)
                            <?php $i++ ?>
                            <tr class="d-flex justify-content-between px-4 py-2">
                                <td>{{ $i }}</td>
                                <td>{{ $reminder->title }}</td>
                                <td>
                                    <form class="d-inline" action="/dashboard/reminder/{{ $reminder->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn-style-less" type="submit"><i class="fa fa-check-circle text-success"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <!-- Pagination -->
                    <div class="pt-4 d-flex justify-content-center text-vvsm">
                        {{ $reminders->links() }}
                    </div>

                </div>

            </div>
        </div>


        <!-- Date -->
        <div class="col-5 dash-con">
            <div class="dash-con-inner">

                <div>
                    <img src="{{ asset('/images/icons/calendar.png') }}">
                    <p>زمان و تاریخ</p>
                    <p id="show-time" class="text-info py-2 px-4 border bg-light rounded"></p>
                </div>

                @include('calendar.index')

            </div>
        </div>


    </div>



    <!--  Diagram  ------------------------------------------------------------------------------------------------------------------------------------------>
    <div class="row">
        <div class="col dash-con">
            <div class="dash-con-inner">

                <div>
                    <img src="{{ asset('/images/icons/diagram.png') }}">
                    <p>نمودار</p>
                    <p>سود خالص 30 روز اخیر</p>
                </div>

                <div id="pop_div" class="w-100 h-100 m-auto py-2"></div>
                {!! Lava::render('AreaChart', 'Population', 'pop_div') !!}

            </div>
        </div>
    </div>



</div>



<!-- Scripts -------------------------------------------------------------------------------------------------------------------->
<script type="text/javascript">
    $(document).ready(function() {
        //
    });
</script>



@endsection
