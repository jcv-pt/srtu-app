<div class='content-wrapper'>
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Listagem de linhas');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="routesView" ng-controller="routesViewController">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <table class="table table-striped" id="routesTable" ui-jq="dataTable" ui-options="dataTablesSetup('/routes/get.json')" >
                            <thead>
                                <tr>
                                    <th width="5%"><?= __('Id');?> </th>
                                    <th width="30%"><?= __('Nome');?> </th>
                                    <th><?= __('Numero');?></th>
                                    <th><?= __('Cor');?></th>
                                    <th width="20%"><?= __('Acções');?></th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
