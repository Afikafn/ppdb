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
    Pengguna
@endsection

@section('menu')
    @auth
        <ul class="metismenu" id="menu">
            <li><a href="dashboard">
                    <i class="fas fa-home"></i>
                    <span class="nav-text">Pengguna</span>
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
                        <li><a href="{{route('data-jurusan')}}">jurusan</a></li>
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
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">User Data</h4>

                    <!-- center modal -->
                    <div>
                        <button class="btn btn-info waves-effect waves-light mb-4" onclick="printDiv('cetak')"><i
                                class="fa fa-print"> </i></button>
                        <!--<button class="btn btn-secondary waves-effect waves-light mb-4"><i class="fas fa-eye"
                                title="Mode grid"> </i></button>-->
                        <button type="button" class="btn btn-primary mb-4" data-bs-toggle="modal" data-bs-target=".modal"
                            style="margin-bottom: 1rem;"><i class="mdi mdi-plus me-1"></i>Tambahkan Pengguna</button>
                    </div>


                    <div class="modal fade modal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Tambah Pengguna</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="/save-user" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xl-12">
                                                    <label for="idusers">Nama</label>
                                                    <input type="text" class="form-control" id="name"
                                                        placeholder="Masukkan Nama" name="name" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="iduser">Email</label>
                                            <input type="email" class="form-control" id="email"
                                                placeholder="Masukkan Email" name="email" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="iduser">Kata Sandi</label>
                                            <input type="password" class="form-control" id="password"
                                                placeholder="Masukkan Kata Sandi" name="password" required>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label for="iduser">Jenis Kelamin</label>
                                                    <select class="default-select form-control wide" title="Jenis Kelamin"
                                                        name="gender" required>
                                                        <option value="Laki-laki" disabled>Pilih Jenis Kelamin</option>
                                                        <option value="Perempuan">Perempuan</option>
                                                        <option value="Laki-laki">Laki-laki</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="iduser">Telepon</label>
                                                    <input type="text" class="form-control" placeholder="Enter Telepon"
                                                        name="nohp" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-xl-6">
                                                    <label for="iduser">Role Pengguna</label>
                                                    <select class="default-select form-control wide" title="Country" aria-placeholder="Pilih role"
                                                        name="level" required>
                                                        <option value="Calon Mahasiswa" disabled>Pilih Role</option>
                                                        <option value="Administrator">Administrator</option>
                                                        <option value="Calon Mahasiswa">Calon Siswa</option>
                                                    </select>
                                                </div>
                                                <div class="col-xl-6">
                                                    <label for="iduser">Foto Profil</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text">Upload</span>
                                                        <div class="form-file">
                                                            <input type="file" class="form-file-input form-control"
                                                                name="foto">
                                                        </div>
                                                    </div>
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
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" id="cetak">
                        @csrf
                        <table id="example3" class="display" style="min-width: 845px">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Telepon</th>
                                    <th>Email</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                               
                                @foreach ($kode as $x)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $x->nama }}</td>
                                        <td>{{ $x->gender }}</td>
                                        <td>{{ $x->no_hp }}</td>
                                        <td>{{ $x->email }}</td>

                                        <td>
                                            <div class="d-flex">
                                                <a class="btn btn-light shadow btn-xs sharp me-1" title="Data Registration"
                                                    href="{{route('edit-user',$x->id)}}"><i class="fa fa-file-alt"></i></a>
                                                <a class="btn btn-primary shadow btn-xs sharp me-1" title="Edit"
                                                    href="{{route('edit-user',$x->id)}}"><i
                                                        class="fa fa-pencil-alt"></i></a>
                                                <a class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"
                                                            data-bs-toggle="modal"
                                                            data-bs-target=".delete{{  $x->id }}"></i></a>
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
                                                                        <form action="{{ route('delete-user', $x->id) }}" method="POST">
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
