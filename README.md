🛒 Auction Site with Chatbot (Final Project)

A full-stack auction platform integrated with an intelligent chatbot to assist users in real-time. This project demonstrates web development, backend integration, and conversational AI using Python.

🚀 Overview

This project is an auction-based web application where users can interact with a chatbot for assistance, queries, and navigation. The chatbot is powered by NLP techniques and runs as a separate Python service.

🧠 Features

💬 Real-time chatbot for user assistance

🛍️ Auction-style platform UI

🔗 Integration between frontend and chatbot backend

⚡ Flask-based chatbot server

📚 Uses ChatterBot corpus for training

🏗️ Tech Stack

Frontend

HTML, CSS, JavaScript

Hosted via XAMPP / WAMP

Backend (Chatbot)

Python

Flask

ChatterBot

📂 Project Structure
Auction-Site-With-Chatbot-Final/
│
├── client_chat/        # Frontend files (UI + chat interface)
├── chatbot/            # Python chatbot code
├── app.py              # Flask app entry point
├── requirements.txt    # Python dependencies
└── README.md
⚙️ Setup Instructions
1. Clone the Repository
git clone https://github.com/YOUR_USERNAME/Auction-Site-With-Chatbot-Final.git
cd Auction-Site-With-Chatbot-Final
2. Setup Frontend (XAMPP / WAMP)

Install XAMPP or WAMP

Copy the client_chat folder into:

XAMPP → htdocs/

WAMP → www/

Start Apache server

Open in browser:

http://localhost/client_chat
3. Setup Chatbot (Python)
Install Dependencies
pip install -r requirements.txt
Run the Chatbot Server
python app.py

The chatbot will start on:

http://localhost:5000
🔗 Integration Notes

Ensure Flask server is running before using the chat feature

Frontend communicates with chatbot via API calls

Update API endpoints in frontend if port/config changes

📌 Important Notes

Make sure all Python dependencies are installed properly

ChatterBot may require additional setup depending on version

Use a virtual environment for better dependency management

🧪 Future Improvements

Add authentication system

Improve chatbot accuracy with custom training

Deploy to cloud (AWS / Heroku)

Add real-time bidding system

👨‍💻 Author

Parth Sapre

Data Engineer | AI Enthusiast
