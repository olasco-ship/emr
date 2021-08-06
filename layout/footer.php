<?php
?>

<script src="<?php echo emr_lucid ?>/light/assets/bundles/libscripts.bundle.js"></script>
<script src="<?php echo emr_lucid ?>/light/assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?php echo emr_lucid ?>/light/assets/bundles/chartist.bundle.js"></script>
<script src="<?php echo emr_lucid ?>/light/assets/bundles/knob.bundle.js"></script> <!-- Jquery Knob-->
<script src="<?php echo emr_lucid ?>/light/assets/bundles/flotscripts.bundle.js"></script> <!-- flot charts Plugin Js -->
<script src="<?php echo emr_lucid ?>/assets/vendor/toastr/toastr.js"></script>
<script src="<?php echo emr_lucid ?>/assets/vendor/flot-charts/jquery.flot.selection.js"></script>
<script src="<?php echo emr_lucid ?>/assets/vendor/summernote/dist/summernote.js"></script>

<script src="<?php echo emr_lucid ?>/light/assets/bundles/mainscripts.bundle.js"></script>
<script src="<?php echo emr_lucid ?>/light/assets/js/index.js"></script>

<script src="<?php echo emr_lucid ?>/assets/scripts/common.js"></script>
<!-- <script src="<?php //echo emr_lucid ?>/light/assets/js/common.js"></script> -->
<script src="<?php echo emr_lucid ?>/assets/scripts/typeahead.js"></script>
<script src="<?php echo emr_lucid ?>/assets/jquery-ui/jquery-ui.min.js"></script>

<script src="<?php echo emr_lucid ?>/assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo emr_lucid ?>/assets/vendor/sweetalert/sweetalert.min.js"></script> <!-- SweetAlert Plugin Js -->
<script src="<?php echo emr_lucid ?>/light/assets/js/pages/ui/dialogs.js"></script>
<script src="<?php echo emr_lucid ?>/assets/vendor/parsleyjs/js/parsley.min.js"></script>

<script src="<?php echo emr_lucid ?>/assets/multiselect/js/select2.min.js"></script>
<script src="<?php echo emr_lucid ?>/assets/multiselect/js/script.js"></script>

<script src="<?php echo emr_lucid ?>/assets/scripts/script.js"></script>





<!-- <script src="../light/assets/bundles/mainscripts.bundle.js"></script> -->
</body>


