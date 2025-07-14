{{-- قسم التعليقات --}}
<div class="card mt-4">
    <div class="card-header pb-0">
        <h6 class="mb-0">{{ __('grading.comments') }}</h6>
    </div>
    <div class="card-body">
        {{-- عرض التعليقات الموجودة --}}
        @if(isset($comments) && $comments->count() > 0)
            <div class="comments-list mb-4">
                @foreach($comments as $comment)
                    <div class="comment-item border rounded p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-start">
                            <div class="flex-grow-1">
                                <div class="d-flex align-items-center mb-2">
                                    <div class="avatar avatar-sm me-3">
                                        <img src="{{ $comment->teacher->image ?? asset('images/default-avatar.png') }}" 
                                             alt="{{ $comment->teacher->name }}" 
                                             class="rounded-circle" 
                                             style="width: 32px; height: 32px;">
                                    </div>
                                    <div>
                                        <h6 class="mb-0">{{ $comment->teacher->name }}</h6>
                                        <small class="text-muted">
                                            {{ __('grading.comment_by') }} {{ $comment->teacher->name }} 
                                            {{ __('grading.on') }} {{ $comment->commented_at->format('M d, Y H:i') }}
                                        </small>
                                    </div>
                                </div>
                                <div class="comment-text">
                                    <p class="mb-2">{{ $comment->comment }}</p>
                                </div>
                                
                                {{-- المرفق --}}
                                @if($comment->hasAttachment())
                                    <div class="attachment-info">
                                        <div class="d-flex align-items-center">
                                            <i class="fas fa-paperclip text-primary me-2"></i>
                                            <div>
                                                <a href="{{ route('teacher.grading.download-comment-attachment', $comment->id) }}" 
                                                   class="text-primary text-decoration-none">
                                                    {{ basename($comment->attachment_file) }}
                                                </a>
                                                <small class="text-muted d-block">
                                                    {{ $comment->formatted_attachment_size }} • {{ $comment->attachment_type }}
                                                </small>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                            
                            {{-- زر الحذف --}}
                            <div class="ms-3">
                                <form action="{{ route('teacher.grading.delete-comment', $comment->id) }}" 
                                      method="POST" 
                                      onsubmit="return confirm('{{ __('grading.delete_comment') }}?')"
                                      style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" 
                                            title="{{ __('grading.delete_comment') }}">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-comments text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-2">{{ __('grading.no_comments') }}</p>
            </div>
        @endif

        {{-- نموذج إضافة تعليق جديد --}}
        <div class="add-comment-section">
            <h6 class="mb-3">{{ __('grading.add_comment') }}</h6>
            <form action="{{ $commentRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="comment" class="form-label">{{ __('grading.comment_text') }}</label>
                    <textarea name="comment" id="comment" rows="4" 
                              class="form-control @error('comment') is-invalid @enderror" 
                              placeholder="اكتب تعليقك هنا..." required>{{ old('comment') }}</textarea>
                    @error('comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="attachment" class="form-label">{{ __('grading.attachment_optional') }}</label>
                    <input type="file" name="attachment" id="attachment" 
                           class="form-control @error('attachment') is-invalid @enderror"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <small class="form-text text-muted">
                        الملفات المسموحة: PDF, DOC, DOCX, JPG, JPEG, PNG (الحد الأقصى: 10MB)
                    </small>
                    @error('attachment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>
                        {{ __('grading.submit_comment') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 