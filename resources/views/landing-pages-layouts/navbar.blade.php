<header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav class="main-nav">
                        <!-- ***** Logo Start ***** -->
                        <a href="index.html" class="logo">FitSoul<em> Gym</em></a>
                        <!-- ***** Logo End ***** -->
                        <!-- ***** Menu Start ***** -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="#top" class="active">Home</a></li>
                            <li class="scroll-to-section"><a href="#features">Program</a></li>
                            <li class="scroll-to-section"><a href="#our-classes">Supplement</a></li>
                            <li class="scroll-to-section"><a href="#schedule">Membership</a></li>
                            <li class="scroll-to-section"><a href="#contact-us">Contact</a></li>
                            @if(auth()->check())
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