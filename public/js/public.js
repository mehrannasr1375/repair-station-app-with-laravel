$(function(){


    // in 'orders/create.blade.php' for select that customer id new or old
    $("#new_customer").click(function(){
        $("#customer_status_new").prop("checked", true);
    });
    $("#old_customer").click(function(){
        $("#customer_status_old").prop("checked", true);
    });


    function show_time() {
        d = new Date();
        H = d.getHours();
        H = ( H < 10 ) ? "0" + H : H;
        i = d.getMinutes();
        i = ( i < 10 ) ? "0" + i : i;
        s = d.getSeconds();
        s = ( s < 10 ) ? "0" + s : s;
        $("#show-time").html( H + ":" + i + ":" + s);
        setInterval("show_time()", 1000); 
    }

    show_time();
    
})
