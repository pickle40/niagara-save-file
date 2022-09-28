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

$(function() {
    $("form[name='transaction_form']").validate({
        rules: {
            diskon: "required",
            bayar: "required",
        },
        errorPlacement: function(error, element) {
            var name = element.attr("name");
            $("input[name=" + name + "]").addClass("is-invalid");
        },
        submitHandler: function(form) {
            form.submit();
        },
    });
});

function subtotalBarang(harga, jumlah_barang, status_pajak) {
    var subtotal_barang_ppn = 0;
    var subtotal_barang_non_ppn = 0;
    // $('.total_barang').each(function () {
    //   subtotal_barang_ppn += parseInt($(this).val());
    //   $('input[name=subtotal_ppn]').val(subtotal_barang_ppn);
    //   console.log("ppn " + subtotal_barang_ppn);
    // });
    // $('.status-pajak').each(function () {
    //   subtotal_barang_ppn = 0;
    //   subtotal_barang_non_ppn = 0;
    //   if($(this).val() == 'ppn'){
    //     $('.total_barang').each(function () {
    //       subtotal_barang_ppn += parseInt($(this).val());
    //       $('input[name=subtotal_ppn]').val(subtotal_barang_ppn);
    //       console.log("ppn " + subtotal_barang_ppn);
    //     });
    //   }
    //   else if($(this).val() == 'non-ppn'){
    //     $('.total_barang').each(function () {
    //       subtotal_barang_non_ppn += parseInt($(this).val());
    //       $('input[name=subtotal_non_ppn]').val(subtotal_barang_non_ppn);
    //       console.log("non-ppn" + subtotal_barang_non_ppn);
    //     });
    //   }
    // });
    $(".total_barang_ppn").each(function() {
        subtotal_barang_ppn += parseInt($(this).val());
        $("input[name=subtotal_ppn]").val(subtotal_barang_ppn);
        // console.log("ppn " + subtotal_barang_ppn);
    });
    $(".total_barang_non_ppn").each(function() {
        subtotal_barang_non_ppn += parseInt($(this).val());
        $("input[name=subtotal_non_ppn]").val(subtotal_barang_non_ppn);
        // console.log("non_ppn" + subtotal_barang_non_ppn);
    });
    var subtotal_barang = subtotal_barang_ppn + subtotal_barang_non_ppn;
    $(".nilai-subtotal1-td").html(
        "Rp. " + parseInt(subtotal_barang).toLocaleString()
    );
    $(".nilai-subtotal2-td").val(subtotal_barang);
}

function diskonBarang() {
    var subtotal = parseInt($("input[name=subtotal]").val());
    var diskon = parseInt($("input[name=diskon]").val());
    var total = subtotal - (subtotal * diskon) / 100;
    $(".nilai-total1-td").html("Rp. " + parseInt(total).toLocaleString());
    $(".nilai-total2-td").val(total);
    $(".bayar-input-modal").val(total);
}

function jumlahBarang() {
    var jumlah_barang = 0;
    $(".jumlah_barang_text").each(function() {
        jumlah_barang += parseInt($(this).text());
    });
    $(".jml-barang-td").html(jumlah_barang + " Barang");
}

function tambahData(
    kode,
    nama,
    harga,
    pack,
    stok,
    status_pajak,
    status,
    jenis_kemasan,
    jumlah_barang
) {
    var harga_total = jumlah_barang * harga;
    var kode_jenis_kemasan;
    if (jenis_kemasan == "dos") {
        kode_jenis_kemasan = 1;
    } else if (jenis_kemasan == "pack") {
        kode_jenis_kemasan = 2;
    }
    var jenis_kemasan_kode = jenis_kemasan;
    var tambah_data =
        '<tr><td><input type="text" name="kode_barang[]" hidden="" value="' +
        kode +
        '"><span class="nama-barang-td">' +
        nama +
        '</span><span class="kode-barang-td">' +
        kode +
        '</span></td><td><input type="text" name="harga_barang[]" hidden="" value="' +
        harga +
        '"><span>Rp. ' +
        parseInt(harga).toLocaleString() +
        '</span></td><td><div class="d-flex justify-content-start align-items-center"><input type="text" name="jumlah_barang[]" hidden="" value="' +
        jumlah_barang +
        '"><a href="#" class="btn-operate mr-2 btn-tambah"><i class="mdi mdi-plus"></i></a><span class="ammount-product mr-2" unselectable="on" onselectstart="return false;" onmousedown="return false;"><p class="jumlah_barang_text">' +
        jumlah_barang +
        '</p></span><a href="#" class="btn-operate btn-kurang"><i class="mdi mdi-minus"></i></a><b style="text-transform:uppercase">&nbsp;&nbsp;' +
        jenis_kemasan_kode +
        '</b></div></td><td><input type="text" class="total_barang_' +
        status_pajak +
        '" name="total_barang_' +
        status_pajak +
        '[]" hidden="" value="' +
        harga_total +
        '"><span>Rp. ' +
        parseInt(harga_total).toLocaleString() +
        '</span></td><td><a href="#" class="btn btn-icons btn-rounded btn-secondary ml-1 btn-hapus"><i class="mdi mdi-close"></i></a></td><td hidden=""><span>' +
        stok +
        "</span><span>" +
        status +
        "</span><span class='jenis-kemasan-td'>" +
        jenis_kemasan +
        "</span><span>" +
        "</span><span class='kode-jenis-td'>" +
        kode +
        " " +
        jenis_kemasan +
        "</span><span class='pack'>" +
        pack +
        '</span><input type="text" class="status-pajak" name="status_pajak" hidden="" value="' +
        status_pajak +
        '"><input type="text" name="subtotal_ppn" hidden="" value=""><input type="text" name="subtotal_non_ppn" hidden="" value=""><input type="text" name="kode_jenis_kemasan[]" hidden="" value="' +
        kode_jenis_kemasan +
        '"></td></tr>';
    //  console.log(tambah_data);
    $(".table-checkout").append(tambah_data);
    subtotalBarang(harga, jumlah_barang, status_pajak);
    diskonBarang();
    jumlahBarang();
    $(".close-btn").click();
}

