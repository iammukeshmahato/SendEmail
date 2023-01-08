# Send Mail From Localhost using PHPmailer

### We will use gmail smtp server to send the mail.

### Requirements

1. [PHPmailer](#download-phpmailer)
1. [Gmail account setup for smtp](#setup-gmail-accocunt)

## Download PHPmailer

1. [click here](https://github.com/PHPMailer/PHPMailer/archive/refs/heads/master.zip) to download php mailer.
1. extract the downloaded zip file.
1. rename the extracted file from `PHPMailer-master` to `PHPMailer`.
1. copy the folder from downloaded location to the working directory.

## Setup Gmail Accocunt

1. First of all, we need to set two factor authentication for our gmail account.
   [click here](https://myaccount.google.com/security) to set two factor authentication.

1. Now create App password

   ![create app password](/img/img1.PNG)

1. click on on App Password. login to your account.

1. A window will open.

   ![app password](/img/img2.PNG)

1. from the select app menu, select other and give name as you want. I am giving it `PhpMailer`.

   ![select other](/img/img3.PNG)

1. click on `GENERATE` button.

   ![](/img/img4.PNG)

Window as above containing password will appear. copy the password and keep it safe for further use.

## Create a form to send email

```html
<title>Send Mail</title>
<link
   rel="stylesheet"
   href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
/>
<div class="container m-5 d-flex justify-content-center">
   <div class="col col-5">
      <?php
        session_start();
        if (isset($_SESSION['status']) && $_SESSION['status'] == "email sent successfully") { ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
         <strong>Successful!</strong> OTP successfully sent to
         <?php echo $_SESSION['email']; ?>
      </div>
      <?php unset($_SESSION['status']);
        }
        ?>
      <h1 class="text-center">New Email</h1>
      <form action="sendmail.php" method="POST">
         <div class="mb-3">
            <label for="email" class="form-label">To</label>
            <input
               type="email"
               class="form-control"
               id="email"
               name="email"
               aria-describedby="emailHelp"
            />
         </div>
         <div class="mb-3">
            <label for="subject" class="form-label">Subject</label>
            <input
               type="text"
               class="form-control"
               name="subject"
               id="subject"
               aria-describedby="helpId"
               placeholder=""
            />
         </div>
         <div class="mb-3">
            <label for="body" class="form-label">Body</label>
            <textarea
               class="form-control"
               name="body"
               id="body"
               rows="5"
            ></textarea>
         </div>
         <button type="submit" class="btn btn-primary" name="submit">
            send
         </button>
      </form>
   </div>
</div>
```

## Create a file to send mail.

In this case our file is `sendmail.php`.

```php
<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'PHPMailer/src/Exception.php';
    require 'PHPMailer/src/PHPMailer.php';
    require 'PHPMailer/src/SMTP.php';

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = "your-owm-email@gmail.com";  // your own email address from which you want to send email
    $mail->Password = "";   // your app password generated previously.
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    if (isset($_POST['submit'])) {

        $mail->setFrom('your-owm-email@gmail.com');   // your own email, same as the username
        $mail->addAddress($_POST['email']);     // getting email from form.
        $mail->isHTML(true);
        $mail->Subject = $_POST['subject'];     // getting subject form form
        $mail->Body = $_POST['body'];       // getting body from form
        $mail->send();

        $_SESSION['status'] = "email sent successfully";
        $_SESSION['email'] = $_POST['email'];
    } else {
        echo "Please try again";
    }
    header("location:index.php");
?>
```
