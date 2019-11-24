$(function(){



    // in 'orders/create.blade.php' for select that customer id new or old
    $("#new_customer").click(function(){
        $("#customer_status_new").prop("checked", true);
    });
    $("#old_customer").click(function(){
        $("#customer_status_old").prop("checked", true);
    });



    // show time online
    function checkTime(i) {
        if (i < 10)  {i = "0" + i};
        return i;
    }
    function showTime() {
        var now = new Date();
        var h   = checkTime(now.getHours());
        var m   = checkTime(now.getMinutes());
        var s   = checkTime(now.getSeconds());
        $('#time').html ( h + "<span class='font-weight-light px-3'> : </span>" + m + "<span class='font-weight-light px-3'> : </span>" + s );
        setTimeout(showTime, 1000);
    }
    showTime();


    // numeric text boxes
    $(document).on('keypress', '.numericOnly', function (e) {
        if ( String.fromCharCode(e.keyCode).match(/[^0-9]/g) )
            return false;
    });



    // waiting spinner for load page
    $(window).on("load",function() {
        if ($(".ouro").css('display') == 'block') {
            setTimeout(function(){
                $('.ouro').parent().css('margin-top', '0px');
                $('#app').show();
                $('.ouro').hide();
                new WOW().init();
            }, 700);
        } else
            $('#app').show();

    });



    // Enable bootstrap tooltips
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });



    // cost seaparate
    function addComma(str) {
        var objRegex = new RegExp('(-?[0-9]+)([0-9]{3})');
        while (objRegex.test(str)) {
            str = str.replace(objRegex, '$1,$2');
        }
        return str;
    }
    $('.cost-separate').each(function () {
        $(this).text(addComma($(this).text()));
    });



})
