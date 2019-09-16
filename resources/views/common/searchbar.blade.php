<div class="top-search-con">


    <div class="top-search">
        <div class="d-flex justify-content-center">
            <p class="ml-3">جستجو :</p>
            <select class="form-control ml-1" name="" id="">
                <option value="">کد اشتراک</option>
                <option value="">نام</option>
            </select>
            <input type="text" class="form-control" name="" id=""/>
            <span class="r-s-cancel"><i class="fa fa-close"></i></span>
        </div>
    </div>


    <span id="btn-toggle-top-search"><i class="fa fa-search"></i></span>


</div>



<script type="text/javascript">
    $(window).on('load', function() {
        $("#btn-toggle-top-search").click(function (event) {

            $('.top-search').slideToggle(200);

            // $('.top-search').css('display', 'flex');


        });
    });
</script>
