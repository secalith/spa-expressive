/**
 * !! It inititates itself as: var objDataClient at the line line of this js file,
 * use objDataClient.setup();
 */

function ObjDataClient ( sCallbackName ) {
    this.callback_name = sCallbackName;
    this.url_content = "/singlepageapplication/content/edit/token/ajax";
}

    ObjDataClient.prototype.getCallbackName = function(){
        return this.callback_name;
    }

    ObjDataClient.prototype.getDeveloperPathData = function(mode){
        switch (mode) {
            case 'area':
                return this.getAreaData();
                break;
            case 'block':
                return this.getBlockData();
                break;
            case 'content':
                return this.getContentData();
                break;
        }
    }

    ObjDataClient.prototype.getAreaData = function(){
        var area = '{ "area" : [' +
            '{ "uid":"a12312a", "dataType":"area.global", "dataTemplate":"std" },' +
            '{ "uid":"a12312b", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312c", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312d", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312e", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312f", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312g", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312h", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312i", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312j", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312k", "dataType":"area.page", "dataTemplate":"std" },' +
            '{ "uid":"a12312l", "dataType":"area.page", "dataTemplate":"std" }' +
            ' ]}';
        var obj = JSON.parse(area);
        return obj;
    }

    ObjDataClient.prototype.getBlockData = function(){
        var block = '{ "block" : [' +
            '{ "uid":"b12312a", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312b", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312c", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312d", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312e", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312f", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312g", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312h", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312i", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312j", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312k", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312l", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312m", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312n", "dataType":"block.stack", "dataTemplate":"std" },' +
            '{ "uid":"b12312o", "dataType":"block.stack", "dataTemplate":"std" }' +
            ' ]}';
        var obj = JSON.parse(block);
        return obj;
    }

    ObjDataClient.prototype.getContentData = function(){

        var content = '{ "content" : [' +
            '{ "uid":"c12312a", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312b", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312c", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312d", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312e", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312f", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312g", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312h", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312i", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312j", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312k", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312l", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312m", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312n", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312o", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312p", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312q", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312r", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312s", "dataType":"content.markdown", "dataBlockTemplate":"std" },' +
            '{ "uid":"c12312t", "dataType":"content.markdown", "dataBlockTemplate":"std" }' +
            ' ]}';
        var obj = JSON.parse(content);
        return obj;
    }

var objDataClient = new ObjDataClient('objDataClient'); // new object instance
