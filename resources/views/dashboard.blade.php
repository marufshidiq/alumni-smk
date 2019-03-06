@extends('layouts.main')

@section('content')
<div class="product-sales-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
                <div class="sparkline9-list">
                    <div class="sparkline9-hd">
                        <div class="main-sparkline9-hd">
                            <h1>Ringkasan</h1>
                        </div>
                    </div>
                    <div class="sparkline9-graph">
                        <div class="basic-login-form-ad">                            
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="basic-login-inner">                                        
                                        <p>Mohon lengkapi informasi profil anda untuk mempermudah komunikasi antar alumni.</p>
                                        <form>
                                            <div class="form-group-inner">
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['avatar'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Foto profil
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['email'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Alamat email
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['phone'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Kontak telefon
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['class'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Tahun masuk
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['class'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Jurusan
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['class'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Kelas
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">                                                    
                                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                        <div class="i-checks pull-left">
                                                            <label class="">
                                                                <div class="iradio_square-green @if($checklist['social'])checked @endif" style="position: relative;"><input type="radio" checked="" value="option2" name="a" style="position: absolute; opacity: 0;"><ins class="iCheck-helper" style="position: absolute; top: 0%; left: 0%; display: block; width: 100%; height: 100%; margin: 0px; padding: 0px; background: rgb(255, 255, 255); border: 0px; opacity: 0;"></ins></div> 
                                                                <i></i> Media Sosial
                                                            </label>
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
            <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                <div class="product-sales-chart">
                    <div class="portlet-title">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="caption pro-sl-hd">
                                    <span class="caption-subject"><b>Statistik Alumni</b></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="actions graph-rp graph-rp-dl">
                                    <p>Jumlah alumni terdaftar dan terverifikasi <br> (Diperbarui setiap 1 jam)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <ul class="list-inline cus-product-sl-rp">
                        @foreach(\App\MajorList::all() as $major)
                        <li>
                            <h5><i class="fa fa-circle" style="color: {{config('morris.color.'.$loop->index)}};"></i>{{$major['short_name']}}</h5>
                        </li>
                        @endforeach
                    </ul>
                    <div id="extra-area-chart" style="height: 356px;"></div>
                </div>
            </div>
            <!-- col-lg-3 col-md-3 col-sm-3 col-xs-12 -->            
        </div>
    </div>
</div>

@endsection

@section('js')
<!-- morrisjs JS
============================================ -->
<script src="/main/js/morrisjs/raphael-min.js"></script>
<script src="/main/js/morrisjs/morris.js"></script>
<script src="/main/js/morrisjs/smkn1klaten.js"></script>
<!-- morrisjs JS
============================================ -->
@endsection