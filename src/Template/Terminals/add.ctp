<div class="content-wrapper">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Novo Terminal');?></h2>
            </header>
            <div class="content-body" ng-controller="addController">

                <div class="row">
                    <div class="col-md-6">
                        
                        <div class="row">
                            <div class="col-md-8">
                                <label class="form-label" for="field-1"><?= __('Descrição');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="name" ng-model="postData.name" type="text">
                                </div>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <label class="form-label" for="field-1"><?= __('Localização');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="location" ng-model="postData.location" type="text">
                                </div>
                            </div>    
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="field-1">&nbsp;</label>
                                <span class="desc"></span>
                                <div class="input-group" inputgroup>
                                    <select class="form-control input-lg" id="authorized" ng-model="postData.authorized" >
                                        <option value=""><?= __('escolher...');?></option>
                                        <option value="1"><?= __('Autorizado');?></option>
                                        <option value="0"><?= __('Não Autorizado');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 margin-top-20">
                                <button type="button" ng-click="add()" class="btn btn-success"><?= __('Adicionar Novo Terminal');?></button>
                            </div>
                        </div>
                        
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    
</div>