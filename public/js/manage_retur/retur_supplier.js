// $("#search-supplier").select2({
//     ajax: {
//         placeholder: "Cari Supplier",
//         url: "{{ url('retur/retur_supplier/searchSupplier') }}",
//         dataType: "json",
//         type: "GET",
//         // delay: 250,
//         processResults: function(data) {
//             return {
//                 results: $.map(data.supplier, function(item) {
//                     return {
//                         text: item.nama,
//                         id: item.id,
//                     };
//                 }),
//             };
//         },
//         cache: true,
//     },
// });