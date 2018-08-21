/**
 * !! It inititates itself as: var objCiRegister at the line line of this js file,
 * use ObjEditor.setup();
 */

    function ObjEditor ( sCallbackName ){
        this.callback_name = sCallbackName;
        this.url_block = "/api/block/create/token/ajax";
        this.url_content = "/api/content/edit/token/ajax";
        this.data_area_identifier_attr_name = "data-area-identifier";
        this.togglePathInfoNewClass = 'editor-paths-show-';
        this.defaultEditMode = 'inline';

        this.plugins = {};

        this.plugins.ajax = new Ajax(this.callback_name);

        this.dataIdentifier = 'data-uid';
    }

    ObjEditor.prototype.getCallbackName = function(){
        return this.callback_name;
    }
    ObjEditor.prototype.setEventAttribute = function(sElementSelector,sEvent,sCallback,iPropagation){
        iPropagationReturn = (iPropagation===1)?'return false;':'';
        var normalized_event_name = sEvent.charAt(0).toUpperCase() + sEvent.slice(1); // normalize event name, so its ucfirst
        jQuery(sElementSelector).attr('on' + normalized_event_name,this.getCallbackName() + '.' + sCallback + '($(this),' + iPropagation + ');'+iPropagationReturn);
    }
    ObjEditor.prototype.setup = function(){
        $('.tooltip').css('display', 'block');
        $('.tooltip').animate({ opacity: 0 }, 0);
        // console.log("ObjEditor.setup");
        this.setEventAttribute('.menu-item-add-block','click','toggleBlockMenu',0);

        this.setEventAttribute('.menu-item.menu-item-area','click','togglePathInfo',0);
        this.setEventAttribute('.menu-item.menu-item-block','click','togglePathInfo',0);

        localStorage.clear();

        //
        this.setEventAttribute('.navbar-nav .menu-item-content','click','togglePathInfo',0);

        this.setEventAttribute('body','load','addAdminClass',0);
    }
    ObjEditor.prototype.togglePathInfo = function(jqObject){
        // assign mode
        var type = jqObject.attr("data-item-type");
        var newClass = this.togglePathInfoNewClass + type;
        $('body').toggleClass(newClass);
        return this.editMode(type);
    } // this.setEventAttribute
    ObjEditor.prototype.editItem = function(jqObject) {
        var uid = jqObject.parent("[data-content-identifier]").attr("data-content-identifier");
        this.url_content
        var url = this.url_content.replace("token", uid);
        $.get( url, function( data ) {
            $(data).find('form').attr('action',url);
            $(".modal-body")
                .append( data );
        }, "html" );
      //  console.log(uid);
    };

    /**
     *
     * @param type
     */
    ObjEditor.prototype.addItem = function(block_type) {
        var url = this.url_block.replace("token", block_type);
        $.get( url, function( data ) {
            $(data).find('form').attr('action',url);
            console.log(data);
            $(".modal-body")
                .append( data );
        }, "html" );

        return;
    };
    ObjEditor.prototype.addAdminClass = function(){
        $('body').addClass("role-administrator");
    };
    /**
     *
     */
    ObjEditor.prototype.makeBlocksDraggable = function(){
        $('.drag-item').draggable({
            cursor: 'move',
            helper: "clone"
        });
    }
    ObjEditor.prototype.editItemInline = function(jqObject) {

        console.log(jqObject.attr('contentEditable'));

        if(jqObject.attr('contentEditable') === 'true') {

            // check if content changed

            jqObject.attr('contentEditable','false');
        } else {
            jqObject.attr('contentEditable','true');
        }

    }
    ObjEditor.prototype.toggleContentEditable = function(jqObject) {

        console.log(jqObject.attr('contentEditable'));

        if(jqObject.attr('contentEditable') === 'true') {

            // check if content changed

            jqObject.attr('contentEditable','false');
        } else {
            jqObject.attr('contentEditable','true');
        }

    }

    ObjEditor.prototype.scanStorageChanges = function(jqObject) {

        var allItems = localStorage;


        for (i = 0; i < localStorage.length; i++) {
            var key = localStorage.key(i);

            var localItem = localStorage.getItem(key);


            if( typeof localItem.type !== typeof undefined && localItem.type==='content') {

                var item = JSON.parse(JSON.stringify(localStorage.getItem(key)));

                $('#form-fixed-save-observer').removeClass('hidden');
            }else {
                console.log(localItem);
            }

        }

    }
    ObjEditor.prototype.editContent = function(jqObject) {


        console.log('check if content is loaded from the server into localStorage');
        console.log('if not loaded load it now.');
        console.log('if loaded compare the original with current');

    }

    ObjEditor.prototype.storeContent = function(jqObject) {

        var currentItemUid = jqObject.attr(this.dataIdentifier);

        var storageItems = JSON.parse(localStorage.getItem('content'));

        console.log(storageItems);

        for (var i = 0; i < storageItems.length; i++) {

            var item = storageItems[i] ;

            console.log(item);

        }

        return;

        var original = localStorage.getItem("content-" + currentItemUid);

        originalJSON = JSON.parse(original);

        var current = jqObject.text();

        if(originalJSON.original!==current) {

            original.current = current;

            var storageItem = '{"uid":"'+currentItemUid+'","original":"'+originalJSON.original+'","type":"content","current":"'+current+'"}';

            storageItem2 = JSON.parse(JSON.stringify(storageItem));

            localStorage.setItem("content-" + currentItemUid,storageItem2);

            console.log('diff');
        } else {
            console.log('same');

            var storageItem = '{"uid":"'+currentItemUid+'","original":"'+originalJSON.original+'","type":"content"}';

            storageItem2 = JSON.parse(JSON.stringify(storageItem));

            // localStorage.setItem("content-" + currentItemUid,storageItem2);

            // localStorage.removeItem("content-" + currentItemUid);
        }

        this.scanStorageChanges(jqObject);

    }

    ObjEditor.prototype.saveContent = function(jqObject) {

        var dataIdentifier = 'data-uid';

        if(localStorage.getItem("content-" + jqObject.attr(dataIdentifier)) !== jqObject.text()) {
            console.log('changed');


            this.plugins.ajax.postData(this.url_content,jqObject.text())


        } else {
            // console.log(localStorage.getItem(jqObject.attr(dataIdentifier)));
            // console.log('same');
            // console.log(jqObject.text());
        }
        // localStorage.setItem(jqObject.attr(dataIdentifier), currentItem.innerHTML);

    }