<script>
    $(function () {


        $('#labItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#labCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#drugItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('drug_cart.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#drugCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#labCheck').on("click", '.decrease_cart', function () {
            var id = $(this).data('id');
            modify_test(id, 'action=put&');
            //  modify_test(id, 'action=delete&');
        });

        $('#labCheck').on("click", '.increase_cart', function () {
            var id = $(this).data('id');
            modify_test(id);
        });

        $('#scanCheck').on("click", '.decrease_cart', function () {
            var id = $(this).data('id');
            modify_scan(id, 'action=put&');
            //  modify_test(id, 'action=delete&');
        });

        $('#scanCheck').on("click", '.increase_cart', function () {
            var id = $(this).data('id');
            modify_scan(id);
        });


        $('#drugCheck').on("click", '.decrease_cart', function () {
            var id = $(this).data('id');
            modify_drug_cart(id, 'action=put&');
            //  modify_test(id, 'action=delete&');
        });

        $('#drugCheck').on("click", '.increase_cart', function () {
            var id = $(this).data('id');
            modify_drug_cart(id);
        });

        function modify_drug_cart(id, param, element) {
            $.post('drug_cart.php?' + (param || '') + 'id=' + id, {id: id})
                .done(function (data) {
                    $("#drugCheck").html(data.bill);
                    //    $("#cart_count").html(data.items_count);
                    //    $("#testCheck").html(data.bill);
                    //    $("#drugCheck").html(data.save_bill);
                    //    $("#dispenseCheck").html(data.bill);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }


        $('#domain_id').change(function () {
            var selectedOption = $('#domain_id option:selected');
            console.log(selectedOption);
            selectedOption.val() ?
                $.post('classification.php', {value: selectedOption.val()}, function (data) {
                    $('#classification_id').html(data.trim());
                }) : $('#classification_id').html("");
        });

        $('#classification_id').change(function () {
            var selectedOption = $('#classification_id option:selected');
            console.log(selectedOption);
            selectedOption.val() ?
                $.post('diagnosis.php', {value: selectedOption.val()}, function (data) {
                    $('#diagnosis_id').html(data.trim());
                }) : $('#diagnosis_id').html("");
        });

        $('#clinic_id').change(function () {
            let selectedOption = $('#clinic_id option:selected');
            console.log(selectedOption);
            selectedOption.val() ?
                $.post('sub_clinic.php', {value: selectedOption.val()}, function (data) {
                    $('#sub_clinic_id').html(data.trim());
                }) : $('#sub_clinic_id').html("");
        });

        /*$('#examination_cat_id').change(function () {
            let selectedOption = $('#examination_cat_id option:selected');
            console.log(selectedOption);
            selectedOption.val() ?
                $.post('exam_cat.php', {value: selectedOption.val()}, function (data) {
                    $('#examination_id').html(data.trim());
                }) : $('#examination_id').html("");
        });*/

        $('#examination_cat_id').change(function () {
            getSymptoms($('#examination_cat_id option:selected'));
            // let selectedOption = $('#examination_cat_id option:selected');
            // var count = 0;
            // console.log(selectedOption);
            // selectedOption.each(function (){
            //         selectedOption.val() ?
            //             $.post('exam_cat.php', {value: selectedOption.val()}, function (data) {
            //                 $('#examination_id').html(data.trim());
            //             }) : $('#examination_id').html("");
            // });
        });

        function getSymptoms(id) {
            // var e = document.getElementById("examination_cat_id");
            // var strUser = e.value;
            // console.log(id);
            $('#examination_id').html("");
            for (let i=0; i<id.length; i++){
                // console.log(id[i].value)
                $.post('exam_cat.php', {value: id[i].value}, function (data) {
                    $('#examination_id').html(data.trim());
                })
            }

            // id.each(function (){
            //         selectedOption.val() ?
            //             $.post('exam_cat.php', {value: selectedOption.val()}, function (data) {
            //                 $('#examination_id').html(data.trim());
            //             }) : $('#examination_id').html("");
            // });
        }



        $('#clinic_vitals').change(function () {
            var selectedOption = $('#clinic_vitals option:selected');
            //   console.log(selectedOption);
            selectedOption.val() ?
                $.post('clinic_vitals.php', {value: selectedOption.val()}, function (data) {
                    $('#clin_vitals').html(data.trim());
                }) : $('#clin_vitals').html("");
        });

        $('#record_search')
            .on('submit', function ($ev) {
                $ev.preventDefault();
                let bill = $('#record_search input#bill_number').val();
                //  var $btn = $('#record_search button[type="submit"]').button('loading');
                $.post('search.php', {bill_number: bill}, function (data) {
                    $('#revItems').html(data.trim());
                });

            });


        $('#nhis_search')
            .on('submit', function ($ev) {
                $ev.preventDefault();
                let nhis = $('#nhis_search input#nhis_number').val();
                //  var $btn = $('#record_search button[type="submit"]').button('loading');
                $.post('search.php', {nhis_number: nhis}, function (data) {
                    $('#revItems').html(data.trim());
                });

            });


        $("#dob").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:currentYear.textContent"
        });
        $(".datepickeri").datepicker({
            dateFormat: 'dd-mm-yy',
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:currentYear.textContent"
        });


        $(function () {
            //$('#adm_date').datetimepicker();
        });

        // $("#adm_date").datepicker({
        //     dateFormat: 'dd-mm-yy H:i:s',
        //     changeMonth: true,
        //     changeYear: true,
        //     yearRange: "1900:currentYear.textContent"
        // });

        $("#stage_five").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "1900:currentYear.textContent"
        });

        $("#start_date").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $("#end_date").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $('#formPrint').click(function () {
            window.print();
        });

        $('#printBill').click(function () {
            window.print();
        });

        $('#revenueHead_id').change(function () {
            let selectedOption = $('#revenueHead_id option:selected');
            selectedOption.val() ?
                $.post('../revenueHead/my_dept.php', {value: selectedOption.val()}, function (data) {
                    $('#revHeadItems').html(data.trim());
                }) : $('#revHeadItems').html("");
        });


        $('#record_search')
            .on('submit', function ($ev) {
                $ev.preventDefault();
                let bill = $('#record_search input#bill_number').val();
                //  var $btn = $('#record_search button[type="submit"]').button('loading');
                $.post('search.php', {bill_number: bill}, function (data) {
                    $('#revItems').html(data.trim());
                });

            });


        $('#testItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });
        $('#testItemsSecond').on('click', '.add_to_bill_second', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#radioItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#scanCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#scanItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('scan_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#scanCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });


        $('.inputReceipt').click(function () {
            var name = $(this).text();
            $("#editProduct").text(name);
            // var id = $(this).attr("data-productId");
            var id = $(this).data("productId");
            $("#updateBody").load("input_receipt.php?id=" + id);
            $('#input_receipt_modal').modal('show');
        });

        $('.uploadResult').click(function () {
            var name = $(this).text();
            $("#editProduct").text(name);
            // var id = $(this).attr("data-productId");
            var id = $(this).data("productId");
            $("#updateBody").load("upload_result.php?id=" + id);
            $('#upload_result_modal').modal('show');
        });

        $('#chemItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#chemItemsSecond').on('click', '.add_to_bill_second', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#microItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#histoItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#nucItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });

        $('#microItemsSecond').on('click', '.add_to_bill_second', function () {
            var id = $(this).data('id');
            $.post('test_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#testCheckSecond").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });


        $('#txtProduct').typeahead({
            source: function (query, result) {
                $.ajax({
                    url: "server.php",
                    data: 'query=' + query,
                    dataType: "json",
                    type: "POST",
                    success: function (data) {
                        result($.map(data, function (item) {
                            return item;
                        }));
                    }
                });
            }

        });

        $('#selectRev').change(function () {
            var selectedOption = $('#selectRev option:selected');
            var myVal = $('#divResult').html(selectedOption.text());
            $.post('gen_bill.php', {value: selectedOption.val()}, function (data) {
                //                alert("data sent and received: " + data);
                $('#revItems').html(data.trim());
            });
            // $('#divResult').html(selectedOption.val() + " " + selectedOption.text());
        })


        $('#dispensedItems').on('click', '.add_to_bill', function () {
            var id = $(this).data('id');
            $.post('dispense_bill.php?id=' + id + ($(this)[0].checked ? '' : '&action=delete'), {id: id})
                .done(function (data) {
                    $("#dispenseCheck").html(data.bill);
                    //   $("#bill_count").html(data.items_count);
                });
        });


        $('#testCheck').on("click", '.increase_bill', function () {
            var id = $(this).data('id');
            modify_test(id);
        });

        $('#testCheck').on("click", '.decrease_bill', function () {
            var id = $(this).data('id');
            modify_test(id, 'action=put&');
        });

        $('#testCheck').on("click", '.del_bill', function () {
            var id = $(this).data('id');
            modify_test(id, 'action=delete&');
        });

        $('#scanCheck').on("click", '.increase_bill', function () {
            var id = $(this).data('id');
            modify_scan(id);
        });

        $('#scanCheck').on("click", '.decrease_bill', function () {
            var id = $(this).data('id');
            modify_scan(id, 'action=put&');
        });

        $('#scanCheck').on("click", '.del_bill', function () {
            var id = $(this).data('id');
            modify_scan(id, 'action=delete&');
        });


        function modify_test(id, param, element) {
            $.post('test_bill.php?' + (param || '') + 'id=' + id, {id: id})
                .done(function (data) {
                    $("#cart_count").html(data.items_count);
                    $("#testCheck").html(data.bill);
                    $("#save_page").html(data.save_bill);
                    $("#labCheck").html(data.bill);
                    //   $("#scanCheck").html(data.bill);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }

        function modify_scan(id, param, element) {
            $.post('scan_bill.php?' + (param || '') + 'id=' + id, {id: id})
                .done(function (data) {
                    $("#scanCheck").html(data.bill);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }

        function modify_dispense(id, param, element) {
            $.post('dispense_bill.php?' + (param || '') + 'id=' + id, {id: id})
                .done(function (data) {
                    $("#cart_count").html(data.items_count);
                    $("#testCheck").html(data.bill);
                    $("#save_page").html(data.save_bill);
                    $("#dispenseCheck").html(data.bill);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }


        $('#formPrint').on('submit', function (e) {
            e.preventDefault();
            var id = $('#billId').val();
            $.post('print_bill.php', {id: id});
            $('#submit').window.print();
        });


        $('#formSearch')
            .on('submit', function ($ev) {
                $ev.preventDefault();

                var name = $('#formSearch input#txtProduct').val();
                $.post('drug_cart.php', {name: name})
                    .done(function (data) {
                        //      $("#check").html(data.bill);
                        $("#save_page").html(data.save_bill);
                        $("#flow_one").html(data.flow);
                        //    $('#txtProduct').focus();
                        $('#txtProduct').val('');
                    });
            });


        $('#flowSearch')
            .on('submit', function ($ev) {
                $ev.preventDefault();

                var name = $('#flowSearch input#txtProduct').val();
                $.post('dispense_cart.php', {name: name})
                    .done(function (data) {
                        //      $("#check").html(data.bill);
                        $("#save_page").html(data.save_bill);
                        $("#flow_one").html(data.flow);
                        //    $('#txtProduct').focus();
                        $('#txtProduct').val('');
                    });
            });


        $('#check').on("click", '.increase_bill', function () {
            var id = $(this).data('id');
            modify_cart(id);
        });

        $('#check').on("click", '.decrease_bill', function () {
            var id = $(this).data('id');
            modify_cart(id, 'action=put&');
        });

        $('#check').on("click", '.del_bill', function () {
            var id = $(this).data('id');
            modify_cart(id, 'action=delete&');
        });

        $('#save_page').on("click", '.inc_bill', function () {
            var id = $(this).data('id');
            modify_cart(id);
        });

        $('#save_page').on("click", '.dec_bill', function () {
            var id = $(this).data('id');
            modify_cart(id, 'action=put&');
        });

        $('#flow_one').on("click", '.dec_bill', function () {
            var id = $(this).data('id');
            modify_cart(id, 'action=put&');
        });

        $('#dispenseCheck').on("click", '.dec_bill', function () {
            var id = $(this).data('id');
            modify_dispense(id, 'action=put&');
        });

        $('#save_page').on("keyup", '.inp_numb', function () {
            var id = $(this).data('id');
            var unit = $(this).val();
            if (!unit) return;
            modify_cart(id, 'unit=' + unit + '&overwrite=true&', ".inp_numb[data-id=" + id + "]");
        });

        $('#flow_one').on("keyup", '.inp_num', function () {
            var id = $(this).data('id');
            var unit = $(this).val();
            if (!unit) return;
            modify_cart(id, 'unit=' + unit + '&overwrite=true&', ".inp_num[data-id=" + id + "]");
        });

        $('#dispenseCheck').on("keyup", '.inp_num', function () {
            var id = $(this).data('id');
            var unit = $(this).val();
            if (!unit) return;
            modify_dispense(id, 'unit=' + unit + '&overwrite=true&', ".inp_num[data-id=" + id + "]");
        });


        function modify_cart(id, param, element) {
            $.post('my_bill.php?' + (param || '') + 'id=' + id, {id: id})
                .done(function (data) {
                    $("#cart_count").html(data.items_count);
                    $("#check").html(data.bill);
                    $("#save_page").html(data.save_bill);
                    $("#flow_one").html(data.flow);
                    //element && $(element).focus().setCursorToEnd();
                    // set_events();
                })
        }


        $('#returnItem').click(function () {
            $('#return_item_modal').modal('show');
        });

        $('.returnItem').click(function () {
            var name = $(this).text();
            $("#returnProductItem").text(name);
            // var id = $(this).attr("data-orderItemId");
            var id = $(this).data("orderItemId");
            $("#editContent").load("return_product.php?id=" + id);
            $('#product_return_modal').modal('show');
        });


        $("#success").fadeTo(2000, 500).slideUp(500, function () {
            $("#success").slideUp(500);
        });

        $("#app_date").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $("#man_date").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $("#exp_date").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $("#reg_date").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $("#startDate").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $("#endDate").datepicker({
            changeMonth: true,
            changeYear: true,
            //   yearRange: "1900:currentYear.textContent"
        });

        $('.btn-toggle-fullwidth').on('click', function () {
            if (!$('body').hasClass('layout-fullwidth')) {
                $('body').addClass('layout-fullwidth');
                $(this).find(".fa").toggleClass('fa-arrow-left fa-arrow-right');

            } else {
                $('body').removeClass('layout-fullwidth');
                $(this).find(".fa").toggleClass('fa-arrow-left fa-arrow-right');
            }
        });

        $('.btn-toggle-offcanvas').on('click', function () {
            $('body').toggleClass('offcanvas-active');
        });

        $('#Submit').click(function () {
            alert('in');
            var emailVal = $('#email').val(); // assuming this is a input text field
            $.post('checkemail.php', {'email': emailVal}, function (data) {
                if (data === 'exist') return false;
                else $('#form1').submit();
            });
        });


        $(document).ready(function () {

/*            $('#general').hide();
            $('#selGeneral').click(function () {
                $('#general').toggle();
            });*/

            $('#cns').hide();
            $('#selCns').click(function () {
                $('#cns').toggle();
            });

            $('#resp').hide();
            $('#selResp').click(function () {
                $('#resp').toggle();
            });

            $('#cad').hide();
            $('#selCad').click(function () {
                $('#cad').toggle();
            });

            $('#abd').hide();
            $('#selAbd').click(function () {
                $('#abd').toggle();
            });

            $('#uroF').hide();
            $('#selUroF').click(function () {
                $('#uroF').toggle();
            });

            $('#uroM').hide();
            $('#selUroM').click(function () {
                $('#uroM').toggle();
            });

            $('#neuro').hide();
            $('#selNeuro').click(function () {
                $('#neuro').toggle();
            });

            $('#gas').hide();
            $('#selGas').click(function () {
                $('#gas').toggle();
            });

            $('#examNote').hide();
            $('#selExamNote').click(function () {
                $('#examNote').toggle();
            });
        });










    });


    // validation needs name of the element
    //$('#food').multiselect();

    // initialize after multiselect
    //$('#basic-form').parsley();




</script>
</body>
</html>
