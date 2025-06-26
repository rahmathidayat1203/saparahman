@extends('layouts.admin.index')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script type="module" src="https://cdn.jsdelivr.net/npm/emoji-picker-element@^1/index.js"></script>

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
        }

        .chat-container {
            display: flex;
            height: calc(100vh - 80px); /* sesuaikan kalau ada navbar di layout admin */
            overflow: hidden;
            background-color: #f8fafc;
        }

        .chat-sidebar {
            width: 300px;
            background-color: white;
            border-right: 1px solid #e5e7eb;
            display: flex;
            flex-direction: column;
            padding: 16px;
        }

        .chat-sidebar h3 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 12px;
        }

        .create-new {
            background-color: #3b82f6;
            color: white;
            padding: 10px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 16px;
            cursor: pointer;
            font-weight: 600;
        }

        .search-bar input {
            width: 100%;
            padding: 8px 12px;
            border-radius: 8px;
            border: 1px solid #ccc;
            margin-bottom: 16px;
        }

        .chat-list {
            overflow-y: auto;
            flex-grow: 1;
        }

        .chat-item {
            display: flex;
            align-items: center;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 8px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .chat-item.active,
        .chat-item:hover {
            background-color: #f1f5f9;
        }

        .chat-item img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .chat-info h4 {
            font-size: 15px;
            font-weight: 600;
            margin: 0;
        }

        .chat-info span {
            font-size: 12px;
            color: gray;
        }

        .chat-window {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            background-color: #e5e7eb;
            border-left: 1px solid #ddd;
        }

        .chat-header {
            background-color: #3b82f6;
            color: white;
            padding: 16px;
            font-size: 18px;
            font-weight: 600;
        }

        #chatMessages {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .message-bubble {
            max-width: 60%;
            padding: 12px 16px;
            background-color: white;
            border-radius: 18px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            font-size: 14px;
            position: relative;
        }

        .message-bubble.you {
            background-color: #f472b6;
            color: white;
            align-self: flex-end;
            border-bottom-right-radius: 4px;
        }

        .message-img {
            max-width: 240px;
            border-radius: 10px;
            margin-top: 6px;
        }

        .chat-input {
            display: flex;
            align-items: center;
            padding: 12px;
            background-color: white;
            gap: 10px;
            border-top: 1px solid #ddd;
            position: relative;
        }

        .chat-input input[type="text"] {
            flex-grow: 1;
            padding: 10px 14px;
            border-radius: 20px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        .chat-input button {
            font-size: 18px;
            background: none;
            border: none;
            cursor: pointer;
        }

        emoji-picker {
            position: absolute;
            bottom: 50px;
            left: 12px;
            z-index: 99;
        }
    </style>

    <div class="chat-container">
        <div class="chat-sidebar">
            <div class="create-new">+ New Chat</div>
            <h3>Chat</h3>
            <div class="search-bar">
                <input type="text" placeholder="Search Name" />
            </div>
            <div class="chat-list">
                <div class="chat-item active">
                    <img src="https://i.pravatar.cc/42?img=3" />
                    <div class="chat-info">
                        <h4>Melonie Sherk</h4>
                        <span>3 hours ago</span>
                    </div>
                </div>
                {{-- Tambahan kontak lainnya bisa disini --}}
            </div>
        </div>

        <div class="chat-window">
            <div class="chat-header">Melonie Sherk</div>

            <div id="chatMessages"></div>

            <div class="chat-input">
                <button id="emojiBtn">😊</button>
                <button id="imageBtn">📎</button>
                <input type="file" id="imageInput" accept="image/*" style="display: none" />
                <input type="text" id="messageInput" placeholder="Type a message here..." />
                <button id="sendBtn">➤</button>
                <emoji-picker id="emojiPicker" style="display: none;"></emoji-picker>
            </div>
        </div>
    </div>

    <script>
        const firebaseConfig = {
            apiKey: "{{ env('FIREBASE_API_KEY') }}",
            authDomain: "{{ env('FIREBASE_AUTH_DOMAIN') }}",
            databaseURL: "{{ env('FIREBASE_DATABASE_URL') }}",
            projectId: "{{ env('FIREBASE_PROJECT_ID') }}",
            storageBucket: "{{ env('FIREBASE_STORAGE_BUCKET') }}",
            messagingSenderId: "{{ env('FIREBASE_MESSAGING_SENDER_ID') }}",
            appId: "{{ env('FIREBASE_APP_ID') }}"
        };

        firebase.initializeApp(firebaseConfig);
        const db = firebase.database();
        const storage = firebase.storage();

        const emojiBtn = document.getElementById('emojiBtn');
        const emojiPicker = document.getElementById('emojiPicker');
        const messageInput = document.getElementById('messageInput');
        const sendBtn = document.getElementById('sendBtn');
        const chatMessages = document.getElementById('chatMessages');
        const imageBtn = document.getElementById('imageBtn');
        const imageInput = document.getElementById('imageInput');

        emojiBtn.addEventListener('click', () => {
            emojiPicker.style.display = emojiPicker.style.display === 'none' ? 'block' : 'none';
        });

        emojiPicker.addEventListener('emoji-click', (event) => {
            messageInput.value += event.detail.unicode;
            emojiPicker.style.display = 'none';
            messageInput.focus();
        });

        imageBtn.addEventListener('click', () => {
            imageInput.click();
        });

        imageInput.addEventListener('change', () => {
            const file = imageInput.files[0];
            if (!file) return;

            const fileRef = storage.ref().child('images/' + Date.now() + '_' + file.name);
            fileRef.put(file).then(snapshot => snapshot.ref.getDownloadURL())
                .then(url => {
                    const message = {
                        sender: 'You',
                        imageUrl: url,
                        timestamp: Date.now()
                    };
                    db.ref('chats').push(message);
                });
        });

        sendBtn.addEventListener('click', () => {
            const text = messageInput.value.trim();
            if (text === '') return;

            const message = {
                sender: 'You',
                text: text,
                timestamp: Date.now()
            };

            db.ref('chats').push(message);
            messageInput.value = '';
        });

        db.ref('chats').on('child_added', (snapshot) => {
            const msg = snapshot.val();
            const div = document.createElement('div');
            div.className = 'message-bubble';
            if (msg.sender === 'You') div.classList.add('you');

            if (msg.text) {
                div.innerText = msg.text;
            }

            if (msg.imageUrl) {
                const img = document.createElement('img');
                img.src = msg.imageUrl;
                img.className = 'message-img';
                div.appendChild(img);
            }

            chatMessages.appendChild(div);
            chatMessages.scrollTop = chatMessages.scrollHeight;
        });
    </script>
@endsection
