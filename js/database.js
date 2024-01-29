var mysql = require('mysql');
var conn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "ksiegarnia"
});


  conn.connect(function(err) {
    if (err) throw err;
    conn.query("SELECT * FROM konto", function (err, result, fields) {
      if (err) throw err;
      console.log(result);
    });
  });