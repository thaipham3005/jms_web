

//#region Save and Load Form
async function saveFormToSession(formType) {
    try {
        inputs = $('[type=text],[type=number], textarea');
        checkboxes = $('input[type=checkbox], input[type=radio]');
        selects = $('select');
        dates = $('[type=date]')
        form_fields = {};

        inputs.each(function() {
            id = $(this)[0]['id'];
            value = $(this)[0]['value'];
            form_fields[id] = value;
        });
        dates.each(function() {
            id = $(this)[0]['id'];
            value = $(this)[0]['value'];
            form_fields[id] = value;
        });
        checkboxes.each(function() {
            id = $(this)[0]['id'];
            if ($(this)[0]['checked'] == true) {
                value = 'checked';
            } else {
                value = null;
            }
            form_fields[id] = value;
        });
        selects.each(function() {
            id = $(this)[0]['id'];
            value = $(this)[0]['value'];
            form_fields[id] = value;
        });
        form = {};
        form = {
            [formType]: form_fields
        }

        console.log(form)

        await $.ajax({
            url: base_url + 'auth/saveDataToSession/' + formType,
            type: 'POST',
            data: form,
            dataType: 'json',
            dataFilter: function(res) {
                // console.log(res);
                return res;
            },
            success: function(response) {
                // console.log(response);
            },
            error: function(error) {
                console.log((error));
            }
        });
    } catch (e) {
        console.log(e);
    }

}

async function loadFormFromSession(formType) {
    try{
        await $.ajax({
            url: base_url + 'auth/loadDataFromSession/' + formType,
            type: 'POST',
            data: {},
            dataType: 'json',
            dataFilter: function(res) {
                // console.log(res);
                return res;
            },
            success: function(response) {
                // console.log(response['request_no']);
                if (response) {
                    Object.keys(response).forEach(function(k) {
                        if (response[k] == 'checked') {
                            console.log(k)
                                // $('#' + k).prop('checked', true);
                            $('[id=' + k + ']').prop('checked', true);
                        } else if (response[k] != '') {
                            $('#' + k).val(response[k]);
                            $('#' + k).css('color', '#3C8DBC');
                        }
                    });
                }
            },
            error: function(error) {
                console.log((error));
            }
        });

    } catch (e) {
        console.log(e);
    }
    
}

async function saveDataToSession(key, dataJson) {
    try{
        info = {
            key: dataJson
        }
    
        await $.ajax({
            url: base_url + 'auth/saveDataToSession/' + key,
            type: 'POST',
            data: info,
            dataType: 'json',
            // async: false,
            dataFilter: function(res) {
                console.log(res);
                return res;
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                // console.log((error));
            }
        });
    }
    catch (e) {
        console.log(e);
    }
    
}

async function loadDataFromSession(key) {
    try {
        await $.ajax({
            url: base_url + 'auth/loadDataFromSession/' + key,
            type: 'POST',
            data: {},
            dataType: 'json',
            dataFilter: function(res) {
                // console.log(res);
                return res;
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log((error));
            }
        });
    }
    catch (e) {
        console.log(e);
    }
    
}

async function clearFormFromSession(formType) {
    try {
        await $.ajax({
            url: base_url + 'auth/clearFormFromSession/' + formType,
            type: 'POST',
            data: {},
            dataType: 'json',
            dataFilter: function(res) {
                // console.log(res);
                return res;
            },
            success: function(response) {
                console.log(response);
            },
            error: function(error) {
                console.log((error));
            }
        });
    }
    catch (e) {
        console.log(e);
    }
}

function autoSaveForm(formType, interval) {
    setInterval(function() {
        saveFormToSession(formType)
    }, interval);
}

//#region

//#region Form validation

//#endregion

//#region Basic CRUD for forms
function removeByModal(id, formElement){
    if (!id){
         showSnackbar("error", `No valid item was selected`);
    }
    try{
        
        $(formElement).unbind('submit').on('submit', function() {
            let form = $(this);
            $.ajax({
                url: `${form.attr('action')}/${id}`,
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                dataFilter: function(res){
                    console.log(res);
                    return res;
                },
                success: function(response) {
                    $(formElement).parents().find('.modal').modal('hide');
                    table.ajax.reload(null, false);
                    if (response.success === true) {
                        showSnackbar("success", response.messages);
                    } else {
                        showSnackbar("error", response.messages);
                    }
                }, 
                error: function(error){
                    console.log(error);
                }
            });
            return false; // return false to disbale default form submission 
        });
    }            
    catch (e){
        console.log(e);
    }
    
    
}

