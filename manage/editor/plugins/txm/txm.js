KindEditor.plugin('txm', function(K) {
        var editor = this, name = 'txm';
        editor.plugin.txm = {
        txmFunc: 
function(e) {
        editor.insertHtml('{{txm}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.txm.txmFunc);
});
