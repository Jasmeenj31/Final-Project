<?php
// Function to calculate the base insurance amount based on age
function calculateBaseAmount($age, $yearsInsured) {
    if ($age >= 16 && $age <= 24) {
        return 1000;
    } elseif ($age >= 25 && $age <= 34) {
        return 600;
    } elseif ($age >= 35) {
        return 250;
    } else {
        return 0;
    }
}

// Function to get the vehicle premium based on vehicle type
function getPremium($vehicleType) {
    switch (strtolower($vehicleType)) {
        case 'compact':
            return 0;
        case 'sedan':
            return 50;
        case 'minivan':
            return 50;
        case 'suv':
            return 75;
        case 'truck':
            return 125;
        case 'sport':
            return 200;
        default:
            return 0;
    }
}

$error = "";
$result = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and trim form data
    $fullName     = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    $emailInput   = isset($_POST['email']) ? trim($_POST['email']) : '';
    $age          = isset($_POST['age']) ? trim($_POST['age']) : '';
    $yearsInsured = isset($_POST['yearsInsured']) ? trim($_POST['yearsInsured']) : '';
    $vehicleType  = isset($_POST['vehicleType']) ? trim($_POST['vehicleType']) : '';

    // Validate Full Name and Email
    if (empty($fullName)) {
        $error .= "Please enter your full name.<br>";
    }
    if (empty($emailInput)) {
        $error .= "Please enter your email address.<br>";
    } elseif (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
        $error .= "Please enter a valid email address.<br>";
    }
    // Validate that Age and Years Insured are numeric
    if (!is_numeric($age) || !is_numeric($yearsInsured)) {
        $error .= "Please enter valid numeric values for Age and Years Insured.<br>";
    } else {
        $age = (int)$age;
        $yearsInsured = (int)$yearsInsured;
        if ($age < 16) {
            $error .= "Minimum age for insurance is 16.<br>";
        }
    }

    // If no errors, calculate the insurance quote
    if (empty($error)) {
        $baseRate  = calculateBaseAmount($age, $yearsInsured);
        $premium   = getPremium($vehicleType);
        $totalRate = $baseRate + $premium;
        
        // Prepare the result message
        $result  = "<h2>Insurance Quote for $fullName</h2>";
        $result .= "<p><strong>Email:</strong> $emailInput</p>";
        $result .= "<p><strong>Base Rate:</strong> $$baseRate</p>";
        $result .= "<p><strong>Vehicle Premium:</strong> $$premium</p>";
        $result .= "<p><strong>Total Monthly Rate:</strong> $$totalRate</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Auto Insurance Quote Application</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f0f0f0;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 600px;
      margin: 2em auto;
      padding: 1em 2em;
      background: #fff;
      border: 2px solid blue;
      border-radius: 5px;
      box-shadow: 2px 2px 6px rgba(0, 0, 0, 0.1);
    }
    h1, h2 {
      text-align: center;
    }
    form {
      margin-top: 1em;
    }
    label {
      display: block;
      margin-top: 1em;
    }
    input[type="text"],
    input[type="number"],
    input[type="email"],
    select {
      padding: 0.5em;
      width: 100%;
      max-width: 300px;
      margin-top: 0.3em;
    }
    input[type="submit"] {
      margin-top: 1em;
      padding: 0.7em 1.5em;
      font-size: 1em;
      background: #0066cc;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
      display: block;
      margin-left: auto;
      margin-right: auto;
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 1em;
    }
    .result {
      background: #e7f0ff;
      border: 2px solid blue;
      padding: 1em;
      margin-top: 1em;
      text-align: center;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Insurance Application Form</h1>
    
    <?php
      if (!empty($error)) {
          echo "<p class='error'>$error</p>";
      } elseif (!empty($result)) {
          echo "<div class='result'>$result</div>";
      }
    ?>
    
    <form method="post" action="">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>
        
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
        
        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>
        
        <label for="yearsInsured">Years Insured:</label>
        <input type="number" id="yearsInsured" name="yearsInsured" required>
        
        <label for="vehicleType">Vehicle Type:</label>
        <select id="vehicleType" name="vehicleType" required>
            <option value="compact">Compact</option>
            <option value="sedan">Sedan</option>
            <option value="minivan">Minivan</option>
            <option value="suv">SUV</option>
            <option value="truck">Truck</option>
            <option value="sport">Sport</option>
        </select>
        
        <input type="submit" value="Submit Application">
    </form>
  </div>
</body>
</html>
