<?php
    define('DB_SERVER','localhost');
    define('DB_USER','root');
    define('DB_PASS','');
    define('DB_NAME','crud_oop');

    class DB_con{
        function __construct()
        {
            $conn=mysqli_connect(DB_SERVER,DB_USER,DB_PASS,DB_NAME);
            $this->dbcon=$conn;
            if(mysqli_connect_errno()){
                echo "Failed to connect to mySQL:" . mysqli_connect_error();
            }

        }
        
        public function insert($firstname,$lastname,$email,$phonenumber,$address){
            $result=mysqli_query($this->dbcon,"INSERT INTO tbluser(firstname,lastname,email,phonenumber,addreass) 
            VALUES('$firstname','$lastname','$email','$phonenumber','$address')");

            return $result;
        }
        public function fetchdata(){
            $result =mysqli_query($this->dbcon,"SELECT * FROM tbluser");
            return $result;
        }
        public function fetchonerecord($userid){
            $result=mysqli_query($this->dbcon,"SELECT *FROM tbluser WHERE id='$userid'");
            return $result;
        }
        public function update($firstname,$lastname,$email,$phonenumber,$address,$userid){
            $result=mysqli_query($this->dbcon,"UPDATE tbluser SET
                firstname='$firstname',
                lastname='$lastname',
                email='$email',
                phonenumber='$phonenumber',
                addreass='$address'
                where id='$userid'
            
            ");
            return $result;
        }
        public function delete($userid){
            $result=mysqli_query($this->dbcon,"DELETE FROM tbluser WHERE id='$userid'");
            return $result;
        }
    }
