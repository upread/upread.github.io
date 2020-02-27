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

//Запрашиваем вопрос
function reqQue(){
jQuery.ajax({
       url: "https://upread.ru/github/question.php",
       type: "POST",
       crossDomain: true,
       data: "keyUser="+keyUser,
       success:function(result){
      jQuery('#osnov').html(result);
       },
       error:function(xhr,status,error){
           alert(status);
       if (status=="Поздравляем! Вы правильно ответили на все вопросы!") jQuery("#otvet").css('display','none');
       }
   });
}

//проверяем ответ
jQuery('#otvet').click(function() {
  var answer = jQuery("input[name='answer']:checked").val();
    jQuery.ajax({
           url: "https://upread.ru/github/answer.php",
           type: "POST",
           crossDomain: true,
           data: "keyUser="+keyUser+"&answer="+answer,
           success:function(result){
               alert(result);
               if (result=="Ответ верный!") reqQue();
           },
           error:function(xhr,status,error){
               alert(status);
           }
       });

});

function setCookie(){
    var cookieString = "keyUser=" + keyUser;
    document.cookie = cookieString;
}

function getCookie(){
 return document.cookie.split("=")[1];
}

//меняем ключ
jQuery('#EnterUser').click(function() {
  keyUser = jQuery('#keyUser').val();
reqQue();
});

//генерируем новый и запрос на вопрос
var keyUser = pass_gen(16);
jQuery(document).ready(function() {
if (getCookie()=="") setCookie();
else keyUser = getCookie();
jQuery('#keyUser').val(keyUser);
reqQue();
});
