$(document).ready(function () {
    $(document).on("change", "#item_code_add", function (e) {
        var item_code_add = $(this).val();
        if (item_code_add != "") {
            var token_search = $("#token_search").val();
            var ajax_get_item_uoms_url = $("#ajax_get_item_uoms_url").val();
            jQuery.ajax({
                url: ajax_get_item_uoms_url,
                type: "post",
                dataType: "html",
                cache: false,
                data: {
                    item_code_add: item_code_add,
                    _token: token_search,
                },
                success: function (data) {
                    $("#UomDivAdd").html(data);
                    $("#btn_addToPill").show();
                    $(".related_to_itemCard").show();
                    var type = $("#item_code_add")
                        .children("option:selected")
                        .data("type");
                    if (type == 2) {
                        $(".related_to_date").show();
                    } else {
                        $(".related_to_date").hide();
                    }
                },
                error: function () {
                    $(".related_to_itemCard").hide();
                    alert("حدث خطأ ما ، الرجاء أعد المحاولة مرة أخرى");
                    $("#UomDivAdd").html("");
                    $(".related_to_date").hide();
                    //related_to_date
                },
            });
        } else {
            $(".related_to_itemCard").hide();
            $("#UomDivAdd").html("");
            $(".related_to_date").hide();

            //uom_id_add
        }
        // btn_addToPill;
    });
    $(document).on("input", "#qty_add", function (e) {
        calculateAdd();
    });

    $(document).on("input", "#price_add", function (e) {
        calculateAdd();
    });
    $(document).on("click", "#btn_addToPill", function (e) {
        var item_code_add = $("#item_code_add").val();
        if (item_code_add == "") {
            alert("من فضلك  اختر الصنف");
            $("#item_code_add").focus();
            return false;
        }
        var uom_id_Add = $("#uom_id_add").val();
        if (uom_id_Add == "") {
            alert("من فضلك  اختر الوحدة");
            $("#uom_id_add").focus();
            return false;
        }

        var is_parent_uom = $("#uom_id_add")
            .children("option:selected")
            .data("is_parent_uom");
        var quantity_add = $("#qty_add").val();
        if (quantity_add == "" || quantity_add == 0) {
            alert("من فضلك  ادخل الكمية المستلمة");
            $("#quantity_add").focus();
            return false;
        }

        var price_add = $("#price_add").val();
        if (price_add == "") {
            alert("من فضلك  ادخل سعر الوحدة ");
            $("#price_add").focus();
            return false;
        }
        var type = $("#item_code_add").children("option:selected").data("type");
        if (type == 2) {
            var production_date = $("#production_date").val();
            if (production_date == "") {
                alert("من فضلك  اختر تاريخ الانتاج  ");
                $("#production_date").focus();
                return false;
            }

            var expire_date = $("#expiration_date").val();
            if (expire_date == "") {
                alert("من فضلك  اختر تاريخ انتهاء الصلاحية  ");
                $("#expiration_date").focus();
                return false;
            }

            if (expire_date < production_date) {
                alert(
                    "عفوا لايمكن ان يكون تاريخ الانتهاء اقل من تاريخ الانتاج !!!"
                );
                $("#expire_date").focus();
                return false;
            }
        } else {
            var production_date = $("#expiration_date").val();
            var expire_date = $("#expiration_date").val();
        }

        var total_add = $("#total_add").val();
        if (total_add == "") {
            alert("من فضلك  ادخل اجمالي   الاصناف  ");
            $("#total_add").focus();
            return false;
        }

        var auto_serial_parent = $("#auto_serial_parent").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_add_new_details").val();

        jQuery.ajax({
            url: ajax_search_url,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                auto_serial_parent: auto_serial_parent,
                _token: token_search,
                item_code_add: item_code_add,
                uom_id_Add: uom_id_Add,
                is_parent_uom: is_parent_uom,
                qty_add: quantity_add,
                price_add: price_add,
                production_date: production_date,
                expiration_date: expire_date,
                total_add: total_add,
                type: type,
            },
            success: function (data) {
                reload_items_details();
                reload_parent_pill();
                alert("تم الاضافة بنجاح");
            },
            error: function () {},
        });
    });

    function calculateAdd() {
        var quantity_add = $("#qty_add").val();
        var price_add = $("#price_add").val();
        if (quantity_add == "") quantity_add = 0;
        if (price_add == "") price_add = 0;
        $("#total_add").val(parseFloat(quantity_add) * parseFloat(price_add));
    }

    /*888888888888888888888888888888888888888*/

    function reload_items_details() {
        var auto_serial_parent = $("#auto_serial_parent").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_reload_items_details").val();
        jQuery.ajax({
            url: ajax_search_url,
            type: "post",
            dataType: "html",
            cache: false,
            data: {
                auto_serial_parent: auto_serial_parent,
                _token: token_search,
            },
            success: function (data) {
                $("#ajax_response_search_div_details").html(data);
            },
            error: function () {},
        });
    }

    function reload_parent_pill() {
        var auto_serial_parent = $("#auto_serial_parent").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_reload_parent_pill").val();

        jQuery.ajax({
            url: ajax_search_url,
            type: "post",
            dataType: "html",
            cache: false,
            data: {
                auto_serial_parent: auto_serial_parent,
                _token: token_search,
            },
            success: function (data) {
                $("#ajax_responce_serarchDivparentpill").html(data);
            },
            error: function () {},
        });
    }

    //load_edit_item_details

    $(document).on("click", ".load_edit_item_details", function (e) {
        var id = $(this).data("id");
        var auto_serial_parent = $("#auto_serial_parent").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_load_edit_item_details").val();

        jQuery.ajax({
            url: ajax_search_url,
            type: "post",
            dataType: "html",
            cache: false,
            data: {
                auto_serial_parent: auto_serial_parent,
                _token: token_search,
                id: id,
            },
            success: function (data) {
                $("#edit_item_Modal_body").html(data);
                $("#modal-rg").modal("show");
                $("#Add_item_Modal_body").html("");
                $("#Add_item_Modal").modal("hide");
            },
            error: function () {},
        });
    });

    ////////////////////
    function calculateUpdate() {
        var quantity_add = $("#quantity_add_update").val();
        var price_add = $("#price_add_update").val();
        if (quantity_add == "") quantity_add = 0;
        if (price_add == "") price_add = 0;
        $("#total_add_update").val(
            parseFloat(quantity_add) * parseFloat(price_add)
        );
    }
    $(document).on("input", "#quantity_add_update", function (e) {
        calculateUpdate();
    });

    $(document).on("input", "#price_add_update", function (e) {
        calculateUpdate();
    });

    $(document).on("click", "#EditDetailsItem", function (e) {
        var id = $(this).data("id");

        var item_code_add = $("#item_code_add_update").val();
        if (item_code_add == "") {
            alert("من فضلك  اختر الصنف");
            $("#item_code_add").focus();
            return false;
        }
        var uom_id_Add = $("#uom_id_update").val();
        if (uom_id_Add == "") {
            alert("من فضلك  اختر الوحدة");
            $("#uom_id_Add").focus();
            return false;
        }

        var is_parent_uom = $("#uom_id_Add_update")
            .children("option:selected")
            .data("is_parent_uom");
        var quantity_add = $("#quantity_add_update").val();
        if (quantity_add == "" || quantity_add == 0) {
            alert("من فضلك  ادخل الكمية المستلمة");
            $("#quantity_add").focus();
            return false;
        }

        var price_add = $("#price_add_update").val();
        if (price_add == "") {
            alert("من فضلك  ادخل سعر الوحدة ");
            $("#quantity_add").focus();
            return false;
        }
        var type = $("#item_code_add_update")
            .children("option:selected")
            .data("type");
        if (type == 2) {
            var production_date = $("#production_date_update").val();
            if (production_date == "") {
                alert("من فضلك  اختر تاريخ الانتاج  ");
                $("#production_date").focus();
                return false;
            }

            var expire_date = $("#expire_date_update").val();
            if (expire_date == "") {
                alert("من فضلك  اختر تاريخ انتهاء الصلاحية  ");
                $("#expire_date").focus();
                return false;
            }

            if (expire_date < production_date) {
                alert(
                    "عفوا لايمكن ان يكون تاريخ الانتهاء اقل من تاريخ الانتاج !!!"
                );
                $("#expire_date").focus();
                return false;
            }
        } else {
            var production_date = $("#production_date_update").val();
            var expire_date = $("#expire_date").val();
        }

        var total_add = $("#total_add_update").val();
        if (total_add == "") {
            alert("من فضلك  ادخل اجمالي   الاصناف  ");
            $("#total_add").focus();
            return false;
        }
        var auto_serial_parent = $("#auto_serial_parent").val();
        var token_search = $("#token_search").val();
        var ajax_url = $("#ajax_edit_item_details").val();

        jQuery.ajax({
            url: ajax_url,
            type: "post",
            dataType: "json",
            cache: false,
            data: {
                auto_serial_parent: auto_serial_parent,
                _token: token_search,
                item_code_add: item_code_add,
                uom_id_Add: uom_id_Add,
                is_parent_uom: is_parent_uom,
                quantity_add: quantity_add,
                price_add: price_add,
                production_date: production_date,
                expire_date: expire_date,
                total_add: total_add,
                type: type,
                id: id,
            },
            success: function (data) {
                reload_items_details();
                reload_parent_pill();
                $("#modal-rg").html("");
                $("#modal-rg").modal("hide");
            },
            error: function () {},
        });
    });

    $(document).on("click", "#load_close_approve_invoice", function (e) {
        var auto_serial_parent = $("#auto_serial_parent").val();
        var token_search = $("#token_search").val();
        var ajax_search_url = $("#ajax_load_modal_approve_invoice").val();

        jQuery.ajax({
            url: ajax_search_url,
            type: "post",
            dataType: "html",
            cache: false,
            data: {
                auto_serial_parent: auto_serial_parent,
                _token: token_search,
            },
            success: function (data) {
                $("#model-rr").modal("show");
                $("#ModalApproveInvocie_body").html(data);
            },
            error: function () {},
        });
    });
});
