@extends('layouts.main')

@section('content')
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="sparkline12-list">
                    <div class="sparkline12-hd">
                        <div class="main-sparkline12-hd">
                            <h1>Kesan dan Pesan untuk SMK N 1 Klaten</h1>
                        </div>
                    </div>
                    <div class="sparkline12-graph">
                        <div class="basic-login-form-ad">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="all-form-element-inner">
                                        @if(\Auth::user()->testimonial()->first()['active'] == 0)
                                        <div class="alert alert-info" role="alert">
                                            <strong>Pemberitahuan!</strong> Kesan dan Pesan anda akan tampil di halaman publik setelah diverifikasi oleh admin.
                                        </div>
                                        @else
                                        <div class="alert alert-success" role="alert">
                                            <strong>Pemberitahuan!</strong> Kesan dan Pesan anda akan telah ditampilkan di halaman publik. Terima kasih
                                        </div>
                                        @endif
                                        <form action="{{route('add.testi')}}" method="POST">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="act" value="@if(\Auth::user()->testimonial()->exists()) edit @else add @endif">
                                            <div class="form-group-inner">
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
                                                        <label class="login2 pull-right pull-right-pro">Kesan dan Pesan</label>                                                    
                                                    </div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                        <textarea maxlength="190" class="form-control" rows="3" id="message" name="message">@if(\Auth::user()->testimonial()->exists()){{\Auth::user()->testimonial()->first()['message']}}@endif</textarea>
                                                        <div class="char">(0/190)</div>
                                                    </div>
                                                </div>                                        
                                                <div class="row">
                                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12"></div>
                                                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12">
                                                        <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                            <button class="btn btn-sm btn-primary" type="submit">
                                                            @if(\Auth::user()->testimonial()->exists())
                                                            Ubah Kesan dan Pesan
                                                            @else
                                                            Tambahkan Kesan dan Pesan
                                                            @endif
                                                            </button>
                                                            @if(\Auth::user()->testimonial()->exists())
                                                            <button class="btn btn-sm btn-danger" id="deleteButton" type="button">
                                                            Hapus
                                                            </button>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <form action="{{route('add.testi')}}" method="POST" id="deleteMessage">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="act" value="delete">
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

@section('js')
<script>
    var maxLength = 190;
    $("#message").on("keyup",function(event){
        countMessage();
    });

    $("#deleteButton").click(function(){
        $("#deleteMessage").submit();
    });

    function countMessage(){
        var length = $("#message").val().length;
        $(".char").html("("+length+"/"+maxLength+")");
    }
    
    @if(\Auth::user()->testimonial()->exists())
    $(document).ready(function() {
        countMessage();
    });
    @endif
</script>
@endsection