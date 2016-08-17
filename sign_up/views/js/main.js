$(document).ready(function(){
     $('div[class=banner]').click(function(){
          window.location.href = root;
     });
     
     $('div[id^=btn_]').each(function(){
          $(this).button();
     });
});