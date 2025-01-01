@extends('Layout.header')

@section('main')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Validation</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Validation</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- jquery validation -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Inputkan Daftar Poli</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{route('pasien.poli.daftar')}}" method="POST">
                            @csrf
                            <input type="hidden" name="id_pasien" value="{{$pasien_id}}">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="namapoli">Nama Poli</label>
                                    <input type="text" class="form-control "
                                        value="{{$poli->nama_poli}}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="namapoli">Nama Jadwal | Dokter</label>
                                    <select name="id_jadwal" id="" class="form-control">
                                        @foreach($jadwals as $p)
                                        <option value="{{$p->id}}">{{$p->dokter->nama_dokter}} | {{$p->hari}} | {{$p->jam_mulai}}
                                            | {{$p->selesai}}</option>
                                        @endforeach
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="namapoli">Keluhan</label>
                                    <textarea name="keluhan" class="form-control" id="" cols="10" rows="2"></textarea>
                                </div>

                                <div class="form-group">
                                    <label for="namapoli">Nomor Antrian</label>
                                    <input type="hidden" name="no_antrian" value="{{$pasien}}">
                                    <input type="text" class="form-control "
                                        value="{{$pasien}}" disabled>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
                <!-- right column -->
                <div class="col-md-6">

                </div>
                <!--/.col (right) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
