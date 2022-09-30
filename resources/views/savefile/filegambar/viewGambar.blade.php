@extends('templates/main')
@section('css')
<link rel="stylesheet" href="{{ asset('css/manage_product/product/style.css') }}">
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
@endsection

@section('content')
    
    <form>
        <div class="row page-title-header" style="margin-top:15px;">
            <div class="col-12">
                <div class="page-header d-flex justify-content-between align-items-center">
                    <h4 class="page-title">Gambar</h4>
                    <div class="d-flex justify-content-start">
                        <div class="text-right">
                            <button type="button" class="btn btn-danger" onclick="location.href='{{ url('/save-file-gambar') }}'"><i class="mdi mdi-keyboard-backspace"></i>Back</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="text-center">
                        <img src="{{ asset('/images/app_admin/'.$list_img->file.'/') }}">
                    </div> 
                </div>
            </div>
        </div> --}}
        <div class="form-group">
            <div class="row">
                <div class="col-2 text-center">
                    <img src="{{ asset('/images/app_admin/'.$list_img->file.'/') }}">
                </div>             
            </div>
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
@endsection