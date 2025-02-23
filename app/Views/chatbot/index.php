<!-- Tambahkan di bagian style -->
<style>
    .typing-indicator {
        display: none;
        padding: 10px;
        background: #e9ecef;
        border-radius: 10px;
        margin: 10px;
        width: fit-content;
    }

    .typing-indicator span {
        height: 8px;
        width: 8px;
        background: #666;
        display: inline-block;
        border-radius: 50%;
        animation: bounce 1.3s linear infinite;
    }

    .typing-indicator span:nth-child(2) {
        animation-delay: 0.2s;
    }

    .typing-indicator span:nth-child(3) {
        animation-delay: 0.4s;
    }

    @keyframes bounce {

        0%,
        100% {
            transform: translateY(0);
        }

        50% {
            transform: translateY(-5px);
        }
    }
</style>

<!-- Tambahkan sebelum form chat -->
<div class="typing-indicator" id="typingIndicator">
    <span></span>
    <span></span>
    <span></span>
</div>

<!-- Update script JavaScript -->
<script>
    $(document).ready(function() {
        $('#chatForm').on('submit', function(e) {
            e.preventDefault();

            const message = $('#messageInput').val();
            if (!message) return;

            // Tampilkan pesan user
            appendMessage(message, false);

            // Tampilkan indikator typing
            $('#typingIndicator').show();

            // Kirim ke server
            $.ajax({
                url: '<?= base_url('chatbot/sendMessage') ?>',
                type: 'POST',
                data: {
                    message: message
                },
                success: function(response) {
                    $('#typingIndicator').hide();
                    if (response.status === 'success') {
                        appendMessage(response.response, true);
                    }
                },
                error: function() {
                    $('#typingIndicator').hide();
                    appendMessage("Maaf, terjadi kesalahan. Silakan coba lagi.", true);
                }
            });

            $('#messageInput').val('');
        });

        function appendMessage(message, isBot) {
            const messageDiv = $('<div>')
                .addClass('chat-message')
                .addClass(isBot ? 'bot-message' : 'user-message')
                .text(message);

            $('#chatContainer').append(messageDiv);
            $('#chatContainer').scrollTop($('#chatContainer')[0].scrollHeight);
        }
    });
</script>