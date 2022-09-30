@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
<div class="row page-title-header">
    <div class="col-12">
        <div class="page-header d-flex justify-content-between align-items-center">
            <h4 class="page-title"> Log File Gambar Terhapus</h4>
            <div class="d-flex justify-content-start">
            </div>
        </div>

    </div>
</div>

<div class="row">
    <div class="col-12 grid-margin">
        <div class="card card-noborder b-radius">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="table-akun">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>tanggal Di dihapus</th>
                                <th>Nama</th>
                                <th>Nama File Gambar</th>
                            </tr>
                        </thead>
                        <tbody>
                            <@foreach ($list_img as $item)
                            <tr>
                              <td>{{ date('d F Y', strtotime($item->created_at)) }}</td>
                              <td>{{ $item->name }}</td>
                              <td>{{ $item->file }}</td>
                          </tr>
                            @endforeach
                            {{-- @foreach ($po_bahan as $i)
                            <tr>
                                <td>{{ $i->id_po_bahan_baku }}</td>
                                <td>{{ $i->nama }}</td>
                                <td>Rp {{ number_format($i->total_nominal) }}</td>
                                <td>{{ $i->created_at }}</td>
                                <td>{{ $i->status }}</td>
                                <td >
                                    <button type="button" class="btn btn-primary btn-sm" onclick="location.href='{{ url('po-bahanbaku/view/'.$i->id) }}'"><i class="mdi mdi-history"></i>Details</button>
                                    @if($i->status == 'Pending')
                                    <button type="button" class="btn btn-danger btn-sm" onclick="location.href='{{ url('po-bahanbaku/delete/'.$i->id) }}'"><i class="mdi mdi-delete"></i>Delete</button>
                                    <button type="button" class="btn btn-success btn-sm" onclick="location.href='{{ url('po-bahanbaku/penerimaan/'.$i->id) }}'"><i class="mdi mdi-account-check"></i>Penerimaan</button>
                                    @endif
                                </td>
                            </tr>
                            @endforeach --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
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
    $(document).ready(function () {
        $('#table-akun').DataTable({                
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