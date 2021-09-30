<div class='content-wrapper' id="manageSchedules" ng-controller="manageSchedulesController" >
    <div class="col-lg-5">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Novo Horário'); ?></h2>
            </header>
            <div class="content-body padding-bottom-15">

                <div class="row">

                    <div class="col-md-12">

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="field-1"><?= __('Hora'); ?></label>
                                <span class="desc"></span>
                                <div class="controls">
                                    <input class="form-control" id="time" ng-model="postData.schedule" type="text">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="form-label" for="field-1"><?= __('Estação'); ?></label>
                                <span class="desc"></span>
                                <div class="input-group" inputgroup>
                                    <select class="form-control input-lg" id="season_id" ng-model="postData.season_id" >
                                        <option value=""><?= __('escolher...'); ?></option>
                                        <?php foreach ($seasons as $season): ?>
                                            <option value="<?= $season->id; ?>"><?= $season->name; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <button type="button" ng-click="submitPostData()" class="btn btn-success"><?= __('Adicionar Horário'); ?></button>
                                <button type="button" ng-click="clearPostData()" class="btn btn-warning"><?= __('Limpar'); ?></button>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </section>
    </div>

                    
    <div class="col-lg-7">
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Gerir Horários'); ?></h2>
            </header>
            <div class="content-body padding-bottom-15" >
                
                    <div class="col-md-12">

                        <div class="row">

                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <table class="table table-striped" id="schedulesTable" ui-jq="dataTable" ui-options="dataTablesSetup()" >
                                    <thead>
                                        <tr>
                                            <th style="width:5%"><?= __('Id'); ?> </th>
                                            <th style="width:30%"><?= __('Horário'); ?> </th>
                                            <th><?= __('Estação'); ?></th>
                                            <th><?= __('Acções'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>

                        </div><!-- End Row -->


                    </div>
                
                    <div class="row">
                        <div class="col-md-12"> &nbsp;</div>
                    </div>

                </div>

            </div>
        </section>
    </div>

</div>