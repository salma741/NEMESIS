<section class="section" id="trainers">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Expert <em>Trainers</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        @foreach ($configurations as $index => $configuration )
                        <p>{{ $configuration->paragraph_trainer }}</p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="row">
            @foreach ($trainers as $index => $trainer )                
                <div class="col-lg-4">
                    <div class="trainer-item">
                        <div class="image-thumb">
                            <img class="image-thumb" src="{{asset('storage/' . $trainer->image)}}" alt="">
                        </div>
                        <div class="down-content">
                            <br>
                            <h4>{{$trainer->name}}</h4>
                            <p>{{$trainer->description}}</p>
                            <p>{{$trainer->address}}</p>
                            <p>{{$trainer->phone}}</p>
                        </div>
                    </div>    
                </div>
                @endforeach
            </div>
        </div>
    </section>