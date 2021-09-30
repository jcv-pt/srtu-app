<div class='content-wrapper'>
    <section class="box nobox margin-top-15 margin-bottom-0" ng-controller="infoController">
        <div class="content-body">
            <div class="col-md-12 col-sm-12 col-xs-12 padding-right-30 padding-left-20">
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding-right-0 padding-left-0">
                    <div class="r4_counter wid-stats db_box">
                        <div class='stats-data'>
                            
                            <i class="material-icons icon-primary pull-left">account_balance</i>
                            <div class="stats">
                                <h3>{{infoModel.no_routes}}</h3>
                                <span><?= __('Linhas');?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding-right-0 padding-left-0">
                    <div class="r4_counter wid-stats db_box">
                        <div class='stats-data'>
                            <i class="material-icons icon-primary pull-left">start</i>
                            <div class="stats">
                                <h3>{{infoModel.no_vehicles}}</h3>
                                <span><?= __('Veiculos');?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding-right-0 padding-left-0">
                    <div class="r4_counter wid-stats db_box">
                        <div class='stats-data'>
                            <i class="material-icons icon-primary pull-left">stop</i>
                            <div class="stats">
                                <h3>{{infoModel.no_stops}}</h3>
                                <span><?= __('Paragens');?></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12 padding-right-0 padding-left-0">
                    <div class="r4_counter wid-stats db_box">
                        <div class='stats-data'>
                            
                            <i class="material-icons icon-primary pull-left">store_mall_directory</i>
                            <div class="stats">
                                <h3>{{infoModel.no_terminals}}</h3>
                                <span><?= __('Terminais');?></span>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </section>
    
    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Bem vindo!');?></h2>
            </header>
            <div class="content-body padding-top-45">
                <div class="row">
				
                    <h1><?= __('S.R.T.U.');?></h1>
                    <h2><?= __('Sistema de Rastreio de Transportes Urbanos');?></h2>
                    <p><?= __('Seja bem vindo, navegue por um dos menus...');?></p>

                </div>
            </div>
        </section>

        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Ficha Técnica');?></h2>
            </header>
            <div class="content-body padding-top-45">
                <div class="row">

                    <p><strong><?= __('Tipo:');?></strong> <?= __('Projecto final de curso (TFC)');?><br>
                    <strong><?= __('Instituto:');?></strong> <?= __('ISMAT - Instituto Superior Manuel Teixeira Gomes');?><br>
                    <strong><?= __('Coordenador:');?></strong> <?= __('Prof. Tiago Candeias');?></p>
                    <strong><?= __('Autor:');?></strong> <?= __('João Vieira - info@joao-vieira.pt');?></p>
                    <strong><?= __('Data:');?></strong><?= __('30-03-2017');?></p>
                    <p><strong><?= __('Descrição:');?></strong> <br>
                    <?= __('Realizado no ambito de projecto de final de curso (TFC) do curso de Engenharia Informática 16/17, esta aplicação é parte integrante do sistema de rastreio de veiculos de transportes urbanos.');?>
                    </p>
                </div>
            </div>
        </section>

    </div>
    
    <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
        <section class="box">
            <header class="panel_header">
                <h2 class="title pull-left">ISMAT @ 2017</h2>
            </header>
            <div class="content-body padding-top-45">
                <div class="row" align="center">
				
                    <img src="/img/ismat_logo.png">

                </div>
            </div>
        </section>
    </div>
	

</div>
