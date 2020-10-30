/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

// window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example', require('./components/Example.vue'));

// const app = new Vue({
// el: '#app'
// });

/**
 * import socket io client
 */
const socket = require('socket.io-client')('http://localhost:9090');

/**
 * Init Component
 */
const $window = $(window);
const $usernameInput = $('.usernameInput');
const $messages = $('.messages');
const $userLists = $('.user-lists');
const $inputMessage = $('.inputMessage');
const $token = $('.secretToken');

/**
 * Vars
 */
let username;
let userid;
let friendid;
let $currentInput = $usernameInput.focus();

/**
 * Keyboard Events
 */
window.selectThis = function(value) {
    friendid = value;
    chat.changeSelectedId();
    chat.loadChat();
}

window.removeThis = function(value) {
    chat.removeListUser(value);
}

$window.keydown(function (event) {

    if (!(event.ctrlKey || event.metaKey || event.altKey)) {
        $currentInput.focus();
    }

    /**
     * When user press enter key
     */
    if (event.which === 13) {
        chat.handlePressEnter();
    }
});

/**
 * Chat Functionalities
 */
const chat = {

    handlePressEnter: () => {
        if (username === undefined) {
            chat.loginUser($usernameInput.val().trim(), $token.val().trim());
        } else {
            if (chat.isValidInputMessage()) {
                chat.sendMessage($inputMessage.val().trim());
            } else {
                alert('Please type message');
                chat.setInputFocus();
            }
        }
    },

    isValidInputMessage: () => $inputMessage.val().length > 0 ? true : false,

    loginUser: (user, token) => {
        if (token === '#1234') { // is admin !!need to auto-fetch
            username = user;
            chat.setInputFocus();
            userid = socket.id;
        } else { // is customer
            username = user;
            chat.setInputFocus();
            userid = socket.id;
            friendid = socket.id;
            let data = {
                id: friendid, // Receiver id
                username: user,
                time: (new Date()).getTime()
            };            
            socket.emit('user-join', data);
        }
    },

    changeSelectedId: () => {
        if (friendid) {
            socket.emit('leaveChat', friendid);
        }
        console.log('current friend id '+friendid);
        let data = {
            id: friendid, // Receiver id
            time: (new Date()).getTime()
        };
        socket.emit('joinChat', data);
    },

    setInputFocus: () => {
        $currentInput = $inputMessage.focus();
    },

    // this is for private chat
    sendMessage: (message) => {
        // console.log($token);
        if ($token.val().trim() === '#1234') { // Check if admin
            var url = "/dashboard/chat-admin";
            var tunnel_id = friendid;
        } else {
            var url = "/customer-chat";
            var tunnel_id = userid;
        }
        $currentInput.val('');
        chat.setInputFocus();
        let data = {
            sendId: userid, // Sender id
            id: friendid, // Receiver id
            time: (new Date()).getTime(),
            username: username,
            message: message
        };
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
        url: url,
        type:"POST",
        data:{
            _token: $('meta[name="csrf-token"]').attr('content'),
            message_id: tunnel_id,
            message: message,
            username: username,
        },
        dataType: 'JSON',
        success: function (data) { 
        console.log(data)
        }
        });
        socket.emit('sendMsg', data);

        // chat.addChatMessage(data);
    },

    log: (message, options) => {
        const element = $('<li style="list-style-type:none">').addClass('log').text(message);
        chat.addMessageElement(element, options);
    },

    loadChat: () => {
        $.ajax({
            url: 'admin-chat/'+friendid,
            type: 'get',
            dataType: 'json',
            success: function(response){
                var len = 0;
                $('.messages').empty(); // Empty box
                if (response) {
                // console.log(response);
                len = response.length;
                }
                if (len > 0) {
                    for(var i=0; i<len; i++) {
                        var data = response[i];
                        chat.addChatMessage(data);
                    }
                }
            }
        });
    },    

    listUser: (data, options) => {
        const userButton = $('<button style="width: 90%; background-color: white;" class="btn" name="message_id" value="'+data.id+'" onclick="selectThis(this.value)">').text(data.username);
        const userClose = $('<button style="width: 10%; background-color: white;" class="btn" value="'+data.id+'" onclick="removeThis(this.value)">').text('X');
        const element = $('<li id="'+data.id+'" class="list-group-item"/>')
                        .append(userButton, userClose);
        chat.addUserListElement(element, options);
    },

    removeListUser: (data) => {
        var myobj = document.getElementById(data);
        myobj.remove();
    },    

    addChatMessage: (data) => {
        const $usernameElement = $('<span class="username"/>').text(data.username+': ');
        const $messageBodyElement = $('<span class="messageBody">').text(data.message);

        const $messageElement = $('<li class="list-group-item"/>')
            .data('username', data.username)
            .append($usernameElement, $messageBodyElement);

        chat.addMessageElement($messageElement);
    },

    addMessageElement: (element, options) => {
        const $element = $(element);

        if (!options) options = {};
        if (typeof options.fade === undefined) options.fade = true;
        if (typeof options.prepend === undefined) options.prepend = false;
        if (options.fade) $element.hide().fadeIn(150);

        if (options.prepend) {
            $messages.prepend($element);
        } else {
            $messages.append($element);
        }

        $messages[0].scrollTop = $messages[0].scrollHeight;
    },

    addUserListElement: (element, options) => {
        const $element = $(element);

        if (!options) options = {};
        if (typeof options.fade === undefined) options.fade = true;
        if (typeof options.prepend === undefined) options.prepend = false;
        if (options.fade) $element.hide().fadeIn(150);

        if (options.prepend) {
            $userLists.prepend($element);
        } else {
            $userLists.append($element);
        }

        $userLists[0].scrollTop = $userLists[0].scrollHeight;
    }    
};

/**
 * Events
 */
socket.on('connect', () => {

    console.log('connected');
});

socket.on('chat-message', (data) => {

    chat.addChatMessage(data);
});

socket.on('receiveMsg', data => {

    chat.addChatMessage(data);
});

socket.on('user-join', (data) => {

    // chat.log(data.username + ' is connected');
    chat.listUser(data);
});

socket.on('user-unjoin', (data) => {

    // chat.log(data.user + ' disconnected');
});