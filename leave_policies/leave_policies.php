<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Leave Policies</title>
  <style>
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background-color: #f5f7fa;
      margin: 0;
      padding: 0;
    }
    .container {
      max-width: 900px;
      margin: 40px auto;
      background-color: #ffffff;
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
    }
    h2 {
      color: #007acc;
      margin-top: 40px;
      border-bottom: 2px solid #007acc;
      padding-bottom: 8px;
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 12px 15px;
      border-bottom: 1px solid #ddd;
    }
    th {
      background: #007acc;
      color: #fff;
      text-transform: uppercase;
      font-size: 14px;
    }
    ul {
      margin-top: 10px;
      padding-left: 20px;
    }
    ul li {
      margin-bottom: 8px;
      line-height: 1.6;
    }
    .contact {
      margin-top: 30px;
      text-align: center;
    }
    .contact button {
      background: #007acc;
      color: white;
      padding: 12px 20px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 16px;
    }
    .contact button:hover {
      background: #005f99;
    }
    .back-link {
      margin-top: 40px;
      text-align: center;
    }
    .back-link a {
      color: #007acc;
      text-decoration: none;
      font-size: 16px;
    }
    .back-link a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Company Leave Policies</h1>

    <h2>1. Leave Types & Entitlements</h2>
    <table>
      <thead>
        <tr>
          <th>Leave Type</th>
          <th>Annual Entitlement</th>
        </tr>
      </thead>
      <tbody>
        <tr><td>Privilege Leave (PL) / Earned Leave (EL)</td><td>24 days</td></tr>
        <tr><td>Casual Leave (CL)</td><td>12 days</td></tr>
        <tr><td>Sick Leave (SL)</td><td>10 days</td></tr>
        <tr><td>Maternity Leave (ML)</td><td>90 days</td></tr>
        <tr><td>Paternity Leave</td><td>7 days</td></tr>
        <tr><td>Compensatory Off (Comp-off)</td><td>As earned</td></tr>
        <tr><td>Marriage Leave</td><td>5 days</td></tr>
        <tr><td>Bereavement Leave</td><td>5 days</td></tr>
        <tr><td>Loss of Pay (LOP) / Leave Without Pay (LWP)</td><td>Unpaid</td></tr>
      </tbody>
    </table>

    <h2>2. Accrual, Calendar & Carry-Over</h2>
    <ul>
      <li>All entitlements are credited on January 1 each year.</li>
      <li>Company holiday calendar published by January 10.</li>
      <li>Up to 5 days of Privilege/Earned Leave may carry over.</li>
      <li>Casual, Sick, and Comp-off leaves do not carry over.</li>
    </ul>

    <h2>3. Notice Period & Leave Approval</h2>
    <ul>
      <li>Submit planned leave at least 15 days in advance.</li>
      <li>Report sick leave within 2 hours of shift start.</li>
      <li>All leaves subject to manager/HR approval.</li>
    </ul>

    <h2>4. Emergency Leaves & Late Return</h2>
    <ul>
      <li>For emergencies call HR immediately: <b>+91-9876543210</b>.</li>
      <li>Failure to return by the end date without notice → LOP.</li>
    </ul>

    <h2>5. Modification & Cancellation</h2>
    <ul>
      <li>Pending leave requests can be cancelled at any time.</li>
      <li>Approved leave can be cancelled only up to 3 days before the start date.</li>
      <li>Modifications to approved leaves can only be made before the leave commencement via the "Modify Leave" feature.</li>
    </ul>

    <h2>6. Frequently Asked Questions</h2>
    <ul>
      <li><strong>What if I exceed my entitlement?</strong> Excess leaves will be marked as Loss of Pay (LOP).</li>
      <li><strong>Can I split leave types?</strong> Yes, but only with prior approval.</li>
      <li><strong>Who approves my leave?</strong> Your leave will be approved by your manager and HR.</li>
      <li><strong>How do I raise a query?</strong> Use the “Contact HR” button below to reach out to HR.</li>
    </ul>

    <div class="contact">
      <p>Need help or have questions?</p>
      <button onclick="contactHR()">Contact HR</button>
    </div>

    <div class="back-link">
      <a href="../dashboard/employee_dashboard_form.php">← Back to Dashboard</a>
    </div>
  </div>

  <script>
    function contactHR() {
      alert("If no email client opens, please email jatinsharma13488@gmail.com manually.");
      window.location.href = "mailto:hr@company.com";
    }
  </script>
</body>
</html>
