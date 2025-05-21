<script src="https://cdn.tailwindcss.com"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .card, .chart-container, .summary-card {
        background-color: white;
        border-radius: 0.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
        padding: 1.5rem;
        margin-bottom: 2rem;
    }

    .dashboard-table { /* Unified class for all tables */
        width: 100%;
        border-collapse: collapse;
        border-radius: 0.5rem;
    }

    .dashboard-table thead th {
        padding: 1rem;
        text-align: left;
        border-bottom: 1px solid #E5E7EB;
        color: #4B5563;
        font-weight: 600;
    }

    .dashboard-table tbody td {
        padding: 1rem;
        border-bottom: 1px solid #F3F4F6;
    }

    .dashboard-table tbody tr:last-child td {
        border-bottom: none;
    }

    .status {
        border-radius: 9999px;
        padding: 0.25rem 0.75rem;
        font-size: 0.875rem;
        font-weight: 500;
    }

    .status-approved {
        background-color: #D1FAE5;
        color: #065F46;
    }

    .status-pending {
        background-color: #FEE2E2;
        color: #991B1B;
    }

    .status-rejected {
        background-color: #FFFBEB;
        color: #78350F;
    }

    /* New status styles for 'paid' and 'delivery' */
    .status-paid {
        background-color: #D1FAE5; /* Greenish */
        color: #065F46;
    }
    .status-delivery {
        background-color: #BFDBFE; /* Bluish */
        color: #1E40AF;
    }


    .box {
        background-color: #9b806e;
        padding: 20px;
        width: 200px;
        border-radius: 0.5rem;
    }

    @media (max-width: 600px) {
        .box {
            padding: 5px;
        }
    }
</style>

<?php
include("dbconi.php"); // Make sure this path is correct for your database connection

// Check if connection was successful
if (!$dbc) {
    die("Connection failed: " . mysqli_connect_error());
}

// --- Get Total Products ---
$total_products_query = "SELECT COUNT(*) as total_bikes FROM bikes";
$total_products_result = mysqli_query($dbc, $total_products_query);
$total_products_row = mysqli_fetch_assoc($total_products_result);
$total_items = $total_products_row['total_bikes'];

// --- Get Total Accounts ---
$total_accounts_query = "SELECT COUNT(*) as total_users FROM users";
$total_accounts_result = mysqli_query($dbc, $total_accounts_query);
$total_accounts_row = mysqli_fetch_assoc($total_accounts_result);
$total_accs = $total_accounts_row['total_users'];

// --- Get Total Transactions (all statuses) ---
$total_transaction_query = "SELECT COUNT(*) as total_pay FROM payments";
$total_transaction_result = mysqli_query($dbc, $total_transaction_query);
$total_transaction_row = mysqli_fetch_assoc($total_transaction_result);
$total_trans = $total_transaction_row['total_pay'];

// --- Get Total Paid Orders (assuming 'status' column contains 'paid') ---
$paid_orders_query = "SELECT COUNT(*) as total_orders FROM payments WHERE status = 'paid'";
$paid_orders_result = mysqli_query($dbc, $paid_orders_query);
$paid_orders_row = mysqli_fetch_assoc($paid_orders_result);
$total_orders = $paid_orders_row['total_orders'];

// --- Get Total Deliveries (assuming 'status' column contains 'delivery') ---
$paid_deliveries_query = "SELECT COUNT(*) as total_deliveries FROM payments WHERE status = 'delivery'";
$paid_deliveries_result = mysqli_query($dbc, $paid_deliveries_query);
$paid_deliveries_row = mysqli_fetch_assoc($paid_deliveries_result);
$total_deliveries = $paid_deliveries_row['total_deliveries'];

// --- Get Recent Combined Transactions (Delivery and Paid) ---
$recent_transactions_query = "
    SELECT id, fullname, time, status, price
    FROM payments
    WHERE status IN ('delivery', 'paid')
    ORDER BY time DESC
    LIMIT 7";

