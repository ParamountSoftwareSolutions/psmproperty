<script src="<?php echo url('application/modules/accounts/assets/js/general_ledger_report_script.js'); ?>" type="text/javascript"></script>

@extends((new App\Helpers\Helpers)->user_login_route()['file'].'.layout.app')
@section('title', 'Leads')
@section('style')

@endsection
@section('content')
<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12 col-md-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>
                                            <?php echo App\Helpers\Helpers::display('general_ledger'); ?>
                                        </h4>
                                    </div>
                                </div>
                                <div id="printArea">
                                    <table width="99%" align="center" class="general_ledger_report_tble" cellpadding="5" cellspacing="5" border="2">

                                        <thead>
                                            <tr align="center">

                                                <td colspan="7">
                                                    <font size="+1" class="general_ledger_report_fontfamily"> <strong><?php echo App\Helpers\Helpers::display('general_ledger_of') . ' ' . $data['ledger']->HeadName . ' on ' . $dtpFromDate . ' To '  . $dtpToDate; ?></strong></font><strong></th></strong>
                                            </tr>

                                            <tr>
                                                <td height="25"><strong><?php echo App\Helpers\Helpers::display('sl'); ?></strong></td>
                                                <td><strong><?php echo "Head Code"; ?></strong></td>
                                                <td><strong><?php echo "Head Name"; ?></strong></td>
                                                <?php
                                                if ($chkIsTransction) {
                                                ?>
                                                    <td><strong><?php echo App\Helpers\Helpers::display('particulars') ?></strong></td>
                                                <?php
                                                }
                                                ?>
                                                <td align="right"><strong><?php echo App\Helpers\Helpers::display('debit'); ?></strong></td>
                                                <td align="right"><strong><?php echo App\Helpers\Helpers::display('credit'); ?></strong></td>
                                                <td align="right"><strong><?php echo App\Helpers\Helpers::display('balance'); ?></strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (empty($error)) {
                                            ?>

                                                <tr>
                                                    <td height="25"></td>
                                                    <td></td>
                                                    <td><?php echo App\Helpers\Helpers::display('no_report') ?>.</td>
                                                    <?php
                                                    if ($chkIsTransction) {
                                                    ?>
                                                        <td></td>
                                                    <?php
                                                    }
                                                    ?>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                    <td align="right"></td>
                                                </tr>

                                                <?php
                                            } else {
                                                $TotalCredit = 0;
                                                $CurBalance = $data['prebalance'];
                                                foreach ($HeadName2 as $key => $data) {
                                                ?>
                                                    <tr>
                                                        <td height="25"><?php echo ++$key; ?></td>
                                                        <td><?php echo $data->COAID; ?></td>
                                                        <td><?php echo $data->HeadName; ?></td>
                                                        <?php
                                                        if ($chkIsTransction) {
                                                        ?>
                                                            <td><?php echo $data->Narration; ?></td>
                                                        <?php
                                                        }
                                                        ?>

                                                        <td align="right"><?php echo  number_format($data->Debit, 2, '.', ','); ?></td>
                                                        <td align="right"><?php echo  number_format($data->Credit, 2, '.', ','); ?></td>
                                                        <?php
                                                        $TotalDebit += $data->Debit;
                                                        $CurBalance += $data->Debit;

                                                        $TotalCredit += $data->Credit;
                                                        $CurBalance -= $data->Credit;
                                                        ?>
                                                        <td align="right"><?php echo  number_format($CurBalance, 2, '.', ','); ?></td>

                                                    </tr>
                                                <?php } ?>

                                        <tfoot>
                                            <tr class="table_data">
                                                <?php
                                                if ($chkIsTransction)
                                                    $colspan = 4;
                                                else
                                                    $colspan = 3;
                                                ?>
                                                <td colspan="<?php echo $colspan; ?>" align="right"><strong><?php echo App\Helpers\Helpers::display('total') ?></strong></td>
                                                <td align="right"><strong><?php echo number_format($TotalDebit, 2, '.', ','); ?></strong></td>
                                                <td align="right"><strong><?php echo number_format($TotalCredit, 2, '.', ','); ?></strong></td>
                                                <td align="right"><strong><?php echo number_format($CurBalance, 2, '.', ','); ?></strong></td>
                                            </tr>
                                        </tfoot>
                                    <?php
                                            }
                                    ?>
                                    </tbody>
                                    <h4>
                                        <?php echo App\Helpers\Helpers::display('pre_balance') ?> : <?php echo number_format($data['prebalance'], 2, '.', ','); ?>
                                        <br /> <?php echo App\Helpers\Helpers::display('current_balance') ?> : <?php echo number_format($data['prebalance'], 2, '.', ','); ?>
                                    </h4>
                                    </table>
                                </div>
                                <div class="text-center general_ledger_report_btn" id="print">
                                    <input type="button" class="btn btn-warning" name="btnPrint" id="btnPrint" value="Print" onclick="printDiv();" />

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
@section('script')
<script></script>
@endsection