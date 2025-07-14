{{-- قسم التعليقات العامة --}}
<div class="card mt-4">
    <div class="card-header pb-0">
        <h6 class="mb-0">
            <i class="fas fa-bullhorn me-2"></i>
            {{ __('grading.general_comments') }}
        </h6>
        <small class="text-muted">{{ __('grading.general_comment_for_all_students') }}</small>
    </div>
    <div class="card-body">
        {{-- عرض جميع التعليقات العامة --}}
        @if($item->generalComments && $item->generalComments->count())
            @foreach($item->generalComments->sortByDesc('created_at') as $comment)
                <div class="general-comment-item border rounded p-3 mb-4 bg-light">
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
                                        {{ __('grading.general_comment_by') }} {{ $comment->teacher->name }} 
                                        {{ __('grading.general_comment_on') }} {{ $comment->created_at->format('M d, Y H:i') }}
                                    </small>
                                </div>
                            </div>
                            <div class="comment-text">
                                <p class="mb-2">{{ $comment->comment }}</p>
                            </div>
                            {{-- المرفق العام --}}
                            @if($comment->hasAttachment())
                                <div class="attachment-info">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-paperclip text-primary me-2"></i>
                                        <div>
                                            <a href="{{ route($downloadRoute, $comment->id) }}" 
                                               class="text-primary text-decoration-none">
                                                {{ $comment->attachment_file_name }}
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
                            <form action="{{ route($deleteRoute, $comment->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('{{ __('grading.delete_general_comment') }}?')"
                                  style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-link text-danger p-0" 
                                        title="{{ __('grading.delete_general_comment') }}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="text-center py-4">
                <i class="fas fa-bullhorn text-muted" style="font-size: 3rem;"></i>
                <p class="text-muted mt-2">{{ __('grading.no_general_comments') }}</p>
            </div>
        @endif

        {{-- نموذج إضافة تعليق عام جديد --}}
        <div class="add-general-comment-section">
            <h6 class="mb-3">{{ __('grading.add_general_comment') }}</h6>
            <form action="{{ $commentRoute }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="general_comment" class="form-label">{{ __('grading.general_comment_text') }}</label>
                    <textarea name="general_comment" id="general_comment" rows="4" 
                              class="form-control @error('general_comment') is-invalid @enderror" 
                              placeholder="اكتب التعليق العام هنا..." required>{{ old('general_comment') }}</textarea>
                    @error('general_comment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="comment_attachment" class="form-label">{{ __('grading.general_attachment_optional') }}</label>
                    <input type="file" name="comment_attachment" id="comment_attachment" 
                           class="form-control @error('comment_attachment') is-invalid @enderror"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,image/jpeg,image/png">
                    <small class="form-text text-muted">
                        الملفات المسموحة: PDF, DOC, DOCX, JPG, JPEG, PNG (الحد الأقصى: 10MB)
                    </small>
                    @error('comment_attachment')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-paper-plane me-2"></i>
                        {{ __('grading.submit_general_comment') }}
                    </button>
                </div>
            </form>
        </div>
    </div>
</div> 