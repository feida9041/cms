KindEditor.plugin('riqi', function(K) {
        var editor = this, name = 'riqi';
        editor.plugin.riqi = {
        riqiFunc: 
function(e) {
        editor.insertHtml('{{riqi}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.riqi.riqiFunc);
});
