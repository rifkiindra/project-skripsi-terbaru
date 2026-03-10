@extends('layouts.adminlte')

@section('title', 'Manajemen Anggota')

@section('page-title', 'Daftar Anggota')

@section('content')
<div class="card">
    <div class="mb-3 d-flex justify-content-between align-items-center">
     <h5 class="mb-0">Manajemen Anggota</h5>
    <form action="{{ route('admin.members.index') }}" method="GET" class="d-flex" style="gap: 8px;">
        <input type="text" name="search" class="form-control" 
               placeholder="Cari nama atau email..." 
               value="{{ request('search') }}" style="width: 250px;">
        <button type="submit" class="btn btn-primary">Cari</button>
        @if(request('search'))
            <a href="{{ route('admin.members.index') }}" class="btn btn-secondary">Reset</a>
        @endif
    </form>
        <a href="{{ route('admin.members.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Tambah Anggota
        </a>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle text-center">
                <thead class="thead-dark">
                    <tr>
                        <th>NO</th>
                        <th>NAMA</th>
                        <th>EMAIL</th>
                        <th>NO TELEPON</th>
                        <th>ALAMAT</th>
                        <th>ROLE</th>
                        <th>AKSI</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($members as $index => $member)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $member->nama }}</td>
                            <td>{{ $member->email }}</td>
                            <td>{{ $member->telepon ?? '-' }}</td>
                            <td>{{ $member->alamat ?? '-' }}</td>
                            <td>
                                @if($member->user->role === 'direktur')
                                   <span class="badge bg-danger">Direktur</span>
                                @elseif($member->user->role === 'admin')
                                   <span class="badge bg-success">Admin</span>
                                 @elseif($member->user->role === 'tim')
                                   <span class="badge bg-info">Tim</span>
                                 @else
                                   <span class="badge bg-secondary">Member</span>
                                 @endif
                            </td>

                            <!-- AKSI -->
                            <td>
                                <a href="{{ route('admin.members.show', $member->id) }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-warning btn-sm">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.members.destroy', $member->id) }}" method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7">Belum ada anggota terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
