const searchBar = document.querySelector(".search input"),
searchIcon = document.querySelector(".search button"),
usersList = document.querySelector(".users-list");
changeTheme = document.querySelector("#change-theme");
groupChat = document.querySelector("#group-chat");


// groupChat.onclick = ()=>{
//   // Create a new XMLHttpRequest object
//   var xhr = new XMLHttpRequest();

//   // Configure it: POST-request for the PHP file
//   xhr.open("POST", "php/Group-chat.php", true);


//   // Get the PHP session variable value
//   var sessionValue = "<?php echo isset($_SESSION['unique_id']) ? $_SESSION['unique_id'] : ''; ?>";

//   // Define the data to be sent
//   var postData = JSON.stringify({ sessionValue: sessionValue });

//   // Define what happens on successful data submission
//   xhr.onload = function() {
//       if (xhr.status == 200) {
//           console.log("POST request successful");
//           // Handle the response from the server if needed
//       }
//   };

//   // Define what happens in case of an error
//   xhr.onerror = function() {
//       console.error("Error during POST request");
//   };

//   // Send the request with the data
//   xhr.send(postData);
// };


changeTheme.onclick = ()=>{
var theme  = localStorage.getItem('theme');
console.log(theme);
console.log("asdfsdfsad");
if(theme=="theme-dark"){
  console.log("theme is currently dark");
 localStorage.removeItem('theme');
  localStorage.setItem('theme', "theme-light");
  console.log("cahnge theme to light");
  }else{
    console.log("theme is currently light");
    localStorage.removeItem('theme');
    localStorage.setItem('theme', "theme-dark");
    console.log("cahnge theme to dark");
  }
location.reload();
}


searchIcon.onclick = ()=>{
  searchBar.classList.toggle("show");
  searchIcon.classList.toggle("active");
  searchBar.focus();
  if(searchBar.classList.contains("active")){
    searchBar.value = "";
    searchBar.classList.remove("active");
  }
}

searchBar.onkeyup = ()=>{
  let searchTerm = searchBar.value;
  if(searchTerm != ""){
    searchBar.classList.add("active");
  }else{
    searchBar.classList.remove("active");
  }
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/search.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          usersList.innerHTML = data;
        }
    }
  }
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhr.send("searchTerm=" + searchTerm);
}

setInterval(() =>{
  let xhr = new XMLHttpRequest();
  xhr.open("GET", "php/users.php", true);
  xhr.onload = ()=>{
    if(xhr.readyState === XMLHttpRequest.DONE){
        if(xhr.status === 200){
          let data = xhr.response;
          if(!searchBar.classList.contains("active")){
            usersList.innerHTML = data;
          }
        }
    }
  }
  xhr.send();
}, 500);

