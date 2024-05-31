@extends('layout/main')

@section('content')

<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Home</a></li>
          <li class="breadcrumb-item active">Dashboard v1</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <!-- Small boxes (Stat box) -->
    <div class="row">
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3>{{$totalBooking}}</h3>
            <p>Total Pesanan</p>
          </div>
          <div class="icon">
            <i class="ion ion-bag"></i>
          </div>
          <a href="{{ route('booking.list') }}" class="small-box-footer">Ke List Pesanan Sekarang <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>{{$totalLapangan}}</h3>

            <p>Total Lapangan</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="/lapangan" class="small-box-footer">List Lapangan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>{{$totalPelanggan}}</h3>

            <p>Total Pelanggan</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="/pelanggan" class="small-box-footer">List Pelanggan <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>{{$totalGaleri}}</h3>

            <p>Total Foto Galeri</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="/galeri" class="small-box-footer">List Galeri <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    </div>
    <!-- /.row -->
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->

      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">Latest Booking</h6>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Pelanggan</th>
                  <th>Lapangan</th>
                  <th>Sesi</th>
                  <th>Status Booking</th>
                  <th>Status Bayar</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($latestPesanan as $row)
                <tr>
                  <td>{{ ($row->id_customer == null) ? "-" : $row->user->name  }}</td>
                  <td>{{ $row->lapangan->nama_lapangan }}</td>
                  <td>{{ $row->session->name }}</td>
                  <td>{{ $row->status == 1 ? 'Dibooking' : '-'}}</td>
                  <td>@if($row->status == 1 && $row->status_bayar == 0)
                    Belum Bayar
                    @elseif($row->status == 0 && $row->status_bayar == 0)
                    -
                    @elseif($row->status == 1 && $row->status_bayar == 1)
                    Sudah Bayar
                    @endif
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <!-- right col -->
    </div>
    <!-- /.row (main row) -->
  </div><!-- /.container-fluid -->
</section>
<!-- /.content -->

@endsection