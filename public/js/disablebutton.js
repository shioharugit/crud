// フォーム送信前に二重クリック防止のdisabledを付与する
$('.disable-button').click(function(){
    $("<input>",{
        type:"hidden",
        name:"action",
        value:"submit"
    }).appendTo("form");
    var form = $(this).parents('form');
    $(this).prop('disabled',true);
    form.submit();
});