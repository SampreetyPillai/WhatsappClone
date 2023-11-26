<!DOCTYPE html>
<!-- Coding By CodingNepal - youtube.com/codingnepal -->
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Realtime Chat App | CodingNepal</title>
  <link id = "setStyle" rel="stylesheet" href="style.css">
  <script> 
  var st = document.querySelector('#setStyle');
var theme = localStorage.getItem('theme');
if(theme=="theme-light"){
st.href = "style.css";
console.log('Theme is set to light in header');
}else{
  st.href = "style2.css";
console.log('Theme is set to dark in header');
}
</script>   
  
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
</head>