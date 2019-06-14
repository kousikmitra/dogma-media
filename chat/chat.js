// OOP Way
/*fbChat = {
  bootChat: function () {
    var chatArea = $('#chatMsg'),
      that = this;

    // Load the messages every 5 seconds
    setInterval(this.getMessages, 5000);

    // Bind the keyboard event
    chatArea.bind('keydown', function (event) {
      if (event.keyCode === 13 && event.shiftKey === false) {
        var message = chatArea.val();

        if (message.length !== 0) {
          that.sendMessage(message);
          event.preventDefault();
        } else {
          alert('Provide a message to send!');
        }
      }
    });
  },
  sendMessage: function (message) {
    var that = this;
    $.ajax({
      url: 'add_msg.php',
      method: 'post',
      data: { msg: message },
      success: function (data) {
        $('#chatMsg').val('');
        that.getMessages();
      }
    });
  },
  getMessages: function () {
    alert('debug');
    $.ajax({
      url: 'get_messages.php',
      method: 'GET',
      success: function (data) {
        $('.msg-wgt-body').html(data);
      }
    });
  }
};
*/

// Initialize the chat
//fbChat.bootChat();

// Procedural way
/**
 * Add a new chat message
 * 
 * @param {string} message
 */
function scroll_chat() {
  $('#chat-window').animate({
    scrollTop: $('#chat-window').get(0).scrollHeight
  }, 1000);
}

function send_message(message, sent_to) {
  $.ajax({
    url: 'add_msg.php',
    method: 'post',
    data: { msg: message, sent_to: sent_to },
    success: function (data) {
      if (data == '') {
        $('#chatMsg').val('');
      }
      get_messages();
      scroll_chat();
    }
  });
}

/**
 * Get's the chat messages.
 */
function get_messages() {
  var sent_to = $('#sent-user').attr('data');
  $.ajax({
    url: 'get_messages.php',
    data: "chat_id=" + sent_to,
    method: 'GET',
    success: function (data) {
      $('.msg-wgt-body').html(data);
      
    }
  });
}

/**
 * Initializes the chat application
 */
function boot_chat() {
  var chatArea = $('#chatMsg');

  // Load the messages every 5 seconds
  // setInterval(get_messages, 5000);

  // Bind the keyboard event
  chatArea.bind('keydown', function (event) {
    // Check if enter is pressed without pressing the shiftKey
    if (event.keyCode === 13 && event.shiftKey === false) {
      var message = chatArea.val();
      // Check if the message is not empty
      if (message.length !== 0) {
        send_message(message, chatArea.attr('data'));
        event.preventDefault();
      } else {
        alert('Provide a message to send!');
        chatArea.val('');
      }
    }
  });
}

// Initialize the chat
boot_chat();
