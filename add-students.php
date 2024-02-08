<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

   if(isset($_POST['submit']))
  {
 $stuname=$_POST['stuname'];
 $stuemail=$_POST['stuemail'];
 $stuclass=$_POST['stuclass'];
 $gender=$_POST['gender'];
 $bd=$_POST['bd'];
 $dob=$_POST['dob'];
 $stuid=$_POST['stuid'];
 $fname=$_POST['fname'];
 $mname=$_POST['mname'];
 $connum=$_POST['connum'];
 $altconnum=$_POST['altconnum'];
 $address=$_POST['address'];
 $image=$_FILES["image"]["name"];
 $cty=$_POST['cty'];
 $pc=$_POST['pc'];
 $state=$_POST['state'];
 $ctr=$_POST['ctr'];
 $poy=$_POST['poy'];
 $dpt=$_POST['dpt'];
 $tcl=$_POST['tcl'];
 $cc=$_POST['cc'];
 $role=$_POST['role'];
 $ret="select UserName from tblstudent where UserName=:uname || StuID=:stuid";
 $query= $dbh -> prepare($ret);
$query->bindParam(':uname',$uname,PDO::PARAM_STR);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
$query-> execute();
     $results = $query -> fetchAll(PDO::FETCH_OBJ);
if($query -> rowCount() == 0)
{
$extension = substr($image,strlen($image)-4,strlen($image));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Logo has Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
$image=md5($image).time().$extension;
 move_uploaded_file($_FILES["image"]["tmp_name"],"images/".$image);
$sql="insert into tblstudent(StudentName,StudentEmail,StudentClass,Gender,BD,DOB,StuID,FatherName,MotherName,ContactNumber,AltenateNumber,Address,UserName,Password,Image,city,pincode,state,country,DateofAdmission,dept,tcl,cc,role)values(:stuname,:stuemail,:stuclass,:gender,:bd,:dob,:stuid,:fname,:mname,:connum,:altconnum,:address,:uname,:password,:image,:cty,:pc,:state,:ctr,:poy,:dpt,:tcl,:cc,:role)";
$query=$dbh->prepare($sql);
$query->bindParam(':stuname',$stuname,PDO::PARAM_STR);
$query->bindParam(':stuemail',$stuemail,PDO::PARAM_STR);
$query->bindParam(':stuclass',$stuclass,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':bd',$bd,PDO::PARAM_STR);
$query->bindParam(':dob',$dob,PDO::PARAM_STR);
$query->bindParam(':stuid',$stuid,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':mname',$mname,PDO::PARAM_STR);
$query->bindParam(':connum',$connum,PDO::PARAM_STR);
$query->bindParam(':altconnum',$altconnum,PDO::PARAM_STR);
$query->bindParam(':address',$address,PDO::PARAM_STR);
$query->bindParam(':image',$image,PDO::PARAM_STR);
$query->bindParam(':cty',$cty,PDO::PARAM_STR);
$query->bindParam(':pc',$pc,PDO::PARAM_STR);
$query->bindParam(':state',$state,PDO::PARAM_STR);
$query->bindParam(':ctr',$ctr,PDO::PARAM_STR);
$query->bindParam(':poy',$poy,PDO::PARAM_STR);
$query->bindParam(':dpt',$dpt,PDO::PARAM_STR);
$query->bindParam(':tcl',$tcl,PDO::PARAM_STR);
$query->bindParam(':cc',$cc,PDO::PARAM_STR);
$query->bindParam(':role',$role,PDO::PARAM_STR);
 $query->execute();
   $LastInsertId=$dbh->lastInsertId();
   if ($LastInsertId>0) {
    echo '<script>alert("Student has been added.")</script>';
echo "<script>window.location.href ='add-students.php'</script>";
  }
  else
    {
         echo '<script>alert("Something Went Wrong. Please try again")</script>';
    }
}}