function dataCustomer(nama, handphone) {
    var data =
        "<tr><td>Nama: </td><td>" +
        nama +
        "</td></tr><tr><td>Handphone: </td><td>" +
        handphone +
        "</td></tr>";
    $("#data_customer").empty();
    $("#data_customer").append(data);
}

$(document).on("click", ".btn-tambah", function(e) {
    e.preventDefault();
    var stok = parseInt(
        $(this).parent().parent().next().next().next().children().eq(0).text()
    );
    // console.log("stok : " + stok);
    var status = parseInt(
        $(this).parent().parent().next().next().next().children().eq(1).text()
    );
    var jenis_kemasan = $(this)
        .parent()
        .parent()
        .next()
        .next()
        .next()
        .children()
        .eq(2)
        .text();
    // var pack = $(this)
    //     .parent()
    //     .parent()
    //     .next()
    //     .next()
    //     .next()
    //     .children()
    //     .eq(3)
    //     .text();
    var pack = $(".pack", $(this).closest("tr")).text();
    // console.log("pack : " + pack);
    var jumlah_barang = parseInt($(this).prev().val());
    // console.log("+ 1 :" + jumlah_barang);

    if (jumlah_barang < stok) {
        if (jenis_kemasan == "dos") {
            var mod_stok = stok / pack;
            // console.log("mod stok : " + parseInt(mod_stok));
            // var jumlah_barang_dos = jumlah_barang * pack;
            if (
                (parseInt(mod_stok) > jumlah_barang && status == 1) ||
                status == 0
            ) {
                var tambah_barang = jumlah_barang + 1;
                $(this).prev().val(tambah_barang);
                $(this).next().children().first().html(tambah_barang);
                var harga = parseInt(
                    $(this).parent().parent().prev().children().first().val()
                );
                var total_barang = harga * tambah_barang;
                $(this)
                    .parent()
                    .parent()
                    .next()
                    .children()
                    .first()
                    .val(total_barang);
                $(this)
                    .parent()
                    .parent()
                    .next()
                    .children()
                    .eq(1)
                    .html("Rp. " + parseInt(total_barang).toLocaleString());
                subtotalBarang();
                diskonBarang();
                jumlahBarang();
            } else {
                swal({
                    title: "Jumlah sudah melebihi stok batas " + jenis_kemasan,
                    text: "",
                    icon: "error",
                    button: "Ok",
                });
            }
        } else if (jenis_kemasan == "pack") {
            var mod_stok = stok % pack;
            if (
                (parseInt(mod_stok) > jumlah_barang && status == 1) ||
                status == 0
            ) {
                var tambah_barang = jumlah_barang + 1;
                $(this).prev().val(tambah_barang);
                $(this).next().children().first().html(tambah_barang);
                var harga = parseInt(
                    $(this).parent().parent().prev().children().first().val()
                );
                var total_barang = harga * tambah_barang;
                $(this)
                    .parent()
                    .parent()
                    .next()
                    .children()
                    .first()
                    .val(total_barang);
                $(this)
                    .parent()
                    .parent()
                    .next()
                    .children()
                    .eq(1)
                    .html("Rp. " + parseInt(total_barang).toLocaleString());
                subtotalBarang();
                diskonBarang();
                jumlahBarang();
            } else {
                swal({
                    title: "Jumlah sudah melebihi stok batas " + jenis_kemasan,
                    text: "",
                    icon: "error",
                    button: "Ok",
                });
            }
        }
    } else {
        swal({
            title: "Jumlah sudah melebihi stok batas " + jenis_kemasan,
            text: "",
            icon: "error",
            button: "Ok",
        });
    }
});

