<?php
// Set the API URL
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?where=colleges%20like%20%22IT%22%20AND%20the_programs%20like%20%22bachelor%22&limit=100";

// Fetch the response
$response = file_get_contents($URL);

// Check if the response was successful
if ($response === FALSE) {
    die('Error occurred while fetching data');
}

// Decode the JSON response to an associative array
$result = json_decode($response, true);

// Check if the decoding was successful
if (json_last_error() !== JSON_ERROR_NONE) {
    die('Error decoding JSON: ' . json_last_error_msg());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Nationality Data</title>
    <link rel="stylesheet" href="https://picocss.com/pico.min.css"> <!-- Pico CSS for styling -->
</head>
<body>
    <div class="container">
        <h1>University of Bahrain Students Enrollment by Nationality</h1>
        <table>
            <thead>
                <tr>
                    <th>Nationality</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through the result and display each entry in the table
                if (isset($result['records']) && is_array($result['records'])) {
                    foreach ($result['records'] as $record) {
                        // Update field names according to the API response structure
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($record['fields']['nationality']) . "</td>";
                        echo "<td>" . htmlspecialchars($record['fields']['number_of_students']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='2'>No data available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>