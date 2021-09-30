<div class="content-wrapper">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <div class="content-body" ng-controller="logoutController">

                <div class="row">
                    <div class="col-md-12" align="center">

                        <h2><?= __('Logout');?></h2>
                        
                        <p><?= __('Tem a certeza que pretende sair?');?></p>
                        
                        <p><button ng-click="doLogOut()" class="btn btn-primary"><?= __('Sim, pretendo sair');?></button> <a href="#/app/dashboard" class="btn btn-warning"><?= __('Não, vou continuar ligado');?></a></p>
                        
                    </div>

                </div>
            </div>
        </section>
    </div>
    
</div>