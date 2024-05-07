<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

include_once __DIR__ . '/../model/Authentication.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/Exception.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/PHPMailer.php';
include_once __DIR__ . '/../vendor/PhpMailer/src/SMTP.php';

class AuthenticationController {
    private $auth;
    function __construct()
    {
        $this->auth = new Authentication();
    }

    public function createUser($name, $email, $password)
    {
        return $this->auth->createUser($name, $email, $password);
    }

    public function getUsers()
    {
        return $this->auth->getUsers();
    }

    public function getUser($id)
    {
        return $this->auth->getUser($id);
    }

    public function otpVerify($email)
    {
        $otp = rand(1000,9999);
   
        $mailer = new PHPMailer(true);

        $mailer->isSMTP();
        $mailer->Host = 'smtp.gmail.com';
        $mailer->SMTPAuth = true;
        $mailer->SMTPSecure = 'tls';
        $mailer->Port = 587;

        $mailer->Username = "simonzarni03@gmail.com";
        $mailer->Password = "uszj czrg zowg apxa";

        $mailer->setFrom("simonzarni03@gmail.com","Food Order");
        $mailer->addAddress($email);

        $mailer->IsHTML(true);
        $mailer->Subject = "Your account registration is in progress.";
        $mailer->Body = 'Your OTP code is '.$otp.'.';

        if ($mailer->send())
        {
            return $otp;
        }
    }
}

?>