@if (Auth::guest())
<script>window.location = "login";</script>
@else
<!-- Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>Campus Management System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="Skill Point Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template,
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>

    <!-- Bootstrap Core CSS -->
    <link href="{{ asset('web/css/bootstrap.css') }}" rel='stylesheet' type='text/css' />
    <!-- login icon animation -->
    <link href="{{ asset('web/css/animate.css') }}" rel="stylesheet" type="text/css" media="all">
    <!-- Custom CSS -->
    <link href="{{asset('web/css/style.css')}}" rel='stylesheet' type='text/css' />
    <!-- font-awesome icons -->
    <link href="{{asset('web/css/fontawesome-all.min.css')}}" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!-- online fonts -->
    <link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Gentium+Book+Basic:400,400i,700i" rel="stylesheet">
    <!--//online fonts -->
</head>

<body>
    <div class="se-pre-con"></div>
    <!-- header -->
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="d-flex header-agile">
                            <li>
                                <span class="fas fa-envelope-open"></span>
                                <a href="mailto:example@email.com" class="text-white">info@example.com</a>
                            </li>
                            <li>
                                <span class="fas fa-phone-volume"></span>
                                <p class="d-inline text-white">+456 123 7890</p>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 hearder-right-agile">
                        <div class="d-flex">
                            <!-- Multiple select filter -->
                            <select class="custom-select">
                                <option value="HTML">Programming</option>
                                <option value="jQuery">Art & Design</option>
                                <option value="Pug">Languages</option>
                                <option value="SASS">UX Training</option>
                                <option value="Angular">Business</option>
                                <option value="React">Vocabulary</option>
                                <option value="Jade">Photography</option>
                                <option value="PHP">Inclusive-education</option>
                                <option value="Java">New Technologies</option>
                            </select>
                            <!-- Multiple select filter  -->
                            <div class="login-wthree my-auto">
                                @if (Auth::guest())
                                <a href="{{route('web.login')}}" class="text-white text-capitalize">login<span class="fas fa-sign-in-alt flash animated infinite"></span></a>
                                @else
                                <span class="text-light">{{ Auth::user()->name }}</span>
                                <a href="{{ route('web.logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" data-toggle="modal" data-target="#logoutModal" class="text-white text-capitalize">Logout<span class="fas fa-sign-in-alt flash animated infinite"></span></a>
                                <form id="logout-form" action="{{ route('web.logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="header-bottom">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light p-0">
                    <h1><a class="navbar-brand" href="{{route('web.home')}}">
                            <span>C</span>ampus
                            <i class="w3-spacing" style="margin-right: 0rem;"></i>
                            <span>M</span>anagement
                            <i class="w3-spacing" style="margin-right: 0rem;"></i>
                            <span>S</span>ystem
                            <i class="w3-spacing" style="margin-right: 0rem;"></i>
                        </a></h1>
                    <button class="navbar-toggler ml-lg-auto ml-sm-5" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav text-center ml-auto">
                            <li class="nav-item  mr-lg-3 mt-lg-0 mt-4">
                                <a class="hover-fill" href="{{route('web.home')}}" data-txthover="Home">Home</a>
                            </li>
                            <li class="nav-item mr-lg-3 my-lg-0 my-4">
                                <a class=" hover-fill" data-txthover="Assignment/Exam" href="{{route('stuAssignment.index')}}" id="navbarDropdown" role="button">
                                    Assignment/Exam
                                </a>
                                <!-- <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="hover-fill" href="{{route('stuAssignment.index')}}" data-txthover="View">View</a>
                                    <a class="hover-fill" href="pricingplans.html" data-txthover="Upload">Upload</a>
                                </div> -->
                            </li>
                            <li class="nav-item mr-lg-3 my-lg-0 my-4">
                                <a class=" hover-fill" data-txthover="Notes" href="{{route('stuNotes.index')}}" id="navbarDropdown" role="button">
                                    Notes
                                </a>
                                <!-- <div class=" dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="hover-fill" href="services.html" data-txthover="View">View </a>
                                    <a class="hover-fill" href="pricingplans.html" data-txthover="Upload">Upload</a>
                    </div> -->
                    </li>
                    <li class="nav-item mr-lg-3 my-lg-0 my-4">
                        <a class="hover-fill" href="contact.html" data-txthover="Attendance">Attendance</a>
                    </li>
                    <li class="nav-item">
                        <a class="hover-fill" href="contact.html" data-txthover="Feedback">Feedback</a>
                    </li>
                    </ul>
            </div>
            </nav>
        </div>
        </div>
    </header>
    <!-- //header -->
    <!-- about -->
    @yield('main')
    <!-- //about -->
    <!-- stats -->
    <!-- //stats -->
    <!-- footer top -->
    <!-- //footer top -->
    <!-- footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-12 my-lg-auto mt-3">
                    <div class="cpy-right text-lg-right text-center">
                        <p class="text-secondary">© All rights reserved </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //footer -->
    <!-- js-->
    <script src="{{asset('web/js/jquery-2.2.3.min.js')}}"></script>
    <!-- loading-gif Js -->
    <script src="{{asset('web/js/modernizr.js')}}"></script>
    <script>
        //paste this code under head tag or in a seperate js file.
        // Wait for window load
        $(window).load(function() {
            // Animate loader off screen
            $(".se-pre-con").fadeOut("slow");;
        });
    </script>
    <!--// loading-gif Js -->
    <!-- Multiple select filter using jQuery -->
    <script src="{{asset('web/js/custom-select.js')}}"></script>
    <!-- //Multiple select filter using jQuery -->
    <!-- stats counter -->
    <script src="{{asset('web/js/counter.js')}}"></script>
    <!-- script for password match -->
    <script>
        window.onload = function() {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- script for password match -->
    <!-- start-smooth-scrolling -->
    <script src="{{asset('web/js/move-top.js')}}">
    </script>
    <script src="{{asset('web/js/easing.js')}}"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
    </script>
    <!-- //end-smooth-scrolling -->
    <!-- smooth-scrolling-of-move-up -->
    <script>
        $(document).ready(function() {
            /*
             var defaults = {
            	 containerID: 'toTop', // fading element id
            	 containerHoverID: 'toTopHover', // fading element hover id
            	 scrollSpeed: 1200,
            	 easingType: 'linear'
             };
             */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <script src="{{asset('web/js/SmoothScroll.min.js')}}"></script>
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('web/js/bootstrap.js')}}">
    </script>
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>
@endif
