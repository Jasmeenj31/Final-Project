<?php   
		function getPremium($vehicleType) {  
		if($vehicleType == "Compact")
			$Premium = 0;
		elseif($vehicleType == "Sedan")
			$Premium = 50;
		elseif ($vehicleType == "Minivan")
			$Premium = 50;
		elseif($vehicleType == "SUV")
			$Premium = 75;
		elseif($vehicleType == "Truck")
			$Premium = 125;
		elseif($vehicleType == "sport")
			$Premium = 200;
		return $Premium;
		}
		function calculateBaseAmount($age, $yearsInsured) { 
			$ageYears = $age + $yearsInsured ;
		if ($ageYears >= 16 AND $ageYears <= 24)
				$baseRate = 1000;
		elseif($ageYears >= 25 AND $ageYears <= 34)
				$baseRate = 600;
		elseif ($ageYears >= 35)
				$baseRate = 250;
		return $BaseRate;
		}	
		$action = filter_input (INPUT_POST, 'action'); 
		
		if ($action == "Submit Application") { 
			
			
			$fullName = filter_input(INPUT_POST, 'fullName');
			$email = filter_input (INPUT_POST, 'email');
			$age = filter_input (INPUT_POST, 'age', FILTER_VALIDATE_INT);
			$yearsInsured = filter_input(INPUT_POST, 'yearsInsured', FILTER_VALIDATE_INT);
			$vehicleType = filter_input (INPUT_POST, 'vehicleType');
			$result = "";
			
			
			if( empty($fullName) OR empty($email) OR empty($age) OR empty($yearsInsured) OR empty($vehicleType) )
				$result = "<p>All fields are required to fill</p>";
			
			if( $age == FALSE OR $yearsInsured == FALSE )
				$result .= "<p>Age and Years Insured must be valid integers</p>";
			
			if ($age <=16)
				$result .= "<p>Your age should be minimum of 16 years</p>";
			
			if ($result == ""){
			
			$BaseRate = calculateBaseAmount($age, $yearsInsured);
			
			$Premium =  getPremium($vehicleType);				  
			
			$MonthlyRate = $BaseRate + $Premium ;
			
			$message = "<label>Name:</label>
					<span> $fullName</span><br>

					<label>Email:</label>
					<span>$email</span><br>

					<label>Age:</label>
					<span>$age</span><br>
					
					<label>Years Insured:</label>
					<span>$yearsInsured</span><br>
					
					<label>Vehicle Type:</label>
					<span>$vehicleType</span><br>

					<label>Monthly Rate:</label>
					<span> $MonthlyRate</span><br>" ;
		}
			
			?>
			<!DOCTYPE html>
			<html>
			<head>
				<title>Insurance Quote</title>
				<link rel="stylesheet" href="main.css">

			</head>
			<body>
			<p><a href="insurance_application.php">Back to Application Form</a></p>
				<main>
					<h1>Insurance Quote:</h1>
				
				<div><?php echo $result ?></div>
				
				<p><a href="insurance_application.php">Back to Application Form</a></p>
				</main>
			</body>
			</html>
<?php }
		else {
?>



<!DOCTYPE html>
		<html>
		<head>
			<title>Insurance Application Form </title>
			<link rel="stylesheet" href="main.css">
			
		</head>
		<body>
			<main>
			<h1>Insurance Application Form</h1>		
			<form action="insurance_application" method="post">
				<div id="data">
					<label>Full Name:</label>
					<input type="text" name="fullName">
					<br>

					<label>Email:</label>
					<input type="text" name="email">
					<br>

					<label>Age (minimum 16):</label>
					<input type="text" name="age">
					<br>
					<label>Number of Years Insured:</label>
					<input type="text" name="yearsInsured">
					<br>
					<label>Vehicle Type:</label>
					<select name="vehicleType">
						<option value = ""></option>
						<option value = "Compact">Compact</option>
						<option value = "Sedan">Sedan</option>
						<option value = "Sport">Sport</option>
						<option value = "SUV">SUV</option>
						<option value = "Minivan">Minivan</option>
						<option value = "Truck">Truck</option>  
					</select>
					<br>
				</div>
				<div id="buttons">
					<label>&nbsp;</label>
					<input type="submit" name = "action" value="Submit Application"><br>
				</div>
			</form>
			</main>
		</body>
		</html>
<?php  }
?>