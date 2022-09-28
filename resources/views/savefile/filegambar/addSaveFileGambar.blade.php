@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<form action="{{ url('/po-bahanbaku/add') }}" method="POST">
        @csrf
        <div class="row page-title-header">
            <div class="col-12">
                <div class="page-header d-flex justify-content-between align-items-center">
                    <h4 class="page-title">Save File Gambar</h4>
                    <div class="d-flex justify-content-start">
                        {{-- <div class="text-right">
                            <button type="button" class="btn btn-secondary" onclick="location.href='{{ url('/po-bahanbaku') }}'">Cancel</button>
                        </div>  --}}
                    </div>
                </div>
            </div>
        </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="nama" class="text">Nama</label>
                    </div>
                    <div class="col-10">
                        <input type="text" class="form-control textField" id="nama" placeholder="Masukkan Nama" name="nama">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <div class="row">
                    <div class="col-2">
                        <label for="upload-file-gambar" class="text">Upload File Gambar Design</label>
                    </div>
                    <div class="col-10">
                        <input type="file" class="textField" id="upload_file_gambar" name="upload_file_gambar">
                    </div>                
                </div>
            </div>
            
            <div class="text-right">
                <button type="button" class="btn btn-danger"  onclick="location.href='{{ url('save-file-gambar') }}'"><i class="mdi mdi-cancel"></i>Cancel</button>
                <button type="button" class="btn btn-success"><i class="mdi mdi-content-save"></i>Save</button>
            </div>
    </form>
@endsection

