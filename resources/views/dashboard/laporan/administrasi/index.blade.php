@extends('dashboard.layouts.main')

@section('content')
  <div class="container">
    <div class="row mb-3">
      <div class="col">
        <div class="card">
          <div class="card-header fw-semibold text-center fs-5">Jumlah Masukan yang Diterima per Tahun</div>
          <div class="card-body">
            <div id="chartSolusi" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row mb-3">
      <div class="col">
        <div class="card">
          <div class="card-header fw-semibold text-center fs-5">Jumlah Perizinan yang Diterima per Tahun</div>
          <div class="card-body">
            <div id="chartPerizinan" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="row mb-3">
      <div class="col">
        <div class="card">
          <div class="card-header fw-semibold text-center fs-5">Jenis Surat Yang Diurus per Tahun {{ now()->year }}</div>
          <div class="card-body">
            <div id="chartJenisSurat" style="height: 300px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <script>
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
