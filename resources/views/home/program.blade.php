<section class="section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="section-heading">
                        <h2>Choose <em>Program</em></h2>
                        <img src="assets/images/line-dec.png" alt="waves">
                        <h5 style="color: grey;">BUILD YOUR MUSCLE, with this program!</h5>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                        @for($i=0;$i<sizeof($programs);$i+=2 )
                            <li class="feature-item">
                                <div class="left-icon">
                                    <img src="assets/images/features-first-icon.png" alt="First One">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $programs[$i]->title}}</h4>
                                    <p>{{ $programs[$i]->description}}</p>
                                </div>
                            </li>
                        @endfor

                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="features-items">
                    @for($i=1;$i<sizeof($programs);$i+=2 )
                            <li class="feature-item">
                                <div class="left-icon">
                                    <img src="assets/images/features-first-icon.png" alt="First One">
                                </div>
                                <div class="right-content">
                                    <h4>{{ $programs[$i]->title}}</h4>
                                    <p>{{ $programs[$i]->description}}</p>
                                </div>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </section>