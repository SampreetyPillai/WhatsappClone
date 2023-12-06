var con = require('mysql').createConnection({
    host: "localhost",
    user: "root",
    password: "mysql_pass_23"
  });
  
  
  
function mt(){
    con.connect(function(err) {
      // if (err) throw err;
      if(err) {
       console.log("not connected");
      }
      else{
       console.log("Connected!");
      }
      con.query("CREATE DATABASE IF NOT EXISTS mydb", function (err, result) {
       if (err) throw err;
       console.log("Database created");
     });
     });
  }

module.exports = mt;