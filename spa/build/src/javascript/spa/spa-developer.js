/**
 * !! It inititates itself as: var objCiRegister at the line line of this js file,
 * use objDeveloper.setup();
 */

    function ObjDeveloper ( sCallbackName ){
        this.callback_name = sCallbackName;
        this.url_content = "/singlepageapplication/content/edit/token/ajax";
    }

    ObjDeveloper.prototype.getCallbackName = function(){
        return this.callback_name;
    }

    ObjDeveloper.prototype.setEventAttribute = function(sElementSelector,sEvent,sCallback,iPropagation){
        iPropagationReturn = (iPropagation===1)?'return false;':'';
        var normalized_event_name = sEvent.charAt(0).toUpperCase() + sEvent.slice(1); // normalize event name, so its ucfirst
        jQuery(sElementSelector).attr('on' + normalized_event_name,this.getCallbackName() + '.' + sCallback + '($(this),' + iPropagation + ');'+iPropagationReturn);
    }

    ObjDeveloper.prototype.setup = function(){
        this.setEventAttribute('.menu-item.menu-item-area','click','togglePathInfo',0);
        this.setEventAttribute('.menu-item.menu-item-block','click','togglePathInfo',0);
        this.setEventAttribute('.menu-item.menu-item-content','click','togglePathInfo',0);
        this.setEventAttribute('body','load','addAdminClass',0);
    }

    ObjDeveloper.prototype.togglePathInfo = function(jqObject){
        // assign mode
        var type = jqObject.attr("data-item-type");
        var newClass = "show-" + type;
        $('body').addClass(newClass);
        return this.editMode(type);
    } // this.setEventAttribute

    ObjDeveloper.prototype.editItem = function(jqObject) {
        var uid = jqObject.parent("[data-content-identifier]").attr("data-content-identifier");
        this.url_content

        var url = this.url_content.replace("token", uid);

        $.get( url, function( data ) {
            $(data).find('form').attr('action',url);
            $( ".modal-body" )
                .append( data );
        }, "html" );

        console.log(uid);

    };

    ObjDeveloper.prototype.addAdminClass = function() {
        $('body').addClass("administrator");
    };

    ObjDeveloper.prototype.editMode = function(type) {
        // default if argument not set for `mode`
        // if (typeof mode === 'undefined' || $.inArray(mode,getModeTypes())) { mode = 'block'; }

        console.log("Action edit `" + type + "` has been triggered");

        var dataIdentifier = "data-" + type + "-identifier";

        var obj = objDataClient.getDeveloperPathData(type);

        var len = $('[' + dataIdentifier + ']').length;
        if (len > 0) {
            for (i = 0; i < len; i++) {

                var currentItem = $('[' + dataIdentifier + ']').eq(i);
                var currentItemAttributeValue = currentItem.attr(dataIdentifier);
                var uid = currentItemAttributeValue;

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
                    var $glyphicon = $("<span>", {class: "glyphicon glyphicon-edit", "aria-hidden": "true","data-toggle":"modal","data-target":".exx"});
                    $span.prepend($glyphicon);
                    $e.append($span);
                    currentItem.append($e);
                    this.setEventAttribute("#foo-" + type + "-" + i,"click","editItem");
                };
            };
            var $modal = $("<div>",{
                class:"exx modal fade",
                role:"dialog",
                tabindex:"-1"
            }).html('<div class="modal-dialog" role="document"><div class="modal-content"><div class="modal-body">4564563</div></div></div>');
            $('.no-display').prepend($modal);
        };
    };

var objDeveloper = new ObjDeveloper('objDeveloper');
