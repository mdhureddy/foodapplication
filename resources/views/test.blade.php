<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Geocoding Example</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>

    <div class="container">
        <label for="addressInput">Enter Address:</label>
        <textarea type="text" id="addressInput" placeholder="Eg:Area..."></textarea>
        <button onclick="geocodeAddress()">Geocode</button>

       
        <p>Latitude: <span id="latitude"></span></p>
        <p>Longitude: <span id="longitude"></span></p>
    </div>

    <script>
        function geocodeAddress() {
            var address = document.getElementById('addressInput').value;

           
            var queryParams = [];
            if (address) {
                queryParams.push(encodeURIComponent(address));
            }

            
            var geocodeUrl = `https://geocode.maps.co/search?q=${queryParams.join(',')}&api_key=6593e5577c7d8202740709tyeba73eb`;

            fetch(geocodeUrl)
                .then(response => response.json())
                .then(data => {
                    console.log('Geocoding Response:', data);

                    if (data && data[0] && data[0].lat && data[0].lon) {
                        console.log('Latitude:', data[0].lat);
                        console.log('Longitude:', data[0].lon);

                        document.getElementById('latitude').innerHTML = data[0].lat;
                        document.getElementById('longitude').innerHTML = data[0].lon;
                    } else {
                        console.error('Invalid response structure or missing data.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        }
    </script>

</body>
</html>
