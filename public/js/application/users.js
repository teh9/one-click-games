$("#addUser").click(function (){
    return openValidationWindow('Add new user', 'userCreate');
})

deleteUser = (user_id) => {
    post('users', {
        action: 'deleteUser',
        user_id: user_id
    }).done( function (response) {
        if(isSuccess(response)){
            $("#userId"+user_id).remove();
            return new Notifications('messageUp', response);
        }
        return new Notifications('messageUp', response);
    })
}

updateUser = (user_id) => {
    return openValidationWindow('Update user', 'updateUser', user_id)
}

prepareData = (method, uid = null) => {
    return {
        action: method,
        name: $("#uName").val(),
        email: $("#uEmail").val(),
        password: $("#uPassword").val(),
        age: $("#uAge").val(),
        user_id: uid
    }
}

openValidationWindow = (title, method, user_id = null) => {
    Swal.fire({
        title: title,
        html: '<input type="text" class="form-control" id="uName" placeholder="User name">' +
            '<input type="email" class="form-control my-2" id="uEmail" placeholder="User email">' +
            '<input type="password" class="form-control mb-2" id="uPassword" placeholder="User password">' +
            '<input type="number" class="form-control" id="uAge" placeholder="User age">',
        confirmButtonText: 'Proceed',
        showCancelButton: true,
        cancelButtonText: 'Cancel',
        focusConfirm: false,
        preConfirm: () => {
            const data = prepareData(method, user_id);
            post('users', data).done(function (response) {
                if(isSuccess(response)){
                    return new Notifications('message', response, '/');
                }

                if (isObject(response.message)) {
                    response.message = ObjToStrNotify(response.message);
                }
                return new Notifications('message', response);
            });
        }
    });
}
