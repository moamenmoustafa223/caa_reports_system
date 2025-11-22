$(document).ready(function (){

    $('#products_details').on('keyup blur', '.quantity', function(){
        let $row = $(this).closest('tr');
        let quantity = $row.find('.quantity').val() || 0;
        let unit_price = $row.find('.unit_price').val() || 0;

        $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));

        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#tax_value').val(calculate_tax());
        $('#total_amount').val(sum_total_amount());
        // $('#remaining').val(sum_remaining_amount());

    });

    $('#products_details').on('keyup blur', '.unit_price', function(){
        let $row = $(this).closest('tr');
        let quantity = $row.find('.quantity').val() || 0;
        let unit_price = $row.find('.unit_price').val() || 0;

        $row.find('.row_sub_total').val((quantity * unit_price).toFixed(2));

        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#tax_value').val(calculate_tax());
        $('#total_amount').val(sum_total_amount());
        // $('#remaining').val(sum_remaining_amount());
    });

    $('#products_details').on('keyup blur', '.discount', function(){

        $('#tax_value').val(calculate_tax());
        $('#total_amount').val(sum_total_amount());
        // $('#remaining').val(sum_remaining_amount());
    });

    $('#products_details').on('keyup blur', '.payment_amount', function(){
        $('#tax_value').val(calculate_tax());
        $('#total_amount').val(sum_total_amount());
        // $('#remaining').val(sum_remaining_amount());
    });

    // حساب الاجمالي الفرعي
    let sum_total = function($selector){
        let sum = 0;
        $($selector).each(function(){
            let selectorVal = $(this).val() != '' ? $(this).val() : 0;
            sum += parseFloat(selectorVal);
        });
        return sum.toFixed(2);
    }

    // حساب الضريبة
    let calculate_tax = function (){

        let sub_totalVal = $('.sub_total').val() || 0;
        let discount = parseFloat($('.discount').val()) || 0;
        let discountVal = sub_totalVal * (discount / 100);
        let tax_value = (sub_totalVal - discountVal) * 0.05;

        return tax_value.toFixed(2);
    }

    // حساب الاجمالي
    let sum_total_amount = function (){
        let sum = 0;
        let sub_totalVal = $('.sub_total').val() || 0;
        let discount = parseFloat($('.discount').val()) || 0;
        let discountVal = sub_totalVal * (discount / 100);

        let tax_value = parseFloat($('.tax_value').val()) || 0;

        sum += sub_totalVal;
        sum -= discountVal;
        sum += tax_value;

        return sum.toFixed(2)
    }

    // حساب المبلغ المتبقي

    let sum_remaining_amount = function (){
        let sum = 0;
        let total_amountVal = $('.total_amount').val() || 0;
        let payment_amount = parseFloat($('.payment_amount').val()) || 0;

        sum += total_amountVal;
        sum -= payment_amount;
        return sum.toFixed(2)
    }

    // اضافة صف جديد
    $('#btn_add').click(function() {

        let trCount = $('#products_details').find('tr.cloning_row:last').length;
        let numberIncr = trCount > 0 ? parseInt($('#products_details').find('tr.cloning_row:last').attr('id')) + 1 : 0;

        let template =
            `<tr class="cloning_row">
                        <td>
                            <button class="btn btn-danger btn-xs mt-1 btn_remove " type="button" id="btn_remove">
                                <i class="far fa-trash-alt"></i>
                            </button>
                        </td>
                        <td>
                            <input type="text" class="form-control product_name"  name="product_name[]" id="product_name" required >
                        </td>

                         <td>
                            <input type="number"  class="form-control quantity" name="quantity[]" id="quantity" required>
                        </td>

                        <td>
                            <input type="number"  class="form-control unit_price" name="unit_price[]" id="unit_price" required>
                        </td>

                        <td>
                            <input type="number" value="0.00"  class="form-control row_sub_total" id="row_sub_total"  name="row_sub_total[]" readonly >
                        </td>
                    </tr>`;

        $('#products_details').find('tbody').append(template);

    });

    // حذف صف
    $(document).on('click', '.btn_remove', function(e){
        e.preventDefault();
        $(this).parent().parent().remove();

        $('#sub_total').val(sum_total('.row_sub_total'));
        $('#tax_value').val(calculate_tax());
        $('#total_amount').val(sum_total_amount());
    });


});
