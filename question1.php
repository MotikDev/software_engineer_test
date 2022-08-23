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
        <label for="hour">H:</label>
        <input type="text" name="hour">
        <br><br>
        <label for="minute">M:</label>
        <input type="text" name="minute">
        <br><br><br>
        <input type="submit" value="Check Time">
    </form>

</body>
</html>
<?php
    class Question1 {
        private $numeralTime;

        function __construct($time){
            $this->numeralTime = $time;
        }

        public function setTime() {
            $hour = explode(':', $this->numeralTime)[0];
            $minutes = explode(':', $this->numeralTime)[1];

            $validated = $this->validation($hour, $minutes);

            if ($validated[0] && (int)$minutes === (int) '00') {
                return "$validated[0] o'clock";
            } elseif ((int) $minutes === (int) '30') {
                return "half past $validated[0]";
            } elseif ((int) $minutes < 30) {
                return "$validated[1] past $validated[0]";
            } elseif ((int) $minutes > 30) {
                return "$validated[1] minutes to $validated[0]";
            }
        }

        private function validation($hour, $minutes){
            
            if ((strlen($hour) === 2) && ((int) $hour) && ($hour >= 1) && ($hour <= 12)) {
                $hourInWords = $this->convertToHour($hour);
            } else {
                exit("A valid hour format is required i.e. 01 or 12 and the maximum value allowed is 12.");
            }

            if (strlen($minutes) === 2 && (int) $minutes && $minutes >= 0 && $minutes <= 60) {
                $minutesInWords = $this->convertToMinutes($minutes);
            } elseif ((int) $minutes == 0) {
                $minutesInWords = true;
            } else {
                exit("A valid minutes format is required i.e. 00 or 60 and the maximum value allowed is 60");
            }

            return [$hourInWords, $minutesInWords];
        }

        private function convertToHour($hour) {
            if ($hour === '00') {
                return 'Midnight';
            } elseif ($hour === '01') {
                return 'one';
            } elseif ($hour === '02') {
                return 'two';
            } elseif ($hour === '03') {
                return 'three';
            } elseif ($hour === '04') {
                return 'four';
            } elseif ($hour === '05') {
                return 'five';
            } elseif ($hour === '06') {
                return 'six';
            } elseif ($hour === '07') {
                return 'seven';
            } elseif ($hour === '08') {
                return 'eight';
            } elseif ($hour === '09') {
                return 'nine';
            } elseif ($hour === '10') {
                return 'ten';
            } elseif ($hour === '11') {
                return 'eleven';
            } elseif ($hour === '12') {
                return 'twelve';
            }
            
        }

        private function convertToMinutes($minutes){
            $minutes = (int) $minutes;
            
            if($minutes == (int) '01' || $minutes === 59){
                return 'one';
            } elseif ($minutes == (int) '02' || $minutes === 58) {
                return 'two';
            } elseif ($minutes == (int) '03' || $minutes === 57) {
                return 'three';
            } elseif ($minutes == (int) '04' || $minutes === 56) {
                return 'four';
            } elseif ($minutes == (int) '05' || $minutes === 55) {
                return 'five';
            } elseif ($minutes == (int) '06' || $minutes === 54) {
                return 'six';
            } elseif ($minutes == (int) '07' || $minutes === 53) {
                return 'seven';
            } elseif ($minutes == (int) '08' || $minutes === 52) {
                return 'eight';
            } elseif ($minutes == (int) '09' || $minutes === 51) {
                return 'nine';
            } elseif ($minutes === 10 || $minutes === 50) {
                return 'ten';
            } elseif ($minutes === 11 || $minutes === 49) {
                return 'eleven';
            } elseif ($minutes === 12 || $minutes === 48) {
                return 'twelve';
            } elseif ($minutes === 13 || $minutes === 47) {
                return 'thirteen';
            } elseif ($minutes === 14 || $minutes === 46) {
                return 'fourteen';
            } elseif ($minutes === 15 || $minutes === 45) {
                return 'fifteen';
            } elseif ($minutes === 16 || $minutes === 44) {
                return 'sixteen';
            } elseif ($minutes === 17 || $minutes === 43) {
                return 'seventeen';
            } elseif ($minutes === 18 || $minutes === 42) {
                return 'eighteen';
            } elseif ($minutes === 19 || $minutes === 41) {
                return 'nineteen';
            } elseif ($minutes === 20 || $minutes === 40) {
                return 'twenty';
            } elseif ($minutes === 21 || $minutes === 39) {
                return 'twenty-one';
            } elseif ($minutes === 22 || $minutes === 38) {
                return 'twenty-two';
            } elseif ($minutes === 23 || $minutes === 37) {
                return 'twenty-three';
            } elseif ($minutes === 24 || $minutes === 36) {
                return 'twenty-four';
            } elseif ($minutes === 25 || $minutes === 35) {
                return 'twenty-five';
            } elseif ($minutes === 26 || $minutes === 34) {
                return 'twenty-six';
            } elseif ($minutes === 27 || $minutes === 33) {
                return 'twenty-seven';
            } elseif ($minutes === 28 || $minutes === 32) {
                return 'twenty-eight';
            } elseif ($minutes === 29 || $minutes === 31) {
                return 'twenty-nine';
            }
        }
    }



    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $hour = $_POST['hour'];
        $minute = $_POST['minute'];

        if (empty($hour) || empty($minute)) {
            date_default_timezone_set('Africa/Lagos');
            $currentHour = substr(date('h A'), 0, 2);
            // $timeFormat = substr(date('h A'), 3, 2); 
            $currentMin = substr(date('i A'), 0, 2);
            $testing = new Question1(($currentHour).':'.$currentMin);
            $currentTime = $testing->setTime();
            echo "Hour or minutte is empty but current time is $currentTime";
        } else {
            // $currentHour = date('h');
            // $currentMin = date('i');
            $testing = new Question1($hour.':'.$minute);
            echo $testing->setTime();
        }
      }
?>