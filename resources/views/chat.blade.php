@extends('layouts.admin.index')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>

    <!-- Firebase Compat SDK -->
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-database-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-storage-compat.js"></script>
    <script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-auth-compat.js"></script>

    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        .chat-container {
            display: flex;
            height: 80vh;
            border: 1px solid #ccc;
            border-radius: 8px;
            overflow: hidden;
            background-color: #f8f9fa;
        }
        .chat-sidebar {
            width: 25%;
            border-right: 1px solid #ddd;
            padding: 1rem;
            background: #fff;
        }
        .chat-sidebar h4 {
            margin-bottom: 0.5rem;
            color: #333;
        }
        .chat-sidebar small {
            color: #666;
        }
        .user-list {
            margin-top: 1rem;
        }
        .user-item {
            padding: 0.5rem;
            cursor: pointer;
            border-radius: 4px;
            margin-bottom: 0.25rem;
            transition: background-color 0.2s;
        }
        .user-item:hover {
            background-color: #f0f0f0;
        }
        .user-item.active {
            background-color: #007bff;
            color: white;
        }
        .chat-window {
            width: 75%;
            display: flex;
            flex-direction: column;
            background: #eef1f4;
        }
        .chat-header {
            padding: 1rem;
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
            display: flex;
            align-items: center;
        }
        .chat-header .status {
            margin-left: 10px;
            font-size: 0.8rem;
            color: #666;
        }
        #chatMessages {
            flex: 1;
            padding: 1rem;
            overflow-y: auto;
            background: #f8f9fa;
        }
        .chat-input {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: #fff;
            border-top: 1px solid #ddd;
            position: relative;
        }
        .chat-input input[type="text"] {
            flex: 1;
            padding: 0.75rem;
            border: 1px solid #ccc;
            border-radius: 20px;
            outline: none;
            font-size: 14px;
        }
        .chat-input input[type="text"]:focus {
            border-color: #007bff;
        }
        .chat-input button {
            margin-left: 0.5rem;
            border: none;
            background: none;
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
            border-radius: 50%;
            transition: background-color 0.2s;
        }
        .chat-input button:hover {
            background-color: #f0f0f0;
        }
        .message-bubble {
            margin-bottom: 12px;
            padding: 12px 16px;
            background: #fff;
            border-radius: 18px;
            max-width: 70%;
            clear: both;
            word-wrap: break-word;
            box-shadow: 0 1px 2px rgba(0,0,0,0.1);
            position: relative;
        }
        .message-bubble.you {
            background: #007bff;
            color: white;
            margin-left: auto;
            border-bottom-right-radius: 4px;
        }
        .message-bubble.other {
            background: #e9ecef;
            color: #333;
            border-bottom-left-radius: 4px;
        }
        .message-info {
            font-size: 0.75rem;
            opacity: 0.7;
            margin-top: 4px;
        }
        .message-info .sender-name {
            font-weight: 600;
        }
        .message-info .timestamp {
            margin-left: 8px;
        }
        .message-img {
            max-width: 200px;
            max-height: 200px;
            border-radius: 12px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .message-img:hover {
            transform: scale(1.05);
        }
        emoji-picker {
            position: absolute;
            bottom: 70px;
            right: 60px;
            z-index: 1000;
        }
        .empty-chat {
            text-align: center;
            color: #666;
            padding: 2rem;
            font-style: italic;
        }
        .typing-indicator {
            padding: 8px 16px;
            background: #e9ecef;
            border-radius: 18px;
            margin-bottom: 12px;
            max-width: 100px;
            opacity: 0.7;
        }
        .typing-dots {
            display: flex;
            align-items: center;
            gap: 4px;
        }
        .typing-dots span {
            width: 6px;
            height: 6px;
            background: #666;
            border-radius: 50%;
            animation: typing 1.4s infinite;
        }
        .typing-dots span:nth-child(2) {
            animation-delay: 0.2s;
        }
        .typing-dots span:nth-child(3) {
            animation-delay: 0.4s;
        }
        @keyframes typing {
            0%, 60%, 100% {
                transform: translateY(0);
            }
            30% {
                transform: translateY(-10px);
            }
        }
    </style>

    <div class="chat-container">
        <div class="chat-sidebar">
            <h4>{{ auth()->user()->name }}</h4>
            <small>Online</small>
            <div class="user-list">
                <div class="user-item active">
                    <strong>{{ auth()->user()->name }}</strong>
                    <small class="d-block">Private Notes</small>
                </div>
            </div>
        </div>
        <div class="chat-window">
            <div class="chat-header">
                <span>{{ auth()->user()->name }}</span>
                <span class="status">Private Chat</span>
            </div>
            <div id="chatMessages">
                <div class="empty-chat">
                    Start typing to begin your private conversation...
                </div>
            </div>
            <div class="chat-input">
                <button id="emojiBtn" type="button" title="Add Emoji">😊</button>
                <button id="imageBtn" type="button" title="Upload Image">📎</button>
                <input type="file" id="imageInput" accept="image/*" style="display: none" />
                <input type="text" id="messageInput" placeholder="Type a message..." autocomplete="off" />
                <button id="sendBtn" type="button" title="Send Message">➤</button>
                <emoji-picker id="emojiPicker" style="display: none;"></emoji-picker>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Firebase config from .env via blade
            const firebaseConfig = {
                apiKey: "{{ env('FIREBASE_API_KEY') }}",
                authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
                databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
                projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
                storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
                messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
                appId: "{{ env('FIREBASE_APP_ID') }}"
            };

            // Initialize Firebase app
            firebase.initializeApp(firebaseConfig);

            const db = firebase.database();
            const storage = firebase.storage();
            const auth = firebase.auth();

            // User info - sesuaikan dengan struktur Firebase
            const currentUser = {
                id: "{{ auth()->user()->id }}",
                name: "{{ auth()->user()->name }}",
                email: "{{ auth()->user()->email ?? '' }}"
            };

            // Buat user identifier yang konsisten
            const userId = `user${currentUser.id}`;
            const chatRoom = `guru_1_user115`;
            
            // Reference ke chat room sesuai struktur Firebase
            const roomRef = db.ref(`guruChats/${chatRoom}`);

            // Sign in anonymously
            auth.signInAnonymously().catch(error => {
                console.error('Firebase Auth Error:', error);
            });

            // DOM elements
            const emojiBtn = document.getElementById('emojiBtn');
            const emojiPicker = document.getElementById('emojiPicker');
            const messageInput = document.getElementById('messageInput');
            const sendBtn = document.getElementById('sendBtn');
            const chatMessages = document.getElementById('chatMessages');
            const imageBtn = document.getElementById('imageBtn');
            const imageInput = document.getElementById('imageInput');

            let isFirstMessage = true;

            // Utility function untuk format waktu
            const formatTimestamp = (timestamp) => {
                const date = new Date(timestamp);
                const now = new Date();
                const diffTime = Math.abs(now - date);
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

                if (diffDays === 1) {
                    return date.toLocaleTimeString('en-US', { 
                        hour: '2-digit', 
                        minute: '2-digit',
                        hour12: false 
                    });
                } else {
                    return date.toLocaleDateString('en-US', { 
                        month: 'short', 
                        day: 'numeric',
                        hour: '2-digit', 
                        minute: '2-digit',
                        hour12: false 
                    });
                }
            };

            // Toggle emoji picker
            emojiBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (emojiPicker.style.display === 'none' || !emojiPicker.style.display) {
                    emojiPicker.style.display = 'block';
                } else {
                    emojiPicker.style.display = 'none';
                }
            });

            // Hide emoji picker when clicking outside
            document.addEventListener('click', (e) => {
                if (!emojiPicker.contains(e.target) && e.target !== emojiBtn) {
                    emojiPicker.style.display = 'none';
                }
            });

            // When emoji clicked, add to input
            emojiPicker.addEventListener('emoji-click', e => {
                messageInput.value += e.detail.unicode;
                emojiPicker.style.display = 'none';
                messageInput.focus();
            });

            // Open file selector on image button click
            imageBtn.addEventListener('click', () => imageInput.click());

            // Handle image upload
            imageInput.addEventListener('change', () => {
                const file = imageInput.files[0];
                if (!file) return;

                // Validasi ukuran file (max 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('File size too large. Maximum 5MB allowed.');
                    return;
                }

                const timestamp = Date.now();
                const fileRef = storage.ref(`images/${chatRoom}/${timestamp}_${file.name}`);

                // Show uploading indicator
                const uploadDiv = document.createElement('div');
                uploadDiv.className = 'message-bubble you';
                uploadDiv.innerHTML = '<em>Uploading image...</em>';
                chatMessages.appendChild(uploadDiv);
                chatMessages.scrollTop = chatMessages.scrollHeight;

                fileRef.put(file).then(snapshot => {
                    return snapshot.ref.getDownloadURL();
                }).then(url => {
                    // Remove uploading indicator
                    chatMessages.removeChild(uploadDiv);

                    // Struktur pesan sesuai dengan Firebase
                    const messageData = {
                        id: `${timestamp}_${Math.random().toString(36).substr(2, 9)}`,
                        senderId: userId,
                        senderName: currentUser.name,
                        imageUrl: url,
                        timestamp: timestamp
                    };

                    return roomRef.child(messageData.id).set(messageData);
                }).catch(err => {
                    console.error('Error uploading image:', err);
                    chatMessages.removeChild(uploadDiv);
                    alert('Failed to upload image. Please try again.');
                });

                imageInput.value = ''; // reset input
            });

            // Send message function
            const sendMessage = () => {
                const text = messageInput.value.trim();
                if (!text) return;

                const timestamp = Date.now();
                const messageId = `${timestamp}_${Math.random().toString(36).substr(2, 9)}`;

                // Struktur pesan sesuai dengan Firebase yang ditunjukkan
                const messageData = {
                    id: messageId,
                    senderId: userId,
                    senderName: currentUser.name,
                    text: text,
                    timestamp: timestamp
                };

                roomRef.child(messageId).set(messageData).then(() => {
                    messageInput.value = '';
                }).catch(err => {
                    console.error('Error sending message:', err);
                    alert('Failed to send message. Please try again.');
                });
            };

            // Send message on send button click
            sendBtn.addEventListener('click', sendMessage);

            // Send message on Enter key
            messageInput.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    sendMessage();
                }
            });

            // Listen to new messages and display
            roomRef.orderByChild('timestamp').on('child_added', (snapshot) => {
                const messageData = snapshot.val();
                
                // Remove empty chat message if it exists
                if (isFirstMessage) {
                    const emptyChat = chatMessages.querySelector('.empty-chat');
                    if (emptyChat) {
                        emptyChat.remove();
                    }
                    isFirstMessage = false;
                }

                const messageDiv = document.createElement('div');
                messageDiv.className = 'message-bubble';

                // Determine if message is from current user
                const isCurrentUser = messageData.senderId === userId;
                messageDiv.classList.add(isCurrentUser ? 'you' : 'other');

                // Create message content
                let messageContent = '';
                
                if (messageData.text) {
                    messageContent += `<div class="message-text">${messageData.text}</div>`;
                }

                if (messageData.imageUrl) {
                    messageContent += `<div class="message-image">
                        <img src="${messageData.imageUrl}" class="message-img" alt="Shared image" 
                             onclick="window.open('${messageData.imageUrl}', '_blank')" />
                    </div>`;
                }

                // Add message info (sender and timestamp)
                const messageInfo = `<div class="message-info">
                    ${!isCurrentUser ? `<span class="sender-name">${messageData.senderName}</span>` : ''}
                    <span class="timestamp">${formatTimestamp(messageData.timestamp)}</span>
                </div>`;

                messageDiv.innerHTML = messageContent + messageInfo;
                chatMessages.appendChild(messageDiv);
                
                // Auto scroll to bottom
                chatMessages.scrollTop = chatMessages.scrollHeight;
            });

            // Handle message updates (if needed)
            roomRef.on('child_changed', (snapshot) => {
                console.log('Message updated:', snapshot.val());
                // Handle message updates if needed
            });

            // Handle message deletions (if needed)
            roomRef.on('child_removed', (snapshot) => {
                console.log('Message removed:', snapshot.val());
                // Handle message deletions if needed
            });

            // Auto-focus on message input
            messageInput.focus();

            // Add typing indicator functionality (optional)
            let typingTimeout;
            messageInput.addEventListener('input', () => {
                // Clear previous timeout
                clearTimeout(typingTimeout);
                
                // Set new timeout
                typingTimeout = setTimeout(() => {
                    // Remove typing indicator logic here if implemented
                }, 1000);
            });
        });
    </script>
@endsection