KindEditor.plugin('product', function(K) {
        var editor = this, name = 'product';
        editor.plugin.product = {
        productFunc: 
function(e) {
        editor.insertHtml('{{product}}');
        }
        };
        // 点击图标时执行
        editor.clickToolbar(name, editor.plugin.product.productFunc);
});
