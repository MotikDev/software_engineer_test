<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Scores</title>
    <meta http-equiv="Cache-control" content="no-cache">
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>

<body style="margin-left: 100px; margin-top: 50px">
    <h1>Enter student's name and scores below</h1>
    <?php
    if ($_GET['status'] == 'success') {
        echo "<span style='background-color:green; padding: 5px 15px; color:#F8F0E3'>You have successfully submitted your scores.</span><br/><br/>";
    } elseif ($_GET['status'] == 'failed') {
        echo "<span style='background-color:red; padding: 5px 15px; color:#F8F0E3'>Your scores was not successfully submitted.</span><br/><br/>";
    } elseif ($_GET['status'] == 'con_error') {
        echo "<span style='background-color:red; padding: 5px 15px; color:#F8F0E3'>There was a problem connection with the database.</span><br/><br/>";
    } elseif ($_GET['status'] == 'not_number') {
        echo "<span style='background-color:red; padding: 5px 15px; color:#F8F0E3'>You have entered an invalid number.</span><br/><br/>";
    }
    ?>
    <form action="<?= htmlspecialchars('../Route/web.php') ?>" method="POST">
        <label for="">Student Name:</label>
        <input type="text" id="name" name="scoreArray[name]" value="" required>
        <br><br>

        <label for="">English:</label>
        <input type="text" id="english" name="scoreArray[english]" value="" required>
        <br><br>
        <label for="">Mathematics:</label>
        <input type="text" id="maths" name="scoreArray[maths]" value="" required>
        <br><br>
        <label for="">History:</label>
        <input type="text" id="history" name="scoreArray[history]" value="" required>
        <br><br>
        <label for="">GST:</label>
        <input type="text" id="gst" name="scoreArray[gst]" value="" required>
        <br><br>
        <label for="">French:</label>
        <input type="text" id="french" name="scoreArray[french]" value="" required>
        <br><br>
        <input type="submit" value="Submit scores" name="submitScores" style="background-color:darkcyan; color:antiquewhite; padding: 10px 20px; border:0 solid transparent; border-radius:5px">
        <br><br>
    </form>
    <br><br><br>
    <p>
        <a href="../Route/web.php?report=generate" style="text-decoration:none; background-color:coral; color:antiquewhite; padding: 10px 20px; border-radius:5px">Generate Report</a>
    </p>
    <br>

    <?php
    if (isset($_GET['generated_results']) && !is_null($_GET['generated_results'])) {
    ?>
            <table>
                <thead>
                    <th>Student Name</th>
                    <th>English</th>
                    <th>Mathematics</th>
                    <th>History</th>
                    <th>GST</th>
                    <th>French</th>
                </thead>
                <tbody>
                    <?php
                    foreach (json_decode($_GET['generated_results']) as $key => $value) {
                    ?>
                        <tr>
                            <td><?= $value->student_name ?></td>
                            <td><?= $value->english ?></td>
                            <td><?= $value->maths ?></td>
                            <td><?= $value->history ?></td>
                            <td><?= $value->gst ?></td>
                            <td><?= $value->french ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

            <br><br><br>

            <table>
                <thead>
                    <th>Student Name</th>
                    <th>Mean</th>
                    <th>Median</th>
                    <th>Mode</th>
                </thead>
                <tbody>
                <?php
                    foreach (json_decode($_GET['generated_results']) as $key => $value) {
                        $studentName = $value->student_name;
                        $total = $value->english + $value->maths + $value->history + $value->gst + $value->french;
                        $mean = $total/6;

                        $arrayToSort = [$value->english, $value->maths, $value->history, $value->gst, $value->french];
                        sort($arrayToSort);
                        $median = $arrayToSort[3];
                        
                        $countedArrayValues = array_count_values($arrayToSort);

                        $mode = 0;
                        $i = 0;
                        foreach ($countedArrayValues as $key => $value) {
                            if ($i < 1) {
                                $mode = $key;
                            }
                            $i++;
                        }
                ?>
                        <tr>
                            <td><?= $studentName ?></td>
                            <td><?= $mean ?></td>
                            <td><?= $median ?></td>
                            <td><?= $mode ?></td>
                        </tr>
                <?php
                    }
                ?>
                </tbody>
            </table>
    <?php } else ?>

    <?php {
    ?>
        <table>
            <thead>
                <th>Student Name</th>
                <th>English</th>
                <th>Mathematics</th>
                <th>History</th>
                <th>GST</th>
                <th>French</th>
            </thead>
        </table>
        <p>No student record has been saved so far.</p>
    <?php
    }
    ?>

    <br><br><br>

</body>

</html>