@section('script')
<script src="{{ asset('js/manage_customer/customer/script.js') }}"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript">
    
    $(document).ready(function() {
        $('#supplier_id').select2();
    });

    $(document).ready(function() {
        $('#bahan_baku_id').select2();
    });

    var halamansekarang=1;
    function gantiHalamanDepan(){
        halamansekarang+=1;
        if(halamansekarang>=4){
            halamansekarang=4;
        }
        if (halamansekarang==1){
            $("#halaman1").show();
            $("#halaman2").hide();
            $("#halamanDepan").show();
            $("#halamanBelakang").hide();
            $("#halamanSubmit").hide();
            
        }
        else if (halamansekarang==2){
            $("#halaman1").hide();
            $("#halaman2").show();
            $("#halamanDepan").hide();
            $("#halamanBelakang").show();
            $("#halamanSubmit").show();
            
        }
        
    }
    function gantiHalamanBelakang(){
        halamansekarang-=1;
        if(halamansekarang<=1){
            halamansekarang=1;
        }
        if (halamansekarang==1){
            $("#halaman1").show();
            $("#halaman2").hide();
            $("#halamanDepan").show();
            $("#halamanBelakang").hide();
            $("#halamanSubmit").hide();
            
        }
        else if (halamansekarang==2){
            $("#halaman1").hide();
            $("#halaman2").show();
            $("#halamanDepan").hide();
            $("#halamanBelakang").show();
            $("#halamanSubmit").show();
            
        }
        
    } 

    $('#tambah_del_addr').click(function(){
        var inserted = `<tr>                            
            <td><input  class='form-control form-control-sm' type='text' name='bahan_baku_id[]' value="`+$('#bahan_baku_id').val()+`" readonly/></td>            
            <td><input class='form-control form-control-sm' type='text' name='berat[]' value="`+$('#berat').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='nominal[]' value="`+$('#nominal').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='harga_per_kg[]' value="`+$('#nominal').val()/$('#berat').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='expired_at[]' value="`+$('#expired_at').val()+`" readonly/></td>
        </tr>`

        $('#table_del_addr').append(inserted)
    })
    

    $('#tambah_bank_supp').click(function(){
        var inserted = `<tr>                            
            <td><input class='form-control form-control-sm' type='text' name='bank_supp_nama[]' value="`+$('#bank_supp_nama').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='bank_supp_acc[]' value="`+$('#bank_supp_acc').val()+`" readonly/></td>
            <td><input class='form-control form-control-sm' type='text' name='bank_supp_rek[]' value="`+$('#bank_supp_rek').val()+`" readonly/></td>                                
        </tr>`

        $('#table_bank_supp').append(inserted)
    })

    $('#kurang_del_addr').click(function(){
        $('#table_del_addr').children().last().remove();
    })

    $('#kurang_bank_supp').click(function(){
        $('#table_bank_supp').children().last().remove();
    })
    

    //datatables bank_in
    $(document).ready(function () {
        $("#halaman1").show();
            $("#halaman2").hide();
            $("#halaman3").hide();
            $("#halaman4").hide();
            $("#halamanDepan").hide();
            $("#halamanBelakang").hide();
            $("#halamanSubmit").show();
        $('#table-akun').DataTable({
            dom: 'lBfrtip',
            buttons: [
                'colvis',
                {
                    extend: 'collection',
                    text: 'Export',
                    buttons: [
                        { 
                            extend: 'print',
                            footer: true 
                        },
                        { 
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns:[6,'visible'],
                            },
                            footer: true 
                        },
                        { 
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [6, ':visible' ]
                            },
                            footer: true 
                        },
                        { 
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [6, ':visible' ]
                            }, 
                            footer: true 
                        },
                    ]
                },
            ],
            
            // "language": {
            //     "lengthMenu": "Tampilkan _MENU_ data per halaman",
            //     "zeroRecords": "Tidak ada data",
            //     "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            //     "infoEmpty": "Tidak ada data yang ditampilkan",
            //     "infoFiltered": "(difilter dari _MAX_ total data)",
            //     "search": "Cari:",
            //     "paginate": {
            //         "first": "Awal",
            //         "last": "Akhir",
            //         "next": "Selanjutnya",
            //         "previous": "Sebelumnya"
            //     },
            // },
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
        });
    });

    @if ($message = Session::get('error'))
    swal(
        "",
        "{{ $message }}",
        "error"
    );
  @endif

    @if ($message = Session::get('create_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('update_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('delete_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif  

  @if ($message = Session::get('import_success'))
    swal(
        "Berhasil!",
        "{{ $message }}",
        "success"
    );
  @endif

  @if ($message = Session::get('update_failed'))
    swal(
        "",
        "{{ $message }}",
        "error"
    );
  @endif

  @if ($message = Session::get('supply_system_status'))
    swal(
        "",
        "{{ $message }}",
        "success"
    );
  @endif

  $(document).on('click', '.filter-btn', function(e){
    e.preventDefault();
    var data_filter = $(this).attr('data-filter');
    $.ajax({
      method: "GET",
      url: "{{ url('/customer/filter') }}/" + data_filter,
      success:function(data)
      {
        $('tbody').html(data);
      }
    });
  });

  $(document).on('click', '.btn-edit', function(){
    var data_edit = $(this).attr('data-edit');
    $.ajax({
      method: "GET",
      url: "{{ url('/customer/edit') }}/" + data_edit,
      success:function(response)
      {
        $('input[name=id]').val(response.customer.id);
        $('input[name=nama]').val(response.customer.nama);
        $('input[name=alamat]').val(response.customer.alamat);
        $('input[name=nama_bank]').val(response.customer.nama_bank);
        $('input[name=no_rekening]').val(response.customer.no_rekening);
        $('input[name=phone]').val(response.customer.phone);
        $('input[name=kota]').val(response.customer.kota);
        validator.resetForm();
      }
    });
  });

  $(document).on('click', '.btn-delete', function(e){
    e.preventDefault();
    var data_id = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    swal({
      title: "Apa Anda Yakin?",
      text: "Data Akun "+nama+" akan terhapus, klik oke untuk melanjutkan",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
        window.open("{{ url('/accounting/akun/delete') }}/" + data_id, "_self");
      }
    });
  });

  var validator = $("form[name='update_form']").validate({
        rules: {
            nama: "required",
            kota: "required"
        },
        messages: {
            nama: "Nama customer tidak boleh kosong",
            kota: "Kota customer tidak boleh kosong",
        },
        errorPlacement: function(error, element) {
            var name = element.attr("name");
            $("#" + name + "_error").html(error);
        },
        submitHandler: function(form) {
            form.submit();
        }
  });

  //format rupiah
    var rupiah = document.getElementById('rupiah');
    rupiah.addEventListener('keyup', function(e){
        // tambahkan 'Rp.' pada saat form di ketik
        // gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
        rupiah.value = formatRupiah(this.value, 'Rp. ');
    });
    //fungsi format rupiah
    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }
</script>

@endsection