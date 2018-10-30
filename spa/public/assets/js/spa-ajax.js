class Ajax {
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
        this.server.url.create = "/api/content/create";

        this.server.url.update = "/api/content/update";
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
     * Sends new message
     *
     * @param message
     */
    create(message){
        this.postData(this.server.url.update, message)
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