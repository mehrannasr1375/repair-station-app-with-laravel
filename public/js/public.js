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
        setInterval(showTime, 1000);
    }
    showTime();



})
