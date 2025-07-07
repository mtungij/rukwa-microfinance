<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <title><?= htmlspecialchars($comp_data->comp_name) ?> - Loan Statement Report</title>
    <style>
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 6px 8px;
            text-align: left;
        }
        th {
            background-color: #00bcd4;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .total-row {
            background-color: #ddd;
            font-weight: bold;
        }
        .company-header {
            text-align: center;
            margin-top: 20px;
        }
        .company-header img {
            max-height: 80px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
<?php 
$company_name = "EVAMO FINANCIAL SERVICES LIMITED";
$company_email = "evamofinanace@gmail.com";
$company_phone = "+255 764 626 888";
$logo_path = FCPATH . 'assets/img/cdclogo.png';
$logo_url = 'file://' . $logo_path;


?>
    <!-- Company Header -->
    <div class="company-header">
    <div style="text-align: center;">
    <img src="<?= $logo_url ?>" alt="Company Logo" style="max-height: 100px; width: auto;" />
</div>

        <h2><?= htmlspecialchars($company_name) ?></h2>
    
        <p>Email: <?= htmlspecialchars($company_email) ?> | Phone: <?= htmlspecialchars($company_phone) ?></p>
    </div>

    <!-- Report Title -->
    <h3 style="text-align: center; margin-top: 30px;">LOAN STATEMENT REPORT</h3>

    <!-- Table -->
    <table>
    <thead>
        <tr>

            <th>S/No</th>
            <th>Jina La Mteja</th>
            <th>Afisa</th>
            <th>Namba Ya Simu</th>
            <th>Principal</th>
            <th>Riba</th>
            <th>Mkopo+Riba</th>
            <th>Rejesho</th>
            <th>Muda Wa Mkopo</th>
            <th>Lipwa</th>
            <th>Deni</th>
            <th>Faini lipwa</th>
            <th>Status</th>
            <th>Withdraw Date</th>
            <th>End Date</th>
        </tr>
    </thead>
    <tbody>
  <?php
    $no = 1;
    ?>
   
        <?php foreach ($loan_collection as $item): ?>
                    
            <tr>
                <td><?= $no++ ?>.</td>
                <td><?= strtoupper(htmlspecialchars($item->f_name ." ". $item->m_name ." ". $item->l_name)) ?></td>
                <td><?= strtoupper(htmlspecialchars($item->empl_name)) ?></td>
                <td>
                    <?php 
                        $phone = $item->phone_no;
                        if (strpos($phone, '255') === 0) {
                            $phone = '0' . substr($phone, 3);
                        }
                        echo htmlspecialchars($phone);
                    ?>
                </td>
                <td><?= number_format($item->loan_aprove) ?></td>
                <td><?= htmlspecialchars($item->loan_int - $item->loan_aprove) ?></td>
                 <td><?= htmlspecialchars($item->loan_int) ?></td>
                   <td><?= number_format($item->restration) ?></td>
                <td>
                    <?php 
                        if ($item->day == '1') {
                            $frequency = "Siku";
                        } elseif ($item->day == '7') {
                            $frequency = "Wiki";
                        } elseif (in_array($item->day, ['28','29','30','31'])) {
                            $frequency = "Mwezi";
                        } else {
                            $frequency = "Other";
                        }
                        echo $frequency . " (" . htmlspecialchars($item->session) . ")";
                    ?>
                </td>
              
                <td><?= number_format($item->total_depost) ?></td>
                <td><?= number_format($item->loan_int - ($item->total_depost + $item->total_double)) ?></td>
                <td><?= number_format($item->penart_paid) ?></td>
                <?php
                    $status = '';
                    switch ($item->loan_status) {
                        case 'open':
                            $status = '<span class="badge badge-warning">Pending</span>';
                            break;
                        case 'aproved':
                            $status = '<span class="badge badge-info">Approved</span>';
                            break;
                        case 'withdrawal':
                            $status = '<span class="badge badge-primary">Active</span>';
                            break;
                        case 'done':
                            $status = '<span class="badge badge-success">Done</span>';
                            break;
                        case 'out':
                            $status = '<span class="badge badge-danger">Default</span>';
                            break;
                        case 'disbarsed':
                            $status = '<span class="badge badge-secondary">Disbursed</span>';
                            break;
                        default:
                            $status = '<span class="badge badge-secondary">Unknown</span>';
                    }
                ?>
                <td><?= $status ?></td>
                <td><?= htmlspecialchars($item->loan_stat_date) ?></td>
                <td><?= htmlspecialchars(substr($item->loan_end_date, 0, 10)) ?></td>
            </tr>
        <?php endforeach; ?>
        <!-- Totals Row -->
        <tr class="total-row">
            <td colspan="4"><b>JUMLA</b></td>           
            <td><b><?= number_format(array_sum(array_column($loan_collection, 'loan_aprove'))) ?></b></td>
            <!-- <td><b></?= htmlspecialchars($item->loan_name) ?></b></td> -->
            <td><b></b></td>
            <td><b><?= number_format(array_sum(array_column($loan_collection, 'restration'))) ?></b></td>
            <td><b><?= number_format(array_sum(array_column($loan_collection, 'total_depost'))) ?></b></td>
            <td><b><?= number_format(array_sum(array_column($loan_collection, 'loan_int')) - (array_sum(array_column($loan_collection, 'total_depost')) + array_sum(array_column($loan_collection, 'total_double')))) ?></b></td>
            <td><b><?= number_format(array_sum(array_column($loan_collection, 'penart_paid'))) ?></b></td>
            <td><b></b></td>
            <td><b></b></td>
            <td><b></b></td>
        </tr>
    </tbody>
</table>

<br><br>

<!-- ✅ Depositor Summary Section -->
<?php if (!empty($lazo['details'])): ?>
    <h3>MHUTASARI WA MALIPO</h3>
    <table border="1" cellpadding="6" cellspacing="0">
        <thead>
            <tr>
                <th>S/No</th>
                <th>DEPOSITOR</th>
                <th>Jumla ya Deposit (TSh)</th>
            </tr>
        </thead>
        <tbody>
            <?php
                $depositor_summary = [];

                foreach ($lazo['details'] as $item) {
                    $username = $item->depositor_username ?? '';

                    if (!empty($username)) {
                        if (!isset($depositor_summary[$username])) {
                            $depositor_summary[$username] = 0;
                        }
                        $depositor_summary[$username] += $item->depost;
                    }
                }

                if (!empty($depositor_summary)):
                    $sn = 1;
                    foreach ($depositor_summary as $username => $sum_depost):
            ?>
                <tr>
                    <td><b><?= $sn++ ?>.</b></td>
                    <td><b><?= htmlspecialchars(strtoupper($username)) ?></b></td>
                    <td><b><?= number_format($sum_depost) ?></b></td>
                </tr>
            <?php endforeach; else: ?>
                <tr>
                    <td colspan="3" style="text-align: center;">Hakuna walio deposit leo.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<?php endif; ?>

    
</body>
</html>
