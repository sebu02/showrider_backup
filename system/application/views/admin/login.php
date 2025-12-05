<div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth" style="background: linear-gradient(to bottom, #e6e5f2, #90B2D8);padding-top:1px;">
        <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
                <div class="auth-form-light text-left p-5">

                    <div class="brand-logo" style="text-align:center;">
                        <img src="<?php echo base_url() . 'static/adminpanel/assets/'; ?>images/logo.png" style="max-width:91px;">
                    </div>

                    <!-- <h4> Welcome to Admin Panel</h4> -->

                    <h6 class="font-weight-light" style="text-align:center;">Sign in to Admin Panel</h6>

                    <form action="<?php echo base_url() . 'admin/login/'; ?>" method="post" class="pt-3" autocomplete="off">

                        <div class="form-group">
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" required>
                            
                            <span class="text-danger gl_span_error" style="font-size: 14px;">
                                <?php echo form_error('username'); ?>
                            </span>
                            
                        </div>

                        <div class="form-group">
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                            
                            <span class="text-danger gl_span_error" style="font-size: 14px;">
                                <?php echo form_error('password'); ?>
                            </span>
                            
                        </div>
                        <div class="mt-3">
                            <button class="btn btn-block btn-info btn-md font-weight-medium auth-form-btn" type="submit">Sign In</button>
                        </div>

                        <div class="text-center mt-3 font-weight-light">
                            <?php
                            if ($this->session->flashdata('message')) {
                                ?>
                                <p class="" style="color: #FF0000;">
                                    <strong><?php echo $this->session->flashdata('message'); ?></strong></p>

                                <?php
                            }
                            ?>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
</div>