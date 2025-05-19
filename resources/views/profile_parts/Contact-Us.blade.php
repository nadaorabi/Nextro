<div class="tab-pane" id="academic-support">
  <h6 class="text-center">Send Inquiry or Request Support</h6>
  <hr>

  <form>
    <div class="form-group mb-3">
      <label for="recipientSelect">Send To</label>
      <select class="form-control" id="recipientSelect" required>
        <option disabled selected>Select a recipient</option>
        <optgroup label="Instructors">
          <option value="john.smith@university.edu">Dr. John Smith – CS101</option>
          <option value="maria.jones@university.edu">Dr. Maria Jones – MATH202</option>
        </optgroup>
        <optgroup label="Support">
          <option value="support@university.edu">Technical Support</option>
          <option value="advising@university.edu">Academic Advising</option>
        </optgroup>
      </select>
    </div>

    <div class="form-group mb-3">
      <label for="subject">Subject</label>
      <input type="text" class="form-control" id="subject" placeholder="Enter a short title" required>
    </div>

    <div class="form-group mb-3">
      <label for="message">Message</label>
      <textarea class="form-control" id="message" rows="4" placeholder="Describe your question or issue..." required></textarea>
    </div>

    <div class="form-group mb-3">
      <label for="attachment">Attach File (optional)</label>
      <input type="file" class="form-control" id="attachment">
    </div>

    <div class="d-flex flex-column flex-md-row justify-content-center gap-3">
      <button type="submit" class="btn btn-primary btn-lg w-100 w-md-auto">Send Request</button>
    </div>
  </form>

  <hr>

  <div class="small text-muted text-center">
    Your message will be sent directly to the selected instructor or support office. Please allow up to 48 hours for a response.
  </div>
</div>
