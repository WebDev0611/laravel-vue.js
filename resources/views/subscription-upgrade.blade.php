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
                            [ 'feature' => '15 Live Tours', 'included' => true ],
                            [ 'feature' => 'Smartphone, Tablet and VR Ready', 'included' => true ],
                            [ 'feature' => 'Supports all 360° Images ', 'included' => true ],
                            [ 'feature' => 'Share on Social Media', 'included' => true ],
                            [ 'feature' => 'Free Updates & Support', 'included' => true ],
                            [ 'feature' => 'Easy to use Menu', 'included' => true ],
                            [ 'feature' => 'Customized Branding', 'included' => true ],
                             [ 'feature' => 'No Contract', 'included' => true ],
                             
                        ];
                        $silverFeatures = [
                             [ 'feature' => '25 Live Tours', 'included' => true ],
                            [ 'feature' => 'Smartphone, Tablet and VR Ready', 'included' => true ],
                            [ 'feature' => 'Supports all 360° Images ', 'included' => true ],
                            [ 'feature' => 'Share on Social Media', 'included' => true ],
                            [ 'feature' => 'Free Updates & Support', 'included' => true ],
                            [ 'feature' => 'Easy to use Menu', 'included' => true ],
                            [ 'feature' => 'Customized Branding', 'included' => true ],
                             [ 'feature' => 'Intelligent Statistics', 'included' => true ],
                             [ 'feature' => 'No Contract', 'included' => true ],
                        ];
                        $goldFeatures = [
                              [ 'feature' => '50 Live Tours', 'included' => true ],
                            [ 'feature' => 'Smartphone, Tablet and VR Ready', 'included' => true ],
                            [ 'feature' => 'Supports all 360° Images ', 'included' => true ],
                            [ 'feature' => 'Share on Social Media', 'included' => true ],
                            [ 'feature' => 'Free Updates & Support', 'included' => true ],
                            [ 'feature' => 'Easy to use Menu', 'included' => true ],
                            [ 'feature' => 'Customized Branding', 'included' => true ],
                             [ 'feature' => 'Intelligent Statistics', 'included' => true ],
                             [ 'feature' => 'No Contract', 'included' => true ],
                        ];
                        $platinumFeatures = [
                        
                          [ 'feature' => 'Unlimited', 'included' => true ],
                            [ 'feature' => 'Smartphone, Tablet and VR Ready', 'included' => true ],
                            [ 'feature' => 'Supports all 360° Images ', 'included' => true ],
                            [ 'feature' => 'Share on Social Media', 'included' => true ],
                            [ 'feature' => 'Free Updates & Support', 'included' => true ],
                            [ 'feature' => 'Easy to use Menu', 'included' => true ],
                            [ 'feature' => 'Customized Branding', 'included' => true ],
                             [ 'feature' => 'Intelligent Statistics', 'included' => true ],
                             [ 'feature' => 'No Contract', 'included' => true ],
                           
                        ];
                        @endphp


                        @foreach($plans as $plan)
                            @if($plan->subkey != 'free')
                            <div class="section-plans__plan col-lg-3 col-md-6 {{ $plan->name }}">
                                <div class="section-plans__plan-inner">

                                    <div class="section-plans__plan-header">

                                        @if ($plan->subkey == Auth::user()->subkey)
                                        <div class="section-plans__plan-subscribed-message">
                                            Subscribed
                                        </div>
                                        @endif

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


   <a class="btn btn-primary green"
                                           href="{{ url('/user/subscription/order?subscription=' . $plan->subkey) }}"
                                        >
                                            Subscribe
                                        </a>
                                      
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
