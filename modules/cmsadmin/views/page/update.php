<style>
    .test {
        background-color:red; color:black; padding:20px
    }
</style>
<script type="text/ng-template" id="recursion.html">
    <div class="col s1">
        <div class="card blue lighten-5">
        <span>{{placeholder.label | uppercase}}</span>
        </div>
    </div>
    <div class="col s11">
        <div ng-repeat="(key, block) in placeholder.__nav_item_page_block_items" ng-controller="PageBlockEditController" data-drag="true" jqyoui-draggable="{onStart : 'onStart', onStop : 'onStop'}" data-jqyoui-options="{revert: true, handle : '.drag-icon', helper : 'clone'}" ng-model="block">
        <div ng-controller="DropBlockController" data-sortindex="{{key}}" ng-model="droppedBlock" data-drop="true" data-jqyoui-options="{greedy : true, tolerance : 'touch', hoverClass : 'test' }" jqyoui-droppable="{onDrop: 'onDrop()', multiple : true}"></div>
                    
        <div class="card" style="margin-bottom:5px; min-height:300px;">
            <div class="card-content" style="padding:10px;">
                <span class="card-title activator grey-text text-darken-4">{{block.name}} <i class="mdi-navigation-more-vert right"></i> <i class="mdi-content-select-all right drag-icon"></i></span>
                <div ng-bind-html="renderTemplate(block.twig_admin, data, cfgdata, block, block.extras)" />
            </div>
            <div class="card-reveal" style="z-index:999999;">
                <span class="card-title grey-text text-darken-4">{{block.name}} <i class="mdi-navigation-close right"></i></span>
                <form class="col s12">
                    <div class="row" ng-repeat="field in block.vars">
                        <zaa-injector dir="field.type" options="field.options" label="{{field.label}}" grid="12" model="data[field.var]"></zaa-injector>
                    </div>
                    <div ng-show="block.cfgs.length > 0">
                        <h5>Konfigurations Parameter</h5>
                        <div class="row" ng-repeat="cfgField in block.cfgs">
                            <zaa-injector dir="cfgField.type" options="cfgField.options" label="{{cfgField.label}}" grid="12" model="cfgdata[cfgField.var]"></zaa-injector>
                        </div>
                    </div>
                    <button type="button" ng-click="save()">Speichern</button>
                </form>
            </div>
            
        </div>
        <div>
            <div ng-show="block.__placeholders.length" class="card blue lighten-4">
                <div ng-repeat="placeholder in block.__placeholders" ng-controller="PagePlaceholderController" ng-include="'recursion.html'" class="row"></div>
            </div>
        </div>

        </div><!-- // CLOSEING ng-controller dropBlockController -->

        <div ng-controller="DropBlockController" ng-model="droppedBlock" data-sortindex="-1" data-drop="true" data-jqyoui-options="{greedy : true, tolerance : 'touch', hoverClass : 'test' }" jqyoui-droppable="{onDrop: 'onDrop()', multiple : true}">
            
        </div>
    </div>

</script>
<div ng-controller="NavController">
    <div class="row">
        <div class="col s12">
    
            <div class="toolbar [ grey lighten-3 ]">
                <div class="row">
                    <div class="col s12">
    
                        <!-- LEFT TOOLBAR -->
                        <div class="left">
    
                            <!-- LANGUAGE SWITCH -->
                            <div class="toolbar__group">
                                <a class="[ waves-effect waves-tale ][ btn-flat btn--small btn--bold ][ teal-text text-darken-2 ][ grey lighten-2 ]">DE</a>
                                <a class="[ waves-effect waves-tale ][ btn-flat btn--small btn--bold ][ teal-text text-darken-2 ][ grey lighten-2 ]">EN</a>
                                <a class="[ waves-effect waves-tale ][ btn-flat btn--small btn--bold ][ teal-text text-darken-2 ]">FR</a>
                            </div>
                            <!-- /LANGUAGE SWITCH -->
    
                            <!-- PLACEHOLDER TOGGLE -->
                            <div class="toolbar__group">
                                <div class="switch">
                                    <label>
                                        Platzhalter offen
                                        <input type="checkbox">
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                            <!-- /PLACEHOLDER TOGGLE -->
    
                        </div> <!-- /LEFT TOOLBAR -->
    
                        <!-- RIGHT TOOLBAR -->
                        <div class="right">
    
                            <!-- NAVIGATION DROPDOWN -->
                            <div class="toolbar__group">
                                <select class="browser-default">
                                    <option value="" disabled selected>Navigation</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <!-- /NAVIGATION DROPDOWN -->
    
                            <!-- SITE PLACEMENET -->
                            <div class="toolbar__group">
                                <select class="browser-default">
                                    <option value="" disabled selected>Seitenplatzierung</option>
                                    <option value="1">Option 1</option>
                                    <option value="2">Option 2</option>
                                    <option value="3">Option 3</option>
                                </select>
                            </div>
                            <!-- /SITE PLACEMENET -->
    
                            <!-- DELETE BUTTON -->
                            <div class="toolbar__group">
                                <a class="[ waves-effect waves-tale ][ btn-flat btn--small ][ grey-text text-darken-2 ]"><i class="mdi-action-delete"></i></a>
                            </div>
                            <!-- /DELETE BUTTON -->
    
                            <!-- VISIBILITY SWITCH -->
                            <div class="toolbar__group">
                                <div class="switch">
                                    <label>
                                        Sichtbar
                                        <input type="checkbox">
                                        <span class="lever"></span>
                                    </label>
                                </div>
                            </div>
                            <!-- /VISIBILITY SWITCH -->
    
                        </div>
                        <!-- /RIGHT TOOLBAR -->
    
                    </div>
                </div>
            </div>
    
        </div>
    </div>

    <div class="row">
        <div class="col s{{(12/langs.length)}}" ng-repeat="lang in langs" ng-controller="NavItemController">
            <div class="card-panel red lighten-1" ng-if="item.length == 0">
                <h6>{{lang.name}}</h6>
                <p>Diese Seite wurde noch nicht in {{lang.name}} übersetzt.</p>
            </div>
            <div class="card-panel" ng-if="item.length != 0">
                <h6>{{lang.name}}</h6>
                <h4>{{item.title}} <a class="btn-floating btn-large red right"><i class="large mdi-editor-mode-edit"></i></a></h4>

                <div ng-switch on="item.nav_item_type">
                    <div ng-switch-when="1" ng-controller="NavItemTypePageController"><!-- type:page -->
                        <div ng-repeat="placeholder in container.__placeholders" ng-controller="PagePlaceholderController" ng-include="'recursion.html'" class="row"></div>
                    </div>

                    <div ng-switch-when="2"><!-- type:module -->
                        <p><b>This page is used as Module!</b></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col s12" style="position: fixed; bottom:0px;">
            <div ng-controller="DroppableBlocksController">
                <div ng-repeat="block in blocks" style="display: inline-block;" data-drag="true" jqyoui-draggable="{placeholder: 'keep', index : {{$index}}, onStart : 'onStart', onStop : 'onStop'}" ng-model="blocks" data-jqyoui-options="{revert: true, helper : 'clone'}">
                    <span class="waves-effect waves-light btn light-blue darken-3" style="margin-right:5px; font-size:11px;">{{block.name}}</span>
                </div>
            </div>
        </div>
    </div>
</div>