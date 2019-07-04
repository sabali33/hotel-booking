
const CustomController = ()=>{
	return {
		init(){
			
			jQuery(document).ready( ($) =>{
				$('.delete-attribute').click( e =>{
					const confirmed = confirm('Do you want to delete this type?');
					if( !confirmed ){
						return;
					}
					const attributeId = e.target.getAttribute('data-attributeid');
					
					$.get(`/room-type/${attributeId}`, (response)=>{
						
						if( response.success ){
							window.location = response.redirect;
						}
					});

				});
				$('.delete-booking').click( e =>{
					const confirmed = confirm('Do you want to delete this type?');
					if( !confirmed ){
						return;
					}
					const bookingId = e.target.getAttribute('data-bookingid');
					
					$.get(`/booking/${bookingId}`, (response)=>{
						
						if( response.success ){
							window.location = response.redirect;
						}
					});
				});
				$('.deletePrice').click( e =>{
					this.remoteDeleteObject( e, `price`);
				});
				/*$('.updateCustomer').click( e =>{
					e.preventDefault();
					let data = {
						first_name: 'Eliasu',
						last_name: 'Abraman',
						email : "test@tse.com",
						address: 'djgj sfd',
						city: 'name',
						country: "Ghana"
					};
					axios.put('/customer/4', data).then(res =>{
						console.log(res);
					})
				})*/
				
			});
			
		},
		remoteDeleteObject(ev, item){
			const confirmed = confirm('Do you want to delete this type?');
			if( !confirmed ){
				return;
			}
			const query = ev.target.getAttribute(`data-${item}id`);
			
			$.get(`/${item}/${query}`, (response)=>{
				
				if( response.success ){
					window.location = response.redirect;
				}
			});
		}
	}
}
module.exports = {
	CustomController
}