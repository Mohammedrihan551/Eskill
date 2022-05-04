<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <title>Eskill | Page</title>
</head>
  
<body>
  <!--navigation starts-->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">E-Skill</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.html">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="studentaddmission.html">Enroll</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="studentresult.html">Check-Result</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="eskilladmin.php">Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  <!--navigation ends-->


  <?php

  require "dblink.php";

  /*student information inserting*/
  if (isset($_POST["admissionSubmit"])) {
    $sname = strtoupper($_POST["admissionName"]);
    $sphone = $_POST["admissionPhone"];
    $semail = $_POST["admissionEmail"];
    $sdate = $_POST["admissionDate"];

    $sql = "SELECT * FROM `studentinfo`";
    $cresult = mysqli_query($con, $sql);
    $crow = mysqli_num_rows($cresult);

    $roll1 = substr($sdate, 2, 2);
    $roll2 = substr($sdate, 5, 2);
    $roll = $roll1 . $roll2 . $crow;

 /*Stutent Information After Insertion*/
  echo "<div class='card mb-4' style='margin: 2rem;'>
  <div class='card-body'>
    <h2>Profile</h2>
    <hr>
    <div class='row'>
      <div class='col-sm-3'>
        <p class='mb-0'>Rollno</p>
      </div>
      <div class='col-sm-9'>
        <p class='text-muted mb-0'>$roll</p>
      </div>
    </div>
    <hr>
    <div class='row'>
      <div class='col-sm-3'>
        <p class='mb-0'>Name</p>
      </div>
      <div class='col-sm-9'>
        <p class='text-muted mb-0'>$sname</p>
      </div>
    </div>
    <hr>
    <div class='row'>
      <div class='col-sm-3'>
        <p class='mb-0'>Phone</p>
      </div>
      <div class='col-sm-9'>
        <p class='text-muted mb-0'>$sphone</p>
      </div>
    </div>
    <div class='row'>
      <div class='col-sm-3'>
        <p class='mb-0'>E-mail</p>
      </div>
      <div class='col-sm-9'>
        <p class='text-muted mb-0'>$semail</p>
      </div>
    </div>
    <div class='row'>
      <div class='col-sm-3'>
        <p class='mb-0'>Date</p>
      </div>
      <div class='col-sm-9'>
        <p class='text-muted mb-0'>$sdate</p>
      </div>
    </div>
  </div>
  </div>";
  $sql="INSERT INTO `studentinfo` (`name`, `rollno`, `phone`, `email`, `date`)
  VALUES ('$sname', '$roll', '$sphone', '$semail', '$sdate')";
  $result=mysqli_query($con,$sql); 
   /*Student information After insertion ends*/
  if (!$result) {
    echo "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
           <h4 class='alert-heading'>Failed!</h4>
           <p>No, Student Admmission Record Not Stored.
           <hr>
           <p class='mb-0'>Failed.</p>
          </div>";
    } else {
          echo "<div class='alert alert-success' role='alert' style='margin: 2rem;>
           <h4 class='alert-heading'>Sussesfully!</h4>
           <p>Yes, Student Admmission Record Stored.
           <hr>
           <p class='mb-0'>Sussess.</p>
         </div>";
   }
  }



  /*Student Marks Inserting*/
  if (isset($_POST["addMarksbtn"])) {
    $rollno = $_POST["addMarksRollno"];
    $course = $_POST["addMarksCourse"];
    $marks = $_POST["addMarksMarks"];
    $date = $_POST["addMarksDate"];


    $selectRollno = "SELECT * FROM `studentinfo` where rollno='$rollno'";
    $selectResult = mysqli_query($con, $selectRollno);
    $ssrow = mysqli_num_rows($selectResult);

    $ssql = "SELECT * FROM `studentmarks` where course='$course'";
    $sreselt = mysqli_query($con, $selectRollno);
    $srec = mysqli_fetch_array($sreselt);

    if ($ssrow == 1) {
          "<div class='alert alert-success' role='alert' style='margin: 2rem;>
              <h4 class='alert-heading'>SUCCESSFULLY!</h4>
              <p>No,'ROLLNO' . $rollno . 'EXIST'.
              <hr>
              <p class='mb-0'>SUCCESS.</p>
             </div>";

      $isql = "INSERT INTO `studentmarks` (`rollno`, `course`, `marks`, `date`)
          VALUES ('$rollno', '$course', '$marks', '$date')";
      $ireselt = mysqli_query($con, $isql);
        if (!$ireselt) {
         echo "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
              <h4 class='alert-heading'>FAILED!</h4>
              <p>No,STUDENT MARKS NOT SAVED PLEASE TRY AGAIN.
              <hr>
              <p class='mb-0'>FAILURE.</p>
             </div>";
         }else {
          echo "<div class='alert alert-success' role='alert' style='margin: 2rem;>
              <h4 class='alert-heading'>SUCCESS!</h4>
              <p>YES,STUDENT MARKS SAVED.</p>
              <hr>
              <p class='mb-0'>SUCCESS.</p>
             </div>";
       }
    }else {
     echo "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
           <h4 class='alert-heading'>FAILURE!</h4>
           <p>NO, ROLLNO   $rollno   DOES NOT EXIST </p>
           <hr>
           <p class='mb-0'>FAILED.</p>
          </div>";
    }
  }
  

  /*Student Marks Inserting Ends*/



  /*Marks and profile dislaying starts*/
  if(isset($_POST["resultbtn"])){
    $rollno=$_POST["admissionFrmRollno"];
   
     $sssql="SELECT * FROM `studentinfo` where rollno='$rollno'";
     $ssresult=mysqli_query($con,$sssql);
     $ssrec=mysqli_fetch_array($ssresult);
     $rows=mysqli_num_rows($ssresult);
  
     /*Profile displaying table*/
     if($rows>0){
     echo "<div class='card mb-4' style='margin: 2rem;'>
        <div class='card-body'>
          <h2>Profile</h2>
          <hr>
          <div class='row'>
            <div class='col-sm-3'>
              <p class='mb-0'>Name</p>
            </div>
            <div class='col-sm-9'>
              <p class='text-muted mb-0'>$ssrec[0]</p>
            </div>
          </div>
          <hr>
          <div class='row'>
            <div class='col-sm-3'>
              <p class='mb-0'>Phone</p>
            </div>
            <div class='col-sm-9'>
              <p class='text-muted mb-0'>$ssrec[2]</p>
            </div>
          </div>
          <hr>
          <div class='row'>
            <div class='col-sm-3'>
              <p class='mb-0'>Phone</p>
            </div>
            <div class='col-sm-9'>
              <p class='text-muted mb-0'>$ssrec[3]</p>
            </div>
          </div>
        </div>
      </div>";
     }else{
      echo "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
      <h4 class='alert-heading'>FAILED!</h4>
      <p>NO, INVALID ROLLNO</p>
      <hr>
      <p class='mb-0'>FAILURE.</p>
     </div>";
     }
      /*Profile displaying table ends*/
  
        /*Markssheet starts*/
        $ssql = "SELECT * FROM `studentmarks` where rollno='$rollno'";
        $sresult = mysqli_query($con, $ssql);
        $srow = mysqli_num_rows($sresult);
        /*Marksheet ends*/

  if($srow>0){
      /*Marks displaying table Starts*/
      $tot = 0;
      $avg = 0;
     echo " <div class='table-responsive' style='margin: 2rem;'>
             <table class='table' class='border'>
               <h2>Marksheet</h2>
               <hr>
               <thead>
                 <tr><th scope='col'>Rollno</th><th scope='col'>Course</th><th scope='col'>Date</th><th scope='col'>Marks</th></tr>
               </thead>
               <tbody>";
           while ($srec = mysqli_fetch_array($sresult)) {
                echo "<tr><td scope='row'>$srec[0]</td><td scope='row'>$srec[1]</td><td scope='row'>$srec[3]</td><td scope='row'>$srec[2]</td> </tr>";
                $tot = $tot + $srec[2];  
               }
               $avg = $tot / $srow;
          echo"</tbody>
               <tfoot>
                 <tr><th scope='col' colspan='3'>Total</th><th scope='col'>$tot</th></tr>
                  <tr><th scope='col' colspan='3'>Avg</th><th scope='col'>$avg</th></tr>
               </tfoot>
             </table>
             <hr>
           </div>";
           if(!$sresult){
            "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
             <h4 class='alert-heading'>Failed!</h4>
             <p>No, Student Did Not Write Exam.
             <hr>
             <p class='mb-0'>Failed.</p>
            </div>";
           }
           else{
           "<div class='alert alert-sussess' role='alert' style='margin: 2rem;>
            <h4 class='alert-heading'>Failed!</h4>
            <p>No, Student Admmission Record Not Stored.
            <hr>
            <p class='mb-0'>Failed.</p>
           </div>";
           }
    /*Marks displaying table Ends*/
          }else{
            echo "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
            <h4 class='alert-heading'>FAILED!</h4>
            <p>NO, INVALID ROLLNO</p>
            <hr>
            <p class='mb-0'>FAILURE.</p>
           </div>";
          }
  }
  /*Marks and profile dislaying starts*/
?>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>

</html>