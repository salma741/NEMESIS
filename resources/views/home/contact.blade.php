<section class="section" id="contact-us">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div id="map">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d4057925.3230426307!2d105.8911898!3d-6.6694985!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e70894a399ad0a3%3A0x190a377f8b120a82!2sFitsoul%20Gym%20Fitness%20Center!5e0!3m2!1sid!2sid!4v1716818599151!5m2!1sid!2sid" width="100%" height="600px" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="contact-form">
                    <form id="contact" action="{{ route('contact.send') }}" method="post">
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
