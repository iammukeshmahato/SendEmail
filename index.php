<title>Send Mail</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
<div class="container m-5 d-flex justify-content-center">
    <div class="col col-5">
        <?php
        session_start();
        if (isset($_SESSION['status']) && $_SESSION['status'] == "email sent successfully") { ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Successful!</strong> OTP successfully sent to <?php echo $_SESSION['email']; ?>
            </div>
        <?php unset($_SESSION['status']);
        }
        ?>
        <h1 class="text-center">New Email</h1>
        <form action="sendmail.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">To</label>
                <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" class="form-control" name="subject" id="subject" aria-describedby="helpId" placeholder="">
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <textarea class="form-control" name="body" id="body" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name='submit'>send</button>
        </form>
    </div>
</div>