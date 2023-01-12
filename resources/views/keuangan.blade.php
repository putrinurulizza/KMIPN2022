@extends('layouts.main')

@section('content')
  <div class="container mb-5">
    <div class="row">
      <div class="col">
        <h1 class="text-center mb-5" style="color:#000957; font-weight: bold;">LAPORAN KEUANGAN DESA</h1>
        <div class="card">
          <div class="card-body">
            <table id="myTable" class="table responsive nowrap table-bordered table-striped align-middle" style="width:100%">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Keterangan</th>
                  <th>Debet</th>
                  <th>Kredit</th>
                  <th>Saldo</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>12 Juli 2002</td>
                  <td>Dana</td>
                  <td>150000</td>
                  <td>0</td>
                  <td>150000</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
