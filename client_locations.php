<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Set Location</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBbmzguZyAbhI_u077S1PWJ6iR7K9092Oo&libraries=places"></script>
    <style>
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h2>Select Your Location</h2>
    <form action="finalize.php" method="POST">
        <!-- Dropdown for Saved Locations -->
        <label for="saved-locations">Choose from Saved Locations:</label>
        <select id="saved-locations">
            <option value="">--Select a Saved Location--</option>
            <?php
            session_start();
            include 'connection.php';

            $client_id = $_SESSION['client_id'];
            $stmt = $conn->prepare("SELECT * FROM clients WHERE client_id = ?");
            $stmt->bind_param("i", $client_id);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                echo '<option value="' . htmlspecialchars(json_encode($row)) . '">'
                    . htmlspecialchars($row['street_name'] . ', ' . $row['barangay'] . ', ' . $row['city'] . ', ' . $row['region'])
                    . '</option>';
            }
            ?>
        </select>
        <button type="button" id="load-saved-location">Load Location</button>

        <!-- Address Fields -->
        <div id="new-address">
            <label>Region:</label>
            <input type="text" id="region" name="region"><br>

            <label>Province:</label>
            <input type="text" id="province" name="province"><br>

            <label>City:</label>
            <input type="text" id="city" name="city"><br>

            <label>Barangay:</label>
            <input type="text" id="barangay" name="barangay"><br>

            <label>Street Name:</label>
            <input type="text" id="street_name" name="street_name"><br>
        </div>

        <button type="button" id="preview-location">Preview on Map</button>

        <!-- Map and Coordinates -->
        <div id="map"></div>
        <input type="hidden" id="latitude" name="latitude">
        <input type="hidden" id="longitude" name="longitude">

        <button type="submit">Save Location</button>
    </form>

    <script>
        let map, marker, geocoder;

        function initMap() {
            const defaultLocation = { lat: 14.5995, lng: 120.9842 }; // Manila, Philippines
            map = new google.maps.Map(document.getElementById("map"), {
                center: defaultLocation,
                zoom: 12,
            });

            geocoder = new google.maps.Geocoder();

            marker = new google.maps.Marker({
                position: defaultLocation,
                map: map,
                draggable: true,
            });

            google.maps.event.addListener(marker, "dragend", () => {
                updateAddress(marker.getPosition());
            });

            google.maps.event.addListener(map, "click", (event) => {
                marker.setPosition(event.latLng);
                updateAddress(event.latLng);
            });

            document.getElementById("preview-location").addEventListener("click", () => {
                const address = constructAddress();
                if (address) {
                    geocoder.geocode({ address }, (results, status) => {
                        if (status === "OK") {
                            const location = results[0].geometry.location;
                            map.setCenter(location);
                            marker.setPosition(location);
                            updateCoordinates(location);
                        } else {
                            alert("Geocode was not successful for the following reason: " + status);
                        }
                    });
                } else {
                    alert("Please fill out the address fields before previewing the location.");
                }
            });

            document.getElementById("load-saved-location").addEventListener("click", () => {
                const savedLocation = document.getElementById("saved-locations").value;
                if (savedLocation) {
                    const locationData = JSON.parse(savedLocation);

                    document.getElementById("region").value = locationData.region;
                    document.getElementById("province").value = locationData.province || "";
                    document.getElementById("city").value = locationData.city;
                    document.getElementById("barangay").value = locationData.barangay;
                    document.getElementById("street_name").value = locationData.street_name;
                    document.getElementById("latitude").value = locationData.latitude;
                    document.getElementById("longitude").value = locationData.longitude;

                    const location = { lat: parseFloat(locationData.latitude), lng: parseFloat(locationData.longitude) };
                    map.setCenter(location);
                    marker.setPosition(location);
                } else {
                    alert("Please select a saved location.");
                }
            });
        }

        function constructAddress() {
            const streetName = document.getElementById("street_name").value.trim();
            const barangay = document.getElementById("barangay").value.trim();
            const city = document.getElementById("city").value.trim();
            const province = document.getElementById("province").value.trim();
            const region = document.getElementById("region").value.trim();
            return `${streetName}, ${barangay}, ${city}, ${province}, ${region}`;
        }

        function updateAddress(location) {
            updateCoordinates(location);

            geocoder.geocode({ location }, (results, status) => {
                if (status === "OK" && results[0]) {
                    const addressComponents = results[0].address_components;

                    const getAddressPart = (type) =>
                        addressComponents.find((comp) => comp.types.includes(type))?.long_name || "";

                    document.getElementById("region").value = getAddressPart("administrative_area_level_1");
                    document.getElementById("province").value = getAddressPart("administrative_area_level_2");
                    document.getElementById("city").value = getAddressPart("locality");
                    document.getElementById("barangay").value = getAddressPart("sublocality_level_1");
                    document.getElementById("street_name").value = getAddressPart("route");
                } else {
                    alert("Unable to fetch address for the location. Please try again.");
                }
            });
        }

        function updateCoordinates(location) {
            document.getElementById("latitude").value = location.lat();
            document.getElementById("longitude").value = location.lng();
        }

        window.onload = initMap;
    </script>
</body>
</html>
