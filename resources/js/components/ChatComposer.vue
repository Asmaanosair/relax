<template>
    <div class="pannel-block field d-flex justify-content-center">
        <input
            class="message-input"
            type="text"
            v-on:keyup.enter="sendChat"
            v-model="chat"
            placeholder="أكتب رسالة هنا..."
        />

        <button id="send"  v-on:click="sendChat" class="message-sbt send-message"> ارسال</button>
    </div>
</template>

<script>
export default {

    props: ["chats", "userid", "friendid"],
    data() {
        return {
            chat: "",
            lang:""
        };
    },
    methods: {
       
        sendChat: function(e) {
            if (this.chat != "") {
                var data = {
                    message: this.chat,
                    user_id: this.friendid,
                    doctor_id: this.userid,
                    curr:new Date().toLocaleString('ar'),
                    created_at:null

                };

                console.log(data);

                this.chat = "";
                this.chats.push(data);

                let mySound = document.getElementById("chat-sound")
                mySound.play()
                mySound.currentTime=0

                axios.post("/chat/sendChat", data).then(response => {

                });
            }
        }
    },

      mounted() {
      }

};
</script>

<style>

</style>
