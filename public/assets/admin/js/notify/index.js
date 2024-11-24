'use strict';
var notify = $.notify({
    type: 'success',
    allow_dismiss: true,
    delay: 2000,
    showProgressbar: true,
    timer: 300,
    animate:{
        enter:'animated fadeInDown',
        exit:'animated fadeOutUp'
    }
});

setTimeout(function() {
    notify.success('message', '<i class="fa fa-bell-o"></i><strong>تجريبي </strong>');
}, 1000);
