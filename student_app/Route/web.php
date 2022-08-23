<?php
    require('../Controller/StudentScores.php');
    // basename(parse_url($_SERVER['HTTP_REFERER'],PHP_URL_PATH)
    $studentMethods = new StudenScores();

    if (isset($_POST['submitScores'])) {
        try {
            $studentMethods->postScores($_POST['scoreArray']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    if (isset($_GET['report']) && $_GET['report'] === 'generate') {
        try {
            $result = $studentMethods->generateReport();
            // return header("Location:../View/index.php?generated_results=$result");

            var_dump($result);
        } catch (\Throwable $th) {
            throw $th;
        }
        // echo "I am ready to generate this student's report";
    }
?>