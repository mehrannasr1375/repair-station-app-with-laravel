<div class="modal fade" id="modal_confirm" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">



            <!-- Modal Header -->
            <div class="modal-header">

                <h6 class="modal-title" id="exampleModalLabel">
                    <i class="fa fa-1x fa-info-circle text-info ml-2"></i>
                    @yield('modal_title')
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>



            <!-- Modal Body -->
            <div class="modal-body">
                <div>
                    @yield('modal_content')
                </div>
                <div>
                    آیا وضعیت دستگاه شماره
                    <p class="px-2 mb-0 text-primary" style="display: inline-block"></p>
                    به سالم تغییر یابد؟
                </div>
            </div>



            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                <button type="button" id="btn_confirm" data-type="@yield('btn_confirm_type')" class="btn btn-sm btn-primary">بله</button>
            </div>



        </div>
    </div>
</div>


