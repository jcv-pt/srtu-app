<div class="content-wrapper">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Nova Linha');?></h2>
            </header>
            <div class="content-body padding-bottom-0" ng-controller="routesAddController">
                <div class="row">
                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12">

                        <div class="row">
                            <div class="col-xs-12">
                                <div class="form-group">
                                    <label class="form-label" for="field-1"><?= __('Nome');?></label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input class="form-control" id="name" ng-model="routesData.name" type="text">
                                    </div>
                                <div>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-6">
                                <div class="form-group">
                                    <label class="form-label" for="field-1"><?= __('Numero');?></label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input class="form-control" id="number" ng-model="routesData.number" type="text">
                                    </div>
                                <div>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="form-group">
                                    <label class="form-label" for="field-1"><?= __('Cor');?></label>
                                    <span class="desc"></span>
                                    <div class="controls">
                                        <input type="color" class="form-control" id="color" ng-model="routesData.color" value="#ff0000">
                                    </div>
                                <div>
                            </div>    
                        </div>
                        
                        <div class="row">
                            <div class="form-group">
                                <button type="button" ng-click="addRoute()" class="btn btn-success"><?= __('Adicionar Nova Linha');?></button>
                            </div>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
        </section>
    </div>
    
</div>