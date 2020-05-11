<?php
    //ob_start();
    session_start();
    include 'DatabaseFile/Database.php';
    include 'Classes/User.php';
    include 'Classes/Link.php';
    include 'Classes/UserType.php';

    if(isset($_POST['login'])){
        $Validate = User::logIn(test_input($_POST['username']), test_input($_POST['password']));

        if($Validate != NULL){

            $_SESSION['user'] = serialize($Validate);
            echo "<script>window.location = '".$Validate->links[0]->physicalAddress."';</script>";
        }
        else{
            echo "<script> if(!alert('Wrong E-Mail Or Password!')) { document.location = 'portal.php'; } </script>";
        }
    }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

?>