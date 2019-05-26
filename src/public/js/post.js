jQuery (function ()
{
    //テスト
    //$('input[name="photo"]').change(function(){
    //    var file = this.files[0];
    //    $("#jq_test").text("変更")
    //})

    //投稿画像のプレビュー表示
    $(function(){
        $('input[name="photo"]').change(function(e){
        //ファイルオブジェクトを取得する
        var file = e.target.files[0];
        var reader = new FileReader();
        //imgタグの表示
        $('#post-img').show();
        //アップロードした画像を設定する
        reader.onload = (function(file){
            return function(e){
                $('#post-img').attr('src', e.target.result);
                $('#post-img').attr('title', file.name);
            };
        })(file);
            reader.readAsDataURL(file);
        });
    });
})