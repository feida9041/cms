KindEditor.plugin('sncode', function(K) {
        var editor = this, name = 'sncode';
        editor.plugin.sncode = {
        sncodeFunc: 
function(e) {
        editor.insertHtml('{{sncode}}');
        }
        };
        // 点击图标时执行
        editor.clickToolbar(name, editor.plugin.sncode.sncodeFunc);
});
