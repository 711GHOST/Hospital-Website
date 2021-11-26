<?php
if (isset($_POST['submit'])) {
    if (isset($_POST['Full_Name']) && isset($_POST['Phone_Number']) &&
        isset($_POST['Email']) && isset($_POST['Slot_Time']) &&
        isset($_POST['Message'])) {
        
        $Full_Name = $_POST['Full_Name'];
        $Phone_Number = $_POST['Phone_Number'];
        $Email = $_POST['Email'];
        $Slot_Time = $_POST['Slot_Time'];
        $Message = $_POST['Message'];
        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "hospital_website";
        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die('Could not connect to the database.');
        }
        else {
            $Select = "SELECT Email FROM Appointment WHERE Email = ? LIMIT 1";
            $Insert = "INSERT INTO Appointment(Full_Name, Phone_Number, Email, Slot_Time, Message) values(?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($Select);
            $stmt->bind_param("s", $Email);
            $stmt->execute();
            $stmt->bind_result($resultEmail);
            $stmt->store_result();
            $stmt->fetch();
            $rnum = $stmt->num_rows;
            if ($rnum == 0) {
                $stmt->close();
                $stmt = $conn->prepare($Insert);
                $stmt->bind_param("sisss",$Full_Name, $Phone_Number, $Email, $Slot_Time, $Message);
                if ($stmt->execute()) {
                    echo "New record inserted sucessfully in our Database. We will soon contact you.";
                }
                else {
                    echo $stmt->error;
                }
            }
            else {
                echo "Someone already registered using this email.";
            }
            $stmt->close();
            $conn->close();
        }
    }
    else {
        echo "All field are required.";
        die();
    }
}
else {
    echo "Submit button is not set";
}
?>