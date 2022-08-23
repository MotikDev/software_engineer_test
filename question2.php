<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="hour">Enter an integer</label>
        <input type="number" name="integerValue" required>
        <br><br><br>
        <input type="submit" value="Create staircase">
    </form>

</body>
</html>
<?php
    class Question2 {
        private $staircaseValue;

        function __construct($integer){
            $this->staircaseValue = $integer;
        }

        public function getStaircase() {
            $steps = $this->staircaseValue;

            $this->validation($steps);

            for ($i=1; $i <= (int)$steps; $i++) { 
                for ($i1=0; $i1 < $i; $i1++) { 
                    echo "#";
                }
                echo "<br/>";
            }
        }

        private function validation($steps){
            if (((int) $steps) && ($steps >= 1) && ($steps <= 100)) {
                return true;
            } else {
                exit("Invalid input supplied.");
            }
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $integerValue = $_POST['integerValue'];

        if (empty($integerValue)) {
          echo "Integer value is empty. Enter a minimum of 1 and a maximum of 100";
        } else {
            $testing = new Question2($integerValue);
            $testing->getStaircase();
        }
      }
?>