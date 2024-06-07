<div class="main-banner" id="top">
        <video autoplay muted loop id="bg-video">
            <source src="{{asset("assets/images/gym-video.mp4")}}" type="video/mp4" />
        </video>

        <div class="video-overlay header-text">
            <div class="caption">
            @foreach ($configurations as $index => $configuration )
                <h6>{{ $configuration->motivation_1 }}</h6>
                <h2>{{ $configuration->motivation_2 }} <em>{{ $configuration->name }}</em></h2>
                @endforeach
                <div class="main-button scroll-to-section">
                    <a href="{{URL::to('registration-member')}}">Join Member</a>
                </div>
            </div>
        </div>
    </div>