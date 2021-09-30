<div class='content-wrapper'>
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Visualizar Trajecto');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="stopsView" ng-controller="viewController" data-ng-init="init()">

                <div class="row margin-bottom-15">
                    <div class="col-md-2">
                        <h3><?= __('ID Linha');?></h3>
                        <p><strong>#{{lineNumber}}</strong></p>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Paragens');?></h3>
                        <p>{{numberStops}}</p>
                    </div>
                    <div class="col-md-2">
                        <h3><?= __('Total Km\'s');?></h3>
                        <p>{{totalKms!==undefined ? totalKms + ' Kms' : '<?= __('a calcular...');?>'}}</p>
                    </div>
                    <div class="col-md-3">
                        <h3><?= __('Tempo Estimado');?></h3>
                        <p>{{estimatedTime!==undefined ? estimatedTime + ' Minutos' : '<?= __('a calcular...');?>'}}</p>
                    </div>
                    <div class="col-md-3">
                        &nbsp;
                    </div>
                    <div class="col-md-12">
                        <hr></hr>
                    </div>
                </div>
                
                <div class="clearfix"></div>
                
                <div class="row">
                    <div class="col-md-12">
                        <div id="map_canvas" style="min-height:500px; width:100%;" ui-map="myMap" ui-options="mapOptions"></div>
                    </div>
                </div>
                
                <div class="row margin-top-15">
                    <div class="col-md-4">
                        <button onclick="$('#coords').toggle();" class="btn btn-default margin-bottom-15"><?= __('Mostrar Coordenadas do Trajecto');?></button>
                        <div id="coords" style="width:100%; height:350px; overflow:scroll; border:1px solid #ebebeb; display:none"></div>
                    </div>
                </div>


            </div>
        </section>
    </div>

    
</div>
