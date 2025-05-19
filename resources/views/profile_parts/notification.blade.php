<div class="container-fluid px-2">
  <div class="tab-pane">
    <h6 class="text-center">📢 Notifications</h6>
    <p class="text-muted text-center font-weight-bold">Tap on any notification to mark it as read.</p>
    <hr>

    <!-- Notification List -->
    <div id="notification-container" class="row"></div>

    <!-- Pagination Controls -->
    <div class="pagination-container text-center mt-4">
      <button id="prevPage" class="btn btn-outline-secondary btn-xs" disabled>⬅ Previous</button>
      <span id="pageIndicator" class="font-weight-bold mx-3"></span>
      <button id="nextPage" class="btn btn-outline-secondary btn-xs">Next ➡</button>
    </div>
  </div>
</div>

<script>
  const notifications = Array.from({ length: 12 }, (_, i) => ({
    id: i + 1,
    text: `🔔 Notification ${i + 1}: Important update!`,
    status: "Unread"
  }));

  function getSavedStatus() {
    return JSON.parse(localStorage.getItem("notificationStatus")) || {};
  }

  function saveStatus(status) {
    localStorage.setItem("notificationStatus", JSON.stringify(status));
  }

  let currentPage = 1;
  const perPage = 5;
  const container = document.getElementById("notification-container");
  const pageIndicator = document.getElementById("pageIndicator");
  const prevBtn = document.getElementById("prevPage");
  const nextBtn = document.getElementById("nextPage");

  function renderNotifications() {
    container.innerHTML = "";
    const savedStatus = getSavedStatus();
    const pageNotifications = notifications.slice((currentPage - 1) * perPage, currentPage * perPage);

    pageNotifications.forEach(notif => {
      const card = document.createElement("div");
      card.className = `col-12 mb-3 notification-card ${savedStatus[notif.id] === 'Read' ? 'read-effect' : ''}`;
      card.innerHTML = `
        <div class="card shadow-sm">
          <div class="card-body d-flex justify-content-between align-items-center">
            <span class="notif-text">${notif.text}</span>
            <button class="btn btn-outline-primary btn-sm mark-read" data-id="${notif.id}">
              ${savedStatus[notif.id] === "Read" ? "✅ Read" : "📩 Mark as Read"}
            </button>
          </div>
        </div>
      `;
      container.appendChild(card);
    });

    document.querySelectorAll(".mark-read").forEach(button => {
      button.addEventListener("click", () => {
        const notifId = button.getAttribute("data-id");
        const savedStatus = getSavedStatus();
        savedStatus[notifId] = "Read";
        saveStatus(savedStatus);
        renderNotifications();
      });
    });

    pageIndicator.innerText = `Page ${currentPage} of ${Math.ceil(notifications.length / perPage)}`;
    prevBtn.disabled = currentPage === 1;
    nextBtn.disabled = currentPage >= Math.ceil(notifications.length / perPage);
  }

  prevBtn.addEventListener("click", () => {
    if (currentPage > 1) {
      currentPage--;
      renderNotifications();
    }
  });

  nextBtn.addEventListener("click", () => {
    if (currentPage < Math.ceil(notifications.length / perPage)) {
      currentPage++;
      renderNotifications();
    }
  });

  renderNotifications();
</script>

<style>
.pagination-container button {
  background-color: #007bff;
  color: white;
  border-radius: 6px; /* تقليل تدوير الحواف */
  padding: 5px 10px; /* تصغير الحجم */
  font-size: 12px; /* تقليل حجم النص */
  border: none;
  font-weight: bold;
  transition: background-color 0.3s, transform 0.2s;
}

.pagination-container button:hover {
  background-color: #0056b3;
  transform: scale(1.05);
}

.pagination-container button:disabled {
  background-color: #ccc;
  color: #666;
  cursor: not-allowed;
}

.pagination-container {
  display: flex;
  justify-content: center;
  align-items: center;
  gap: 8px; /* تقليل المسافة بين العناصر */
  margin-top: 15px; /* تحسين التباعد */
}


</style>