$recent_transactions_result = mysqli_query($dbc, $recent_transactions_query);
$recent_transactions = [];
if ($recent_transactions_result) {
    while ($row = mysqli_fetch_assoc($recent_transactions_result)) {
        $recent_transactions[] = $row;
    }
} else {
    echo "Error fetching recent transactions: " . mysqli_error($dbc);
}

// Define an array of colors for days of the week (Monday to Sunday)
$day_colors = [
    1 => 'rgba(255, 99, 132, 0.6)', // Monday (Red-ish)
    2 => 'rgba(54, 162, 235, 0.6)', // Tuesday (Blue-ish)
    3 => 'rgba(255, 206, 86, 0.6)', // Wednesday (Yellow-ish)
    4 => 'rgba(75, 192, 192, 0.6)', // Thursday (Teal-ish)
    5 => 'rgba(153, 102, 255, 0.6)',// Friday (Purple-ish)
    6 => 'rgba(255, 159, 64, 0.6)', // Saturday (Orange-ish)
    7 => 'rgba(199, 199, 199, 0.6)' // Sunday (Gray-ish)
];

$day_border_colors = [
    1 => 'rgba(255, 99, 132, 1)',
    2 => 'rgba(54, 162, 235, 1)',
    3 => 'rgba(255, 206, 86, 1)',
    4 => 'rgba(75, 192, 192, 1)',
    5 => 'rgba(153, 102, 255, 1)',
    6 => 'rgba(255, 159, 64, 1)',
    7 => 'rgba(199, 199, 199, 1)'
];


// --- Dates for current and previous 7-day periods ---
$today_date = date('Y-m-d');
$date_7_days_ago = date('Y-m-d', strtotime('-6 days')); // Current 7 days: [6 days ago, ..., today]
$date_14_days_ago = date('Y-m-d', strtotime('-13 days')); // Previous 7 days: [13 days ago, ..., 7 days ago]


// --- Sales Data for Chart (Daily Total Sales with status 'paid' for last 7 days) ---
$sales_chart_query = "
    SELECT DATE(time) as sale_date, SUM(price) as total_sales
    FROM payments
    WHERE status = 'paid'
    AND DATE(time) >= '$date_7_days_ago'
    AND DATE(time) <= '$today_date'
    GROUP BY sale_date
    ORDER BY sale_date ASC";

$sales_chart_result = mysqli_query($dbc, $sales_chart_query);
$sales_labels = [];
$sales_data = [];
$sales_background_colors = [];
$sales_border_colors = [];
if ($sales_chart_result) {
    while ($row = mysqli_fetch_assoc($sales_chart_result)) {
        $sales_labels[] = $row['sale_date'];
        $sales_data[] = (float)$row['total_sales'];
        $day_of_week = date('N', strtotime($row['sale_date'])); // 1 (for Monday) through 7 (for Sunday)
        $sales_background_colors[] = $day_colors[$day_of_week] ?? 'rgba(0, 0, 0, 0.6)'; // Fallback color
        $sales_border_colors[] = $day_border_colors[$day_of_week] ?? 'rgba(0, 0, 0, 1)'; // Fallback color
    }
} else {
    echo "Error fetching sales data for chart: " . mysqli_error($dbc);
}

// --- Delivery Data for Chart (Daily Total Deliveries with status 'delivery' for last 7 days) ---
$delivery_chart_query = "
    SELECT DATE(time) as delivery_date, COUNT(*) as total_deliveries
    FROM payments
    WHERE status = 'delivery'
    AND DATE(time) >= '$date_7_days_ago'
    AND DATE(time) <= '$today_date'
    GROUP BY delivery_date
    ORDER BY delivery_date ASC";

