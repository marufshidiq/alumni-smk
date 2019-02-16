@extends('layouts.main')

@section('content')
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">        
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Edit Profil</h1>                            
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        <div class="form-group-inner">
                                            <form name="changeName" href="{{ route('profile.edit.post') }}" method="POST">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Nama Lengkap</label>
                                                    </div>
                                                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="input-group">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="parameter" value="name">
                                                            <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" disabled>                                                            
                                                            <div class="input-group-btn custom-dropdowns-button">
                                                                <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                                                                    </button>
                                                                <ul class="dropdown-menu pull-right">
                                                                    <li><a id="change-name">Ubah</a>
                                                                    </li>                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div style="display:none;" id="change-name-btn">
                                                            <a class="btn btn-sm btn-success" id="change-name-save"><i class="fa fa-save"></i> Simpan</a>
                                                            <a class="btn btn-sm btn-default" id="change-name-cancel"><i class="fa fa-ban"></i> Batal</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Email <i class="fa fa-lock"></i></label>
                                                </div>
                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{ Auth::user()->email }}" disabled>
                                                        <div class="input-group-btn custom-dropdowns-button">
                                                            <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                                                                </button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a href="#">Private</a>
                                                                </li>                                                                    
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @foreach(Auth::user()->addresses as $address)
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Alamat {{$loop->iteration}} @if($address['privacy'] == "private")<i class="fa fa-lock"></i>@endif</label>
                                                </div>
                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$address['address']}}" readonly>
                                                        <div class="input-group-btn custom-dropdowns-button">
                                                            <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                                                                </button>
                                                            <ul class="dropdown-menu pull-right">
                                                                <li><a onclick="event.preventDefault();document.getElementById('edit-address-{{$loop->iteration}}').submit();">Ubah</a>
                                                                </li> 
                                                                <li><a href="{{route('profile.privacy', ['type'=>'address','id'=>$address['id']])}}">
                                                                @if($address['privacy'] == "private")
                                                                Public
                                                                @else
                                                                Private
                                                                @endif
                                                                </a>
                                                                </li>
                                                                <li><a href="{{route('profile.delete', ['type'=>'address','id'=>$address['id']])}}">Hapus</a>
                                                                </li>                                                                    
                                                            </ul>
                                                            <form id="edit-address-{{$loop->iteration}}" action="{{route('address.addedit.form')}}" method="POST">
                                                            <input type="hidden" name="act" value="edit">
                                                            <input type="hidden" name="id" value="{{$address['id']}}">
                                                            {{ csrf_field() }}
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        @endforeach                                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <a class="btn btn-sm btn-success"><i class="fa fa-envelope"></i> Tambahkan Email</a>
                        <a class="btn btn-sm btn-success"><i class="fa fa-phone"></i> Tambahkan Kontak</a>                        
                        <a class="btn btn-sm btn-success" onclick="event.preventDefault();document.getElementById('add-address').submit();"><i class="fa fa-home"></i> Tambahkan Alamat</a>
                        <a class="btn btn-sm btn-success"><i class="fa fa-globe"></i> Tambahkan Media Sosial</a>
                        <form id="add-address" action="{{route('address.addedit.form')}}" method="POST">
                        <input type="hidden" name="act" value="add">
                        {{ csrf_field() }}
                        </form>
                        <br>
                        <br>
                        <i class="fa fa-lock" ></i>&nbsp;&nbsp;Informasi hanya akan ditampilkan pada orang yang telah anda berikan akses (private)
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $( "#change-name" ).click(function() {
        event.preventDefault();
        $("#change-name-btn").show();
        $("#name").prop('disabled', false);
    });
    $( "#change-name-save" ).click(function() {
        event.preventDefault();
        document.changeName.submit();
    });
    $( "#change-name-cancel" ).click(function() {
        event.preventDefault();
        $("#change-name-btn").hide();
        $("#name").prop('disabled', true);
    });
</script>
@endsection