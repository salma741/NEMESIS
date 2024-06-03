<section class="section" id="contact-us">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
            @foreach ($configurations as $index => $configuration)
                <div id="map">
                    <iframe src="{{$configuration->map_link}}" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
                @endforeach 
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="contact-form">
                    <form id="contact" action="{{route('contact.send')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <fieldset>
                                <input name="name" type="text" id="name" placeholder="Your Name*" required="">
                            </fieldset>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <fieldset>
                                <input name="phone" type="text" id="phone" placeholder="Your Phone*" required="">
                            </fieldset>
                        </div>
                        <div class="col-md-12 col-sm-12">
                            <fieldset>
                                <input name="subject" type="text" id="subject" placeholder="Subject">
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <textarea name="message" rows="6" id="message" placeholder="Message" required=""></textarea>
                            </fieldset>
                        </div>
                        <div class="col-lg-12">
                            <fieldset>
                                <button type="submit" id="form-submit" class="main-button">Send Message</button>
                            </fieldset>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
