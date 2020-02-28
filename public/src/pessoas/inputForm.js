$(document).ready(function()
	{
		$(".validate").submit(function(e)
			{
				e.preventDevault()
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
				 url: '/pessoas/store'+location.search,
				type: 'POST',
				data: $('form').serealize(),
				success: function(data)
					{
						console.log(data)
					}
                })
            })
        })
