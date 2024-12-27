$(document).ready(function () {

    function getdata(page,str,limit ) {
        $.ajax({
            url: "backend.php",
            type: "post",
            datatype: "html",
            data: {
                page_no: page,
                search_str: str,
                limit_no : limit
            },
            success: function (data) {
                $(".my-data").html(data);

            }
        })
    }


    getdata();


    $(document).on("click", ".pagination li", function () {
      
        var id=$(this).attr("id");
        getdata(id);
    })


    $("input").on("keyup",function(){
      
        let value=$(this).val();
        getdata(1,value);

    });

    $("#selectId").on('input', function(){
        
        let value = $(this).val();
        console.log(value);
        getdata( $(document).on(".pagination li").attr("id") , $("input").val() , value );

    })


})