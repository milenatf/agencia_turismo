@extends('site.layouts.app')

@section('content-site')
<div class="content">

    <section class="container">
        <h1 class="title">Promoções</h1>

        <div class="row">
            @forelse($promotions as $promotion)
            <article class="result col-lg-3 col-md-4 col-sm-6 col-12">
                <div class="image-promo">
                    <img src="{{url('assets/site/images/buenos_aires.jpg')}}" alt="">

                    <div class="legend">
                        <h1>Destino: {{ $promotion->destination->city->name }}</h1>
                        <h2>Saída: {{ $promotion->origin->city->name }}</h2>
                        <span>Somente ida</span>
                    </div>
                </div><!--image-promo-->

                <div class="details">
                    <p>Data: {{ formatDateAndtime($promotion->date, 'd/m/Y') }}</p>

                    <div class="price">
                        <span>R$ {{ number_format($promotion->price, 2, ',','.') }}</span>
                        <strong>Em até {{ $promotion->qts_stops }}x</strong>
                    </div>

                    <a href="{{route('details.flight', $promotion->id)}}" class="btn btn-buy">Comprar</a>
                </div><!--details-->

            </article><!--result-->
            @empty
                <p>Não há promoções cadastradas!</p>
            @endforelse
        </div><!--Row-->
    </section><!--Container-->

</div>
@endsection