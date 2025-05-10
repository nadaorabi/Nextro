<div class="tab-pane" id="attendance-Record">
  <h5>📅 Attendance Record - Modern Institute</h5>
  <hr>

  <!-- Attendance Table -->
  <div class="table-responsive">
    <table class="table table-bordered text-center" id="attendanceTable">
      <thead class="thead-light">
        <tr>
          <th>Date</th>
          <th>Day</th>
          <th>Course Type</th>
          <th>Status</th>
          <th>Notes</th>
        </tr>
      </thead>
      <tbody>
        <!-- Rows will be inserted by JavaScript -->
      </tbody>
    </table>
  </div>

  <!-- Attendance Summary -->
  <div class="mt-3 text-right">
    <strong>Attendance Rate:</strong> <span id="attendanceRate">--%</span>
  </div>
</div>

<script>
  // Sample attendance data - grouped by course type
  const attendanceData = [
    { date: "2025-04-01", day: "Tuesday", courseType: "Baccalaureate", status: "Present", notes: "Math class" },
    { date: "2025-04-02", day: "Wednesday", courseType: "Ninth Grade", status: "Absent", notes: "No excuse" },
    { date: "2025-04-03", day: "Thursday", courseType: "English Language", status: "Present", notes: "Good participation" },
    { date: "2025-04-04", day: "Friday", courseType: "Baccalaureate", status: "Present", notes: "" },
    { date: "2025-04-05", day: "Saturday", courseType: "English Language", status: "Absent", notes: "Sick leave" }
  ];

  const tableBody = document.querySelector("#attendanceTable tbody");
  let presentCount = 0;

  attendanceData.forEach(record => {
    const row = document.createElement("tr");

    row.innerHTML = `
      <td>${record.date}</td>
      <td>${record.day}</td>
      <td><strong>${record.courseType}</strong></td>
      <td>
        <span class="badge badge-${record.status === "Present" ? "success" : "danger"}">
          ${record.status === "Present" ? "✅ Present" : "❌ Absent"}
        </span>
      </td>
      <td>${record.notes || "-"}</td>
    `;

    if (record.status === "Present") presentCount++;
    tableBody.appendChild(row);
  });

  // Calculate and display attendance rate
  const rate = ((presentCount / attendanceData.length) * 100).toFixed(1);
  document.getElementById("attendanceRate").textContent = `${rate}%`;
</script>
