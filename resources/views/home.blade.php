@extends('layouts.app')
@section('title')
    @if ($data)
        {{ $data->title }}
    @endif
@endsection
@section('content')
    @if ($data && $data->slug != 'home')
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">
                <ol>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li>{{ $data->title }}</li>
                </ol>
                <h2 class="float-start">{{ $data->title }}</h2>
                @if ($data->type == 'mitra')
                    <div class="float-end"><a class="btn btn-success" id="register">Registrasi Kemitraan</a></div>
                @endif
            </div>
        </section><!-- End Breadcrumbs 111-->
    @else
        <section id="breadcrumbs" class="breadcrumbs">
        </section>
    @endif
    <section class="inner-page">
        <div class="container">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <?php
            $content = '';
            if ($data) {
                if ($data->type != 'mitra') {
                    $content = str_replace('<iframe', '<iframe class="me-4" style="float:left"', $data->content);
                    $content = str_replace('<img', '<img class="img-fluid"', $content);
                }
            }
            ?>
            {!! $content !!}
            @if ($data && $data->type == 'mitra')
                {{--
                <div class="row">
                    <div class="col-5">
                        <input type="text" class="form-control" placeholder="Nama Perusahaan"aria-label="Nama Perusahaan" id="nama_perusahaan">
                    </div>
                    <div class="col-5">
                        <select class="form-select" aria-label="Default select example" id="jenis_perusahaan">
                            <option selected>Jenis Perijinan</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <div class="col-2 d-grid gap-2">
                        <button type="button" class="btn btn-primary" id="filter">FILTER</button>
                    </div>
                </div>
                --}}
                <div class="row mt-4" id="list_mitra" style="display: {{(session('status')) ? 'none' : 'block'}}">
                    <div class="col">
                        @forelse ($mitra as $item)
                            <a href="javascript:void(0)" data-href="/api/detil-mitra/{{ $item->id }}"
                                class="openPopup"><img
                                    src="{{ $item->logo ? asset('storage/images/' . $item->logo) : '/no-logo.png' }}"
                                    class="img-thumbnail me-2" alt="{{ $item->nama_perusahaan }}" width="200"></a>
                        @empty
                            <h2 class="text-center">Tidak ada data untuk ditampilkan</h2>
                        @endforelse
                    </div>
                </div>
                <div class="row mt-4" id="form" style="display: {{($errors->any()) ? 'block' : 'none'}}">
                    <form action="/register" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mb-3">
                            <label for="nomor_registrasi" class="col-sm-2 col-form-label">Nomor Registrasi</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control @error('nomor_registrasi') is-invalid @enderror" id="nomor_registrasi" name="nomor_registrasi">
                                @error('nomor_registrasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nib" class="col-sm-2 col-form-label">NIB</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control @error('nib') is-invalid @enderror" id="nib" name="nib">
                                @error('nib')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="npwp" class="col-sm-2 col-form-label">NPWP</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control @error('npwp') is-invalid @enderror" id="npwp" name="npwp">
                                @error('npwp')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nama_perusahaan" class="col-sm-2 col-form-label">Nama Perusahaan</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control @error('nama_perusahaan') is-invalid @enderror" id="nama_perusahaan" name="nama_perusahaan">
                                @error('nama_perusahaan')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="brand" class="col-sm-2 col-form-label">Nama Merek Usaha</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control" id="brand" name="brand">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control" id="alamat" name="alamat">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="provinsi_id" class="col-sm-2 col-form-label">Provinsi</label>
                            <div class="col-sm-10 has-validation">
                                <select class="form-select" aria-label="== Pilih Provinsi ==" id="provinsi_id" name="provinsi_id">
                                    <option selected>== Pilih Provinsi ==</option>
                                    @foreach ($provinsi as $item)
                                    <option value="{{$item->code}}">{{$item->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kabupaten_id" class="col-sm-2 col-form-label">Kabupaten/Kota</label>
                            <div class="col-sm-10 has-validation">
                                <select class="form-select" aria-label="== Pilih Kabupaten/Kota ==" id="kabupaten_id" name="kabupaten_id">
                                    <option selected>== Pilih Kabupaten/Kota ==</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="kecamatan_id" class="col-sm-2 col-form-label">Kecamatan</label>
                            <div class="col-sm-10 has-validation">
                                <select class="form-select" aria-label="== Pilih Kecamatan ==" id="kecamatan_id" name="kecamatan_id">
                                    <option selected>== Pilih Kecamatan ==</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="desa_id" class="col-sm-2 col-form-label">Desa/Kelurahan</label>
                            <div class="col-sm-10 has-validation">
                                <select class="form-select" aria-label="== Pilih Desa/Kelurahan ==" id="desa_id" name="desa_id">
                                    <option selected>== Pilih Desa/Kelurahan ==</option>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="telepon" class="col-sm-2 col-form-label">Nomor Telpon/WA</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control" id="telepon" name="telepon">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control" id="email" name="email">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="website" class="col-sm-2 col-form-label">Website</label>
                            <div class="col-sm-10 has-validation">
                                <input type="text" class="form-control" id="website" name="website">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="logo" class="col-sm-2 col-form-label">Logo Perusahaan</label>
                            <div class="col-sm-10 has-validation">
                                <input type="file" class="form-control @error('photo') is-invalid @enderror" id="logo" name="photo" />
                                @error('photo')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Register</button>
                    </form>
                </div>
            @endif
        </div>
    </section>
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="myModalLabel">Detil Mitra</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            const myModal = new bootstrap.Modal('#myModal', {
                keyboard: false
            })
            $('.openPopup').on('click', function() {
                var dataURL = $(this).attr('data-href');
                console.log(dataURL);
                $('.modal-body').load(dataURL, function() {
                    //$('#myModal').modal({show:true});
                    myModal.show()
                });
            });
            $('#filter').on('click', function() {
                var nama_perusahaan = $('#nama_perusahaan').val()
                var jenis_perusahaan = $('#jenis_perusahaan').val()
                $.post("/api/filter-mitra", {
                        nama_perusahaan: nama_perusahaan,
                        jenis_perusahaan: jenis_perusahaan
                    })
                    .done(function(data) {
                        console.log(data);
                    });
            });
            $('#register').on('click', function() {
                $('#list_mitra').hide()
                $('#form').show()
            });
            $("#provinsi_id").change(function(e){
                e.preventDefault()
                $.post("/api/wilayah/kabupaten", {
                    _token: "{{ csrf_token() }}",
                    provinsi_id: e.target.value,
                })
                .done(function(data) {
                    $.each(data, function (i, item) {
						$('#kabupaten_id').append($('<option>', { 
							value: item.code,
							text : item.name
						}));
					});
                });
            });
            $("#kabupaten_id").change(function(e){
                e.preventDefault()
                $.post("/api/wilayah/kecamatan", {
                    _token: "{{ csrf_token() }}",
                    kabupaten_id: e.target.value,
                })
                .done(function(data) {
                    $.each(data, function (i, item) {
						$('#kecamatan_id').append($('<option>', { 
							value: item.code,
							text : item.name
						}));
					});
                });
            });
            $("#kecamatan_id").change(function(e){
                e.preventDefault()
                $.post("/api/wilayah/desa", {
                    _token: "{{ csrf_token() }}",
                    kecamatan_id: e.target.value,
                })
                .done(function(data) {
                    $.each(data, function (i, item) {
						$('#desa_id').append($('<option>', { 
							value: item.code,
							text : item.name
						}));
					});
                });
            });
        });
    </script>
@endsection
