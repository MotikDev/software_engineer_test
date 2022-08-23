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
        <label for="hour">Recursive function for adding numbers:</label><br><br>
        <input type="number" name="recursiveNumber" required>
        <br><br>
        <input type="submit" value="Calculate recursion">
    </form>

</body>
</html>
<?php
    class Question {

        private $recursiveNumbers;

        function __construct($recursiveNumbers){
            $this->recursiveNumbers = $recursiveNumbers;
        }

        public function getRecursion(){
            $this->validation();
            $numberArray = $this->getNumberArray();
            $recursiveValue = $this->recursiveFunction($numberArray);
            echo "<br/> The recursive value of $this->recursiveNumbers is $recursiveValue";
        }

        private function validation() {
            if (((int) $this->recursiveNumbers) && ($this->recursiveNumbers >= 1) && (count(str_split($this->recursiveNumbers)) <= 100)) {
                return true;
            } else {
                exit("Invalid input supplied.");
            }
        }

        private function getNumberArray(){
            return str_split($this->recursiveNumbers);
        }

        private function recursiveFunction($numberArray){
            if (count($numberArray) === 0) {
                return ;
            }
            $currentValue = array_shift($numberArray);
            return  ((int)$currentValue + $this->recursiveFunction($numberArray));
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $digits = $_POST['recursiveNumber'];

        if (empty($digits)) {
          echo "You have not entered a value.";
        } else {
            $testing = new Question($digits);
            $testing->getRecursion();
        }
      }
?>