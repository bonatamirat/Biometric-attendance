<?php
include 'config.php';
header('Content-Type: text/html');
try {
    $cursor = $attendanceCollection->aggregate([
        ['$lookup' => [
            'from' => 'employees',
            'localField' => 'employee_id',
            'foreignField' => '_id',
            'as' => 'employee'
        ]],
        ['$unwind' => '$employee'],
        ['$sort' => ['clock_in' => -1]],
        ['$limit' => 5],
        ['$project' => [
            'name' => '$employee.name',
            'clock_in' => ['$dateToString' => ['format' => '%Y-%m-%d %H:%M:%S', 'date' => '$clock_in']],
            'clock_out' => ['$ifNull' => [
                ['$dateToString' => ['format' => '%Y-%m-%d %H:%M:%S', 'date' => '$clock_out']],
                'N/A'
            ]]
        ]]
    ]);
    foreach ($cursor as $row) {
        echo "<tr>
            <td>" . htmlspecialchars($row['name']) . "</td>
            <td>" . htmlspecialchars($row['clock_in']) . "</td>
            <td>" . htmlspecialchars($row['clock_out']) . "</td>
        </tr>";
    }
} catch (Exception $e) {
    echo "<tr><td colspan='3'>Error fetching attendance records</td></tr>";
    error_log("Fetch Attendance: MongoDB error: " . $e->getMessage());
}
?>