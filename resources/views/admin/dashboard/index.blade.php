@extends('admin.layouts.main.app')

@section('content')

    <div class="row">
      <div class="ms-3">
        <h3 class="mb-0 h4 font-weight-bolder">Dashboard</h3>
        <p class="mb-4">
          Selamat Datang {{ Auth::user()->name }}
        </p>
      </div>
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
              <div>
                <p class="text-sm mb-0 text-capitalize">Jumlah Terjual</p>
                <h4 class="mb-0">{{ $totalPenjualan }}</h4>
              </div>
              <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                <i class="material-symbols-rounded opacity-10">weekend</i>
              </div>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>
      <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
          <div class="card-header p-2 ps-3">
            <div class="d-flex justify-content-between">
              <div>
                <p class="text-sm mb-0 text-capitalize">Total Pendapatan</p>
                <h4 class="mb-0">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</h4>
              </div>
              <div class="icon icon-md icon-shape bg-gradient-dark shadow-dark shadow text-center border-radius-lg">
                <i class="material-symbols-rounded opacity-10">person</i>
              </div>
            </div>
          </div>
          <hr class="dark horizontal my-0">
        </div>
      </div>
    </div>
    <div class="row d-flex">
      <div class="col-lg-6 col-md-6 mt-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h6 class="mb-0">Penjualan Per Bulan</h6>
            <div class="pe-2">
              <div class="chart">
                <canvas id="penjualanPerBulanChart" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
            <hr class="dark horizontal">
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 mt-4 mb-4">
        <div class="card h-100">
          <div class="card-body">
            <h6 class="mb-0">Penjualan Per Penerbangan</h6>
            <div class="pe-2">
              <div class="chart">
                <canvas id="chartPerPenerbangan" class="chart-canvas" height="170"></canvas>
              </div>
            </div>
            <hr class="dark horizontal">
          </div>
        </div>
      </div>
    </div>
    

    <script>
      // Penjualan per Bulan
      var ctxBulan = document.getElementById('penjualanPerBulanChart').getContext('2d');
      var penjualanPerBulanChart = new Chart(ctxBulan, {
          type: 'bar',
          data: {
              labels: @json($penjualanPerBulan->pluck('bulan')), 
              datasets: [{
                  label: 'Pendapatan per Bulan',
                  data: @json($penjualanPerBulan->pluck('pendapatan')), 
                  backgroundColor: 'rgba(75, 192, 192, 0.2)',
                  borderColor: 'rgba(75, 192, 192, 1)',
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

      // chart per penerbangan
      var ctx = document.getElementById('chartPerPenerbangan').getContext('2d');
      var chart = new Chart(ctx, {
          type: 'pie',
          data: {
              labels: {!! json_encode($penjualanPerPenerbangan->pluck('slug')) !!},
              datasets: [{
                  label: 'Total Penumpang',
                  data: {!! json_encode($penjualanPerPenerbangan->pluck('total_penumpang')) !!},
                  backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0', '#9966FF'],
              }]
          },
          options: {
              responsive: true,
              aspectRatio: 1.5,
        layout: {
            padding: 20
        }
          }
      });

    </script>
@endsection