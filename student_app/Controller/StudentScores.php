 <?php
    class StudenScores{
        private $serverName = "localhost";
        private $userName = "root";
        private $password = "";
        private $DBName = "student_scores";
        private $connection;

        function __constructor(){
            // $this->connectDatabase();
        }

        private function connectDatabase(){
            $this->connection = new mysqli($this->serverName, $this->userName, $this->password, $this->DBName);
            if (mysqli_connect_errno()) {
                return header("Location:../View/index.php?status=con_error");
            }
        }

        private function validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            if (is_numeric($data)) {
                if ($data >= 0 && $data <= 100) {
                    return $data;
                } else {
                    exit(header("Location:../View/index.php?status=not_number"));
                }
                
            }
            return $data;
        }

        public function postScores($scoreArray){
            $this->connectDatabase();

            $name = $this->validate($scoreArray['name']);
            $eng = $this->validate((double) $scoreArray['english']);
            $maths = $this->validate((double) $scoreArray['maths']);
            $history = $this->validate((double) $scoreArray['history']);
            $gst = $this->validate((double) $scoreArray['gst']);
            $french = $this->validate((double) $scoreArray['french']);
            
            try {
                $statement = $this->connection->prepare("INSERT INTO scores (student_name, english, maths, history, gst, french) VALUES (?, ?, ?, ?, ?, ?)");
                $statement->bind_param('sddddd', $name, $eng, $maths, $history, $gst, $french);
                $statement->execute();
                $statement->close();
                return header("Location:../View/index.php?status=success");
            } catch (\Throwable $th) {
                return header("Location:../View/index.php?status=failed");
            }
        }

        public function generateReport(){
            $this->connectDatabase();
            
            $query = "SELECT * from scores ORDER BY id ASC";
            $result = $this->connection->query($query);
            $studentNames = [];

            foreach ($result as $key => $value) {
                $studentNames[] = $value;
            }

            return header("Location:../View/index.php?generated_results=".json_encode($studentNames));
        }

        public function __destruct()
        {
            $this->connection->close();
        }

        // DATABASE SCHEMA
        // CREATE TABLE scores (
        //     id INTEGER NOT NULL AUTO_INCREMENT PRIMARY KEY,
        //     student_name VARCHAR(255) NOT NULL,
        //     english DECIMAL NOT NULL,
        //     maths DECIMAL NOT NULL,
        //     history DECIMAL NOT NULL,
        //     gst DECIMAL NOT NULL,
        //     french DECIMAL NOT NULL
        // );
    }
?>