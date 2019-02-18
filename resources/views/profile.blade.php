@extends('layouts.main')

@section('content')
<div class="single-pro-review-area mt-t-30 mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                <div class="profile-info-inner">
                <a class="btn btn-sm btn-primary" href="{{ route('profile.edit') }}"><i class="fa fa-pencil"></i> Ubah Profil</a>
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
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                        <img class="message-avatar" src="/main/img/school.svg" alt="">
                                                </div>
                                                <div class="message">
                                                    <a class="message-author" href="#"> Universitas Gadjah Mada </a>
                                                    <span class="message-date"> 2015 - 2018 </span>
                                                    <span class="message-content">D3 Teknik Elektro
                                                    </span>                                                    
                                                </div>
                                            </div>
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                        <img class="message-avatar" src="/main/img/school.svg" alt="">
                                                </div>
                                                <div class="message">
                                                    <a class="message-author" href="#"> Universitas Gadjah Mada </a>
                                                    <span class="message-date"> 2015 - 2018 </span>
                                                    <span class="message-content">D3 Teknik Elektro
                                                    </span>                                                    
                                                </div>
                                            </div>
                                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newSchoolProfileModal"><i class="fa fa-university"></i> Tambahkan Riwayat Sekolah</a>                                                                                     
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
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                        <img class="message-avatar" src="/main/img/work.svg" alt="">
                                                </div>
                                                <div class="message">
                                                    <a class="message-author" href="#"> Universitas Gadjah Mada </a>
                                                    <span class="message-date"> 2015 - 2018 </span>
                                                    <span class="message-content">D3 Teknik Elektro
                                                    </span>                                                    
                                                </div>
                                            </div>
                                            <div class="chat-message">
                                                <div class="profile-hdtc">
                                                        <img class="message-avatar" src="/main/img/work.svg" alt="">
                                                </div>
                                                <div class="message">
                                                    <a class="message-author" href="#"> Universitas Gadjah Mada </a>
                                                    <span class="message-date"> 2015 - 2018 </span>
                                                    <span class="message-content">D3 Teknik Elektro
                                                    </span>                                                    
                                                </div>
                                            </div>
                                            <a class="btn btn-sm btn-success" data-toggle="modal" data-target="#newSchoolProfileModal"><i class="fa fa-industry"></i> Tambahkan Riwayat Pekerjaan</a>
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
                                                    <h5>Informasi Sekolah Baru</h5>
                                                    <p>Masukkan informasi tempat sekolah anda</p>
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
@endsection

@section('js')
<script>
$(document).ready(function(){
    $('[tool-tip-toggle="tooltip-demo"]').tooltip({
        placement : 'top'
    });
});
</script>
@endsection