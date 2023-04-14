<?php
// Check if the form is submitted
if (isset($_GET["submit"])) {
  $user_input = $_GET["location"];

  if ($user_input == "") {
    $error = "Please enter a location";
  } else {
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=" . $user_input . "&appid=1518915488b1d4d56c4cf8631174ce1e&units=metric";
    $weather_data = file_get_contents($api_url);
    $weather_data = json_decode($weather_data, true);

    // Check if the API returns any error
    if ($weather_data["cod"] != 200) {
      $error = "Error";
    } else {
      $api_url = "https://api.openweathermap.org/data/2.5/forecast?q=" . $user_input . "&appid=1518915488b1d4d56c4cf8631174ce1e&units=metric";
      $forecast_data = file_get_contents($api_url);
      $forecast_data = json_decode($forecast_data, true);

      $city_name = $weather_data["name"];
      $country_code = $weather_data["sys"]["country"];
      $current_temp = $weather_data["main"]["temp"];
      $current_feels_like = $weather_data["main"]["feels_like"];
      $current_humidity = $weather_data["main"]["humidity"];
      $current_pressure = $weather_data["main"]["pressure"];
      $current_wind_speed = $weather_data["wind"]["speed"];
      $current_wind_deg = $weather_data["wind"]["deg"];
      $current_weather_main = $weather_data["weather"][0]["main"];
      $current_weather_desc = $weather_data["weather"][0]["description"];
      $current_weather_icon = $weather_data["weather"][0]["icon"];

    // Function to convert wind direction from degrees to cardinal direction
    function wind_dir($deg) {
        if ($deg >= 348.75 || $deg < 11.25) {
            return "N";
        } elseif ($deg >= 11.25 && $deg < 33.75) {
            return "NNE";
        } elseif ($deg >= 33.75 && $deg < 56.25) {
            return "NE";
        } elseif ($deg >= 56.25 && $deg < 78.75) {
            return "ENE";
        } elseif ($deg >= 78.75 && $deg < 101.25) {
            return "E";
        } elseif ($deg >= 101.25 && $deg < 123.75) {
            return "ESE";
        } elseif ($deg >= 123.75 && $deg < 146.25) {
            return "SE";
        } elseif ($deg >= 146.25 && $deg < 168.75) {
            return "SSE";
        } elseif ($deg >= 168.75 && $deg < 191.25) {
            return "S";
        } elseif ($deg >= 191.25 && $deg < 213.75) {
            return "SSW";
        } elseif ($deg >= 213.75 && $deg < 236.25) {
            return "SW";
        } elseif ($deg >= 236.25 && $deg < 258.75) {
            return "WSW";
        } elseif ($deg >= 258.75 && $deg < 281.25) {
            return "W";
        } elseif ($deg >= 281.25 && $deg < 303.75) {
            return "WNW";
        } elseif ($deg >= 303.75 && $deg < 326.25) {
            return "NW";
        } else {
            return "NNW";
        }
        }
    
        // Function to format the date and time string from the API
        function format_date_time($dt_txt) {
        $timestamp = strtotime($dt_txt);
        $date = date("l, M d", $timestamp);
        $time = date("h:i A", $timestamp);
        return array($date, $time);
        }
    }
  }

} else {
    //Load page with default location
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=Dhaka&appid=1518915488b1d4d56c4cf8631174ce1e&units=metric";
    $weather_data = file_get_contents($api_url);
    $weather_data = json_decode($weather_data, true);

    $api_url = "https://api.openweathermap.org/data/2.5/forecast?q=Dhaka&appid=1518915488b1d4d56c4cf8631174ce1e&units=metric";
    $forecast_data = file_get_contents($api_url);
    $forecast_data = json_decode($forecast_data, true);

    $city_name = $weather_data["name"];
    $country_code = $weather_data["sys"]["country"];
    $current_temp = $weather_data["main"]["temp"];
    $current_feels_like = $weather_data["main"]["feels_like"];
    $current_humidity = $weather_data["main"]["humidity"];
    $current_pressure = $weather_data["main"]["pressure"];
    $current_wind_speed = $weather_data["wind"]["speed"];
    $current_wind_deg = $weather_data["wind"]["deg"];
    $current_weather_main = $weather_data["weather"][0]["main"];
    $current_weather_desc = $weather_data["weather"][0]["description"];
    $current_weather_icon = $weather_data["weather"][0]["icon"];

    // Function to convert wind direction from degrees to cardinal direction
    function wind_dir($deg) {
    if ($deg >= 348.75 || $deg < 11.25) {
        return "N";
    } elseif ($deg >= 11.25 && $deg < 33.75) {
        return "NNE";
    } elseif ($deg >= 33.75 && $deg < 56.25) {
        return "NE";
    } elseif ($deg >= 56.25 && $deg < 78.75) {
        return "ENE";
    } elseif ($deg >= 78.75 && $deg < 101.25) {
        return "E";
    } elseif ($deg >= 101.25 && $deg < 123.75) {
        return "ESE";
    } elseif ($deg >= 123.75 && $deg < 146.25) {
        return "SE";
    } elseif ($deg >= 146.25 && $deg < 168.75) {
        return "SSE";
    } elseif ($deg >= 168.75 && $deg < 191.25) {
        return "S";
    } elseif ($deg >= 191.25 && $deg < 213.75) {
        return "SSW";
    } elseif ($deg >= 213.75 && $deg < 236.25) {
        return "SW";
    } elseif ($deg >= 236.25 && $deg < 258.75) {
        return "WSW";
    } elseif ($deg >= 258.75 && $deg < 281.25) {
        return "W";
    } elseif ($deg >= 281.25 && $deg < 303.75) {
        return "WNW";
    } elseif ($deg >= 303.75 && $deg < 326.25) {
        return "NW";
    } else {
        return "NNW";
    }
    }

    // Function to format the date and time string from the API
    function format_date_time($dt_txt) {
    $timestamp = strtotime($dt_txt);
    $date = date("l, M d", $timestamp);
    $time = date("h:i A", $timestamp);
    return array($date, $time);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f0f0f0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .card-header {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 26px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .name {
            background-color: #007bff;
            color: white;
            font-weight: bold;
            font-size: 14px;
        }

        .card-body {
            padding: 40px;
        }

        .search-form {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }

        .search-input {
            width: 300px;
            border-radius: 10px;
            border: none;
            outline: none;
            padding: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .search-button {
            margin-left: 10px;
            border-radius: 10px;
            border: none;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .error {
            color: red;
            font-weight: bold;
            text-align: center;
        }

        .current-weather {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .current-weather-left {
            display: flex;
            align-items: center;
        }

        .current-weather-icon {
            width: 100px;
            height: 100px;
        }

        .current-weather-info {
            margin-left: 20px;
        }

        .current-weather-temp {
            font-size: 48px;
            font-weight: bold;
        }

        .current-weather-desc {
            font-size: 18px;
            text-transform: capitalize;
        }

        .current-weather-city {
            font-size: 24px;
        }

        .current-weather-right {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
        }

        .current-weather-main {
            font-size: 24px;
        }

        .current-weather-details {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .current-weather-detail {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .current-weather-detail-icon {
            font-size: 24px;
            margin-right: 10px;
        }

        .forecast {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 20px;
        }

        .forecast-item {
            width: 23%;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            padding: 10px;
            margin-bottom: 20px;
        }

        .forecast-date {
            font-weight: bold;
        }

        .forecast-time {
            color: gray;
        }

        .forecast-icon {
            width: 50px;
            height: 50px;
        }

        .forecast-temp {
            font-size: 24px;
            font-weight: bold;
        }

        .forecast-desc {
            text-transform: capitalize;
        }
    </style>    
</head>

<body>
    <div class="container">
      <div class="card">
          <div class="card-header">
              Weather Forecast
              <div class="name ml-auto">by Aldrin Kabya (2030443)</div>
          </div>
          <div class="card-body">
              <form class="search-form" method="get" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
                  <input type="text" name="location" class="search-input" placeholder="Enter a location">
                  <button type="submit" name="submit" class="search-button">Search</button>
              </form>
              <?php
              if (isset($error)) {
                echo "<div class='error'>$error</div>";
              }
              ?>
              <?php
              if (!isset($error)) {
                ?>
                <h3 class="Today">Today</h3>
                <div class="current-weather">                
                    <div class="current-weather-left">
                        <img src="https://openweathermap.org/img/wn/<?php echo $current_weather_icon; ?>.png" alt="<?php echo $current_weather_desc; ?>" class="current-weather-icon">
                        <div class="current-weather-info">
                            <div class="current-weather-temp"><?php echo round($current_temp, 1); ?>°C</div>
                            <div class="current-weather-desc"><?php echo $current_weather_desc; ?></div>
                            <div class="current-weather-city"><?php echo $city_name; ?>, <?php echo $country_code; ?></div>
                        </div>
                    </div>
                    <div class="current-weather-right">
                        <div class="current-weather-main"><?php echo $current_weather_main; ?></div>
                        <div class="current-weather-details">
                            <div class="current-weather-detail">
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-thermometer-half current-weather-detail-icon"></i>
                                Feels like: <?php echo round($current_feels_like, 1); ?>°C
                            </div>
                            <div class="current-weather-detail">
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-tint current-weather-detail-icon"></i>
                                Humidity: <?php echo $current_humidity; ?>%
                            </div>
                            <div class="current-weather-detail">
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-tachometer-alt current-weather-detail-icon"></i>
                                Pressure: <?php echo $current_pressure; ?> hPa
                            </div>
                            <div class="current-weather-detail">
                            &nbsp;&nbsp;&nbsp;&nbsp;<i class="fas fa-wind current-weather-detail-icon"></i>
                                Wind: <?php echo round($current_wind_speed, 1); ?> m/s, <?php echo wind_dir($current_wind_deg); ?>
                            </div>
                        </div>
                    </div>
                </div>
                <h3 class="forecast mt-5">5-Day Weather Forecast</h3>
                <div class="forecast">                   
                    <?php
                    // Loop through the forecast data and display each item
                    for ($i = 0; $i < 40; $i++) {
                        $forecast_date_time = $forecast_data["list"][$i]["dt_txt"];
                        $forecast_temp = $forecast_data["list"][$i]["main"]["temp"];
                        $forecast_desc = $forecast_data["list"][$i]["weather"][0]["description"];
                        $forecast_icon = $forecast_data["list"][$i]["weather"][0]["icon"];
                        list($forecast_date, $forecast_time) = format_date_time($forecast_date_time);
                        ?>
                        <div class="forecast-item">
                            <div class="forecast-date"><?php echo $forecast_date; ?></div>
                            <div class="forecast-time"><?php echo $forecast_time; ?></div>
                            <img src="https://openweathermap.org/img/wn/<?php echo $forecast_icon; ?>.png" alt="<?php echo $forecast_desc; ?>" class="forecast-icon">
                            <div class="forecast-temp"><?php echo round($forecast_temp, 1); ?>°C</div>
                            <div class="forecast-desc"><?php echo $forecast_desc; ?></div>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <?php
              }
              ?>
          </div>
      </div>
    </div>
</body>
</html>