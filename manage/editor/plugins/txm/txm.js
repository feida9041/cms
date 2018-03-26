KindEditor.plugin('txm', function(K) {
        var editor = this, name = 'txm';
        editor.plugin.txm = {
        txmFunc: 
function(e) {
        editor.insertHtml('{{txm}}');
        }
        };
        // 点击图标时执行
        editor.clickToolbar(name, editor.plugin.txm.txmFunc);
});
