<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="index.css">
</head>

<body>

    <?php
    include('DB.php');
    include('ip.php');
    $msg = '';
    $full_name = '';
    $phone = '';
    $email = '';
    $subject = '';
    $message = '';
    if (isset($_POST['submit'])) {
        $ip  = getIPAddress();
        $full_name = mysqli_real_escape_string($con, $_POST['full_name']);

        $phpne = mysqli_real_escape_string($con, $_POST['phone']);

        $email = mysqli_real_escape_string($con, $_POST['email']);

        $subject = mysqli_real_escape_string($con, $_POST['subject']);

        $message = mysqli_real_escape_string($con, $_POST['message']);

        $check_duplicate = mysqli_query($con, "SELECT * FROM contact_form WHERE full_name = '$full_name' and email = '$email' and phone = '$phone'");
        $count = mysqli_num_rows($check_duplicate);

        if ($count > 0) {
            $msg = "Data already exists";
        } else {
            if (!preg_match('/^[a-zA-Z\s]+$/', $full_name)) {
                $msg = "Enter valid Name";
            } elseif (!preg_match('/^[0-9+()-]{10}$/', $phone) && strlen($phone) >= 10 && empty($phone)) {
                $msg = "Enter valid Phone Number";
            } else if (!preg_match('/^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,}$/', $email)) {
                $msg = "Enter valid Email Address";
            } else {
                $query  = mysqli_query($con, "INSERT INTO contact_form (full_name,phone,email,subjects,messages,ip_add) VALUES('$full_name','$phone','$email','$subject','$message','$ip')");

                if ($query) {
                    $msg = "Data saved successfully";
                } else {
                    $msg = "Not Inserted";
                }
            }
        }
    }

    ?>
    <div class="container">
        <form action="" method="post">
            <div class="row">
                <h2 style="text-align: center; color: brown;">Contact Form</h2>
                <div>
                    <label for="">Full Name</label>
                    <input type="text" name="full_name" id="" placeholder="Enter FUll Name" value="<?php echo htmlentities($full_name) ?>">
                </div>

                <div>
                    <label for="">Phone Number</label>
                    <input type="number" name="phone" id="" placeholder="Enter Phone Number" value="<?php echo htmlentities($phone) ?>">
                </div>

                <div>
                    <label for="">Email</label>
                    <input type="email" name="email" id="" placeholder="Enter Email" value="<?php echo htmlentities($email) ?>">
                </div>

                <div>
                    <label for="">Subject</label>
                    <input type="text" name="subject" id="" placeholder="Enter Subject" value="<?php echo htmlentities($subject) ?>">
                </div>

                <div>
                    <label for="">Message</label>
                    <textarea name="message" id="" cols="30" rows="10"><?php echo htmlentities($message) ?></textarea>
                </div>

                <div>
                    <input type="submit" name="submit" value="submit">
                </div>

                <h3><?php if (isset($msg)) {
                    echo $msg;
                    
                }else {
                    unset($msg);
                }?></h3>
            </div>
        </form>
    </div>
</body>

</html>