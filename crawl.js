

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
 var urlregex = new RegExp("^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.|http:\/\/|https:\/\/|ftp:\/\/){1}([0-9A-Za-z]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|co|uk|in)|[0-9A-Za-z]+\.[0-9A-Za-z]+\.(com|edu|gov|int|mil|net|org|biz|arpa|info|name|pro|aero|coop|museum|co|uk|in))(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\?\'\\\+&amp;%\$#\=~_\-]+))*$");
 
  return urlregex.test(url);
 }

function checkurl(value)
{
  
var response=IsURL(value);
if(response)
{
 
  var url="crawl.php";
                  $.ajax({
                    url:url,
                    data:{url:value},
                    dateType:"json",
                    type:"POST",
                    beforeSend:function()
                    {
                      $("#process").html("Processing");
                      $("#process").css({"display":"block"});
                      setInterval(function(){  if($("#process").html()!=""){$("#process").html("."+$("#process").html()+".");} }, 100);
                     
                    },
                    success: function(data)
                    {
                      $("#process").css({"display":"block"});
                      $("#process").html("");
                      var obj=JSON.parse(data);
                      var html="";
                      var html1="";
                      $("#tab").css({"display":"flex"});
                       html+="<strong>og:title: </strong><br>"+obj.ogtitle+"<br><br>";
                       html+="<strong>og:description: </strong><br>"+obj.ogdescription+"<br><br>";
                       html+="<strong>og:image: </strong><br><img src='"+obj.ogimage+"' width='200' height='200'><br><br>";
                       html+="<strong>og:video: </strong><br>"+obj.ogvideo+"<br><br>";
                       html+="<strong>Host: </strong><br>"+obj.host+"<br><br>";
                       html1+="<strong>links: </strong><br>"+obj.link+"<br><br>";
                       html1+="<strong>images: </strong><br><div style='width:500px;heigh:800px;overflow:scroll;border:1px solid #00FF00'>"+obj.image+"</div><br><br>";
                       $("#preview").attr("src",obj.previewurl);
                       $("#previewtxt").attr("href",value);
                       $("#source").html("<xmp>"+obj.source+"</xmp> ");
                       $("#output").html(html);
                       $("#output1").html(html1);
                    }
                  });
}   
  

}
}
    
