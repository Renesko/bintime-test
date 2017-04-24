$(document).ready(function () {
    $(".product-list").on("change", function () {
        var key = $(this).val();
        var priceElementId = "line[" + $(this).data("index") + "][price]";
        var priceSelector = "input[id='" + priceElementId + "']";

        if (key) {
            $.ajax({
                url: "/product/" + key + "/price",
                dataType: "json",
                type: "get",
                success: function (response) {
                    $(priceSelector).val(response);
                }
            });
        } else {
            $(priceSelector).val("");
        }
    });
});