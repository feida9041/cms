KindEditor.plugin('zd1', function(K) {
        var editor = this, name = 'zd1';
        editor.plugin.zd1 = {
        zd1Func: 
function(e) {
        editor.insertHtml('{{zd1}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.zd1.zd1Func);
});