$delivery_chart_result = mysqli_query($dbc, $delivery_chart_query);
$delivery_labels = [];
$delivery_data = [];
$delivery_background_colors = [];
$delivery_border_colors = [];
if ($delivery_chart_result) {
    while ($row = mysqli_fetch_assoc($delivery_chart_result)) {
        $delivery_labels[] = $row['delivery_date'];
        $delivery_data[] = (int)$row['total_deliveries'];
        $day_of_week = date('N', strtotime($row['delivery_date'])); // 1 (for Monday) through 7 (for Sunday)
        $delivery_background_colors[] = $day_colors[$day_of_week] ?? 'rgba(0, 0, 0, 0.6)'; // Fallback color
        $delivery_border_colors[] = $day_border_colors[$day_of_week] ?? 'rgba(0, 0, 0, 1)'; // Fallback color
    }
} else {
    echo "Error fetching delivery data for chart: " . mysqli_error($dbc);
}

// --- Calculate Total Sales for the CURRENT last 7 days (status 'paid') ---
$current_7_days_sales_query = "
    SELECT SUM(price) as current_period_sales
    FROM payments
    WHERE status = 'paid'
    AND DATE(time) >= '$date_7_days_ago'
    AND DATE(time) <= '$today_date'";

$current_7_days_sales_result = mysqli_query($dbc, $current_7_days_sales_query);
$current_7_days_sales_row = mysqli_fetch_assoc($current_7_days_sales_result);

// FIX FOR LINE 91: Using ternary operator for PHP 5.x compatibility
$overall_total_sales_7_days = isset($current_7_days_sales_row['current_period_sales']) ? $current_7_days_sales_row['current_period_sales'] : 0;


// --- Calculate Total Sales for the PREVIOUS 7 days (status 'paid') ---
$previous_7_days_sales_query = "
    SELECT SUM(price) as previous_period_sales
    FROM payments
    WHERE status = 'paid'
    AND DATE(time) >= '$date_14_days_ago'
    AND DATE(time) < '$date_7_days_ago'"; // Note '<' to exclude the start of the current period

$previous_7_days_sales_result = mysqli_query($dbc, $previous_7_days_sales_query);
$previous_7_days_sales_row = mysqli_fetch_assoc($previous_7_days_sales_result);
$overall_total_sales_previous_7_days = isset($previous_7_days_sales_row['previous_period_sales']) ? $previous_7_days_sales_row['previous_period_sales'] : 0;

// --- Calculate Percentage Change for Sales ---
$percentage_change_sales = 0;
$percentage_sign_sales = '';
$percentage_color_class_sales = 'text-gray-500'; // Default to grey

if ($overall_total_sales_previous_7_days > 0) {
    $percentage_change_sales = (($overall_total_sales_7_days - $overall_total_sales_previous_7_days) / $overall_total_sales_previous_7_days) * 100;
} elseif ($overall_total_sales_7_days > 0) {
    // If previous sales were 0 but current sales are > 0, it's a significant increase
    $percentage_change_sales = 100; // Represent as +100%
}

if ($percentage_change_sales > 0) {
    $percentage_sign_sales = '+';
    $percentage_color_class_sales = 'text-green-500';
} elseif ($percentage_change_sales < 0) {
    $percentage_sign_sales = ''; // Sign is inherent in number format for negative
    $percentage_color_class_sales = 'text-red-500';
}
// If 0, it remains grey, and no sign is needed for 0.00%


// --- Get Priciest Items (Top 4) ---
$priciest_items_query = "
    SELECT model, price
    FROM bikes
    ORDER BY price DESC
    LIMIT 4";

$priciest_items_result = mysqli_query($dbc, $priciest_items_query);
$priciest_items = [];
if ($priciest_items_result) {
    while ($row = mysqli_fetch_assoc($priciest_items_result)) {
        $priciest_items[] = $row;
    }
} else {
    echo "Error fetching priciest items: " . mysqli_error($dbc);
}

// --- Get New Arrival Items (max 3) ---
// This query assumes 'id' in 'bikes' table is auto-incrementing and thus reflects insertion order.
// If you have a 'date_added' column, it would be more accurate to use that: ORDER BY date_added DESC
$new_arrival_items_query = "
    SELECT model, price
    FROM bikes
    ORDER BY id DESC
    LIMIT 3";

