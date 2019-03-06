@extends('layouts.main')

@section('content')
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Unggah foto profil</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                Upload Validation Error<br><br>
                                <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                                </ul>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <form action="{{route('avatar.upload')}}" enctype="multipart/form-data" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group-inner">
                                                <input id="avatar" name="avatar" type="file" accept="image/*" required>                                                
                                            </div>                                            
                                            <div class="form-group-inner">
                                                <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Unggah</button>                                            
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection