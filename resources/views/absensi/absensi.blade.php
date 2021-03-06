@extends('../index')
@extends('absensi.additional')

@section('content')
	<div class="row">
        @if (session('alert_success'))
        <div style="position: absolute; z-index: 999; right: -10px; " class="col-md-6 notifberhasil">
          <div class="notif alert alert-success alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{session('alert_success')}}
          </div>
        </div>
        @elseif(session('alert_fail'))
        <div style="position: absolute; z-index: 999; right: -10px; " class="col-md-6 notifberhasil">
          <div class="notif alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            {{session('alert_fail')}}
          </div>
        </div>
      @endif
		<div class="col-md-6">
			        <div class="panel panel-default" width="50%">
			            <div class="panel-heading">
			                <h4>Tambah Absensi</h4>
			            </div>
			            <div class="panel-body">
			                {!! Form::open(['route' => 'absensi.index']) !!}
			                    <div class="form-grup">
					               {!! Form::label('NISN', 'NISN') !!}
					               {!! Form::text('NISN', '' ,['class' => 'col-sm-6 form-control', 'required' => 'required']) !!}
					               </div>
                                   <br>
			                   <div class="form-grup">
                         {!! Form::label('lama', 'lama') !!}
                         {!! Form::text('lama', '',['class' => 'col-sm-6 form-control', 'required' => 'required']) !!}
                         </div>
                         <br>
                         <div class="form-grup">
					               {!! Form::label('keterangan', 'Keterangan') !!}
					               {!! Form::select('keterangan', ['sakit' => 'sakit', 'ijin' => 'ijin', 'alpa' => 'alpa'], '',['class' => 'col-sm-6 form-control', 'required' => 'required']) !!}
                                   </div>
                                   <br><br>
                                {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
			                {!! Form::close() !!}
			            </div>
			        </div>
			    </div>
       <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Data Absensi</h3>
            </div>
            <div class="panel-body">
              <table id="example2" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NISN</th>
                  <th>Nama siswa</th>
                  <th>Lama</th>
                  <th>keterangan</th>
                  <th>Opsi</th>
                </tr>
                </thead>
                <tbody>
                	<?php $no = 0;?>
                	@foreach($data_absence as $show_absence)
                	<?php $no++ ;?>
                <tr>
                  <td>{{$no}}</td>
                  <td>{{$show_absence->NISN}}</td>
                  <td>{{$show_absence->namesiswa->nama}}</td>
                  <td>{{$show_absence->lama}} Hari</td>
                  <td>{{$show_absence->keterangan}}</td>
                  <td>
                  	<button class="btn btn-info" data-toggle="modal" data-target="#edit{{$show_absence->id}}">Edit</button>
                  	<button class="btn btn-danger" data-toggle="modal" data-target="#delete{{$show_absence->id}}">hapus</button>
                  </td>
                </tr>
                  <div class="modal fade" id="edit{{$show_absence->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Edit Absensi NISN {{$show_absence->NISN}}</h5>
                                    </div>
                                      {!! Form::open(['route' => ['absensi.update',$show_absence->id],'method' => 'put']) !!}
                                    <div class="modal-body">
                                          <div class="form-grup">
                                         {!! Form::label('lama', 'Lama') !!}
                                         {!! Form::text('lama', $show_absence->lama,['class' => 'col-sm-6 form-control', 'required' => 'required']) !!}
                                          </div>
                                          <div class="form-grup">
                                           {!! Form::label('keterangan', 'Keterangan') !!}
                                           {!! Form::select('keterangan', ['sakit' => 'sakit', 'ijin' => 'ijin', 'alpa' => 'alpa'], $show_absence->keterangan,['class' => 'col-sm-6 form-control', 'required' => 'required']) !!}
                                           </div>
                                    </div>
                                    <br><br><br>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                      {!! Form::submit('Simpan', ['class' => 'btn btn-primary']) !!}
                                    </div>
                                      {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="delete{{$show_absence->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Delete Kelas</h5>
                                    </div>
                                    {!! Form::open(['route' => ['absensi.destroy',$show_absence->id],'method' => 'DELETE']) !!}
                                    <div class="modal-body">
                                        Yakin Ingin Menghapus Absensi {{$show_absence->NISN}}
                                    </div>
                                    <br><br>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kembali</button>
                                        {!! Form::submit('Hapus', ['class' => 'btn btn-danger']) !!}
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                  	@endforeach
                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
         </div>
	</div>


	

@endsection