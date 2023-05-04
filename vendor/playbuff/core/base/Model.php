<?php
namespace playbuff\base;

use playbuff\Db;
use Valitron\Validator;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Model 
{
    public $attributes = [];
    public $errors = [];
    public $rules = [];
    public $db;
    public $mailer;

    public function __construct()
    {
        $this->db = Db::instance();
    }

    public function load($data)
    {
        foreach($this->attributes as $k => $v) {
            if (isset($data[$k])) {
                $this->attributes[$k] = $data[$k];
            }
        }
    }

    public function save($tableName)
    {
        $table = \R::dispense($tableName);
        foreach($this->attributes as $k => $v) {
            $table->$k = $v;
        }
        return \R::store($table);
    }

    public function validate($data)
    {
        $v = new Validator($data);

        $v->rules($this->rules);
        
        if ($v->validate()) {
            return true;
        }

        $this->errors = $v->errors();
        return false;
    }

    public function getErrors()
    {
        $errors = "<ul>";
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>" . $item . "</li>";
            }
        }
        $errors .= "</ul>";
        return $errors;
    }

    public static function sendMail($userEmail, $smtpEmail, $smtpPass, $smtpHost, $subject, $html) 
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $smtpHost;
            $mail->SMTPAuth = true;
            $mail->Username = $smtpEmail;
            $mail->Password = $smtpPass;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;
        
            $mail->CharSet = "UTF-8";
            $mail->setLanguage('ru', "phpmailer/language/");

            $mail->setFrom($smtpEmail, 'PlayBuff.ru');
            $mail->addAddress($userEmail);
         
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $html;
        
            $mail->send();
            return true;
            
        } catch (\Exception $e) {
            return false;
        }
    }

}

?>