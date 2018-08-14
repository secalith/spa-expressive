
    function ObjHtml ( sCallbackName ){
        this.callback_name = sCallbackName;
    }

    ObjEditor.prototype.getCallbackName = function(){
        return this.callback_name;
    }

    ObjHtml.prototype.createElement = function(htmlTag,attributes){

        return jQuery("<"+htmlTag+">",{}).html('');

    } // this.createElement
