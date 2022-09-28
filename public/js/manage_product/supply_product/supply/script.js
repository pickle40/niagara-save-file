$(document).ready(function() {
    $(".total-field").each(function() {
        var harga = $(this).prev().children().first().val();
        var jumlah = $(this).prev().prev().text();
        var total = parseInt(harga) * parseInt(jumlah);
        $(this).text("- Rp. " + parseInt(total).toLocaleString() + ",00");
    });
});

// $(document).ready(function(){
//   $('input[name=search]').on('keyup', function(){
//     var searchTerm = $(this).val().toLowerCase();
//     $(".list-date table").each(function(){
//       var lineStr = $(this).text().toLowerCase();
//       if(lineStr.indexOf(searchTerm) == -1){
//         $(this).hide();
//         $(this).parent().prev().hide();
//       }else{
//         $(this).show();
//         $(this).parent().prev().show();
//       }
//     });
//   });
// });

// $('.dropdown-search').on('hide.bs.dropdown', function () {
//   $('.list-date table').show();
//   $('.list-date table').parent().prev().show();
//   $('input[name=search]').val('');
// });

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