@extends('templates.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="grid grid-cols-1 gap-6">
            <!-- Bagian Pencarian dan Ekspor -->
            <div class="bg-white shadow-lg rounded-lg p-6 transition-all duration-300 hover:shadow-xl">
                <div class="grid md:grid-cols-2 gap-6">
                    <!-- Form Pencarian -->
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-purple-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                            Cari Provinsi 🔍
                        </h2>
                        <form method="GET" action="{{ route('response') }}" class="space-y-4">
                            <div>
                                <label for="province-search" class="block text-sm font-medium text-gray-700 mb-2">Pilih Provinsi</label>
                                <select name="province" id="province-search" class="w-full px-4 py-2 border border-purple-300 rounded-md focus:ring-2 focus:ring-purple-500 transition-all">
                                    <option value="">Semua Provinsi 🌎</option>
                                </select>
                            </div>
                            <button type="submit" class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700 transition-colors flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="11" cy="11" r="8"></circle>
                                    <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                </svg>
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Form Ekspor -->
                    <div class="space-y-4">
                        <h2 class="text-2xl font-bold text-purple-600 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="7 10 12 15 17 10"></polyline>
                                <line x1="12" y1="15" x2="12" y2="3"></line>
                            </svg>
                            Ekspor Laporan 📊
                        </h2>
                        <form method="GET" action="{{ route('report.export') }}" class="space-y-4">
                            <div>
                                <label for="province-export" class="block text-sm font-medium text-gray-700 mb-2">Pilih Provinsi untuk Ekspor</label>
                                <select name="province" id="province-export" class="w-full px-4 py-2 border border-purple-300 rounded-md focus:ring-2 focus:ring-purple-500 transition-all">
                                    <option value="">Semua Provinsi 🌍</option>
                                </select>
                            </div>
                            <button type="submit" id="export-button" class="w-full bg-purple-600 text-white py-2 rounded-md hover:bg-purple-700 transition-colors flex items-center justify-center" disabled>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="7 10 12 15 17 10"></polyline>
                                    <line x1="12" y1="15" x2="12" y2="3"></line>
                                </svg>
                                Ekspor
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabel Laporan -->
            <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <h2 class="text-2xl font-bold text-purple-600 mb-4 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                        Daftar Laporan 📋
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-purple-100 text-purple-800">
                                <tr>
                                    <th class="px-4 py-3 text-left">#</th>
                                    <th class="px-4 py-3 text-left">Gambar & Pengirim 👤</th>
                                    <th class="px-4 py-3 text-left">Provinsi 🌆</th>
                                    <th class="px-4 py-3 text-left">Deskripsi 📝</th>
                                    <th class="px-4 py-3 text-left">Suara 🗳️</th>
                                    <th class="px-4 py-3 text-left">Aksi 🔍</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($responses as $index => $report)
                                <tr class="hover:bg-purple-50 transition-colors">
                                    <td class="px-4 py-4 font-medium">{{ $index + 1 }}</td>
                                    <td class="px-4 py-4">
                                        <div class="flex items-center">
                                            <img src="{{ asset('assets/images/' . ($report->image ?? 'default.jpg')) }}" 
                                                 alt="Gambar dari {{ $report->name ?? 'Tanpa Nama' }}" 
                                                 class="w-16 h-16 rounded-lg object-cover mr-4 shadow-md">
                                            <span class="text-sm text-gray-600">{{ $report['user']['email'] ?? 'Nama Tidak Tersedia' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-4 py-4" id="province-{{ $report->id }}">Memuat... 🔄</td>
                                    <td class="px-4 py-4 text-sm text-gray-700">{{ $report->description ?? 'Deskripsi Tidak Tersedia' }}</td>
                                    <td class="px-4 py-4">
                                        <span class="inline-flex items-center px-3 py-1 rounded-full bg-purple-100 text-purple-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            {{ $report->voting ?? '0' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-4">
                                        <a href="{{ route('response.show', ['id' => $report->id]) }}" class="bg-purple-500 text-white px-4 py-2 rounded-md hover:bg-purple-600 transition-colors flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                                <circle cx="12" cy="12" r="3"></circle>
                                            </svg>
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="text-center py-6 text-gray-500">
                                        Tidak Ada Laporan Tersedia 📭
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('style')
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
@endpush

@push('script')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const provinceSelectSearch = document.getElementById('province-search');
        const provinceSelectExport = document.getElementById('province-export');
        const exportButton = document.getElementById('export-button');
        const reports = @json($responses);
        let availableProvinces = [];

        // Mengumpulkan provinsi yang tersedia dari laporan
        reports.forEach(report => {
            const provinceId = report.province;
            if (!availableProvinces.includes(provinceId)) {
                availableProvinces.push(provinceId);
            }
        });

        // Mengambil data provinsi dari API
        fetch("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json")
            .then(response => response.json())
            .then(data => {
                // Mengisi dropdown pencarian provinsi
                data.forEach(province => {
                    const option = document.createElement('option');
                    option.value = province.id;
                    option.textContent = `${province.name} 🏙️`;
                    provinceSelectSearch.appendChild(option);
                });

                // Mengisi dropdown ekspor provinsi dengan provinsi yang tersedia
                data.forEach(province => {
                    if (availableProvinces.includes(province.id)) {
                        const option = document.createElement('option');
                        option.value = province.id;
                        option.textContent = `${province.name} 🏘️`;
                        provinceSelectExport.appendChild(option);
                    }
                });

                // Mengisi nama provinsi di tabel
                reports.forEach(report => {
                    const provinceElement = document.getElementById(`province-${report.id}`);
                    const province = data.find(p => p.id === report.province);
                    if (province) {
                        provinceElement.textContent = `${province.name} 🌆`;
                    } else {
                        provinceElement.textContent = 'Provinsi Tidak Diketahui 🌍';
                    }
                });
            })
            .catch(error => {
                console.error('Error mengambil data provinsi:', error);
            });

        // Logika aktivasi tombol ekspor
        provinceSelectExport.addEventListener('change', function() {
            const selectedProvince = provinceSelectExport.value;
            exportButton.disabled = !(selectedProvince === "" || availableProvinces.includes(selectedProvince));
        });
    });
</script>
@endpush