$(document).on("click", ".btn-kurang", function(e) {
    e.preventDefault();
    var jumlah_barang = parseInt($(this).prev().prev().prev().val());
    if (jumlah_barang > 1) {
        var kurang_barang = jumlah_barang - 1;
        $(this).prev().prev().prev().val(kurang_barang);
        $(this).prev().children().first().html(kurang_barang);
        var harga = parseInt(
            $(this).parent().parent().prev().children().first().val()
        );
        var total_barang = harga * kurang_barang;
        $(this).parent().parent().next().children().first().val(total_barang);
        $(this)
            .parent()
            .parent()
            .next()
            .children()
            .eq(1)
            .html("Rp. " + parseInt(total_barang).toLocaleString());
        subtotalBarang();
        diskonBarang();
        jumlahBarang();
    }
});

$(document).on("click", ".btn-hapus", function(e) {
    e.preventDefault();
    $(this).parent().parent().remove();
    subtotalBarang();
    diskonBarang();
    jumlahBarang();
    setTimeout(function() {
        $("#item_search").find("option").remove();
        $("#item_search").focus();
    }, 0);
});

$(document).on("click", ".ubah-diskon-td1", function(e) {
    e.preventDefault();
    $(".diskon-input").prop("hidden", false);
    $(".diskon-input-value").prop("hidden", false);
    $(".nilai-diskon-td").prop("hidden", true);
    $(".nilai-diskon-value-td").prop("hidden", true);
    $(".simpan-diskon-td").prop("hidden", false);
    $(this).prop("hidden", true);
});

$(document).on("click", ".simpan-diskon-td", function(e) {
    e.preventDefault();
    $(".diskon-input").prop("hidden", true);
    $(".diskon-input-value").prop("hidden", true);
    $(".nilai-diskon-td").prop("hidden", false);
    $(".nilai-diskon-value-td").prop("hidden", false);
    $(".ubah-diskon-td").prop("hidden", false);
    $(this).prop("hidden", true);
    diskonBarang();
});

$(document).on("input", ".diskon-input", function() {
    $(".nilai-diskon-td").html($(this).val());
    var diskon_1 = $(this).val();
    var subtotal = $("input[name=subtotal]").val();
    var diskon_value =
        parseInt(subtotal) - parseInt(subtotal) * (diskon_1 / 100);
    $("#diskon_value").val(diskon_value);
    $(".nilai-diskon-value-td").html(diskon_value);
    if ($(this).val().length > 0) {
        $(this).removeClass("is-invalid");
    } else {
        $(this).addClass("is-invalid");
    }
    console.log($(".diskon-input-value").val());
});

$(document).on("input", ".diskon-input-value", function() {
    $(".nilai-diskon-value-td").html($(this).val());
    var diskon_value = $(this).val();
    var subtotal = $("input[name=subtotal]").val();
    var discount_total =
        ((parseInt(subtotal) - diskon_value) / parseInt(subtotal)) * 100;
    $("#diskon").val(discount_total);
    $(".nilai-diskon-td").html(discount_total);
    if ($(this).val().length > 0) {
        $(this).removeClass("is-invalid");
    } else {
        $(this).addClass("is-invalid");
    }
});

$(document).on("input", ".bayar-input", function() {
    if ($(this).val().length > 0) {
        $(this).removeClass("is-invalid");
        $(".nominal-error").prop("hidden", true);
    } else {
        $(this).addClass("is-invalid");
    }
});

function stopScan() {
    Quagga.stop();
}

$("#scanModal").on("hidden.bs.modal", function(e) {
    $("#area-scan").prop("hidden", true);
    $("#btn-scan-action").prop("hidden", true);
    $(".barcode-result").prop("hidden", true);
    $(".barcode-result-text").html("");
    $(".kode_barang_error").prop("hidden", true);
    stopScan();
});

$(document).ready(function() {
    $("#customer_search").focus();
    $("input[name=search]").on("keyup", function() {
        var searchTerm = $(this).val().toLowerCase();
        $(".product-list li").each(function() {
            var lineStr = $(this).text().toLowerCase();
            // console.log(lineStr);
            if (lineStr.indexOf(searchTerm) == -1) {
                $(this).addClass("non-active-list");
                $(this).removeClass("active-list");
            } else {
                $(this).addClass("active-list");
                $(this).removeClass("non-active-list");
            }
        });
    });
});