$.ajax({
    type: 'get',
    contentType: "application/json; charset=utf-8",
    dataType: 'json',
    url: `/get-user`+location.search
}).done(function (response) {
    let html= ''
    response.forEach(function (user, key) {
        html += `
        <div>${user.name}"</div>
        `
    });
    $('#user').html(html)
     html=''
})