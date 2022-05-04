<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>Admin Page | Add Marks Page | Add Course Page</title>
</head>
<body>
   <!--Navigation bar starts-->
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
              <a class="nav-link active" href="eskilladmin.php">Admin</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!--Navigation bar Ends-->

    <!--Add marks form starts-->
    <form name="addMarksFrm"  method="POST" action="inserted.php">
      <legend style="margin:1rem;">Add-Marks</legend>
      <!-- Grid row -->
      <div class="form-group row" style="margin:1rem;">
        <!-- Default input -->
        <label for="inputNumber3" class="col-sm-2 col-form-label" style="width:5rem">Rollno</label>
        <div class="col-sm-10" style="width:25rem";>
          <input type="number" class="form-control" name="addMarksRollno" id="inputNumber3" placeholder="Rollno" required>
        </div>
      </div>
      <div class="form-group row" style="margin:1rem;">
        <!-- Default input -->
        <label for="inputselect3" class="col-sm-2 col-form-label" style="width:5rem">Course</label>
        <div class="col-sm-10" style="width:25rem";>
        <select class="form-control" name="addMarksCourse" class="browser-default custom-select" id="inputselect3" required>
        <option selected >Click To Select Course</option>
            <?php
            /*added course selection in add marks in admin*/
                  require "dblink.php";
                  $sql="SELECT * FROM `studentcourse`";
                  $result=mysqli_query($con,$sql);
                  while($row=mysqli_fetch_array($result)){
                  echo "<option value=$row[coursename]>$row[coursename]</option>";
                  }
            /*added course selection in add marks in admin*/
         ?>
        </select>
        </div>
      </div>
      <div class="form-group row" style="margin:1rem;">
        <!-- Default input -->
        <label for="inputMarks3" class="col-sm-2 col-form-label" style="width:5rem">Marks</label>
        <div class="col-sm-10" style="width:25rem";>
          <input type="number" class="form-control" id="inputMarks3" name="addMarksMarks" placeholder="Marks" required>
        </div>
      </div>
      <div class="form-group row" style="margin:1rem;">
        <!-- Default input -->
        <label for="inputDate3" class="col-sm-2 col-form-label" style="width:5rem">Date</label>
        <div class="col-sm-10" style="width:25rem";>
          <input type="date" class="form-control" id="inputDate3" name="addMarksDate" placeholder="Date" required>
        </div>
      </div>
      
      <!-- Grid row -->
      <!-- Grid row -->
      <div class="form-group row" style="margin:1rem;display: inline-block;">
        <div class="col-sm-10">
          <button type="reset" class="btn btn-danger btn-md">Reset</button>
        </div>
      </div>
      <div class="form-group row" style="display: inline-block;">
        <div class="col-sm-10">
          <button type="submit" name="addMarksbtn" class="btn btn-primary btn-md">Add</button>
        </div>
      </div>
      <!-- Grid row -->
    </form>
    <!-- Default horizontal form -->
        <!--Add Marks form ends-->


    <!--Add Course Name starts-->
    <form name="addcoursecfrm" method="post">
      <legend style="margin:1rem;">Add-Course</legend>
      <!-- Grid row -->
      <div class="form-group row" style="margin:1rem;">
        <!-- Default input -->
        <label for="inputNumber3" class="col-sm-2 col-form-label"  style="width:5rem">Name</label>
        <div class="col-sm-10" style="width:25rem";>
          <input type="text" class="form-control" id="inputNumber3" name="addCourseName" placeholder="Course Name" required>
        </div>
      </div>
      <!-- Grid row -->
      <!-- Grid row -->
      <div class="form-group row" style="margin:1rem;display: inline-block;">
        <div class="col-sm-10">
          <button type="reset" class="btn btn-danger btn-md">Reset</button>
        </div>
      </div>
      <div class="form-group row" style="display: inline-block;">
        <div class="col-sm-10">
          <button type="submit" class="btn btn-primary btn-md" name="addCourseBtn">Add</button>
        </div>
      </div>
      <!-- Grid row -->
    </form>
    <!-- Default horizontal form -->
        <!--Add Course Name ends-->

    <?php
      /*Adding Course name in admin*/
      if(isset($_POST["addCourseBtn"])){
         $course=strtoupper($_POST["addCourseName"]);
        
         $selectCource="select * from studentcourse where coursename='$course'";
         $selectResult=mysqli_query($con,$selectCource);
         $row=mysqli_num_rows($selectResult);

         if($row>0){
             echo " <div class='alert alert-danger' role='alert' style='margin: 2rem;>
                       <h4 class='alert-heading'>FAILED!</h4>
                        <p>NO, $course Course Name Already Taken.</p>
                        <hr>
                        <p class='mb-0'>FAILURE.</p>
                       </div>";
         }
         else{
            $sql="INSERT INTO `studentcourse` (`coursename`) VALUES ('$course')";
            $result=mysqli_query($con,$sql);
             if(!$result){
              echo "<div class='alert alert-danger' role='alert' style='margin: 2rem;>
                    <h4 class='alert-heading'>FAILED!</h4>
                    <p>NO, FAILED TO ADD $course COURSE NAME.</p>
                    <hr>
                     <p class='mb-0'>FAILURE.</p>
                    </div>";  
             }
             else{
                echo " <div class='alert alert-success' role='alert' style='margin: 2rem;>
                        <h4 class='alert-heading'>SUCCESSFULLY!</h4>
                        <p>YES ,SUCCESSFULLY ADDED $course COURSE NAME.</p>
                        <hr>
                        <p class='mb-0'>SUCCESS.</p>
                        </div>";  
             }
          }
        }
      /*Adding Course name in admin ends*/ 
    ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