function addByModal(formElement){    
   try{
       $(formElement).unbind('submit').on('submit', function() {
           let form = $(this);
           $.ajax({
               url: form.attr('action'),
               type: form.attr('method'),
               data: form.serialize(),
               dataType: 'json',
               beforeSend: function(){
                    // console.log(form.serialize());
               },
               dataFilter: function(res){
                   console.log(res);
                   return res;
               },
               success: function(response) {
                   $(formElement).parents().find('.modal').modal('hide');
                   table.ajax.reload(null, false);
                   if (response.success === true) {
                       showSnackbar("success", response.messages);
                   } else {
                       showSnackbar("error", response.messages);
                   }
               }, 
               complete: function(){

               },
               error: function(error){
                   console.log(error);
               }
           });
           return false; // return false to disbale default form submission 
       });
   }         
   catch (e){
       console.log(e);
   }
}

function editByModal(id, formElement){    
    try{
        $(formElement).unbind('submit').on('submit', function() {
            let form = $(this);
            $.ajax({
                url: `${form.attr('action')}/${id}`,
                type: form.attr('method'),
                data: form.serialize(),
                dataType: 'json',
                beforeSend: function(){
                     // console.log(form.serialize());
                },
                dataFilter: function(res){
                    // console.log(res);
                    return res;
                },
                success: function(response) {
                    $(formElement).parents().find('.modal').modal('hide');
                    table.ajax.reload(null, false);
                    if (response.success === true) {
                        showSnackbar("success", response.messages);
                    } else {
                        showSnackbar("error", response.messages);
                    }
                }, 
                complete: function(){
 
                },
                error: function(error){
                    console.log(error);
                }
            });
            return false; // return false to disbale default form submission 
        });
    }         
    catch (e){
        console.log(e);
    }
 }


//#endregion

//#region  General functions
function togglePasswordVisible(elementID){
    element = $(elementID);
    if (element.type === "password"){
        element.type = "text";
    } else {
        element.type = "password";
    }
}

function test() {
    // notifyMe("This is notification from VTS app " + window.location.href, base_url);

    console.log()
}

function notifyMe(message, link) {
    if (!window.Notification) {
        alert('Browser does not support notifications.');
    } else {
        // check if permission is already granted
        if (Notification.permission === 'granted') {
            // show notification here
            var notify = new Notification('JMS Notify', {
                body: message,
                icon: base_url + 'assets/logo/jms.ico',
                // image: base_url + 'images/logo.png',
                vibrate: true,
                // requireInteraction: true
            });
            notify.onclick = function(e) {
                window.open(link);
            };
            notify.onshow = function(e) {
                let src = base_url + 'assets/sounds/ding-dong.mp3';
                let audio = new Audio(src);
                audio.play();
            }

        } else {
            // request permission from user
            Notification.requestPermission().then(function(p) {
                if (p === 'granted') {
                    // show notification here
                    var notify = new Notification('VTS Notification', {
                        body: message,
                        icon: base_url + 'assets/logo/jms.ico',
                        // image: base_url + 'images/logo.png',
                        vibrate: true,
                        // requireInteraction: true
                    });
                } else {
                    console.log('User blocked notifications.');
                }
                notify.onclick = function() {
                    window.open(link);
                };
                notify.onshow = function(e) {
                    let src = base_url + 'assets/sounds/ding-dong.mp3';
                    let audio = new Audio(src);
                    audio.play();
                }
            }).catch(function(err) {
                console.error(err);
            });
        }
    }
}

function loadDataToFields(fields, data, container){
    parent = $(container);

    fields.forEach((item)=>{
        element = parent.find(`[name="${item}"]`);

        if (element.attr("type") == 'text' || element.attr("type") == 'number' || element.attr("type") == 'date' ||  element.attr("type") == 'email' || element.is('select')) {
            element.val(data[item]);
        } else if (element.attr("type") == 'checkbox') {
            if (data[item] == '1') {
                element.attr('checked', true);
            }
        } else if (element.attr("type") == 'radio') {
            element.each(function() {
                if ($(this).val() == data[item]) {
                    $(this).attr('checked', true);
                }
            })
        } else if (element.is('textarea')) {
            element.text(data[item]);
        } else {
            element.text(data[item]);
        }
        
    });
    
}

//#endregion

//#region  Users & Organization

