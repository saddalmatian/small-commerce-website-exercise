<?php
include '../config/dbconnection.php';
firstStep();

if (!isset($_SERVER["HTTP_X_REQUESTED_WITH"]))
    header('location:../main.php');
else
    echo "<footer class='text-center text-lg-start bg-light text-muted'>
    <section class='d-flex justify-content-center justify-content-lg-between p-4 border-bottom'>
    </section>
    <section class=''>
        <div class='container text-center text-md-start mt-5'>
            <div class='row mt-3'>
                <div class='col-md-3 col-lg-4 col-xl-3 mx-auto mb-4'>
                    <h6 class='text-uppercase fw-bold mb-4'>
                        <i class='fas fa-gem me-3'></i>Company name
                    </h6>
                    <p>
                        Here you can use rows and columns to organize your footer content. Lorem ipsum
                        dolor sit amet, consectetur adipisicing elit.
                    </p>
                </div>
                <div class='col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4'>
                    <!-- Links -->
                    <h6 class='text-uppercase fw-bold mb-4'>
                        Contact
                    </h6>
                    <p>
                        <i class='fas fa-envelope me-3'></i>
                        gianghoatran09@gmail.com
                    </p>
                    <p><i class='fas fa-phone me-3'></i> + 84 914 764 104</p>
                    <p><i class='fas fa-phone me-3'></i> + 84 948 764 104</p>
                </div>
            </div>
        </div>
    </section>
</footer>";
?>