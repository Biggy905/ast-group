function cloneDOM(selector) {
    return $(selector).clone(true, true);
}

function mapValidateKey(data) {
    let keys = Object.keys(data);

    return keys[0];
}

function sendForm(
    method,
    url,
    contentType,
    responseType,
    body
) {
    var sendForm = new XMLHttpRequest();

    sendForm.open(method, url);
    sendForm.setRequestHeader('Content-Type', contentType);
    sendForm.responseType = responseType;
    sendForm.send(body);

    return sendForm;
}

function responseForm(sendForm) {
    sendForm.onload = function () {
        let responseJson = this.response;
        let key;
        if (this.status >= 200 && this.status <= 299) {
            if (responseJson['data']['status'] === 'success') {
                location.href = responseJson['data']['url'];
            } else {
                key = mapValidateKey(responseJson['data']);

                appendAlert(responseJson['data'][key], 'danger');
            }
        }
    }
}

const appendAlert = (message, type) => {
    const wrapper = document.createElement('div')
    wrapper.innerHTML = [
        `<div class="alert alert-${type} alert-dismissible" role="alert">`,
        `   <div>${message}</div>`,
        '   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>',
        '</div>'
    ].join('')
}

function responseFormValidate(sendForm) {
    sendForm.onload = function () {
        let responseJson = this.response;
        let key;
        if (this.status >= 200 && this.status <= 299) {
            if (responseJson['data']['status'] === 'success') {
                location.href = responseJson['data']['url'];
            } else if(responseJson['data']['status'] === 'queue') {
                key = mapValidateKey(responseJson['data']);

                appendToastSuccess(responseJson['data'][key]);
            } else {
                key = mapValidateKey(responseJson['data']);

                appendToastError(responseJson['data'][key]);
            }
        }
    }
}

const appendToastSuccess = (message) => {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.success(message);
}

const appendToastError = (message) => {
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    toastr.error(message);
}
