<!-- filepath: c:\Users\Hadiranie\KasirV1\resources\views\admin\dashboard.blade.php -->
@extends('admin.template.master')
@section('title')
    APLIKASI KASIR | Dashboard
@endsection
@section('content') 
<div class="container py-10 px-10">
    <!-- Page Title -->
    <div class="page-title d-flex flex-column align-items-start justify-content-center flex-wrap me-2 pb-5 pb-lg-0 pt-7 pt-lg-0">
        <h1 class="d-flex flex-column text-gray-900 fw-bold my-0 fs-1">Dashboard
            
        </h1>
        <ul class="breadcrumb breadcrumb-dot fw-semibold fs-base my-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{route('dashboard')}}" class="text-muted text-hover-primary">Home</a>
            </li>
        </ul>
    </div>

    <!-- Summary Section -->
    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5>Total Penjualan Hari Ini</h5>
                <h3 class="fw-bold">Rp {{ number_format($totalSalesToday, 0, ',', '.') }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5>Jumlah Transaksi</h5>
                <h3 class="fw-bold">{{ $transactionCount }}</h3>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h5>Pendapatan Hari Ini</h5>
                <h3 class="fw-bold">Rp {{ number_format($revenueToday, 0, ',', '.') }}</h3>
            </div>
        </div>
    </div>

    <!-- Sales Chart -->
    <div class="card shadow-sm p-4 mb-5">
        <h5 class="fw-bold">Grafik Penjualan</h5>
        <canvas id="salesChart" height="100"></canvas>
    </div>

    <!-- Top Products -->
    <div class="card shadow-sm p-4">
        <h5 class="fw-bold">Produk Terlaris</h5>
        <ul class="list-group">
            @foreach($topProducts as $product)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $product->NamaProduk }}
                    <span class="badge bg-primary rounded-pill">{{ $product->total_sold }} Terjual</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($salesDates),
            datasets: [{
                label: 'Penjualan',
                data: @json($salesData),
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderWidth: 2,
                fill: true,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Tanggal'
                    }
                },
                y: {
                    title: {
                        display: true,
                        text: 'Jumlah Penjualan'
                    }
                }
            }
        }
    });
</script>
@endsection