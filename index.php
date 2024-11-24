<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";
// Fetch the response
$response = file_get_contents($URL);

// Debugging output
echo "<pre>";
echo htmlspecialchars($response); // Output the raw JSON response
echo "</pre>";
exit; // Stop further execution to inspect the output

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
    <link rel="stylesheet" href="https://picocss.com/pico.min.css">
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
                if (isset($result['records']) && is_array($result['records'])) {
                    foreach ($result['records'] as $record) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($record['fields']['nationality'] ?? 'N/A') . "</td>";
                        echo "<td>" . htmlspecialchars($record['fields']['number_of_students'] ?? 'N/A') . "</td>";
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