@extends('templates.app')

@section('content')
<div class="container min-h-screen d-flex align-items-center justify-content-center py-5">
    <div class="col-12 col-md-8 col-lg-6">
        <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
            <div class="card-body p-5">
                @if(Session::get('success'))
                    <div class="alert alert-success animate__animated animate__fadeIn">
                        <i class="fas fa-check-circle me-2"></i>
                        {{Session::get('success')}}
                    </div>
                @endif   

                @if($errors->any())
                    <div class="alert alert-danger animate__animated animate__shakeX">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="text-center mb-4">
                    <i class="fas fa-user-plus text-purple mb-3" style="font-size: 4rem;"></i>
                    <h2 class="fw-bold text-purple">Tambah User Baru</h2>
                    <p class="text-muted">Silahkan isi form dibawah ini</p>
                </div>

                <form action="{{ route('user.store') }}" method="POST">
                    @csrf                
                    <div class="form-group mb-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-envelope text-purple"></i>
                            </span>
                            <input type="email" 
                                   class="form-control form-control-lg border-0 bg-light" 
                                   name="email" 
                                   id="email" 
                                   placeholder="Masukan Email"
                                   value="{{old('email')}}">
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-lock text-purple"></i>
                            </span>
                            <input type="password" 
                                   class="form-control form-control-lg border-0 bg-light" 
                                   name="password" 
                                   id="password" 
                                   placeholder="Masukan Password"
                                   value="{{old('password')}}">
                            <span class="input-group-text bg-light border-0 toggle-password" style="cursor: pointer;">
                                <i class="fas fa-eye text-purple"></i>
                            </span>
                        </div>
                    </div>

                    <div class="form-group mb-4">
                        <div class="input-group input-group-lg">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-user-tag text-purple"></i>
                            </span>
                            <select class="form-select form-select-lg border-0 bg-light" name="role" id="role">
                                <option selected disabled hidden>Pilih Role</option>
                                <option value="GUEST" {{old('GUEST')}}>GUEST</option>
                                <option value="STAFF" {{old('STAFF')}}>STAFF</option>
                                <option value="HEAD_STAFF" {{old('HEAD_STAFF')}}>Head Staff</option>
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-purple btn-lg w-100 mt-4">
                        <i class="fas fa-plus-circle me-2"></i>Tambah Data
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
/* Import Font Awesome and Animate.css */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

:root {
    --purple-primary: #6366f1;
    --purple-secondary: #4f46e5;
    --purple-light: #eef2ff;
}

.card {
    backdrop-filter: blur(10px);
    background: rgba(255, 255, 255, 0.98);
    transition: all 0.3s ease;
    border: 1px solid var(--purple-light);
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(99, 102, 241, 0.1);
}

.text-purple {
    color: var(--purple-primary);
}

.btn-purple {
    background: linear-gradient(135deg, var(--purple-primary), var(--purple-secondary));
    color: white;
    border: none;
    transition: all 0.3s ease;
}

.btn-purple:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(99, 102, 241, 0.3);
    color: white;
}

.form-control:focus, .form-select:focus {
    box-shadow: none;
    border: none;
    background: white !important;
}

.input-group-text {
    transition: all 0.3s ease;
}

.input-group:focus-within .input-group-text {
    background: white !important;
}

.form-control, .form-select {
    transition: all 0.3s ease;
}

.form-control:hover, .form-select:hover {
    background: var(--purple-light) !important;
}

.card {
    animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');
    
    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        const eyeIcon = this.querySelector('i');
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
});
</script>
@endsection