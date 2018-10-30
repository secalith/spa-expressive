class AdminMenu{
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
        this.userIdentity = null;
        this.btnToggleMenu = "#menu-admin-toggle-btn";
        this.btnToggleMenuShow = "#menu-admin-toggle-show-btn";
        this.adminMenu = "#menu-admin-wrapper";
        this.visibleClass = '.admin-menu-visible';
        this.init();
    }
    toggleMenu(){
        this.plugins.html.toggleClass(
            document.querySelector('body'),
            this.visibleClass
        );
    }
    init(){
        document.querySelector(this.btnToggleMenu).setAttribute('onClick','javascript:'+this.callbackName+'.toggleMenu();return false;');
        document.querySelector(this.btnToggleMenuShow).setAttribute('onClick','javascript:'+this.callbackName+'.toggleMenu();return false;');
    }
}