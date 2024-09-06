<?php
namespace app\controllers;

class Contact extends \app\core\Controller {

    //send an email to Kourosh from the customer
    function contactUs() {
        if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = "From: $name\nEmail: $email\n\n" . $_POST['message'];

            $exitCode = \app\models\Mailer::sendEmail('kourosharani@gmail.com', $subject, $message);
            if($exitCode == 0){
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('Message successfully sent!');</script>";
                }else{
                    echo "<script>alert('Message envoyé avec succès!');</script>";
                }
                
            } else {
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('Message failed to send');</script>";
                }else{
                    echo "<script>alert('L'envoi du message a échoué');</script>";
                }
               
            }
        } 
        $this->view('Contact/contact');
    }
    public function subscribe(){
        if(isset($_POST['email'])){
            $email = $_POST['email'];
            $subscriber = new \app\models\Subscriber();
            $subscriber->email = $email;
            if($subscriber->exists()){
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('You are already subscribed!');</script>";
                }else{
                    echo "<script>alert('Vous êtes déjà inscrit !');</script>";
                }
                
            } else {
                $subscriber->insert();
                $message = "Merci de vous être abonné à notre lettre d'information !";
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('Subscribed successfully!');</script>";
                }else{
                    $message = "Thank you for subscribing to our newsletter!";
                    echo "<script>alert('Abonnement réussi !');</script>";
                }
               
                $subject = "Newsletter Subscription";
               
                
                \app\models\Mailer::sendEmail($email, $subject, $message);
            }
    
            // Delay the redirection for 3 seconds (adjust as needed)
            echo "<script>setTimeout(function(){ window.location.href = '/Home'; }, 1);</script>";
            exit(); // Ensure that no further PHP code is executed after this point
        }
        header('location:/Home');
    }

    //admin can contact a user
    #[\app\filters\isAdmin]
    public function contactUser(){
        if(isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])) {
            $email = $_POST['email'];
            $subject = $_POST['subject'];
            $message = $_POST['message'];

            $exitCode = \app\models\Mailer::sendEmail($email, $subject, $message);
            if($exitCode == 0){
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('Message successfully sent!');</script>";
                }else{
                    echo "<script>alert('Message envoyé avec succès !');</script>";
                }
                
            } else {
                echo "<script>alert('L'envoi du message a échoué');</script>";
            }
        } 
        $this->view('Admin/contact');
    }

    //admin can contact all subscribers by posting a newsletter
    #[\app\filters\isAdmin]
    public function newsletter(){
        if(isset($_POST['subject']) && isset($_POST['message'])) {
            $subject = $_POST['subject'];
            $message = $_POST['message'];
            $initialization = new \app\models\Subscriber();
            $subscribers = \app\models\Subscriber::getAllEmails();
            $exitCode = \app\models\Mailer::sendEmailToMultipleRecipients($subscribers, $subject, $message);
            if($exitCode == 0){
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('Newsletter successfully sent!');</script>";
                }else{
                    echo "<script>alert('La lettre d'information a été envoyée avec succès !');</script>";
                }
              
            } else {  
                if($_SESSION['lang'] == 'en'){
                    echo "<script>alert('Newsletter failed to send');</script>";
                }else{
                    echo "<script>alert('La lettre d'information n'a pas été envoyée');</script>";
                }
               
            }
        } 
        $this->view('Admin/newsletter');
    }

    //admin can download a list of all subscribers
    #[\app\filters\isAdmin]
    public function downloadSubscribersList(){
        // Fetch all subscriber emails
        $initialization = new \app\models\Subscriber();
        $subscribers = \app\models\Subscriber::getAllEmails();
    
        // Open file for writing
        $file = fopen("subscribers.csv", "w");
    
        // Write header row
        fputcsv($file, ["Email"]);
    
        // Write each subscriber's email to the CSV file
        foreach($subscribers as $subscriber){
            // Assuming $subscriber is a string representing the email address
            fputcsv($file, [$subscriber]);
        }
    
        // Close the file
        fclose($file);
    
        // Set appropriate headers for download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=subscribers.csv');
    
        // Output the file contents to the response
        readfile("subscribers.csv");
    
        // Exit script
        exit();
    }

    //admin can download a list of all users
    #[\app\filters\isAdmin]
    public function downloadUserList(){
        // Fetch all registered emails
        $initialization = new \app\models\Customer();
        $customers = \app\models\Customer::getAllEmails();
    
        // Open file for writing
        $file = fopen("customers.csv", "w");
    
        // Write header row
        fputcsv($file, ["Email"]);
    
        // Write each subscriber's email to the CSV file
        foreach($customers as $customer){
            // Assuming $subscriber is a string representing the email address
            fputcsv($file, [$customer]);
        }
    
        // Close the file
        fclose($file);
    
        // Set appropriate headers for download
        header('Content-Type: application/csv');
        header('Content-Disposition: attachment; filename=customers.csv');
    
        // Output the file contents to the response
        readfile("customers.csv");
    
        // Exit script
        exit();
    }
    
    
}
?>
