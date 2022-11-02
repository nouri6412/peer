<div class="container-fluid">
    <div class="container">
        <h2 class="text-center" id="title">Facundo farm and Resort</h2>
        <p class="text-center">
            <small id="passwordHelpInline" class="text-muted"> Developer: follow me on facebook <a href="https://www.facebook.com/JheanYu"> John niro yumang</a> inspired from <a href="https://p.w3layouts.com/">https://p.w3layouts.com/</a>.</small>
        </p>
        <hr>
        <div class="row">
            <div class="col-md-5 p-5 ">
                <hr>
                <form role="form">
                    <fieldset>
                        <p class="text-uppercase"> Login using your account: </p>

                        <div class="form-group">
                            <input type="email" name="log" id="log" class="form-control input-lg" placeholder="username">
                        </div>
                        <div class="form-group">
                            <input type="password" name="pwd" id="pwd" class="form-control input-lg" placeholder="Password">
                        </div>
                        <div>
                            <input type="submit" class="btn btn-md" value="Sign In">
                        </div>

                    </fieldset>
                </form>
            </div>
            <div class="col-md-2">
                <!-------null------>
            </div>
            <div class="col-md-5 p-5 ">
                <form role="form" method="post" id="signup_form">
                    <div style="display: none;" class="alert alert-danger"></div>
                    <fieldset>
                        <p class="text-uppercase pull-center"><?php echo __('SIGN UP', "whatsmess")  ?></p>
                        <div class="form-group">
                            <label for="username"><?php echo __('username', "whatsmess")  ?></label>
                            <input type="text" name="username" id="username" class="form-control input-lg" placeholder="username">
                        </div>

                        <div class="form-group">
                            <label for="email"><?php echo __('email', "whatsmess")  ?></label>
                            <input  name="email" id="email" class="form-control input-lg" placeholder="Email Address">
                        </div>
                        <div class="form-group">
                            <label for="password"><?php echo __('password', "whatsmess")  ?></label>
                            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="password2"><?php echo __('re password', "whatsmess")  ?></label>
                            <input type="password" name="password2" id="password2" class="form-control input-lg" placeholder="Password2">
                        </div>

                        <div>
                            <input type="submit" class="btn btn-md" value="Register">
                        </div>
                    </fieldset>
                </form>
            </div>

        </div>
    </div>
</div>