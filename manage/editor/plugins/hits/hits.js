KindEditor.plugin('hits', function(K) {
        var editor = this, name = 'hits';
        editor.plugin.hits = {
        hitsFunc: 
function(e) {
        editor.insertHtml('{{hits}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.hits.hitsFunc);
});
