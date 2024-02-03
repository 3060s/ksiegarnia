const express = require('express');
const bodyParser = require('body-parser');
const mysql = require('mysql');
const app = express();
const port = 3000;

const conn = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database: "ksiegarnia"
});

conn.connect(err => {
    if (err) {
        console.error('Database connection error:', err);
        return;
    }
    console.log('Connected to MySQL database');
});

app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public'));

app.use((req, res, next) => {
    const username = req.headers.username;
    const password = req.headers.password;
    if (username && password) {
        conn.query('SELECT * FROM users WHERE username = ? AND password = ?', [username, password], (err, results) => {
            if (err) {
                console.error('Database query error:', err);
                res.status(500).send('Internal Server Error');
            } else {
                req.user = results[0];
                next();
            }
        });
    } else {
        next();
    }
});

app.post('/createAccount', (req, res) => {
    const { username, password } = req.body;
    // Check if the username is already taken
    conn.query('SELECT * FROM users WHERE username = ?', [username], (err, results) => {
        if (err) {
            console.error('Database query error:', err);
            res.status(500).send('Internal Server Error');
        } else {
            if (results.length > 0) {
                res.status(400).send('Username already taken. Please choose a different username.');
            } else {
                // Add the new user to the database
                conn.query('INSERT INTO users (username, password) VALUES (?, ?)', [username, password], (err) => {
                    if (err) {
                        console.error('Database query error:', err);
                        res.status(500).send('Internal Server Error');
                    } else {
                        res.send('Account created successfully!');
                    }
                });
            }
        }
    });
});

app.get('/', (req, res) => {
    res.sendFile(__dirname + '/index.html');
});

app.post('/login', (req, res) => {
    if (req.user) {
        res.send('Login successful.');
    } else {
        res.status(401).send('Authentication failed. Please check your username and password.');
    }
});

app.listen(port, () => {
    console.log(`Server is running at http://localhost:${port}`);
});