<header class="main">
    <div class="container">
        <div id="header" class="clearfix">
            <div class="col-md-3 col-sm-4 col-xs-12">
                <div id="weather" class="row">
                    <div class="weather-row">
                        <div class="weather-icon">
                            <span id="weather-icon" class=""></span>
                        </div>
                        <div class="weather-information">
                            <div class="weather-city-date">
                                <span class="city">София</span>
                                <span class="temperature"></span>
                                <span class="weather-chevron glyphicon glyphicon-chevron-down"></span>
                            </div>
                            <span class="description"></span>
                        </div>
                    </div>
                    <div class="weather-city-select">
                        <div class="arrow"></div>
                        <div class="box">
                            <a class="weather-choose-city" href="#" data-city="Sofia">София</a>
                            <a class="weather-choose-city" href="#" data-city="Varna">Варна</a>
                            <a class="weather-choose-city" href="#" data-city="Plovdiv">Пловдив</a>
                            <a class="weather-choose-city" href="#" data-city="Burgas">Бургас</a>
                            <a class="weather-choose-city" href="#" data-city="Sliven">Сливен</a>
                            <a class="weather-choose-city" href="#" data-city="Dupnitsa">Дупница</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-4 col-md-offset-1 col-xs-12">
                <a id="logo" href="/" title="Гласове">
                    <img src="{{ asset('/images/logo.png') }}" alt="Гласове лого"/>
                </a>
            </div>
            <div class="col-md-3 col-sm-4 col-xs-12 pull-right">
                <form action="/search" method="get" class="search row pull-right">
                    <input type="text" name="search" placeholder="Търси..." value="{{ Input::get('search') }}"/>
                    <button type="submit" title="Търси"><span class="glyphicon glyphicon-search"></span></button>
                </form>
            </div>
        </div>
    </div>

    @include('partials.navigation')
</header>
