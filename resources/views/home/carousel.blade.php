<div class="container-lg">
    <div class="row">
        <div class="col-md-12">
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <!-- Carousel indicators -->
                <ol class="carousel-indicators">
                    @foreach ($carousels as $index => $carousel)
                        <li data-target="#myCarousel" data-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></li>
                    @endforeach
                </ol>

                <!-- Wrapper for carousel items -->
                <div class="carousel-inner" style="margin-top: 70px;">
                    @foreach ($carousels as $index => $carousel)
                        <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                            <img src="{{ asset('storage/' . $carousel->image) }}" class="img-fluid" alt="{{ $carousel->title }}">
                            <div class="carousel-caption">
                                <div class="row">
                                    <div class="col-12">
                                        <h3>{{ $carousel->title }}</h3>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <p>{{ $carousel->description }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Carousel controls -->
                <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
                    <i class="fa fa-angle-left"></i>
                </a>
                <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
                    <i class="fa fa-angle-right"></i>
                </a>
            </div>
        </div>
    </div>
</div>
