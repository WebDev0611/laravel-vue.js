@extends('layouts.main')
@section('page-name', 'subscription-upgrade')

@section('content')

<main class="app-main">

    <section class="section-heading">
        <div class="container">

            <h1 class="section-heading__heading">
                Choose a plan
            </h1>
        </div>
    </section>

    <section class="section-plans">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-lg-offset-0 col-md-10 col-md-offset-1">
                    <div class="row">

                        @php
                        $bronzeFeatures = [
                            [ 'feature' => 'Access to our full feature Interface until subscription runs out', 'included' => true ],
                            [ 'feature' => '100 uploaded panoramas', 'included' => true ],
                            [ 'feature' => 'Free Support and future updates ', 'included' => true ],
                            [ 'feature' => 'Direct link of for your virtual tours to embed on Zoopla, Rightmove or your own website', 'included' => true ],
                            [ 'feature' => 'No Contract', 'included' => true ],
                            [ 'feature' => 'Full Statistics and Analytics of who visits your tours, how long they stay and where they usually click or tap', 'included' => false ],
                            [ 'feature' => 'Feature 5', 'included' => false ],
                        ];
                        $silverFeatures = [
                            [ 'feature' => 'Access to our full feature Interface until subscription runs out', 'included' => true ],
                            [ 'feature' => '500 uploaded panoramas ', 'included' => true ],
                            [ 'feature' => 'Free Support and future updates', 'included' => true ],
                            [ 'feature' => 'Direct link of for your virtual tours to embed on Zoopla, Rightmove or your own website', 'included' => true ],
                            [ 'feature' => 'No Contract', 'included' => true ],
                            [ 'feature' => 'Full Statistics and Analytics of who visits your tours, how long they stay and where they usually click or tap', 'included' => false ],
                            [ 'feature' => 'Feature 5', 'included' => false ],
                        ];
                        $goldFeatures = [
                            [ 'feature' => 'Access to our full feature Interface until subscription runs out', 'included' => true ],
                            [ 'feature' => '1000 uploaded panoramas', 'included' => true ],
                            [ 'feature' => 'Free Support and future updates', 'included' => true ],
                            [ 'feature' => 'Direct link of for your virtual tours to embed on Zoopla, Rightmove or your own website', 'included' => true ],
                            [ 'feature' => 'No Contract', 'included' => true ],
                            [ 'feature' => 'Full Statistics and Analytics of who visits your tours, how long they stay and where they usually click or tap', 'included' => false ],
                            [ 'feature' => 'Feature 5', 'included' => true ],
                        ];
                        $platinumFeatures = [
                            [ 'feature' => 'Access to our full feature Interface until subscription runs out', 'included' => true ],
                            [ 'feature' => 'Unlimited uploaded panoramas', 'included' => true ],
                            [ 'feature' => 'Free Support and future updates', 'included' => true ],
                            [ 'feature' => 'Direct link of for your virtual tours to embed on Zoopla, Rightmove or your own website', 'included' => true ],
                            [ 'feature' => 'No Contract', 'included' => true ],
                            [ 'feature' => 'Full Statistics and Analytics of who visits your tours, how long they stay and where they usually click or tap', 'included' => true ],
                            [ 'feature' => 'Feature 5', 'included' => true ],
                        ];
                        @endphp

			@foreach($plans as $plan)
                            @if($plan->subkey != 'free')
                            <div class="section-plans__plan col-lg-3 col-md-6 {{ $plan->name }}">
                                <div class="section-plans__plan-inner">

                                    <div class="section-plans__plan-header">

                                       
                                        <h2 class="section-plans__plan-name">{{ $plan->name }}</h2>

                                        <span class="section-plans__plan-price">
                                            £{{ $plan->price }} /pm
                                        </span>

                                        <span class="section-plans__plan-count">
                                            @if ($plan->subkey == 'platinum')
                                            Unlimited
                                            @else
                                            {{ $plan->max_tours }}
                                            @endif
                                            Tours
                                        </span>
                                    </div>

                                    <div class="section-plans__plan-body">

                                        <ul class="section-plans__plan-features">
                                            @php
                                            if ($plan->subkey == 'bronze') {
                                                $features = $bronzeFeatures;
                                            } elseif ($plan->subkey == 'silver') {
                                                $features = $silverFeatures;
                                            } elseif ($plan->subkey == 'gold') {
                                                $features = $goldFeatures;
                                            } elseif ($plan->subkey == 'platinum') {
                                                $features = $platinumFeatures;
                                            }
                                            @endphp

                                            @foreach ($features as $feature)

                                                @php
                                                    if ($feature['included']) {
                                                        $icon = 'check_circle';
                                                        $iconColor = 'green';
                                                    } else {
                                                        $icon = 'cancel';
                                                        $iconColor = 'red';
                                                    }
                                                @endphp

                                                <li>
                                                    <i class="material-icons {{ $iconColor }}">{{ $icon }}</i>
                                                    {{ $feature['feature'] }}
                                                </li>
                                            @endforeach

                                        </ul>

                                    </div>


                                    <div class="section-plans__plan-footer">
                                        <form action="/user/subscription/order" method=POST>
                                        <input type="hidden" name="testMode" value="100">
                                        <input type="hidden" name="plan" value="{{ $plan->subkey }}">
                                        <input type="hidden" name="cartId" value="{{ $plan->max_tours }}">
                                        <input type="hidden" name="amount" value="{{ $plan->price }}">
                                        <input type="hidden" name="currency" value="GBP">

                                         @if(Auth::guest())
                                         <a href="{{url('/login')}}" class="btn btn-primary green">Subscribe</a>
                                        @else
                                         <a href="{{url('/user/subscription/order')}}?subscription={{$plan->subkey}}" class="btn btn-primary green">Subscribe</a>
                                        @endif

                                        </form>
                                    </div>


                                </div>
                            </div>
                            @endif

                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </section>

</main>

@endsection
