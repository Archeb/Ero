window.commentMode=0; //0为邮箱Gravatar，1为使用QQ头像
window.TypechoComment={
    reply: function(el,id){
        var replyEl=document.querySelector('.reply-info');
        replyEl.classList.remove('reply-info-closed');
        replyEl.querySelector('#reply-name').innerText=document.getElementById(el).querySelector('.comment-author-name').innerText;
        document.getElementById('comment-parent').value=id;
        document.documentElement.scrollTo({"behavior": "smooth", "top":replyEl.offsetTop-500});
    },

    cancelReply: function(){
        var replyEl=document.querySelector('.reply-info');
        replyEl.classList.add('reply-info-closed');
        document.getElementById('comment-parent').value="";
    }
}

function changeCommentAvatarMode(){
    if(window.commentMode==0){
        document.querySelector('#avatarMode').style.d="path('M3.18,13.54C3.76,12.16 4.57,11.14 5.17,10.92C5.16,10.12 5.31,9.62 5.56,9.22C5.56,9.19 5.5,8.86 5.72,8.45C5.87,4.85 8.21,2 12,2C15.79,2 18.13,4.85 18.28,8.45C18.5,8.86 18.44,9.19 18.44,9.22C18.69,9.62 18.84,10.12 18.83,10.92C19.43,11.14 20.24,12.16 20.82,13.55C21.57,15.31 21.69,17 21.09,17.3C20.68,17.5 20.03,17 19.42,16.12C19.18,17.1 18.58,18 17.73,18.71C18.63,19.04 19.21,19.58 19.21,20.19C19.21,21.19 17.63,22 15.69,22C13.93,22 12.5,21.34 12.21,20.5H11.79C11.5,21.34 10.07,22 8.31,22C6.37,22 4.79,21.19 4.79,20.19C4.79,19.58 5.37,19.04 6.27,18.71C5.42,18 4.82,17.1 4.58,16.12C3.97,17 3.32,17.5 2.91,17.3C2.31,17 2.43,15.31 3.18,13.54Z')";
        document.querySelector('#mail').placeholder="请输入QQ号";
        window.commentMode=1;
    }else{
        document.querySelector('#avatarMode').style.d="path('M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z')";
        document.querySelector('#mail').placeholder="←点此使用QQ头像";
        window.commentMode=0;
        
    }
}

function parseToDOM(str){
   var div = document.createElement("div");
   if(typeof str == "string")
       div.innerHTML = str;
   return div.childNodes;
}

function sendComment(){
    var form=document.querySelector('#comment-form');
    var data = new FormData(form);
    if(window.commentMode==1){
        data.set("mail",data.get('mail')+"@qq.com");
    }
    fetch(form.action,{credentials:'include',method: "POST",body:data}).then(function(data){return data.text()}).then(function(text){
        if(text.indexOf('Error')!=-1){
            alert(parseToDOM(text)[7].innerText.trim());
        }else{
            var newComment=document.querySelector('#comments>li');
            if(newComment.querySelector('.comment-children')){newComment.removeChild(newComment.querySelector('.comment-children'))};
            newComment.querySelector('.comment-author-name').innerText=data.get('author');
            newComment.querySelector('.avatar').src='https://gravatar.cat.net/avatar/' + data.get('mail').MD5(32) + '?s=55&r=G&d=';
            newComment.querySelector('.comment-content').innerHTML='<p>' + data.get('text') + '</p>';
            newComment.querySelector('.comment-time').innerText=new Date().toISOString().replace('T',' ').substr(0,new Date().toISOString().replace('T',' ').lastIndexOf(':'));
            var comment_list=document.querySelector('.comment-list')
            if(!comment_list){
                comment_list=document.createElement('ol');
                comment_list.classList.add('comment-list');
                document.querySelector('#comments').appendChild(comment_list);
            }
            comment_list.appendChild(newComment);
            alert('评论成功');
        }
    });
}

