<!-- list -->
<ul class="wraplist wrapper-menu">

    <li ui-sref-active="active">
        <a ui-sref="app.dashboard" class="nosub">
            <i class="material-icons">dashboard</i>
            <span class="title"><?= __('Inicio');?></span>
        </a>
    </li>

    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">grid_on</i>
            <span class="title"><?= __('Linhas');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.routes.add"><?= __('Adicionar');?></a>
            </li>
            <li ui-sref-active="active">
                <a ui-sref="app.routes.manage"><?= __('Gerir');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto">
        <a href="javascript:;">
            <i class="material-icons">apps</i>
            <span class="title"><?= __('Paragens');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.stops.manage"><?= __('Gerir');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">looks</i>
            <span class="title"><?= __('Estações');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.seasons.add"><?= __('Adicionar');?></a>
            </li>
            <li ui-sref-active="active">
                <a ui-sref="app.seasons.manage"><?= __('Gerir');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">access_time</i>
            <span class="title"><?= __('Horários');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.schedules.manage"><?= __('Gerir');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">directions_bus</i>
            <span class="title"><?= __('Veiculos');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.vehicles.add"><?= __('Adicionar');?></a>
            </li>
            <li ui-sref-active="active">
                <a ui-sref="app.vehicles.manage"><?= __('Gerir');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">dvr</i>
            <span class="title"><?= __('Terminais');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.terminals.add"><?= __('Adicionar');?></a>
            </li>
            <li ui-sref-active="active">
                <a ui-sref="app.terminals.manage"><?= __('Gerir');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">info</i>
            <span class="title"><?= __('Informações Uteis');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.info.edit"><?= __('Editar');?></a>
            </li>
        </ul>
    </li>
    
    <li href class="auto"> 
        <a href="javascript:;">
            <i class="material-icons">memory</i>
            <span class="title"><?= __('Monotorização');?></span>
            <span class="arrow material-icons">keyboard_arrow_right</span>
        </a>
        <ul class="wraplist wraplist-sub wraplist wraplist-sub sub-menu dk dk">
            <li ui-sref-active="active">
                <a ui-sref="app.monitoring.view"><?= __('Ver');?></a>
            </li>
        </ul>
    </li>

</ul>
<!-- / list -->
