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

    public function __construct()
    {
        $this->apiKey = env('OPENAI_API_KEY');
    }

    public function showChat()
    {
        // Check if user is authenticated and is a student
        if (!Auth::check() || Auth::user()->role !== 'student') {
            return redirect()->route('login')->with('error', 'يجب تسجيل الدخول كطالب للوصول للمساعد الذكي.');
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
                    'message' => 'غير مصرح لك باستخدام المساعد الذكي.'
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
                    'message' => 'عذراً، المساعد الذكي غير متاح حالياً. يرجى المحاولة لاحقاً.'
                ], 500);
            }

            // Get real course data from database
            $coursesData = $this->getCoursesData();
            
            // Check for specific questions and provide direct answers
            $directAnswer = $this->getDirectAnswer($userMessage);
            if ($directAnswer) {
                return response()->json([
                    'success' => true,
                    'message' => $directAnswer,
                    'timestamp' => now()->format('H:i')
                ]);
            }
            
            // Detect user language
            $isArabic = preg_match('/[\x{0600}-\x{06FF}]/u', $userMessage);
            $langInstruction = $isArabic
                ? 'Answer in Arabic in a professional, friendly, and motivating way.'
                : 'Answer in English in a professional, friendly, and motivating way.';
            // Prepare the conversation context with language detection
            $messages = [
                [
                    'role' => 'system',
                    'content' => "You are a professional, friendly, and ethical academic assistant for students at Nextro Institute.\n\nYour main mission:\n- Explain academic concepts in a simple, clear, and engaging way.\n- Help students understand lessons, solve exercises, and guide them in research or assignments without giving final answers directly.\n- Encourage critical thinking and self-learning, not just ready answers.\n- Always use polite, respectful, and clear language.\n- Adapt your explanations to the student's age and level.\n- Refer to scientific sources if possible, or suggest general trusted resources.\n- Respect the academic and ethical environment of the institute.\n- Interact in a human, encouraging, and motivating way.\n\nYou must never:\n- Answer any non-academic or non-educational questions (politics, religion, entertainment, personal life, medicine, relationships, money, rumors, or any sensitive or inappropriate content).\n- Provide biased, violent, bullying, discriminatory, or inappropriate content.\n- Express personal opinions or discuss non-scientific topics.\n\nIf the user asks a non-educational question:\n- Politely apologize and ask them to ask an academic question.\n- Example: 'Sorry, I can't discuss this type of question. How can I help you with your studies or current lesson?'\n\nYour ultimate goal:\nTo be a virtual study companion for the student, helping them learn, progress, and succeed academically.\n\nAvailable courses:\n{$coursesData}\n\n{$langInstruction}"
                ],
                [
                    'role' => 'user',
                    'content' => $userMessage
                ]
            ];

            // Make API call to ChatGPT with SSL options and cost optimization
            $response = Http::timeout(30)
                ->withOptions([
                    'verify' => false, // Disable SSL verification temporarily
                    'curl' => [
                        CURLOPT_SSL_VERIFYPEER => false,
                        CURLOPT_SSL_VERIFYHOST => false,
                    ]
                ])
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $this->apiKey,
                    'Content-Type' => 'application/json',
                ])
                ->post($this->apiUrl, [
                    'model' => 'gpt-3.5-turbo', // أسرع نموذج
                    'messages' => $messages,
                    'max_tokens' => 500, // تقليل للسرعة
                    'temperature' => 0.3,
                    'presence_penalty' => 0.1,
                    'frequency_penalty' => 0.1,
                ]);

            if ($response->successful()) {
                $data = $response->json();
                $botResponse = $data['choices'][0]['message']['content'] ?? 'عذراً، حدث خطأ في معالجة رسالتك.';
                if ($isArabic) {
                    $botResponse = $this->cleanArabicMarkdown($botResponse);
                }
                
                // Log successful interaction
                Log::info('Chatbot interaction', [
                    'user_id' => Auth::id(),
                    'user_message' => $userMessage,
                    'bot_response' => $botResponse,
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
                
                return response()->json([
                    'success' => false,
                    'message' => 'عذراً، حدث خطأ في الاتصال. يرجى المحاولة مرة أخرى.'
                ], 500);
            }

        } catch (\Exception $e) {
            Log::error('ChatBot Error: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'message' => $request->input('message')
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'عذراً، حدث خطأ غير متوقع. يرجى المحاولة مرة أخرى.'
            ], 500);
        }
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
                $price = $course->is_free ? 'مجاني' : $course->price . ' ' . $course->currency;
                if ($course->discount_percentage > 0) {
                    $finalPrice = $course->getFinalPriceAttribute();
                    $price .= " (خصم {$course->discount_percentage}% = {$finalPrice} {$course->currency})";
                }
                
                $coursesInfo[] = "- {$course->title} ({$course->category->name}): {$price} - {$course->credit_hours} ساعة";
            }
            
            return implode("\n", $coursesInfo);
        } catch (\Exception $e) {
            return "معلومات الكورسات غير متاحة حالياً";
        }
    }

    /**
     * Get course name translation
     */
    private function translateCourseName($course, $isArabic)
    {
        // يمكنك تعديل هذا القاموس حسب الكورسات الفعلية لديك
        $translations = [
            'math' => ['ar' => 'الرياضيات', 'en' => 'Math'],
            'sciences' => ['ar' => 'العلوم', 'en' => 'Sciences'],
            'arabic' => ['ar' => 'اللغة العربية', 'en' => 'Arabic'],
            // أضف المزيد حسب الحاجة
        ];
        $key = strtolower($course->title);
        if (isset($translations[$key])) {
            return $isArabic ? $translations[$key]['ar'] : $translations[$key]['en'];
        }
        return $course->title;
    }

    /**
     * Get direct answer for specific questions
     */
    private function getDirectAnswer($message)
    {
        $message = trim(mb_strtolower($message, 'UTF-8'));
        $isArabic = preg_match('/[\x{0600}-\x{06FF}]/u', $message);

        // سؤال من صممه
        if (preg_match('/(من صنعك|من صممك|من أنشأك|who made you|who created you|who built you|who developed you)/iu', $message)) {
            return $isArabic
                ? "تم إنشائي وتطويري بواسطة فريق Nextro."
                : "I was created and developed by the Nextro team.";
        }

        // التحية
        if (preg_match('/^(مرحبا|أهلاً|السلام عليكم|hi|hello|hey|good morning|good evening|welcome)/iu', $message)) {
            return $isArabic
                ? "مرحباً! كيف يمكنني مساعدتك في موضوع علمي أو دراسي؟"
                : "Hello! How can I help you with a scientific or academic topic?";
        }

        // إذا كان السؤال غير علمي أو تعليمي
        if (preg_match('/(سياسة|دين|ترفيه|حياة شخصية|مال|شائعات|أخبار|رياضة|فن|مشاهير|سياسي|اقتصاد|اقتصادي|اجتماعي|اجتماعية|حب|زواج|طلاق|عاطفة|جريمة|جنايات|سجن|مخدرات|جنس|جنسية|سيرة ذاتية|شخصية|شخصيات|مشاهير|فنان|فنانة|ممثل|ممثلة|مغني|مغنية|موسيقى|أغاني|أغنية|فيديو|يوتيوب|تيك توك|انستجرام|فيسبوك|تويتر|سناب|واتساب|سيارة|سيارات|سفر|سياحة|طبخ|أكل|مطاعم|ألعاب|لعبة|game|games|sport|celebrity|celebrities|politics|religion|personal|life|love|marriage|divorce|crime|drugs|sex|biography|famous|actor|actress|singer|music|song|video|youtube|tiktok|instagram|facebook|twitter|snap|whatsapp|car|cars|travel|tourism|cooking|food|restaurant|restaurants)/u', $message)) {
            return $isArabic
                ? "عذراً، لا يمكنني مناقشة هذا النوع من الأسئلة. اسألني عن موضوع علمي أو تعليمي."
                : "Sorry, I can't discuss this type of question. Please ask me about a scientific or educational topic.";
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