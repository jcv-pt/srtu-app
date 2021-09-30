<div class="content-wrapper">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Nova Estação');?></h2>
            </header>
            <div class="content-body" ng-controller="addController">

                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="field-1"><?= __('Nome');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="name" ng-model="postData.name" type="text">
                                </div>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label" for="field-1"><?= __('A partir de');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="date_from" ng-model="postData.date_from" type="text">
                                </div>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <label class="form-label" for="field-1"><?= __('Até');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="date_to" ng-model="postData.date_to" type="text">
                                </div>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-md-12 margin-top-20">
                                <button type="button" ng-click="add()" class="btn btn-success"><?= __('Adicionar Nova Estação');?></button>
                            </div>
                        </div>
                        
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    
</div>