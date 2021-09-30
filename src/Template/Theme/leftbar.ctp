<!-- SIDEBAR - START -->
<!-- MAIN MENU - START -->
<perfect-scrollbar class="page-sidebar-wrapper" id="main-menu-wrapper" wheel-propagation="true" suppress-scroll-x="true" min-scrollbar-length="20" menuheight>
    <!-- USER INFO - START -->
    <div class="profile-info" ng-show="app.settings.menuProfile">
        <div class="profile-image col-md-12 col-sm-12 col-xs-12 text-center">
            <a ui-sref="app.ui.profile">
                <img src="data/profile/profile.png" class="img-responsive">
                <span class="profile-status available"></span>
            </a>
        </div>
        <div class="profile-details col-md-12 col-sm-12 col-xs-12">
            <h3>
                <a ui-sref="app.ui.profile"><?= $userData->name; ?></a>
            </h3>
        </div>
    </div>
    <!-- USER INFO - END -->
    <!-- nav -->

    <nav ui-nav ng-include="'theme/nav'"></nav>

    <!-- nav -->
    <div class="sidebar-graphs col-md-12">
        <h5>
            <?= __('Sessão');?>
            <span class="pull-right">{{100-app.session.timePer}}%</span>
        </h5>
        <uib-progressbar value="100-app.session.timePer" id="session_timeout" ng-class=" 100-app.session.timePer >=30 ? 'progress progress-sm success' : ( 100-app.session.timePer <30 &&  100-app.session.timePer >= 15 ? 'progress progress-sm warning' : 'progress progress-sm danger')"></uib-progressbar>
    </div>
</perfect-scrollbar>
<!-- MAIN MENU - END -->
<!--  SIDEBAR - END -->
