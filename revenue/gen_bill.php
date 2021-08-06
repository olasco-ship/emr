<?php
require_once("../includes/initialize.php");


if (!$session->is_logged_in()) {
    if (!is_post())
        redirect_to(emr_lucid . "/auth/signin.php");
    else {
        return;
    }
}
if (!is_post()) {
    PatientBill::clear_all_bill();
    ?>
    <?php
    require('../layout/header.php');
    ?>

    <div id="main-content">
        <div class="container-fluid">
            <h1 class="sr-only">Dashboard</h1>


            <!-- SALES SUMMARY -->
            <div class="dashboard-section">
                <div class="section-heading clearfix">
                    <h2 class="section-title"><i class="fa fa-shopping-basket"></i> Non-Clinical Bills </h2>
                    <a href="#" class="right">View Sales Reports</a>
                </div>


                <dl class="dl-horizontal">
                    <dt style="font-size: large">
                        Select Unit Head
                    </dt>
                    <dd>
                        <select class="form-control" id="selectRev" name="rev_head" style="width: 300px">
                            <option value="">Select All</option>
                            <?php $rev_heads = RevenueHead::find_all();
                            foreach ($rev_heads as $rev_head) {
                                ?>
                                <option
                                        value="<?php echo $rev_head->id; ?>"><?php echo $rev_head->revenue_name; ?></option>
                                <?php
                            }
                            ?>

                        </select>
                    </dd>
                </dl>


                <div id="divResult" style="font-weight: bold; font-size: large"></div>
                <div class="row">

                    <div class="col-sm-8" style="font-size: large">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th>Revenue Name</th>
                                <th>Revenue Price</th>
                            </tr>
                            </thead>
                            <tbody id="revItems">
                            <?php $revs = Test::find_all();
                            foreach ($revs as $rev) { ?>
                                <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                                    <td>
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox" class="add_to_bill" value=""
                                                       data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                                            </label>
                                        </div>
                                    </td>
                                    <td><?php echo "₦$rev->price" ?></td>
                                </tr>
                            <?php } ?>
                            </tbody>
                        </table>

                    </div>


                    <div class="col-sm-4 bill" id="check">


                    </div>


                </div>


            </div>

        </div>
    </div>


    <?php
    require('../layout/footer.php');
} else {
    $value = $_POST['value'];
    if (!empty($value)) {
        $revenues = Test::find_by_revenueHead_id($value);
        foreach ($revenues as $rev) { ?>
            <tr data-id="<?php echo $rev->revenueHead_id; ?>">

                <td>
                    <div class="checkbox"><label>
                            <input type="checkbox" class="add_to_bill" value=""
                                   data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                        </label>
                    </div>
                </td>
                <td><?php echo "₦$rev->price"; ?></td>
            </tr>
        <?php }

    } else {
        $revs = Test::find_all();
      //  $revs = Revenue::find_all_by_rev();
        foreach ($revs as $rev) { ?>
            <tr data-id="<?php echo $rev->revenueHead_id; ?>">
                <td>
                    <div class="checkbox"><label><input type="checkbox" class="add_to_bill" value=""
                                                        data-id="<?php echo $rev->id; ?>"><?php echo $rev->name; ?>
                        </label></div>
                </td>
                <td><?php echo "₦$rev->price" ?></td>
            </tr>
        <?php }
    }
} ?>