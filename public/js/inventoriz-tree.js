/**
 * Скрипт страницы дерева устройств модуля Inventoriz
 * 2022.11.18 (c) Павел Сатин
 */



    function onLoadTreePage() {

        
        var inventorizUrl = $('#tree').attr('data-api-url');
        var computerName = $('#tree').attr('data-computer-name');
        var computerId = "";

        var auth_token;


        if (localStorage.token) {

            auth_token = localStorage.token;

            $.ajax({
                type: 'GET',
                url: inventorizUrl + '/api/v1/computer-name?name=' + computerName,
                // data: jQuery.param({ 'name': computerName }),
                headers: {
                    'Authorization': 'Bearer ' + auth_token
                },
                success: function (data) {
                    // console.log(data);
                    computerId = data.id;
                    if (typeof(computerId) != 'undefined' && computerId !== null) {
                        computerId = data.id;
                        renderComputerTree(computerId, auth_token, inventorizUrl);
                    } else {
                        console.log(data);
                        $('#tree').html('<p>No data</p>');
                    }
                },
                error: function (jqXHR, text, error) {
                    $('#tree').html('<p>' + error + '</p>');
                    console.log(error);
                }
            });

        } else {

            console.log('При загрузке страницы не обнаружен токен для авторизации!');

            // loginForm = '<form id="inventoriz-login-form">' +
            //         '<div class="form-group">' +
            //             '<label for="email">Имя пользователя</label>' +
            //             '<input type="email" class="form-control" id="email" name="email" placeholder="Имя пользователя" required="">' +
            //         '</div>' +
            //         '<div class="form-group">' +
            //             '<label for="password">Пароль</label>' +
            //             '<input type="password" class="form-control" id="password" name="password" placeholder="Пароль" required="">' +
            //         '</div>' +
            //         '<div class="form-group">' +
            //             '<button type="submit" class="btn btn-primary">Вход</button>' +
            //             '<button type="button" class="btn btn-info" data-dismiss="modal">Отмена</button>' +
            //         '</div>' +
            //     '</form>';

            // $('#tree').html(loginForm);


            $('#tree').html('<p>Unauthorized</p>');
        }


    }





    function renderComputerTree(computerId, auth_token, inventorizUrl){
        // console.log(auth_token);
        $('#tree').fancytree({
            ajax: { type: 'GET',
                beforeSend: function (xhr) {
                    if (auth_token) {
                        xhr.setRequestHeader('Authorization', 'Bearer ' + auth_token);
                    }
                }
            },
            source: { url: inventorizUrl + '/api/v1/computers/' + computerId + '/hardware' },
            tooltip: true,
            iconTooltip: function(event, data) {
                return data.typeInfo.iconTooltip;
            },
            icon: function(event, data) {
                if (data.node.icon) {
                    return 'img/inventoriz/icons/' + data.node.icon;
                }
            },

        });
    }










/*
// Предыдущая версия с авторизацией

            var json_url_login = inventorizUrl + '/api/login';
            $.ajax({
                type: 'POST',
                url: json_url_login,
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                data: jQuery.param({ 'email': '<?php echo $config['inventoriz_user']; ?>', 'password': '<?php echo $config['inventoriz_password']; ?>'}),
                success: function (data) {
                    // console.log(data);
                    auth_token = data.token;

                    auth_token = localStorage.token;

                    $.ajax({
                        type: 'GET',
                        url: inventorizUrl + '/api/v1/computer-name?name=' + computerName,
                        // data: jQuery.param({ 'name': computerName }),
                        headers: {
                            'Authorization': 'Bearer ' + auth_token
                        },
                        success: function (data) {
                            // console.log(data);
                            computerId = data.id;
                            if (typeof(computerId) != 'undefined' && computerId !== null) {
                                computerId = data.id;
                                renderComputerTree(computerId, auth_token);
                            } else {
                                console.log(data);
                                $('#tree').html('<p>No data</p>');
                            }
                        },
                        error: function (jqXHR, text, error) {
                            $('#tree').html('<p>' + error + '</p>');
                            console.log(error);
                        }
                    });


                },
                error: function (jqXHR, text, error) {
                    console.log(error);
                }
            });


*/
