(function($) {
  $.fn.inputFilter = function(inputFilter) {
    return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
      if (inputFilter(this.value)) {
        this.oldValue = this.value;
        this.oldSelectionStart = this.selectionStart;
        this.oldSelectionEnd = this.selectionEnd;
      } else if (this.hasOwnProperty("oldValue")) {
        this.value = this.oldValue;
        this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
      } else {
        this.value = "";
      }
    });
  };
}(jQuery));

$(".number-input").inputFilter(function(value) {
  return /^-?\d*$/.test(value); 
});

$(document).on('input propertychange paste', '.input-notzero', function(e){
  var val = $(this).val()
  var reg = /^0/gi;
  if (val.match(reg)) {
      $(this).val(val.replace(reg, ''));
  }
});

$(function() {
  $("form[name='manual_form']").validate({
    rules: {
      kode_barang: "required",
      jumlah: "required",
      harga_beli: "required"
    },
    messages: {
      kode_barang: "Kode barang tidak boleh kosong",
      jumlah: "Jumlah tidak boleh kosong",
      harga_beli: "Harga satuan tidak boleh kosong"
    },
    errorPlacement: function(error, element) {
        var name = element.attr("name");
        $("#" + name + "_error").html(error);
    },
    submitHandler: function(form) {
      form.submit();
    }
  });
});

var validator = $("form[name='manual_form']").validate({
    rules: {
      kode_barang: "required",
      jumlah: "required",
      harga_beli: "required"
    },
    messages: {
      kode_barang: "Kode barang tidak boleh kosong",
      jumlah: "Jumlah tidak boleh kosong",
      harga_beli: "Harga satuan tidak boleh kosong"
    },
    errorPlacement: function(error, element) {
        var name = element.attr("name");
        $("#" + name + "_error").html(error);
    },
    submitHandler: function(form) {
      form.submit();
    }
});

$(document).on('click', '.btn-tab', function(){
	$('.btn-tab').toggleClass('btn-tab-active');
});

$(document).on('click', '.btn-pilih', function(e){
  e.preventDefault();
  var kode_barang = $(this).prev().prev().prev().children().next().text();
	var nama_barang = $(this).prev().prev().prev().children().first().text();
  var pack = $(this).prev().children().next().next().val();
  var harga_modal_dos = $(this).prev().children().first().val();
  var harga_modal_pack = $(this).prev().children().next().val();
  var harga_jual_dos = $(this).prev().children().next().next().val();
  var harga_jual_pack = $(this).prev().children().next().next().next().val();
	$('input[name=kode_barang]').val(kode_barang);
	$('input[name=nama_barang]').val(nama_barang);
	$('input[name=pack]').val(pack);
  $('input[name=harga_beli]').val(harga_modal_dos);
	$('input[name=harga_beli_pack]').val(harga_modal_pack);
	$('input[name=harga_jual_dos]').val(harga_jual_dos);
	$('input[name=harga_jual_pack]').val(harga_jual_pack);
  var hasil = $('input[name=harga_beli]').val() / 1.11
  $('input[name=harga_beli_without_ppn]').val(hasil)
  $('input[name=percent_ppn]').val('11')
  if(status_pajak == 'non_ppn'){
    $('input[name=harga_beli_without_ppn]').val('');
    $('input[name=percent_ppn]').val('');
  }
	$('.close-btn').click();
	$('input[name=kode_barang]').valid();
  $('.modal-backdrop').remove();
});

$(document).ready(function(){
  $('input[name=search]').on('keyup', function(){
    var searchTerm = $(this).val().toLowerCase();
    $(".product-list li").each(function(){
      var lineStr = $(this).text().toLowerCase();
      console.log(lineStr);
      if(lineStr.indexOf(searchTerm) == -1){
        $(this).addClass('non-active-list');
        $(this).removeClass('active-list');
      }else{
        $(this).addClass('active-list');
        $(this).removeClass('non-active-list');
      }
    });
  });
});

$(document).on('click', '.btn-delete', function(){
    
    var hasil = $('#subtotal').next().val();
    var current_total = $('#total_harga').val();
    var total = current_total - hasil;
    $('#total_harga').val(total);
    $('.total_harga').text('Rp.' + total.toLocaleString());

    $(this).parents().eq(1).remove();

    var check = $('.kd-barang-field').length;
    if(check != 0){
      $('.btn-simpan').prop('hidden', false);
      $('.wrapper').prop('hidden', false);
    }else{
      $('.btn-simpan').prop('hidden', true);
      $('.wrapper').prop('hidden', true);
    }
  });

$(document).on('click', '.manual_form_btn', function(){
  $('form[name=manual_form]').prop('hidden', false);
  $('form[name=import_form]').prop('hidden', true);
  $('input[name=excel_file]').val('');
  $('.excel-name').html('Pilih File');
  $('.btn-upload').prop('hidden', true);
});

$(document).on('click', '.import_form_btn', function(){
  $('form[name=manual_form]').prop('hidden', true);
  $('form[name=import_form]').prop('hidden', false);
  $('input[name=kode_barang]').val('');
  $('input[name=jumlah]').val('');
  $('input[name=harga_beli]').val('');
});

$(document).on('click', '.excel-file', function(e){
  e.preventDefault();
  $('input[name=excel_file]').click();
});

$('input[name=excel_file]').change(function(){
    var filename = $(this).val().replace(/C:\\fakepath\\/i, '');
    $('.excel-name').html(filename);
    $('.btn-upload').prop('hidden', false);
});