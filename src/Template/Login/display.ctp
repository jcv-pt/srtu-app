<div class="login_page">
    <div class="login-wrapper" ng-controller="LoginFormController">
        <div id="login" ng-show="showLogin" class="login loginpage col-lg-offset-4 col-lg-4 col-md-offset-3 col-md-6 col-sm-offset-3 col-sm-6 col-xs-offset-2 col-xs-8">
            <h1><a href="#" title="Login Page" tabindex="-1">Slant Admin - Angular</a></h1>

            <form name="form" class="form-validation">

                <div class="text-danger text-center message" ng-show="authError">
                    <img src="{{authImg}}" ng-if="authImg" width="55" height="55">
                    <p>{{authError}}</p>
                </div>

                <p>
                    <input name="username" id="user_login" class="input" ng-model="user.username" placeholder="Username" required/></label>
                </p>
                <p>
                    <input type="password" name="pwd" id="user_password" class="input" ng-model="user.password" placeholder="Password" required/></label>
                </p>
                
                <p class="submit">
                    <button type="submit" ng-click="login()" ng-disabled='form.$invalid' class="btn btn-accent btn-block"><?= __('Log In');?></button>
                </p>
            </form>

        </div>
    </div>
</div>




