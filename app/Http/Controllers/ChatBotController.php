<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ChatBotController extends Controller
{
    private $apiKey;
    private $apiUrl = 'https://api.openai.com/v1/chat/completions';
    private $useAPI = true;

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
        $this->useAPI = !empty($this->apiKey);
    }

    public function showChat()
    {
        // Check if user is authenticated and is a student
        if (!Auth::check() || Auth::user()->role !== 'student') {
            return redirect()->route('login')->with('error', 'You must login as a student to access the AI Assistant.');
        }

        return view('User.chatbot');
    }

    public function sendMessage(Request $request)
    {
        try {
            // Validate user
            if (!Auth::check() || Auth::user()->role !== 'student') {
                return response()->json([
                    'success' => false,
                    'message' => 'You are not authorized to use the AI Assistant.'
                ], 403);
            }

            $request->validate([
                'message' => 'required|string|max:1000'
            ]);

            $userMessage = $request->input('message');
            
            // Check if API key is configured
            if (empty($this->apiKey)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Sorry, the AI Assistant is not available at the moment. Please try again later.'
                ], 500);
            }

            // Get real course data from database
            $coursesData = $this->getCoursesData();
            
            // Check for specific questions and provide direct answers
            $directAnswer = $this->getDirectAnswer($userMessage);
            if ($directAnswer) {
                $this->saveToHistory($userMessage, $directAnswer);
                return response()->json([
                    'success' => true,
                    'message' => $directAnswer,
                    'timestamp' => now()->format('H:i')
                ]);
            }
            
            // Detect user language automatically
            $isArabic = $this->detectArabicText($userMessage);
            $langInstruction = $this->getLanguageInstruction($isArabic);

            // Get conversation history
            $conversationHistory = $this->getConversationHistory();
            
            // Prepare the conversation context with comprehensive system knowledge
            $messages = [
                [
                    'role' => 'system',
                    'content' => "You are Nextro AI, an intelligent academic assistant for the Nextro Institute Management System. You have comprehensive knowledge about the system and its development.\n\nSYSTEM INFORMATION:\n\nPlatform Name: Nextro\nLocation: Syria - Hama\nType: Modern Institute Management System\nPurpose: Helps students find courses, educational materials, and register for the institute\nScope: Internal system for institute management\n\nDEVELOPMENT TEAM:\n- Lead Developer: Engineer Nada Mohannad Arabi\n- Co-Developer: Engineer Nour Bishar Warda\n- Project Type: Graduation project\n- Presentation: National Private University\n\nDEVELOPMENT PHASES:\n1. Planning Phase: Requirements analysis, system architecture design\n2. Design Phase: Database design, UI/UX design, system interfaces\n3. Development Phase: Coding, implementation, testing\n4. Testing Phase: Quality assurance, bug fixes, performance optimization\n5. Deployment Phase: System installation, user training, go-live\n\nSYSTEM FEATURES:\n- Student Management: Registration, profiles, academic records\n- Course Management: Course catalog, enrollment, scheduling\n- Educational Materials: Digital resources, assignments, exams\n- Administrative Tools: Reports, analytics, user management\n- Communication: Notifications, messaging, announcements\n\nYour characteristics:\n- You are extremely friendly, warm, and always positive\n- You are highly intelligent and can answer specific questions accurately\n- You remember previous conversations and build upon them\n- You ask follow-up questions to better understand the student's needs\n- You show genuine interest in the student's academic journey\n- You use encouraging and motivating language\n- You are patient and explain things clearly\n- You celebrate student progress and achievements\n- You can think critically and provide detailed, helpful responses\n- You have deep knowledge about the Nextro system and its capabilities\n\nYour capabilities:\n- You can answer questions about academic subjects (math, science, literature, history, etc.)\n- You can help with study techniques and learning strategies\n- You can explain complex concepts in simple terms\n- You can provide step-by-step solutions to problems\n- You can help with research and writing\n- You can answer questions about educational processes and procedures\n- You can provide guidance on academic planning and career development\n- You can explain system features and how to use them\n- You can provide information about the development team and project history\n- You can help with technical questions about the platform\n\nYour main mission:\n- Answer questions directly and specifically\n- Provide accurate, helpful information about the Nextro system\n- Explain academic concepts clearly and engagingly\n- Help students understand lessons and solve problems\n- Guide students in research and assignments\n- Encourage critical thinking and self-learning\n- Always use polite, respectful, and encouraging language\n- Adapt your explanations to the student's level\n- Refer to scientific sources when possible\n- Respect the academic environment\n- Be very interactive and ask relevant questions\n- Provide information about system features and capabilities\n- Share knowledge about the development process and team\n\nYou must never:\n- Answer non-academic questions (politics, religion, entertainment, personal life, medicine, relationships, money, rumors, or any sensitive content)\n- Provide biased, violent, bullying, discriminatory, or inappropriate content\n- Express personal opinions or discuss non-scientific topics\n- Give generic responses - always provide specific, helpful answers\n- Share confidential information about the development team\n\nIf the user asks a non-educational question:\n- Politely redirect them to academic topics\n- Example: 'I'd love to help you with your studies! What subject are you working on?'\n\nAvailable courses:\n{$coursesData}\n\n{$langInstruction}\n\nIMPORTANT: Always provide specific, detailed answers to questions. Do not give generic responses. Think critically and provide helpful, accurate information based on the specific question asked. You have comprehensive knowledge about the Nextro system and can answer questions about its features, development, and capabilities."
                ]
            ];

            // Add conversation history
            foreach ($conversationHistory as $chat) {
                $messages[] = [
                    'role' => 'user',
                    'content' => $chat['user_message']
                ];
                $messages[] = [
                    'role' => 'assistant',
                    'content' => $chat['bot_response']
                ];
            }

            // Add current message
            $messages[] = [
                'role' => 'user',
                'content' => $userMessage
            ];

            // Make API call to ChatGPT
            $response = Http::timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($this->apiUrl, [
                    'model' => 'gpt-3.5-turbo',
                    'messages' => $messages,
                    'max_tokens' => 800,
                    'temperature' => 0.8,
                    'presence_penalty' => 0.1,
                    'frequency_penalty' => 0.1,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $botResponse = $data['choices'][0]['message']['content'] ?? 'Sorry, there was an error processing your message.';
                
                // Clean response based on language
                if ($isArabic) {
                    $botResponse = $this->cleanArabicMarkdown($botResponse);
                }
                
                // Save to conversation history
                $this->saveToHistory($userMessage, $botResponse);
                
                // Log successful interaction
                Log::info('Chatbot interaction', [
                    'user_id' => Auth::id(),
                    'user_message' => $userMessage,
                    'bot_response' => $botResponse,
                    'detected_language' => $isArabic ? 'ar' : 'en',
                    'timestamp' => now()
                ]);
                
                return response()->json([
                    'success' => true,
                    'message' => $botResponse,
                    'timestamp' => now()->format('H:i')
                ]);
            } else {
                Log::error('ChatGPT API Error', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'user_id' => Auth::id()
                ]);
                
                $errorMsg = $isArabic ? 
                    'عذراً، حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.' :
                    'Sorry, there was an error in the connection. Please try again later.';
                
                return response()->json([
                    'success' => false,
                    'message' => $errorMsg
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('ChatBot Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'message' => $request->input('message')
            ]);
            
            $errorMsg = $this->detectArabicText($request->input('message')) ? 
                'عذراً، حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.' :
                'Sorry, an unexpected error occurred. Please try again later.';
            
            return response()->json([
                'success' => false,
                'message' => $errorMsg
            ], 500);
        }
    }

    /**
     * Detect if text contains Arabic characters
     */
    private function detectArabicText($text)
    {
        return preg_match('/[\x{0600}-\x{06FF}]/u', $text);
    }

    /**
     * Get language instruction for the AI
     */
    private function getLanguageInstruction($isArabic)
    {
        if ($isArabic) {
            return 'Answer in Arabic in a very friendly, warm, and encouraging way. Use proper Arabic grammar and punctuation. Be very interactive and ask follow-up questions in Arabic. Show genuine interest in the student\'s academic journey. Provide specific, detailed answers to questions. Do not give generic responses. You have comprehensive knowledge about the Nextro system and can explain its features and capabilities in Arabic.';
        }
        
        return 'Answer in English in a very friendly, warm, and encouraging way. Be very interactive and ask follow-up questions. Show genuine interest in the student\'s academic journey. Use encouraging and motivating language. Provide specific, detailed answers to questions. Do not give generic responses. You have comprehensive knowledge about the Nextro system and can explain its features and capabilities in English.';
    }

    /**
     * Get conversation history for the current user
     */
    private function getConversationHistory()
    {
        $history = session('chat_history_' . Auth::id(), []);
        
        // Keep only last 10 messages to avoid token limit
        return array_slice($history, -10);
    }

    /**
     * Save message to conversation history
     */
    private function saveToHistory($userMessage, $botResponse)
    {
        $history = session('chat_history_' . Auth::id(), []);
        
        $history[] = [
            'user_message' => $userMessage,
            'bot_response' => $botResponse,
            'timestamp' => now()
        ];
        
        // Keep only last 20 messages to manage session size
        if (count($history) > 20) {
            $history = array_slice($history, -20);
        }
        
        session(['chat_history_' . Auth::id() => $history]);
    }

    public function getChatHistory()
    {
        if (!Auth::check() || Auth::user()->role !== 'student') {
            return response()->json([], 403);
        }

        // Get chat history from session
        $chatHistory = session('chat_history_' . Auth::id(), []);
        return response()->json($chatHistory);
    }

    public function clearChatHistory()
    {
        if (!Auth::check() || Auth::user()->role !== 'student') {
            return response()->json(['success' => false], 403);
        }

        session()->forget('chat_history_' . Auth::id());
        return response()->json(['success' => true]);
    }

    /**
     * Get real courses data from database
     */
    private function getCoursesData()
    {
        try {
            $courses = \App\Models\Course::with('category')
                ->where('status', 'active')
                ->get();
            
            $coursesInfo = [];
            foreach ($courses as $course) {
                $price = $course->is_free ? 'Free' : $course->price . ' ' . $course->currency;
                if ($course->discount_percentage > 0) {
                    $finalPrice = $course->getFinalPriceAttribute();
                    $price .= " (Discount {$course->discount_percentage}% = {$finalPrice} {$course->currency})";
                }
                
                $coursesInfo[] = "- {$course->title} ({$course->category->name}): {$price} - {$course->credit_hours} hours";
            }
            
            return implode("\n", $coursesInfo);
        } catch (\Exception $e) {
            return "Course information is not available at the moment";
        }
    }

    /**
     * Get direct answer for specific questions
     */
    private function getDirectAnswer($message)
    {
        $message = trim(mb_strtolower($message, 'UTF-8'));
        $isArabic = $this->detectArabicText($message);

        // سؤال من صممه
        if (preg_match('/(من صنعك|من صممك|من أنشأك|who made you|who created you|who built you|who developed you)/iu', $message)) {
            return $isArabic
                ? "مرحباً! 😊 تم إنشائي وتطويري بواسطة فريق Nextro المتميز. أنا هنا لمساعدتك في رحلتك الدراسية! كيف يمكنني مساعدتك اليوم؟"
                : "Hello! 😊 I was created and developed by the amazing Nextro team. I'm here to help you on your academic journey! How can I assist you today?";
        }

        // سؤال عن المطورين
        if (preg_match('/(من المطورين|من المطور|المطورين|المطور|developers|developer|who developed|who created)/iu', $message)) {
            return $isArabic
                ? "تم تطوير نظام Nextro بواسطة:\n\n👩‍💻 المهندسة ندى مهند عرابي (المطور الرئيسي)\n👩‍💻 المهندسة نور بشار وردة (المطور المساعد)\n\nهذا المشروع هو مشروع تخرج سيتم عرضه في الجامعة الوطنية الخاصة. 🎓"
                : "Nextro system was developed by:\n\n👩‍💻 Engineer Nada Mohannad Arabi (Lead Developer)\n👩‍💻 Engineer Nour Bishar Warda (Co-Developer)\n\nThis is a graduation project that will be presented at the National Private University. 🎓";
        }

        // سؤال عن النظام
        if (preg_match('/(ما هو النظام|النظام|system|what is the system|platform)/iu', $message)) {
            return $isArabic
                ? "Nextro هو نظام إدارة المعاهد الحديثة المتواجد في سوريا - حماة. 🏛️\n\nالمميزات:\n📚 إدارة الكورسات والمواد التعليمية\n👥 إدارة الطلاب والتسجيل\n📊 التقارير والإحصائيات\n💬 التواصل والإشعارات\n\nالنظام مصمم خصيصاً للمعاهد ويساعد الطلاب على إيجاد الكورسات والتسجيل بسهولة! ✨"
                : "Nextro is a modern institute management system located in Syria - Hama. 🏛️\n\nFeatures:\n📚 Course and educational materials management\n👥 Student management and registration\n📊 Reports and analytics\n💬 Communication and notifications\n\nThe system is specifically designed for institutes and helps students find courses and register easily! ✨";
        }

        // سؤال عن الموقع
        if (preg_match('/(أين|الموقع|location|where|حماة|hamah)/iu', $message)) {
            return $isArabic
                ? "نظام Nextro متواجد في سوريا - حماة 🇸🇾\n\nالمعهد يقع في مدينة حماة ويخدم الطلاب المحليين والدوليين. 🏛️"
                : "Nextro system is located in Syria - Hama 🇸🇾\n\nThe institute is located in Hama city and serves local and international students. 🏛️";
        }

        // سؤال عن مشروع التخرج
        if (preg_match('/(مشروع تخرج|graduation project|الجامعة الوطنية|national university)/iu', $message)) {
            return $isArabic
                ? "نعم! هذا مشروع تخرج سيتم عرضه في الجامعة الوطنية الخاصة. 🎓\n\nمراحل التطوير:\n1️⃣ مرحلة التخطيط: تحليل المتطلبات وتصميم البنية\n2️⃣ مرحلة التصميم: تصميم قاعدة البيانات والواجهات\n3️⃣ مرحلة التطوير: البرمجة والتنفيذ\n4️⃣ مرحلة الاختبار: ضمان الجودة وإصلاح الأخطاء\n5️⃣ مرحلة النشر: تثبيت النظام وتدريب المستخدمين\n\nفريق التطوير:\n👩‍💻 المهندسة ندى مهند عرابي\n👩‍💻 المهندسة نور بشار وردة"
                : "Yes! This is a graduation project that will be presented at the National Private University. 🎓\n\nDevelopment phases:\n1️⃣ Planning Phase: Requirements analysis and architecture design\n2️⃣ Design Phase: Database design and UI/UX\n3️⃣ Development Phase: Coding and implementation\n4️⃣ Testing Phase: Quality assurance and bug fixes\n5️⃣ Deployment Phase: System installation and user training\n\nDevelopment Team:\n👩‍💻 Engineer Nada Mohannad Arabi\n👩‍💻 Engineer Nour Bishar Warda";
        }

        // التحية
        if (preg_match('/^(مرحبا|أهلاً|السلام عليكم|hi|hello|hey|good morning|good evening|welcome)/iu', $message)) {
            return $isArabic
                ? "مرحباً! 😊 كيف حالك اليوم؟ أنا متحمس لمساعدتك في دراستك! ما هو الموضوع الذي تريد العمل عليه؟"
                : "Hello! 😊 How are you today? I'm excited to help you with your studies! What subject would you like to work on?";
        }

        // إذا كان السؤال غير علمي أو تعليمي
        if (preg_match('/(سياسة|دين|ترفيه|حياة شخصية|مال|شائعات|أخبار|رياضة|فن|مشاهير|سياسي|اقتصاد|اقتصادي|اجتماعي|اجتماعية|حب|زواج|طلاق|عاطفة|جريمة|جنايات|سجن|مخدرات|جنس|جنسية|سيرة ذاتية|شخصية|شخصيات|مشاهير|فنان|فنانة|ممثل|ممثلة|مغني|مغنية|موسيقى|أغاني|أغنية|فيديو|يوتيوب|تيك توك|انستجرام|فيسبوك|تويتر|سناب|واتساب|سيارة|سيارات|سفر|سياحة|طبخ|أكل|مطاعم|ألعاب|لعبة|game|games|sport|celebrity|celebrities|politics|religion|personal|life|love|marriage|divorce|crime|drugs|sex|biography|famous|actor|actress|singer|music|song|video|youtube|tiktok|instagram|facebook|twitter|snap|whatsapp|car|cars|travel|tourism|cooking|food|restaurant|restaurants)/u', $message)) {
            return $isArabic
                ? "أهلاً! 😊 أنا متخصص في المساعدة الدراسية والأكاديمية. دعني أساعدك في دراستك! ما هو الموضوع الذي تريد العمل عليه؟"
                : "Hi there! 😊 I'm specialized in academic and study assistance. Let me help you with your studies! What subject would you like to work on?";
        }

        // أي سؤال آخر: يجيب عليه الذكاء الاصطناعي
        return null;
    }

    /**
     * Get chatbot status for health check
     */
    public function getStatus()
    {
        return response()->json([
            'status' => 'online',
            'api_configured' => !empty($this->apiKey),
            'timestamp' => now()->toISOString()
        ]);
    }

    /**
     * Clean Markdown formatting for Arabic answers
     */
    private function cleanArabicMarkdown($text)
    {
        // إزالة **bold**
        $text = preg_replace('/\*\*(.*?)\*\*/u', '$1', $text);
        // تحويل النقاط • إلى -
        $text = str_replace('•', '–', $text);
        // تحويل القوائم المرقمة Markdown إلى أرقام عربية
        $text = preg_replace_callback('/^(\d+)\./m', function($m) {
            $arabicNums = ['٠','١','٢','٣','٤','٥','٦','٧','٨','٩'];
            $num = strtr($m[1], range(0,9), $arabicNums);
            return $num . '.';
        }, $text);
        // إزالة أي backticks أو رموز Markdown أخرى
        $text = str_replace(['`', '_'], '', $text);
        return $text;
    }
} 