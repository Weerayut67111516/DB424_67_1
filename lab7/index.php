<?php
include 'header.php';
?>
<?php
    echo $_SESSION['user']['firstName'].' '.
         $_SESSION['user']['lastName']; 
?>
</h1>
<?php
include 'footer.php';
?>
   