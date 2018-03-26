KindEditor.plugin('bianhao', function(K) {
        var editor = this, name = 'bianhao';
        editor.plugin.bianhao = {
        bianhaoFunc: 
function(e) {
        editor.insertHtml('{{cpbh}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.bianhao.bianhaoFunc);
});
