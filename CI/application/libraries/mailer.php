<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailer{

    function sendMail($email_subject,$email_body,$smtp_email_to){
        include_once("PHPMailer/class.smtp.php");       // 引入php邮件类
        include_once("PHPMailer/class.phpmailer.php");      // 引入php邮件类
        $mail= new PHPMailer();
        $mail->CharSet = "utf-8";                // 编码格式
        $mail->IsSMTP();
        $mail->SMTPAuth   = true;                   // 必填，SMTP服务器是否需要验证，true为需要，false为不需要
        $mail->Host       = "smtp.qq.com";         // 必填，设置SMTP服务器
        $mail->Port       = 465;                     // 设置端口
        $mail->Username   = "2820644688@qq.com";           // 必填，开通SMTP服务的邮箱；
        $mail->Password   = "iefvdznrvexydfia";         // 必填， 以上邮箱对应的密码
        $mail->SMTPSecure = 'ssl';                 //传输协议
        $mail->From       = "2820644688@qq.com";       // 必填，发件人Email
        $mail->FromName   = "ONELibrary System";             // 必填，发件人昵称或姓名
        $mail->Subject    = $email_subject;          // 必填，邮件标题（主题）

        $mail->MsgHTML($email_body);             //邮件内容
        $mail->AddReplyTo($smtp_email_to);           // 收件人回复的邮箱地址
        $mail->AddAddress($smtp_email_to);      // 收件人邮箱
        $mail->IsHTML(true);                 // 是否以HTML形式发送，如果不是，请删除此行

        return $mail->Send();

    }
}