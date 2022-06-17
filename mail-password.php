<?php
$happiDoc=include_once 'documents-location.php';
include_once $happiDoc.'classes/dbutility.php';
include_once $happiDoc.'classes/utility.php';

if(isset($_POST['rEmail'])){
//    if($_POST['rEmail']==''){
//        echo "Please enter your email to recover password";
//    }else{

//                    echo "rPass form submitted. <br/>";
    $userEmail = $_POST['rEmail'];
    
    if (checkUser($userEmail)){
        $userDetails = dbUtility::getUser($userEmail);
        $uFullName=$userDetails[1]." ".$userDetails[2];
        $status = sendMail($uFullName, $userEmail);
        if($status==1){
            print "<strong class='success'>An email has been sent to you with the temporary password.</strong>";
        }else{
        print "<strong class='error'>An error occured while sending mail.</strong>";
        }
    }
    else {
    print "<strong class='error'>We do not have the e-mail address on file. Please contact <a href='mailto:jakechen@@iupui.edu'>admin</a> for assistance.</strong>";
    }
 }
    function checkUser($email){
        return dbutility::emailExists($email);
    }

    function sendMail($userFullName, $email){
        include_once('classes/mailUtility.php');
        include_once('classes/utility.php');

        $userFullName=trim($userFullName);
        $temp_pass = utility::createRandomPassword();
        $subject="Temporary Password for your HAPPI portal account login";
        $body="Dear $userFullName,
             <br/><br/>We received your request for a new password for your HAPPI portal account, $email.
             <br/>Your new password is: <span>$temp_pass</span>

             <br/><br/>For security reasons, please go to <a href='http://discovery.informatics.iupui.edu/HAPPI/signIn.php'>http://discovery.informatics.iupui.edu/HAPPI/</a> and change the password immediately upon login. To change your password, click on the My Profile tab
                    and then click on the Reset Password tab to create a new password.
             <br/>If you have any questions, please email us at <a href='mailto:jakechen@iupui.edu'>Contact Us</a>
             <br/><br/><br/>Best regards,
             <br/><br/>HAPPI Team
              ";

        $attach='';
        $nameEmailArray= array($userFullName => $email);

        $mailUtility = new MailUtility($nameEmailArray, $subject, $body);
        $status = $mailUtility->sendMail();
        if($status == 1){
            dbUtility::resetPassword($email, $temp_pass);
        }
        return $status;

    }
?>