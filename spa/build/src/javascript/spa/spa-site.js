/**
 * !! It inititates itself as: var objCiRegister at the line line of this js file,
 * use objDeveloper.setup();
 */
/*
function ObjCommon ( sCallbackName ){
    this.callback_name = sCallbackName;
    this.url_content = "/singlepageapplication/content/edit/token/ajax";
}

ObjCommon.prototype.getCallbackName = function(){
    return this.callback_name;
}

ObjCommon.prototype.setEventAttribute = function(sElementSelector,sEvent,sCallback,iPropagation){
    iPropagationReturn = (iPropagation===1)?'return false;':'';
    var normalized_event_name = sEvent.charAt(0).toUpperCase() + sEvent.slice(1); // normalize event name, so its ucfirst
    jQuery(sElementSelector).attr('on' + normalized_event_name,this.getCallbackName() + '.' + sCallback + '($(this),' + iPropagation + ');'+iPropagationReturn);
}

ObjCommon.prototype.setup = function(){
    console.log('hello');
    this.setEventAttribute('img','load','loadImage',0);
}

ObjCommon.prototype.loadImage = function(jqObject){
    // assign mode
    var src = jqObject.attr("src");

    var image = document.images[0];
    var downloadingImage = new Image();
    downloadingImage.onload = function(){
        image.src = this.src;
    };
    downloadingImage.src = "assets/img/logo.png";

    console.log(jqObject);
} // this.setEventAttribute

var objCommon = new ObjCommon('objCommon');

var image = document.images[0];
var downloadingImage = new Image();
downloadingImage.onload = function(){
    image.src = this.src;
};
downloadingImage.src = "assets/img/logo.png";

//$(function() {
    objCommon.setup();
//});

*/

