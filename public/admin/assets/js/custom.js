"use strict";

var base_url=$('#base-url').attr('data-url');
var key_val=$('#base-key').attr('data-key');

function anyDiscount(value) {
    const disSec = document.querySelector('.disSec');
    if (value == 1) {
        disSec.style.display = 'flex';
    } else {
        disSec.style.display = 'none';
        document.getElementById('discount').value = "";
        document.getElementById('discount_type').value = 1;
    }
}


document.addEventListener("DOMContentLoaded", function() {
    const checkedRadio = document.querySelector('input[name="any_discount"]:checked');
    if (checkedRadio && checkedRadio.value == '1') {
        document.querySelector('.disSec').style.display = 'flex';
    }
});


$(document).ready(function() {
    $('#category-select').on('change', function() {
        var categoryId = $(this).val();
        $('#dynamic-fields').html('');

        if (categoryId) {
            $.ajax({
                url: GET_FIELDS_URL + categoryId,
                method: "GET",
                dataType: "json",
                cache: false,
                success: function(fields) {
                    if (fields.length === 0) return;

                    var html = '';
                    fields.forEach(function(field) {
                       var inputType = field.field_type || 'text';

                        html += `
                            <div class="row mb-3 field-row">
                                <div class="col-sm-3">
                                    <label class="col-form-label">${field.field_name}</label>
                                </div>
                                <div class="col-sm-9">
                                    <input type="${inputType}" class="form-control" 
                                        name="fields[${field.id}]" 
                                        placeholder="Enter ${field.field_name}" required>
                                </div>
                            </div>
                        `;
                    });

                    $('#dynamic-fields').html(html);
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                    console.log(xhr.responseText);
                }
            });
        }
    });
});

function changeStatus(md, act, rid) {
    if (confirm('Are you sure you want to ' + act + ' this?')) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "GET",
            url: base_url + "/admin/change-status/",
            data: { rowid: rid, mode: md, action: act },
            dataType: "text",
            cache: false,
            success: function (data) {
                switch (md) {
                    case "product_best_seller":
                        $('#bst_' + rid).html(data);
                        break;
                    case "stock":
                        $('#stk_' + rid).html(data);
                        break;
                    default:
                        $('#st_' + rid).html(data);
                        break;
                }

                var act_txt = "";
                switch (act) {
                    case "activate":
                        if (md == 'product_best_seller') {
                            act_txt = "Marked as Best Seller";
                        } else if (md == 'stock') {
                            act_txt = "In Stock";
                        } else {
                            act_txt = "Activated";
                        }
                        break;
                    case "deactivate":
                        if (md == 'product_best_seller') {
                            act_txt = "Removed from Best Seller";
                        } else if (md == 'stock') {
                            act_txt = "Out of Stock";
                        } else {
                            act_txt = "Deactivated";
                        }
                        break;
                }

                $('#msgDivAjax').html('<div class="alert alert-success">' + act_txt + ' Successfully</div>');
            },
            error: function () {
                $('#msgDivAjax').html('<div class="alert alert-danger">Something went wrong</div>');
            }
        });
    }
}

function deleteData(md,rid)
{   
 if (confirm('Are you sure you want to delete this?')) {

   
     $.ajax({
         type: "GET",
         url: base_url + "/admin/delete-data/",
         data: {rowid: rid , csrf_token_name : key_val,  mode : md },
         dataType: "text",  
         cache:false,
         success: 
              function(data){
                $('#tr_' + rid).remove();  //as a debugging message.
                $('#msgDivAjax').html('<div class="alert alert-success background-success">Deleted Successfully</div>');
        
              }
          });// you have missed this bracket
   }
}


document.addEventListener("DOMContentLoaded", function() {
    const yearType   = document.getElementById("yearType");
    const yearBox    = document.getElementById("yearBox");
    const monthBox   = document.getElementById("monthBox");
    const startDate  = document.getElementById("startDateBox");
    const endDate    = document.getElementById("endDateBox");

    yearType.addEventListener("change", function() {
        yearBox.classList.add("d-none");
        monthBox.classList.add("d-none");
        startDate.classList.add("d-none");
        endDate.classList.add("d-none");

        if (this.value === "0") {
            yearBox.classList.remove("d-none");
        } else if (this.value === "1") {
            yearBox.classList.remove("d-none");
            monthBox.classList.remove("d-none");
        } else if (this.value === "2") {
            startDate.classList.remove("d-none");
            endDate.classList.remove("d-none");
        }
    });
});
