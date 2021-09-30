<div class="content-wrapper">
    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
        
        <section class="box ">
            <header class="panel_header">
                <h2 class="title pull-left"><?= __('Editar Informações Uteis');?></h2>
            </header>
            <div class="content-body" ng-controller="editController">

                <div class="row">
                    <div class="col-md-12">
                        
                        <div class="form-group wysiwyg">
                            <div class="">
                                <div class="btn-toolbar m-b-sm btn-editor" data-role="editor-toolbar" data-target="#editor">
                                    <div class="btn-group dropdown margin-left-0" uib-dropdown>
                                        <a class="btn btn-default btn-border" uib-dropdown-toggle uib-tooltip="Font"><i class="fa fa-font"></i><b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href data-edit="fontName Serif" style="font-family:'Serif'">Serif</a></li>
                                            <li><a href data-edit="fontName Sans" style="font-family:'Sans'">Sans</a></li>
                                            <li><a href data-edit="fontName Arial" style="font-family:'Arial'">Arial</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group dropdown" uib-dropdown>
                                        <a class="btn btn-default btn-border" uib-dropdown-toggle data-toggle="dropdown" uib-tooltip="Font Size"><i class="fa fa-text-height"></i>&nbsp;<b class="caret"></b></a>
                                        <ul class="dropdown-menu">
                                            <li><a href data-edit="fontSize 5" style="font-size:24px">Huge</a></li>
                                            <li><a href data-edit="fontSize 3" style="font-size:18px">Normal</a></li>
                                            <li><a href data-edit="fontSize 1" style="font-size:14px">Small</a></li>
                                        </ul>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-border" data-edit="bold" uib-tooltip="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="italic" uib-tooltip="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="strikethrough" uib-tooltip="Strikethrough"><i class="fa fa-strikethrough"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="underline" uib-tooltip="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-border" data-edit="insertunorderedlist" uib-tooltip="Bullet list"><i class="fa fa-list-ul"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="insertorderedlist" uib-tooltip="Number list"><i class="fa fa-list-ol"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="outdent" uib-tooltip="Reduce indent (Shift+Tab)"><i class="fa fa-dedent"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="indent" uib-tooltip="Indent (Tab)"><i class="fa fa-indent"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-border" data-edit="justifyleft" uib-tooltip="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="justifycenter" uib-tooltip="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="justifyright" uib-tooltip="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="justifyfull" uib-tooltip="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
                                    </div>
                                    <div class="btn-group dropdown" uib-dropdown>
                                        <a class="btn btn-default btn-border" uib-dropdown-toggle uib-tooltip="Hyperlink"><i class="fa fa-link"></i></a>
                                        <div class="dropdown-menu">
                                            <div class="input-group m-l-xs m-r-xs">
                                                <input class="form-control input-sm" id="LinkInput" placeholder="URL" type="text" data-edit="createLink" />
                                                <div class="input-group-btn">
                                                    <button class="btn btn-sm btn-default btn-border" type="button">Add</button>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="btn btn-default btn-border" data-edit="unlink" uib-tooltip="Remove Hyperlink"><i class="fa fa-cut"></i></a>
                                    </div>
                                    <div class="btn-group">
                                        <a class="btn btn-default btn-border" data-edit="undo" uib-tooltip="Undo (Ctrl/Cmd+Z)"><i class="fa fa-undo"></i></a>
                                        <a class="btn btn-default btn-border" data-edit="redo" uib-tooltip="Redo (Ctrl/Cmd+Y)"><i class="fa fa-repeat"></i></a>
                                    </div>
                                </div><br>
                                <div ui-jq="wysiwyg" id="html" class="form-control wysiwyg-editor" style="overflow:scroll;height:500px;max-height:500px">
                                    <?= $html; ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 margin-top-20">
                                <button type="button" ng-click="edit()" class="btn btn-success"><?= __('Actualizar Informações');?></button>
                            </div>
                        </div>
                        
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
    
</div>