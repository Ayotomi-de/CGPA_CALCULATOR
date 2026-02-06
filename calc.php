<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $grades = $_POST['grade'];
    $credits = $_POST['credit'];

    $grade_points = [
        'A' => 5,
        'B' => 4,
        'C' => 3,
        'D' => 2,
        'E' => 1,
        'F' => 0
    ];

    // $grade_points = $_POST['scale'];

    $total_points = 0;
    $total_credits = 0;

    foreach ($grades as $index => $grade) {
        $credit = $credits[$index];
        $grade_value = $grade_points[$grade];
        
        $total_points += $grade_value * $credit;
        $total_credits += $credit;
    }

    $cgpa = ($total_credits > 0) ? number_format($total_points / $total_credits, 2) : 'Invalid input!';
} else {
    header("Location: index.html"); // Redirect back if accessed directly
    exit();
}

$feedback = "";

if ($cgpa >= 4.5) {
    $feedback = "🌟 Excellent! You're on fire!";
} elseif ($cgpa >= 3.5) {
    $feedback = "👍 Great job! Keep pushing!";
} elseif ($cgpa >= 2.5) {
    $feedback = "🙂 Good effort! There's room for improvement.";
} elseif ($cgpa >= 1.5) {
    $feedback = "😕 You can do better! Don’t give up!";
} else {
    $feedback = "🚨 Consider seeking extra help. You've got this!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CGPA Result</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>🎓 CGPA Result</h1>
        <div class="result">
            <h2>Your CGPA is: <span><?php echo $cgpa; ?></span></h2>
            <p><?php echo $feedback; ?></p>
        </div>
        <a href="index.html" class="back-button">🔙 Calculate Again</a>
    </div>
</body>
</html>
