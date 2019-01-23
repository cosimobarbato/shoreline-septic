<?php
    $msg_box = ""; // this variable will store messages of the form
    $errors = array(); // error array
    // check the fields for errors
    if($_POST['user_name'] == "")    $errors[] = "Field 'Your name' is blank!";
    if($_POST['user_email'] == "")   $errors[] = "Field 'Your e-mail' is not filled!";
    if($_POST['user_phone'] == "") $errors[] = "Field 'Your phone number' is blank!";
    if($_POST['text_comment'] == "") $errors[] = "Field 'message Text' is blank!";
 
    // if the form is error-free
    if(empty($errors)){     
       // collect data from the form
        $message  = "Name: " . $_POST['user_name'] . "<br/>";
        $message .= "E-mail: " . $_POST['user_email'] . "<br/>";
        $message .= "Phone: " . $_POST['user_phone'] . "<br/>";
        $message .= "Message: " . $_POST['text_comment'];      
        send_mail($message); // send an email
        // print a success message
        $msg_box = "<span style='color: green;'>Message successfully sent!</span>";
    }else{
        // if there were errors, then output them
        $msg_box = "";
        foreach($errors as $one_error){
            $msg_box .= "<span style='color: red;'>$one_error</span><br/>";
        }
    }
 
    // make a response to the client part in JSON format
    echo json_encode(array(
        'result' => $msg_box
    ));
     
     
    // send email function
    function send_mail($message){
        // mail to which the letter will come
        $mail_to = "cbarb001@gmail.com"; 
        // message subject
        $subject = "Website Inquiry";
         
       	// message header
        $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=utf-8\r\n"; // letter encoding
        $headers .= "From: Shoreline Septic <no-reply@test.com>\r\n"; // who is the letter from
         
       
        mail($mail_to, $subject, $message, $headers);
    }
?>