var myVar = {
    idTree: 0,
    ligh: function () {
        $('a[data-rel^=lightcase]').lightcase({
            forceHeight: true,
            maxWidth: 1200,
            maxHeight: 900,
            swipe: true,
        });
    },
    ajax: function (functionName, url, data = null) {
        $.ajax({
            url: url,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: functionName,
            error: function (data, textError, one) {
                myModal.error.show(data.responseText, one, 0);
            },
        });
    },
    ajaxForm: function (element, functionName) {
        let data = new FormData(element);
        $.ajax({
            url: element.action,
            type: 'post',
            data: data,
            processData: false,
            contentType: false,
            success: functionName,
            error: function (data, textError, one) {
                myModal.error.show(data.responseText, one, 0);
            },
        });
    },
    ajaxA: function (element, functionName) {
        $.ajax({
            url: element.href,
            type: 'post',
            processData: false,
            contentType: false,
            success: functionName,
            error: function (data, textError, one) {
                myModal.error.show(data.responseText, one, 0);
            }
        });
    },
    lenghtChar: function (element) {
        $("span[data-count-lenght='" + element.id + "']").text(element.value.length)
    },
    keyDownLength: function (element) {
        $(element).each(function (index, e) {
            $(e).on('keydown', myVar.lenghtChar(e));
        });

    },
    save: function (form) {
        console.info(form);
        $("'" + form + "'").trigger('submit')
    }
};

myVar.ligh();


var myModal = {
    info: {
        open: function () {
            $('#modalInfo').modal('show');
        },
        close: function () {
            $('#modalInfo').modal('hide');
        },
        show: function (text, title = 'Информация', time = 0) {
            $('#modalInfo-body').html(text);
            $('#modalInfo-title').html(title);
            if (time != 0) {
                setTimeout(function () {
                    myModal.info.close();
                }, time)
            }
            this.open();
        },
        clear: function () {
            $('#modalInfo-body').html('');
            $('#modalInfo-title').html('');
        }
    },
    error: {
        open: function () {
            $('#modalError').modal('show');
        },
        close: function () {
            $('#modalError').modal('hide');
        },
        show: function (text, title = 'Ошибка', time = 0) {
            $('#modalError-body').html(text);
            $('#modalError-title').html(title);
            if (time != 0) {
                setTimeout(function () {
                    myModal.error.close();
                }, time)
            }
            this.open();
        },
        clear: function () {
            $('#modalError-body').html('');
            $('#modalError-title').html('');
        }
    },
    panel: {
        position : 0,
        text: function (text, width = 0) {
            
            $('#control-info-modal').html(text);
            if(width !== 0){
                myModal.panel.position = 1;
                $('#control-slider-id').css('width', width+'%');
            }else{
                $('#control-slider-id').css('width', '100%');
            }
        },
        clear: function () {
            $('#control-info-modal').html('');
        },
        close: function () {
//            if(myModal.panel.position != 0 ){
//                $('span[data-toggle="control-sidebar"]').trigger('click')  
//                myModal.panel.position = 0;
//                $('span[data-toggle="control-sidebar"]').trigger('click')  
//            }else{
//                $('span[data-toggle="control-sidebar"]').trigger('click')  
//            }
            $('span[data-toggle="control-sidebar"]').trigger('click');
        },
        start: function(){
            $('[data-toggle="control-sidebar"]').controlSidebar();
        }
        
    }
};