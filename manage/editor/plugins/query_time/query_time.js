KindEditor.plugin('query_time', function(K) {
        var editor = this, name = 'query_time';
        editor.plugin.query_time = {
        query_timeFunc: 
function(e) {
        editor.insertHtml('{{query_time}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.query_time.query_timeFunc);
});
