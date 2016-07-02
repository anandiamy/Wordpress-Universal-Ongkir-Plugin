jQuery(document).ready(function($) {

	var animation = $( '.loading-animation' );
	var animation_from = $( '.loading-animation-from' );
	var animation_to = $( '.loading-animation-to' );
	animation.hide();

	animation_from.show();
	animation_to.show();

	$.ajax({
		url: WP_ONGKIR_CHECK.url,
		type: 'POST',
		dataType: 'json',
		data: {
			action: 'ongkir_load_city',
		},
		success: function( response ) {
			$.each(response.data.response.rajaongkir.results, function(i,item){
				//console.log(item.province);
				$('.from').append($('<option>').attr('value', item.city_id).text(item.city_name + ' - ' + item.province));
				animation_from.hide();
				
				$('.to').append($('<option>').attr('value', item.city_id).text(item.city_name + ' - ' + item.province));
				animation_to.hide();
			});
		},
		error: function( error ) {

		}
	});

	$('.btn-amy-submit').click(function() {
		
		animation.show();

		company_name = $('.company-name option:selected').val();
		from = $('.from option:selected').val();
		to = $('.to option:selected').val();
		kg = $('.kg').val();
		
		$.ajax({
			url: WP_ONGKIR_CHECK.url,
			type: 'POST',
			dataType: 'json',
			data: {
				action: 'ongkir_check',
				company_name: $('.company-name option:selected').val(),
				from: $('.from option:selected').val(),
				to: $('.to option:selected').val(),
				kg: $('.kg').val(),
				//security: WP_ONGKIR_CHECK.security
			},
			success: function( response ) {

				$('.amy-result-ongkir').remove();

				response2 = response;

				amy_table = "<table class='amy-result-ongkir'>";
				amy_table += "<tr><td>Kota Asal</td><td colspan='2'>" + response.data.response.rajaongkir.origin_details.city_name + "</td></tr>";
				amy_table += "<tr><td>Kota Tujuan</td><td colspan='2'>" + response.data.response.rajaongkir.destination_details.city_name + "</td></tr>";
				amy_table += "<tr><td>Kurir</td><td colspan='2'>" + response.data.response.rajaongkir.query.courier + "</td></tr>";
				amy_table += "<tr><td colspan='3'>Haga</td></tr>";
				amy_table += "<tr><td>Service</td><td>Harga</td><td>Estimasi</td></tr>";
				
				for (var i = 0; i < response.data.response.rajaongkir.results[0].costs.length; i++) {
					amy_table += "<tr><td>" + response.data.response.rajaongkir.results[0].costs[i].service + "</td><td>" + response.data.response.rajaongkir.results[0].costs[i].cost[0].value + "</td><td>" + response.data.response.rajaongkir.results[0].costs[i].cost[0].etd + "</td></tr>";					
				}


				
				amy_table += "</table>";

				$(".amy-table").append(amy_table);

				animation.hide();
			},
			error: function( error ) {
				alert('error');
				//alert(error);
			}
		});

	});

});