
function makeSelectOptions(array,only,withPreSelected = true){

    let options = '';
    if(withPreSelected === true){
        options = '<option disabled selected>Select</option>';
    }
    if(typeof array[only] !== 'undefined'){
        $.each(array[only],function (id,text){
            options = options + '<option value="'+id+'">'+text+'</option>';
        })
    }

    return options;
}
function countRows(modal){
    let tBodyElements = modal.find('tbody tr');
    let modalId = modal.attr('id');
    if(tBodyElements.length > 0){
        $("button[data-target='#"+modalId+"']").find('.count').html('('+tBodyElements.length+')');
    }else{
        $("button[data-target='#"+modalId+"']").find('.count').html('');
    }
}

function sumDebitAndCreditToFooter(table){
    let allDebitFields = table.find('.debit');
    let allCreditFields = table.find('.credit');
    let totalDebit = 0;
    let totalCredit = 0;

    allDebitFields.each(function (){
        let amt = sanitizeAutonum($(this).val());
        totalDebit = totalDebit + amt;
    })
    allCreditFields.each(function (){
        let amt = sanitizeAutonum($(this).val());
        totalCredit = totalCredit + amt;
    })
    table.find('.debit_total').html($.number(totalDebit,2));
    table.find('.credit_total').html($.number(totalCredit,2))
}
function jevSuccessfullySubmitted(){
    $('.totals').each(function (){
        $(this).html('0.00');
    });
    $("#sl_modals").html('');
}



//ON ADD SL ROW BUTTON
$("body").on("click",".add_sl_row_btn",function (){
    let t = $(this);
    let tbl = t.parents('table');
    let tBody = tbl.find('tbody');
    let slRowTemplate = $("#sl_row_template").html();
    let newRand = makeId(10);
    let accountCodeSelected = t.attr('account_code');
    slRowTemplate = slRowTemplate.replaceAll('slug',t.attr('data'));
    slRowTemplate = slRowTemplate.replaceAll('newRand',newRand);
    tBody.append(slRowTemplate);
    $("#sl_row_"+newRand+" .autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    });
    let targetSelect2 = $("#select_sa_"+newRand);
    targetSelect2.html(makeSelectOptions(saAccounts,accountCodeSelected));
    targetSelect2.select2();
    $("#sl_row_"+newRand+" .account_code_header").val(accountCodeSelected);
});

//ON CLICK SL BUTTON
$("body").on('click','.sl_btn',function (){

    let t = $(this);
    let tr = t.parents('tr');
    let select2 = tr.find('.select2_account_code');
    let targetModal = $(t.attr('data-target'));
    let previousSelectedAccountCode = targetModal.find('.add_sl_row_btn').attr('account_code');
    if(select2.val() !== ''){
        if(typeof  saAccounts[select2.val()] == 'undefined'){
            toast('warning','No Subsidiary accounts on selected Account Code was found.');
        }else{
            if(typeof previousSelectedAccountCode !== 'undefined'){
                if(previousSelectedAccountCode !== select2.val()){
                    Swal.fire({
                        html: '<p style="font-size: 16px">You have changed the selected account code.<br> ' +
                            'Current subisidiary accounts will be discarded.</p><br>' +
                            'Previously selected: <b>'+previousSelectedAccountCode+'</b><br>' +
                            'Newly selected: <b>'+select2.val()+'</b>',
                        showDenyButton: false,
                        showCancelButton: true,
                        confirmButtonText: 'Continue',
                    }).then((result) => {
                        /* Read more about isConfirmed, isDenied below */
                        if (result.isConfirmed) {
                            targetModal.find('.modal-title').html(select2.val());
                            targetModal.find('.add_sl_row_btn').attr('account_code',select2.val());
                            targetModal.find('tbody').html('');
                            targetModal.modal('show');
                            countRows(targetModal);
                        }
                    })
                }else{
                    targetModal.find('.modal-title').html(select2.val());
                    targetModal.find('.add_sl_row_btn').attr('account_code',select2.val());
                    targetModal.modal('show');
                }
            }else{
                targetModal.find('.modal-title').html(select2.val());
                targetModal.find('.add_sl_row_btn').attr('account_code',select2.val());
                targetModal.modal('show');
            }
        }
    }else{
        toast('warning','Please select account code/title.');
    }
});

$("#add_jev_details_btn").click(function (){
    let jevTbl = $(this).parents('table');
    let rand = makeId(10);
    let jevDetailsRowTemplate = $("#jev_details_row_template").html().replaceAll('slug',rand);

    jevTbl.find('tbody').append(jevDetailsRowTemplate);
    let newRow = jevTbl.find('#row_'+rand);
    newRow.find('.select2_resp_center').select2();

    //initialize autonum on new inputs
    newRow.find(".autonum").each(function(){
        new AutoNumeric(this, autonum_settings);
    });

    //initialize select2 on account code
    newRow.find(".select2_account_code").select2({
        ajax: {
            url: ajaxUrlForSelect2AccountCode,
            dataType: 'json',
            delay : 250,
        },

        placeholder: 'Select item',
    });

    //populate readonly account code
    $('#row_'+rand+' .select2_account_code').on('select2:select', function (e) {
        let data = e.params.data;
        newRow.find('.account').val(data.id);
    });

    //add modal
    slModals = $("#sl_modals");
    slModalTemplate = $("#sl_modal_template").html();
    slModalTemplate = slModalTemplate.replaceAll('slug',rand);
    slModals.append(slModalTemplate);
    // $(".add_sl_row_btn[data='"+rand+"']").trigger('click');

})

//count rows on modal hide
$("body").on("hidden.bs.modal",".sl_modal",function (){
    let t = $(this);
    countRows(t);
});