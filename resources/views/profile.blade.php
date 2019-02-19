@extends('layouts.main')

@section('content')
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="profile-info-inner">
                @if($ownProfile)
                <a class="btn btn-sm btn-primary" href="{{ route('profile.edit') }}"><i class="fa fa-pencil"></i> Ubah Profil</a>
                @endif
                    <div class="profile-img">
                        <img src="/main/img/user.png" style="border-radius: 50%;" alt="" />
                    </div>
                    <div class="profile-details-hr">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="address-hr">
                                    <p>
                                        <b>Nama</b>
                                        <br />{{ $profile['name'] }}
                                    </p>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="address-hr">
                                    <p>
                                        <b>Email</b>
                                        @foreach($profile['email'] as $email)
                                        <br />{{$email['email']}} 
                                        @if($email['privacy'] == "private")<a href="{{ route('profile.request', ['user' =>$profile['id'], 'type' => 'email', 'id' => $email['id']]) }}"><i class="fa fa-unlock-alt" tool-tip-toggle="tooltip-demo" data-original-title="Klik icon ini untuk meminta akses informasi." ></i></a>
                                        @elseif($email['privacy'] == "request")<i class="fa fa-envelope" tool-tip-toggle="tooltip-demo" data-original-title="Permohonan akses telah dikirimkan."></i>
                                        @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="address-hr">
                                    <p>
                                        <b>Kontak</b>
                                        @foreach($profile['phone'] as $phone)
                                        <br />@if($phone['whatsapp'])<i class="fa fa-whatsapp"></i>@endif {{$phone['phone']}} 
                                        @if($phone['privacy'] == "private")<a href="{{ route('profile.request', ['user' =>$profile['id'], 'type' => 'phone', 'id' => $phone['id']]) }}"><i class="fa fa-unlock-alt" tool-tip-toggle="tooltip-demo" data-original-title="Klik icon ini untuk meminta akses informasi."></i></a>
                                        @elseif($phone['privacy'] == "request")<i class="fa fa-envelope" tool-tip-toggle="tooltip-demo" data-original-title="Permohonan akses telah dikirimkan."></i>
                                        @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>                            
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="address-hr">
                                    <p>
                                        <b>Alamat</b>                                        
                                        @foreach($profile['address'] as $address)
                                        <br /><i class="fa fa-home"></i> {{$address['address1']}} 
                                        @if($address['privacy'] == "private")<a href="{{ route('profile.request', ['user' =>$profile['id'], 'type' => 'address', 'id' => $address['id']]) }}"><i class="fa fa-unlock-alt" tool-tip-toggle="tooltip-demo" data-original-title="Klik icon ini untuk meminta akses informasi."></i></a>
                                        @elseif($address['privacy'] == "request")<i class="fa fa-envelope" tool-tip-toggle="tooltip-demo" data-original-title="Permohonan akses telah dikirimkan."></i>
                                        @endif
                                        @if($address['privacy'] != "private")
                                        <br />{{$address['address2']}} 
                                        @endif
                                        @endforeach
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="address-hr">
                                    <p><b>Media Sosial</b></p>
                                </div>
                            </div>
                        </div>
                        @foreach(array_chunk($profile["socialmedia"], 3) as $chunk)
                        <div class="row">
                            @foreach($chunk as $sm)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="address-hr">
                                    <a href="{{$sm['link']}}"><i class="{{$sm['icon']}}"></i></a>
                                    @if($sm['privacy'] == "private")
                                    <h6><a href="{{ route('profile.request', ['user' =>$profile['id'], 'type' => 'social', 'id' => $sm['id']]) }}"><i class="fa fa-unlock-alt" tool-tip-toggle="tooltip-demo" data-original-title="Klik icon ini untuk meminta akses informasi."></i></a></h6>
                                    @elseif($sm['privacy'] == "request")
                                    <h6><i class="fa fa-envelope" tool-tip-toggle="tooltip-demo" data-original-title="Permohonan akses telah dikirimkan."></i></h6>
                                    @elseif($sm['privacy'] == "public")
                                    <h6>{{$sm['username']}}</h6>                                   
                                    @endif 
                                </div>
                            </div> 
                            @endforeach
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                <div class="product-payment-inner-st res-mg-t-30 analysis-progrebar-ctn">
                    <ul id="myTabedu1" class="tab-review-design">
                        <!-- <li class="active"><a href="#about">Tentang</a></li>                         -->
                        <li class="active"><a href="#education">Pendidikan</a></li>                        
                        <li><a href="#work">Pekerjaan</a></li>                        
                    </ul>
                    <div id="myTabContent" class="tab-content custom-product-edit">
                        <!-- <div class="product-tab-list tab-pane fade active in" id="about">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">                                        
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="content-profile">
                                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras
                                                        dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras
                                                        dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                                    <p>Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.Cras
                                                        dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-b-15">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="skill-title">
                                                            <h2>Kemampuan</h2>
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>Java</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 90%;" class="progress-bar progress-yellow"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>Php</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 80%;" class="progress-bar progress-green"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>Apps</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 70%;" class="progress-bar progress-blue"></div>
                                                    </div>
                                                </div>
                                                <div class="progress-skill">
                                                    <h2>C#</h2>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 60%;" class="progress-bar progress-red"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mg-b-15">
                                            <div class="col-lg-12">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="skill-title">
                                                            <h2>Ketertarikan</h2>
                                                            <hr />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="ex-pro">
                                                    <ul>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                        <li><i class="fa fa-angle-right"></i> Lorem ipsum dolor sit amet, consectetur adipiscing elit.</li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>                                        
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        <div class="product-tab-list tab-pane fade active in" id="education">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="chat-discussion" style="height: auto">
                                            @if($schoolList->count() == 0)
                                            <h4>Belum menambahkan informasi riwayat pendidikan</h4>
                                            @endif
                                            @foreach($schoolList as $school)
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                        <img class="message-avatar" src="/main/img/school.svg" alt="">
                                                </div>
                                                <div class="message">
                                                    <a target="_blank" class="message-author" href="@if($school->schoolDetail['url'] != ""){{$school->schoolDetail['url']}}@else # @endif"> {{$school->schoolDetail['name']}} </a>
                                                    <span class="message-date"> {{$school->start}} - {{$school->end}} </span>
                                                    <span class="message-content">{{$school->grade}} - {{$school->major}}
                                                    </span>                                                    
                                                </div>
                                            </div>
                                            @endforeach
                                            @if($ownProfile)
                                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newSchoolProfileModal"><i class="fa fa-university"></i> Tambahkan Riwayat Pendidikan</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product-tab-list tab-pane fade in" id="work">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="review-content-section">
                                        <div class="chat-discussion" style="height: auto">
                                            @if($industryList->count() == 0)
                                            <h4>Belum menambahkan informasi riwayat pekerjaan</h4>
                                            @endif
                                            @foreach($industryList as $industry)
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                        <img class="message-avatar" src="/main/img/work.svg" alt="">
                                                </div>
                                                <div class="message">
                                                    <a class="message-author" href="#"> {{$industry->industryDetail['name']}} </a>
                                                    <span class="message-date"> {{$industry->start}} - {{$industry->end}} </span>
                                                    <span class="message-content">{{$industry->position}} - {{$industry->division}}
                                                    </span>                                                    
                                                </div>
                                            </div>
                                            @endforeach
                                            @if($ownProfile)
                                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newIndustryProfileModal"><i class="fa fa-industry"></i> Tambahkan Riwayat Pekerjaan</a>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                    <div id="newSchoolProfileModal" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">                                    
                                <div class="modal-body">
                                    <div class="modal-login-form-inner">                                            
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="basic-login-inner modal-basic-inner">
                                                    <h5>Informasi Riwayat Sekolah</h5>
                                                    <p>Masukkan informasi riwayat sekolah anda</p>
                                                    <form action="{{route('school.save')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="act" value="add">
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Institusi</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <div class="form-select-list">
                                                                        <select data-placeholder="Pilih institusi..." class="chosen-select" name="school" tabindex="-1">
                                                                            @foreach(\App\SchoolList::all()->sortBy('name') as $data)
                                                                            <option value="{{$data['id']}}">{{$data['name']}} @if(!$data['active'])*@endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Jenjang</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <div class="form-select-list">
                                                                        <select data-placeholder="Pilih jenjang..." class="chosen-select" name="grade" tabindex="-1">
                                                                            <option value="Kursus">Kursus Profesional</option>
                                                                            <option value="Profesi">Profesi</option>
                                                                            <option value="D1">D1</option>
                                                                            <option value="D2">D2</option>
                                                                            <option value="D3">D3</option>
                                                                            <option value="D4">D4</option>
                                                                            <option value="S1">S1</option>
                                                                            <option value="S2">S2</option>
                                                                            <option value="S3">S3</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Jurusan</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="text" id="major" name="major" class="form-control" placeholder="Jurusan" required/>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Masa Pendidikan</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" id="start" name="start" class="form-control" placeholder="Tahun Masuk" required/>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" id="end" name="end" class="form-control" placeholder="Tahun Keluar" required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <br>
                                                        <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Apabila anda tidak menemukan nama Institusi pendidikan dalam daftar tersebut, anda dapat menambahkan melalui link berikut : <a href="{{route('add.institution.get')}}">Tambah informasi Institusi</a>
                                                        <br>
                                                        <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Institusi yang belum diverifikasi oleh admin (bertanda *) belum akan ditampilkan pada halaman publik
                                                        <div class="login-btn-inner">                                                                
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
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
                    <div id="newIndustryProfileModal" class="modal modal-edu-general modal-zoomInDown fade" role="dialog">
                        <div class="modal-dialog">
                            <div class="modal-content">                                    
                                <div class="modal-body">
                                    <div class="modal-login-form-inner">                                            
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <div class="basic-login-inner modal-basic-inner">
                                                    <h5>Informasi Riwayat Pekerjaan</h5>
                                                    <p>Masukkan informasi riwayat pekerjaan anda</p>
                                                    <form action="{{route('industry.save')}}" method="POST">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" name="act" value="add">
                                                        <div class="form-group-inner">
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Institusi</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <div class="form-select-list">
                                                                        <select data-placeholder="Pilih institusi..." class="chosen-select" name="industry" tabindex="-1">
                                                                            @foreach(\App\IndustryList::all()->sortBy('name') as $data)
                                                                            <option value="{{$data['id']}}">{{$data['name']}} @if(!$data['active'])*@endif</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <br>                                                            
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Jabatan</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="text" id="position" name="position" class="form-control" placeholder="Jabatan" required/>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Divisi</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <input type="text" id="division" name="division" class="form-control" placeholder="Divisi / Bagian" required/>
                                                                </div>
                                                            </div>
                                                            <br>
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                                                                    <label class="login2">Periode</label>
                                                                </div>
                                                                <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                                                    <div class="row">
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" id="start" name="start" class="form-control" placeholder="Tahun Mulai" required/>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                                            <input type="text" id="end" name="end" class="form-control" placeholder="Tahun Selesai" required/>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>                                                        
                                                        <br>
                                                        <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Apabila anda tidak menemukan nama Institusi pendidikan dalam daftar tersebut, anda dapat menambahkan melalui link berikut : <a href="{{route('add.industry.get')}}">Tambah informasi Institusi</a>
                                                        <br>
                                                        <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Institusi yang belum diverifikasi oleh admin (bertanda *) belum akan ditampilkan pada halaman publik
                                                        <div class="login-btn-inner">                                                                
                                                            <div class="row">
                                                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12"></div>
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
@endsection

@section('css')
<link rel="stylesheet" href="/main/css/chosen/bootstrap-chosen.css">
@endsection

@section('js')
<!-- chosen JS
============================================ -->
<script src="/main/js/chosen/chosen.jquery.js"></script>
<script src="/main/js/chosen/chosen-active.js"></script>
<script>
$(document).ready(function(){
    $('[tool-tip-toggle="tooltip-demo"]').tooltip({
        placement : 'top'
    });
});
</script>
@endsection