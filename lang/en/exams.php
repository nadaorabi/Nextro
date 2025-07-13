<?php

return [
    'created' => 'Exam created successfully',
    'updated' => 'Exam updated successfully',
    'deleted' => 'Exam deleted successfully',
    'delivery_types' => [
        'online' => 'Online (Questions on website)',
        'file' => 'File Upload (Student downloads file)',
    ],
    'types' => [
        'manual' => 'Manual (Teacher Grading)',
        'auto' => 'Auto (Automatic Grading)',
    ],
    'file_upload' => [
        'label' => 'Exam File',
        'help' => 'Supported formats: PDF, DOC, DOCX, TXT (Max size: 10MB)',
        'current_file' => 'Current File:',
        'download' => 'Download Current File',
        'keep_current' => 'Leave empty to keep current file',
    ],
    'validation' => [
        'delivery_type_required' => 'Delivery type is required',
        'file_required_for_file_type' => 'File is required when delivery type is "file"',
        'file_size' => 'File size must be less than 10MB',
        'file_type' => 'File type not supported. Supported formats: PDF, DOC, DOCX, TXT',
    ],
]; 