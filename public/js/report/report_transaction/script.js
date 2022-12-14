(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on(
            "input keydown keyup mousedown mouseup select contextmenu drop",
            function() {
                if (inputFilter(this.value)) {
                    this.oldValue = this.value;
                    this.oldSelectionStart = this.selectionStart;
                    this.oldSelectionEnd = this.selectionEnd;
                } else if (this.hasOwnProperty("oldValue")) {
                    this.value = this.oldValue;
                    this.setSelectionRange(
                        this.oldSelectionStart,
                        this.oldSelectionEnd
                    );
                } else {
                    this.value = "";
                }
            }
        );
    };
})(jQuery);

$(".number-input").inputFilter(function(value) {
    return /^-?\d*$/.test(value);
});

$(document).on("input propertychange paste", ".input-notzero", function(e) {
    var val = $(this).val();
    var reg = /^0/gi;
    if (val.match(reg)) {
        $(this).val(val.replace(reg, ""));
    }
});

$(document).on("keydown", ".dis-backspace", function(e) {
    if (e.which === 8) {
        e.preventDefault();
    }
});

$(document).on("click", ".btn-selengkapnya", function() {
    var target = $(this).attr("data-target");
    var status = $(target).attr("data-status");
    if (status == 0) {
        $(target).fadeIn(200);
        $(this).children().first().removeClass("mdi-chevron-down");
        $(this).children().first().addClass("mdi-chevron-up");
        $(target).attr("data-status", 1);
    } else {
        $(target).fadeOut(200);
        $(this).children().first().addClass("mdi-chevron-down");
        $(this).children().first().removeClass("mdi-chevron-up");
        $(target).attr("data-status", 0);
    }
});

$(".date").dateDropper({
    format: "d-m-Y",
});


$("input[name=search1]").keyup(function () {
    //split the current value of searchInput
    var str = this.value.toUpperCase();
    var data = str.split(" ");
    //create a jquery object of the rows
    var jo = $(".list-date table").find("tr");
    if (this.value == "") {
        jo.show();
        return;
    }
    //hide all the rows
    jo.hide();

    //Recusively filter the jquery object to get results.

    jo.filter(function (i, v) {
        var $t = $(this);
        // for (var d = 0; d < data.length; ++d) {
        //     if ($t.is(":contains('" + data[d] + "')")) {
        //         return true;
        //     }
        // }
        for (var d = 0; d < data.length; ++d) {
            if ($t.text().toUpperCase().indexOf(data[d]) > -1) {
                return true;
            }
        }
        return false;
    })
    //show the rows that match.
    .show();
}).focus(function () {
    this.value = "";
    $(this).css({
        "color": "black"
    });
    $(this).unbind('focus');
}).css({
    "color": "#C0C0C0"
});

$(document).on("click", ".btn-filter", function() {
    var tgl_awal = $("input[name=tgl_awal]").val();
    var tgl_akhir = $("input[name=tgl_akhir]").val();
    if (tgl_awal == "" && tgl_akhir == "") {
        var today = new Date();
        tgl_awal = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
        tgl_akhir = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
        var sArray = tgl_awal.split("-");
        var sDate = new Date(sArray[2], sArray[1], sArray[0]);
        var eArray = tgl_akhir.split("-");
        var eDate = new Date(eArray[2], eArray[1], eArray[0]);
        if (eDate < sDate) {
            swal(
                "",
                "Tanggal akhir tidak boleh kurang dari tanggal awal",
                "error"
            );
        } else {
            $("form[name=filter_form]").submit();
        }
    } else if (tgl_awal == "") {
        var today = new Date();
        tgl_awal = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
        var sArray = tgl_awal.split("-");
        var sDate = new Date(sArray[2], sArray[1], sArray[0]);
        var eArray = tgl_akhir.split("-");
        var eDate = new Date(eArray[2], eArray[1], eArray[0]);
        if (eDate < sDate) {
            swal(
                "",
                "Tanggal akhir tidak boleh kurang dari tanggal awal",
                "error"
            );
        } else {
            $("form[name=filter_form]").submit();
        }
    } else if (tgl_akhir == "") {
        var today = new Date();
        tgl_akhir = today.getDate()+'-'+(today.getMonth()+1)+'-'+today.getFullYear();
        var sArray = tgl_awal.split("-");
        var sDate = new Date(sArray[2], sArray[1], sArray[0]);
        var eArray = tgl_akhir.split("-");
        var eDate = new Date(eArray[2], eArray[1], eArray[0]);
        if (eDate < sDate) {
            swal(
                "",
                "Tanggal akhir tidak boleh kurang dari tanggal awal",
                "error"
            );
        } else {
            $("form[name=filter_form]").submit();
        }
    } else {
        var sArray = tgl_awal.split("-");
        var sDate = new Date(sArray[2], sArray[1], sArray[0]);
        var eArray = tgl_akhir.split("-");
        var eDate = new Date(eArray[2], eArray[1], eArray[0]);
        console.log(eArray);
        if (eDate < sDate) {
            swal(
                "",
                "Tanggal akhir tidak boleh kurang dari tanggal awal",
                "error"
            );
        } else {
            $("form[name=filter_form]").submit();
        }
    }
});

var check_laporan = 0;
$(document).on("click", "input[value=period]", function() {
    check_laporan = 0;
    $(".period-form").prop("hidden", false);
    $(".manual-form").prop("hidden", true);
});

$(document).on("click", "input[value=manual]", function() {
    check_laporan = 1;
    $(".manual-form").prop("hidden", false);
    $(".period-form").prop("hidden", true);
});

$(document).on("change", ".period-select", function() {
    if ($(this).val() == "minggu") {
        $(".time-input").val(1);
        $(".time-input").attr("max", 4);
    } else if ($(this).val() == "bulan") {
        $(".time-input").val(1);
        $(".time-input").attr("max", 11);
    } else if ($(this).val() == "tahun") {
        $(".time-input").val(1);
        $(".time-input").attr("max", 5);
    }
});

$(document).on("click", ".btn-export", function() {
    if (check_laporan == 1) {
        var tgl_awal = $("input[name=tgl_awal_export]").val();
        var tgl_akhir = $("input[name=tgl_akhir_export]").val();
        if (tgl_awal == "" && tgl_akhir == "") {
            swal("", "Tanggal awal dan akhir tidak boleh kosong", "error");
        } else if (tgl_awal == "") {
            swal("", "Tanggal awal tidak boleh kosong", "error");
        } else if (tgl_akhir == "") {
            swal("", "Tanggal akhir tidak boleh kosong", "error");
        } else {
            var sArray = tgl_awal.split("-");
            var sDate = new Date(sArray[2], sArray[1], sArray[0]);
            var eArray = tgl_akhir.split("-");
            var eDate = new Date(eArray[2], eArray[1], eArray[0]);
            if (eDate < sDate) {
                swal(
                    "",
                    "Tanggal akhir tidak boleh kurang dari tanggal awal",
                    "error"
                );
            } else {
                $("form[name=export_form]").submit();
            }
        }
    } else {
        $("form[name=export_form]").submit();
    }
});