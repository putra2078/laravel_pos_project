@extends('layouts.main')

@section('title', 'Home')

@section('content')

<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $transactionCount }}</h3>
                <p>Jumlah Transaksi Hari ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>Rp{{ number_format($omzetToday, 0, ',', '.') }}</h3>
                    
                    <p>Omzet Hari Ini</p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
            <div class="inner">
                <h3>Rp{{ number_format($profitToday, 0, ',', '.') }}</h3>

                <p>Profit Hari ini</p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $userCount }}</h3>
    
                <p>Jumlah User</p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>

        <div class="container-fluid">
        <div class="row">
        <div class="col-lg">
            <div class="card">
            <div class="card-header border-0">
                <div class="d-flex justify-content-between">
                <h3 class="card-title">Penjualan</h3>
                <a href="javascript:void(0);">View Report</a>
                </div>
            </div>
            <div class="card-body">
                <form id="filterForm" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="date" name="start_date" id="start_date" class="form-control" placeholder="Start Date">
                        </div>
                        <div class="col-md-5">
                            <input type="date" name="end_date" id="end_date" class="form-control" placeholder="End Date">
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary btn-block">Filter</button>
                        </div>
                    </div>
                </form>
                <div class="d-flex">
                    <p class="d-flex flex-column">
                        <span class="text-bold text-lg">Jumlah Transaksi</span>
                        <span>Jumlah Transaksi</span>
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                        <span class="text-success">
                        <i class="fas fa-arrow-up"></i> 12.5%
                        </span>
                        <span class="text-muted">Since last week</span>
                    </p>
                </div>
                <!-- /.d-flex -->

                <div class="position-relative mb-4">
                    <canvas id="transactionsChart" height="100"></canvas>
                    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                    <script>
                    let chartInstance = null;

                    function fetchAndRenderChart(startDate = '', endDate = '') {
                        let url = '{{ route('chart.transactions') }}';
                        if (startDate && endDate) {
                            url += `?start_date=${startDate}&end_date=${endDate}`;
                        }
                        fetch(url)
                            .then(response => response.json())
                            .then(data => {
                                const labels = data.map(item => 'Tanggal ' + item.created_at);
                                const totals = data.map(item => item.total);

                                const ctx = document.getElementById('transactionsChart').getContext('2d');
                                if (chartInstance) {
                                    chartInstance.destroy();
                                }
                                chartInstance = new Chart(ctx, {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'Total Transaksi',
                                            data: totals,
                                            backgroundColor: 'rgba(54, 162, 235, 0.7)',
                                            borderColor: 'rgba(54, 162, 235, 1)',
                                            borderWidth: 1
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true
                                            }
                                        }
                                    }
                                });
                            });
                    }

                    document.addEventListener('DOMContentLoaded', function () {
                        fetchAndRenderChart();

                        document.getElementById('filterForm').addEventListener('submit', function(e) {
                            e.preventDefault();
                            const startDate = document.getElementById('start_date').value;
                            const endDate = document.getElementById('end_date').value;
                            fetchAndRenderChart(startDate, endDate);
                        });
                    });
                    </script>
                </div>
            </div>
            </div>
            <!-- /.card -->

@endsection