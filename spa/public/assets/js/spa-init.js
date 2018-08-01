var objEditor = new ObjEditor('objEditor');

var spaForm = new SpaForm("form","form",null);

$( document ).ready(function(){
    // start the whole circus
    ENV_URL = 'http://spa.local.vm';
    spaForm.initialize();



});