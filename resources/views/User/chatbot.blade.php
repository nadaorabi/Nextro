@extends('layouts.app')

@section('title', 'المساعد الذكي - Nextro')

@section('hero')
<link href="https://fonts.googleapis.com/css2?family=Display+Playfair:wght@400;700&family=Inter:wght@400;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">المساعد الذكي</h1>
                <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <p>اسأل أي سؤال عن الكورسات، التسجيل، أو أي استفسار آخر</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">الرئيسية</a></li>
            <li class="breadcrumb-item active" aria-current="page">المساعد الذكي</li>
        </ol>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white text-center py-3">
                    <h5 class="mb-0">
                        <i class="fas fa-robot me-2"></i>
                        المساعد الذكي - Nextro
                    </h5>
                    <small>يمكنني مساعدتك في الاستفسارات عن الكورسات والتسجيل</small>
                </div>
                
                <div class="card-body p-0">
                    <!-- Chat Messages Container -->
                    <div id="chat-messages" class="chat-container" style="height: 400px; overflow-y: auto; padding: 20px;">
                        <!-- Welcome Message -->
                        <div class="message bot-message">
                            <div class="message-content">
                                <div class="message-bubble">
                                    <div class="message-text">
                            مرحباً! 👋 أنا مساعدك التعليمي الذكي في معهد Nextro. 
                                        يمكنني مساعدتك في:
                                        <ul class="mt-2 mb-0">
                                <li>📚 شرح المفاهيم الدراسية وتبسيط الدروس</li>
                                <li>💡 مساعدتك في حل التمارين والواجبات</li>
                                <li>🎯 توجيهك في الأبحاث والمشاريع</li>
                                <li>📖 معلومات عن الكورسات والبرامج التعليمية</li>
                                <li>📝 إجراءات التسجيل والقبول</li>
                                        </ul>
                            اسألني عن أي موضوع دراسي أو تعليمي! 🎓
                                    </div>
                                    <div class="message-time">{{ now()->format('H:i') }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Chat Input -->
                    <div class="chat-input-container p-3 border-top">
                        <form id="chat-form" class="d-flex">
                            <div class="input-group">
                                <input type="text" id="message-input" class="form-control" 
                                       placeholder="اكتب رسالتك هنا..." 
                                       maxlength="1000" 
                                       autocomplete="off">
                                <button type="submit" class="btn btn-primary" id="send-btn">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </form>
                        
                        <!-- Quick Actions -->
                        <div class="quick-actions mt-3">
                            <small class="text-muted">أسئلة سريعة:</small>
                            <div class="d-flex flex-wrap gap-2 mt-2">
                                <button class="btn btn-outline-primary btn-sm quick-question" data-question="ما هي الكورسات المتاحة؟">
                                    📚 الكورسات المتاحة
                                </button>
                                <button class="btn btn-outline-primary btn-sm quick-question" data-question="كيف أسجل في كورس؟">
                                    📝 كيفية التسجيل
                                </button>
                                <button class="btn btn-outline-primary btn-sm quick-question" data-question="ما هي رسوم الكورسات؟">
                                    💰 رسوم الكورسات
                                </button>
                                <button class="btn btn-outline-primary btn-sm quick-question" data-question="اشرح لي مفهوم البرمجة">
                                    💡 مساعدة دراسية
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Chat Actions -->
                <div class="card-footer bg-light text-center">
                    <button class="btn btn-outline-secondary btn-sm me-2" id="clear-chat">
                        <i class="fas fa-trash me-1"></i>مسح المحادثة
                    </button>
                    <button class="btn btn-outline-info btn-sm" id="scroll-bottom">
                        <i class="fas fa-arrow-down me-1"></i>أحدث رسالة
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.chat-container {
    background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
}

.message {
    margin-bottom: 15px;
    display: flex;
}

.user-message {
    justify-content: flex-end;
}

.bot-message {
    justify-content: flex-start;
}

.message-content {
    max-width: 70%;
}

.message-bubble {
    background: white;
    border-radius: 18px;
    padding: 12px 16px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    position: relative;
}

.user-message .message-bubble {
    background: #007bff;
    color: white;
}

.bot-message .message-bubble {
    background: white;
    color: #333;
}

.message-text {
    margin-bottom: 5px;
    line-height: 1.4;
}

.message-time {
    font-size: 11px;
    opacity: 0.7;
    text-align: right;
}

.user-message .message-time {
    color: rgba(255,255,255,0.8);
}

.bot-message .message-time {
    color: #666;
}

.chat-input-container {
    background: white;
}

.input-group {
    border-radius: 25px;
    overflow: hidden;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

#message-input {
    border: none;
    padding: 12px 20px;
    font-size: 14px;
}

#message-input:focus {
    box-shadow: none;
    border: none;
}

#send-btn {
    border: none;
    padding: 12px 20px;
    border-radius: 0 25px 25px 0;
}

.quick-actions {
    background: #f8f9fa;
    border-radius: 10px;
    padding: 15px;
}

.quick-question {
    border-radius: 20px;
    font-size: 12px;
    padding: 6px 12px;
}