//MD5
String.prototype.MD5 = function (bit)
{
    var sMessage = this;
    function RotateLeft(lValue, iShiftBits) { return (lValue<<iShiftBits) | (lValue>>>(32-iShiftBits)); } 
    function AddUnsigned(lX,lY)
    {
        var lX4,lY4,lX8,lY8,lResult;
        lX8 = (lX & 0x80000000);
        lY8 = (lY & 0x80000000);
        lX4 = (lX & 0x40000000);
        lY4 = (lY & 0x40000000);
        lResult = (lX & 0x3FFFFFFF)+(lY & 0x3FFFFFFF); 
        if (lX4 & lY4) return (lResult ^ 0x80000000 ^ lX8 ^ lY8); 
        if (lX4 | lY4)
        { 
            if (lResult & 0x40000000) return (lResult ^ 0xC0000000 ^ lX8 ^ lY8); 
            else return (lResult ^ 0x40000000 ^ lX8 ^ lY8); 
        } else return (lResult ^ lX8 ^ lY8); 
    } 
    function F(x,y,z) { return (x & y) | ((~x) & z); } 
    function G(x,y,z) { return (x & z) | (y & (~z)); } 
    function H(x,y,z) { return (x ^ y ^ z); } 
    function I(x,y,z) { return (y ^ (x | (~z))); } 
    function FF(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(F(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function GG(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(G(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function HH(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(H(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function II(a,b,c,d,x,s,ac)
    { 
        a = AddUnsigned(a, AddUnsigned(AddUnsigned(I(b, c, d), x), ac)); 
        return AddUnsigned(RotateLeft(a, s), b); 
    } 
    function ConvertToWordArray(sMessage)
    { 
        var lWordCount; 
        var lMessageLength = sMessage.length; 
        var lNumberOfWords_temp1=lMessageLength + 8; 
        var lNumberOfWords_temp2=(lNumberOfWords_temp1-(lNumberOfWords_temp1 % 64))/64; 
        var lNumberOfWords = (lNumberOfWords_temp2+1)*16; 
        var lWordArray=Array(lNumberOfWords-1); 
        var lBytePosition = 0; 
        var lByteCount = 0; 
        while ( lByteCount < lMessageLength )
        { 
            lWordCount = (lByteCount-(lByteCount % 4))/4; 
            lBytePosition = (lByteCount % 4)*8; 
            lWordArray[lWordCount] = (lWordArray[lWordCount] | (sMessage.charCodeAt(lByteCount)<<lBytePosition)); 
            lByteCount++; 
        } 
        lWordCount = (lByteCount-(lByteCount % 4))/4; 
        lBytePosition = (lByteCount % 4)*8; 
        lWordArray[lWordCount] = lWordArray[lWordCount] | (0x80<<lBytePosition); 
        lWordArray[lNumberOfWords-2] = lMessageLength<<3; 
        lWordArray[lNumberOfWords-1] = lMessageLength>>>29; 
        return lWordArray; 
    } 
    function WordToHex(lValue)
    { 
        var WordToHexValue="",WordToHexValue_temp="",lByte,lCount; 
        for (lCount = 0;lCount<=3;lCount++)
        { 
            lByte = (lValue>>>(lCount*8)) & 255; 
            WordToHexValue_temp = "0" + lByte.toString(16); 
            WordToHexValue = WordToHexValue + WordToHexValue_temp.substr(WordToHexValue_temp.length-2,2); 
        } 
        return WordToHexValue; 
    } 
    var x=Array(); 
    var k,AA,BB,CC,DD,a,b,c,d 
    var S11=7, S12=12, S13=17, S14=22; 
    var S21=5, S22=9 , S23=14, S24=20; 
    var S31=4, S32=11, S33=16, S34=23; 
    var S41=6, S42=10, S43=15, S44=21; 
    // Steps 1 and 2. Append padding bits and length and convert to words 
    x = ConvertToWordArray(sMessage); 
    // Step 3. Initialise 
    a = 0x67452301; b = 0xEFCDAB89; c = 0x98BADCFE; d = 0x10325476; 
    // Step 4. Process the message in 16-word blocks 
    for (k=0;k<x.length;k+=16)
    { 
        AA=a; BB=b; CC=c; DD=d; 
        a=FF(a,b,c,d,x[k+0], S11,0xD76AA478); 
        d=FF(d,a,b,c,x[k+1], S12,0xE8C7B756); 
        c=FF(c,d,a,b,x[k+2], S13,0x242070DB); 
        b=FF(b,c,d,a,x[k+3], S14,0xC1BDCEEE); 
        a=FF(a,b,c,d,x[k+4], S11,0xF57C0FAF); 
        d=FF(d,a,b,c,x[k+5], S12,0x4787C62A); 
        c=FF(c,d,a,b,x[k+6], S13,0xA8304613); 
        b=FF(b,c,d,a,x[k+7], S14,0xFD469501); 
        a=FF(a,b,c,d,x[k+8], S11,0x698098D8); 
        d=FF(d,a,b,c,x[k+9], S12,0x8B44F7AF); 
        c=FF(c,d,a,b,x[k+10],S13,0xFFFF5BB1); 
        b=FF(b,c,d,a,x[k+11],S14,0x895CD7BE); 
        a=FF(a,b,c,d,x[k+12],S11,0x6B901122); 
        d=FF(d,a,b,c,x[k+13],S12,0xFD987193); 
        c=FF(c,d,a,b,x[k+14],S13,0xA679438E); 
        b=FF(b,c,d,a,x[k+15],S14,0x49B40821); 
        a=GG(a,b,c,d,x[k+1], S21,0xF61E2562); 
        d=GG(d,a,b,c,x[k+6], S22,0xC040B340); 
        c=GG(c,d,a,b,x[k+11],S23,0x265E5A51); 
        b=GG(b,c,d,a,x[k+0], S24,0xE9B6C7AA); 
        a=GG(a,b,c,d,x[k+5], S21,0xD62F105D); 
        d=GG(d,a,b,c,x[k+10],S22,0x2441453); 
        c=GG(c,d,a,b,x[k+15],S23,0xD8A1E681); 
        b=GG(b,c,d,a,x[k+4], S24,0xE7D3FBC8); 
        a=GG(a,b,c,d,x[k+9], S21,0x21E1CDE6); 
        d=GG(d,a,b,c,x[k+14],S22,0xC33707D6); 
        c=GG(c,d,a,b,x[k+3], S23,0xF4D50D87); 
        b=GG(b,c,d,a,x[k+8], S24,0x455A14ED); 
        a=GG(a,b,c,d,x[k+13],S21,0xA9E3E905); 
        d=GG(d,a,b,c,x[k+2], S22,0xFCEFA3F8); 
        c=GG(c,d,a,b,x[k+7], S23,0x676F02D9); 
        b=GG(b,c,d,a,x[k+12],S24,0x8D2A4C8A); 
        a=HH(a,b,c,d,x[k+5], S31,0xFFFA3942); 
        d=HH(d,a,b,c,x[k+8], S32,0x8771F681); 
        c=HH(c,d,a,b,x[k+11],S33,0x6D9D6122); 
        b=HH(b,c,d,a,x[k+14],S34,0xFDE5380C); 
        a=HH(a,b,c,d,x[k+1], S31,0xA4BEEA44); 
        d=HH(d,a,b,c,x[k+4], S32,0x4BDECFA9); 
        c=HH(c,d,a,b,x[k+7], S33,0xF6BB4B60); 
        b=HH(b,c,d,a,x[k+10],S34,0xBEBFBC70); 
        a=HH(a,b,c,d,x[k+13],S31,0x289B7EC6); 
        d=HH(d,a,b,c,x[k+0], S32,0xEAA127FA); 
        c=HH(c,d,a,b,x[k+3], S33,0xD4EF3085); 
        b=HH(b,c,d,a,x[k+6], S34,0x4881D05); 
        a=HH(a,b,c,d,x[k+9], S31,0xD9D4D039); 
        d=HH(d,a,b,c,x[k+12],S32,0xE6DB99E5); 
        c=HH(c,d,a,b,x[k+15],S33,0x1FA27CF8); 
        b=HH(b,c,d,a,x[k+2], S34,0xC4AC5665); 
        a=II(a,b,c,d,x[k+0], S41,0xF4292244); 
        d=II(d,a,b,c,x[k+7], S42,0x432AFF97); 
        c=II(c,d,a,b,x[k+14],S43,0xAB9423A7); 
        b=II(b,c,d,a,x[k+5], S44,0xFC93A039); 
        a=II(a,b,c,d,x[k+12],S41,0x655B59C3); 
        d=II(d,a,b,c,x[k+3], S42,0x8F0CCC92); 
        c=II(c,d,a,b,x[k+10],S43,0xFFEFF47D); 
        b=II(b,c,d,a,x[k+1], S44,0x85845DD1); 
        a=II(a,b,c,d,x[k+8], S41,0x6FA87E4F); 
        d=II(d,a,b,c,x[k+15],S42,0xFE2CE6E0); 
        c=II(c,d,a,b,x[k+6], S43,0xA3014314); 
        b=II(b,c,d,a,x[k+13],S44,0x4E0811A1); 
        a=II(a,b,c,d,x[k+4], S41,0xF7537E82); 
        d=II(d,a,b,c,x[k+11],S42,0xBD3AF235); 
        c=II(c,d,a,b,x[k+2], S43,0x2AD7D2BB); 
        b=II(b,c,d,a,x[k+9], S44,0xEB86D391); 
        a=AddUnsigned(a,AA); b=AddUnsigned(b,BB); c=AddUnsigned(c,CC); d=AddUnsigned(d,DD); 
    }
    if(bit==32)
    {
        return WordToHex(a)+WordToHex(b)+WordToHex(c)+WordToHex(d);
    }
    else
    {
        return WordToHex(b)+WordToHex(c);
    }
}