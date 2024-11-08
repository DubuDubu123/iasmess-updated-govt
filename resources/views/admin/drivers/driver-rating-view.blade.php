@extends('admin.layouts.app')

<style>
    .timeline .timeline-item>.timeline-point {
        color: yellow !important;
        padding: 3px;
    }

    .dropdown.user.user-menu a.dropdown-toggle {
        display: inherit;
    }

</style>

@section('content')


<section class="content">
    <div class="row">
        <div class="col-12">

            <a href="{{ url()->previous() }}">
                <button class="btn btn-danger btn-sm pull-right mb-3" type="submit">
                    <i class="mdi mdi-keyboard-backspace mr-2"></i>
                    @lang('view_pages.back')
                </button>
            </a>
            <div class="box">
                <div class="box">
                    <div class="box-body box-profile pad0">
                        <div class="row">
                            <div class="col-md-2 m-auto text-right">
                                <img class="avatar avatar-xxl avatar-bordered"
                                    src="{{ $item->user->profile_pic ?: asset('/assets/img/user-dummy.svg') }}" alt="">
                            </div>
                            <div class="col-md-4 col-12">
                                <div>
                                    <h3>
                                        <span class="text-gray">{{ $item->name }} </span>
                                    </h3>
                                    <p>
                                        <span class="text-gray">
                                            {{ $item->user->email }} <br>
                                            {{ $item->user->mobile }}
                                        </span>
                                    </p>
                                    <p>
                                        @php $rating = $item->rating($item->user_id); @endphp

                                        @php
                                            $ratingValue = $item->driverRating()->where('user_rating',1)->avg('rating');
                                            $roundedRating = round($ratingValue,2); // Round the rating to the nearest whole number
                                        @endphp

                                        <span> {{ $roundedRating }}</span>
                                    </p>
                                   
                                </div>
                            </div>
                            <div class="col-md-2 m-auto">
                                <img class="w-fill" src="{{ $item->vehicleType->icon ?: asset('assets/images/2.jpg') }}"
                                    alt="">
                            </div>
                            <div class="col-md-4 col-12">
                                <div>
                                    <h3>
                                        <span class="text-gray">{{ $item->car_make }}</span>
                                    </h3>
                                    <p>
                                        <span class="text-gray">
                                            {{ $item->car_model }} ({{ $item->vehicleType->name }})
                                        </span>
                                    </p>
                                    <p>
                                        <span class="text-gray">
                                            {{ $item->car_number }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>

            <div class="col-lg-12">

                <div class="nav-tabs-custom box-profile">

                    <div class="tab-content">

                        <div class="active tab-pane" id="timeline">

                            <div class="box p-15">
                                <div class="timeline timeline-single-column" style="max-width: max-content;">
                                    @foreach ($trips as $trip)

                                        <div class="timeline-item">
                                            <div class="timeline-point">
                                                <i class="fa fa-star text-yellow"></i>
                                            </div>
                                            
                                            <div class="timeline-event p-10">
                                                <div class="post">
                                                    <div class="user-block">

                                                        <img class="img-bordered-sm rounded-circle"
                                                            src="{{ $trip->userDetail->profile_picture ?: asset('/assets/img/user-dummy.svg') }}"
                                                            alt="user image">

                                                        <span class="username">
                                                            <a href="#">{{ $trip->userDetail->name }}</a>
                                                            {{ $trip->requestDetail->request_number }}
                                                        </span>
                                                        <span
                                                            class="description">{{ $trip->created_at->diffForHumans() ?? '' }}</span>
                                                        <p style="position: absolute;right: 15px;top: 15px;">
                                                            {{ $trip->created_at->format('d-M-Y') }}</p>
                                                    </div>

                                                    <div class="activitytimeline">
                                                        <p>
                                                            <b>  @lang('view_pages.pickup_address'):</b>
                                                            
                                                            <span class="text-gray">
                                                                {{ $trip->requestDetail->requestPlace->pick_address }}
                                                            </span>
                                                        </p>
                                                        <p class="mar0">{{ $trip->comment }}</p>

                                                        <span>
                                                            @php
                                                                $rating = $trip->rating;
                                                                $originalRating = $rating; // Store the original rating value

                                                                for ($i = 1; $i <= 5; $i++) {
                                                                    echo '<span class="fa-stack" style="width:1em">';
                                                                    if ($rating > 0) {
                                                                        if ($rating > 0.5) {
                                                                            echo '<i class="fa fa-star checked" style="color: yellow"></i>';
                                                                        } else {
                                                                            echo '<i class="fa fa-star-half-o" style="color: yellow"></i>';
                                                                        }
                                                                    } else {
                                                                        echo '<i class="fa fa-star-o" style="color: yellow"></i>';
                                                                    }
                                                                    echo '</span>';
                                                                    $rating--;
                                                                }
                                                            @endphp

                                                            <span>({{ number_format($originalRating, 1) }})</span>
                                                        </span>

                                                        
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    @endforeach
                                    <span class="timeline-label">
                                        <button class="btn btn-danger"><i class="fa fa-clock-o"></i></button>
                                    </span>

                                    <div class="text-right">
                                        <span  style="float:right">
                                        {{$trips->links()}}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>   
                </div>
            </div>
        </div>
    </section>

@endsection
