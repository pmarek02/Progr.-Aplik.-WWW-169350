<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CMS Project</title>
    <link rel="stylesheet" href="templates/styles.css">
    <link rel="stylesheet" href="/public/css/style_new.css">
    <style>
/* General Styles */
body {
    font-family: 'Roboto', sans-serif;
    background-color: #f5f5f5; /* Light grey background for a clean look */
    margin: 0;
    padding: 0;
    color: #333;
}
header {
    background-color: #4a90e2; /* Calm blue header */
    color: white;
    padding: 20px;
    text-align: center;
    font-size: 24px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}
footer {
    background-color: #333;
    color: white;
    text-align: center;
    padding: 10px;
    position: relative;
    bottom: 0;
    width: 100%;
    box-shadow: 0 -2px 4px rgba(0, 0, 0, 0.1);
}
.container {
    max-width: 1100px;
    margin: 20px auto;
    padding: 20px;
    background: white;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
button, .btn {
    background-color: #4a90e2;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
    transition: all 0.3s ease;
}
button:hover, .btn:hover {
    background-color: #357ab7; /* Darker blue on hover */
}
h1, h2, h3 {
    color: #4a90e2;
}
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    background: #fff;
}
table th, table td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: left;
}
table th {
    background-color: #4a90e2;
    color: white;
}
.card {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 20px 0;
    background-color: #fafafa;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
}
.alert {
    padding: 15px;
    background-color: #f8d7da;
    color: #721c24;
    margin-bottom: 20px;
    border-radius: 5px;
}
.success {
    padding: 15px;
    background-color: #d4edda;
    color: #155724;
    margin-bottom: 20px;
    border-radius: 5px;
}

/* Responsive Design */
@media (max-width: 768px) {
    header {
        font-size: 20px;
    }
    .container {
        padding: 10px;
    }
    table th, table td {
        padding: 8px;
    }
}
        
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Arial', sans-serif;
    line-height: 1.6;
    background: #f4f4f9;
    color: #333;
    padding: 0 20px;
}

/* Navigation */
nav {
    background: #0077b6;
    color: #fff;
    padding: 10px 20px;
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 5px;
}

nav a {
    color: #fff;
    text-decoration: none;
    margin: 0 10px;
    font-weight: bold;
}

nav a:hover {
    text-decoration: underline;
}

/* Buttons */
button {
    background: #0077b6;
    color: #fff;
    border: none;
    padding: 10px 15px;
    border-radius: 5px;
    cursor: pointer;
    font-size: 1rem;
}

button:hover {
    background: #005f8a;
}

/* Card Component */
.card {
    background: #fff;
    border: 1px solid #ddd;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    margin: 20px 0;
    padding: 20px;
    transition: transform 0.2s ease-in-out;
}

.card:hover {
    transform: scale(1.02);
}

/* Footer */
footer {
    background: #333;
    color: #fff;
    text-align: center;
    padding: 10px 0;
    margin-top: 20px;
}
        a {
            text-decoration: none;
            color: #4a90e2;
            font-weight: bold;
        }
        
    
        
</style>
</head>
<body>
    <header>
        <h1>CMS Management</h1>
    </header>
