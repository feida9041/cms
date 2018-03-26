KindEditor.plugin('riqi', function(K) {
        var editor = this, name = 'riqi';
        editor.plugin.riqi = {
        riqiFunc: 
function(e) {
        editor.insertHtml('{{riqi}}');
        }
        };
        // 点击图标时执行
        editor.clickToolbar(name, editor.plugin.riqi.riqiFunc);
});
