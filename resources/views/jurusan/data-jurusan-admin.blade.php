@extends('master.master-admin')

@section('title')
    PPDB SMAKDA
@endsection

@section('header')
@endsection

@section('navbar')
    @parent
@endsection

@section('menunya')
    Jurusan
@endsection

@section('menu')
@auth
        <ul class="metismenu" id="menu">
            <li><a href="{{route('dashboard')}}">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Beranda</span>
                </a>
            </li>
            @if (auth()->user()->role == 'Administrator')
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-book"></i>
                        <span class="nav-text">Data Master </span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('data-user')}}">Pengguna</a></li>
                        <li><a href="{{route('data-sekolah')}}">Sekolah</a></li>
                        <li><a href="{{route('data-jurusan')}}">Jurusan</a></li>
                        <li><a href="{{route('data-jadwal')}}">Jadwal Kegiatan</a></li>
                    </ul>
                </li>
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                        <i class="fa fa-database"></i>
                        <span class="nav-text">Data Transaksi</span>
                    </a>
                    <ul aria-expanded="false">
                        <li><a href="{{route('data-registration')}}">Pendaftaran</a></li>
                    </ul>
                </li>
                <li><a href="{{route('data-pengumuman')}}" aria-expanded="false">
                        <i class="fa fa-file"></i>
                        <span class="nav-text">Pengumuman</span>
                    </a>
                </li>
            @else
                <li><a href="{{route('data-registration')}}" aria-expanded="false">
                    <i class="fa fa-database"></i>
                        <span class="nav-text">Pendaftaran</span>
                    </a>
                </li>
            @endif
        </ul>
    @endauth
@endsection

@section('content')
@error('success')
<div class="alert alert-success alert-dismissible fade show">
    <svg viewbox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="me-2"><polyline points="9 11 12 14 22 4"></polyline><path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path></svg>	
    <strong>Sukses!</strong> Data berhasil disimpan.
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="btn-close">
    </button>
</div>
@enderror
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Data Jurusan</h4>

                    <!-- center modal -->
                    <div>
                        <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                                class="fa fa-print"> </i></button>
                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal"
                            style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Tambah Jurusan</button>
                    </div>

                    <div class="modal fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Jurusan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('save-jurusan') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="userid" value="{{ auth()->user()->id}}">
                                        <div class="form-group">
                                            <label for="iduser">Nama Jurusan</label>
                                            <input type="text" class="form-control" id="nama"
                                                placeholder="Masukkan Nama Jurusan" name="nama" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="iduser">Foto Jurusan</label>
                                            <div class="input-group">
                                                <span class="input-group-text">Upload</span>
                                                <div class="form-file">
                                                    <input type="file" class="form-file-input form-control" name="foto">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer border-top-0 d-flex">
                                            <button type="button" class="btn btn-danger light"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" name="add" class="btn btn-primary">Tambah Data</button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- /.modal-content -->
                        </div><!-- /.modal-dialog -->
                    </div><!-- /.modal -->
                </div>
                <div class="card-body" id="cetak">
                    <div class="table-responsive">
                        @csrf

                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama Jurusan</th>
                                    <th>Gambar</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($viewData as $x)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $x->id_jurusan }}</td>
                                        <td>{{ $x->nama_jurusan }}</td>
                                        <td><img src="{{ asset($x->foto_jurusan) }}" width="200px" height="200" alt=""></td>
                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                    data-bs-toggle="modal" data-bs-target=".edit{{ $x->id }}"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"
                                                        data-bs-toggle="modal"
                                                        data-bs-target=".delete{{ $x->id }}"></i></a>
                                                <div class="modal fade delete{{ $x->id }}" tabindex="-1"
                                                    role="dialog" aria-hidden="true">
                                                    <div class="modal-dialog modal-sm">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hapus Data</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal">
                                                                </button>
                                                            </div>
                                                            <div class="modal-body text-center"><i
                                                                    class="fa fa-trash"></i><br> Apakah anda yakin ingin
                                                                menghapus data ini?<br> {{ $x->id }}
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-danger light"
                                                                    data-bs-dismiss="modal">Batalkan</button>
                                                                    <form action="{{ route('delete-jurusan', $x->nama_jurusan) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini?');">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Ya, Hapus Data Ini</button>
                                                                    </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                    <div class="modal fade edit{{ $x->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="mySmallModalLabel" aria-hidden="true">

                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Sunting Jurusan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="update-jurusan/{{ $x->id }}" method="POST"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="hidden" name="userid" value="{{ auth()->user()->id}}">
                                                        <div class="form-group">
                                                            <input type="hidden" name="id" id="nama" class="form-control"
                                                                value="{{ $x->id }}">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <label for="iduser">Nama Jurusan</label>
                                                                    <input type="text" class="form-control" id="nama"
                                                                        value="{{ $x->nama_jurusan }}"
                                                                        placeholder="Masukan Nama Jurusan" name="nama"
                                                                        required>
                                                                </div>
                                                                <div class="col-xl-12">
                                                                    <label for="iduser">Foto Jurusan</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-text">Upload</span>
                                                                        <div class="form-file">
                                                                            <input type="file" class="form-file-input form-control" name="foto"
                                                                                value="{{ old('foto') }}">
                                                                            <input type="hidden" name="pathnya" class="form-control-file"
                                                                                value="{{ $x->foto_jurusan }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer border-top-0 d-flex">
                                                            <button type="button" class="btn btn-danger light"
                                                                data-bs-dismiss="modal">Tutup</button>
                                                            <button type="submit" name="add"
                                                                class="btn btn-primary">Perbaharui
                                                                Data</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div><!-- /.modal -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
@endsection
