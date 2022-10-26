<?php

use Illuminate\Support\Facades\DB;
// @include ('Class/CConManager.php');
// @include ('Class/Ccommon.php');
// @include ('Class/CResult.php');
// @include ('Class/CAccount.php'); 
?>
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
                                    <div class="panel-body" id="printArea">
                                        <tr align="center">
                                            <td id="ReportName" class="coa_print_family"><b><?php echo App\Helpers\Helpers::display('bk_vouchar') ?></b></td>
                                        </tr>
                                        <div class="">
                                            <table cellpadding="0" cellspacing="0" border="1px solid #000" width="99%" class="coa_print_text_align">
                                                <?php
                                                // $oResult=new CResult();
                                                // $oAccount=new CAccount();

                                                $oResult = DB::select("SELECT * FROM acc_coa WHERE IsActive=1 ORDER BY HeadCode");
                                                // $oResult=$oAccount->SqlQuery($sql);
                                                for ($i = 0; $i < count($oResult); $i++) {
                                                    $oResultLevel = DB::select(DB::raw("SELECT MAX(HeadLevel) as MHL FROM acc_coa WHERE IsActive=1"))[0];
                                                    // $oResultLevel=$oAccount->SqlQuery($sql);
                                                    $maxLevel = $oResultLevel->MHL;

                                                    $HL = $oResult[$i]->HeadLevel;
                                                    $Level = $maxLevel + 1;
                                                    $HL1 = $Level - $HL;

                                                    echo '<tr>';
                                                    for ($j = 0; $j < $HL; $j++) {
                                                        echo '<td>&nbsp;</td>';
                                                    }
                                                    echo '<td>' . $oResult[$i]->HeadCode . '</td>';
                                                    echo '<td colspan=' . $HL1 . '>' . $oResult[$i]->HeadName . '</td>';
                                                    echo '</tr>';
                                                }
                                                ?>
                                            </table>

                                        </div>
                                        <div class="text-center coa_print" id="print">
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
<script src="<?php echo url('public/accounts/assets/js/coa_print_script.js'); ?>" type="text/javascript"></script>
@endsection