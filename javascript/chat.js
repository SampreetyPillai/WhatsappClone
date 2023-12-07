const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");
disappearingMessages = document.getElementById("disappearing");
t = 0;
pageStart = 0;
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

let audioIN = { audio: true };
// audio is true, for recording

// Access the permission for use
// the microphone
navigator.mediaDevices.getUserMedia(audioIN)

// 'then()' method returns a Promise
.then(function (mediaStreamObj) {

    // Connect the media stream to the
    // first audio element
    // let audio = document.querySelector('audio');
    // if ("srcObject" in audio) {
    // audio.srcObject = mediaStreamObj;
    // }
    // else { // Old version
    // audio.src = window.URL
    //     .createObjectURL(mediaStreamObj);
    // }

    // It will play the audio
    // audio.onloadedmetadata = function (ev) {

    // // Play the audio in the 2nd audio
    // // element what is being recorded
    // if(t!=0) audio.play();
    // };

    // Start record
    let start = document.getElementById('btnStart');

    // 2nd audio tag for play the audio
    //let playAudio = document.getElementById('adioPlay');

    // This is the main thing to recorded 
    // the audio 'MediaRecorder' API
    let mediaRecorder = new MediaRecorder(mediaStreamObj);
    start.addEventListener('click', function (ev) {
        
       
        if(t==0) {
            mediaRecorder.start();
            console.log("started recording");
            t = 1;
        }else {
            mediaRecorder.stop();
            console.log("stopped recording");
            t = 0;
        }
    })


    mediaRecorder.ondataavailable = function (ev) {
    dataArray.push(ev.data);
    }

    // Chunk array to store the audio data 
    let dataArray = [];

    // Convert the audio data in to blob 
    // after stopping the recording
    mediaRecorder.onstop = function (ev) {

    // blob of type mp3
    console.log("Asdfsd");
    let audioData = new Blob(dataArray, 
                { 'type': 'audio/mp3;' });
    
    dataArray = [];
    let audioSrc = window.URL
        .createObjectURL(audioData);
        console.log(audioSrc);
        
        var link = document.getElementById("link"); // Or maybe get it from the current document
    link.href = audioSrc;
    link.download = "AudioFile.mp3";
    link.style.visiblity="visible";
   // window.download(audioSrc, "AudioFile.mp3");
    link.innerHTML = "Click here to download the file";
    //document.body.appendChild(link); // Or append it whereever you want

    //playAudio.src = audioSrc;
    }
});

// If any error occurs then handles the error 
// .catch(function (err) {
//     console.log(err.name, err.message);
// });
  