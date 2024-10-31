jQuery(document).ready(function($) {
	
	$("#ns-close-modal").click(function() {
		$(".ns-modal-wc-layer").hide();
		$(".ns-modal-wc").hide();
		$(".ns-product-id-hidden").remove();
		$("html").removeClass("ns-modal-opened");
	});


	$(".ns-modal-wc-layer").bind('click', function(e) {
		if($(e.target).closest('.ns-modal-wc').length === 0) {
			$(".ns-modal-wc-layer").hide();
			$(".ns-modal-wc").hide();
			$(".ns-product-id-hidden").remove();
			$("html").removeClass("ns-modal-opened");
		}
	  });

	$(".ns-woo-catalog-submit-for-info").click(function() {
		var id = $(this).data("id-prodotto");
		var product_name = $(this).data("nome-prodotto");
		$('#ns-subject').val('I am writing to enquire about '+product_name);
		$('.ns-modal-wc').append('<input type="hidden" class="ns-product-id-hidden" id="productid" name="productid" value="'+id+'" />');

		$(".ns-div-success").hide();
		$(".ns-modal-wc-layer").show();
		$(".ns-modal-wc").show();
		$(".ns-textarea-size").show();
		$(".ns-div-share-now").show();
		$(".ns-div-success").hide();
		$(".ns-div-error").hide();
		$("html").addClass("ns-modal-opened");
	});
	
	$("#ns-share-now").click(function() {


		var ns_mail_sender_name = $('#ns-your-name').val();
		var ns_mail_sender_mail = $('#ns-your-email').val();
		var ns_mail_subject = $('#ns-subject').val();
		var ns_mail_body_content = $('.ns-textarea-dialog').val();
		var ns_mail_product_name = $('#productid').val();
		

		$.ajax({
			url: nssendrequest.ajax_url, 
			type : 'POST',
			data : {
				action : 'ns_wc_send_request',
				ns_mail_sender_name : ns_mail_sender_name,
				ns_mail_sender_mail : ns_mail_sender_mail,
				ns_mail_subject : ns_mail_subject,
				ns_mail_body_content : ns_mail_body_content,
				ns_mail_product_name : ns_mail_product_name
				
			},
			success: function(result){
				$(".ns-textarea-size").hide();
				$(".ns-div-share-now").hide();
				if(result == "done")
					$(".ns-div-success").show();
				else
					$(".ns-div-error").show();
				
			}
		});
		
	});
	
	$(".ns-try-again").click(function() {

		$(".ns-div-error").hide();
		$(".ns-textarea-size").show();
		$(".ns-div-share-now").show();
		
	});
		
});


  