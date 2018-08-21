class Chat {
    constructor(callbackName) {
        this.callbackName = callbackName;
        /**
         * COntainer for other classes; Some kind of primitiove serviceManager
         *
         * @todo create separate class and create from json-config
         * @type {{}}
         */
        this.plugins = {};
        this.plugins.html = new Html();
        this.plugins.chatWindow = new ChatWindow(this.callbackName);
        this.plugins.chatAjax = new ChatAjax(this.callbackName);
        this.userIdentity = null;
        window[this.callbackName] = this;
        this.init();
    }

    init(){
        // set the message submit observer-atribute for the chat send button
        document.querySelector(this.plugins.chatWindow.chatSubmitBtn).setAttribute('onClick','javascript:'+this.callbackName+'.submitMessage();return false;');
        // set the minimize chat-button
        document.querySelector(this.plugins.chatWindow.btnMinimize).setAttribute('onClick','javascript:'+this.callbackName+'.minimize();return false;');
        document.querySelector(this.plugins.chatWindow.btnMaximize).setAttribute('onClick','javascript:'+this.callbackName+'.maximize();return false;');

        // login to the spa-application
        var connectStatus = this.connect();
        connectStatus.then(function(response){
            // connected, apply welcome message from the application
            var htmlJson = {"tag":"div","children":[{"tag":"span","text":'server: '},{"tag":"i","text":response.message}]};
            var html = window['chat'].plugins.html.createHtmlFromJSON(htmlJson);
            document.querySelector(window['chat'].plugins.chatWindow.chatContent).appendChild(html);

            window['chat'].plugins.chatWindow
                .toggleIconRefresh()
                .setKeyEnterSubmitObserver()
            ;

        });
        this.setTimer();
    }

    minimize(){
        return this.plugins.chatWindow.chatMinimize();
    }
    maximize(){
        return this.plugins.chatWindow.chatMaximize();
    }

    connect(){
        return this.plugins.chatAjax.connect();
    }

    getIdentity(){
        return this.userIdentity;
    }

    setIdentity(identity){
        this.userIdentity = identity;
        return this;
    }

    readMessages(){
        window['chat'].plugins.chatWindow.toggleIconRefresh();
        var status = window['chat'].plugins.chatAjax.readNew();
        window['chat'].plugins.chatWindow.toggleIconRefresh();
        //console.log(status);
    }

    // Periodically check for new messages
    setTimer(){
        var intervalID = setInterval(window[this.callbackName].readMessages, 5000); // Will alert every second.
    }

    submitMessage(){
        window[this.callbackName].plugins.chatWindow.toggleIconRefresh();
        var message = document.querySelector(this.plugins.chatWindow.chatText).value;
        if(message.length==0) {
            return false;
        }

        // append to chat history container
        var htmlJson = {"tag":"div","children":[{"tag":"span","text":'you: '},{"tag":"span","text":message}]};
        var html = window['chat'].plugins.html.createHtmlFromJSON(htmlJson);
        document.querySelector(window['chat'].plugins.chatWindow.chatContent).appendChild(html);

        this.plugins.chatAjax.create({identity:this.getIdentity(),message:message});

        // clear new message input
        document.querySelector(this.plugins.chatWindow.chatText).value = '';

        console.log(message);
        window[this.callbackName].plugins.chatWindow.toggleIconRefresh();
    };

}

/**
 * Holds interactions with the chat window (as html)
 */
class ChatWindow {
    constructor(callbackName) {
        this.callbackName = callbackName;
        this.chatWrapper = "#chat-wrapper";
        this.chatWrapperStatusMinimized = ".chat-display-minimized";
        this.chatText = "#chat-text";
        this.chatBody = "#chat-body";
        this.chatContent = "#chat-content";
        this.chatSubmitBtn = "#chat-submit-btn";
        this.chatIconRefresh = ".glyphicon-refresh";
        this.btnMinimize = ".chat-tab-minimize";
        this.btnMaximize = ".chat-tab-maximize";
        this.optEnterSend = "#chat-option-enter_send";
    }

