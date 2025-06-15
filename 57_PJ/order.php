<?php
session_start();
include 'conn.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login.php");
    exit;
}

// Fetch order data with customer username
$query = "SELECT o.*, customer_id 
          FROM orders o 
          JOIN users u ON o.customer_id = user_id 
          ORDER BY o.order_date DESC";
$result = mysqli_query($connection, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <title>Order Management</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: linear-gradient(135deg, #0c3567, #fefeff);
      color: #fff;
      padding: 40px 20px;
      min-height: 100vh;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.05);
      border-radius: 12px;
      padding: 20px;
      backdrop-filter: blur(6px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
    }

    h3 {
      text-align: center;
      margin-bottom: 25px;
    }

    table {
      color: #fff;
    }

    th {
      background-color: #1f2937;
      color: #facc15;
    }

    .table-striped tbody tr:nth-of-type(odd) {
      background-color: rgba(255, 255, 255, 0.03);
    }

    .badge {
      font-size: 0.8rem;
      padding: 5px 10px;
    }

    .badge-success {
      background-color: #28a745;
    }

    .badge-warning {
      background-color: #ffc107;
      color: #000;
    }

    .badge-danger {
      background-color: #dc3545;
    }

    .badge-info {
      background-color: #17a2b8;
    }
  </style>
</head>
<body>
  <?php include 'header.php'; ?>

  <div class="container mt-5">
    <h3>📦 Order Management</h3>
    <div class="card">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th>#</th>
              <th>Customer</th>
              <th>Order Date</th>
              <th>Total</th>
              <th>Payment</th>
              <th>Shipping Address</th>
              <th>Status</th>
              <th>Payment Status</th>
            </tr>
          </thead>
          <tbody>
            <?php if (mysqli_num_rows($result) > 0): 
              $count = 1;
              while ($row = mysqli_fetch_assoc($result)):
                $orderStatusClass = match($row['order_status']) {
                  'pending' => 'badge-warning',
                  'completed' => 'badge-success',
                  'cancelled' => 'badge-danger',
                  default => 'badge-info'
                };

                $paymentStatusClass = $row['payment_status'] === 'paid' ? 'badge-success' : 'badge-warning';
            ?>
            <tr>
              <td><?= $count++; ?></td>
              <td><?= htmlspecialchars($row['username']) ?></td>
              <td><?= $row['order_date'] ?></td>
              <td>$<?= number_format($row['total_amount'], 2) ?></td>
              <td><?= htmlspecialchars($row['payment_method']) ?></td>
              <td><?= htmlspecialchars($row['shipping_address']) ?></td>
              <td><span class="badge <?= $orderStatusClass ?>"><?= ucfirst($row['order_status']) ?></span></td>
              <td><span class="badge <?= $paymentStatusClass ?>"><?= ucfirst($row['payment_status']) ?></span></td>
            </tr>
            <?php endwhile; else: ?>
            <tr>
              <td colspan="8" class="text-center">No orders found.</td>
            </tr>
            <?php endif; ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
