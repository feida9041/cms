KindEditor.plugin('hits', function(K) {
        var editor = this, name = 'hits';
        editor.plugin.hits = {
        hitsFunc: 
function(e) {
        editor.insertHtml('{{hits}}');
        }
        };
        // 点击图标时执行
        editor.clickToolbar(name, editor.plugin.hits.hitsFunc);
});
