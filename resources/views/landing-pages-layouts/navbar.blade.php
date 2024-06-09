<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        @foreach ($configurations as $index => $configuration )
                        <a href="index.html" class="logo">{{ $configuration->name }}<em> Gym</em></a>
                        @endforeach
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="{{ route('home') }}" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features">Program</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Supplement</a></li>
                            <li class="scroll-to-section"><a href="#schedule">Membership</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">Contact</a></li>
                            @if(auth()->check())
                            <li class="scroll-to-section nav-item dropdown">
                                <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profile
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('member-profile') }}">Edit Profile</a>
                                    @if($hasRegistrations)
                                    <a class="dropdown-item" href="{{ URL::to('/registration-member') }}">Your Member Package Registration</a>
                                    @endif
                                    <a class="dropdown-item" href="#">Your Status</a>
                                </div>
                            </li>
                            <li class="main-button"><a href="{{ route('logout') }}">Logout</a></li>
                            @else
                            <li class="main-button"><a href="{{ route('login') }}">Login</a></li>
                            @endif
                        </ul>        
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- ***** Menu End ***** -->
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <script>
        $(document).ready(function () {
            $('.dropdown-toggle').click(function (e) {
                var $el = $(this).next('.dropdown-menu');
                var isVisible = $el.is(':visible');
                $('.dropdown-menu').not($el).hide(); // Hide other dropdowns
                if (isVisible) {
                    $el.hide(); // If clicked again, hide it
                } else {
                    $el.show(); // Show the clicked dropdown
                }
                return false; // Prevent default action and stop propagation
            });
            $(document).click(function (e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').hide(); // Hide dropdown if clicked outside
                }
            });
        });
    </script>