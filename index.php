<?php
$URL = "https://data.gov.bh/api/explore/v2.1/catalog/datasets/01-statistics-of-students-nationalities_updated/records?limit=100";

$response = file_get_contents($URL);

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
    <title>Student Enrollment Data</title>
    <link rel="stylesheet" href="https://picocss.com/pico.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }
        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        h2 {
            color: #555;
            text-align: center;
        }
        p {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>University of Bahrain Students Enrollment Data</h1>
        <h2>Summary of Enrollment Figures</h2>
        <p>This table summarizes the enrollment figures by nationality for various colleges at the University of Bahrain. Data shown only include entries with student enrollments greater than zero.</p>
        <table>
            <thead>
                <tr>
                    <th>Year</th>
                    <th>Semester</th>
                    <th>Nationality</th>
                    <th>College</th>
                    <th>Number of Students</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($result['results']) && is_array($result['results'])) {
                    foreach ($result['results'] as $record) {
                        // Filter out records with zero students
                        if ($record['number_of_students'] > 0) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($record['year']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['semester']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['nationality']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['colleges']) . "</td>";
                            echo "<td>" . htmlspecialchars($record['number_of_students']) . "</td>";
                            echo "</tr>";
                        }
                    }
                } else {
                    echo "<tr><td colspan='5'>No data available.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>