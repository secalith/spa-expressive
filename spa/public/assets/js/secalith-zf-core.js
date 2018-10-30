function SecalithZFCore ( sCallbackName ) {

    // in case of listeners use
    var _callback_name = sCallbackName;
    var _debug = true; // Control console.log output here
    this.debug_level = 3;// 0 = critical error , 1 = error, 2=debug ,3 = information

    var _animationSpeedOut = 150;
    var _animationSpeedIn = 100;
    var _buttonActivateTopValue = 150; // value in pixels

    this.cache = [];

    // check dependency
    var _checkJQuery = function(){
        if( ! window.jQuery) {
            _log("Load jQuery first!");
            return false;
        } else {
            return true;
        }
    }

    var _loadConfig = function() {}

    /**
     * Will log the message if _debug_level is >=
     *
     * @var sMsg string message
     * @var iLevel int log level
     */
    this.log = function(sMsg,iLevel) {
        // #TODO
        if( typeof iLevel === 'undefined') {
            iLevel = _debug_level;
        }
        if((iLevel<=this.debug_level) && _debug===true) {
            if(iLevel==0){
                console.error( _callback_name + ' [' + iLevel + '] ' + sMsg);
            } else {
                console.log( _callback_name + ' [' + iLevel + '] ' + sMsg);
            }
        }
    }; // this.log()

    this.setCache = function(namespace,data) {
        this.cache[namespace] = data;
    }

    this.getCache = function(namespace) {
        if('undefined' == typeof this.cache[namespace]) {
            return false;
        } else {
            console.log(this.cache);
            return this.cache[namespace];
        }
    }

    //
    this.setEventAttribute = function(sElementSelector,sEvent,sCallback,iPropagation) {
        console.log(sElementSelector);
        iPropagationReturn = (iPropagation===1)?'return false;':'';
        var normalized_event_name = sEvent.charAt(0).toUpperCase() + sEvent.slice(1); // normalize event name, so its ucfirst
        console.log(normalized_event_name);
        console.log(jQuery(sElementSelector).length);
        jQuery(sElementSelector).attr('on' + normalized_event_name,_callback_name + '.' + sCallback + '($(this),' + iPropagation + ');'+iPropagationReturn);
    } // this.setEventAttribute

    this.setup = function () { // it can access private members
        if( _checkJQuery()) { // check if jQuery is loaded
            // set Event Listener on some objects

            // set toggleTableColumn observer, so it is possible to manipulate table view with form ['available']
            // this.setEventAttribute('.table .list-group-item input[type="checkbox"]','change','toggleTableColumn',0);
            // this.setEventAttribute('#refresh-table','click','refreshMainTable',1);
            // this.setEventAttribute('.table-dynamic .btn-submit','click','tableAction',1);
            // this.setEventAttribute('.table-dynamic select','change','tableSyncActionSelectors',1);

        } // endif
    }; // this.setup()
}
