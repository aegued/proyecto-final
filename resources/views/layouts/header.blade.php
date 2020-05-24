<!-- Page Header -->
<header class="masthead" style="background-image: url('@yield('image', asset('img/home-bg.jpg'))')">
    <div class="overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-10 mx-auto">
                <div class="@yield('class','site-heading')">
                    <h1>@yield('title', 'Bienvenido a nuesto Blog')</h1>
                    <span class="subheading">@yield('subtitle', 'Todas las noticias en un solo sitio.')</span>
                    @yield('meta')
                </div>
            </div>
        </div>
    </div>
</header>
