@extends('index')
@extends('piket/additional')
@section('content')
<div class="row">
    @if (isset($oputput))
    aa
    @endif
    <div class="col-md-12">
        <div>
            <h2>Data piket</h2>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3>Data Piket</h3>
            </div>
            <div class="panel-body">
                <table id="example" class="table table-striped table-bordered" style="width:100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Hari</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_piket as $index => $data)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$data->hari }}</td>
                            <td>
                                <button class="btn btn-warning">Edit</button>
                                <button class="btn btn-danger">hapus</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
    <div class="col-md-6">

        <div class="panel panel-default" width="50%">
            <div class="panel-heading">
                <h3>Tambah Piket</h3>
            </div>
            <div class="panel-body">
                {!! Form::open(['url' => '/piket']) !!}
                    {!! Form::label('hari', 'Hari'); !!}
                    {!! Form::text('hari', '', ['class' => 'form-control' , 'placeholder' => 'Masukkan hari Piket']) !!}
                    <br>
                    {!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection