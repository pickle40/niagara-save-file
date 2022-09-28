$(document).ready(function(){
  $('input[name=search]').on('keyup', function(){
    var searchTerm = $(this).val().toLowerCase();
    $("tbody tr").each(function(){
      var lineStr = $(this).text().toLowerCase();
      if(lineStr.indexOf(searchTerm) == -1){
        $(this).hide();
      }else{
        $(this).show();
      }
    });
  });
});