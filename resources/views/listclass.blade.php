@extends('layouts.main')

@section('content')
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline10-list mt-b-30">
                    <div class="sparkline10-hd">
                        <div class="main-sparkline10-hd">
                            <h1>Daftar Kelas berdasarkan Tahun Masuk dan Jurusan</span></h1>
                        </div>
                    </div>
                    <div class="sparkline10-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner inline-basic-form">
                                        <form action="{{route('class.list')}}" method="POST">
                                            <input type="hidden" name="act" value="not">
                                            {{ csrf_field() }}
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                        <div class="form-select-list">
                                                            <select data-placeholder="Pilih tahun masuk..." class="chosen-select" name="year" tabindex="-1">
                                                                @foreach(\App\EducationYearList::all()->sortBy('year') as $data)
                                                                <option value="{{$data['id']}}" @if($data['id']==$info['year']) selected @endif>{{$data['year']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                                        <div class="form-select-list">
                                                            <select data-placeholder="Pilih jurusan..." class="chosen-select" name="major" tabindex="-1">
                                                                @foreach(\App\MajorList::all()->sortBy('name') as $data)
                                                                <option value="{{$data['id']}}" @if($data['id']==$info['major']) selected @endif>{{$data['name']}} ({{$data['short_name']}}) - {{$data->current['full_name']}} ({{$data->current['short_name']}})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                        <div class="login-horizental lg-hz-mg"><button class="btn btn-sm btn-primary login-submit-cs" type="submit">Tampilkan data kelas</button></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Mohon diperhatikan bahwa pengelompokan kelas (angkatan) dilakukan berdasarkan <b>Tahun Masuk</b> bukan dari <b>Tahun Kelulusan</b>
                                            <br>
                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Setelah anda yakin dengan kelas yang sesuai, anda dapat melakukan <b>klaim</b> terhadap kelas tersebut.
                                            <br>
                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Bagi alumni yang merupakan pindahan dari sekolah lain, harap menyesuaikan Tahun Masuk dengan Tahun Masuk teman-teman diangkatannya.
                                            <br>
                                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Dikarenakan nama jurusan yang mungkin mengalami beberapa perubahan dari tahun ke tahun, maka nama jurusan ditampilkan dalam format <b>Nama Jurusan saat itu - Nama Jurusan yang sepadan dengan jurusan yang ada saat ini</b>. Untuk itu apabila anda tidak menemukan nama jurusan yang sesuai dengan jurusan anda saat itu, dapat menambahkan melalui link berikut : <a href="{{route('add.major.get')}}">Tambah informasi Jurusan</a>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if($info['status'] != "fisrt")
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Angkatan {{\App\EducationYearList::find($info['year'])['year']}} - Jurusan {{\App\MajorList::find($info['major'])['name']}}</h1>
                            @if($classList->count() == 0)
                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Belum ada data kelas pada angkatan ini, silahkan tambahkan data kelas baru                            
                            @else
                            <i class="fa fa-info-circle" ></i>&nbsp;&nbsp;Apabila anda belum menemukan kelas anda pada angkatan ini, silahkan tambahkan data kelas baru                            
                            @endif
                            <a class="btn btn-sm btn-success"><i class="fa fa-user-plus"></i> Tambahkan data kelas baru</a>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@if($info['status'] != "fisrt")
@if($classList->count() != 0)
<div class="courses-area  mg-b-15">
    <div class="container-fluid">
        <div class="row">
            @foreach($classList->sortBy('name') as $class)
            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                <div class="courses-inner res-mg-b-30">
                    <div class="courses-title">
                        @if($class['photo'] == null)
                        <img src="/main/img/SMK.jpg" alt="">
                        @else
                        <img src="{{$class['photo']}}" alt="">
                        @endif
                        <h2>{{$class->yearInfo['year']}} - {{$class->majorInfo['short_name']}} - {{$class['name']}}</h2>
                    </div>
                    <div class="courses-alaltic">
                        @if($class['alias']!="")
                        <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-commenting"></i></span> {{$class['alias']}}</span>
                        @endif
                        <span class="cr-ic-r"><span class="course-icon"><i class="fa fa-user"></i></span> 20</span>                        
                    </div>
                    <div class="course-des">
                    </div>
                    <div class="product-buttons">
                        <a class="btn btn-sm btn-info"><i class="fa fa-users"></i> Tampilkan anggota</a>
                        <a class="btn btn-sm btn-success"><i class="fa fa-plus"></i> Klaim Kelas</a>
                    </div>
                </div>
            </div> 
            @endforeach           
        </div>
    </div>
</div>
@endif
@endif
@endsection


@section('css')
<link rel="stylesheet" href="/main/css/chosen/bootstrap-chosen.css">
@endsection

@section('js')
<!-- chosen JS
============================================ -->
<script src="/main/js/chosen/chosen.jquery.js"></script>
<script src="/main/js/chosen/chosen-active.js"></script>
@endsection