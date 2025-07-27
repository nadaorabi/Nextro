class FloatingChatbot {
    constructor() {
        this.isOpen = false;
        this.isLoading = false;
        this.messageHistory = [];
        this.init();
    }

    init() {
        this.createChatbotHTML();
        this.bindEvents();
        this.loadWelcomeMessage();
        this.loadChatHistory();
    }

    createChatbotHTML() {
        const chatbotHTML = `
            <div class="floating-chatbot">
                <button class="chatbot-toggle" id="chatbotToggle">
                    <i class="fas fa-robot"></i>
                    <div class="chatbot-notification" id="chatbotNotification" style="display: none;">1</div>
                </button>
                
                <div class="chatbot-window" id="chatbotWindow">
                    <div class="chatbot-header">
                        <div>
                            <h5><i class="fas fa-robot me-2"></i>AI Assistant</h5>
                            <small>Nextro Academic</small>
                        </div>
                        <div class="chatbot-controls">
                            <button class="close-btn" id="chatbotClose">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <div class="chatbot-messages" id="chatbotMessages">
                        <!-- Messages will be added here -->
                    </div>
                    
                    <div class="chatbot-input-container">
                        <form id="chatbotForm" class="chatbot-input-group">
                            <textarea 
                                class="chatbot-input" 
                                id="chatbotInput" 
                                placeholder="Type your message here..."
                                rows="1"
                                maxlength="1000"
                            ></textarea>
                            <button type="submit" class="chatbot-send-btn" id="chatbotSend">
                                <i class="fas fa-paper-plane"></i>
                            </button>
                        </form>
                        
                        <div class="chatbot-quick-actions">
                            <small>Quick Questions:</small>
                            <div class="chatbot-quick-buttons">
                                <button class="chatbot-quick-btn" data-question="What courses are available?">
                                    📚 Available Courses
                                </button>
                                <button class="chatbot-quick-btn" data-question="How do I register for a course?">
                                    📝 How to Register
                                </button>
                                <button class="chatbot-quick-btn" data-question="What are the course fees?">
                                    💰 Course Fees
                                </button>
                                <button class="chatbot-quick-btn" data-question="I need help with my studies">
                                    💡 Study Help
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        document.body.insertAdjacentHTML('beforeend', chatbotHTML);
    }

    bindEvents() {
        // Toggle chatbot
        document.getElementById('chatbotToggle').addEventListener('click', () => {
            this.toggleChatbot();
        });

        // Close chatbot
        document.getElementById('chatbotClose').addEventListener('click', () => {
            this.closeChatbot();
        });

        // Send message
        document.getElementById('chatbotForm').addEventListener('submit', (e) => {
            e.preventDefault();
            this.sendMessage();
        });

        // Handle Enter key in textarea
        document.getElementById('chatbotInput').addEventListener('keydown', (e) => {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                this.sendMessage();
            }
        });

        // Quick questions
        document.querySelectorAll('.chatbot-quick-btn').forEach(btn => {
            btn.addEventListener('click', () => {
                const question = btn.getAttribute('data-question');
                this.addMessage(question, 'user');
                this.sendToAPI(question);
            });
        });

        // Auto-resize textarea
        document.getElementById('chatbotInput').addEventListener('input', (e) => {
            this.autoResizeTextarea(e.target);
        });

        // Close on outside click
        document.addEventListener('click', (e) => {
            const chatbot = document.querySelector('.floating-chatbot');
            if (this.isOpen && !chatbot.contains(e.target)) {
                this.closeChatbot();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && this.isOpen) {
                this.closeChatbot();
            }
        });
    }

    loadWelcomeMessage() {
        const welcomeMessage = `Hello! I'm Nextro AI, your friendly academic assistant! 😊

I'm here to help you with:
• 📚 Explaining study concepts and simplifying lessons
• 💡 Assisting with exercises and assignments
• 🎯 Guiding you in research and projects
• 📖 Information about available courses
• 📝 Registration and admission procedures

I remember our conversations and build upon them to give you personalized help! How can I assist you today? 🎓`;
        
        this.addMessage(welcomeMessage, 'bot');
    }

    async loadChatHistory() {
        try {
            const response = await fetch('/user/chatbot/history', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            });
            
            if (response.ok) {
                const history = await response.json();
                if (history.length > 0) {
                    // Add a separator
                    this.addMessage("--- Previous Conversation ---", 'system');
                    
                    // Load last few messages from history
                    const recentHistory = history.slice(-5);
                    recentHistory.forEach(chat => {
                        this.addMessage(chat.user_message, 'user', chat.timestamp);
                        this.addMessage(chat.bot_response, 'bot', chat.timestamp);
                    });
                    
                    this.addMessage("--- Current Session ---", 'system');
                }
            }
        } catch (error) {
            console.log('No chat history found or error loading history');
        }
    }

    toggleChatbot() {
        if (this.isOpen) {
            this.closeChatbot();
        } else {
            this.openChatbot();
        }
    }

    openChatbot() {
        const window = document.getElementById('chatbotWindow');
        window.classList.add('active');
        this.isOpen = true;
        
        // Hide notification
        document.getElementById('chatbotNotification').style.display = 'none';
        
        // Focus input
        setTimeout(() => {
            document.getElementById('chatbotInput').focus();
        }, 300);
        
        // Scroll to bottom
        this.scrollToBottom();
    }

    closeChatbot() {
        const window = document.getElementById('chatbotWindow');
        window.classList.remove('active');
        this.isOpen = false;
    }

    sendMessage() {
        const input = document.getElementById('chatbotInput');
        const message = input.value.trim();
        
        if (message && !this.isLoading) {
            this.addMessage(message, 'user');
            this.sendToAPI(message);
            input.value = '';
            this.autoResizeTextarea(input);
        }
    }

    async sendToAPI(message) {
        this.isLoading = true;
        this.showTypingIndicator();
        this.disableInput();
        
        try {
            const response = await fetch('/user/chatbot/send', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ 
                    message: message
                })
            });
            
            const data = await response.json();
            
            this.hideTypingIndicator();
            
            if (data.success) {
                this.addMessage(data.message, 'bot');
            } else {
                const errorMsg = 'Sorry, there was an error in the connection. Please try again later.';
                this.addMessage(errorMsg, 'bot');
            }
            
        } catch (error) {
            console.error('Chatbot Error:', error);
            this.hideTypingIndicator();
            const errorMsg = 'Sorry, there was an error in the connection. Please try again later.';
            this.addMessage(errorMsg, 'bot');
        }
        
        this.isLoading = false;
        this.enableInput();
    }

    addMessage(message, sender, timestamp = null) {
        const messagesContainer = document.getElementById('chatbotMessages');
        const messageDiv = document.createElement('div');
        messageDiv.className = `chatbot-message ${sender}`;
        
        const messageTime = timestamp || new Date().toLocaleTimeString('en-US', { 
            hour: '2-digit', 
            minute: '2-digit' 
        });
        
        if (sender === 'system') {
            messageDiv.innerHTML = `
                <div class="chatbot-message-content">
                    <div class="chatbot-message-bubble system-message">
                        <small>${message}</small>
                    </div>
                </div>
            `;
        } else {
            messageDiv.innerHTML = `
                <div class="chatbot-message-content">
                    <div class="chatbot-message-bubble">
                        ${message}
                    </div>
                    <div class="chatbot-message-time">${messageTime}</div>
                </div>
            `;
        }
        
        messagesContainer.appendChild(messageDiv);
        this.scrollToBottom();
        
        // Store in history (only for user and bot messages)
        if (sender !== 'system') {
            this.messageHistory.push({
                message: message,
                sender: sender,
                timestamp: messageTime
            });
        }
    }

    showTypingIndicator() {
        const messagesContainer = document.getElementById('chatbotMessages');
        const typingDiv = document.createElement('div');
        typingDiv.className = 'chatbot-message bot';
        typingDiv.id = 'typingIndicator';
        
        typingDiv.innerHTML = `
            <div class="chatbot-message-content">
                <div class="chatbot-typing">
                    <div class="chatbot-typing-dot"></div>
                    <div class="chatbot-typing-dot"></div>
                    <div class="chatbot-typing-dot"></div>
                </div>
            </div>
        `;
        
        messagesContainer.appendChild(typingDiv);
        this.scrollToBottom();
    }

    hideTypingIndicator() {
        const typingIndicator = document.getElementById('typingIndicator');
        if (typingIndicator) {
            typingIndicator.remove();
        }
    }

    scrollToBottom() {
        const messagesContainer = document.getElementById('chatbotMessages');
        messagesContainer.scrollTop = messagesContainer.scrollHeight;
    }

    autoResizeTextarea(textarea) {
        textarea.style.height = 'auto';
        textarea.style.height = Math.min(textarea.scrollHeight, 100) + 'px';
    }

    disableInput() {
        const input = document.getElementById('chatbotInput');
        const sendBtn = document.getElementById('chatbotSend');
        
        input.disabled = true;
        sendBtn.disabled = true;
        sendBtn.classList.add('loading');
    }

    enableInput() {
        const input = document.getElementById('chatbotInput');
        const sendBtn = document.getElementById('chatbotSend');
        
        input.disabled = false;
        sendBtn.disabled = false;
        sendBtn.classList.remove('loading');
    }

    showNotification() {
        const notification = document.getElementById('chatbotNotification');
        notification.style.display = 'flex';
    }
}

// Initialize chatbot when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Only initialize for students (users)
    if (window.isStudent) {
        window.floatingChatbot = new FloatingChatbot();
    }
});

// Global functions for external access
window.openChatbot = function() {
    if (window.floatingChatbot) {
        window.floatingChatbot.openChatbot();
    }
};

window.closeChatbot = function() {
    if (window.floatingChatbot) {
        window.floatingChatbot.closeChatbot();
    }
};

window.sendChatbotMessage = function(message) {
    if (window.floatingChatbot) {
        window.floatingChatbot.addMessage(message, 'user');
        window.floatingChatbot.sendToAPI(message);
    }
};

// إظهار/إخفاء نافذة الشات مع الحركة
const chatbotBtn = document.querySelector('.floating-chatbot-btn');
const chatbotWindow = document.querySelector('.floating-chatbot-window');
const chatbotClose = document.querySelector('.floating-chatbot-close');

if (chatbotBtn && chatbotWindow) {
  chatbotBtn.addEventListener('click', function(e) {
    chatbotWindow.classList.toggle('active');
  });
}
// إغلاق عند الضغط على زر الإغلاق
if (chatbotClose && chatbotWindow) {
  chatbotClose.addEventListener('click', function() {
    chatbotWindow.classList.remove('active');
  });
}
// إغلاق عند الضغط خارج النافذة
window.addEventListener('click', function(e) {
  if (chatbotWindow && chatbotWindow.classList.contains('active')) {
    if (!chatbotWindow.contains(e.target) && !chatbotBtn.contains(e.target)) {
      chatbotWindow.classList.remove('active');
    }
  }
});

// تفعيل البوت العائم تلقائياً
new FloatingChatbot(); 