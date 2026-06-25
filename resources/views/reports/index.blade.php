@extends('layouts.master')

@section('content')

<div class="container">

    <h1 class="mb-4">Laporan Dashboard</h1>

    {{-- Statistik --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card border-success shadow-sm">
                <div class="card-body text-center">
                    <h5>Sentimen Positif</h5>
                    <h2>{{ $positive }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-warning shadow-sm">
                <div class="card-body text-center">
                    <h5>Sentimen Netral</h5>
                    <h2>{{ $neutral }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card border-danger shadow-sm">
                <div class="card-body text-center">
                    <h5>Sentimen Negatif</h5>
                    <h2>{{ $negative }}</h2>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">

    {{-- Statistik Kupon --}}
    <div class="row">

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5>Kupon Aktif</h5>
                    <h2>{{ $activeCoupons }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5>Kupon Kadaluarsa</h5>
                    <h2>{{ $expiredCoupons }}</h2>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <h5>Total Penggunaan Kupon</h5>
                    <h2>{{ $totalCouponUsage }}</h2>
                </div>
            </div>
        </div>

    </div>

    <hr class="my-4">

    {{-- Charts --}}
    <div class="row">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    Analisis Sentimen Rating
                </div>
                <div class="card-body">
                    <div style="height:300px">
                        <canvas id="sentimentChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header">
                    Statistik Kupon
                </div>
                <div class="card-body">
                    <div style="height:300px">
                        <canvas id="couponChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
const sentimentCtx = document.getElementById('sentimentChart');

new Chart(sentimentCtx, {
    type: 'pie',
    data: {
        labels: ['Positif', 'Netral', 'Negatif'],
        datasets: [{
            data: [
                {{ $positive }},
                {{ $neutral }},
                {{ $negative }}
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});

const couponCtx = document.getElementById('couponChart');

new Chart(couponCtx, {
    type: 'doughnut',
    data: {
        labels: ['Aktif', 'Kadaluarsa'],
        datasets: [{
            data: [
                {{ $activeCoupons }},
                {{ $expiredCoupons }}
            ]
        }]
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});
</script>

@endsection