/**
 * Find every element with predefined data type (area,block,content)
 *
 * @param type
 */
ObjEditor.prototype.editMode = function(type) {
    // default if argument not set for `mode`
    // if (typeof mode === 'undefined' || $.inArray(mode,getModeTypes())) { mode = 'block'; }

    console.log("Action edit `" + type + "` has been triggered");

    var itemIdentifier = '[data-type="' + type + '"][data-wrapper="main"]';

    // var obj = objDataClient.getDeveloperPathData(type);

    var len = $(itemIdentifier).length;

    var forLocal = {"content":{}};

    if (len > 0) {



        for (i = 0; i < len; i++) {

            var currentItem = $(itemIdentifier).eq(i);
            var currentItemAttributeValue = currentItem.attr(this.dataIdentifier);
            var uid = currentItemAttributeValue;

            console.log();

            // Make every content editable.
            if(this.defaultEditMode=='inline' && $('#content-update-mode-switch input[type="checkbox"]').attr('checked')==='checked') {

                var currentItemUid = currentItemAttributeValue;

                if(currentItem.attr('data-content-type')==='text') {
                    currentItem.attr('contentEditable','true');
                    this.setEventAttribute(currentItem,'keyup','editContent');
                }



                var storageItem = {};
                storageItem.uid = currentItemUid;
                storageItem.type = type;
                storageItem.original = 55;

                console.log(currentItem.text());

                forLocal.content[currentItemUid] = storageItem;

                // storageItem = JSON.parse(JSON.stringify(storageItem));

                // localStorage.setItem("content-" + currentItemUid, storageItem);



            } else {
                if ("undefined" !== typeof(currentItemAttributeValue)) {

                    currentItem.addClass("border-" + type);

                    $span = $("<span>", {
                        id: "foo-" + type + "-" + i,
                        class: "frontbox-dev-" + type + "-attr"
                    });
                    //.text(uid);
                    var $e = $("<div>", {
                        id: "foo-" + type + "-" + i,
                        class: "frontbox-dev-" + type + "-attr-wrapper"
                    });
                    var $glyphicon = $("<span>edit", {class: "glyphicon glyphicon-edit", "aria-hidden": "true","data-toggle":"modal","data-target":".exx"});
                    $span.prepend($glyphicon);
                    $e.append($span);
                    currentItem.append($e);
                    this.setEventAttribute("#foo-" + type + "-" + i,"click","editItem");
                };
            }

            // localStorage.setItem("content", JSON.stringify(forLocal));

        };




        var $modal = $("<div>",{
            class:"exx modal fade",
            role:"dialog",
            tabindex:"-1"
        }).html('<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body">Hello World</div></div></div>');
        $('.no-display').prepend($modal);
    };
};

    /**
     *
     */
    ObjEditor.prototype.makeAreasDroppable = function(){

        var dataAreaIdentifierAttrName = this.data_area_identifier_attr_name;

        $("[data-area-identifier]").droppable({
            hoverClass: "ui-state-hover",
            drop: function(event, ui) {
                // determine dragged block type
                var block_type = $(event.originalEvent.toElement).eq(0).parent().find(".block-type").eq(0).attr("value");

                if("undefined"!==typeof(block_type)){
                    // append block placeholder to the selected area
                    var $blockPlaceholder = $("<div>",{
                        class:"block-placeholder",
                        tabindex:"-1"
                    }).html('<div><strong>__PLACEHOLDER__</strong> for `'+block_type+'` <span onClick="javascript:$(this).parents(\'.block-placeholder\').eq(0).remove();"><strong>remove</strong></span>'
                        + '<span>'
                        + '<span class="glyphicon glyphicon-resize-vertical" aria-hidden="true"></span>'
                        + '<strong>sort</strong></span></div>');

                    $($blockPlaceholder).appendTo($(this));

                    // make block sortable
                    $(this).sortable();
                    $( this ).disableSelection();

                    objEditor.addItem(block_type);

                    var $modal = $("<div>",{
                        class:"exx modal fade in",
                        role:"dialog",
                        tabindex:"-1"
                    }).html('<div class="modal-dialog block" role="document"><div class="modal-block"><div class="modal-body">Get form for '+block_type+'</div></div></div>');
                    //$('body').append($modal);
                    $($modal).appendTo('body');
                    $('.modal.fade.in').modal()
                }

                var ij = 0;
/*
                $('.drag-item').each(function(ij) {

                    var block_type = $('.drag-item').eq(ij).find(".block-type").eq(0).attr("value");

                    console.log(block_type);

                    // append to area
                    console.log(itemid.attr('class'));

                    if ($(this).find(".block-type").eq(0).attr("value") === block_type) {

                        // trigger add action frm same object
                        objEditor.addItem(block_type);
                        var $modal = $("<div>",{
                            class:"exx modal fade in",
                            role:"dialog",
                            tabindex:"-1"
                        }).html('<div class="modal-dialog block" role="document"><div class="modal-block"><div class="modal-body">Get form for '+block_type+'</div></div></div>');
                        //$('body').append($modal);
                        $($modal).appendTo('body');
                        $('.modal-dialog.block').parent('div').eq(0).modal('show');
                        var $blockPlaceholder = $("<div>",{
                            class:"block-placeholder",
                            tabindex:"-1"
                        }).html('<div>Get form for '+block_type+'</div>');
                        //$('body').append($modal);

                        console.log($('[' + dataAreaIdentifierAttrName + ']').eq(0).attr(dataAreaIdentifierAttrName));

                        // $($blockPlaceholder).appendTo($('[' + dataIdentifier + ']').eq(i));
                        console.log(i);
                        $($blockPlaceholder).appendTo(itemid);

                    }
                    ij++;
                });
*/



                //   console.log("Dropped to " + currentItemAttributeValue);

            }
        });
    }

    /**
     * Controls visibility of block menu.
     * Also it scans the `Block Menu` in order to find available blocks,
     *      then it makes each `available-block-item` draggable
     *
     *      then it scans for available areas on the page in order to make each `droppable` with the `drop` callback
     *          Areas are identified by attribute `data-area-identifier`
     *          For each area it sets `jquery-ui-droppable` with the `drop` callback
     */
    ObjEditor.prototype.toggleBlockMenu = function(){
        $('.menu-item-add-block').toggleClass("active");
        // display the menu
        $('#menu-editor-blocks-side').css('display', 'block')
            .animate({ opacity: 0 }, 0)
            .animate({opacity:1,width:"350px"},'fast')
        ;

        // turn edit mode for the `areas`
        objDeveloper.editMode("area");

        // make blocks draggable
        this.makeBlocksDraggable();

        // make areas droppable
        this.makeAreasDroppable();

        return;

        // default if argument not set for `mode`
        var dataAreaIdentifierAttrName = this.data_area_identifier_attr_name;

        //var obj = objDataClient.getDeveloperPathData(type);

        var len = $('[' + this.data_area_identifier_attr_name + ']').length;

        if (len > 0) {
            for (i = 0; i < len; i++) {
                var currentArea = $('[' + this.data_area_identifier_attr_name + ']').eq(i);

                console.log($(currentArea).attr('class'));

                var currentItemAttributeValue = currentArea.attr("data-area-identifier");
                var uid = currentItemAttributeValue;

                if ("undefined" !== typeof(currentItemAttributeValue)) {

                    $("[data-area-identifier]").droppable({
                        hoverClass: "ui-state-hover",
                        drop: function(event, ui) {
                            var itemid = $(event.originalEvent.toElement).eq(0);
                            var ij = 0;
                            $('.drag-item').each(function(ij) {

                                var block_type = $('.drag-item').eq(ij).find(".block-type").eq(0).attr("value");

                                // append to area
console.log(itemid);

                                if ($(this).find(".block-type").eq(0).attr("value") === block_type) {

                                    // trigger add action frm same object
                                    objEditor.addItem(block_type);
                                    var $modal = $("<div>",{
                                        class:"exx modal fade in",
                                        role:"dialog",
                                        tabindex:"-1"
                                    }).html('<div class="modal-dialog block" role="document"><div class="modal-block"><div class="modal-body">Get form for '+block_type+'</div></div></div>');
                                    //$('body').append($modal);
                                    $($modal).appendTo('body');
                                    $('.modal-dialog.block').parent('div').eq(0).modal('show');
                                    var $blockPlaceholder = $("<div>",{
                                        class:"block-placeholder",
                                        tabindex:"-1"
                                    }).html('<div>Get form for '+block_type+'</div>');
                                    //$('body').append($modal);

                                    console.log($('[' + dataAreaIdentifierAttrName + ']').eq(0).attr(dataAreaIdentifierAttrName));

                                   // $($blockPlaceholder).appendTo($('[' + dataIdentifier + ']').eq(i));
console.log(i);
                                    $($blockPlaceholder).appendTo(itemid);

                                }
                                ij++;
                            });




                           console.log("Dropped to " + currentItemAttributeValue);

                        }
                    });
                };
            };
        };
    };
