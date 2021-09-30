<div class='content-wrapper'>
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Visualizar Veiculo');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="vehiclesPosition" ng-controller="positionController" data-ng-init="init()">

                <div class="row ">
                    <div class="col-md-12">
                        <p>Veiculo</p>
                        <h2>{{vehicleDetails.name!==undefined ? vehicleDetails.name : '<?= __('a carregar...');?>'}} {{vehicleDetails.plate!==undefined ? '(' + vehicleDetails.plate + ')' : ''}}</h2>
                    </div>
                    <div class="col-md-12 margin-bottom-15">
                        <hr>
                    </div>
                </div>
                
                <div class="row margin-bottom-15">
                    <div class="col-md-2">
                        <h3><?= __('Linha');?> ({{routeNumber}})</h3>
                        <p>
                            <input type="color" value="{{routeColor}}" disabled></input>
                        </p>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Sentido');?></h3>
                        <p>{{locationDetails.direction!==undefined ? (locationDetails.direction == 'down' ? '<?= __('Ida');?>' : '<?= __('Volta');?>') : '<?= __('a carregar...');?>'}}
                        <img ng-if="locationDetails.direction == 'down'" src="/img/down.png" />
                        <img ng-if="locationDetails.direction == 'up'" src="/img/up.png"  /></p>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Paragens');?></h3>
                        <p>{{numberStops!==undefined ? numberStops : '<?= __('a carregar...');?>'}}</p>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Total Km\'s');?></h3>
                        <p>{{totalKms!==undefined ? totalKms + ' Kms' : '<?= __('a calcular...');?>'}}</p>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Velocidade Actual');?></h3>
                        
                        <uib-progress ng-if="locationDetails.speed!==undefined">
                            <uib-bar value="locationDetails.speed*100/50" type="{{ locationDetails.speed <= 40 ? 'success' : 'danger'}}"><span>{{locationDetails.speed}} Km/h</span></uib-bar>
                        </uib-progress>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Tempo Estimado');?></h3>
                        <p>{{estimatedTime!==undefined ? estimatedTime + ' Minutos' : '<?= __('a calcular...');?>'}}</p>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="map_canvas" style="min-height:500px; width:100%;" ui-map="myMap" ui-options="mapOptions"></div>
                    </div>
                </div>

            </div>
        </section>
    </div>

    
</div>
