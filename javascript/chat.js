const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
disappearingMessages = document.getElementById("disappearing");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(true){
        sendBtn.classList.add("active");
    }else{
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
    var username = getCookieValue("curruser");
    //username+="true";
    var v = username + "=notify";
    document.cookie=v;
    console.log(v);
    console.log("adfsd", getCookieValue(getCookieValue("curruser")));
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
              }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
  }
  
function getCookieValue(name) 
  {
    const regex = new RegExp(`(^| )${name}=([^;]+)`)
    const match = document.cookie.match(regex)
    if (match) {
      return match[2]
    }
 }

 disappearingMessages.onclick = () =>{
    var current = getCookieValue("disappearing_messages");
    if(current=="off"){
        document.cookie = "disappearing_messages=on";
        //setCookie("disappearing_messages","on", 1);
        console.log(getCookieValue("disappearing_messages"));
    }else{
        document.cookie = "disappearing_messages=off";
        //setCookie("disappearing_messages","off", 1);
        console.log(getCookieValue("disappearing_messages"));
    }

 }
// disappearingMessages.onclick = ()=>{
//     setcookie("DisappearingMessage", $value, time()+3600, "/", "example.com");
//   }
  