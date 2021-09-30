<div class='content-wrapper'>
    <div class="col-lg-12">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Listagem de Estações');?></h2>
            </header>
            <div class="content-body padding-bottom-15" id="view" ng-controller="viewController">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 table-responsive">
                        <table class="table table-striped" id="seasonsTable" ui-jq="dataTable" ui-options="dataTablesSetup('/seasons/get.json')" >
                            <thead>
                                <tr>
                                    <th style="width:5%"><?= __('Id');?> </th>
                                    <th style="width:30%"><?= __('Nome');?> </th>
                                    <th style="width:20%"><?= __('De');?></th>
                                    <th style="width:20%"><?= __('Até');?></th>
                                    <th style="width:15%"><?= __('Acções');?></th>
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
