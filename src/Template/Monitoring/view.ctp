<div class='content-wrapper' ng-controller="viewController">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        
         <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">language</i> <?= __('Uso da API ( Geral )');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-4 col-sm-4 col-xs-4">
                        <div ui-jq="sparkline" ui-refresh="infoModel.apicalls.pie.data" ui-options="{{infoModel.apicalls.pie.data}}, {
                            type: 'pie',
                            width: '100%',
                            height: '200',
                            sliceColors: ['{{app.color.primary}}', '{{app.color.accent}}', '{{app.color.warning}}', '{{app.color.success}}'],
                            offset: 0,
                            borderWidth: 0,
                            borderColor: '#00007f',
                            tooltipFormat: '{\{offset:names\}} ({\{percent.0\}}%)',
                            tooltipValueLookups: {
                                names: {
                                    0: 'Apps',
                                    1: 'Veiculos',
                                    2: 'Terminais',
                                    3: 'Nenhum'
                                }
                            }
                            }" class="sparkline inline">Loading...
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-8">
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-counter bg-primary">
                                <div class="content">
                                    <i class="material-icons">apps</i>
                                    <h2 class="number_counter">{{infoModel.apicalls.pie.data[0]}}%</h2>
                                    <div class="clearfix"></div>
                                    <span><?= __('Apps');?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-counter bg-accent">
                                <div class="content">
                                    <i class="material-icons">directions_bus</i>
                                    <h2 class="number_counter">{{infoModel.apicalls.pie.data[1]}}%</h2>
                                    <div class="clearfix"></div>
                                    <span><?= __('Veiculos');?></span>
                                </div>
                            </div>
                        </div>
                       
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-counter bg-warning">
                                <div class="content">
                                    <i class="material-icons">dvr</i>
                                    <h2 class="number_counter">{{infoModel.apicalls.pie.data[2]}}%</h2>
                                    <div class="clearfix"></div>
                                    <span><?= __('Terminais');?></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="tile-counter bg-success">
                                <div class="content">
                                    <i class="material-icons">dvr</i>
                                    <h2 class="number_counter">{{infoModel.apicalls.pie.data[3]}}%</h2>
                                    <div class="clearfix"></div>
                                    <span><?= __('Outro');?></span>
                                </div>
                            </div>
                        </div>
                    
                    </div>
                </div>
            </div>
        </section>
        
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">language</i> <?= __('API - Calls / Seg ( Global ) ');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong><?= __('Actual');?></strong> {{infoModel.apicalls.global.cur}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Média');?></strong> {{infoModel.apicalls.global.avg}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Máximo');?></strong> {{infoModel.apicalls.global.max}}
                    </div>
                    <div class="col-md-12 margin-bottom-15">
                        &nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div ui-jq="sparkline" ui-refresh="infoModel.apicalls.global.data" ui-options="{{infoModel.apicalls.global.data}}, {
                            type: 'line',
                            width: '100%',
                            height: '200',
                            lineWidth: 2,
                            lineColor: '{{app.color.primary}}',
                            fillColor: 'rgba(132,127,159,0.5)',
                            highlightSpotColor: '{{app.color.accent}}',
                            highlightLineColor: '#FF6E40',
                            spotRadius: 4,
                            }" class="sparkline inline">Loading...
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">assignment</i> <?= __('Logs');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4><?= __('Eventos');?></h4>
                        
                        <div class=" table-responsive">
                            <table class="table table-striped" id="logsTable" ui-jq="dataTable" ui-options="dataTablesSetup('/monitoring/get/logs.json')" >
                                <thead>
                                    <tr>
                                        <th><?= __('Type');?> </th>
                                        <th><?= __('IP');?> </th>
                                        <th><?= __('Log');?></th>
                                        <th><?= __('Datetime');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> 
                        </div>

                    </div>
                </div>
            </div>
        </section>
        
    </div>
    
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">directions_bus</i> <?= __('API - Calls / Seg ( Veículos ) ');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong><?= __('Actual');?></strong> {{infoModel.apicalls.vehicles.cur}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Média');?></strong> {{infoModel.apicalls.vehicles.avg}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Máximo');?></strong> {{infoModel.apicalls.vehicles.max}}
                    </div>
                    <div class="col-md-12 margin-bottom-15">
                        &nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div ui-jq="sparkline" ui-refresh="infoModel.apicalls.vehicles.data" ui-options="{{infoModel.apicalls.vehicles.data}}, {
                            type: 'line',
                            width: '100%',
                            height: '200',
                            lineWidth: 2,
                            lineColor: '{{app.color.primary}}',
                            fillColor: '#197bff',
                            highlightSpotColor: '{{app.color.accent}}',
                            highlightLineColor: '#FF6E40',
                            spotRadius: 4,
                            }" class="sparkline inline">Loading...
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">apps</i> <?= __('API - Calls / Seg ( Apps ) ');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong><?= __('Actual');?></strong> {{infoModel.apicalls.apps.cur}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Média');?></strong> {{infoModel.apicalls.apps.avg}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Máximo');?></strong> {{infoModel.apicalls.apps.max}}
                    </div>
                    <div class="col-md-12 margin-bottom-15">
                        &nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div ui-jq="sparkline" ui-refresh="infoModel.apicalls.apps.data" ui-options="{{infoModel.apicalls.apps.data}}, {
                            type: 'line',
                            width: '100%',
                            height: '200',
                            lineWidth: 2,
                            lineColor: '#ff5727',
                            fillColor: '#ba324f',
                            highlightSpotColor: '{{app.color.accent}}',
                            highlightLineColor: '#FF6E40',
                            spotRadius: 4,
                            }" class="sparkline inline">Loading...
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">dvr</i> <?= __('API - Calls / Seg ( Terminais ) ');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-3">
                        <strong><?= __('Actual');?></strong> {{infoModel.apicalls.terminals.cur}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Média');?></strong> {{infoModel.apicalls.terminals.avg}} <?= __(' p/seg.');?>
                    </div>
                    <div class="col-md-3">
                        <strong><?= __('Máximo');?></strong> {{infoModel.apicalls.terminals.max}}
                    </div>
                    <div class="col-md-12 margin-bottom-15">
                        &nbsp;
                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div ui-jq="sparkline" ui-refresh="infoModel.apicalls.terminals.data" ui-options="{{infoModel.apicalls.terminals.data}}, {
                            type: 'line',
                            width: '100%',
                            height: '200',
                            lineWidth: 2,
                            lineColor: '{{app.color.primary}}',
                            fillColor: '#1cbdae',
                            highlightSpotColor: '{{app.color.accent}}',
                            highlightLineColor: '#FF6E40',
                            spotRadius: 4,
                            }" class="sparkline inline">Loading...
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left"><i class="material-icons">assignment</i> <?= __('Logs');?></h2>
            </header>
            <div class="content-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h4><?= __('Warnings & Erros ( Sistema )');?></h4>
                        
                        <div class=" table-responsive">
                            <table class="table table-striped" id="messagesTable" ui-jq="dataTable" ui-options="dataTablesSetup('/monitoring/get/messages.json')" >
                                <thead>
                                    <tr>
                                        <th><?= __('Type');?> </th>
                                        <th><?= __('IP');?> </th>
                                        <th><?= __('Log');?></th>
                                        <th><?= __('Datetime');?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table> 
                        </div>

                    </div>
                </div>
            </div>
        </section>
        
    </div>

</div>
