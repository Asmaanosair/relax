import Vue from 'vue'
import './bootstrap'
import { activeLink } from './utils/index'

// Vue components
Vue.component('video-chat', require('./components/VideoChat.vue').default)
Vue.component('dr-video-chat', require('./components/DrVideoChat.vue').default)
Vue.component('chat', () => import( /* webpackChunkName: "chat" */ './components/Chat.vue'))
Vue.component('chat-composer', () => import( /* webpackChunkName: "chat-composer" */ './components/ChatComposer.vue'))

activeLink()

// The Vue instance
const app = new Vue({
  el: '#app',
  data: {
    chats: '',
  },
  created() {
    const userId = $('meta[name="userId"]').attr('content')

    const friendId = $('meta[name="friendId"]').attr('content')

    if (friendId != undefined) {
      axios.post('/chat/getChat/' + friendId).then((response) => {
        this.chats = response.data
      })

      Echo.private('Chat.' + friendId + '.' + userId).listen(
        'BroadcastChat',
        (e) => {
          this.chats.push(e.chat)
        },
      )
    }
  },
})