async function getUserInfo(user_id){
    
    await $.ajax({
        url: base_url + "users/getUserById/"+user_id,
        type: "POST",
        data: [],
        dataType: 'json',
        beforeSend: function() {

        },
        dataFilter: function(res){
            // console.log(res);
            return res;
        },
        success: function(response) { 
            console.log(response);
            const fields = ['login_id','full_name', 'short_name', 'password', 'gender', 'birthday', 'company_id', 'department_id', 'team_id', 'position', 'address', 'email', 'phone', 'skype', 'level', 'group_id', 'first_working_day', 'active'];

            loadDataToFields(fields, response, "#userEditForm");
        }, 
        complete: function() {

        },
        error: function(error){
            console.log(error);
        }
    });
    
}

function genShortName(full_name){
    if (full_name.length > 1){
        let words = full_name.trim().split(" ");
        let short_name = "";
        short_name += words[words.length - 1] + " ";
        for (let i=0; i< words.length - 1; i++){
            short_name += words[i][0];
        }

        return short_name;
    }
}

function loadCompany(elements, preset = null, options = null){
    $.ajax({
        url: base_url + "organization/fetchCompanySelect",
        type: "POST",
        data: [],
        dataType: 'json',
        beforeSend: function() {

        },
        dataFilter: function(res){
            // console.log(res);
            return res;
        },
        success: function(response) { 
            for(element of elements){
                $(element).html(response);
                if (options){
                    if (options['disableOthers']){
                        $(element).find(`[value!="${preset}"]`).attr('disabled', true);
                    }
                    if (options['selectPreset']){
                        $(element).find(`[value="${preset}"]`).attr('selected', true);
                    }
                }
            } 
            // console.log(response);
            // if (response.success === true) {
            //     showSnackbar("success", response.messages);
            // } else {
            //     showSnackbar("error", response.messages);
            // }
        }, 
        complete: function() {

        },
        error: function(error){
            console.log(error);
        }
    });
}

function loadDepartments(elements, preset = null, options = null){
    $.ajax({
        url: base_url + "organization/fetchDepartmentSelect",
        type: "POST",
        data: [],
        dataType: 'json',
        beforeSend: function() {

        },
        dataFilter: function(res){
            // console.log(res);
            return res;
        },
        success: function(response) { 
            for(element of elements){
                $(element).html(response);
                if (options){
                    if (options['disableOthers']){
                        $(element).find(`[value!="${preset}"]`).attr('disabled', true);
                    }
                    if (options['selectPreset']){
                        $(element).find(`[value="${preset}"]`).attr('selected', true);
                    }
                }
                
            } 
            // console.log(response);
            // if (response.success === true) {
            //     showSnackbar("success", response.messages);
            // } else {
            //     showSnackbar("error", response.messages);
            // }
        }, 
        complete: function() {

        },
        error: function(error){
            console.log(error);
        }
    });
}

function loadTeams(elements, department_id, preset = null, options=null){
    $.ajax({
        url: base_url + "organization/fetchTeamSelect/"+ department_id,
        type: "POST",
        data: [],
        dataType: 'json',
        beforeSend: function() {

        },
        dataFilter: function(res){
            // console.log(res);
            return res;
        },
        success: function(response) { 
            for(element of elements){
                $(element).html(response);
                if (options){
                    if (options['disableOthers']){
                        $(element).find(`[value!="${preset}"]`).attr('disabled', true);
                    }
                    if (options['selectPreset']){
                        $(element).find(`[value="${preset}"]`).attr('selected', true);
                    }
                }
            } 
            // console.log(response);
            // if (response.success === true) {
            //     showSnackbar("success", response.messages);
            // } else {
            //     showSnackbar("error", response.messages);
            // }
        }, 
        complete: function() {

        },
        error: function(error){
            console.log(error);
        }
    });
}

function loadGroups(elements, preset = null){
    $.ajax({
        url: base_url + "groups/fetchGroupSelect",
        type: "POST",
        data: [],
        dataType: 'json',
        beforeSend: function() {

        },
        dataFilter: function(res){
            // console.log(res);
            return res;
        },
        success: function(response) { 
            for(element of elements){
                $(element).html(response);
            } 
            // console.log(response);
            // if (response.success === true) {
            //     showSnackbar("success", response.messages);
            // } else {
            //     showSnackbar("error", response.messages);
            // }
        }, 
        complete: function() {

        },
        error: function(error){
            console.log(error);
        }
    });
}

//#endregion

