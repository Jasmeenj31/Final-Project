<?php
// Function to calculate the base insurance amount based on age
function calculateBaseAmount($age, $yearsInsured) {
    // Table:
    // Age 16–24: $1000, 25–34: $600, 35+: $250
    if ($age >= 16 && $age <= 24) {
        return 1000;
    } elseif ($age >= 25 && $age <= 34) {
        return 600;
    } elseif ($age >= 35) {
        return 250;
    } else {
        return 0; // For ages below 16 or invalid input
    }
}

// Function to return the vehicle premium based on vehicle type
function getPremium($vehicleType) {
    // Vehicle premium table:
    // Compact: $0, Sedan: $50, Minivan: $50, SUV: $75, Truck: $125, Sport: $200
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
    // Retrieve and trim posted values
    $fullName = isset($_POST['fullName']) ? trim($_POST['fullName']) : '';
    $emailInput = isset($_POST['email']) ? trim($_POST['email']) : '';
    $age = isset($_POST['age']) ? trim($_POST['age']) : '';
    $yearsInsured = isset($_POST['yearsInsured']) ? trim($_POST['yearsInsured']) : '';
    $vehicleType = isset($_POST['vehicleType']) ? trim($_POST['vehicleType']) : '';

    // Validate that full name and email are provided and valid
    if (empty($fullName)) {
        $error .= "Please enter your full name.<br>";
    }
    if (empty($emailInput)) {
        $error .= "Please enter your email address.<br>";
    } elseif (!filter_var($emailInput, FILTER_VALIDATE_EMAIL)) {
        $error .= "Please enter a valid email address.<br>";
    }
    // Validate that age and years insured are numeric
    if (!is_numeric($age) || !is_numeric($yearsInsured)) {
        $error .= "Please enter valid numeric values for Age and Years Insured.<br>";
    } else {
        $age = (int)$age;
        $yearsInsured = (int)$yearsInsured;
        // Check if age meets the minimum requirement
        if ($age < 16) {
            $error .= "Minimum age for insurance is 16.<br>";
        }
    }
    
    // If no errors, calculate insurance quote
    if (empty($error)) {
        $baseRate = calculateBaseAmount($age, $yearsInsured);
        $premium = getPremium($vehicleType);
        $totalRate = $baseRate + $premium;
        
        // Prepare the result message including full name and email
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
      max-width: 600px;
      margin: 2em auto;
      padding: 1em;
      background: #f8f8f8;
    }
    h1, h2 {
      text-align: center;
    }
    form {
      background: #fff;
      padding: 1em 2em;
      border: 1px solid #ccc;
      border-radius: 5px;
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
    }
    .error {
      color: red;
      text-align: center;
      margin-bottom: 1em;
    }
    .result {
      background: #e7ffe7;
      border: 1px solid #0a0;
      padding: 1em;
      margin-top: 1em;
      text-align: center;
    }
  </style>
</head>
<body>
  <h1>Auto Insurance Quote</h1>
  
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
      
      <input type="submit" value="Get Quote">
  </form>
</body>
</html>
