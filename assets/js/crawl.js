

 var prevurl="";
function crawl(element) {

if(element.value=="")
{
  prevurl="";
 $("#tab").css({"display":"none"});

}


  var match = /(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.)(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.exec(element.value);
     if(match)
     {

 urlchecksum(match[0],element.value,element.value.length);
   
    }
  
     
 else
 {

    var match1 =/(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/.exec(element.value);
    if(match1)
    {

     urlchecksum(match1[0],element.value,element.value.length);
  
    }
    else
    {
        prevurl="";
         $("#tab").css({"display":"none"});
         
    }
 }   
     
 
      
     
}


function urlchecksum(url,value,len)
{
  if(prevurl!=url)
{

  if(value.lastIndexOf(" ")==(len-1))
{
      
 checkurl(url);          
    prevurl=url;
    
}

}
function IsURL(url) {

  // var urlregex = new RegExp(
  //       "^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.){1}([0-9A-Za-z]+\.com|.co|.uk|.in|.org|.edu|.gl)");
 var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.|http:\/\/|https:\/\/|ftp:\/\/){1}([0-9A-Za-z]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|co|uk|in|co.in)|[0-9A-Za-z]+\.[0-9A-Za-z]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|co|uk|in|co.in))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");

  return urlregex.test(url);
 }

function checkurl(value)
{
  
var response=IsURL(value);
if(response)
{
 var base=$("#baseurl").val();
  var url=base+"crawl/crawlurl";
                  $.ajax({
                    url:url,
                    data:{url:value},
                    dateType:"json",
                    type:"POST",
                    beforeSend:function()
                    {
                      $("#pbar").css({"width":"0%"});
                      $("#process").html(0);
                      $("#processstr").show();
                      $("#process_quote").show();
                      setInterval(function(){ if($("#process").html()<100){ if($("#process").html()!=""){$("#process").html((parseInt($("#process").html())+1)); $("#pbar").css({"width":(parseInt($("#process").html())+10)+"%"})}} }, 1000);
                     
                    },
                    success: function(data)
                    {
                      $("#pbar").css({"width":"100%"});
                      $("#process").html(100);
                      var obj=JSON.parse(data);
                      var html="";
                      var html1="";
                      $("#tab").show();
                      
                       html+="<strong style='color:#ff0000;'>og:title: </strong><br>"+obj.ogtitle+"<br><br>";
                       html+="<strong style='color:#ff0000;'>og:description: </strong><br>"+obj.ogdescription+"<br><br>";
                       html+="<strong style='color:#ff0000;'>og:image: </strong><br><img src='"+obj.ogimage+"' width='200' height='200'><br><br>";
                       html+="<strong style='color:#ff0000;'>og:video: </strong><br>"+obj.ogvideo+"<br><br>";
                       html+="<strong style='color:#ff0000;'>Host: </strong><br>"+obj.host+"<br><br>";
                       html1+="<strong style='color:#ff0000;'>links: </strong><br>"+obj.link+"<br><br>";
                       html1+="<strong style='color:#ff0000;'>images: </strong><br><div style='width:500px;heigh:800px;overflow:scroll;border:1px solid #00FF00'>"+obj.image+"</div><br><br>";
                       $("#preview").attr("data",obj.previewurl);
                       $("#previewtxt").attr("href",value);
                       $("#source").html("<xmp>"+obj.source+"</xmp> ");
                       $("#output").html(html);
                       $("#output1").html(html1);
                       setTimeout(function(){ $("#processstr").hide();$("#process_quote").hide();},3000);
                       
                      
                    }
                  });
}   
  

}
}
    
