<template>
  <b-card no-body>
    <b-card-body>
      <div v-if="isBusy" class="text-center text-danger my-2">
        <b-spinner class="align-middle"></b-spinner>
        <strong>Loading...</strong>
      </div>
      <div v-else>
        <b-row>
          <b-col>
            <input type="text" v-model="message" />
            <b-button variant="danger" @click="sendMessage()">Connect</b-button>
            <ul>
              <template v-for="message in messages">
                <li>{{ message.text }}</li>
              </template>
            </ul>
          </b-col>
          <b-col>
            <img :src="qr_code" alt="qr image" v-if="connected" />
          </b-col>
        </b-row>
      </div>
    </b-card-body>
  </b-card>
</template>

<script>
import { BCard, BCardBody, BSpinner, BButton, BRow, BCol } from 'bootstrap-vue'
//import { socket } from "@/libs/socket";
import socket from '@/services/socketService';
export default {
  components: {
    BCard,
    BCardBody,
    BSpinner,
    BButton, BRow, BCol
  },
  data() {
    return {
      isBusy: false,
      qr_code: 'aaa',
      connected: false,
      message: '',
      messages: []
    }
  },
  created() {
    //SocketioService.setupSocketConnection();
    //this.$http.get('/dashboard').then(response => {
      //this.isBusy = false
      //this.data = response.data
    //})
    this.messages.push({text: 'Whatsapp started'});
    
  },
  methods: {
    sendMessage() {
      this.messages.push({text: 'Creating session...'});
      socket.emit('create-session', {
				id: this.message,
				description: `${this.message} deskripsi`
			});
    },
  },
  mounted() {
    socket.on('message', (message) => {
      this.messages.push(message);
    });
    socket.on('ayo', (message) => {
      console.log('mounted');
      console.log(message);
      this.messages.push(message);
    });
    socket.on('init', (data) => {
      console.log(data);
      for (var i = 0; i < data.length; i++) {
        var session = data[i];
        var clientId = session.id;
        var clientDescription = session.description;
        if (session.ready) {
          this.messages.push({text: 'Whatsapp is ready!'});
          this.messages.push({text: `ID: ${clientId}`});
        } else {
          if(this.messages){
            this.messages.push({text: 'Connecting...'});
          }
        }
      }
    });
    socket.on('message', (data) => {
      if(this.messages){
        this.messages.push({text: data.text});
      }
		});
    socket.on('qr', (data) => {
      this.connected = true
      this.qr_code = data.src
    });
    
    socket.on('ready', (data) => {
      this.connected = false
      //this.messages.push({text: 'hide qr ready'});
    });
    socket.on('authenticated', (data) => {
      this.connected = false
      this.messages.push({text: data.text});
    });
  },
}
</script>