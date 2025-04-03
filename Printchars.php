 <?php
        function calculateBaseAmount($age, $yearsInsured) {
            if ($age >= 16 && $age <= 24) {
                return 1000;
            } elseif ($age >= 25 && $age <= 34) {
                return 600;
            } else {
                return 250;
            }
        }

        function getPremium($vehicleType) {
            switch ($vehicleType) {
                case 'Compact':
                    return 0;
                case 'Sedan':
                case 'Minivan':
                    return 50;
                case 'SUV':
                    return 75;
                case 'Truck':
                    return 125;
                case 'Sport':
                    return 200;
                default:
                    return 0;
            }
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $age = $_POST['age'];
            $yearsInsured = $_POST['yearsInsured'];
            $vehicleType = $_POST['vehicleType'];

            $baseAmount = calculateBaseAmount($age, $yearsInsured);
            $premium = getPremium($vehicleType);

            $totalAmount = $baseAmount + $premium;

            echo "<h2>Total Monthly Rate: $" . $totalAmount . "</h2>";
        }
    ?>
</body>
</html>