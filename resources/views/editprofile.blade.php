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
                                        @foreach(Auth::user()->contactNumbers as $contact)
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Kontak {{$loop->iteration}} @if($contact['whatsapp'])<i class="fa fa-whatsapp"></i>@endif @if($contact['privacy'] == "private")<i class="fa fa-lock"></i>@endif</label>
                                                </div>
                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$contact['number']}}" readonly>
                                                        <div class="input-group-btn custom-dropdowns-button">
                                                            <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                                                                </button>
                                                            <ul class="dropdown-menu pull-right">                                                                
                                                                <li><a href="{{route('profile.privacy', ['type'=>'contact','id'=>$contact['id']])}}">
                                                                @if($contact['privacy'] == "private")
                                                                Public
                                                                @else
                                                                Private
                                                                @endif
                                                                </a>
                                                                </li>
                                                                <li><a href="{{route('profile.privacy', ['type'=>'whatsapp','id'=>$contact['id']])}}">
                                                                @if($contact['whatsapp'])
                                                                Nonaktifkan WA
                                                                @else
                                                                Aktifkan WA
                                                                @endif
                                                                </a>
                                                                </li>
                                                                <li><a onclick="return confirm('Apakah anda yakin ingin menghapus kontak ini?')" href="{{route('profile.delete', ['type'=>'contact','id'=>$contact['id']])}}">Hapus</a>
                                                                </li>                                     
                                                            </ul>                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        @endforeach

                                        @foreach(Auth::user()->socialMedia as $sm)
                                        <div class="form-group-inner">
                                            <div class="row">
                                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                                                    <label class="login2 pull-right pull-right-pro">Media Sosial {{$loop->iteration}} @if($sm['privacy'] == "private")<i class="fa fa-lock"></i>@endif</label>
                                                </div>
                                                <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" value="{{$sm->link()}}" readonly>
                                                        <div class="input-group-btn dropdown-segmented">
                                                            <button onclick="window.open('{{$sm->link()}}')" tabindex="-1" class="btn btn-white" type="button"><i class="{{$sm->details['icon']}}"></i>&nbsp;{{$sm->details['name']}}</button>
                                                            <button data-toggle="dropdown" class="btn btn-white dropdown-toggle" type="button" aria-expanded="false">Action <span class="caret"></span>
                                                                </button>
                                                            <ul class="dropdown-menu pull-right">                                                                
                                                                <li><a href="{{route('profile.privacy', ['type'=>'socialmedia','id'=>$sm['id']])}}">
                                                                @if($sm['privacy'] == "private")
                                                                Public
                                                                @else
                                                                Private
                                                                @endif
                                                                </a>
                                                                </li>                                                                
                                                                <li><a onclick="return confirm('Apakah anda yakin ingin menghapus media sosial ini?')" href="{{route('profile.delete', ['type'=>'socialmedia','id'=>$sm['id']])}}">Hapus</a>
                                                                </li>                                     
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
                        <a class="btn btn-sm btn-success" href="{{ route('avatar.edit') }}"><i class="fa fa-user"></i> Ubah Foto Profil</a>
                        @if(Auth::user()->class()->count() == 0)
                        <a class="btn btn-sm btn-success" onclick="event.preventDefault();document.getElementById('choose-class').submit();"><i class="fa fa-users"></i> Pilih kelas dan angkatan</a>
                        @endif
                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newEmailModal"><i class="fa fa-envelope"></i> Tambahkan Email</a>
                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newContactModal"><i class="fa fa-phone"></i> Tambahkan Kontak</a>                        
                        <a class="btn btn-sm btn-success" onclick="event.preventDefault();document.getElementById('add-address').submit();"><i class="fa fa-home"></i> Tambahkan Alamat</a>
                        <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newSocialMediaModal"><i class="fa fa-globe"></i> Tambahkan Media Sosial</a>
                        <form id="add-address" action="{{route('address.addedit.form')}}" method="POST">
                        <input type="hidden" name="act" value="add">
                        {{ csrf_field() }}
                        </form>
                        <form id="choose-class" action="{{route('class.list')}}" method="POST">
                        <input type="hidden" name="act" value="first">
                        {{ csrf_field() }}
                        </form>
                        <br>
                        <br>
                        <i class="fa fa-lock" ></i>&nbsp;&nbsp;&nbsp;Informasi hanya akan ditampilkan pada orang yang telah anda berikan akses (private)
                        <br>
                        <i class="fa fa-whatsapp" ></i>&nbsp;&nbsp;Menginformasikan bahwa pada nomor kontak tersebut dapat dihubungi melalui WhatsApp
                        <div id="newEmailModal" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
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
                        <div id="newContactModal" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">                                    
                                    <div class="modal-body">
                                        <div class="modal-login-form-inner">                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="basic-login-inner modal-basic-inner">
                                                        <h5>Nomor Kontak Baru</h5>
                                                        <p>Masukkan informasi nomor kontak anda</p>
                                                        <form action="{{route('contact.save')}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="act" value="add">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                        <label class="login2">Nomor</label>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                                        <input type="tel" oninput="this.value = this.value.replace(/[^0-9.]/g, ''); this.value = this.value.replace(/(\..*)\./g, '$1');" name="number" class="form-control" placeholder="Masukkan nomor telefon rumah atau nomor telefon genggam" required/>
                                                                    </div>
                                                                </div>
                                                            </div>                                                        
                                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Masukkan nomor tanpa tanda +
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
                        <div id="newSocialMediaModal" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                            <div class="modal-dialog">
                                <div class="modal-content">                                    
                                    <div class="modal-body">
                                        <div class="modal-login-form-inner">                                            
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="basic-login-inner modal-basic-inner">
                                                        <h5>Media Sosial Baru</h5>
                                                        <p>Masukkan informasi Media Sosial anda</p>
                                                        <form action="{{route('socialmedia.save')}}" method="POST">
                                                            {{ csrf_field() }}
                                                            <input type="hidden" name="act" value="add">
                                                            <div class="form-group-inner">
                                                                <div class="row">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                        <label class="login2">Media</label>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                                        <div class="form-select-list">
                                                                                <select class="form-control custom-select-value" name="media" id="media">
                                                                                    @foreach(\App\SocialMediaList::all() as $sm)
                                                                                    <option value="{{$sm['id']}}">{{$sm['name']}}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br>
                                                                <div class="row">
                                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                                        <label class="login2">Username</label>
                                                                    </div>
                                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                                        <input type="text" id="username" name="username" class="form-control" placeholder="Masukkan username dari media sosial anda" required/>
                                                                    </div>
                                                                </div>
                                                            </div>                                                        
                                                            <i class="fa fa-external-link" id="external-link-icon" style="display:none;"></i>&nbsp;&nbsp;<span id="url-username"></span>
                                                            <br>
                                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Penggunaan username akan memudahkan pengguna lain untuk menuju profil media sosial anda
                                                            <br>
                                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Gunakan link diatas untuk mencoba apakah username yang anda masukkan benar-benar mengarah ke media sosial anda
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
    var urldefault ="";
    $(document).ready(function() {
        changeURL({{\App\SocialMediaList::first()['id']}});
    });
    $( "#change-name" ).click(function(event) {
        event.preventDefault();
        $("#change-name-btn").show();
        $("#name").prop('disabled', false);
    });
    $( "#change-name-save" ).click(function(event) {
        event.preventDefault();
        document.changeName.submit();
    });
    $( "#change-name-cancel" ).click(function(event) {
        event.preventDefault();
        $("#change-name-btn").hide();
        $("#name").prop('disabled', true);
    });
    $("input#username").on({
        keydown: function(e) {
            if (e.which === 32){
                alert("Username tidak mengandung karakter spasi");
                return false;
            }
        },
        keyup: function(e) {
            updateURl();
        },
        change: function() {
            this.value = this.value.replace(/\s/g, "");            
        }
    });
    $("#media").change(function() {
        var media = $(this).children("option:selected").val();
        changeURL(media);        
    });
    function changeURL(media){
        $.post("{{route('api.get.media')}}",
        {
            id: media,            
        },
        function(data, status){
            urldefault = data.url;
            updateURl();
        });
    }
    function updateURl(){
        var username = $("#username").val();
        $("#external-link-icon").show();
        var userlink = urldefault.replace("{username}", username);
        document.getElementById("url-username").innerHTML = "<a target='_blank' href='"+ userlink +"' >"+userlink+"</a>";
    }
</script>
@endsection