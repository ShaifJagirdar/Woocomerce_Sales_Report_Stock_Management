
jQuery(document).ready(function() {
    console.log('script loaded');
    jQuery('#fetch_report').click(function(){
        console.log('btnclicked')
        var sku = jQuery('#sku_input').val();
        if (!sku) {
            alert('Please enter an SKU.');
            return;
        }
        jQuery.ajax({
            url: murrelektronik_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'fetch_product_data',
                security: murrelektronik_ajax.nonce,
                sku: sku
            },
            success: function(response) {
                if (response.success) {
                    jQuery('#units_sold').text(response.data.units_sold);
                    jQuery('#stock_level').text(response.data.stock_level);
                    jQuery('#sku_report_popup').removeClass('hidden');
                    var modalElement = document.getElementById('skuReportModal');
                    var modal = new bootstrap.Modal(modalElement);
                    modal.show();
                    modalElement.addEventListener('shown.bs.modal', function () {
                        jQuery('#skuReportModal .btn-close').focus(); 
                    });
                    modalElement.addEventListener('hidden.bs.modal', function () {
                        jQuery('#fetch_report').focus(); 
                    });
                } else {
                    alert(response.data.message);
                }
            }
        });
    })
    jQuery('.close-popup').on('click', function() {
        jQuery('#sku_report_popup').addClass('hidden');
    });
});
