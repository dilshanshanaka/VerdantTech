<?php include "includes/header.php" ?>   

    <div class="container" style="background: url(images/contact.jpg)">
        <div class="row justify-content-end">
            <div class="col-5 m-4 p-5 shadow-lg bg-white">
            <h1 class="text-danger font-weight-light pb-3">Contact Us</h1>
            <form method="POST" action="includes/mail.php">
                <div class="form-group row">
                    <label for="name" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" name="name" placeholder="Enter your name..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" name="email" placeholder="Enter your email..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="mobile" class="col-sm-2 col-form-label">Mobile</label>
                    <div class="col-sm-10">
                    <input type="text"  class="form-control" name="mobile" placeholder="Enter your mobile number..." required>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="message" class="col-sm-2 col-form-label">Message</label>
                    <div class="col-sm-10">
                    <textarea class="form-control" name="message" rows="3" placeholder="Enter your message..." required></textarea>
                    </div>
                </div>
                <button type="submit" class="btn btn-danger btn-block mt-4">Submit</button>
            </form>
            </div> 

        </div>
    </div>


<?php include "includes/footer.php" ?>   