.quick-question:hover {
    transform: translateY(-1px);
    transition: all 0.2s ease;
}

/* Loading Animation */
.typing-indicator {
    display: flex;
    align-items: center;
    gap: 5px;
    padding: 10px 15px;
    background: white;
    border-radius: 18px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    max-width: 70px;
}

.typing-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #007bff;
    animation: typing 1.4s infinite ease-in-out;
}

.typing-dot:nth-child(1) { animation-delay: -0.32s; }
.typing-dot:nth-child(2) { animation-delay: -0.16s; }

@keyframes typing {
    0%, 80%, 100% {
        transform: scale(0.8);
        opacity: 0.5;
    }
    40% {
        transform: scale(1);
        opacity: 1;
    }
}

/* Responsive Design */
@media (max-width: 768px) {
    .message-content {
        max-width: 85%;
    }
    
    .quick-actions {
        padding: 10px;
    }
    
    .quick-question {
        font-size: 11px;
        padding: 4px 8px;
    }
}

/* Scrollbar Styling */
#chat-messages::-webkit-scrollbar {
    width: 6px;
}

#chat-messages::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 3px;
}

#chat-messages::-webkit-scrollbar-thumb {
    background: #c1c1c1;
    border-radius: 3px;
}

#chat-messages::-webkit-scrollbar-thumb:hover {
    background: #a8a8a8;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const chatMessages = document.getElementById('chat-messages');
    const messageInput = document.getElementById('message-input');
    const chatForm = document.getElementById('chat-form');
    const sendBtn = document.getElementById('send-btn');
    const clearBtn = document.getElementById('clear-chat');
    const scrollBottomBtn = document.getElementById('scroll-bottom');
    const quickQuestions = document.querySelectorAll('.quick-question');

    // Send message function
    function sendMessage(message) {
        if (!message.trim()) return;

        // Add user message
        addMessage(message, 'user');
        
        // Clear input
        messageInput.value = '';
        
        // Show typing indicator
        showTypingIndicator();
        
        // Send to server
        fetch('{{ route("chatbot.send") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ message: message })
        })
        .then(response => response.json())
        .then(data => {
            hideTypingIndicator();
            
            if (data.success) {
                addMessage(data.message, 'bot');
            } else {
                addMessage('عذراً، حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.', 'bot');
            }
        })
        .catch(error => {
            hideTypingIndicator();
            addMessage('عذراً، حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.', 'bot');
            console.error('Error:', error);
        });
    }

    // Add message to chat
    function addMessage(text, sender) {
        const messageDiv = document.createElement('div');
        messageDiv.className = `message ${sender}-message`;
        
        const time = new Date().toLocaleTimeString('ar-SA', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        messageDiv.innerHTML = `
            <div class="message-content">
                <div class="message-bubble">
                    <div class="message-text">${text}</div>
                    <div class="message-time">${time}</div>
                </div>
            </div>
        `;
        
        chatMessages.appendChild(messageDiv);
        scrollToBottom();
    }

    // Show typing indicator
    function showTypingIndicator() {
        const typingDiv = document.createElement('div');
        typingDiv.className = 'message bot-message';
        typingDiv.id = 'typing-indicator';
        typingDiv.innerHTML = `
            <div class="message-content">
                <div class="typing-indicator">
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                    <div class="typing-dot"></div>
                </div>
            </div>
        `;
        chatMessages.appendChild(typingDiv);
        scrollToBottom();
    }

    // Hide typing indicator
    function hideTypingIndicator() {
        const typingIndicator = document.getElementById('typing-indicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    // Scroll to bottom
    function scrollToBottom() {
        chatMessages.scrollTop = chatMessages.scrollHeight;
    }

    // Form submit
    chatForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const message = messageInput.value.trim();
        if (message) {
            sendMessage(message);
        }
    });

    // Quick questions
    quickQuestions.forEach(btn => {
        btn.addEventListener('click', function() {
            const question = this.getAttribute('data-question');
            sendMessage(question);
        });
    });

    // Clear chat
    clearBtn.addEventListener('click', function() {
        if (confirm('هل أنت متأكد من مسح جميع الرسائل؟')) {
            fetch('{{ route("chatbot.clear") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(() => {
                chatMessages.innerHTML = `
                    <div class="message bot-message">
                        <div class="message-content">
                            <div class="message-bubble">
                                <div class="message-text">
                                    تم مسح المحادثة. كيف يمكنني مساعدتك؟
                                </div>
                                <div class="message-time">${new Date().toLocaleTimeString('ar-SA', { hour: '2-digit', minute: '2-digit' })}</div>
                            </div>
                        </div>
                    </div>
                `;
            });
        }
    });

    // Scroll to bottom button
    scrollBottomBtn.addEventListener('click', scrollToBottom);

    // Auto-resize input
    messageInput.addEventListener('input', function() {
        this.style.height = 'auto';
        this.style.height = Math.min(this.scrollHeight, 100) + 'px';
    });

    // Focus input on load
    messageInput.focus();
});
</script>
@endsection 