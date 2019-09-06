
<div id="@yield('modal_id')" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h6 class="modal-title">
                    <i class="fa fa-1x fa-info-circle text-info ml-2"></i>
                    @yield('modal_header')
                </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <p class="px-2 mb-0 text-dark" style="display: inline-block">
                    @yield('modal_body')
                </p>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" id="btn_cancel" class="btn btn-sm btn-secondary" data-dismiss="modal">انصراف</button>
                <button type="button" data-type="@yield('modal_btn_confirm_data_type')" class="btn_confirm btn btn-sm btn-primary">بله</button>
            </div>
        </div>
    </div>
</div>
