KindEditor.plugin('sncode', function(K) {
        var editor = this, name = 'sncode';
        editor.plugin.sncode = {
        sncodeFunc: 
function(e) {
        editor.insertHtml('{{sncode}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.sncode.sncodeFunc);
});
