<?php include('incs/header.php'); ?>
<?php include('incs/nav.php'); ?>
<?php include('incs/side.php'); ?>


<section class="section about-section  gray-bg" id="about">
    <div class="container ">
        <div class="row align-items-center  flex-row-reverse">
            <div class="col-lg-6">
                <div class="about-text go-to">

                    <div class="row about-list">
                        <div class="col-md-6">
                            <div class="media">
                                <label>Birthday</label>
                                <p>4th april 1998</p>
                            </div>
                            <div class="media">
                                <label>Age</label>
                                <p>22 Yr</p>
                            </div>
                            <div class="media">
                                <label>Residence</label>
                                <p>Canada</p>
                            </div>
                            <div class="media">
                                <label>Address</label>
                                <p>California, USA</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="media">
                                <label>E-mail</label>
                                <p>info@domain.com</p>
                            </div>
                            <div class="media">
                                <label>Phone</label>
                                <p>820-885-3321</p>
                            </div>
                            <div class="media">
                                <label>Skype</label>
                                <p>skype.0404</p>
                            </div>
                            <div class="media">
                                <label>Freelance</label>
                                <p>Available</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="about-avatar">
                    <img src="https://bootdey.com/img/Content/avatar/avatar7.png" title="" alt="">
                </div>
            </div>
        </div>

</section>



<div id="main-content" class="m-0">
    <div class="pull-right pr-4 pb-2">


    <a href="<?php echo base_url('Oficer/customer_schedule/' . $loan->customer_id . '/' . $loan->loan_id); ?>" class="btn btn-primary" target="_blank">
    <i class="icon-printer"></i> Print Schedule
</a>


    </div>
    <div class="container-fluid">
        <table class="table">
            <thead class="thead-primary">
            <tr>
                <th scope="col">S/no</th>
                <th scope="col">#</th>
                <th scope="col">Date</th>
                <th scope="col">Collection</th>
                <th scope="col">collected</th>
            </tr>
            </thead>
            <tbody>
            <?php $total = 0 ?>
            <?php $j = 0 ;?>
            <?php $start_date = new DateTime($loan->loan_stat_date) ?>

            <?php if($loan->day == 30): ?>
                <?php for($i=29; $i <= $total_days; $i += (int) $loan->day): ?>
                    <?php $loan_start_date = clone $start_date; ?>
                    <?php $total += $loan->restration ?>
                    <tr>
                        <th scope="row"><?= ++$j ?> </th>
                        <th scope="row"><?= $i ?> </th>
                        <td><?= $loan_start_date->modify("+$i days")->format('d-m-Y') ?></td>
                        <td><?= number_format($loan->restration ?? 0) ?></td>
                        <td></td>
                    </tr>
                <?php endfor ?>

            <?php elseif($loan->day == 7): ?>
                <?php for($i=6; $i <= $total_days; $i += (int) $loan->day): ?>
                    <?php $loan_start_date = clone $start_date; ?>
                    <?php $total += $loan->restration ?>
                    <tr>
                        <th scope="row"><?= ++$j ?> </th>
                        <th scope="row"><?= $i ?> </th>
                        <td><?= $loan_start_date->modify("+$i days")->format('d-m-Y') ?></td>
                        <td><?= number_format($loan->restration ?? 0) ?></td>
                        <td></td>
                    </tr>
                <?php endfor ?>

            <?php else: ?>
                <?php for($i=1; $i <= $total_days; $i += (int) $loan->day): ?>
                    <?php $loan_start_date = clone $start_date; ?>
                    <?php $total += $loan->restration ?>
                    <tr>
                        <th scope="row"><?= ++$j ?> </th>
                        <th scope="row"><?= $i ?> </th>
                        <td><?= $loan_start_date->modify("+$i days")->format('d-m-Y') ?></td>
                        <td><?= number_format($loan->restration ?? 0) ?></td>
                        <td></td>
                    </tr>
                <?php endfor ?>

            <?php endif ?>


            </tbody>
            <tfoot>
            <th>TOTAL</th>
            <td></td>
            <th><?= number_format($total) ?></td>
            </tfoot>
        </table>
    </div>
</div>

<!-- <script>
    window.onload = () => {
        print()
    }
</script> -->
<?php include('incs/footer.php'); ?>
