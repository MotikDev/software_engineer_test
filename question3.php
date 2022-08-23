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
        <label for="hour">Enter multi-dimentional arrays seperated by commas, and each array must be enclosed with []:</label><br><br>
        <textarea name="inputArrays" cols="30" rows="10"></textarea>
        <br><br>
        <input type="submit" value="See duplicates">
    </form>

</body>
</html>
<?php
    class Question3 {

        private $arrayValues;

        function __construct($arrayValues){
            $this->arrayValues =$arrayValues;
        }

        public function getDuplicates() {
            $multiDimensionalArrays = $this->getArrays();
            $this->checkForDuplicates($multiDimensionalArrays);
        }

        private function getArrays(){
            try {
                $workedArrays = [];
                $arrayNumber = substr_count($this->arrayValues, '[');
    
                for ($i=0; $i < $arrayNumber; $i++) { 
                    $removedSpaces = str_replace(' ', '', $this->arrayValues);
                    $currentArray = explode(']', $removedSpaces)[$i];
                    $stringedValue = explode('[', $currentArray)[1];
                    $spacedValue = str_replace(',', ' ', $stringedValue);
                    $workedArrays[] = explode(' ', $spacedValue);
                }
                return $workedArrays;
            } catch (\Throwable $th) {
                echo "Kindly use the appropriate format for the inputted array";
            }
        }

        private function checkForDuplicates($arrays){
            for ($i=0; $i < count($arrays); $i++) { 
                for ($i1=0; $i1 < count($arrays[$i]); $i1++) { 
                    $arrays[$i][$i1] = (int)$arrays[$i][$i1];
                }
                for ($i1=0; $i1 < count($arrays[$i]); $i1++) { 
                    $realValue = $arrays[$i][$i1];
                    $firstSearch = array_search($realValue, $arrays[$i]);
                    $secondSearch = array_search($realValue, array_reverse($arrays[$i], true));
                    unset($arrays[$i][$i1]);
                    if (in_array($realValue, $arrays[$i]) && ( $firstSearch > $secondSearch)) {
                        array_values($arrays[$i]);
                        $arrays[$i][$i1] = 0;
                    } else {
                        array_values($arrays[$i]);
                        $arrays[$i][$i1] = $realValue;
                    }
                }
            }
            echo json_encode($arrays);
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $integerValues = $_POST['inputArrays'];

        //Test Data
        // [1, 3, 1, 2, 3,4, 4, 3, 5],
        // [1, 1, 1, 1, 1, 1, 1],
        // [4,4,6,6],
        // [7,7,9,9],

        if (empty($integerValues)) {
          echo "You have not entered a value.";
        } else {
            $testing = new Question3($integerValues);
            $testing->getDuplicates();
        }
      }
?>