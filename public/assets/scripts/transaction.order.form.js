var loadProduct = function(){
    headerRequest();
    $("#loader").html('<i class="fa fa-spinner fa-spin"></i>&nbsp; Load Data...');
    let data =  {
        "model_id" : $("#model_id").val(),
        "brand_id" : $("#brand_id").val(),
        "type_id" : $("#type_id").val(),
        "keyword" : $("#keyword").val()
    };
    $.post(BASE_URL + "/api/product/get", data, function(result) {
        if(result){
            $("#loader").html('<i class="fa fa-check"></i>&nbsp; List cars have been loaded.');
            $("#product-detail-section").html(result);
        }
    });
}

$(function(){
    
    if($("#bill-section-list").length){
        loadProduct();
        $("body").css("overflow", "hidden");
    }   

    $("body").on("change", "#model_id", function(e){
        e.preventDefault();
        if($(this).val()){
            loadProduct();
        }
        return false;
    });

    $("body").on("change", "#brand_id", function(e){
        e.preventDefault();
        if($(this).val()){
            loadProduct();
        }
        return false;
    });

    $("body").on("change", "#type_id", function(e){
        e.preventDefault();
        if($(this).val()){
            loadProduct();
        }
        return false;
    });

    $("body").on("click", "#btn-refresh", function(e){
        e.preventDefault();
        $("#model_id").val("").trigger("change");
        $("#brand_id").val("").trigger("change");
        $("#type_id").val("").trigger("change");
        $("#keyword").val("");
        loadProduct();
        return false;
    });

    $('#form-filter').submit(function(e){
        e.preventDefault();
        loadProduct();
        return false;
    });

    loadProduct();
});

$(window).resize(function() {
    var window_height = $(window).height();
    var size1 = window_height - ((window_height / 100) * 50.8);   
    var size2 = window_height - ((window_height / 100) * 54); 
    $("#product-detail-section").slimscroll({
        height: size1+"px",
    });
    $("#bill-section-list").slimscroll({
        height: size2+"px",
    });
});

$(window).trigger('resize');