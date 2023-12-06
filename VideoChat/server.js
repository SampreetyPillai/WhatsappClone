const express = require("express");
const app = express();
const server = require("http").Server(app);
const { v4: uuidv4 } = require("uuid");
//var mysql = 



app.set("view engine", "ejs");
const io = require("socket.io")(server, {
  cors: {
    origin: '*'
  }
});
var con = require('mysql').createConnection({
  host: "localhost",
  user: "root",
  password: "mysql_pass_23"
});





 

const { ExpressPeerServer } = require("peer");
const opinions = {
  debug: true,
}



app.use("/peerjs", ExpressPeerServer(server, opinions));
app.use(express.static("public"));

//const option = prompt("Enter your option");

app.get("/", (req, res) => {
  res.render("welcome");
});
app.get("/login", (req, res) => {
  res.redirect("/");
});

app.get("/register", (req, res) => {
  res.render("register");
});
app.get("/chatting",(req,res)=>{
  res.render("chatting");
})
app.get("/video", (req, res) => {

  res.redirect(`/video${uuidv4()}`);
  console.log("redirected");
});

app.get("/:room", (req, res) => {
  // res.render("chat-room");
  const id = req.params.room;
  if(id[0]=="1"){
    res.render("chatting", { roomId: req.params.room });
  }else{
    res.render("room", { roomId: req.params.room });
  }
  
  //console.log("asfasdfa ", roomId);
});




io.on("connection", (socket) => {
  socket.on("join-room", (roomId, userId, userName) => {
    socket.join(roomId);
    setTimeout(()=>{
      socket.to(roomId).broadcast.emit("user-connected", userId);
    }, 1000)
    socket.on("message", (message) => {
      io.to(roomId).emit("createMessage", message, userName);
    });
  });
});

server.listen(process.env.PORT || 3030);
