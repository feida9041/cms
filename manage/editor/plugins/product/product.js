KindEditor.plugin('product', function(K) {
        var editor = this, name = 'product';
        editor.plugin.product = {
        productFunc: 
function(e) {
        editor.insertHtml('{{product}}');
        }
        };
        // ���ͼ��ʱִ��
        editor.clickToolbar(name, editor.plugin.product.productFunc);
});
