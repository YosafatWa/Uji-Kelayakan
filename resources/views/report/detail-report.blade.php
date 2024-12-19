@extends('templates.app')

@push('styles')
<style>
    :root {
        --primary-purple: #6c5ce7;
        --light-purple: #a29bfe;
        --dark-purple: #4834d4;
        --bg-purple: #f5f3ff;
        --font-family: 'Poppins', sans-serif; /* Modern font */
    }

    body {
        background-color: var(--bg-purple);
        font-family: var(--font-family);
    }

    .card {
        border: none;
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        transition: transform 0.3s ease, box-shadow 0.3s ease; /* Smooth transition */
    }

    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2); /* Enhanced shadow on hover */
    }

    .card-img-top {
        border-radius: 1rem 1rem 0 0;
        transition: transform 0.5s ease, filter 0.5s ease; /* Added filter for brightness */
    }

    .card-img-top:hover {
        transform: scale(1.05);
        filter: brightness(1.1); /* Slightly brighten image on hover */
    }

    .card-body {
        background: white;
        border-radius: 0 0 1rem 1rem;
    }

    .comment-card {
        opacity: 0;
        animation: fadeInUp 0.6s forwards;
        border-left: 4px solid var(--primary-purple);
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

    .comment-form {
        background: white;
        transition: all 0.3s ease;
        border-radius: 1rem;
    }

    .comment-form:hover {
        box-shadow: 0 0 30px rgba(108, 92, 231, 0.1);
    }

    .btn-primary {
        background-color: var(--primary-purple);
        border: none;
        border-radius: 0.5rem;
        padding: 1rem; /* Increased padding for better touch targets */
        transition: background-color 0.3s ease, transform 0.3s ease; /* Smooth transitions */
    }

    .btn-primary:hover {
        background-color: var(--dark-purple);
        transform: scale(1.05); /* Slightly enlarge on hover */
    }

    .form-control {
        border: 2px solid var(--light-purple);
        border-radius: 0.5rem;
    }

    .form-control:focus {
        border-color: var(--primary-purple);
        box-shadow: 0 0 0 0.2rem rgba(108, 92, 231, 0.25);
    }

    .badge {
        padding: 0.5em 1em;
        border-radius: 0.5rem;
    }
</style>
@endpush

@section('content')
<div class="container py-5">
    <div class="row g-4">
        <div class="col-12">
            <div class="card shadow-lg overflow-hidden" data-aos="fade-up">
                <img src="{{ asset('assets/images/' . (old('image', $report->image) ?? 'default.jpg')) }}" 
                     class="card-img-top img-fluid" 
                     alt="Image of {{ old('name', $report->name) ?? 'No Name' }}" 
                     style="height: 400px; object-fit: cover;">
                <div class="card-body p-4">
                    <h2 class="card-title mb-3 fw-bold text-purple-800">{{ old('name', $report->description) ?? 'Nama tidak tersedia' }} 🔍</h2>
                    <div class="row g-3">
                        <div class="col-md-6">
                            <p class="mb-2 text-purple-600"><strong>Penulis:</strong> {{ old('user', $report->user->email) ?? 'Penulis tidak tersedia' }} 👤</p>
                            <p class="mb-2 text-purple-600"><strong>Tanggal:</strong> {{ old('date', $report->created_at->format('Y-m-d')) ?? 'Tanggal tidak tersedia' }} 📅</p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2 text-purple-600"><strong>Type:</strong> {{ old('type', $report->type) ?? 'Tidak diketahui' }} 🏷️</p>
                            <p class="mb-2">
                                <strong class="text-purple-600">Status:</strong> 
                                <span class="badge {{ $report->response?->response_status == 'DONE' ? 'bg-success' : ($report->response?->response_status == 'REJECTED' ? 'bg-danger' : ($report->response?->response_status == 'ON_PROGRESS' ? 'bg-primary' : 'bg-warning')) }}">
                                    {{ ucfirst($report->response?->response_status) }}
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <h2 class="text-center mb-4 text-purple-800">Komentar 💬</h2>
        
        <div class="row g-4">
            <div class="col-12">
                @forelse ($comments as $index => $comment)
                <div class="card comment-card shadow-sm mb-3" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="card-body">
                        <div class="d-flex align-items-center mb-2">
                            <h5 class="card-title mb-0 me-2 text-purple-700">{{ $comment['user']['email'] }}</h5>
                            <small class="text-purple-500">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="card-text text-purple-600">{{ $comment->comment }}</p>
                    </div>
                </div>
                @empty
                <div class="alert alert-info text-center" role="alert">
                    Belum ada komentar 🤷‍♀️
                </div>
                @endforelse
            </div>
        </div>

        <!-- Form Tambah Komentar -->
        <div class="row mt-5">
            <div class="col-md-8 mx-auto">
                <div class="card shadow-lg comment-form">
                    <div class="card-body p-4">
                        <h4 class="card-title text-center mb-4 text-purple-800">Tambah Komentar 💡</h4>
                        <form action="{{ route('report.comment', $report->id) }}" method="post">
                            @csrf
                            <div class="form-floating mb-3">
                                <textarea 
                                    class="form-control @error('comment') is-invalid @enderror" 
                                    id="comment" 
                                    name="comment" 
                                    style="height: 150px;" 
                                    placeholder="Tulis komentar Anda di sini..."
                                    required
                                ></textarea>
                                <label for="comment" class="text-purple-600">Tulis komentar Anda 📝</label>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary w-100 py-2">
                                Kirim Komentar 🚀
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.1/aos.js"></script> <!-- AOS Library -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const commentCards = document.querySelectorAll('.comment-card');
        
        // Initialize AOS
        AOS.init();

        commentCards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.1}s`;
            card.setAttribute('data-aos', 'fade-up'); // Apply AOS effect
            card.setAttribute('data-aos-delay', `${index * 100}`); // Stagger delay
            card.setAttribute('data-aos-duration', '600'); // Animation duration
            card.setAttribute('data-aos-easing', 'ease-in-out'); // Easing function
            card.classList.add("aos-init"); // Initialize AOS state
            card.classList.add("aos-animate"); // Start animation
        });
    });
</script>
@endpush