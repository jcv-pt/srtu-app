<div class='content-wrapper'>
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Adicionar Paragens');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="stopsEdit" ng-controller="stopsEditController" data-ng-init="init()">
                
                <div class="row">

                    <div class="col-md-3">

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
                            <div class="col-md-5">
                                <label class="form-label" for="field-1"><?= __('Latitude');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="lat" ng-model="postData.lat" type="text"  disabled>
                                </div>
                            </div>
                        </div>
 
                        <div class="row">
                            <div class="col-md-5">
                                <label class="form-label" for="field-1"><?= __('Longitude');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="lon" ng-model="postData.lon" type="text"  disabled>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="field-1"><?= __('Ordem');?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="sequence" ng-model="postData.sequence" type="text">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="field-1">&nbsp;</label>
                                <span class="desc"></span>
                                <div class="input-group" inputgroup>
                                    <select class="form-control input-lg" id="seq_ref" ng-model="postData.seq_ref" >
                                        <option value=""><?= __('escolher...');?></option>
                                        <option value="<?= __('top');?>"><?= __('Topo');?></option>
                                        <option value="<?= __('bottom');?>"><?= __('Fim');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label class="form-label" for="field-1"><?= __('Direcção');?></label>
                                <span class="desc"></span>
                                <div class="input-group" inputgroup>
                                    <select class="form-control input-lg" id="direction" ng-model="postData.direction" >
                                        <option value="<?= __('down');?>"><?= __('Ida');?></option>
                                        <option value="<?= __('up');?>"><?= __('Volta');?></option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" ng-click="submitPostData()" class="btn btn-success"><?= __('Adicionar Paragem');?></button>
                                <button type="button" ng-click="clearPostData()" class="btn btn-warning"><?= __('Limpar');?></button>
                            </div>
                        </div>
                            
                    </div>
                    
                    <div class="col-md-9">
                        
                        <div id="map_canvas" style="min-height:500px; width:100%;" ui-map="myMap" ui-event="{'map-click': 'addMarker($event, $params)', 'map-zoom_changed': 'setZoomMessage(myMap.getZoom())' }" ui-options="mapOptions">
                        </div>

                        
                    </div>
                
                </div>

            </div>
        </section>
    </div>

    <!-- Table results -->
    
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Paragens Existentes');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="stopsExisting" ng-controller="stopsExistController">

                <div class="row">
                     
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <table class="table table-striped" id="lineStopsTable" ui-jq="dataTable" ui-options="dataTablesSetup()" >
                            <thead>
                                <tr>
                                    <th style="width:5%"><?= __('Id');?> </th>
                                    <th style="width:30%"><?= __('Localização');?> </th>
                                    <th><?= __('Latitude');?></th>
                                    <th><?= __('Longitude');?></th>
                                    <th><?= __('Ordem');?></th>
                                    <th><?= __('Direcção');?></th>
                                    <th><?= __('Acções');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                        
                </div><!-- End Row -->
                
            </div>
        </section>
    </div>
    
</div>
