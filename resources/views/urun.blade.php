@extends('layouts.master')
@section('title',$urun->urun_adi)
@section('content')
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="{{route('anasayfa')}}">Anasayfa</a></li>
            @foreach($urun->kategoriler()->distinct()->get( ) as $kategori)
                <li><a href="{{route('kategori',$kategori->slug)}}">{{$kategori->kategori_adi}}</a></li>
            @endforeach
            <li class="active">{{$urun->urun_adi}}</li>
        </ol>
        <div class="bg-content">
            <div class="row">
                <div class="col-md-5">
                <img src="{{ asset($urun->resim) }}" alt="{{ $urun->urun_adi }}" style="width: 250px; height: 200px;">

                    <hr>
                    <div class="row">
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="{{ asset($urun->resim) }}" alt="{{ $urun->urun_adi }}" style="width: 250px; height: 100px;"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="{{ asset($urun->resim) }}" alt="{{ $urun->urun_adi }}" style="width: 250px; height: 100px;"></a>
                        </div>
                        <div class="col-xs-3">
                            <a href="#" class="thumbnail"><img src="{{ asset($urun->resim) }}" alt="{{ $urun->urun_adi }}" style="width: 250px; height: 100px;"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <h1>{{$urun->urun_adi}}</h1>
                    <p class="price">{{$urun->fiyat}} ₺</p>
                    <form action="{{route('sepet.ekle')}}" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{$urun->id}}">
                        <input type="submit" class="btn btn-theme" value="Sepete Ekle">
                    </form>
                </div>
            </div>

            <div>
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#t1" data-toggle="tab">Ürün Açıklaması</a></li>
                    <li role="presentation"><a href="#t2" data-toggle="tab">Yorumlar</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="t1">{{$urun->aciklama}}</div>
                    <div role="tabpanel" class="tab-pane" id="t2">Şimdilik Yorum Yok</div>
                </div>
            </div>

        </div>
    </div>
@endsection
