/**
 * !! It inititates (evaluates) itself into var (window.)objCiRegister at the line line of this js file,
 * use objDeveloper.setup();
 */

var localCache = {
    data: {},
    remove: function (url) {
        delete localCache.data[url];
    },
    exist: function (url) {
        return localCache.data.hasOwnProperty(url) && localCache.data[url] !== null;
    },
    get: function (url) {
        console.log('Getting in cache for url' + url);
        return localCache.data[url];
    },
    set: function (url, cachedData, callback) {
        localCache.remove(url);
        localCache.data[url] = cachedData;
        if ($.isFunction(callback)) callback(cachedData);
    }
};

$(function () {
    var url = '/echo/jsonp/';
    $('#ajaxButton').click(function (e) {
        $.ajax({
            url: url,
            data: {
                test: 'value'
            },
            cache: true,
            beforeSend: function () {
                if (localCache.exist(url)) {
                    doSomething(localCache.get(url));
                    return false;
                }
                return true;
            },
            complete: function (jqXHR, textStatus) {
                localCache.set(url, jqXHR, doSomething);
            }
        });
    });
});

function doSomething(data) {
    console.log(data);
}

/* ObjLocalCache: */

function ObjLocalCache ( sCallbackName ){
    this.callback_name = sCallbackName;
}

ObjLocalCache.prototype.getCallbackName = function(){
    return this.callback_name;
}

ObjLocalCache.prototype.data = {};
ObjLocalCache.prototype.remove = function (url) {
    delete this.data[url];
};
ObjLocalCache.prototype.exist = function (url) {
    return this.data.hasOwnProperty(url) && this.data[url] !== null;
};
ObjLocalCache.prototype.get = function (url) {
    console.log('Getting in cache for url' + url);
    return this.data[url];
};
ObjLocalCache.prototype.set = function (cachedData, callback) {
    localCache.remove(url);
    localCache.data[url] = cachedData;
    if ($.isFunction(callback)) callback(cachedData);
};


ObjCache.prototype.setEventAttribute = function(sElementSelector,sEvent,sCallback,iPropagation){
    iPropagationReturn = (iPropagation===1)?'return false;':'';
    var normalized_event_name = sEvent.charAt(0).toUpperCase() + sEvent.slice(1); // normalize event name, so its ucfirst
    jQuery(sElementSelector).attr('on' + normalized_event_name,this.getCallbackName() + '.' + sCallback + '($(this),' + iPropagation + ');'+iPropagationReturn);
}

ObjCache.prototype.setup = function(){
    this.setEventAttribute('.menu-item.menu-item-area','click','togglePathInfo',0);
    this.setEventAttribute('.menu-item.menu-item-block','click','togglePathInfo',0);
    this.setEventAttribute('.menu-item.menu-item-content','click','togglePathInfo',0);
}

ObjCache.prototype.togglePathInfo = function(jqObject){
    // assign mode
    var type = jqObject.attr("data-item-type");
    // call the function
    return this.editMode(type);
} // this.setEventAttribute

ObjCache.prototype.editMode = function(type){
    // default if argument not set for `mode`
    // if (typeof mode === 'undefined' || $.inArray(mode,getModeTypes())) { mode = 'block'; }

    console.log(objDataClient.getDeveloperPathData(type));

    var dataIdentifier = "data-" + type + "-identifier";

    var obj = objDataClient.getDeveloperPathData(type);

    var len = $('.frontbox-' + type).length;
    if (len > 0) {
        for (i = 0; i < len; i++) {
            var currentItem = $('.frontbox-' + type).eq(i);
            var currentItemAttributeValue = currentItem.attr(dataIdentifier);
            if ("undefined" !== typeof(currentItemAttributeValue)) {
                currentItem.addClass("border-" + type);
                if (obj[type].length > 0) {
                    for (ii = 0; ii < obj[type].length; ii++) {
                        var curr = obj[type][ii];
                        var uid = curr.uid;
                        if (uid === currentItemAttributeValue) {
                            $span = $("<span>", {
                                id: "foo-" + ii,
                                class: "frontbox-dev-" + type + "-attr"
                            }).text(curr.uid);
                            var $e = $("<div>", {
                                id: "foo-" + uid,
                                class: "frontbox-dev-" + type + "-attr-wrapper"
                            });
                            var $g = $("<span>", {class: "glyphicon glyphicon-edit", "aria-hidden": "true"});
                            $span.prepend($g);
                            $e.append($span);
                            currentItem.append($e);
                        };
                        uid = null;
                    };
                };
            };
        };
    };
};

var objLocalCache = new ObjLocalCache('objLocalCache'); // new object instance
