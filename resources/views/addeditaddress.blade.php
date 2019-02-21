@extends('layouts.main')

@section('content')
<div class="advanced-form-area mg-b-15">
    <div class="container-fluid">        
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                <div class="sparkline10-list mg-tb-30 responsive-mg-t-0 table-mg-t-pro-n dk-res-t-pro-0 nk-ds-n-pro-t-0">
                    <div class="sparkline10-hd">
                        <div class="main-sparkline10-hd">
                            <h1>{{$detail['header']}}</h1>
                        </div>
                    </div>
                    <form action="{{route('address.save')}}" method="POST" id="address-form">
                    {{ csrf_field() }}
                    <input type="hidden" name="act" value="{{$detail['act']}}">
                    <input type="hidden" name="id" value="{{$detail['id']}}">
                    <div class="sparkline10-graph">
                        <div class="input-knob-dial-wrap">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    Alamat
                                    <input type="text" class="form-control" name="address" placeholder="Alamat lengkap" @if($detail['act']=="edit") value="{{$detail['address']}}" @endif>                        
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="chosen-select-single mg-b-20">
                                        <label>Provinsi</label>
                                        <select data-placeholder="Pilih provinsi..." class="chosen-select province" name="province" tabindex="-1">
                                                <option value="">Pilih provinsi</option>
                                                @foreach($province as $p)
                                                <option value="{{$p['id']}}" @if($detail['act']=="edit") @if($detail['province']==$p['id']) selected @endif @endif>{{$p['name']}}</option>
                                                @endforeach
                                        </select>
                                    </div>                                
                                </div>
                            </div>
                            <div class="row city-section" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="chosen-select-single mg-b-20">
                                        <label>Kota/Kabupaten</label>
                                        <select data-placeholder="Pilih kabupaten..." class="chosen-select city" name="city" tabindex="-1">
                                                <option value="">Pilih </option>
                                                @if($detail['act']=="edit") 
                                                @foreach($detail['city-list'] as $p)
                                                <option value="{{$p['id']}}" @if($detail['act']=="edit") @if($detail['city']==$p['id']) selected @endif @endif>{{$p['name']}}</option>
                                                @endforeach         
                                                @endif                                       
                                        </select>
                                    </div>                                
                                </div>
                            </div>
                            <div class="row district-section" style="display: none;">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="chosen-select-single mg-b-20">
                                        <label>Kecamatan</label>
                                        <select data-placeholder="Pilih kecamatan..." class="chosen-select district" name="district" tabindex="-1">
                                                <option value="">Pilih</option>
                                                @if($detail['act']=="edit") 
                                                @foreach($detail['district-list'] as $p)
                                                <option value="{{$p['id']}}" @if($detail['act']=="edit") @if($detail['district']==$p['id']) selected @endif @endif>{{$p['name']}}</option>
                                                @endforeach 
                                                @endif                                               
                                        </select>
                                    </div>                                
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                    <br>
                    <a class="btn btn-sm btn-success" onclick="saveAddress(event);"><i class="fa fa-save"></i> Simpan</a>
                    <a class="btn btn-sm btn-default" href="{{ route('profile.edit') }}"><i class="fa fa-ban"></i> Batal</a>
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
    @if($detail['act']=="edit") 
        $(".city-section").show();
        $(".district-section").show();
    @endif
    $(".province").change(function() {
        var selectedProvince = $(this).children("option:selected").val();
        $(".district-section").hide();
        $(".district option").remove();
        if(selectedProvince == ""){
            $(".city-section").hide();
            $(".city option").remove();
            return;
        }

        $.post("{{route('api.get.address')}}",
        {
            type: 'city',
            id: selectedProvince,            
        },
        function(data, status){
            $(".city option").remove();
            $.each(data.cities, function (i, item) {
                $('.city').append($('<option>', { 
                    value: item.id,
                    text : item.name 
                }));
            });
            $('.city').trigger("chosen:updated");            
        });

        $(".city-section").show();
    });

    $(".city").change(function() {
        var selectedCity = $(this).children("option:selected").val();
        if(selectedCity == ""){
            $(".district-section").hide();
            return;
        }

        $.post("{{route('api.get.address')}}",
        {
            type: 'district',
            id: selectedCity,            
        },
        function(data, status){
            $(".district option").remove();
            $.each(data.districts, function (i, item) {
                $('.district').append($('<option>', { 
                    value: item.id,
                    text : item.name 
                }));
            });
            $('.district').trigger("chosen:updated");            
        });

        $(".district-section").show();
    });

    function saveAddress(event){
        event.preventDefault();
        var selectedProvince = $('.province').val();
        var selectedCity = $('.city').val();
        var selectedDistrict = $('.district').val();
        if(selectedProvince == "" || selectedCity == "" || selectedDistrict == null)
        {
            alert("Harap lengkapi semua data yang diminta");
            return;
        }
        // console.log(selectedProvince);
        // console.log(selectedCity);
        // console.log(selectedDistrict);
        document.getElementById('address-form').submit();
    }
</script>
@endsection