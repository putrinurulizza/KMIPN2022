@extends('dashboard.layouts.main')

@section('content')
  <div class="containter">
    <div class="row g-3">
      <div class="col-sm-6 col-md-4 col-lg">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-duotone fa-user-circle fa-3x text-primary"></i>
            <div class="d-flex flex-column ms-3">
              <h5 class="card-title fs-6 mb-0">User</h5>
              <p class="card-text fs-4 fw-semibold">{{ $total_users }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-lg">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-duotone fa-newspaper fa-3x text-dark"></i>
            <div class="d-flex flex-column ms-3">
              <h5 class="card-title fs-6 mb-0">Berita</h5>
              <p class="card-text fs-4 fw-semibold">{{ $total_berita }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-lg">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-duotone fa-pen-field fa-3x text-success"></i>
            <div class="d-flex flex-column ms-3">
              <h5 class="card-title fs-6 mb-0">Masukan</h5>
              <p class="card-text fs-4 fw-semibold">{{ $total_pengaduan }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-lg">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-duotone fa-envelope fa-3x text-warning"></i>
            <div class="d-flex flex-column ms-3">
              <h5 class="card-title fs-6 mb-0">Data Surat</h5>
              <p class="card-text fs-4 fw-semibold">{{ $total_surat }}</p>
            </div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-lg">
        <div class="card">
          <div class="card-body d-flex align-items-center">
            <i class="fa-duotone fa-memo-circle-check fa-3x text-info"></i>
            <div class="d-flex flex-column ms-3">
              <h5 class="card-title fs-6 mb-0">Perizinan</h5>
              <p class="card-text fs-4 fw-semibold">{{ $total_perizinan }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="container mt-3 p-0">
    <div class="row g-3">
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header fw-semibold text-center fs-5">Jumlah Masukan yang Diterima per Tahun</div>
          <div class="card-body">
            <div id="chartSolusi" style="height: 300px;"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="card">
          <div class="card-header fw-semibold text-center fs-5">Jumlah Perizinan yang Diterima per Tahun</div>
          <div class="card-body">
            <div id="chartPerizinan" style="height: 300px;"></div>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-md-12">
        <div class="card">
          <div class="card-header fw-semibold text-center fs-5">Jenis Surat Yang Diurus per Tahun {{ now()->year }}</div>
          <div class="card-body">
            <div id="chartJenisSurat" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var surat = <?= json_encode($surat) ?>;
    document.addEventListener('DOMContentLoaded', function() {
      const chart = Highcharts.chart('chartJenisSurat', {
        chart: {
          type: 'column'
        },
        title: {
          text: ''
        },
        xAxis: {
          title: {
            text: 'Nama Surat'
          },
          categories: Object.keys(surat)
        },
        yAxis: {
          title: {
            text: 'Jumlah Surat'
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },
        plotOptions: {
          series: {
            allowPointSelect: true,
            showInLegend: false
          },
          column: {
            colorByPoint: true
          }
        },
        series: [{
          name: 'Jumlah Surat',
          data: Object.values(surat)
        }],
        colors: ['#007bff', '#233446', '#10b981'],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });
    });

    var solusi = <?= json_encode($solusi) ?>;
    document.addEventListener('DOMContentLoaded', function() {
      const chart = Highcharts.chart('chartSolusi', {
        chart: {
          type: 'line',
        },
        title: {
          text: ''
        },
        xAxis: {
          title: {
            text: 'Tahun'
          },
          categories: Object.keys(solusi)
        },
        yAxis: {
          title: {
            text: 'Jumlah Masukan Diterima'
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },
        plotOptions: {
          series: {
            allowPointSelect: true,
            showInLegend: false
          },
          column: {
            colorByPoint: true
          }
        },
        series: [{
          name: 'Jumlah Masukan',
          data: Object.values(solusi)
        }],
        colors: ['#10b981'],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });
    });

    var perizinan = <?= json_encode($perizinan) ?>;
    document.addEventListener('DOMContentLoaded', function() {
      const chart = Highcharts.chart('chartPerizinan', {
        chart: {
          type: 'line',
        },
        title: {
          text: ''
        },
        xAxis: {
          title: {
            text: 'Tahun'
          },
          categories: Object.keys(perizinan)
        },
        yAxis: {
          title: {
            text: 'Jumlah Perizinan Diterima'
          }
        },
        legend: {
          layout: 'vertical',
          align: 'right',
          verticalAlign: 'middle'
        },
        plotOptions: {
          series: {
            allowPointSelect: true,
            showInLegend: false
          },
          column: {
            colorByPoint: true
          }
        },
        series: [{
          name: 'Jumlah Perizinan',
          data: Object.values(perizinan)
        }],
        colors: ['#fd7e14'],
        responsive: {
          rules: [{
            condition: {
              maxWidth: 500
            },
            chartOptions: {
              legend: {
                layout: 'horizontal',
                align: 'center',
                verticalAlign: 'bottom'
              }
            }
          }]
        }
      });
    });
  </script>
@endsection