    /**
     * If User presses enter, then copy
     */
    setKeyEnterSubmitObserver(){
        document.querySelector(this.chatText).onkeypress = function(e){
            if (!e) e = window.event;
            var keyCode = e.keyCode || e.which;
            if (keyCode == '13'){
                // Enter pressed. check if option enterSend is checked
                if(true===window['chat'].plugins.html.isChecked(window['chat'].plugins.chatWindow.optEnterSend)){
                    window['chat'].submitMessage();
                } else {

                }

                return false;
            }
        }
    }

    /**
     * Maximize the chat window by toggling the hidden class for the .chatBody (history)
     */
    chatMaximize(){
        return this.chatMinimize();
    }

    /**
     * Minimize the chat window by toggling the hidden class for the .chatBody (history)
     */
    chatMinimize(){
        window['chat'].plugins.html.toggleClass(
            document.querySelector(window['chat'].plugins.chatWindow.chatWrapper),
            // selector usually contains '.' or '#', this way we clea it
            // @todo maybe move it to toggleClass()?
            this.chatWrapperStatusMinimized
        );
    }

    /**
     * Display the icon inside the chat on or off. Usually used when sending message or checks the status
     */
    toggleIconRefresh(){
        var iconRefresh = document.querySelector(window[this.callbackName].plugins.chatWindow.chatIconRefresh);
        window['chat'].plugins.html.toggleClass(iconRefresh,'hidden');

        return this;
    }
}

/**
 * Makes ajax calls to the spa-messenger
 */
class ChatAjax {
    constructor(callbackName) {
        this.callbackName = callbackName;
        this.server = {};
        this.server.url = {};
        /**
         * url to login to the app-server and check the connection periodically
         * @type {string}
         */
        this.server.url.status = "/messenger/chat/status";
        /**
         * Send new messages to this uri
         * @type {string}
         */
        this.server.url.create = "/messenger/chat/create";
        /**
         * Get new messages
         * @type {string}
         */
        this.server.url.read = "/messenger/chat/read";
        this.server.url.read = "/messenger/chat/status";
    }
    connect(){
        return this.get(this.server.url.status);
    }
    readNew(){
        return this.get(this.server.url.read);
    }

    /**
     * Sends new message
     *
     * @param message
     */
    create(message){
        this.postData(this.server.url.create, message)
            .then(data => console.log(data)) // JSON from `response.json()` call
            .catch(error => console.error(error))
        ;
    }

    /**
     * Handles get connections.
     * May check for new messages this way.
     *
     * @param url
     * @returns {Promise<Response>}
     */
    get(url){
        return fetch(url)
            .then(window[this.callbackName].ajaxStatus)
            .then(function(response) {
                return response.json();
            }).then(function(data) {
                return data;
            }).catch(function(error) {
                console.log('Request failed', error);
            });
    }

    /**
     * Helpful with resolving ajax response status.
     * @param response
     * @returns {void | Array | *}
     */
    ajaxStatus(response) {
        if (response.status >= 200 && response.status < 300) {
            return Promise.resolve(response)
        } else {
            return Promise.reject(new Error(response.statusText))
        }
    }

     postData(url, data) {
        // Default options are marked with *
        return fetch(url, {
            body: JSON.stringify(data), // must match 'Content-Type' header
            cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
            credentials: 'same-origin', // include, same-origin, *omit
            headers: {
                'user-agent': 'Mozilla/4.0 MDN Example',
                'content-type': 'application/json'
            },
            method: 'POST', // *GET, POST, PUT, DELETE, etc.
            mode: 'cors', // no-cors, cors, *same-origin
            redirect: 'follow', // *manual, follow, error
            referrer: 'no-referrer', // *client, no-referrer
        })
            .then(response => response.json()) // parses response to JSON
    }
}