$new_arrival_items_result = mysqli_query($dbc, $new_arrival_items_query);
$new_arrival_items = [];
if ($new_arrival_items_result) {
    while ($row = mysqli_fetch_assoc($new_arrival_items_result)) {
        $new_arrival_items[] = $row;
    }
} else {
    echo "Error fetching new arrival items: " . mysqli_error($dbc);
}

mysqli_close($dbc); // Close the database connection after all queries
?>

<div class="py-6 text-center">
    <h1 class="text-3xl font-bold text-gray-800">Admin Dashboard</h1>
</div>

<div class="max-w-7xl mx-auto px-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    <div class="card">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Sales Report (Last 7 Days)</h2>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-800">$<?php echo number_format($overall_total_sales_7_days, 2); ?></div>
                <div class="text-sm text-gray-500">Total Sales</div>
            </div>
            <div class="<?php echo $percentage_color_class_sales; ?> font-semibold">
                <?php echo $percentage_sign_sales . number_format($percentage_change_sales, 2); ?>%
            </div>
        </div>
    </div>

    <div class="card">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Delivery Tracking</h2>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-800"><?php echo $total_deliveries; ?></div>
                <div class="text-sm text-gray-500">Total New Deliveries</div>
            </div>
            <div class="text-green-500 font-semibold">+15%</div> </div>
    </div>

    <div class="card">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Order Tracking</h2>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-800"><?php echo $total_orders; ?></div>
                <div class="text-sm text-gray-500">Total New Orders</div>
            </div>
            <div class="text-green-500 font-semibold">+15%</div> </div>
    </div>

    <div class="card">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Inventory Tracking</h2>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-800"><?php echo $total_items; ?></div>
                <div class="text-sm text-gray-500">Total Products</div>
            </div>
            <div class="text-green-500 font-semibold">+15%</div> </div>
    </div>

    <div class="card">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Account Tracking</h2>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-800"><?php echo $total_accs; ?></div>
                <div class="text-sm text-gray-500">Total Accounts</div>
            </div>
            <div class="text-green-500 font-semibold">+15%</div> </div>
    </div>

    <div class="card">
        <h2 class="text-lg font-semibold text-gray-700 mb-2">Transaction Report</h2>
        <div class="flex items-center justify-between">
            <div>
                <div class="text-2xl font-bold text-gray-800"><?php echo $total_trans; ?></div>
                <div class="text-sm text-gray-500">Total Transactions</div>
            </div>
            <div class="text-green-500 font-semibold">+10%</div> </div>
    </div>

    <div class="col-span-full grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="card">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Sales Tracking (Daily Paid Transactions - Last 7 Days)</h2>
            <div class="chart-container h-[300px]">
                <canvas id="salesChart"></canvas>
            </div>
        </div>

        <div class="card">
            <h2 class="text-lg font-semibold text-gray-700 mb-2">Delivery Tracking (Daily Deliveries - Last 7 Days)</h2>
            <div class="chart-container h-[300px]">
                <canvas id="deliveryChart"></canvas>
            </div>
        </div>
    </div>

    <div class="card col-span-full">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Recent Transactions</h2>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>TRACKING NO.</th>
                        <th>SUPPLIER / CUSTOMER</th>
                        <th>TIME</th>
                        <th>STATUS</th>
                        <th>TOTAL AMOUNT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($recent_transactions)): ?>
                        <?php foreach ($recent_transactions as $transaction): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($transaction['id']); ?></td>
                                <td><?php echo htmlspecialchars($transaction['fullname']); ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d H:i', strtotime($transaction['time']))); ?></td>
                                <td>
                                    <?php
                                        $statusClass = '';
                                        switch (strtolower($transaction['status'])) {
                                            case 'paid':
                                                $statusClass = 'status-paid';
                                                break;
                                            case 'delivery':
                                                $statusClass = 'status-delivery';
                                                break;
                                            case 'approved':
                                                $statusClass = 'status-approved';
                                                break;
                                            case 'pending':
                                                $statusClass = 'status-pending';
                                                break;
                                            case 'rejected':
                                                $statusClass = 'status-rejected';
                                                break;
                                            default:
                                                $statusClass = '';
                                        }
                                    ?>
                                    <span class="status <?php echo $statusClass; ?>">
                                        <?php echo htmlspecialchars(ucfirst($transaction['status'])); ?>
                                    </span>
                                </td>
                                <td>$<?php echo number_format($transaction['price'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-gray-500">No recent transactions found with status 'delivery' or 'paid'.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card col-span-full md:col-span-1">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Best Seller Items</h2>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ITEM NAME</th>
                        <th>PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($priciest_items)): ?>
                        <?php foreach ($priciest_items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['model']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">No best seller items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card col-span-full md:col-span-1">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">New Arrival Items</h2>
        <div class="overflow-x-auto">
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ITEM NAME</th>
                        <th>PRICE</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($new_arrival_items)): ?>
                        <?php foreach ($new_arrival_items as $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['model']); ?></td>
                                <td>$<?php echo number_format($item['price'], 2); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">No new arrival items found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card col-span-full md:col-span-1">
        <h2 class="text-lg font-semibold text-gray-700 mb-4">Upcoming Tasks & Reminders</h2>
        <ul class="text-gray-700 space-y-2">
            <li class="flex justify-between items-center border-b pb-2 last:border-b-0">
                <div>
                    <span class="font-medium">Review Q2 Financials</span>
                    <p class="text-sm text-gray-500">Due: May 30, 2025</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    High Priority
                </span>
            </li>
            <li class="flex justify-between items-center border-b pb-2 last:border-b-0">
                <div>
                    <span class="font-medium">Update Product Catalog</span>
                    <p class="text-sm text-gray-500">Due: June 15, 2025</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                    Medium Priority
                </span>
            </li>
            <li class="flex justify-between items-center border-b pb-2 last:border-b-0">
                <div>
                    <span class="font-medium">Schedule Team Meeting</span>
                    <p class="text-sm text-gray-500">By: May 24, 2025</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                    Low Priority
                </span>
            </li>
            <li class="flex justify-between items-center">
                <div>
                    <span class="font-medium">Annual Server Maintenance</span>
                    <p class="text-sm text-gray-500">Date: July 1, 2025</p>
                </div>
                <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                    High Priority
                </span>
            </li>
        </ul>
    </div>
</div>

<script>
    // PHP variables to JavaScript
    const salesLabels = <?php echo json_encode($sales_labels); ?>;
    const salesData = <?php echo json_encode($sales_data); ?>;
    const salesBackgroundColors = <?php echo json_encode($sales_background_colors); ?>;
    const salesBorderColors = <?php echo json_encode($sales_border_colors); ?>;

    const deliveryLabels = <?php echo json_encode($delivery_labels); ?>;
    const deliveryData = <?php echo json_encode($delivery_data); ?>;
    const deliveryBackgroundColors = <?php echo json_encode($delivery_background_colors); ?>;
    const deliveryBorderColors = <?php echo json_encode($delivery_border_colors); ?>;

    // Sales Chart
    const salesCtx = document.getElementById('salesChart').getContext('2d');
    new Chart(salesCtx, {
        type: 'bar', // Bar chart for sales
        data: {
            labels: salesLabels,
            datasets: [{
                label: 'Daily Sales (Paid)',
                data: salesData,
                backgroundColor: salesBackgroundColors, // Use dynamic colors
                borderColor: salesBorderColors, // Use dynamic border colors
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Total Sales Amount ($)'
                    }
                }
            }
        }
    });

    // Delivery Chart - Bar Graph with dynamic colors
    const deliveryCtx = document.getElementById('deliveryChart').getContext('2d');
    new Chart(deliveryCtx, {
        type: 'bar', // Bar graph
        data: {
            labels: deliveryLabels,
            datasets: [{
                label: 'Daily Deliveries',
                data: deliveryData,
                backgroundColor: deliveryBackgroundColors, // Use dynamic colors
                borderColor: deliveryBorderColors, // Use dynamic border colors
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top'
                }
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Date'
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Number of Deliveries'
                    },
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
</script>