# Exam Delivery Feature Documentation

## Overview
This feature allows teachers to create exams in two delivery formats:
1. **Online Exams**: Questions are displayed on the website for students to answer directly
2. **File-based Exams**: Students download an exam file (PDF, DOC, DOCX, TXT) to complete offline

## Database Changes

### New Migration
- **File**: `database/migrations/2025_07_13_202738_add_delivery_type_to_exams_table.php`
- **New Columns**:
  - `delivery_type`: ENUM('online', 'file') - Default: 'online'
  - `file_path`: VARCHAR - Stores the path to uploaded exam files

### Model Updates
- **File**: `app/Models/Exam.php`
- **Changes**: Added `delivery_type` and `file_path` to `$fillable` array

## Controller Updates

### ExamController Changes
- **File**: `app/Http/Controllers/Teacher/ExamController.php`
- **Updated Methods**:
  - `store()`: Added file upload handling and delivery type validation
  - `update()`: Added file upload handling for existing exams
  - `destroy()`: Updated success message to use translations

### Key Features:
- File validation (PDF, DOC, DOCX, TXT, max 10MB)
- Dynamic form behavior (show/hide file upload based on delivery type)
- File storage in `storage/app/public/exams/`
- Automatic file path management

## View Updates

### Create Exam Page
- **File**: `resources/views/Teacher/exams/create.blade.php`
- **Features**:
  - Delivery type selection dropdown
  - Dynamic file upload section
  - JavaScript to show/hide file upload based on selection
  - Form validation for file uploads

### Edit Exam Page
- **File**: `resources/views/Teacher/exams/edit.blade.php`
- **Features**:
  - Current file display and download link
  - Option to keep or replace existing file
  - Same dynamic behavior as create page

### Exam Index Page
- **File**: `resources/views/Teacher/exams/index.blade.php`
- **Features**:
  - New "Delivery" column showing delivery type
  - Download links for file-based exams
  - Conditional "Questions" button (only for online exams)

### Exam Show Page
- **File**: `resources/views/Teacher/exams/show.blade.php`
- **Features**:
  - Delivery method display with badges
  - File download button for file-based exams
  - Conditional questions section (only for online exams)
  - Special section for file-based exams explaining the format

## Language Files

### Arabic Translations
- **File**: `lang/ar/exams.php`
- **Includes**:
  - Success messages
  - Delivery type labels
  - File upload help text
  - Validation messages

### English Translations
- **File**: `lang/en/exams.php`
- **Includes**:
  - Success messages
  - Delivery type labels
  - File upload help text
  - Validation messages

## File Storage

### Directory Structure
```
storage/
└── app/
    └── public/
        └── exams/
            └── [uploaded exam files]
```

### File Naming Convention
- Format: `{timestamp}_{original_filename}`
- Example: `1700000000_exam_questions.pdf`

### Supported File Types
- PDF (.pdf)
- Microsoft Word (.doc, .docx)
- Text files (.txt)
- Maximum size: 10MB

## Usage Instructions

### For Teachers

#### Creating an Online Exam
1. Navigate to Exams → Add New Exam
2. Fill in basic exam details
3. Select "Online (Questions on website)" as delivery method
4. Save the exam
5. Add questions using the Questions feature

#### Creating a File-based Exam
1. Navigate to Exams → Add New Exam
2. Fill in basic exam details
3. Select "File Upload (Student downloads file)" as delivery method
4. Upload the exam file (PDF, DOC, DOCX, TXT)
5. Save the exam
6. Students will download the file to complete the exam

#### Editing Exams
- For online exams: Can modify questions and exam details
- For file-based exams: Can replace the file or change delivery type
- File upload is optional when editing (keeps existing file if not changed)

### For Students
- **Online Exams**: Access questions directly on the website
- **File-based Exams**: Download the exam file to complete offline

## Technical Implementation

### JavaScript Functions
```javascript
function toggleDeliveryMethod() {
  const deliveryType = document.getElementById('delivery_type').value;
  const fileSection = document.getElementById('fileUploadSection');
  const fileInput = document.getElementById('exam_file');
  
  if (deliveryType === 'file') {
    fileSection.style.display = 'block';
    fileInput.required = true;
  } else {
    fileSection.style.display = 'none';
    fileInput.required = false;
  }
}
```

### Validation Rules
```php
'delivery_type' => 'required|in:online,file',
'exam_file' => 'nullable|file|mimes:pdf,doc,docx,txt|max:10240'
```

### File Upload Handling
```php
if ($request->delivery_type === 'file' && $request->hasFile('exam_file')) {
    $file = $request->file('exam_file');
    $fileName = time() . '_' . $file->getClientOriginalName();
    $filePath = $file->storeAs('exams', $fileName, 'public');
    $data['file_path'] = $filePath;
}
```

## Security Considerations

### File Upload Security
- File type validation (whitelist approach)
- File size limits (10MB max)
- Secure file naming (timestamp prefix)
- Files stored outside web root
- Access controlled through Laravel's storage system

### Access Control
- Teachers can only manage their own exams
- File downloads are public but files are stored securely
- No direct file system access

## Future Enhancements

### Potential Improvements
1. **File Preview**: Add preview functionality for uploaded files
2. **Multiple Files**: Support for multiple exam files
3. **File Versioning**: Track file changes and versions
4. **Bulk Upload**: Allow bulk file upload for multiple exams
5. **File Templates**: Provide exam file templates
6. **Student Submissions**: Track file downloads and submissions

### Integration Opportunities
1. **Email Notifications**: Notify students when file-based exams are available
2. **Progress Tracking**: Track student progress on file-based exams
3. **Grading Integration**: Integrate with existing grading system
4. **Analytics**: Track exam file download statistics

## Troubleshooting

### Common Issues

#### File Upload Fails
- Check file size (must be under 10MB)
- Verify file type (PDF, DOC, DOCX, TXT only)
- Ensure storage directory has write permissions
- Check symbolic link: `php artisan storage:link`

#### File Download 404 Error
- Verify symbolic link exists: `php artisan storage:link`
- Check file exists in `storage/app/public/exams/`
- Ensure web server can access storage directory

#### Form Validation Errors
- Check all required fields are filled
- Verify delivery type is selected
- Ensure file is uploaded when delivery type is 'file'

### Debug Commands
```bash
# Recreate storage link
php artisan storage:link

# Clear cache
php artisan cache:clear
php artisan config:clear

# Check file permissions
ls -la storage/app/public/exams/

# Verify symbolic link
ls -la public/storage
```

## Migration Commands

### To Apply Changes
```bash
php artisan migrate
```

### To Rollback Changes
```bash
php artisan migrate:rollback --step=1
```

## Testing

### Manual Testing Checklist
- [ ] Create online exam (no file upload)
- [ ] Create file-based exam (with file upload)
- [ ] Edit online exam (change to file-based)
- [ ] Edit file-based exam (replace file)
- [ ] Download exam files
- [ ] Validate file type restrictions
- [ ] Validate file size limits
- [ ] Test form validation messages
- [ ] Verify symbolic link functionality

### Automated Testing
- Unit tests for file upload validation
- Integration tests for exam creation/editing
- Feature tests for file download functionality
- Browser tests for dynamic form behavior 