<?php 
    $action = filter_input(INPUT_POST, 'action');
    
    if ($action == "Submit Quiz") {
        // Retrieve answers from the form
        $q1 = filter_input(INPUT_POST, 'q1');
        $q2 = filter_input(INPUT_POST, 'q2');
        $q3 = filter_input(INPUT_POST, 'q3');
        $q4 = filter_input(INPUT_POST, 'q4');
        
        // Initialize the score
        $score = 0;

        // Check answers and increment the score
        if ($q1 == "Answer 1") $score++;
        if ($q2 == "Answer 2") $score++;
        if ($q3 == "Answer 3") $score++;
        if ($q4 == "Answer 4") $score++;

        // Prepare the message to display
        $message = "You got " . $score . " out of 4 correct!";
        ?>
        
        <!DOCTYPE html>
        <html>
        <head>
            <title>Quiz Results</title>
        </head>
        <body>
            <main>
                <h1>Quiz Results</h1>
                <p><?php echo $message; ?></p>
                <p><a href="quiz.php">Take the quiz again!</a></p>
            </main>
        </body>
        </html>
        
        <?php 
    } else {
        // Display the quiz form
        ?>
        
        <!DOCTYPE html>
        <html>
        <head>
            <title>PHP Quiz</title>
        </head>
        <body>
        <main>
            <h1>Take the Quiz</h1>
            <form action="quiz.php" method="post">
                <fieldset>
                    <legend>Answer the questions below</legend>
                    <p>
                        <label>Question 1:</label><br>
                        <input type="radio" name="q1" value="Answer 1">Answer One<br>
                        <input type="radio" name="q1" value="Answer 2">Answer Two<br>
                        <input type="radio" name="q1" value="Answer 3">Answer Three<br>
                        <input type="radio" name="q1" value="Answer 4">Answer Four<br>
                    </p>
                    <p>
                        <label>Question 2:</label><br>
                        <input type="radio" name="q2" value="Answer 1">Answer One<br>
                        <input type="radio" name="q2" value="Answer 2">Answer Two<br>
                        <input type="radio" name="q2" value="Answer 3">Answer Three<br>
                        <input type="radio" name="q2" value="Answer 4">Answer Four<br>
                    </p>
                    <p>
                        <label>Question 3:</label><br>
                        <input type="radio" name="q3" value="Answer 1">Answer One<br>
                        <input type="radio" name="q3" value="Answer 2">Answer Two<br>
                        <input type="radio" name="q3" value="Answer 3">Answer Three<br>
                        <input type="radio" name="q3" value="Answer 4">Answer Four<br>
                    </p>
                    <p>
                        <label>Question 4:</label><br>
                        <input type="radio" name="q4" value="Answer 1">Answer One<br>
                        <input type="radio" name="q4" value="Answer 2">Answer Two<br>
                        <input type="radio" name="q4" value="Answer 3">Answer Three<br>
                        <input type="radio" name="q4" value="Answer 4">Answer Four<br>
                    </p>
                    
                    <input type="submit" name="action" value="Submit Quiz">
                </fieldset>
            </form>
        </main>
        </body>
        </html>
        
        <?php 
    }
?>