<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communities We Manage</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        @media (max-width: 767px) {
            .carousel-item .row {
                flex-wrap: nowrap;
            }
            .carousel-item .col-md-4 {
                flex: 0 0 100%;
                max-width: 80%;
            }
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">COMMUNITIES WE MANAGE</h1>
        <div class="row" id="communities">
            <?php
            $api_url = "https://devsow.wpengine.com/wp-json/communities/all/";
            $headers = array(
                'Authorization:Basic bmVoYTowI21JdkJCdzRBdWJoKTU5QXhEQ0hIQTU=',
                'Content-Type: application/json'
            );
            $ch = curl_init($api_url);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            $response = curl_exec($ch);
            if (curl_errno($ch)) {
                echo 'Error: ' . curl_error($ch);
            }
            curl_close($ch);
            $result = json_decode($response, true);
            $data = $result['data'];
            if ($data && is_array($data)) {
                foreach ($data as $item) {
                    echo "<div class='col-md-4 mb-4'>";
                    echo "<div class='card mb-4 shadow-sm' style='margin-: 20px;' style='margin-right: 20px;'>";
                    echo "<img src='" . htmlspecialchars($item['image_url']) . "' class='card-img-top' alt='" . htmlspecialchars($item['post_title']) . "'>";
                    echo "<div class='card-body'>";
                    echo "<p class='card-text'>" . htmlspecialchars($item['post_excerpt']) . "</p>";
                    echo "</div>";
                    echo "<div class='card-footer text-center'>" . htmlspecialchars($item['post_title']) . "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No data found</p>";
            }
            ?>
        </div>
        <h1 class="text-center mt-5">OUR SERVICES</h1>
        <div id="communityCarousel" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner" id="services">
                <?php
                if ($data && is_array($data)) {
                    $chunks = array_chunk($data, 3);
                    foreach ($chunks as $index => $chunk) {
                        echo "<div class='carousel-item " . ($index == 0 ? 'active' : '') . "'>";
                        echo "<div class='row'>";
                        foreach ($chunk as $item) {
                            echo "<div class='col-md-4 mb-2'>";
                            echo "<div class='card mb-4 shadow-sm'>";
                            echo "<img src='" . htmlspecialchars($item['image_url']) . "' class='card-img-top' alt='" . htmlspecialchars($item['post_title']) . "'>";
                            echo "<div class='card-footer text-center'>" . htmlspecialchars($item['post_title']) . "</div>";
                            echo "</div>";
                            echo "</div>";
                        }
                        echo "</div>";
                        echo "</div>";
                    }
                } else {
                    echo "<p>No data found</p>";
                }
                ?>
            </div>
            <a class="carousel-control-prev" href="#communityCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#communityCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
