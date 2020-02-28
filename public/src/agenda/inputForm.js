$(document).ready(function()
	{
		$(".agenda").submit(function(e)
			{
				e.preventDefault()
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
				 url: '/agendas/store'+location.search,
				type: 'POST',
				data: $('form').serialize(),
				success: function(data)
					{
						$("#modalId").show('hide')
					}
                })
            })
        })
