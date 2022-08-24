<div class="container">
    <!-- Outer Row -->
        <div class="row justify-content-center">
            <div class="col-lg-6 mb-3 mt-5">
                <div class="card o-hidden border-0 mx-auto mt-5">
                    <div class="card-body p-3">
                        <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg md-3">
                                    <div div class="p-5 mt-2">
                                        <div class="text-center">
                                            <h1 class="h2 text-gray-900 mb-4">Login</h1>
                                    </div>

                                        <?= $this->session->flashdata('message'); ?>

                                    <form class="user" method="post" action="<?= base_url('auth'); ?>">
                                    <div class="form-group">
                                            <input type="text" class="form-control form-control-user" id="email" name="email"
                                            placeholder="Enter Email Address..." value="<?= set_value('email'); ?>">
                                            <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>
                                        </div>
                                    <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password" name="password" 
                                            placeholder="Password">
                                            <?= form_error('password', '<small class="text-danger pl-3">', '</small>'); ?>
                                    </div>
                                        <button type="submit" class="btn btn-primary btn-user btn-block">Login</button>                                 
                                    </form>
                                    </hr>
                                    <hr>
                             
                                    <div class="text-center">
                                        <a class="smail" href="forgot-password.html">Forgot Password?</a>
                                    </div>
                                    <div class="text-center">
                                        <a class="smail" href="<?= base_url('auth/registration') ?>">Create an Account</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
         </div>
    </div>