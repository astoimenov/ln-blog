$(document).ready(function () {

    $('.weather-chevron').click(function () {
        $('.weather-city-select').toggle();
    });

    var weatherCity = localStorage.getItem('weather-city');
    if (weatherCity !== null) {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: 'http://api.openweathermap.org/data/2.5/weather?q=' + weatherCity + ',bg&lang=bg&units=metric',
            success: setWeatherData,
            cache: true
        });

        $('.city').text(getCyrillicCityName(weatherCity));
    } else {
        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: 'http://api.openweathermap.org/data/2.5/weather?q=Sofia,bg&lang=bg&units=metric',
            success: setWeatherData,
            cache: true
        });
    }

    function getCyrillicCityName(city) {
        switch (city) {
            case 'Dupnitsa':
                return 'Дупница';
            case 'Sliven':
                return 'Сливен';
            case 'Burgas':
                return 'Бургас';
            case 'Plovdiv':
                return 'Пловдив';
            case 'Varna':
                return 'Варна';
            case 'Sofia':
            default:
                return 'София';
        }
    }

    $('.weather-choose-city').click(function (e) {
        e.preventDefault();

        var city = $(e.target).data('city');

        $.ajax({
            method: 'GET',
            dataType: 'json',
            url: 'http://api.openweathermap.org/data/2.5/weather?q=' + city + ',bg&lang=bg&units=metric',
            success: setWeatherData,
            cache: true
        });
        $('.city').text(getCyrillicCityName(city));
        $('.weather-city-select').toggle();
        localStorage.setItem('weather-city', city);
    });

    function setWeatherData(data) {
        var description = data.weather[0].description;
        var icon = data.weather[0].icon;
        var temp = Math.round(data.main.temp);
        var iconClass = '';

        switch (icon) {
            case '01d':
                iconClass = 'wi-day-sunny';
                break;
            case '01n':
                iconClass = 'wi-night-clear';
                break;
            case '02d':
                iconClass = 'wi-day-sunny-overcast';
                break;
            case '02n':
            case '03n':
            case '04n':
                iconClass = 'wi-night-cloudy';
                break;
            case '03d':
            case '04d':
                iconClass = 'wi-day-cloudy';
                break;
            case '09d':
                iconClass = 'wi-day-showers';
                break;
            case '09n':
                iconClass = 'wi-night-alt-showers';
                break;
            case '10d':
                iconClass = 'wi-day-rain';
                break;
            case '10n':
                iconClass = 'wi-night-alt-rain';
                break;
            case '11d':
                iconClass = 'wi-day-thunderstorm';
                break;
            case '11n':
                iconClass = 'wi-night-alt-lightning';
                break;
            case '13d':
                iconClass = 'wi-day-snow';
                break;
            case '13n':
                iconClass = 'wi-night-alt-snow';
                break;
            case '50d':
                iconClass = 'wi-day-fog';
                break;
            case '50n':
                iconClass = 'wi-night-alt-cloudy-windy';
                break;
            default:
                iconClass = 'wi-day-sunny';
                break;
        }

        $('#weather-icon').removeClass().addClass('wi ' + iconClass);
        $('.temperature').html(temp + '&deg;C');
        $('.description').text(description);
    }

});
