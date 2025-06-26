<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>

    <!-- BOOTSTRAP CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/js/select.dataTables.min.css') }}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('assets/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}" />
    {{-- Flat Icon --}}
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/3.0.0/uicons-regular-rounded/css/uicons-regular-rounded.css'>
    <link rel='stylesheet'
        href='https://cdn-uicons.flaticon.com/3.0.0/uicons-solid-rounded/css/uicons-solid-rounded.css'>

    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Material Design Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.2.96/css/materialdesignicons.min.css">

    <!-- Themify Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/themify-icons@0.1.2/css/themify-icons.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <!-- Popper.js (untuk positioning dropdown/tooltips) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <!-- Bootstrap 4 JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <!-- CSS Fix untuk Checkbox -->
    <style>
        /* Reset dan tampilkan checkbox yang tersembunyi */
        .todo-list .checkbox {
            position: static !important;
            opacity: 1 !important;
            visibility: visible !important;
            left: auto !important;
            top: auto !important;
            transform: none !important;
            clip: auto !important;
            clip-path: none !important;

            /* Styling checkbox */
            width: 16px !important;
            height: 16px !important;
            margin-right: 8px !important;
            cursor: pointer !important;
            display: inline-block !important;
            vertical-align: middle !important;
        }

        /* Hapus semua styling yang mungkin menyembunyikan atau menduplikasi checkbox */
        .todo-list .checkbox::before,
        .todo-list .checkbox::after {
            display: none !important;
        }

        /* Hapus input-helper yang menyebabkan duplikasi */
        .todo-list .input-helper {
            display: none !important;
        }

        /* Styling untuk form-check-label */
        .todo-list .form-check-label {
            display: flex !important;
            align-items: center !important;
            cursor: pointer !important;
            padding-left: 0 !important;
            margin-bottom: 0 !important;
            width: 100% !important;
        }

        /* Styling untuk container */
        .todo-list .form-check {
            display: flex !important;
            align-items: center !important;
            margin-bottom: 0 !important;
            padding-left: 0 !important;
            flex: 1 !important;
        }

        /* Styling untuk todo list items */
        .todo-list li {
            display: flex !important;
            justify-content: space-between !important;
            align-items: center !important;
            padding: 10px 0 !important;
            border-bottom: 1px solid #f1f3f4 !important;
        }

        /* Styling untuk tombol remove */
        .todo-list li .remove {
            cursor: pointer !important;
            color: #007bff !important;
            font-size: 14px !important;
            padding: 5px !important;
            margin-left: 10px !important;
        }

        .todo-list li .remove:hover {
            color: #dc3545 !important;
        }

        /* Styling untuk completed items */
        .todo-list li.completed .form-check-label {
            text-decoration: line-through !important;
            color: #007bff !important;
        }

        /* Force checkbox appearance untuk browser yang mendukung */
        .todo-list .checkbox {
            appearance: auto !important;
            -webkit-appearance: checkbox !important;
            -moz-appearance: checkbox !important;
        }
    </style>
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        @include('layouts.admin.navbar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <!-- 1. UPDATE RIGHT SIDEBAR UNTUK INTEGRASI DENGAN CHAT BLADE -->
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
                            aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <!-- TODO SECTION -->
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100" id="sidebar-todo-form">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do"
                                        id="sidebar-todo-input">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list" id="sidebar-todo-list">
                                <!-- Todo items akan dimuat dari localStorage atau database -->
                            </ul>
                        </div>
                        <div class="px-3 mt-3">
                            <button class="btn btn-outline-primary btn-sm w-100" onclick="openFullTodoList()">
                                <i class="ti-external-link mr-1"></i>
                                Open Full Todo List
                            </button>
                        </div>
                    </div>

                    <!-- CHAT SECTION -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Recent Chats
                            </p>
                            <button class="btn btn-link btn-sm" onclick="openFullChat()">
                                <i class="ti-external-link"></i>
                            </button>
                        </div>

                        <!-- Mini Chat Window -->
                        <div class="mini-chat-container"
                            style="height: 200px; overflow-y: auto; border-bottom: 1px solid #eee;">
                            <div id="mini-chat-messages" class="p-2">
                                <!-- Messages akan dimuat dari Firebase -->
                                <div class="text-center text-muted small" id="mini-chat-loading">
                                    Loading recent messages...
                                </div>
                            </div>
                        </div>

                        <!-- Quick Chat Input -->
                        <div class="quick-chat-input p-2 border-top">
                            <div class="input-group input-group-sm">
                                <input type="text" class="form-control" placeholder="Quick message..."
                                    id="quick-message-input">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button" onclick="sendQuickMessage()">
                                        <i class="ti-arrow-right"></i>
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Chat List -->
                        <ul class="chat-list mt-2">
                            <li class="list" onclick="openFullChat()">
                                <div class="profile">
                                    <img src="{{ asset('assets/images/faces/face1.jpg') }}" alt="image">
                                    <span class="online"></span>
                                </div>
                                <div class="info">
                                    <p>{{ auth()->user()->name }}</p>
                                    <p>Private Notes</p>
                                </div>
                                <small class="text-muted my-auto">Active</small>
                            </li>
                        </ul>

                        <div class="px-3 mt-3">
                            <button class="btn btn-outline-primary btn-sm w-100" onclick="openFullChat()">
                                <i class="ti-comments mr-1"></i>
                                Open Full Chat
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. JAVASCRIPT UNTUK INTEGRASI -->
            <script>
                // Todo List Integration
                class SidebarTodoManager {
                    constructor() {
                        this.todos = JSON.parse(localStorage.getItem('sidebarTodos') || '[]');
                        this.init();
                    }

                    init() {
                        this.renderTodos();
                        this.bindEvents();
                    }

                    bindEvents() {
                        const form = document.getElementById('sidebar-todo-form');
                        if (form) {
                            form.addEventListener('submit', (e) => {
                                e.preventDefault();
                                this.addTodo();
                            });
                        }
                    }

                    addTodo() {
                        const input = document.getElementById('sidebar-todo-input');
                        const text = input.value.trim();

                        if (text) {
                            const todo = {
                                id: Date.now(),
                                text: text,
                                completed: false,
                                timestamp: new Date().toISOString()
                            };

                            this.todos.unshift(todo);
                            this.saveTodos();
                            this.renderTodos();
                            input.value = '';
                        }
                    }

                    toggleTodo(id) {
                        const todo = this.todos.find(t => t.id === id);
                        if (todo) {
                            todo.completed = !todo.completed;
                            this.saveTodos();
                            this.renderTodos();
                        }
                    }

                    removeTodo(id) {
                        this.todos = this.todos.filter(t => t.id !== id);
                        this.saveTodos();
                        this.renderTodos();
                    }

                    renderTodos() {
                        const container = document.getElementById('sidebar-todo-list');
                        if (!container) return;

                        container.innerHTML = '';

                        // Show only last 5 todos
                        const recentTodos = this.todos.slice(0, 5);

                        recentTodos.forEach(todo => {
                            const li = document.createElement('li');
                            li.className = todo.completed ? 'completed' : '';
                            li.innerHTML = `
                <div class="form-check">
                    <label class="form-check-label">
                        <input class="checkbox form-check-input" type="checkbox" ${todo.completed ? 'checked' : ''} 
                               onchange="sidebarTodoManager.toggleTodo(${todo.id})">
                        ${todo.text}
                    </label>
                </div>
                <i class="remove ti-close" onclick="sidebarTodoManager.removeTodo(${todo.id})"></i>
            `;
                            container.appendChild(li);
                        });

                        if (this.todos.length === 0) {
                            container.innerHTML = '<li class="text-center text-muted small">No todos yet</li>';
                        }
                    }

                    saveTodos() {
                        localStorage.setItem('sidebarTodos', JSON.stringify(this.todos));
                    }
                }

                // Chat Integration
                class SidebarChatManager {
                    constructor() {
                        this.initFirebase();
                        this.bindEvents();
                    }

                    initFirebase() {
                        // Gunakan konfigurasi Firebase yang sama dari chat blade
                        if (typeof firebase !== 'undefined') {
                            this.db = firebase.database();
                            this.chatRoom = 'guru_1_user115'; // Sesuaikan dengan chat blade
                            this.roomRef = this.db.ref(`guruChats/${this.chatRoom}`);
                            this.loadRecentMessages();
                        }
                    }

                    bindEvents() {
                        const input = document.getElementById('quick-message-input');
                        if (input) {
                            input.addEventListener('keypress', (e) => {
                                if (e.key === 'Enter') {
                                    this.sendQuickMessage();
                                }
                            });
                        }
                    }

                    loadRecentMessages() {
                        if (!this.roomRef) return;

                        const container = document.getElementById('mini-chat-messages');

                        // Load last 3 messages
                        this.roomRef.orderByChild('timestamp').limitToLast(3).on('value', (snapshot) => {
                            const messages = [];
                            snapshot.forEach((childSnapshot) => {
                                messages.push(childSnapshot.val());
                            });

                            container.innerHTML = '';

                            if (messages.length === 0) {
                                container.innerHTML = '<div class="text-center text-muted small">No messages yet</div>';
                                return;
                            }

                            messages.forEach(message => {
                                const messageDiv = document.createElement('div');
                                messageDiv.className = 'mini-message mb-1';
                                messageDiv.innerHTML = `
                    <div class="small ${message.senderId === 'user{{ auth()->user()->id }}' ? 'text-primary' : 'text-secondary'}">
                        <strong>${message.senderName}:</strong> 
                        ${message.text || (message.imageUrl ? '📷 Image' : 'Message')}
                    </div>
                `;
                                container.appendChild(messageDiv);
                            });

                            // Auto scroll to bottom
                            container.scrollTop = container.scrollHeight;
                        });
                    }

                    sendQuickMessage() {
                        const input = document.getElementById('quick-message-input');
                        const text = input.value.trim();

                        if (!text || !this.roomRef) return;

                        const timestamp = Date.now();
                        const messageId = `${timestamp}_${Math.random().toString(36).substr(2, 9)}`;

                        const messageData = {
                            id: messageId,
                            senderId: 'user{{ auth()->user()->id }}',
                            senderName: '{{ auth()->user()->name }}',
                            text: text,
                            timestamp: timestamp
                        };

                        this.roomRef.child(messageId).set(messageData).then(() => {
                            input.value = '';
                        }).catch(err => {
                            console.error('Error sending quick message:', err);
                        });
                    }
                }

                // Navigation Functions
                function openFullTodoList() {
                    // Redirect ke dashboard atau halaman todo list
                    window.location.href = '{{ route('dashboard') }}#todo-section';
                }

                function openFullChat() {
                    // Redirect ke halaman chat
                    window.location.href = '{{ route('chat') }}';
                }

                function toggleRightSidebar(tab = null) {
                    const sidebar = document.getElementById('right-sidebar');
                    const isOpen = sidebar.classList.contains('open');

                    if (isOpen) {
                        sidebar.classList.remove('open');
                    } else {
                        sidebar.classList.add('open');

                        // Switch to specific tab if provided
                        if (tab) {
                            const todoTab = document.getElementById('todo-tab');
                            const chatTab = document.getElementById('chats-tab');
                            const todoSection = document.getElementById('todo-section');
                            const chatSection = document.getElementById('chats-section');

                            if (tab === 'todo') {
                                todoTab.click();
                            } else if (tab === 'chat') {
                                chatTab.click();
                            }
                        }
                    }
                }

                // Initialize managers when document is ready
                document.addEventListener('DOMContentLoaded', function() {
                    window.sidebarTodoManager = new SidebarTodoManager();
                    window.sidebarChatManager = new SidebarChatManager();
                });

                // Close sidebar when clicking outside
                document.addEventListener('click', function(e) {
                    const sidebar = document.getElementById('right-sidebar');
                    const settingsButton = document.querySelector('.nav-settings');

                    if (!sidebar.contains(e.target) && !settingsButton?.contains(e.target)) {
                        sidebar.classList.remove('open');
                    }
                });
            </script>

            <!-- 3. CSS UNTUK STYLING -->
            <style>
                /* Sidebar Animation */
                #right-sidebar {
                    position: fixed;
                    top: 0;
                    right: -320px;
                    width: 320px;
                    height: 100vh;
                    z-index: 1050;
                    transition: right 0.3s ease;
                    background: white;
                    box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
                }

                #right-sidebar.open {
                    right: 0;
                }

                /* Mini Chat Styling */
                .mini-chat-container {
                    background: #f8f9fa;
                }

                .mini-message {
                    padding: 4px 8px;
                    border-radius: 4px;
                    background: white;
                    margin-bottom: 2px;
                }

                .quick-chat-input {
                    background: white;
                }

                /* Todo List Styling */
                .todo-list li {
                    padding: 8px 0;
                    border-bottom: 1px solid #f1f3f4;
                }

                .todo-list li.completed .form-check-label {
                    text-decoration: line-through;
                    opacity: 0.6;
                }

                /* Responsive */
                @media (max-width: 768px) {
                    #right-sidebar {
                        width: 100%;
                        right: -100%;
                    }
                }

                /* Overlay for mobile */
                .sidebar-overlay {
                    position: fixed;
                    top: 0;
                    left: 0;
                    width: 100%;
                    height: 100%;
                    background: rgba(0, 0, 0, 0.5);
                    z-index: 1040;
                    display: none;
                }

                .sidebar-overlay.show {
                    display: block;
                }
            </style>
            
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('layouts.admin.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ asset('assets/js/off-canvas.js') }}"></script>
    <script src="{{ asset('assets/js/hoverable-collapse.js') }}"></script>
    <script src="{{ asset('assets/js/template.js') }}"></script>
    <script src="{{ asset('assets/js/settings.js') }}"></script>
    <script src="{{ asset('assets/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ asset('assets/js/dashboard.js') }}"></script>
    <script src="{{ asset('assets/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->
    @stack('scripts')
</body>

</html>
