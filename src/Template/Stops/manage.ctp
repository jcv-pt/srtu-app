<div class='content-wrapper'>
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Listagem de linhas');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="stopsManage" ng-controller="stopsManageController">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <table class="table table-striped" id="routesTable" ui-jq="dataTable" ui-options="dataTablesSetup('/stops/get/routes.json')" >
                            <thead>
                                <tr>
                                    <th style="width:30%"><?= __('Linha');?> </th>
                                    <th><?= __('Numero');?></th>
                                    <th><?= __('Cor');?></th>
                                    <th style="width:30%"><?= __('Acções');?></th>
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
