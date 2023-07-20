<?php
if(isset($_POST["type"]) && isset($_POST["area"])) {
    $search_param = $_POST["type"];
    $search_area = $_POST["area"];

    // db details
    $host ="localhost";
    $dbusername = "id21058526_yash";
    $dbpass = "Abcd@1234";
    $dbname = "id21058526_doctorsearch";

    // make connection
    $conn = new mysqli($host, $dbusername, $dbpass, $dbname);

    // query
    $sql = "SELECT ID, DoctorName, DoctorArea, DoctorImage 
    FROM doctors WHERE DoctorArea 
    LIKE '%".$search_area."%' AND Doctorcategory LIKE '%".$search_param."%'";

    // result
    $result = $conn->query($sql);

    // check
    if($result->num_rows > 0) {
        // default result heading
        // $data = '<b class="services-for-your">Doctors found in your area</b>';
        $data = '';
        $doctor_data = '';
        while($row = $result->fetch_assoc()){
            $doctorid = $row["ID"];
            $doctorname = $row["DoctorName"];
            $doctorinfo = $row["DoctorArea"];
            $doctorimage = $row["DoctorImage"];

            // doctor card
            $doctor_data = $doctor_data.
            '<div class="h1 text-center">Doctors found in your area!</div>
            <div class="card" style="width: 18rem;">
                <img src="'.$doctorimage.'" class="card-img-top" alt="image">
                <div class="card-body">
                    <h5 class="card-title">'.$doctorname.'</h5>
                    <p class="card-text">'.$doctorinfo.'</p>
                </div>
            </div>';
        }
    }
    else {
        $data = '<div class="h1 text-center">No doctors found in your area!</div>';
        $doctor_data = '';
    }      
}
else {
    $data = '<div class="h1 text-center">Bad Query!</div>';
    $doctor_data = '';
}
$data = $data . $doctor_data;
echo $data;
?>