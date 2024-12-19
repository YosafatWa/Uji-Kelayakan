@extends('templates.app')

@section('content')
<div class="container min-h-screen d-flex align-items-center justify-content-center py-5">
    <div class="col-12 col-md-6 col-lg-4">
        <div class="card modern-card border-0 shadow rounded-3">
            <div class="card-body p-4">
                @if (Session::get('failed'))
                    <div class="alert alert-danger animate__animated animate__shakeX">
                        <i class="fas fa-exclamation-circle me-2"></i>
                        {{Session('failed')}}
                    </div>
                @endif

                <div class="text-center mb-3">
                    <i class="fas fa-user-circle text-purple mb-2" style="font-size: 3.5rem;"></i>
                    <h3 class="fw-bold text-purple">Selamat Datang</h3>
                    <p class="text-muted small">Silakan masuk untuk melanjutkan</p>
                </div>

                <form action="{{route('loginAuth')}}" method="POST" class="login-form">
                    @csrf
                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-envelope text-purple"></i>
                            </span>
                            <input type="email" 
                                   class="form-control border-0 bg-light" 
                                   name="email" 
                                   id="email" 
                                   placeholder="Email"
                                   required>
                        </div>
                    </div>

                    <div class="form-group mb-3">
                        <div class="input-group">
                            <span class="input-group-text bg-light border-0">
                                <i class="fas fa-lock text-purple"></i>
                            </span>
                            <input type="password" 
                                   class="form-control border-0 bg-light" 
                                   name="password" 
                                   id="password" 
                                   placeholder="Password"
                                   required>
                            <span class="input-group-text bg-light border-0 toggle-password" style="cursor: pointer;">
                                <i class="fas fa-eye text-purple"></i>
                            </span>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-purple btn-lg w-100 mb-2">
                        <i class="fas fa-sign-in-alt me-2"></i>Masuk
                    </button>
                    <a href="{{route('register')}}" class="btn btn-outline-purple btn-lg w-100">Daftar</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<style>
/* Import Font Awesome and Animate.css */
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css');
@import url('https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css');

:root {
    --purple-primary: #6366f1;
    --purple-secondary: #4f46e5;
    --purple-light: #eef2ff;
    --btn-hover-shadow: rgba(99, 102, 241, 0.2);
}

/* Card Styling */
.modern-card {
    background: var(--purple-light);
    border: 1px solid var(--purple-primary);
    box-shadow: 0 10px 20px rgba(99, 102, 241, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.modern-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(99, 102, 241, 0.25);
}

/* Button Styling */
.btn-purple {
    background: linear-gradient(135deg, var(--purple-primary), var(--purple-secondary));
    color: white;
    border: none;
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
}

.btn-purple:hover {
    background: var(--purple-secondary);
    box-shadow: 0 5px 15px var(--btn-hover-shadow);
}

.btn-outline-purple {
    color: var(--purple-primary);
    border: 2px solid var(--purple-primary);
    transition: all 0.3s ease;
}

.btn-outline-purple:hover {
    background-color: var(--purple-primary);
    color: white;
}

/* Input Styling */
.form-control {
    border-radius: 0.375rem;
    transition: box-shadow 0.3s ease, border-color 0.3s ease;
}

.form-control:focus {
    box-shadow: 0 0 0 0.25rem rgba(99, 102, 241, 0.25);
    border-color: var(--purple-primary);
}

.input-group-text {
    background-color: var(--purple-light);
    border-radius: 0.375rem;
}

.input-group:focus-within .input-group-text {
    background-color: white;
    color: var(--purple-primary);
}

/* Animations */
.card {
    animation: fadeInUp 0.7s ease-in-out;
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
    // Toggle Password Visibility
    const togglePassword = document.querySelector('.toggle-password');
    const passwordInput = document.querySelector('#password');

    togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Toggle eye icon
        const eyeIcon = this.querySelector('i');
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });

    // Add loading state to button on form submit
    const form = document.querySelector('.login-form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function() {
        submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Loading...';
        submitBtn.disabled = true;
    });
});
</script>
@endpush