else
{

echo "<script>alert('Username or Student Id  already exist. Please try again');</script>";
} echo '<script>
document.addEventListener(\'DOMContentLoaded\', function() {
    var form = document.forms[0];

    form.addEventListener(\'submit\', function(event) {
        var stunameInput = form.elements[\'stuname\'].value;
        var stuemailInput = form.elements[\'stuemail\'].value;
        var dobInput = form.elements[\'dob\'].value;
        var stuidInput = form.elements[\'stuid\'].value;
        var fnameInput = form.elements[\'fname\'].value;
        var mnameInput = form.elements[\'mname\'].value;
        var connumInput = form.elements[\'connum\'].value;
        var altconnumInput = form.elements[\'altconnum\'].value;
        var ctyInput = form.elements[\'cty\'].value;
        var pcInput = form.elements[\'pc\'].value;
        var stateInput = form.elements[\'state\'].value;
        var ctrInput = form.elements[\'ctr\'].value;
        var poyInput = form.elements[\'poy\'].value;
        var tclInput = form.elements[\'tcl\'].value;
        var ccInput = form.elements[\'cc\'].value;
        var roleInput = form.elements[\'role\'].value;




        
        if (!/^[a-zA-Z]+$/.test(stunameInput)) {
            alert(\'Please enter only letters in the Student Full Name field.\');
            event.preventDefault();
        }

        // Validate Student Email (You can customize the regex for email validation)
        if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/.test(stuemailInput)) {
            alert(\'Please enter a valid email address.\');
            event.preventDefault();
        }

       

    });
});
</script>';
}
  ?>

     <?php include_once('includes/header1.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
      <?php include_once('includes/sidebar1.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Add Students </h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                  <li class="breadcrumb-item active" aria-current="page"> Add Students</li>
                </ol>
              </nav>
            </div>
            <div class="row">
          
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                   
                   
                    <form class="forms-sample row" method="post" enctype="multipart/form-data" >
                      
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Student Full Name</label>
                        <input type="text" name="stuname" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Student Email</label>
                        <input type="text" name="stuemail" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputEmail3">Student Class</label>
                        <select  name="stuclass" class="form-control" >
                          <option value="">Select Class</option>
                         <?php 

$sql2 = "SELECT * from    tblclass ";
$query2 = $dbh -> prepare($sql2);
$query2->execute();
$result2=$query2->fetchAll(PDO::FETCH_OBJ);

foreach($result2 as $row1)
{          
    ?>  
<option value="<?php echo htmlentities($row1->ID);?>"><?php echo htmlentities($row1->ClassName);?> <?php echo htmlentities($row1->Section);?></option>
 <?php } ?> 
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Gender</label>
                        <select name="gender" value="" class="form-control" >
                          <option value="">Choose Gender</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                          <option value="other">Others</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Blood Group</label>
                        <select name="bd" value="" class="form-control" >
                          <option value="">Choose Blood group</option>
                          <option value="a">A+</option>
                          <option value="b">B+</option>
                          <option value="c">AB+</option> 
                          <option value="d">O+</option>
                          <option value="e">A-</option>
                          <option value="f">B-</option>
                          <option value="g">AB-</option>
                          <option value="h">O-</option>
                        </select>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Date of Birth</label>
                        <input type="date" name="dob" value="" class="form-control" >
                      </div>
                     
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Student GRN</label>
                        <input type="text" name="stuid" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Student Photo</label>
                        <input type="file" name="image" value="" class="form-control" >
                      </div>
                      <h3 class="col-md-12">Parents/Guardian's details</h3>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Father's Name</label>
                        <input type="text" name="fname" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Mother's Name</label>
                        <input type="text" name="mname" value="" class="form-control">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Contact Number</label>
                        <input type="text" name="connum" value="" class="form-control"  maxlength="10" pattern="[0-9]+">
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Alternate Contact Number</label>
                        <input type="text" name="altconnum" value="" class="form-control"  maxlength="10" pattern="[0-9]+">
                      </div>
                      <div class="form-group col-md-12">
                        <label for="exampleInputName1">Address</label>
                        <textarea name="address" class="form-control"></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">City</label>
                        <input type="text" name="cty" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Pin-code</label>
                        <input type="text" name="pc" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">State</label>
                        <input type="text" name="state" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Country</label>
                        <input type="text" name="ctr" value="" class="form-control">
                      </div>
                      <h3 class="col-md-12">Academic's details</h3>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Pass-out year</label>
                        <input type="text" name="poy" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Department</label>
                        <select name="dpt" value="" class="form-control" >
                          <option value="">Choose department</option>
                          <option value="cse">CSE</option>
                          <option value="etc">ENTC</option>
                          <option value="civ">CIVIL</option> 
                          <option value="me">MECH</option>
                          <option value="ch">CHEM</option>
                        </select>
                      </div>
                     
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Technology Learned:</label>
                        <textarea name="tcl" class="form-control"></textarea>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Current Company</label>
                        <input type="text" name="cc" value="" class="form-control" >
                      </div>
                      <div class="form-group col-md-6">
                        <label for="exampleInputName1">Role</label>
                        <input type="text" name="role" value="" class="form-control">
                      </div>
                    
                      <button type="submit" class="btn btn-primary mr-2" name="submit">Add</button>
                    
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
         <?php include_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <?php   ?>