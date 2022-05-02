<template>
    <div class="panel-block ">
        <div class="chat" v-if="chats.length != 0">
            <div v-for="( chat , index ) in chats" style="overflow:auto" :key="index" >

                <div class="message-rect-sender" v-if="chat.user_id == userid">
                    <p class="m-0">{{chat.message}}</p>
                    <span class="time text-success">{{chat.created_at==null ? chat.curr :  new Date(chat.created_at).toLocaleString('ar')   }}</span>
                </div>

                <div class="message-rect-reciever" v-else>
                    <p class="m-0 text-right">{{chat.message}}</p>
                     <span class="time text-warning">{{chat.created_at==null ? chat.curr :  new Date(chat.created_at).toLocaleString('ar')   }}</span>
                </div>

            </div>
        </div>

        <div v-else class="no-message">
          لا يوجد رسائل بينكم حتى الان
        </div>
        <chat-composer
        :userid="userid"
        :friendid="friendid"
        :chats="chats"

        ></chat-composer>
    </div>
</template>

<script>
export default {
    props: ["chats",'userid','friendid'],
    mounted() {
 
      },data() {
        return {

        };
    },


};
</script>

<style scoped>


.chat{
    min-height: 600px;

}
.no-message{
    height: 600px;
    display: flex;
    align-items: center;
    justify-content:center;
    font-size:26px
}

</style>
