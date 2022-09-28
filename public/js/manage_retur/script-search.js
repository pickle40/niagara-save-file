$(document).ready(function() {
    $("input[name=search]").on("keyup", function() {
        var searchTerm = $(this).val().toLowerCase();
        $("tbody tr").each(function() {
            var lineStr = $(this).text().toLowerCase();
            if (lineStr.indexOf(searchTerm) == -1) {
                $(this).hide();
            } else {
                $(this).show();
            }
        });
    });
});

//select search kode transaksi tampil tbody tr
// $(document).on("change", "select[name=kode_transaksi]", function() {
//     var searchTerm = $(this).val().toLowerCase();
//     $("tbody tr").each(function() {
//         var lineStr = $(this).text().toLowerCase();
//         if (lineStr.indexOf(searchTerm) == -1) {
//             $(this).hide();
//         } else {
//             $(this).show();
//         }
//     });
// });

// {{ url('retur/retur_customer/searchKodeTransaksiById') }}

// $("#search_kodeTransaksi").select2({
//     ajax: {
//         placeholder: "Cari Kode Transaksi",
//         url: "searchKodeTransaksiById",
//         dataType: "json",
//         type: "GET",
//         // delay: 250,
//         processResults: function(data) {
//             return {
//                 results: $.map(data.transaction, function(item) {
//                     return {
//                         text: item.kode_transaksi,
//                         id: item.kode_transaksi,
//                     };
//                 }),
//             };
//         },
//         cache: true,
//     },
// });

// //search data by select kode_transaksi ajax
// $(document).on("change", "select[name=kode_transaksi]", function() {
//     var kode_transaksi = $(this).val();
//     $.ajax({
//         url: "searchKodeTransaksi",
//         type: "GET",
//         data: {
//             kode_transaksi: kode_transaksi,
//         },
//         success: function(data) {
//             $("tbody").html(data);
//         },
//     });
// });

// $.ajaxSetup({ headers: { csrftoken: "{{ csrf_token() }}" } });