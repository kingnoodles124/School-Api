<!DOCTYPE html>
<html>
<head>
    <title>API Login Test</title>
</head>
<body>

<h2>Admin Login (API Test)</h2>

<form id="loginForm">
    <label>Email:</label><br>
    <input type="email" id="email" value="admin@example.com"><br><br>

    <label>Password:</label><br>
    <input type="password" id="password" value="password"><br><br>

    <button type="button" onclick="login()">Login</button>
</form>

<hr>

<h3>Response:</h3>
<pre id="responseBox" style="border:1px solid #ddd; padding:10px;"></pre>

<script>
function login() {
    fetch('/api/admin/login', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            email: document.getElementById('email').value,
            password: document.getElementById('password').value
        })
    })
    .then(res => res.json())
    .then(data => {
        document.getElementById('responseBox').textContent =
            JSON.stringify(data, null, 4);
    });
}
</script>

</body>
</html>
