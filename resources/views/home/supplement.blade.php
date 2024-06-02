<section class="section" id="our-classes">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Supporting <em>Supplements</em></h2>
                        <img src="assets/images/line-dec.png" alt="">
                        <p>You can take advantage of supporting supplements for your body. </p>
                    </div>
                </div>
            </div>
            <div class="row" id="tabs">
              <div class="col-lg-4">
                <ul>
                    @foreach ($supplements as $index => $supplement)                    
                    <li><a href='#tabs-{{$index}}'><img src="assets/images/tabs-first-icon.png" alt="">{{$supplement->title}}</a></li>
                    @endforeach
                  <!-- <div class="main-rounded-button"><a href="#">View All Schedules</a></div> -->
                </ul>
              </div>
              <div class="col-lg-8">
                <section class='tabs-content'>
                @foreach ($supplements as $index => $supplement)   
                  <article id='tabs-{{$index}}'>
                    <img class="uniform-image" src="{{asset('storage/' . $supplement->image)}}" alt="First Class">
                    <h4>{{$supplement->title}}</h4>
                    <p>{{$supplement->description}}</p>
                  </article>
                  @endforeach  
                </section>
              </div>
            </div>
        </div>
    </section>