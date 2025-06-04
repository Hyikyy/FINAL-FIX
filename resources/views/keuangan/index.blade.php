@extends('layouts.app')

@section('title', 'Keuangan | Website Kami')
@section('description', 'Informasi keuangan organisasi Himatif.')
@section('keywords', 'keuangan, laporan keuangan, organisasi, pemasukan, pengeluaran, diagram keuangan')

@section('content')

  <main id="main">

    <!-- ======= Keuangan Section ======= -->
    <section id="keuangan" class="inner-page" style="margin-top: 70px; margin-bottom: 10px;">
      <div class="container" data-aos="fade-up">

        <div class="section-header" style="margin-top: 70px; margin-bottom: 10px;">
          <h2 class="text-center fw-bold" style="color: black;">Ringkasan Keuangan Organisasi</h2>
          <p class="text-center">Sekilas tentang kesehatan finansial HIMATIF.</p>
        </div>

        <div class="row justify-content-center">

          <div class="col-lg-6">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data Pemasukan & Pengeluaran</h6>
              </div>
              <div class="card-body">
                <canvas id="keuanganChart"></canvas>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-success h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                      Total Pemasukan
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPemasukan, 2, ',', '.') }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-arrow-up fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-danger h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                      Total Pengeluaran
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPengeluaran, 2, ',', '.') }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-arrow-down fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-info h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                      Surplus / Defisit
                    </div>
                    <div class="row no-gutters align-items-center">
                      <div class="col-auto">
                        <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalPemasukan - $totalPengeluaran, 2, ',', '.') }}</div>
                      </div>
                    </div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Tampilkan Saldo HIMATIF -->
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="card shadow border-left-primary h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                      Saldo HIMATIF
                    </div>
                    <div class="h5 mb-0 font-weight-bold text-gray-800">Rp {{ number_format($totalSaldo, 2, ',', '.') }}</div>
                  </div>
                  <div class="col-auto">
                    <i class="fas fa-coins fa-2x text-gray-300"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- End Tampilkan Saldo HIMATIF -->

          <!-- Ringkasan Bulanan -->
          <div class="col-lg-12">
            <div class="card shadow mb-4">
              <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ringkasan Bulanan</h6>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                      <tr>
                        <th>Bulan</th>
                        <th>Pemasukan</th>
                        <th>Pengeluaran</th>
                        <th>Surplus/Defisit</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($ringkasanBulanan as $bulan => $data)
                        <tr>
                          <td>{{ $data['bulan'] }}</td>
                          <td>Rp {{ number_format($data['total_pemasukan'], 2, ',', '.') }}</td>
                          <td>Rp {{ number_format($data['total_pengeluaran'], 2, ',', '.') }}</td>
                          <td>Rp {{ number_format($data['total_pemasukan'] - $data['total_pengeluaran'], 2, ',', '.') }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- End Ringkasan Bulanan -->

          <div class="col-lg-8">
            <p class="text-center text-muted">
              Informasi lebih detail hanya tersedia untuk administrator.
            </p>
          </div>

        </div>

      </div>
    </section><!-- End Keuangan Section -->

  </main><!-- End #main -->

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <!-- Pastikan Anda sudah menyertakan chartjs-plugin-datalabels -->
  <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2.0.0"></script>
  <script src="https://kit.fontawesome.com/your-fontawesome-kit.js" crossorigin="anonymous"></script> <!-- Gantilah dengan kode Font Awesome Anda -->

  <script>
    // Daftarkan plugin datalabels
    Chart.register(ChartDataLabels);

    const ctx = document.getElementById('keuanganChart').getContext('2d');

    // Hitung total keuangan
    const total = {{ $totalPemasukan }} + {{ $totalPengeluaran }};

    // Hitung persentase pemasukan dan pengeluaran
    const persentasePemasukan = ({{ $totalPemasukan }} / total) * 100;
    const persentasePengeluaran = ({{ $totalPengeluaran }} / total) * 100;

    const myChart = new Chart(ctx, {
      type: 'doughnut', // Mengubah tipe diagram menjadi donat
      data: {
        labels: ['Pemasukan', 'Pengeluaran'],
        datasets: [{
          label: 'Rupiah',
          data: [{{ $totalPemasukan }}, {{ $totalPengeluaran }}],
          backgroundColor: [
            '#1cc88a', // Warna Pemasukan (hijau yang lebih cerah)
            '#e74a3b'  // Warna Pengeluaran (merah yang lebih cerah)
          ],
          hoverBackgroundColor: [
            '#17a673', // Warna Pemasukan saat dihover
            '#bd2130'  // Warna Pengeluaran saat dihover
          ],
          borderColor: ['rgba(255, 255, 255, 0.8)'],
          borderWidth: 1,
        }],
      },
      options: {
        maintainAspectRatio: false,
        cutout: '50%', // Membuat diagram donat (lubang di tengah)
        plugins: {
          legend: {
            position: 'bottom',
            align: 'center',
            labels: {
              boxWidth: 20,
              padding: 20
            }
          },
          tooltip: {
            backgroundColor: "rgba(100, 100, 100, 0.9)",
            bodyFont: {
              size: 16
            },
            titleFont: {
              size: 18
            },
            callbacks: {
              label: function(context) {
                let label = context.label || '';
                if (label) {
                  label += ': ';
                }
                if (context.parsed !== null) {
                  label += new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(context.parsed) + ' (' + (context.dataset.data[context.dataIndex] / total * 100).toFixed(1) + '%)';
                }
                return label;
              }
            }
          },
          datalabels: {
            formatter: (value, ctx) => {
              let sum = 0;
              let dataArr = ctx.chart.data.datasets[0].data;
              dataArr.map(data => {
                  sum += data;
              });
              let percentage = (value*100 / sum).toFixed(2)+"%";
              return percentage;
            },
            color: '#fff',
            font: {
                weight: 'bold',
                size: 16,
            },
          }
        },
      },
    });
  </script>
@endsection
