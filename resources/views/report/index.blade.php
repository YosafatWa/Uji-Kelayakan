@extends('templates.app')

@section('content')
    <div class="container mt-5">
        <!-- Header -->
        <div class="text-center mb-5">
            <h1 class="fw-bold text-purple-800">Laporan Keluhan Masyarakat</h1>
            <p class="text-purple-600">Laporkan keluhan dan pantau laporan Anda dengan mudah.</p>
        </div>

        <!-- Tombol Tambah Laporan -->
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between">
                <a href="{{ route('report.create') }}" class="btn btn-purple">
                    <i class="bi bi-plus-circle me-2"></i> Tambahkan Laporan
                </a>
                <form method="GET" action="{{ route('report.index') }}" class="d-flex gap-2">
                    <select name="province" id="province" class="form-select w-auto border-purple">
                        <option value="">Semua Provinsi</option>
                    </select>
                    <button type="submit" class="btn btn-outline-purple">Cari</button>
                </form>
            </div>
        </div>

        <!-- Daftar Laporan -->
        <div class="row g-4">
            @forelse($reports as $report)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 shadow-lg border-0 rounded-4 report-card">
                        <div class="card-img-wrapper">
                            <img src="{{ asset('assets/images/' . ($report->image ?? 'default.jpg')) }}" 
                                class="card-img-top rounded-top-4" 
                                alt="Gambar {{ $report->name ?? 'No Name' }}" 
                                style="height: 200px; object-fit: cover;">
                            <div class="card-img-overlay d-flex align-items-start justify-content-end">
                                <span class="badge bg-purple-gradient">{{ $report->type ?? 'Jenis Laporan' }}</span>
                            </div>
                        </div>
                        
                        <div class="card-body d-flex flex-column p-4">
                            <p class="text-purple-700 mb-3 description">
                                {{ Str::limit($report->description ?? 'Deskripsi tidak tersedia', 80) }}
                            </p>
                            <div class="user-info mb-3">
                                <p class="text-purple-600 mb-1">
                                    <i class="bi bi-person-circle me-2"></i>{{ $report['user']['email'] ?? 'Email tidak tersedia' }}
                                </p>
                                <p id="province-{{ $report->id }}" class="text-purple-600">
                                    <i class="bi bi-geo-alt me-2"></i>Memuat...
                                </p>
                            </div>

                            <!-- Statistik Laporan -->
                            <div class="d-flex justify-content-between align-items-center mt-auto">
                                <div class="d-flex gap-3">
                                    <span class="text-purple-600">
                                        <i class="bi bi-eye-fill"></i> {{ $report->viewers ?? 0 }}
                                    </span>
                                    <span class="text-purple-600">
                                        <i class="bi bi-heart-fill love-icon" 
                                           id="love-{{ $report->id }}" 
                                           style="{{ $report->voting > 0 ? 'color: #6c5ce7;' : '' }}" 
                                           onclick="toggleLove({{ $report->id }})"></i>
                                        <span id="voting-count-{{ $report->id }}">{{ $report->voting ?? 0 }}</span>
                                    </span>
                                </div>
                                <span class="badge bg-purple-soft text-purple-800">{{ $report->created_at->format('d M Y') ?? '' }}</span>
                            </div>

                            <!-- Tombol Detail -->
                            <a href="{{ route('report.show', ['id' => $report->id]) }}" class="btn btn-purple-gradient mt-3 w-100">
                                Lihat Detail <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-purple text-center py-4">
                        <i class="bi bi-info-circle me-2"></i> Tidak ada laporan yang tersedia.
                    </div>
                </div>
            @endforelse
        </div>
    </div>

    @push('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">

        <style>
            :root {
                --purple-primary: #6c5ce7;
                --purple-secondary: #a29bfe;
                --purple-light: #e4e0ff;
            }

            body {
                background-color: #f8f9fa;
                font-family: 'Inter', sans-serif;
            }

            .text-purple-800 { color: var(--purple-primary); }
            .text-purple-600 { color: var(--purple-secondary); }
            
            .btn-purple {
                background-color: var(--purple-primary);
                color: white;
                border: none;
                padding: 0.75rem 1.5rem;
                border-radius: 12px;
                transition: all 0.3s ease;
            }

            .btn-purple:hover {
                background-color: #5849e6;
                color: white;
                transform: translateY(-2px);
            }

            .btn-outline-purple {
                color: var(--purple-primary);
                border: 2px solid var(--purple-primary);
                border-radius: 12px;
                padding: 0.75rem 1.5rem;
            }

            .btn-outline-purple:hover {
                background-color: var(--purple-primary);
                color: white;
            }

            .btn-purple-gradient {
                background: linear-gradient(135deg, var(--purple-primary), var(--purple-secondary));
                color: white;
                border: none;
                border-radius: 12px;
                padding: 0.75rem 1.5rem;
            }

            .btn-purple-gradient:hover {
                color: white;
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(108, 92, 231, 0.3);
            }

            .report-card {
                transition: all 0.3s ease;
                border: 1px solid var(--purple-light);
            }

            .report-card:hover {
                transform: translateY(-8px);
                box-shadow: 0 8px 25px rgba(108, 92, 231, 0.15);
            }

            .bg-purple-gradient {
                background: linear-gradient(135deg, var(--purple-primary), var(--purple-secondary));
                color: white;
                padding: 0.5rem 1rem;
                border-radius: 8px;
            }

            .bg-purple-soft {
                background-color: var(--purple-light);
            }

            .border-purple {
                border-color: var(--purple-primary);
            }

            .alert-purple {
                background-color: var(--purple-light);
                color: var(--purple-primary);
                border: none;
            }

            .love-icon {
                cursor: pointer;
                transition: transform 0.3s ease;
            }

            .love-icon:hover {
                transform: scale(1.2);
            }

            .description {
                line-height: 1.6;
                font-size: 0.95rem;
            }

            .card-img-wrapper {
                position: relative;
                overflow: hidden;
                border-radius: 16px 16px 0 0;
            }

            .card-img-overlay {
                background: linear-gradient(180deg, rgba(0,0,0,0.4) 0%, rgba(0,0,0,0) 100%);
                padding: 1rem;
            }
        </style>
    @endpush

    @push('script')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const reports = @json($reports);

                reports.forEach(report => {
                    const provinceId = report.province;
                    const provinceElement = document.getElementById(`province-${report.id}`);

                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json`)
                        .then(response => response.json())
                        .then(provinces => {
                            const province = provinces.find(province => province.id == provinceId);
                            provinceElement.innerHTML = `<i class="bi bi-geo-alt me-2"></i>${province ? province.name : 'Lokasi tidak tersedia'}`;
                        })
                        .catch(error => {
                            provinceElement.innerHTML = '<i class="bi bi-geo-alt me-2"></i>Lokasi tidak tersedia';
                            console.error('Error fetching province data:', error);
                        });
                });

                const provinceSelect = document.getElementById('province');

                fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(province => {
                            const option = document.createElement('option');
                            option.value = province.id;
                            option.textContent = province.name;
                            provinceSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error:', error));
            });

            function toggleLove(reportId) {
                const heartIcon = document.getElementById('love-' + reportId);
                const votingCountElement = document.getElementById('voting-count-' + reportId);

                let isLoved = heartIcon.style.color === 'rgb(108, 92, 231)';

                if (!isLoved) {
                    heartIcon.style.color = '#6c5ce7';
                    votingCountElement.innerText = parseInt(votingCountElement.innerText) + 1;
                } else {
                    heartIcon.style.color = '';
                    votingCountElement.innerText = parseInt(votingCountElement.innerText) - 1;
                }

                fetch(`/report/${reportId}/vote`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ vote: !isLoved })
                })
                .then(response => response.json())
                .then(data => {
                    votingCountElement.innerText = data.voting_count;
                })
                .catch(error => console.error('Error:', error));
            }
        </script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @endpush
@endsection
