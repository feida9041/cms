$(function () {
    $("#print_code").on('click', function () {
        $('.ticket_preview').css('border', 'none');
        record_print_times('ajax_print_time');
        $('.ticket_preview').css('border', '1px solid #000');
    })

    $("#print_body svg").each(function (item, val) {
        var id = $(val).attr('id');
        $("#" + id).JsBarcode(id,{
            width: 3,
            fontOptions: "bold",
            marginTop:1
        });
    });

    $("#print_logistics").on('click', function () {
        $('.ticket_logistics').css('border', 'none');
        $("#print_body .ticket_logistics").eq(0).removeClass('ticket_logistics').addClass('ticket_logistics_first');
        record_print_times('ajax_print_logistics_time');
        $("#print_body .ticket_logistics_first").eq(0).removeClass('ticket_logistics_first').addClass('ticket_logistics');
        $('.ticket_logistics').css('border', '1px solid #000');
    })

    function record_print_times(act) {
        $('#print_body').jqprint({
            callback: function () {
                $.confirm({
                    columnClass: 'col-md-6 col-md-offset-3',
                    confirmButtonClass: 'btn-success',
                    cancelButtonClass: 'btn-danger',
                    animation: 'left',
                    theme: 'material',
                    confirmButton: '记录',
                    cancelButton: '不记录',
                    title: '打印记录',
                    content: '<form id="ajax_form">' + $('#print_div').html() + '</form>',
                    confirm: function () {
                        var send = [];
                        $('#ajax_form input[name="chk"]:checked').each(function () {
                            send.push(this.value)
                        });
                        $.ajax({
                            type: "POST",
                            url: '?act=' + act,
                            data: {
                                ids: send
                            },
                            success: function (result) {
                                $.confirm({
                                    title: false, // hides the title.
                                    backgroundDismiss: true,
                                    cancelButton: false, // hides the cancel button.
                                    confirmButton: false, // hides the confirm button.
                                    closeIcon: false, // hides the close icon.
                                    content: result, // hides content block.
                                });
                            },
                            error: function (data) {

                            }
                        })
                    }
                });
            }
        });
    }
});