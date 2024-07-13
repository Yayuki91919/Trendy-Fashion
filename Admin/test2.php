<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>City and Township</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="form-group">
            <label for="user_city">City</label>
            <select class="form-control" id="user_city" name="city" onchange="fetchTownships()">
                <option value="">Select City</option>
                <!-- Populate dynamically with server-side data -->
                <option value="city1">City 1</option>
                <option value="city2">City 2</option>
                <!-- Add more cities as needed -->
            </select>
        </div>
        <div class="form-group">
            <label for="user_town">Township</label>
            <select class="form-control" id="user_town" name="township">
                <option value="">Select Township</option>
                <!-- Populate dynamically based on selected city -->
            </select>
        </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function fetchTownships() {
            var city = $('#user_city').val();
            if (city) {
                $.ajax({
                    url: 'get_townships.php', // Replace with your server-side script URL
                    type: 'POST',
                    data: { city: city },
                    success: function(response) {
                        var townships = JSON.parse(response);
                        $('#user_town').empty();
                        $('#user_town').append('<option value="">Select Township</option>');
                        townships.forEach(function(township) {
                            $('#user_town').append('<option value="' + township.id + '">' + township.name + '</option>');
                        });
                    }
                });
            } else {
                $('#user_town').empty();
                $('#user_town').append('<option value="">Select Township</option>');
            }
        }
    </script>
</body>
</html>
