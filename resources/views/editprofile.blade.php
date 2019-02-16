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
                                        @foreach(Auth::user()->emails as $email)
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Email {{$loop->iteration}} @if($email['privacy'] == "private")<i class="fa fa-lock"></i>@endif</label>
                                                </div>
                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$email['email']}}" readonly>
                                                        <div class="input-group-btn custom-dropdowns-button">
                                                            <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                                                                </button>
                                                            <ul class="dropdown-menu pull-right">                                                                
                                                                <li><a href="{{route('profile.privacy', ['type'=>'email','id'=>$email['id']])}}">
                                                                @if($email['privacy'] == "private")
                                                                Public
                                                                @else
                                                                Private
                                                                @endif
                                                                </a>
                                                                </li>
                                                                @if($email['email'] != Auth::user()->email)
                                                                <li><a onclick="return confirm('Apakah anda yakin ingin menghapus email ini?')" href="{{route('profile.delete', ['type'=>'email','id'=>$email['id']])}}">Hapus</a>
                                                                </li>                                     
                                                                @endif                               
                                                            </ul>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        @endforeach
                                        @foreach(Auth::user()->addresses as $address)
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Alamat {{$loop->iteration}} @if($address['privacy'] == "private")<i class="fa fa-lock"></i>@endif</label>
                                                </div>
                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$address['address']}} | {{$address->districtDetails['name']}}, {{$address->cityDetails['name']}}, {{$address->provinceDetails['name']}}" readonly>
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
                                                                <li><a onclick="return confirm('Apakah anda yakin ingin menghapus alamat ini?')" href="{{route('profile.delete', ['type'=>'address','id'=>$address['id']])}}">Hapus</a>
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
                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#zoomInDown1"><i class="fa fa-envelope"></i> Tambahkan Email</a>
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
                        <!-- <div class="modal-bootstrap modal-login-form">
                            <a class="zoomInDown mg-t" href="#" data-toggle="modal" data-target="#zoomInDown1">Modal Login Form</a>
                        </div> -->
                        <div id="zoomInDown1" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">                                    
                                    <div class="modal-body">
                                        <div class="modal-login-form-inner">                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="basic-login-inner modal-basic-inner">
                                                        <h5>Email Baru</h5>
                                                        <p>Masukkan informasi alamat email anda</p>
                                                        <form action="{{route('email.save')}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="act" value="add">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                        <label class="login2">Email</label>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                                        <input type="email" name="email" class="form-control" placeholder="Masukkan Email" required/>
                                                                    </div>
                                                                </div>
                                                            </div>                                                        
                                                            <div class="login-btn-inner">                                                                
                                                                <div class="row">
                                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"></div>
                                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                                        <div class="login-horizental">
                                                                            <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Simpan</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
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