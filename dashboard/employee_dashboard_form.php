<?php
session_start();
if (!isset($_SESSION['name'])) {
    header("Location: ../login/login_form.php"); // Redirect to login if user is not logged in
    exit();
}
$username = $_SESSION['name'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #e0eafc, #cfdef3); /* Professional blue gradient */
            margin: 0;
            padding: 0;
        }

        .container {
            text-align: center;
            margin-top: 50px;
        }

        h1 {
            font-size: 36px;
            color: #2c3e50;
            margin-bottom: 70px;
        }

        .circle-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 80px;
            margin-top: 40px;
        }

        .circle {
            width: 230px;
            height: 230px;
            border-radius: 40%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            color: white;
            cursor: pointer;
            transition: transform 0.3s ease;
            font-weight: bold;
        }

        .circle:hover {
            transform: scale(1.1);
        }

        .circle-1 { background-color: #2e86de; } /* Blue */
        .circle-2 { background-color: #45aaf2; } /* Light Blue */
        .circle-3 { background-color: #1e3799; } /* Navy Blue */
        .circle-4 { background-color: #38ada9; } /* Teal */
        .circle-5 { background-color: #596275; } /* Grey Blue */
        .circle-6 { background-color: #3c6382; } /* Muted Blue */
        .circle-7 { background-color: #0a3d62; } /* Deep Blue */
        .circle-8 { background-color: #60a3bc; } /* Soft Blue */

        .logout-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 12px 25px;
            background-color: #c0392b;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .logout-btn:hover {
            background-color: #a93226;
        }
    </style>
</head>
<body>

    <div class="container">
        <!-- Welcome Text -->
        <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>

        <!-- Circle Icons for different actions -->
        <div class="circle-container">
            <div class="circle circle-1" onclick="window.location.href='../apply_leave/apply_leave_form.php'">Apply Leave</div>
            <div class="circle circle-2" onclick="window.location.href='../view_balance/view_balance.php'">View Balance</div>
            <div class="circle circle-3" onclick="window.location.href='../leave_history/leave_history_form.php'">Leave History</div>
            <div class="circle circle-4" onclick="window.location.href='../modify_leave/modify_leave_form.php'">Modify Leave</div>
            <div class="circle circle-5" onclick="window.location.href='../check_status/check_status.php'">Request_status</div>
            <div class="circle circle-6" onclick="window.location.href='../leave_policies/leave_policies.php'">Leave Policies</div>
            <div class="circle circle-7" onclick="window.location.href='../cancel_leave/cancel_leave_form.php'">Cancel Leave</div>
        </div>

        <!-- Logout Button -->
        <button class="logout-btn" onclick="window.location.href='../login/login_form.php'">Logout</button>
    </div>
<!-- Chatbot Button & Window -->
<style>
#chatbot-icon {
    position: fixed;
    bottom: 20px;
    left: 20px;
    background-color: #007bff;
    color: white;
    border: none;
    border-radius: 50%;
    width: 60px;
    height: 60px;
    font-size: 30px;
    cursor: pointer;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 999;
}

#chatbot-container {
    position: fixed;
    bottom: 90px;
    left: 20px;
    width: 300px;
    max-height: 400px;
    background-color: white;
    border: 1px solid #ccc;
    border-radius: 10px;
    display: none;
    flex-direction: column;
    justify-content: space-between;
    box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    z-index: 999;
    overflow: hidden;
}

#chatbot-header {
    background-color: #007bff;
    color: white;
    padding: 10px;
    font-weight: bold;
}

#chatbot-messages {
    padding: 10px;
    height: 250px;
    overflow-y: auto;
    font-size: 14px;
}

#chatbot-input {
    display: flex;
    border-top: 1px solid #ccc;
}

#chatbot-input input {
    flex: 1;
    padding: 10px;
    border: none;
    outline: none;
}

#chatbot-input button {
    padding: 10px;
    border: none;
    background-color: #007bff;
    color: white;
    cursor: pointer;
}
</style>

<div id="chatbot-container">
    <div id="chatbot-header">ChatBot</div>
    <div id="chatbot-messages"></div>
    <div id="chatbot-input">
        <input type="text" id="chatbot-text" placeholder="Type a message...">
        <button onclick="sendChat()">Send</button>
    </div>
</div>

<button id="chatbot-icon" onclick="toggleChat()">💬</button>

<script>
function toggleChat() {
    var chat = document.getElementById("chatbot-container");
    chat.style.display = (chat.style.display === "flex") ? "none" : "flex";
}

function sendChat() {
    var input = document.getElementById("chatbot-text");
    var messages = document.getElementById("chatbot-messages");
    var userText = input.value.trim();
    if (userText === "") return;

    messages.innerHTML += `<div><strong>You:</strong> ${userText}</div>`;
    input.value = "";

    // Simple bot logic
    let botReply = "Sorry, I don't understand.";
    if (userText.toLowerCase().includes("leave balance")) {
        botReply = "You can check your leave balance using the 'View Balance' option.";
    } else if (userText.toLowerCase().includes("apply leave")) {
        botReply = "To apply for leave, click on the 'Apply Leave' button.";
    } else if (userText.toLowerCase().includes("hello") || userText.toLowerCase().includes("hi")) {
        botReply = "Hello! How can I assist you with your leave?";
    }

    setTimeout(() => {
        messages.innerHTML += `<div><strong>Bot:</strong> ${botReply}</div>`;
        messages.scrollTop = messages.scrollHeight;
    }, 500);
}
</script>



</body>
</html>
