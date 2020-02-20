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

reqQue(1);
