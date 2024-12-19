@extends('templates.app')

@section('content')

@if(Session::get('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ Session::get('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif 
@if(Session::get('deleted'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="fas fa-check-circle me-2"></i>{{ Session::get('deleted') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="container py-5">
    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header border-0 py-4" style="background: linear-gradient(135deg, #6366f1 0%, #4f46e5 100%);">
                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                        <h3 class="text-white mb-0 fw-bold">
                            <i class="fas fa-users-cog me-2"></i>Kelola Akun
                        </h3>
                        <form class="d-flex" action="{{ route('home.akun') }}" role="search" method="GET">
                            <div class="input-group">
                                <input type="search" name="search" class="form-control form-control-lg border-0" 
                                       placeholder="Cari users..." aria-label="Search">
                                <button class="btn btn-light px-4" type="submit">
                                    <i class="fas fa-search text-primary"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div class="card-body p-4">
                    <a href="{{ route('user.create') }}" class="btn btn-primary mb-4 rounded-3 px-4 py-2">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Akun
                    </a>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th class="text-muted fw-semibold">No</th>
                                    <th class="text-muted fw-semibold">Email</th>
                                    <th class="text-muted fw-semibold">Role</th>
                                    <th class="text-center text-muted fw-semibold">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $index => $user)
                                <tr>
                                    <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-sm bg-primary bg-opacity-10 rounded-circle me-3">
                                                <i class="fas fa-user text-primary p-3"></i>
                                            </div>
                                            {{ $user['email'] }}
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary bg-opacity-10 text-primary px-3 py-2 rounded-pill">
                                            {{ $user['role'] }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center gap-2">
                                            <form action="{{route('user.reset' , $user['id'])}}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-soft-info btn-icon">
                                                    <i class="fas fa-key"></i>
                                                </button>
                                            </form>
                                            <button class="btn btn-soft-danger btn-icon" onclick="showModalDelete({{ $user['id'] }}, '{{ $user['email'] }}')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-end mt-4">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Modal -->
<div class="modal fade" id="ModalDeleteUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form id="form-delete-user" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content border-0 rounded-4">
                <div class="modal-header border-0 bg-danger text-white">
                    <h5 class="modal-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>Konfirmasi Hapus
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body py-4">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus akun <span id="nama-user" class="fw-bold"></span>?</p>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger px-4">Hapus</button>
                </div>
            </div>
        </form>
    </div>
</div>

@push('style')
<style>
    .btn-soft-info {
        color: #0dcaf0;
        background-color: rgba(13, 202, 240, 0.1);
    }
    .btn-soft-info:hover {
        color: #fff;
        background-color: #0dcaf0;
    }
    .btn-soft-danger {
        color: #dc3545;
        background-color: rgba(220, 53, 69, 0.1);
    }
    .btn-soft-danger:hover {
        color: #fff;
        background-color: #dc3545;
    }
    .btn-icon {
        width: 35px;
        height: 35px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
    }
    .avatar-sm {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endpush

@push('script')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" crossorigin="anonymous"></script>
<script>
    function showModalDelete(id, email) {
        let action = '{{route('user.delete', ':id')}}';
        action = action.replace(':id', id);
        $('#form-delete-user').attr('action', action);
        $('#ModalDeleteUser').modal('show');
        $('#nama-user').text(email);
    }
</script>
@endpush

@endsection
