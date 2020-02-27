//Запрашиваем вопрос
function reqQue(question){
jQuery.ajax({
       url: "https://upread.ru/github/question.php",
       type: "POST",
       crossDomain: true,
       data: "question="+question,
       success:function(result){
      jQuery('#osnov').html(result);
       },
       error:function(xhr,status,error){
           alert(status);
       }
   });
}



//проверяем ответ
jQuery('#otvet').click(function() {
  var question = jQuery('#question').data( "value" );
  var answer = jQuery("input[name='answer']:checked").val();
    jQuery.ajax({
           url: "https://upread.ru/github/answer.php",
           type: "POST",
           crossDomain: true,
           data: "question="+question+"&answer="+answer,
           success:function(result){
               alert(result);
               if (result=="Ответ верный!") reqQue(2);
           },
           error:function(xhr,status,error){
               alert(status);
           }
       });

});

//генерация ключа для первого посетителя
function pass_gen(len) {
    chrs = 'abdehkmnpswxzABDEFGHKMNPQRSTWXZ123456789';
    var str = '';
    for (var i = 0; i < len; i++) {
        var pos = Math.floor(Math.random() * chrs.length);
        str += chrs.substring(pos,pos+1);
    }
    return str;
}

jQuery(document).ready(function() {
reqQue(1);
jQuery('#keyUser').val(pass_gen(16));
   });
