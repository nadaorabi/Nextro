# Assignment Delivery Feature

## Overview
This feature allows teachers to create assignments in two different delivery methods:

1. **Online Assignments**: Questions are created and displayed directly on the website
2. **File-based Assignments**: Teachers upload a file (PDF, DOC, DOCX, TXT) that students download

## Database Changes

### New Migration: `add_delivery_type_to_assignments_table`
- Added `delivery_type` enum field with values: `online`, `file`
- Added `file_path` string field to store uploaded file paths
- Default value for `delivery_type` is `online`

### Updated Model: `Assignment`
- Added `delivery_type` and `file_path` to fillable array
- Maintains existing relationships and functionality

## Controller Updates

### AssignmentController
- Updated `store()` method to handle file uploads
- Updated `update()` method to handle file changes
- Added validation for file uploads (max 10MB, supported formats)
- Added custom validation messages in Arabic and English

## View Updates

### Create Assignment Page (`create.blade.php`)
- Added delivery method selection dropdown
- Added file upload section (hidden by default)
- JavaScript to show/hide file upload based on delivery type
- Form now supports `multipart/form-data`

### Edit Assignment Page (`edit.blade.php`)
- Added delivery method selection
- Shows current file if exists
- Allows file replacement
- Maintains existing file if no new file uploaded

### Assignment Index Page (`index.blade.php`)
- Added "Delivery" column to show delivery type
- Shows download link for file-based assignments
- Questions button only shows for online assignments

### Assignment Show Page (`show.blade.php`)
- Displays delivery method information
- Shows file download link for file-based assignments
- Different display for online vs file assignments

## File Upload Features

### Supported File Types
- PDF (.pdf)
- Microsoft Word (.doc, .docx)
- Text files (.txt)

### File Storage
- Files stored in `storage/app/public/assignments/`
- Files accessible via `/storage/assignments/` URL
- Unique filenames with timestamps to prevent conflicts

### File Size Limits
- Maximum file size: 10MB
- Validation enforced on both client and server side

## Language Support

### Arabic Translations (`lang/ar/assignments.php`)
- Success messages
- Delivery type labels
- File upload help text
- Validation messages

### English Translations (`lang/en/assignments.php`)
- Corresponding English translations
- Consistent messaging across languages

## JavaScript Functionality

### Dynamic Form Behavior
- `toggleDeliveryMethod()` function shows/hides file upload section
- File input becomes required when delivery type is "file"
- Form validation updates dynamically

## Usage Examples

### Creating an Online Assignment
1. Teacher selects "Online (Questions on website)"
2. File upload section remains hidden
3. Teacher can add questions after assignment creation
4. Students see questions directly on website

### Creating a File-based Assignment
1. Teacher selects "File Upload (Student downloads file)"
2. File upload section appears
3. Teacher uploads assignment file (PDF, DOC, etc.)
4. Students download file and submit answers separately

## Security Considerations

### File Upload Security
- File type validation (mimes: pdf,doc,docx,txt)
- File size limits (max: 10MB)
- Files stored outside web root
- Unique filenames prevent conflicts

### Access Control
- Only assignment owner (teacher) can upload files
- File paths validated and sanitized
- Direct file access through Laravel's storage system

## Future Enhancements

### Potential Improvements
- File preview functionality
- Multiple file support
- File versioning
- Student submission tracking for file assignments
- Integration with document processing APIs

## Testing

### Manual Testing Checklist
- [ ] Create online assignment
- [ ] Create file-based assignment with PDF
- [ ] Create file-based assignment with DOC
- [ ] Edit assignment delivery type
- [ ] Replace assignment file
- [ ] Download assignment files
- [ ] Validate file size limits
- [ ] Validate file type restrictions
- [ ] Test Arabic and English interfaces

## Migration Notes

### For Existing Assignments
- Existing assignments default to `online` delivery type
- No data migration required
- Backward compatibility maintained

### Database Migration
```bash
php artisan migrate
```

### Storage Setup
```bash
php artisan storage:link
mkdir -p storage/app/public/assignments
``` 