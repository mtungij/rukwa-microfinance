<?php include(APPPATH .'/views/admin/incs/header.php'); ?>
<?php include(APPPATH . './views/admin/incs/nav.php'); ?>
<?php include(APPPATH . './views/admin/incs/side.php'); ?>





<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
<nav class="navbar navbar-inverse container" role="navigation">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Aplication</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Username <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li align="center" class="well">
                            <div><img class="img-responsive" style="padding:2%;" src="https://bootdey.com/img/Content/avatar/avatar1.png" /><a class="change" href="">Change Picture</a></div>
                            <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-lock"></span> Security</a>
                            <a href="#" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>

<div class="container bootstrap snippets bootdey">
    <div class="row well">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked well">
                <li class="active"><a href="#"><i class="fa fa-envelope"></i> Compose</a></li>
                <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
                <li><a href="#"><i class="fa fa-user"></i> Profile</a></li>
                <li><a href="#"><i class="fa fa-key"></i> Security</a></li>
                <li><a href="#"><i class="fa fa-sign-out"></i> Logout</a></li>
            </ul>
        </div>
        <div class="col-md-10">
            <div class="panel">
                <img class="pic img-circle" src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="...">
                <div class="name"><small>User full name</small></div>
                <a href="#" class="btn btn-xs btn-primary pull-right" style="margin:10px;"><span class="glyphicon glyphicon-picture"></span> Change cover</a>
            </div>

            <br>
            <br>
            <br>
            <ul class="nav nav-tabs" id="myTab">
                <li class="active"><a href="#inbox" data-toggle="tab"><i class="fa fa-envelope-o"></i> Inbox</a></li>
                <li><a href="#sent" data-toggle="tab"><i class="fa fa-reply-all"></i> Sent</a></li>
                <li><a href="#assignment" data-toggle="tab"><i class="fa fa-file-text-o"></i> Assignment</a></li>
                <li><a href="#event" data-toggle="tab"><i class="fa fa-clock-o"></i> Event</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="inbox">
                    <a type="button" data-toggle="collapse" data-target="#a1">
                        <div class="btn-toolbar well well-sm" role="toolbar" style="margin:0px;">
                            <div class="btn-group">
                                <input type="checkbox">
                            </div>
                            <div class="btn-group col-md-3">Admin Kumar</div>
                            <div class="btn-group col-md-8"><b>Hi Check this new Bootstrap plugin</b>
                                <div class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:10 PM
                                    <button class="btn btn-primary btn-xs" data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-share-square-o"> Reply</i></button>
                                </div>
                            </div>
                        </div>
                    </a>
                    <div id="a1" class="collapse out well">This is the message body1</div>
                    <br>
                    <button class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
                </div>

                <div class="tab-pane" id="sent">
                    <a type="button" data-toggle="collapse" data-target="#s1">
                        <div class="btn-toolbar well well-sm" role="toolbar" style="margin:0px;">
                            <div class="btn-group">
                                <input type="checkbox">
                            </div>
                            <div class="btn-group col-md-3">Kumar</div>
                            <div class="btn-group col-md-8"><b>This is reply from Bootstrap plugin</b>
                                <div class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:30 AM</div>
                            </div>
                        </div>
                    </a>
                    <div id="s1" class="collapse out well">This is the message body1</div>
                    <br>
                    <button class="btn btn-primary btn-xs"><i class="fa fa-check-square-o"></i> Delete Checked Item's</button>
                </div>

                <div class="tab-pane" id="assignment">
                    <a href="">
                        <div class="well well-sm" style="margin:0px;">Open GL Assignments <span class="pull-right"><i class="glyphicon glyphicon-time"></i> 12:20 AM 20 Dec 2014 </span></div>
                    </a>
                </div>

                <div class="tab-pane" id="event">
                    <div class="media">
                        <a class="pull-left" href="#">
                            <img class="media-object img-thumbnail" width="100" src="https://www.bootdey.com/image/200x200" alt="...">
                        </a>
                        <div class="media-body">
                            <h4 class="media-heading">Animation Workshop</h4> 2Days animation workshop to be conducted
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

</div>

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <br/>
            <br/>
            <form class="form-horizontal">
                <fieldset>
                    <!-- Text input-->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="body">Body :</label>
                        <div class="col-md-8">
                            <input id="body" name="body" type="text" placeholder="Message Body" class="form-control input-md">

                        </div>
                    </div>

                    <!-- Textarea -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="message">Message :</label>
                        <div class="col-md-8">
                            <textarea class="form-control" id="message" name="message"></textarea>
                        </div>
                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="send"></label>
                        <div class="col-md-8">
                            <button id="send" name="send" class="btn btn-primary">Send</button>
                        </div>
                    </div>

                </fieldset>
            </form>

        </div>
    </div>
</div>

<div id="main-content" class="profilepage_2 blog-page">
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