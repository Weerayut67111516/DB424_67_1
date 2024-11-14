<?php
include 'header.php';
require 'db.php';
$sql = "select * from student where studentID = '{$_SESSION['user']['studentID']}'";
$result = $conn->query($sql);
$student = $result->fetch_assoc();
?>
<form action="saveProfile.php" method="post" enctype="multipart/form-data">
   <div class="row">
     <div class="col-md-4 border-right">
       <div class="d-flex flex-column align-items-center text-center p-3 py-5">
         <label for="profile-image" class="mb-3">
           <div id="image">
             <img class= "img-fluid" src="images/profile/<?php echo $student['image']; ?> " alt = "profile image ">
           </div>
           <input class="form-control d-none" type="file" accept="image/*" name="image" id="profile-image" onchange="preview()">
         </label>
       </div>
     </div>
     <div class="col-md-8 border-right">
       <div class="p-3 py-5">
         <div class="d-flex justify-content-between align-items-center mb-3">
           <h4 class="text-right">Profile Settings</h4>
         </div>
         <div class="row mt-2">
           <div class="mb-2">
             <label for="student-id" class="form-label">Student ID</label>
             <input required name="studentID" type="text" class="form-control" id="student-id"
             value="<?php echo $student['studentID'];?>" disabled>
           </div>
           <div class="mb-2">
             <label for="firstNAME" class="form-label">first NAME</label>
             <input required name="firstNAME" type="text" class="form-control" id="firstNAME"
             value="<?php echo $student['firstNAME'];?>">
           </div>

           <div class="mb-2">
             <label for="lastNAME" class="form-label">las tNAME</label>
             <input required name="lastNAME" type="text" class="form-control" id="lastNAME"
             value="<?php echo $student['lastNAME'];?>">
           </div>

           <div class="mb-2">
             <label for="majer" class="form-label">Majer</label>
             <select name="majorID" class="form-select" id="majer">
<?php
$sql = 'select * from majer order by faculty';
$result = $conn->query($sql);
while ($row = $result->fetch_assoc()) {
echo "<option value='{$row['majerID']}'".($row['majerID']==$student['majerID']?' selected':'').">
     {$row['faculty']}-{$row['majerNAME']}
   </option>";
}
$conn->close();
?>
             </select>
           </div>
         </div>
         <div class="mt-5 text-center">
           <button name="submit" class="btn btn-primary" type="submit">Save Profile</button>
         </div>
       </div>
     </div>
   </div>
 </form>
<?php
include 'footer.php';
?>