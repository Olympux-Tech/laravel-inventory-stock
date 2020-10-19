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
const $loginPage = $('.login.page');
const $usernameInput = $('.usernameInput');
const $messages = $('.messages');
const $userLists = $('.userLists');
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
    let friendid = value;
    console.log(friendid);
    chat.changeSelectedId(friendid);
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
        if (token === '#1234') { // is admin
            username = user;
            chat.setInputFocus();
            userid = socket.id;
        } else { // is customer
            $loginPage.fadeOut();
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

    changeSelectedId: (friend_id) => {
        friendid = friend_id;
        let data = {
            id: friendid, // Receiver id
            time: (new Date()).getTime()
        };        
        socket.emit('joinChat', data);
    },

    setInputFocus: () => {
        $currentInput = $inputMessage.focus();
    },

    // sendMessage: (message) => {
    //     $currentInput.val('');
    //     chat.setInputFocus();
    //     const data = {
    //         time: (new Date()).getTime(),
    //         user: username,
    //         message: message
    //     };
    //     socket.emit('chat-message', data);
    // },
    // this is for private chat
    sendMessage: (message) => {
        console.log(friendid);
        $currentInput.val('');
        chat.setInputFocus();
        let data = {
            sendId: userid, // Sender id
            id: friendid, // Receiver id
            time: (new Date()).getTime(),
            user: username,
            message: message
        };
        socket.emit('sendMsg', data);

        // $.ajax({
        // url: "/customer-chat",
        // type:"POST",
        // headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        // },
        // data:{
        //   message_id: userid,
        //   message: message,
        // }
        // });       
        // chat.addChatMessage(data);
    },

    log: (message, options) => {
        const element = $('<li>').addClass('log').text(message);
        chat.addMessageElement(element, options);
    },

    listUser: (data, options) => {
        const element = $('<button name="message_id" id="'+data.id+'" value="'+data.id+'" onclick="selectThis(this.value)">').text(data.username);
        chat.addUserListElement(element, options);
    },

    removeListUser: (data, options) => {
        var myobj = document.getElementById(data.id);
        myobj.remove();
    },    

    addChatMessage: (data) => {
        const $usernameElement = $('<span class="username"/>').text(data.user);
        const $messageBodyElement = $('<span class="messageBody">').text(data.message);

        const $messageElement = $('<li class="message"/>')
            .data('username', data.user)
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
    // this.setMessageJson(data); // Add this message to message list data
    // Determine whether the sendid of this message is the currently chatting object
    // true page to draw chat message
    if (data.sendId === friendid) {
        chat.addChatMessage(data);
    } else {
        chat.addChatMessage(data);
        // chat.log(data + ' fail to find friend');
        // false the red dot is displayed in the top left corner of a friend's picture, indicating that the friend has sent a new message
        // $('.me_' + data.sendId).innerHTML = parseInt($('.me_' + data.sendId).innerHTML) + 1;
        // $('.me_' + data.sendId).style.display = 'block';
    }
});

socket.on('user-join', (data) => {

    chat.log(data.username + ' is connected');
    chat.listUser(data);
});
socket.on('user-unjoin', (data) => {

    chat.log(data.user + ' disconnected');
    chat.removeListUser(data);
});