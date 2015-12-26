<?php  include "includes/db.php"; ?>
<?php  include "includes/header.php"; ?>

<!-- Navigation -->

<?php  include "includes/nav.php"; ?>

<?php


if(isset($_POST['c_submit'])){
   $to = "tamal@crypticbd.com";
    $subject = wordwrap($_POST['c_subject'], 70);
    $body = $_POST['c_body'];
    $header = "From:" . $_POST['c_email'];
}

mail($to, $subject, $body, $header);

?>
<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Contact</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="c_email" id="c_email" class="form-control" placeholder="Enter Your Email">
                            </div>
                            <div class="form-group">
                                <label for="subject" class="sr-only">Subject</label>
                                <input type="text" name="c_subject" id="c_subject" class="form-control" placeholder="Enter Suject">
                            </div>
                            <div class="form-group">
                                <textarea name="c_body" id="" cols="30" rows="10" class="form-control"></textarea>
                            </div>

                            <input type="submit" name="c_submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Submit">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php";?>
