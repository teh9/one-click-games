post = (path, payload, spec = false) => {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    if(!spec){
        path = 'ajax.'+path;
    }

    return $.post(path, payload);
}

isSuccess = (json) => {
    return json.status === 'success';
}

isObject = (object) => {
    return typeof object === 'object';
}

ObjToStrNotify = (object) => {
    let message = '';
    for(const [key, value] of Object.entries(object)){
        message += '<span>'+value+'</span><br>';
    }

    return message;
}

class Notifications
{
    constructor(type, jsonObject, redirect = null) {

        this.redirect = redirect;

        this.actions = {
            'message': 'modalMessage',
            'messageUp': 'modalMessageUp'
        }

        this._init(type, jsonObject);
    }

    _init (type, jsonObject)
    {
        return this[this.actions[type]](jsonObject);
    }

    modalMessage (data)
    {
        const url = this.redirect;

        if(url !== null && data.status === 'success'){
            return Swal.fire({
                icon: data.status,
                html: '<p>'+data.message+'</p>'
            }).then( function () {
                window.location.href = url;
            });
        }

        return Swal.fire({
            icon: data.status,
            html: '<p>'+data.message+'</p>'
        });
    }

    modalMessageUp (data)
    {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: data.status,
            title: data.message
        })
    }
}
